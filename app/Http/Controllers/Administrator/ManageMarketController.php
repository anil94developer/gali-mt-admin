<?php

namespace App\Http\Controllers\Administrator;

use App\Models\GameLoad;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StarlineGameRate;
use App\Models\Result;
use App\Models\Point;
use App\Models\PointTable;
use App\Models\Market;
use App\Models\User;
use App\Models\ManageCommission;
use App\Models\Tabletype;
use App\Models\Walletreport;
use App\Models\UserCommission;
use Carbon\Carbon;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;
use MongoDB\BSON\ObjectId;

class ManageMarketController extends Controller
{
  public function __construct()
  {
  }

  /**
   * Resolve comx_appmarkets document by route id (string or ObjectId).
   * Bids use table_id = market_id; URLs may pass Mongo _id or market_id string.
   */
  private function findMarketBySelectId($id): ?Market
  {
    $id = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', rawurldecode(trim((string) $id)));
    if ($id === '') {
      return null;
    }

    $m = Market::find($id);
    if ($m) {
      return $m;
    }

    $m = Market::where('_id', $id)->first();
    if ($m) {
      return $m;
    }

    if (preg_match('/^[a-f\d]{24}$/i', $id)) {
      try {
        $m = Market::where('_id', new ObjectId($id))->first();
        if ($m) {
          return $m;
        }
      } catch (\Throwable $e) {
        // invalid ObjectId
      }

      $doc = Market::raw(function ($collection) use ($id) {
        try {
          return $collection->findOne(
            [
              '$or' => [
                ['_id' => $id],
                ['_id' => new ObjectId($id)],
              ],
            ],
            ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]
          );
        } catch (\Throwable $e) {
          return null;
        }
      });

      if ($doc !== null) {
        $attrs = is_array($doc) ? $doc : json_decode(json_encode($doc), true);
        if (is_array($attrs) && isset($attrs['_id'])) {
          return (new Market)->newFromBuilder($attrs);
        }
      }
    }

    $m = Market::where('market_id', $id)
      ->where(function ($q) {
        $q->where('market_type', 3)->orWhere('market_type', '3');
      })
      ->first();
    if ($m) {
      return $m;
    }

    try {
      $m = Market::whereRaw([
        'market_id' => ['$regex' => '^' . preg_quote($id, '/') . '$', '$options' => 'i'],
        'market_type' => ['$in' => [3, '3']],
      ])->first();
      if ($m) {
        return $m;
      }
    } catch (\Throwable $e) {
    }

