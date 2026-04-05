<?php
namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Models\Admin;
use Auth;
use Session;
use Hash;

class LoginController extends Controller
{

    public function __construct()
    {

    }


    public function index()
    {
        return view('administrator.login.index');
        // if(Auth::guard('administrator')->user())
        // {
        // 	return redirect('admin/dashboard');
        // }
        // else
        // {

        // }
    }

    // public function authenticate(Request $request)
    // {



    // 	if (Auth::guard('administrator')->attempt(['ad_name' => $request->username, 'password' => $request->password]))
    // 	{
    //         // dd('opopop');
    // 		 $data=Admin::where('ad_name',$request->username)->first();
    // 	     Session::put('user_adata',  $data);
    // 		 return redirect('administrator/dashboard');
    // 	}else{
    // 		$request->flash();
    // 		Session::flash('message', 'Invalid username or password');
    // 		return redirect('administrator');
    // 	}
    // }

    public function authenticate(Request $request)
    {
        
        // dd(Auth::guard('administrator')->attempt(array('ad_name' => $request->username, 'password' => $request->ad_pass)));
        // echo $request->ad_pass; exit();



        // if (Auth::guard('administrator')->attempt(array('ad_name' => $request->username, 'password' => $request->ad_pass, 'otp' => $request->otp))) {
        if (Auth::guard('administrator')->attempt(array('ad_name' => $request->username, 'password' => $request->ad_pass))) {

            $data = Admin::where('ad_name', $request->username)->first();
            Session::put('user_adata', $data);
            return redirect('administrator/dashboard');
        } else {

            $request->flash();
            Session::flash('message', 'Invalid Email or Password');
            return redirect('administrator');
        }
    }

    public function logout()
    {
        Auth::guard('administrator')->logout();
        return redirect('/administrator');
    }

    public function forget_pass()
    {
        return view('administrator.login.forget_pass');
    }

    public function forget_pass_send_link(Request $request)
    {
        $user = Admin::where('email', $request->email)->first();
        if (!empty($user)) {
            $id = $user->id;
            $link = url('administrator/forget-change-password/' . encrypt($id));
            $emailData = array(
                'to' => $request->email,
                'from' => 'a2technosoftdev@gmail.com',
                'subject' => 'Admin Reset Password',
                'view' => 'administrator.login.forgot_email',
                'content' => "Please click on below URL or paste into your browser to reset your Password \n\n " . $link . "\n" . "\n\nThanks\nAdmin Team"
            );
            Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
                $message->to($emailData['to'])
                    ->from($emailData['from'])
                    ->subject($emailData['subject']);
            });
            Session::flash('success_message', 'An email with the reset password link has been sent to you. Please check your inbox or spam folder');
            return redirect()->back();
        } else {
            Session::flash('error_message', 'This email id is not registered');
            return redirect()->back();
        }
    }

    function forget_pass_token($token)
    {
        $id = decrypt($token);
        $user = Admin::find($id);
        if (!empty($user)) {
            Session::put('reset-password', $user->id);
            return view('administrator.login.forget_pass_reset');
        } else {
            Session::flash('error_message', 'Your link is not verify. Please correct your link..!!');
            return redirect()->route('admin_link_forget_pass');
        }
    }

    function update_forget_pass(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $validator = Validator::make($request->all(), [
            'new_password' => 'min:6|required',
            'comfirm_new_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = Session::get('reset-password');
        $user = Admin::find($id);
        $user->password = Hash::make($data['new_password']);
        $user->save();
        Session::put('reset-password', '');
        Session::flash('success_message', "Password successfully reset");
        return redirect()->route('admin_index_page');

    }
    public function LoginOTP()
    {
        $user = Admin::first();
        $mobile_no = $user->mobile;
        $otp = rand('1111', '9999');
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=dOh4l8D1jUX03Bz6TQsuCa9m2gFwrvGVn5SHMWeiqkocyZxPfEH5PKWtcpRVBn9Qo1d4X8lGvx6kqU7g&variables_values=" . $otp . "&route=otp&numbers=" . urlencode($mobile_no),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache"
                ),
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $message11 = 'OTP Send Successfully';

        $otpdata = Admin::where('id','1')->update(['otp' => $otp]);
        return response()->json($message11);
    }

}