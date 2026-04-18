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
use App\Models\PaymentGetway;
use App\Models\PaymentInstruction;
use Session;
use Hash;
use DB;
use Str;
use URL;
use str_slug;
use App\Helpers\Helper;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use MongoDB\BSON\Regex;
use MongoDB\BSON\ObjectId;
class PaymentGetwayController extends Controller
{
    public function __construct()
    {
    }

    private function paymentGatewayRouteFilters($id): array
    {
        if ($id === null || $id === '') {
            return [];
        }

        $id = trim((string) $id);
        if ($id === '') {
            return [];
        }

        $filters = [
            ['_id' => $id],
        ];

        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $filters[] = ['_id' => new ObjectId($id)];
            } catch (\Throwable $e) {
                // invalid ObjectId
            }
        }

        return $filters;
    }

    private function paymentGatewayExists($id): bool
    {
        $filters = $this->paymentGatewayRouteFilters($id);
        if (empty($filters)) {
            return false;
        }

        foreach ($filters as $filter) {
            if (PaymentGetway::raw(function ($collection) use ($filter) {
                return $collection->findOne($filter);
            })) {
                return true;
            }
        }

        return false;
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        // dd("kkk");
        return view('administrator.paymentGetway.index');
    }
    public function Add_PaymentGetway()
    {
        return view('administrator.paymentGetway.addpaymentgetway');
    }

    public function StorePaymentGetwayData(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add_gamemarket')->withErrors($validator)->withInput();
        }

        $insert = new PaymentGetway;
        $insert->name = $request->name;
        $slugInput = $request->input('slug');
        $insert->slug = $slugInput !== null && $slugInput !== ''
            ? Str::slug((string) $slugInput, '-')
            : Str::slug($request->input('name'), '-');
        $insert->status = 1;

        $insert->save();

        return redirect()->route('index_page')->with('success_message', 'One New Banner has been created successfully.');
    }

    public function view_game(Request $request)
    {
        $select = Market::where('market_id', $request->market_id);
        return view('administrator.game_management.view');
    }

    

    public function Get_paymentGetway_Data(Request $request)
    {
        $columns = [
            0 => '_id',
            1 => 'name',
            2 => 'slug',
            3 => 'status',
        ];
    
        $requestData = $_REQUEST;
        $query = PaymentGetway::query(); // Initialize query builder

        // Hide "online" gateway from admin list UI (do not delete from DB).
        // We exclude by both slug and name to be safe with existing data.
        $query->where('slug', '!=', 'online')
              ->where('name', '!=', 'online');
        
        // Apply search filter
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'regex', new Regex($searchValue, 'i'))
                  ->orWhere('slug', 'regex', new Regex($searchValue, 'i'));
            });
        }
    
        // Apply sorting
        $orderColumnIndex = $requestData['order'][0]['column'] ?? 0;
        $orderColumn = $columns[$orderColumnIndex] ?? '_id';
        $orderColumnDir = $requestData['order'][0]['dir'] ?? 'desc';
    
        $query->orderBy($orderColumn, $orderColumnDir);
    
        // Apply pagination
        $limit = $requestData['length'] ?? 10;
        $offset = $requestData['start'] ?? 0;
       
        $total = $query->count(); // Get total count
        $Market = $query->skip($offset)->take((int)$limit)->get(); // Apply pagination
    
        // Process data for DataTables
        $datas = [];
        $i = $offset;
        foreach ($Market as $item) {
            $i++;
            $nestedData = [];
            $nestedData[] = $i;
            $nestedData[] = $item->name;
    
            // Status toggle links
            if ($item->status) {
                
                $message = "'Are you sure you want to Inactive the Payment Getway ?'";

                if ($item->name == 'menual') {
                    $nestedData[] = '<a href="' . url('/administrator/payment-getway/update-status/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>' . " | " . '<a href="' . url('/administrator/payment-instruction/list') . '" title="view">view</a>';
                } else {
                    $nestedData[] = '<a href="' . url('/administrator/payment-getway/update-status/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
                }
                
                if($item->name == 'payment by scanner')
                {
                    $nestedData[] =  '<a href="' . url('/administrator/payment-getway/update-status/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>' ." | ". '<a href="' . url('/administrator/scanner-payment') . '" title="Active">view</a>';
                }elseif($item->name == 'menual') {
                    $nestedData[] = '<a href="' . url('/administrator/payment-getway/update-status/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>' . " | " . '<a href="' . url('/administrator/payment-instruction/list') . '" title="Active">view</a>';
                } 
                else{
                    $nestedData[] = '<a href="' . url('/administrator/payment-getway/update-status/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
                }
            } else {
                $message = "'Are you sure you want to Active the Payment Getway ?'";
                if($item->name == 'payment by scanner')
                {
                    $nestedData[] =  '<a href="' . url('/administrator/payment-getway/update-status/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>' ." | ". '<a href="' . url('/administrator/scanner-payment') . '" title="Active">view</a>';
                }else{
                    $nestedData[] = '<a href="' . url('/administrator/payment-getway/update-status/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
                }
            }
            $nestedData[] = $item->market_status;
    
            $datas[] = $nestedData;
        }
    
        return [
            'data' => $datas,
            'total' => intval($total),
            'recordsTotal' => intval($total),
            'recordsFiltered' => intval($total),
            'draw' => $request->input('draw'),
        ];
    }
    

    public function edit_game(Request $request)
    {
        $select = Market::where('_id', $request->id)->first();
        // dd($select);
        return view('administrator.game_management.edit_game', compact('select'));
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
        if ($select = Market::find($id)) {
            $select->delete();
            Session::flash('success_message', 'One Market has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect()->back();
    }
    public function update_status($id)
    {
        $filters = $this->paymentGatewayRouteFilters($id);

        if (!empty($filters) && $this->paymentGatewayExists($id)) {
            PaymentGetway::raw(function ($collection) use ($filters) {
                $collection->updateMany([], ['$set' => ['status' => 0]]);

                foreach ($filters as $filter) {
                    $result = $collection->updateOne($filter, ['$set' => ['status' => 1]]);
                    if (method_exists($result, 'getMatchedCount') && $result->getMatchedCount() > 0) {
                        return $result;
                    }
                }

                return null;
            });

            Session::flash('success_message', 'Payment gateway status updated successfully.');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }
        return redirect()->route('index_page');
    }

    public function PaymentInstruction()
    {
        return view('administrator.payment_instruction.index');
    }

    public function Get_PaymentInstructionData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = PaymentInstruction::count();
        $Market = PaymentInstruction::whereNotNull('_id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('title', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('id', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->title;
            // $nestedData[] = '<img src="' . URL::to('/backend/uploads/payment_instruction/') . '/' . $item->file . '" height="100" width="150">';
            if($item->file)
            {
                $nestedData[] = "'<video width='320' height='240' controls>
                <source src='" . URL::to('backend/uploads/payment_instruction/' . $item->file) . "' type='video/mp4'>
              </video>'";
            }else{
                $nestedData[] = $item->description;
            }
            

            if ($item->status) {
                $message = "'Are you sure you want to Inactive the payment instruction Status?'";
                $nestedData[] = '<a href="' . url('/administrator/update-payment-instruction-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the payment instruction Status?'";
                $nestedData[] = '<a href="' . url('/administrator/update-payment-instruction-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }

            $editLink = '<a href="' . url('/administrator/edit-payment-instruction/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete-qr-code/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/payment-instruction-details/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink;
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

    public function update_paymen_instruction_status($id)
    {
        $response = DB::statement("UPDATE payment_instruction SET status =(CASE WHEN (status = 1) THEN 0 ELSE 1 END) where id = $id");
        $data = DB::table('payment_instruction')->get();
        foreach ($data as $vs) {
            if ($vs->id != $id) {
                DB::table('payment_instruction')->where('id', $vs->id)->update(['status' => 0]);
            }
        }

        if ($response) {
            Session::flash('success_message', 'status has been updated successfully!');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }

        return redirect()->back();
    }

    public function viewPaymentInstructionDetails($id)
    {
        $select = PaymentInstruction::where('id', $id)->first();
        if (!$select && is_string($id) && preg_match('/^[a-f\d]{24}$/i', $id)) {
            // In MongoDB the identifier is typically stored as `_id`.
            try {
                $select = PaymentInstruction::where('_id', new ObjectId($id))->first();
            } catch (\Throwable $e) {
                // Ignore invalid ObjectId formats and let the normal not-found flow happen.
            }
        }
        if (!$select) {
            return redirect()->route('payment_instruction_list')->with('error_message', 'Payment instruction not found.');
        }
        return view('administrator.payment_instruction.viewDetails',compact('select'));
    }
    public function PaymentInstructionEdit($id)
    {
        $select = PaymentInstruction::where('id', $id)->first();
        if (!$select && is_string($id) && preg_match('/^[a-f\d]{24}$/i', $id)) {
            // In MongoDB the identifier is typically stored as `_id`.
            try {
                $select = PaymentInstruction::where('_id', new ObjectId($id))->first();
            } catch (\Throwable $e) {
                // Ignore invalid ObjectId formats and let the normal not-found flow happen.
            }
        }
        if (!$select) {
            return redirect()->route('payment_instruction_list')->with('error_message', 'Payment instruction not found.');
        }
        return view('administrator.payment_instruction.edit',compact('select'));
    }

    public function PaymentInstructionUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert['title'] = $request->title;
        $insert['description'] = $request->description;
        if($request->file){
            $path_original=public_path() . '/backend/uploads/payment_instruction';
            $file = $request->file;
            $photo_name = time().'-'.$file->getClientOriginalName();
            $file->move($path_original, $photo_name);
            $insert['file'] = $photo_name;
        }

        DB::table('payment_instruction')->where('id', $request->markets_id)->update($insert);
        return redirect()->route('payment_instruction_list')->with('success_message', 'Updated successfully.');
    }

}