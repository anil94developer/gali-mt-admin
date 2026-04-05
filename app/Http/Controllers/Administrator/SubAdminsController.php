<?php
namespace App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\UserRole;
use App\Models\Admin;
use App\Models\Super;
use Session;
use Hash;
use DB;
use Helper;

class SubAdminsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth.administrator:administrator');
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.subadmin.index');
    }

    public function create()
    {
        return view('administrator.subadmin.create');
    }


    /*-------Get data for listing Page ---------*/
    public function getsubadminsData(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Super::count();
        $Super = Super::whereNotNull('userid')->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $Super = $Super->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Super = $Super->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Super = $Super->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Super as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->userid;
            $nestedData[] = $item->email;
            $nestedData[] = $item->mobile;
            $nestedData[] = $item->password;
            // $nestedData[] = $item->role_id;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            // $nestedData[] = $item->credit;

            // if($item->status){
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // }else{
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            $editLink = '<a href="' . url('/administrator/subadmin/edit/' . $item->ad_id) . '" title="Edit"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/subadmin/delete/' . $item->ad_id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/subadmin/view/' . $item->ad_id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            //$withdraw = '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable_withdraw" onclick="get_id_withdraw('.$item->id.','.$item->credit.')">Withdraw</button>';
//$deposit = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" onclick="get_id('.$item->id.')">Deposit</button>';
            $nestedData[] = $ViewLink . " " . $editLink . " " . $deleteLink;
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


    public function store(Request $request)
    {
        // dd($request->all());
        $subadminData = array(
            'userid' => $request->input('userid'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
        );
        $rules = array(
            'userid' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        );
        //    dd($request->all());
        $validator = Validator::make($subadminData, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {


            $lastData = Admin::orderBy('_id','desc')->first();
            $data = array(
                'userid' => $request->input('userid'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'role' => 2,
                'active' => 1,
                'password' => Hash::make($request->input('password')),
                'password' => $request->input('password'),
                'role_id' => implode(",", $request->input('permission')),
            );

            $adminData = array(
                'ad_email' => $request->input('email'),
                'ad_name' => $request->input('userid'),
                'role_id' => "2",
                'password' => Hash::make($request->input('password')),
                'id' => $lastData->id+1,
            );
            // dd($lastData);
            $user = new Admin($adminData);
            $user->save();

            $data['ad_id'] = $lastData->id+1;

            Super::create($data);

            Session::flash('success_message', 'Your Account has been added successfully');
            return redirect('administrator/subadmin-list');
        }
    }

    public function view($ad_id)
    {


        $users = Super::where('ad_id', (int)$ad_id)->first();
        ;
        return view('administrator.subadmin.view', compact('users'));
    }


    public function delete($ad_id)
    {
        //   dd('dasds');
        $select = Super::where('ad_id', (int)$ad_id)->first();
        if ($select) {

            Super::where('ad_id', (int)$ad_id)->delete();
            Session::flash('success_message', 'One Market has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect('administrator/subadmin-list');
    }


    public function edit($ad_id)
    {
        
        $select = Super::where('ad_id', (int)$ad_id)->first();
       
        // return view('admin.sub_admin.edit')->with(['select'=> $select]);
        return view('administrator.subadmin.edit', compact('select'));
    }

    public function edit_store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [

                'mobile' => 'required',
                'userid' => 'required|max:50'
            ],
            [
                'userid.required' => 'This field is required.',
                'userid.max' => 'Name can not be longer than 50 characters',

            ]
        );
        // dd($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {

            $data = array(
                'userid' => $request->input('userid'),
                'mobile' => $request->input('mobile'),
                'role_id' => implode(",", $request->input('permission')),
            );

            Super::where('ad_id', (int)$request->ad_id)->update($data);
            // dd($request->ad_id);
            // $data=Input::all();
            // dd($data);
            // //save official_announcement data
            // $user->fill($data)->save();

            // redirect
            Session::flash('success_message', 'Successfully updated sub-admin!');
            return redirect()->back();
        }
    }


}