    return null;
  }

  /**
   * MongoDB PHP driver expects ObjectId (or BSON type) for _id filters — plain strings throw InvalidArgumentException.
   */
  private function bsonIdForQuery($id)
  {
    if ($id === null || $id === '') {
      return $id;
    }
    if ($id instanceof ObjectId) {
      return $id;
    }
    $s = trim((string) $id);
    if (preg_match('/^[a-f\d]{24}$/i', $s)) {
      try {
        return new ObjectId($s);
      } catch (\Throwable $e) {
      }
    }

    return $id;
  }

  /**
   * @param  array<int|string|null>  $ids
   * @return array<int, ObjectId>
   */
  private function gameLoadObjectIdsForNin(array $ids): array
  {
    $out = [];
    foreach ($ids as $id) {
      if ($id === null || $id === '') {
        continue;
      }
      $s = trim((string) $id);
      if (!preg_match('/^[a-f\d]{24}$/i', $s)) {
        continue;
      }
      try {
        $out[] = new ObjectId($s);
      } catch (\Throwable $e) {
      }
    }

    return $out;
  }

  /*-------Show List Page ---------*/
  public function update_result(Request $request)
  {
    $market_data = Market::where('market_type', 3)->orderBy('market_position', 'ASC')->get();

    $result = Result::query();
    if ($request->filled('from_date') && $request->filled('to_date')) {
      $from = Carbon::parse($request->from_date)->format('d-m-Y');
      $to = Carbon::parse($request->to_date)->format('d-m-Y');

      $result->whereBetween('date', [$from, $to]);
    } else {
      $today = now()->format('d-m-Y');
      $result->where('date', $today);
    }

    $result = $result->orderBy('date_time_result', 'DESC')->get();

    return view('administrator.managemarket.update_result', compact('market_data', 'result'));
  }

  public function updateResultData(Request $request)
  {
    $data = Result::where('_id', $request->id)->first();

    if (!$data) {
      return redirect()->back()->with('error_message', 'Result not found.');
    }

    $data->result = (string) $request->result;
    $data->save();

    return redirect()->back()->with('success_message', 'Market result updated successfully.');
  }

  public function winner_number()
  {
    $market_data = Market::where('market_type', 3)->orderBy('market_position', 'ASC')->get();
    $winnerUserListFinal = [];
    if (isset($_GET['dec_result'])) {

      date_default_timezone_set('Asia/Kolkata');
      $ressutt = preg_replace('/\D/', '', (string) $_GET['dec_result']);
      if ($ressutt === '') {
        return redirect()->route('winner_number_index')->with('error_message', 'Invalid declare result.');
      }
      if (strlen($ressutt) === 1) {
        $ressutt = str_pad($ressutt, 2, '0', STR_PAD_LEFT);
      } elseif (strlen($ressutt) > 2) {
        $ressutt = substr($ressutt, -2);
      }
      $resut1 = str_split($ressutt);
      $andar = $resut1[0];
      $bahar = $resut1[1];
      $jodiKey = $andar . $bahar;

      $id = $_GET['select_market'] ?? '';
      $mdata = $this->findMarketBySelectId($id);

      if (!$mdata) {
        return redirect()->route('winner_number_index')->with('error_message', 'Market not found. Please select a valid market.');
      }

      $mid = $mdata->market_id;
      $datert = date('d-m-Y', strtotime($_GET['market_date']));
      $gdata = GameLoad::where('date', $datert)
        ->where('table_id', $mid)
        ->where('tr_nature', 'TRGAME001')
        ->get();

      $date = date('d-m-Y');
      $date1 = date('Y-m-d H:i:s');

      if (count((array) $gdata) > 0) {

        $winnerUserList = [];
        $winnerUserList1 = [];
        $winnerUserList2 = [];
        foreach ($gdata as $vs) {

          $udata = User::where('user_id', $vs->user_id)->select('credit')->first();
          $winudata = User::where('user_id', $vs->user_id)->select('win_amount')->first();
          $gt = (int) $vs->game_type;
          if ($vs->pred_num == $andar || $vs->pred_num == $bahar || $vs->pred_num == $jodiKey) {

            if ($gt === 9 || $gt === 10) {
              $bahar1 = Tabletype::where('id', $vs->game_type)->first();

              if ($gt === 9 && $vs->pred_num == $andar) {

                $winnerUserList = GameLoad::with('user_data')->where('_id', $this->bsonIdForQuery($vs->_id))->get();
                $winnerUserListFinal[] = $winnerUserList;
              } elseif ($gt === 10 && $vs->pred_num == $bahar) {

                $winnerUserList1 = GameLoad::with('user_data')->where('_id', $this->bsonIdForQuery($vs->_id))->get();
                $winnerUserListFinal[] = $winnerUserList1;
              }
            } else {
              if ($vs->pred_num == $jodiKey) {
                $winnerUserList2 = GameLoad::with('user_data')->where('_id', $this->bsonIdForQuery($vs->_id))->get();
                $winnerUserListFinal[] = $winnerUserList2;
              }
            }
          }

        }
      }
      // dd($winnerUserListFinal);
      return view('administrator.managemarket.winner_number', compact('market_data', 'winnerUserListFinal'));
    }
    return view('administrator.managemarket.winner_number', compact('market_data', 'winnerUserListFinal'));
  }
  public function update_result_delete($id)
  {
    Result::where('_id', $id)->delete();
    return redirect('/administrator/manage-market/update-result');
  }
  public function update_result_store(Request $request)
  {
    date_default_timezone_set('Asia/Kolkata');

    $date = Carbon::parse($request->market_date)->format('d-m-Y');
    $dateTime = Carbon::parse($request->market_date)->format('Y-m-d H:i:s');

    $data = [
      'market_id' => $request->select_market,
      'result' => $request->dec_result,
      'date' => $date,
      'date_time_result' => $dateTime,
      'day_of_result' => Carbon::now()->format('D'),
      'app_id' => 'com.dubaiking',
    ];

    Result::create($data);

    return redirect('/administrator/manage-market/update-result')->with('success_message', 'Market Result Declare successfully.');
  }

  public function winner_numberData_result_declear(Request $request)
  {
    ini_set('memory_limit', -1);
    date_default_timezone_set('Asia/Kolkata');
    $id = $request->select_market;
    $mdata = $this->findMarketBySelectId($id);

    if (!$mdata) {
      return redirect()->back()->with('error_message', 'Market not found. Please select a valid market.');
    }

    $mid = $mdata->market_id;
    if ($request->paidUnpaid == 'unpaid') {
      $this->unpaidWinner($request->winSelected, $mid, $request->date);
      return redirect()->back();
    } elseif ($request->paidUnpaid == 'lost') {
      $this->LostWinner($request->winSelected, $mid, $request->date);
      return redirect()->back();
    } elseif ($request->paidUnpaid == 'UnLost') {
      $this->UnLostWinner($request->winSelected, $mid, $request->date);
      return redirect()->back();
    } elseif ($request->paidUnpaid == 'delete') {
      $this->deleteWinner($request->winSelected, $mid, $request->date);
      return redirect()->back();
    }
    // $this->commission_distribute($request->winSelected,$request->totalWinnerId,$request->date,$mid);

    $totalWinnerIdParts = array_values(array_filter(array_map('trim', explode(',', (string) ($request->totalWinnerId ?? '')))));
    $winSelected = $request->input('winSelected', []);
    if (!is_array($winSelected)) {
      $winSelected = ($winSelected !== null && $winSelected !== '') ? [$winSelected] : [];
    }

    $output = array_values(array_diff(
      array_merge($winSelected, $totalWinnerIdParts),
      array_intersect($winSelected, $totalWinnerIdParts)
    ));

    date_default_timezone_set('Asia/Kolkata');
    $resut1 = str_split($request->dec_result);
    @$andar = $resut1['0'];
    @$bahar = $resut1['1'];

    $date = date('d-m-Y');
    $gdataQuery = GameLoad::where('table_id', $mid)
      ->where('date', date('d-m-Y', strtotime($request->date)))
      ->where('is_result_declared', 0)
      ->where('tr_nature', 'TRGAME001')
      ->where('is_win', 0);
    if (count($output) > 0) {
      $nin = $this->gameLoadObjectIdsForNin($output);
      if (count($nin) > 0) {
        $gdataQuery->whereNotIn('_id', $nin);
      }
    }
    $gdata = $gdataQuery->get();

    $getLostQuery = GameLoad::where('table_id', $mid)
      ->where('date', date('d-m-Y', strtotime($request->date)))
      ->where('is_result_declared', 0)
      ->where('tr_nature', 'TRGAME001')
      ->where('is_win', 0);
    if (count($totalWinnerIdParts) > 0) {
      $ninLost = $this->gameLoadObjectIdsForNin($totalWinnerIdParts);
      if (count($ninLost) > 0) {
        $getLostQuery->whereNotIn('_id', $ninLost);
      }
    }
    $getLostData = $getLostQuery->get();

    if ($mdata->id == 12 or $mdata->id == 39 or $mdata->id == 11) {
      // if ($id == 12 or $id == 39) {
      $date1 = date('Y-m-d H:i:s', strtotime('-1 day'));
      $date = date('d-m-Y', strtotime('-1 day'));
      $dateuserCom = date('Y-m-d', strtotime('-1 day'));
    } else {
      $date = date('d-m-Y');
      $date1 = date('Y-m-d H:i:s');
      $dateuserCom = date('Y-m-d');
    }

    if (count($getLostData) > 0) {
      $this->OtherNumberUserLost($request->winSelected, $mid, $request->date, $dateuserCom);
    }

    if (count((array) $gdata) > 0) {
      foreach ($gdata as $vs) {

        $udata = User::where('user_id', $vs->user_id)->where('user_id', (string) $vs->user_id)->select('credit')->first();
        $winudata = User::where('user_id', $vs->user_id)->select('win_amount')->first();

        if ($vs->pred_num == $andar or $vs->pred_num == $bahar or $vs->pred_num == $andar . $bahar) {

          if ($vs->game_type == 9 or $vs->game_type == 10) {

            $bahar1 = Tabletype::where('id', $vs->game_type)->first();

            $price_lot = $bahar1->price_lot;
            if ($vs->game_type == 9 and $vs->pred_num == $andar) {
              // Calculate win amount
              $price_lot = $bahar1->price_lot;
              $cAmount = $vs->tr_value * $price_lot;

              $pred_num = null;
              if ($vs->game_type == 9) {
                $pred_num = $andar;
              } elseif ($vs->game_type == 10) {
                $pred_num = $bahar;
              }

              $pointTableData = [
                'app_id' => $vs->app_id,
                'game_type' => $vs->game_type,
                'admin_key' => $vs->admin_key,
                'win_value' => $cAmount,
                'user_id' => $vs->user_id,
                'transaction_id' => $vs->transaction_id,
                'uniquid' => $vs->uniquid,
                'tr_nature' => 'TRWIN005',
                'tr_value' => $vs->tr_value,
                'win_bet_amt_not_use' => $vs->tr_value,
                'value_update_by' => 'Win',
                'is_win' => 1,
                'is_result_declared' => (int) 1,
                'batId' => $this->bsonIdForQuery($vs->_id),
                'tr_value_type' => "Credit",
                'tr_value_updated' => @$udata->credit + @$udata->win_amount + $cAmount,
                'date' => $vs->date,
                'pred_num' => $pred_num,
                'tr_status' => "Success",
                'market_type' => "mainMarket",
                'date_time' => $vs->date_time,
                'table_id' => $vs->table_id,
                'created_at' => $date1,
              ];

              // Insert into MongoDB
              PointTable::create($pointTableData);

              $walletReportData = [
                'pred_num' => $pred_num,
                'app_id' => $vs->app_id,
                'transaction_id' => $vs->transaction_id,
                'tr_remark' => "Game Win",
                'game_type' => $vs->game_type,
                'user_id' => $vs->user_id,
                'tr_nature' => 'TRWIN005',
                'win_value' => $cAmount,
                'tr_value' => $cAmount,
                'value_update_by' => "Game",
                'type' => "Credit",
                'date' => $date,
                'date_time' => $date1,
                'tr_status' => "Success",
                'table_id' => $vs->table_id,
                'is_win' => 1,
                'point_table_id' => $vs->uniquid,
              ];

              // Insert into MongoDB

              GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 1, 'win_value' => $cAmount, 'is_result_declared' => 1]);

              $winamt = @$udata->credit + $cAmount;
              User::where('user_id', $vs->user_id)->update(['credit' => $winamt]);
              // DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance, 'win_amount' => $winamt]);
              $userfinal = User::where('user_id', $vs->user_id)->first();
              if ($userfinal) {
                $walletReportData['tr_value_updated'] = $userfinal->credit + $userfinal->win_amount;
              }

              Walletreport::create($walletReportData);



              $user = User::where('user_id', $vs->user_id)->first();
              $user_reffer_by = User::where('ref_code', $user->ref_by)->first();
              if ($user_reffer_by) {
                $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
                if ($com_usr) {
                  $bataamt = $com_usr->bat_amount + $vs->tr_value;
                  $winaamt = $com_usr->win_amount + $cAmount;
                  ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

                } else {
                  ManageCommission::create([
                    'user_id' => $vs->user_id,
                    'reciver_user_id' => $user_reffer_by->user_id,
                    'market_id' => $vs->table_id,
                    'bat_amount' => $vs->tr_value,
                    'win_amount' => $cAmount,
                    'status' => 'pending',
                    'date' => $dateuserCom,
                    'visible' => 1,
                  ]);
                }
              }

            } elseif ($vs->game_type == 10 and $vs->pred_num == $bahar) {

              // $cAmount = $vs->tr_value * $price_lot;
              // $data = array();
              // $data['app_id'] = $vs->app_id;
              // $data['game_type'] = $vs->game_type;
              // $data['admin_key'] = $vs->admin_key;
              // $data['win_value'] = $cAmount;
              // $data['user_id'] = $vs->user_id;
              // $data['transaction_id'] = $vs->transaction_id;
              // $data['tr_nature'] = 'TRWIN005';
              // // $data['tr_value'] = $cAmount;
              // $data['tr_value'] = $vs->tr_value;
              // $data['win_bet_amt_not_use'] = $vs->tr_value;
              // $data['created_at'] = $date1;
              // $data['value_update_by'] = 'Win';
              // $data['batId'] = $vs->id;
              // $data['tr_value_type'] = "Credit";
              // $data['tr_value_updated'] = @$udata->credit + $udata->win_amount + $cAmount;
              // $data['date'] = $date;
              // if ($vs->game_type == 9) {
              //   $pred_num = $andar;
              // }
              // if ($vs->game_type == 10) {
              //   $pred_num = $bahar;
              // }

              // $data['pred_num'] = $pred_num;
              // $data['tr_status'] = "Success";
              // $data['market_type'] = "mainMarket";

              // $data['date_time'] = $date1;

              // $data['table_id'] = $vs->table_id;

              // $rdata = array();
              // $rdata['pred_num'] = $pred_num;
              // $rdata['app_id'] = $vs->app_id;
              // $rdata['game_type'] = $vs->game_type;
              // $rdata['user_id'] = $vs->user_id;
              // $rdata['tr_nature'] = 'TRWIN005';
              // $rdata['win_value'] = $cAmount;
              // $rdata['tr_value'] = $cAmount;
              // $rdata['type'] = "Credit";
              // $rdata['date'] = $date;
              // $rdata['date_time'] = $date1;
              // $rdata['value_update_by'] = "Game";
              // $rdata['tr_status'] = "Success";
              // $rdata['table_id'] = $vs->table_id;
              // $rdata['is_win'] = 1;
              // $rdata['transaction_id'] = $vs->transaction_id;
              // $rdata['tr_remark'] = "Game Win";
              // $rdata['point_table_id'] = $vs->id;

              // (object) Db::table('point_table')->insert($data);
              // Point::where('_id', $vs->_id)->update(['is_win' => 1, 'win_value' => $cAmount, 'is_result_declared' => 1]);

              // $balance = @$udata->credit + $udata->win_amount + $cAmount;
              // $winamt = @$winudata->win_amount + $cAmount;
              // User::where('user_id', $vs->user_id)->update(['win_amount' => $winamt]);
              // $userfinal = DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->first();
              // $rdata['tr_value_updated'] = @$userfinal->credit + $userfinal->win_amount;
              // (object) Db::table('wallet_reports')->insert($rdata);


              $cAmount = $vs->tr_value * $price_lot;

              // Prepare point table data
              $data = [
                'app_id' => $vs->app_id,
                'game_type' => $vs->game_type,
                'admin_key' => $vs->admin_key,
                'win_value' => $cAmount,
                'user_id' => $vs->user_id,
                'transaction_id' => $vs->transaction_id,
                'uniquid' => $vs->uniquid,
                'tr_nature' => 'TRWIN005',
                'tr_value' => $vs->tr_value,
                'win_bet_amt_not_use' => $vs->tr_value,
                'created_at' => $date1,
                'value_update_by' => 'Win',
                'is_win' => 1,
                'is_result_declared' => (int) 1,
                'batId' => $this->bsonIdForQuery($vs->_id),
                'tr_value_type' => "Credit",
                'tr_value_updated' => optional($udata)->credit + optional($udata)->win_amount + $cAmount,
                'date' => $vs->date,
                'pred_num' => ($vs->game_type == 9) ? $andar : (($vs->game_type == 10) ? $bahar : null),
                'tr_status' => "Success",
                'market_type' => "mainMarket",
                // 'date_time' => $date1,
                'date_time' => $vs->date_time,
                'table_id' => $vs->table_id,
              ];

              // Insert into MongoDB `point_table`
              Point::create($data);

              // Update `point_table` document
              GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update([
                'is_win' => 1,
                'win_value' => $cAmount,
                'is_result_declared' => 1
              ]);

              // Calculate updated balances
              $balance = optional($udata)->credit + optional($udata)->win_amount + $cAmount;
              // $winamt = optional($winudata)->win_amount + $cAmount;
              $winamt = @$udata->credit + $cAmount;

              // Update `users` collection
              User::where('user_id', $vs->user_id)->update(['credit' => $winamt]);

              // Fetch user data
              $userfinal = User::where('user_id', $vs->user_id)->first();

              // Prepare wallet report data
              $rdata = [
                'pred_num' => $data['pred_num'],
                'app_id' => $vs->app_id,
                'game_type' => $vs->game_type,
                'user_id' => $vs->user_id,
                'transaction_id' => $vs->transaction_id,
                'tr_nature' => 'TRWIN005',
                'win_value' => $cAmount,
                'tr_value' => $cAmount,
                'type' => "Credit",
                'date' => $date,
                'date_time' => $date1,
                'value_update_by' => "Game",
                'tr_status' => "Success",
                'table_id' => $vs->table_id,
                'is_win' => 1,
                'tr_remark' => "Game Win",
                'point_table_id' => $vs->uniquid,
                'tr_value_updated' => optional($userfinal)->credit + optional($userfinal)->win_amount,
              ];

              // Insert into `wallet_reports` collection
              Walletreport::create($rdata);



              /*Added MongoDb Code */
              $user = User::where('user_id', $vs->user_id)->first();
              $user_reffer_by = User::where('ref_code', $user->ref_by)->first();
              if ($user_reffer_by) {
                $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
                if ($com_usr) {
                  $bataamt = $com_usr->bat_amount + $vs->tr_value;
                  $winaamt = $com_usr->win_amount + $cAmount;
                  ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

                } else {
                  ManageCommission::create([
                    'user_id' => $vs->user_id,
                    'reciver_user_id' => $user_reffer_by->user_id,
                    'market_id' => $vs->table_id,
                    'bat_amount' => $vs->tr_value,
                    'win_amount' => $cAmount,
                    'status' => 'pending',
                    'date' => $dateuserCom,
                    'visible' => 1,
                  ]);
                }
              }

            } else {
              $user = User::where('user_id', $vs->user_id)->first();
              $user_reffer_by = User::where('ref_code', $user->ref_by)->first();
              if ($user_reffer_by) {
                $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
                if ($com_usr) {
                  $bataamt = $com_usr->bat_amount + $vs->tr_value;
                  $winaamt = $com_usr->win_amount;
                  ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

                } else {
                  ManageCommission::create([
                    'user_id' => $vs->user_id,
                    'reciver_user_id' => $user_reffer_by->user_id,
                    'market_id' => $vs->table_id,
                    'bat_amount' => $vs->tr_value,
                    'win_amount' => 0,
                    'status' => 'pending',
                    'date' => $dateuserCom,
                    'visible' => 1,
                  ]);
                }
              }
              GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 2, 'is_result_declared' => 1]);
              $pointTableData = [
                'app_id' => $vs->app_id,
                'game_type' => $vs->game_type,
                'admin_key' => $vs->admin_key,
                'win_value' => 0,
                'user_id' => $vs->user_id,
                'transaction_id' => $vs->transaction_id,
                'uniquid' => $vs->uniquid,
                'tr_nature' => 'TRGAME001',
                'tr_value' => $vs->tr_value,
                'win_bet_amt_not_use' => $vs->tr_value,
                'value_update_by' => 'Loss',
                'is_win' => 2,
                'is_result_declared' => (int) 1,
                'batId' => $this->bsonIdForQuery($vs->_id),
                'tr_value_type' => "Debit",
                'tr_value_updated' => @$user->credit + @$user->win_amount,
                'date' => $vs->date,
                'pred_num' => $vs->pred_num,
                'tr_status' => "Success",
                'market_type' => "mainMarket",
                'date_time' => $vs->date_time,
                'table_id' => $vs->table_id,
                'created_at' => $date1,
              ];

              // Insert into MongoDB
              PointTable::create($pointTableData);

            }
          } else {

            if ($vs->pred_num == $andar . $bahar) {

              $bahar1 = Tabletype::where('id', $vs->game_type)->first();
              // dd($bahar1);
              $price_lot = $bahar1->price_lot;
              $cAmount = $vs->tr_value * $price_lot;

              $data = [
                'app_id' => $vs->app_id,
                'game_type' => $vs->game_type,
                'admin_key' => $vs->admin_key,
                'win_value' => $cAmount,
                'user_id' => $vs->user_id,
                'transaction_id' => $vs->transaction_id,
                'uniquid' => $vs->uniquid,
                'tr_nature' => 'TRWIN005',
                'tr_value' => $vs->tr_value,
                'win_bet_amt_not_use' => $vs->tr_value,
                'market_type' => "mainMarket",
                'value_update_by' => 'Win',
                'is_win' => 1,
                'is_result_declared' => (int) 1,
                'batId' => $this->bsonIdForQuery($vs->_id),
                'tr_value_type' => "Credit",
                'tr_value_updated' => @$udata->credit + $cAmount,
                'date' => $vs->date,
                'pred_num' => $andar . $bahar,
                'tr_status' => "Success",
                'created_at' => $date1,
                // 'date_time' => $date1,
                'date_time' => $vs->date_time,
                'table_id' => $vs->table_id,
              ];

              PointTable::create($data);

              $balance = @$udata->credit + $udata->win_amount + $cAmount;
              // $winamt = @$winudata->win_amount + $cAmount;
              $winamt = @$udata->credit + $cAmount;
              User::where('user_id', $vs->user_id)->update(['credit' => $winamt]);
              $userfinal = User::where('user_id', $vs->user_id)->first();
              $rdata = [
                'app_id' => $vs->app_id,
                'pred_num' => $vs->pred_num,
                'game_type' => $vs->game_type,
                'win_value' => $cAmount,
                'user_id' => $vs->user_id,
                'tr_nature' => 'TRWIN005',
                'tr_value' => $vs->tr_value,
                'value_update_by' => 'Win',
                'type' => "Credit",
                'date' => $date,
                'date_time' => $date1,
                'tr_status' => "Success",
                'table_id' => $vs->table_id,
                'is_win' => 1,
                'transaction_id' => $vs->transaction_id,
                'tr_remark' => "Game Win",
                'point_table_id' => $vs->uniquid,
                'tr_value_updated' => @$userfinal->credit + $userfinal->win_amount,
              ];

              // Insert into MongoDB
              Walletreport::create($rdata);


              GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 1, 'win_value' => $cAmount, 'is_result_declared' => 1]);

              $user = User::where('user_id', $vs->user_id)->first();
              $user_reffer_by = User::where('ref_code', $user->ref_by)->first();
              // echo $user->ref_code;
              if ($user_reffer_by) {
                $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
                if ($com_usr) {
                  $bataamt = $com_usr->bat_amount + $vs->tr_value;
                  $winaamt = $com_usr->win_amount + $cAmount;
                  ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

                } else {
                  ManageCommission::create([
                    'user_id' => $vs->user_id,
                    'reciver_user_id' => $user_reffer_by->user_id,
                    'market_id' => $vs->table_id,
                    'bat_amount' => $vs->tr_value,
                    'win_amount' => $cAmount,
                    'status' => 'pending',
                    'date' => $dateuserCom,
                    'visible' => 1,
                  ]);
                }
              }

            } else {

              // $user = User::where('user_id', trim($vs->user_id))->first();
              $user = User::where('user_id', 'regexp', '^' . trim($vs->user_id) . '$')->first();
              $user_reffer_by = User::whereRaw(['ref_code' => ['$eq' => trim(@$user->ref_by)]])->first();
              // echo $user->ref_code;

              if ($user_reffer_by) {
                $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
                if ($com_usr) {
                  $bataamt = $com_usr->bat_amount + $vs->tr_value;
                  $winaamt = $com_usr->win_amount;
                  ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

                } else {
                  ManageCommission::create([
                    'user_id' => $vs->user_id,
                    'reciver_user_id' => $user_reffer_by->user_id,
                    'market_id' => $vs->table_id,
                    'bat_amount' => $vs->tr_value,
                    'win_amount' => 0,
                    'status' => 'pending',
                    'date' => $dateuserCom,
                    'visible' => 1,
                  ]);
                }
              }
              GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 2, 'is_result_declared' => 1]);
              $pointTableData = [
                'app_id' => $vs->app_id,
                'game_type' => $vs->game_type,
                'admin_key' => $vs->admin_key,
                'win_value' => 0,
                'user_id' => $vs->user_id,
                'transaction_id' => $vs->transaction_id,
                'uniquid' => $vs->uniquid,
                'tr_nature' => 'TRGAME001',
                'tr_value' => $vs->tr_value,
                'win_bet_amt_not_use' => $vs->tr_value,
                'value_update_by' => 'Loss',
                'is_win' => 2,
                'is_result_declared' => (int) 1,
                'batId' => $this->bsonIdForQuery($vs->_id),
                'tr_value_type' => "Debit",
                'tr_value_updated' => @$user->credit + @$user->win_amount,
                'date' => $vs->date,
                'pred_num' => $vs->pred_num,
                'tr_status' => "Success",
                'market_type' => "mainMarket",
                'date_time' => $vs->date_time,
                'table_id' => $vs->table_id,
                'created_at' => $date1,
              ];

              // Insert into MongoDB
              PointTable::create($pointTableData);
            }
          }

        } else {
          $user = User::where('user_id', 'regexp', '^' . trim($vs->user_id) . '$')->first();

          if ($user) {
            $user_reffer_by = User::where('ref_code', 'regexp', '^' . trim($user->ref_by) . '$')->first();
          }


          // echo $user->ref_code;
          if ($user_reffer_by) {
            $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
            if ($com_usr) {
              $bataamt = $com_usr->bat_amount + $vs->tr_value;
              $winaamt = $com_usr->win_amount;
              ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

            } else {
              ManageCommission::create([
                'user_id' => $vs->user_id,
                'reciver_user_id' => $user_reffer_by->user_id,
                'market_id' => $vs->table_id,
                'bat_amount' => $vs->tr_value,
                'win_amount' => 0,
                'status' => 'pending',
                'date' => $dateuserCom,
                'visible' => 1,
              ]);
            }
          }
          GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 2, 'is_result_declared' => 1]);
          $pointTableData = [
            'app_id' => $vs->app_id,
            'game_type' => $vs->game_type,
            'admin_key' => $vs->admin_key,
            'win_value' => 0,
            'user_id' => $vs->user_id,
            'transaction_id' => $vs->transaction_id,
            'uniquid' => $vs->uniquid,
            'tr_nature' => 'TRGAME001',
            'tr_value' => $vs->tr_value,
            'win_bet_amt_not_use' => $vs->tr_value,
            'value_update_by' => 'Loss',
            'is_win' => 2,
            'is_result_declared' => (int) 1,
            'batId' => $this->bsonIdForQuery($vs->_id),
            'tr_value_type' => "Debit",
            'tr_value_updated' => @$user->credit + @$user->win_amount,
            'date' => $vs->date,
            'pred_num' => $vs->pred_num,
            'tr_status' => "Success",
            'market_type' => "mainMarket",
            'date_time' => $vs->date_time,
            'table_id' => $vs->table_id,
            'created_at' => $date1,
          ];

          // Insert into MongoDB
          PointTable::create($pointTableData);
        }

        //Db::table('point_table')->where('id',$vs->id)->update(['is_result_declared'=>1]);
      }

    }

    return redirect()->back();
  }

  public function commission_distribute($winSelected, $totalWinnerId, $date, $mid)
  {
    if ($winSelected) {
      // DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
      $gdata = Point::whereIn('_id', $winSelected)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('is_result_declared', '0')->where('tr_nature', 'TRGAME001')->where('is_win', '0')->orderBy('id', 'DESC')->groupBy('user_id')->get();
      $commissionuserlist = [];
      foreach ($gdata as $vs) {
        $winnerAmt = 0;
        $batAmt = 0;
        $perticularuser = Point::whereIn('id', $winSelected)->where('user_id', $vs->user_id)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('is_result_declared', '0')->where('tr_nature', 'TRGAME001')->where('is_win', '0')->orderBy('id', 'DESC')->get();
        $perticulartotaluser = Point::where('user_id', $vs->user_id)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('is_result_declared', '0')->where('tr_nature', 'TRGAME001')->where('is_win', '0')->orderBy('id', 'DESC')->sum('tr_value');
        foreach ($perticularuser as $vss) {
          if ($vss->game_type == 8) {
            $priceinto = Tabletype::where('id', $vss->game_type)->first();
            $cAmount = $vss->tr_value * $priceinto->price_lot;
            $winnerAmt += $cAmount;
          } elseif ($vss->game_type == 9) {
            $priceinto = Tabletype::where('id', $vss->game_type)->first();
            $cAmount = $vss->tr_value * $priceinto->price_lot;
            $winnerAmt += $cAmount;
          } elseif ($vss->game_type == 10) {
            $priceinto = Tabletype::where('id', $vss->game_type)->first();
            $cAmount = $vss->tr_value * $priceinto->price_lot;
            $winnerAmt += $cAmount;
          }
          $arraydata['winnerAmt'] = $winnerAmt;
          // $arraydata['batAmt'] = $perticulartotaluser;
          $arraydata['batAmt'] = $perticulartotaluser;
        }
        $arraydata['userid'] = $vs->user_id;
        $arraydata['market_id'] = $vs->table_id;
        $commissionuserlist[] = $arraydata;
        // $finalAmt = $perticulartotaluser - $winnerAmt;

        // echo $winnerAmt;
        // echo $perticulartotaluser;
        // if($finalAmt > 0){
        //   echo "yes";
        // }

      }
      // dd($commissionuserlist);
      foreach ($commissionuserlist as $vd) {
        $user = User::where('user_id', $vd['userid'])->first();
        $user_reffer_by = User::where('ref_code', $user->ref_by)->first();
        // echo $user->ref_code;
        if ($user_reffer_by) {
          // dd($user_reffer_by);
          $finalAmt = $vd['batAmt'] - $vd['winnerAmt'];
          // if($finalAmt > 0){
          $chkAlready = ManageCommission::where('user_id', $vd['userid'])->where('date', date('Y-m-d'))->where('status', 'pending')->where('market_id', $vd['market_id'])->first();
          if ($chkAlready) {
            // dd('pppp');
            $upbat = $chkAlready->bat_amount - $vd['batAmt'];
            $updatewin = $chkAlready->win_amount - $vd['winnerAmt'];
            ManageCommission::where('user_id', $vd['userid'])->where('date', date('Y-m-d'))->where('market_id', $vd['market_id'])->update(['bat_amount' => $upbat, 'win_amount' => $updatewin]);
          } else {
            ManageCommission::create([
              'user_id' => $vd['userid'],
              'reciver_user_id' => $user_reffer_by->user_id,
              'market_id' => $vd['market_id'],
              'bat_amount' => $vd['batAmt'],
              'win_amount' => $vd['winnerAmt'],
              'status' => 'pending',
              'date' => date('Y-m-d'),
              'visible' => 1,
            ]);
          }
          // }
        }

      }
      // dd($commissionuserlist);

    }

  }
  public function unpaidWinner($id, $mid, $date)
  {
    $idList = is_array($id) ? $id : (($id !== null && $id !== '') ? [$id] : []);
    $oids = $this->gameLoadObjectIdsForNin($idList);
    if (count($oids) === 0) {
      return;
    }
    $gdata = GameLoad::whereIn('_id', $oids)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('tr_nature', 'TRGAME001')->get();
    //  dd($gdata);
    foreach ($gdata as $vs) {
      // $this->lavalDistributeUnPaid($vs->user_id,$vs->id);
      $win = GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->first();
      // dd($win);

      $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $date)->first();
      //   // dd($com_usr);
      if ($com_usr) {
        if ($win->game_type == 8) {
          $priceinto = Tabletype::where('id', $win->game_type)->first();
          $cAmount = $win->tr_value * $priceinto->price_lot;
          $winnerAmt = $com_usr->win_amount - $cAmount;
        } elseif ($win->game_type == 9) {
          $priceinto = Tabletype::where('id', $win->game_type)->first();
          $cAmount = $win->tr_value * $priceinto->price_lot;
          $winnerAmt = $com_usr->win_amount - $cAmount;
        } elseif ($win->game_type == 10) {
          $priceinto = Tabletype::where('id', $win->game_type)->first();
          $cAmount = $win->tr_value * $priceinto->price_lot;
          $winnerAmt = $com_usr->win_amount - $cAmount;
        }
        $battAmt = $com_usr->bat_amount - $vs->tr_value;
        ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winnerAmt, 'bat_amount' => $battAmt]);
      }

      $user = User::where('user_id', $vs->user_id)->first();
      $totalAMt = $user->credit - $win->win_value;
      $user = User::where('user_id', $vs->user_id)->update(['credit' => $totalAMt]);
      Point::where('uniquid', $vs->uniquid)->delete();
      GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 0, 'is_result_declared' => 0, 'win_value' => 0]);
      Walletreport::where('point_table_id', $vs->uniquid)->delete();

      // $usrcom = User::where('user_id', $vs->user_id)->first();
      // $usrcom_refby = User::where('ref_code', $usrcom->ref_by)->first();
      // if ($usrcom_refby) {
      //   // dd($win);

      // }



    }

  }
  public function deleteWinner($id, $mid, $date)
  {
    $idList = is_array($id) ? $id : (($id !== null && $id !== '') ? [$id] : []);
    $oids = $this->gameLoadObjectIdsForNin($idList);
    if (count($oids) === 0) {
      return;
    }
    $gdata = GameLoad::whereIn('_id', $oids)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('tr_nature', 'TRGAME001')->get();
    foreach ($gdata as $vs) {
      $win = GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->first();
      $user = User::where('user_id', $vs->user_id)->first();
      $totalAMt = $user->credit + $win->tr_value;
      $user = User::where('user_id', $vs->user_id)->update(['credit' => $totalAMt]);
      Walletreport::where('point_table_id', $vs->uniquid)->delete();
      Point::where('uniquid', $vs->uniquid)->delete();
      GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['tr_nature' => 'TRREJECT009', 'tr_remark' => 'Bat Reject Please Check Term&condition', 'is_win' => 3]);

    }
  }
  public function LostWinner($id, $mid, $date)
  {
    $idList = is_array($id) ? $id : (($id !== null && $id !== '') ? [$id] : []);
    $oids = $this->gameLoadObjectIdsForNin($idList);
    if (count($oids) === 0) {
      return;
    }
    $gdata = GameLoad::whereIn('_id', $oids)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('tr_nature', 'TRGAME001')->get();
    foreach ($gdata as $vs) {

      $user = User::where('user_id', $vs->user_id)->first();
      $user_reffer_by = User::where('ref_code', $user->ref_by)->first();
      // echo $user->ref_code;
      if ($user_reffer_by) {
        $dateuserCom = date('Y-m-d');
        $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
        if ($com_usr) {
          $bataamt = $com_usr->bat_amount + $vs->tr_value;
          $winaamt = $com_usr->win_amount;
          ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

        } else {
          ManageCommission::create([
            'user_id' => $vs->user_id,
            'reciver_user_id' => $user_reffer_by->user_id,
            'market_id' => $vs->table_id,
            'bat_amount' => $vs->tr_value,
            'win_amount' => 0,
            'status' => 'pending',
            'date' => $dateuserCom,
            'visible' => 1,
          ]);
        }
      }

      $mdata = Market::where('market_id', $mid)->first();

      if ($mdata->id == 12 or $mdata->id == 39 or $mdata->id == 11) {
        // if ($id == 12 or $id == 39) {
        $date1 = date('Y-m-d H:i:s', strtotime('-1 day'));
        $date = date('d-m-Y', strtotime('-1 day'));
        $dateuserCom = date('Y-m-d', strtotime('-1 day'));
      } else {
        $date = date('d-m-Y');
        $date1 = date('Y-m-d H:i:s');
        $dateuserCom = date('Y-m-d');
      }

      $pointTableData = [
        'app_id' => $vs->app_id,
        'game_type' => $vs->game_type,
        'admin_key' => $vs->admin_key,
        'win_value' => 0,
        'user_id' => $vs->user_id,
        'transaction_id' => $vs->transaction_id,
        'uniquid' => $vs->uniquid,
        'tr_nature' => 'TRGAME001',
        'tr_value' => $vs->tr_value,
        'win_bet_amt_not_use' => $vs->tr_value,
        'value_update_by' => 'Loss',
        'is_win' => 2,
        'is_result_declared' => (int) 1,
        'batId' => $this->bsonIdForQuery($vs->_id),
        'tr_value_type' => "Credit",
        'tr_value_updated' => @$user->credit + @$user->win_amount,
        'date' => $vs->date,
        'pred_num' => $vs->pred_num,
        'tr_status' => "Success",
        'market_type' => "mainMarket",
        'date_time' => $vs->date_time,
        'table_id' => $vs->table_id,
        'created_at' => $date1,
      ];

      // Insert into MongoDB
      PointTable::create($pointTableData);

      GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 2, 'is_result_declared' => 1]);
      //  $this->lavalDistributePaid($vs->user_id,$vs->id);

    }
  }
  public function OtherNumberUserLost($id, $mid, $date, $dateuserCom)
  {
    // $gdata = Point::whereNotIn('id', $id)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('tr_nature', 'TRGAME001')->orderBy('id', 'DESC')->get();
    // foreach ($gdata as $vs) {
    //   Point::where('id', $vs->id)->update(['is_win' => '2', 'is_result_declared' => '1']);
    //   // $this->lavalDistributePaid($vs->user_id,$vs->id);
    //   $com_usr = DB::table('manage_commissions')->where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
    //   if ($com_usr) {
    //     $usrcomdis = $com_usr->win_amount + 0;
    //     $usrcom = User::where('user_id', $com_usr->user_id)->first();
    //     $usrcom_refby = User::where('ref_code', $usrcom->ref_by)->first();
    //     if ($usrcom_refby) {
    //       DB::table('manage_commissions')->where('id', $com_usr->id)->update(['win_amount' => $usrcomdis, 'visible' => 1, 'reciver_user_id' => $usrcom_refby->user_id]);

    //     }
    //   }
    // }
  }
  public function UnLostWinner($id, $mid, $date)
  {
    $idList = is_array($id) ? $id : (($id !== null && $id !== '') ? [$id] : []);
    $oids = $this->gameLoadObjectIdsForNin($idList);
    if (count($oids) === 0) {
      return;
    }
    $gdata = GameLoad::whereIn('_id', $oids)->where('table_id', $mid)->where('date', date('d-m-Y', strtotime($date)))->where('tr_nature', 'TRGAME001')->get();
    foreach ($gdata as $vs) {

      $user = User::where('user_id', $vs->user_id)->first();
      $user_reffer_by = User::where('ref_code', $user->ref_by)->first();
      // echo $user->ref_code;
      if ($user_reffer_by) {
        $dateuserCom = date('Y-m-d');
        $com_usr = ManageCommission::where('user_id', $vs->user_id)->where('market_id', $vs->table_id)->where('date', $dateuserCom)->first();
        if ($com_usr) {
          if ($com_usr->bat_amount < 0) {
            ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->delete();
          }
          $bataamt = $com_usr->bat_amount - $vs->tr_value;
          $winaamt = $com_usr->win_amount;
          ManageCommission::where('_id', $this->bsonIdForQuery($com_usr->_id))->update(['win_amount' => $winaamt, 'bat_amount' => $bataamt]);

        } else {
          // $datastore = [
          //   'user_id' => $vs->user_id,
          //   'reciver_user_id' => $user_reffer_by->user_id,
          //   'market_id' => $vs->table_id,
          //   'bat_amount' => $vs->tr_value,
          //   'win_amount' => 0,
          //   'status' => 'pending',
          //   'date' => date('Y-m-d'),
          //   'visible' => 1,
          //   ];
          //   DB::table('manage_commissions')->insert($datastore);
        }
      }
      Point::where('uniquid', $vs->uniquid)->delete();
      GameLoad::where('_id', $this->bsonIdForQuery($vs->_id))->update(['is_win' => 0, 'is_result_declared' => 0]);
      //  $this->lavalDistributeUnPaid($vs->user_id,$vs->id);
    }
  }

  public function lavalDistributePaid($userId, $id)
  {
    // commission
    $poointt = Point::where('_id', $this->bsonIdForQuery($id))->first();
    $comisionh = (5 * $poointt->tr_value) / 100;
    $ussser = User::where('user_id', $poointt->user_id)->first();
    if ($ussser) {
      if ($ussser->ref_by) {
        $refferbyyy = User::where('ref_code', $ussser->ref_by)->first();
        if ($refferbyyy) {
          // $upodater = $refferbyyy->credit + $comisionh;
          //   User::where('user_id',$refferbyyy->user_id)->update(['credit'=>$upodater]);
          $refferbyyy11 = User::where('ref_code', $ussser->ref_by)->first();

          $ponitypupdate = [
            'user_id' => $refferbyyy->id,
            'batId' => $this->bsonIdForQuery($poointt->_id),
            'amount' => $comisionh,
            'date' => date('Y-m-d'),
            'status' => 'pending',
          ];
          $ponitypupdate = new UserCommission($ponitypupdate);
          $ponitypupdate->save();

        }
      }
    }
  }
  public function lavalDistributeUnPaid($userId, $id)
  {
    // commission
    // dd($id);
    $ussser = UserCommission::where('batId', $this->bsonIdForQuery($id))->where('status', 'pending')->delete();

  }
}


