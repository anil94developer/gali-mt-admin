<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\Point;
use App\Models\Admin;
use App\Models\Market;
use App\Models\GameRate;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;

class GameManageController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function game_name_list()
    {
        return view('administrator.game_management.game_name_list');
    }
    public function game_rate_list()
    {
        $gamerate = GameRate::find(1);
        return view('administrator.game_management.game_rate_list',compact('gamerate'));
    }

    public function add_game()
    {
        return view('administrator.game_management.add_game');
    }

    public function store_game(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            'market_sunday_time_open' => 'required',
            'is_holiday' => 'required',
            'market_sunday_off' => 'required',
            'is_time_limit_applied' => 'required',
            'is_no_limit_game' => 'required',
            'market_saturday_off' => 'required',
            'is_time_limit_applied' => 'required',
            'is_no_limit_game' => 'required',
            'market_saturday_off' => 'required',
            'close_by_admin' => 'required',
            'is_no_limit_game' => 'required',
            'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('add_gamemarket')->withErrors($validator)->withInput();
            }

            $insert = new Market;
            $insert->market_name = $request->market_name;
            // $insert->slug = str_slug($request->title, "-");
            $insert->market_view_time_open = $request->market_view_time_open;
            $insert->market_view_time_close = $request->market_view_time_close;
            $insert->market_sunday_time_open = $request->market_sunday_time_open;
            $insert->is_holiday = $request->is_holiday;
            $insert->market_sunday_off = $request->market_sunday_off;
            $insert->is_time_limit_applied = $request->is_time_limit_applied;
            $insert->is_no_limit_game = $request->is_no_limit_game;
            $insert->market_saturday_off = $request->market_saturday_off;
            $insert->close_by_admin = $request->close_by_admin;
            $insert->is_no_limit_game = $request->is_no_limit_game;
            $insert->status = $request->status;

            $insert->save();

            return redirect()->route('gamemarket_name_list')->with('success_message', 'One New Banner has been created successfully.');
    }

    public function view_game(Request $request)
    {
        $select = Market::where('market_id',$request->market_id);
        return view('administrator.game_management.view');
    }

    public function getGamenameData(Request $request)
    {

        // dd('demo');
        $columns = array(
            0 => 'comx_appmarkets.id',
            1 => 'comx_appmarkets.market_view_time_open',
            2 => 'comx_appmarkets.market_view_time_close',
            3 => 'comx_appmarkets.market_sunday_time_open',
            4 => 'comx_appmarkets.date',
            5 => 'comx_appmarkets.app_id',
        );
        $requestData = $_REQUEST;
        $total = Market::count();
        $Market = Market::whereNotNull('id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		// $i = 0;
		$i = $offset;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->market_name;
            $nestedData[] = date('h:i:s', strtotime($item->market_view_time_open));
            $nestedData[] = date('h:i:s', strtotime($item->market_view_time_close));
            $nestedData[] = $item->status;
            $nestedData[] = $item->market_status;
            $result = '<a href="' . url('/administrator/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            // $editLink = '<a href="' . url('/administrator/game/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' . url('/administrator/game/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink ;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function edit_game(Request $request)
    {
        $select = Market::where('id', $request->id)->first();
        // dd($select);
        return view('administrator.game_management.edit_game',compact('select'));
    }

    public function edit_store_game(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            'market_sunday_time_open' => 'required',
            'is_holiday' => 'required',
            'market_sunday_off' => 'required',
            'is_time_limit_applied' => 'required',
            'is_no_limit_game' => 'required',
            'market_saturday_off' => 'required',
            'close_by_admin' => 'required',
            'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('edit_gamemarket')->withErrors($validator)->withInput();
            }

            // dd($request->all());
            $insert = new Market;
            $insert->market_name = $request->market_name;
            // $insert->slug = str_slug($request->title, "-");
            $insert->market_view_time_open = $request->market_view_time_open;
            $insert->market_view_time_close = $request->market_view_time_close;
            $insert->market_sunday_time_open = $request->market_sunday_time_open;
            $insert->is_holiday = $request->is_holiday;
            $insert->market_sunday_off = $request->market_sunday_off;
            $insert->is_time_limit_applied = $request->is_time_limit_applied;
            $insert->market_saturday_off = $request->market_saturday_off;
            $insert->close_by_admin = $request->close_by_admin;
            $insert->is_no_limit_game = $request->is_no_limit_game;
            $insert->status = $request->status;
            $insert->save();

            return redirect()->route('gamemarket_name_list')->with('success_message', 'One New Banner has been created successfully.');
    }

    public function delete_game(Request $id)
    {
        if ($select = Market::find($id)) 
        {
            $select->delete();
            Session::flash('success_message', 'One Market has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect()->back();
    }
       
}