<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\UserRole;
use App\Models\Admin;
use App\Models\BlockUser;
use App\Models\Super;
use Session;
use Hash;
use DB;
use Helper;

class SubAdminController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index()
    {

        return view('administrator.subadmin_module.index');
    }
    public function block_user_list()
    {
        return view('administrator.subadmin_module.block_user');
    }

    /*-------Get data for listing Page ---------*/
    public function getSubAdminData(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        DB::table('supers')->distinct()->get(['role_id']);
        $total = User::with('role_id', 'role_id')->count();
        $subAdmin = User::whereNotNull('id')->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->FullName;
            $nestedData[] = $item->mob;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            $nestedData[] = $item->credit;
            $nestedData[] = $item->role_id;

            // if($item->status){
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // }else{
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/sub-admin/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $withdraw = '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable_withdraw" onclick="get_id_withdraw(' . $item->id . ',' . $item->credit . ')">Withdraw</button>';
            $deposit = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" onclick="get_id(' . $item->id . ')">Deposit</button>';
            $nestedData[] = $ViewLink . " " . $withdraw . " " . $deposit;
            $datas[] = $nestedData;
        };

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }
    public function getblock_user_Data(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = BlockUser::with('user_data')->count();
        $subAdmin = BlockUser::with('user_data')->whereNotNull('id')->orderBy('created_at', 'desc');
        // dd($subAdmin);
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->user_data->FullName;
            $nestedData[] = $item->user_data->mob;
            $nestedData[] = $item->user_data->credit;

            $nestedData[] = $item->user_data->device_id;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));

            // if($item->status){
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // }else{
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' .url('/administrator/sub-admin/view/'.$item->id).' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $ViewLink;
            $datas[] = $nestedData;
        };

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function getactive_user_Data(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        // $total = BlockUser::with('user_data')->count();
        // $subAdmin = BlockUser::with('user_data')->whereNotNull('id')->orderBy('created_at', 'desc');
        $columns = array(
            0 => 'us_reg_tbl.id',
            1 => 'us_reg_tbl.FullName',
            2 => 'us_reg_tbl.mob'
        );
        $total = User::count();
        $subAdmin = User::whereNotNull('id')->orderBy('created_at', 'desc');
        // dd($subAdmin);
        // dd($subAdmin);
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orwhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $subAdmin = $subAdmin->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();

        //$subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);

        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->FullName;
            // $nestedData[] = $item->email;
            $nestedData[] = $item->us_pass;
            $nestedData[] = $item->mob;
            $nestedData[] = $item->credit;
            $nestedData[] = $item->ref_code;
            $nestedData[] = $item->ref_by;
            if ($item->FullName != "") {
                $deleteLink = "";
            } else {
                $deleteLink = '<a href="' . url('/administrator/user/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            }
            // $nestedData[] = $item->device_id;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));

            $deposit = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" onclick="get_id(' . $item->id . ')">Deposit</button>';

            $withdraw = '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable_withdraw" onclick="get_id_withdraw(' . $item->id . ',' . $item->credit . ')">Withdraw</button>';

            if ($item->user_status) {
                $message = "'Are you sure you want to Inactive the user?'";
                $nestedData[] = '<a href="' . url('/administrator/user/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>' . " " . $deposit . " " . $withdraw . " " . $deleteLink;
            } else {

                $message = "'Are you sure you want to Active the user?'";
                $nestedData[] = '<a href="' . url('/administrator/user/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>' . " " . $deposit;
            }

            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $ViewLink = '<a href="' .url('/administrator/sub-admin/view/'.$item->id).' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $ViewLink;
            $datas[] = $nestedData;
        };

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function withdraw_store(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user_amt = $user->credit;
        $recive_amt = $request->amount;
        $total = $user_amt - $recive_amt;
        $up = User::where('id', $request->user_id)->update(['credit' => $total]);
        Session::flash('success_message', 'Withdraw successful!');
        return redirect()->back();
    }
    public function deposit_store(Request $request)
    {

        $user = User::where('id', $request->user_id)->first();
        $user_amt = $user->credit;
        $recive_amt = $request->amount;
        $total = $user_amt + $recive_amt;
        $up = User::where('id', $request->user_id)->update(['credit' => $total]);

        $data = array();
        $data['app_id'] = "com.dubaiking";
        $data['admin_key'] = "ADMIN0001";
        $data['win_value'] = 0;
        $data['user_id'] = $user->user_id;
        $data['transaction_id'] = rand(111, 999) . rand(222, 888);
        $data['tr_nature'] = 'TRDEPO002';
        $data['tr_value'] = $recive_amt;
        $data['win_bet_amt_not_use'] = 0;

        $data['value_update_by'] = 'Deposit';
        $data['tr_value_type'] = "Credit";
        $data['tr_value_updated'] = $total;
        $data['date'] = date('d-m-Y');
        $data['tr_status'] = "Success";
        $data['date_time'] = date('Y-m-d H:i:s');
        Db::table('point_table')->insert($data);

        Session::flash('success_message', 'Deposit successful!');
        return redirect()->back();
    }
    /*-------Show create Page ---------*/
    public function create(Request $request)
    {
        return view('administrator.subadmin_module.create');
    }

    /*-------store data of create Page ---------*/
    public function store(Request $request)
    {
        //     dd($request->all());
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|unique:subadminattributes',
            'password' => 'min:6|max:100',
            'password_confirmation' => 'min:6|same:password',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->only('first_name', 'last_name', 'email', 'status');
        $data['username'] = $request->first_name . " " . $request->last_name;
        $data['simple_pass'] = $request->password;
        $data['password'] = Hash::make($request->password);
        $permission = $request->input('permission');
        $data['access_permission'] = implode(',', $permission);
        SubAdminAttribute::create($data);
        return redirect()->route('admin_sub_admin')->with('success_message', 'One Sub-Admin has been created successfully.');
    }

    /*-------Show change password Page ---------*/
    public function change_password($id)
    {
        $select = SubAdminAttribute::findorfail($id);
        return view('administrator.subadmin_module.password_change', compact("select"));
    }

    /*-------Store data of change password Page ---------*/
    public function store_change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'min:6|max:100',
            'password_confirmation' => 'min:6|same:password',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $select = SubAdminAttribute::find($request->id);
        if ($select->simple_pass == $request->old_password) {
            SubAdminAttribute::where('id', $request->id)->update(['simple_pass' => $request->password, 'password' => Hash::make($request->password)]);
            return redirect()->route('admin_sub_admin')->with('success_message', 'Password has been updated successfully');
        } else {
            return redirect()->back()->with('error_message', 'Old Password is wrong. Please enter correct old password');
        }
    }
    /*-------Soft delete data---------*/
    function delete($id)
    {
        if ($select = SubAdminAttribute::find($id)) {
            $select->update(['is_deleted' => '0']);
            Session::flash('success_message', 'One  Sub Admin has been deleted successfully!');
        } else {
            Session::flash('success_message', 'Please Try Again!');
        }
        return redirect()->back();
    }

    /*-------Show user data---------*/
    function view($id)
    {

        $select = User::where('id', $id)->first();
        $coin = UserCoin::where('user_id', $select->user_id)->get();
        // dd($id);
        return view('administrator.subadmin_module.view', compact('select', 'coin'));
    }

    /*-------Show edit Page ---------*/
    function edit($id)
    {
        $select = SubAdminAttribute::findorfail($id);
        return view('administrator.subadmin_module.edit', compact('select'));
    }

    /*-------update data of edit Page ---------*/
    public function edit_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->only('first_name', 'last_name', 'status');
        $data['username'] = $request->first_name . " " . $request->last_name;
        $permission = $request->input('permission');
        $data['access_permission'] = implode(',', $permission);
        SubAdminAttribute::where('id', $request->id)->update(['access_permission' => implode(",", $permission)]);
        return redirect()->route('admin_sub_admin')->with('success_message', 'One Sub-Admin has been created successfully.');
    }
    public function update_status($id)
    {
        $response = DB::statement("UPDATE us_reg_tbl SET user_status =(CASE WHEN (user_status = 1) THEN 0 ELSE 1 END) where id = $id");
        if ($response) {
            Session::flash('success_message', 'status has been updated successfully!');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }

        return redirect()->back();
    }

    public function delete_data($id)
    {
        DB::table('us_reg_tbl')->where('id', $id)->delete();
        Session::flash('success_message', 'user has been deleted successfully!');
        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $response = DB::statement("UPDATE subadminattributes SET status =(CASE WHEN (status = 1) THEN 0 ELSE 1 END) where id = $id");
        if ($response) {
            Session::flash('success_message', 'status has been updated successfully!');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }

        return redirect()->back();
    }

    public function today_user_list()
    {

        return view('administrator.subadmin_module.today_user');
    }

    public function getTodayuserData(Request $request)
    {
        $columns = array(
            0 => 'us_reg_tbl.id',
            1 => 'us_reg_tbl.FullName',
            2 => 'us_reg_tbl.mob'
        );
        $requestData = $_REQUEST;
        // $total = BlockUser::with('user_data')->count();
        // $subAdmin = BlockUser::with('user_data')->whereNotNull('id')->orderBy('created_at', 'desc');

        $total = User::whereRaw('Date(created_at) = CURDATE()')->count();
        $subAdmin = User::whereNotNull('id')->whereRaw('Date(created_at) = CURDATE()')->orderBy('created_at', 'desc');
        // dd($subAdmin);
        // dd($subAdmin);
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $subAdmin = $subAdmin->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();


        //$subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->FullName;
            // $nestedData[] = $item->email;
            $nestedData[] = $item->us_pass;
            $nestedData[] = $item->mob;
            $nestedData[] = $item->credit;

            // $nestedData[] = $item->device_id;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));

            // if($item->user_status){
            // $message = "'Are you sure you want to Inactive the user?'";
            // $nestedData[] = '<a href="' .url('/administrator/user/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            //   }else{
            // $message = "'Are you sure you want to Active the user?'";
            //  $nestedData[] = '<a href="' .url('/administrator/user/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            //  }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' .url('/administrator/sub-admin/view/'.$item->id).' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $ViewLink;
            $datas[] = $nestedData;
        };

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }
}
