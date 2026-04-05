<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Contactus;
use App\Models\User;
use App\Models\Gallery;
use App\Models\AppControl;
use App\Models\GeneralSetting;
use DB;
use Response;
use URL;
// use response;
class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
       	$select = DB::table('app_controller')->first();
        return view('front.index.index',compact('select'));
    }

    public function chatstore(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $userid = $request->user_id;
        if ($request->type == 'text') {
            $message = $request->message;
            $type = $request->type;
            $sender = 'user';

            $chatMaster = DB::table('chat_masters')->where('user_id', $userid)->first();
            $user = User::where('id', $userid)->first();
            if ($chatMaster) {
                $st = [
                    'user_id' => $userid,
                    'name' => $user->FullName,
                    'mobile' => $user->mob,
                    'remark' => $message,
                    'type' => 'text',
                    'admin_seen' => 'no',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('chat_masters')->where('id', $chatMaster->id)->update($st);
            } else {
                $st = [
                    'user_id' => $userid,
                    'name' => $user->FullName,
                    'mobile' => $user->mob,
                    'admin_seen' => 'no',
                    'user_seen' => 'yes',
                    'remark' => $message,
                    'type' => 'text',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('chat_masters')->insert($st);
            }

            $data =
                [
                    'message' => $message,
                    'user_id' => $userid,
                    'type' => $type,
                    'sender' => $sender,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            DB::table('chats')->insert($data);
            return Response::json(array(
                'status_code' => 1,
                'message' => 'Successfully.',
                'error_message' => "Successfully.",
            ), 200);
        }
        if ($request->type == 'image') {
            $image = $request->file('message');
            $path_original = public_path() . '/backend/uploads/chatimage';
            $file = $request->message;

            $photo_name = time() . '-' . $file->getClientOriginalName();
            $file->move($path_original, $photo_name);
            $message = $photo_name;


            $type = $request->type;
            $sender = 'user';

            $chatMaster = DB::table('chat_masters')->where('user_id', $userid)->first();
            $user = User::where('id', $userid)->first();
            if ($chatMaster) {
                $st = [
                    'user_id' => $userid,
                    'name' => $user->FullName,
                    'mobile' => $user->mob,
                    'remark' => $message,
                    'type' => 'image',
                    'admin_seen' => 'no',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('chat_masters')->where('id', $chatMaster->id)->update($st);
            } else {
                $st = [
                    'user_id' => $userid,
                    'name' => $user->FullName,
                    'mobile' => $user->mob,
                    'admin_seen' => 'no',
                    'user_seen' => 'yes',
                    'remark' => $message,
                    'type' => 'image',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('chat_masters')->insert($st);
            }


            $data =
                [
                    'message' => $message,
                    'user_id' => $userid,
                    'type' => $type,
                    'sender' => $sender,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            DB::table('chats')->insert($data);
            return Response::json(array(
                'status_code' => 1,
                'message' => 'Successfully.',
                'error_message' => "Successfully.",
            ), 200);
        }

    }
    public function chatstoreAudio(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $userid = $request->user_id;
        if ($request->type == 'audio') {

            $originalName = $request->file('file')->getClientOriginalName();

            // Generate a new filename by combining the current timestamp and the original name
            $newFilename = date('dmYHis') . str_replace(' ', '', $originalName) . '.mp3';

            // Define the path where the file will be stored
            $path_original = public_path('/backend/uploads/chatimage');

            // Move the uploaded file to the specified path with the new filename
            $request->file('file')->move($path_original, $newFilename);
            $message = $newFilename;


            $type = $request->type;
            $sender = 'user';

            $chatMaster = DB::table('chat_masters')->where('user_id', $userid)->first();
            $user = User::where('id', $userid)->first();
            if ($chatMaster) {
                $st = [
                    'user_id' => $userid,
                    'name' => $user->FullName,
                    'mobile' => $user->mob,
                    'remark' => $message,
                    'type' => 'audio',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('chat_masters')->where('id', $chatMaster->id)->update($st);
            } else {
                $st = [
                    'user_id' => $userid,
                    'name' => $user->FullName,
                    'mobile' => $user->mob,
                    'admin_seen' => 'no',
                    'user_seen' => 'yes',
                    'remark' => $message,
                    'type' => 'audio',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('chat_masters')->insert($st);
            }


            $data =
                [
                    'message' => $message,
                    'user_id' => $userid,
                    'type' => $type,
                    'sender' => $sender,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            DB::table('chats')->insert($data);
            return Response::json(array(
                'status_code' => 1,
                'message' => 'Successfully.',
                'error_message' => "Successfully.",
                'data' => $newFilename,
            ), 200);
        }
    }
    public function chatlist(Request $request)
    {
        $userid = $request->user_id;
        $data = DB::table('chats')->where('user_id', $userid)->get();
        $url = URL::to('/backend/uploads/chatimage');
        return Response::json(array(
            'status_code' => 1,
            'message' => 'Successfully.',
            'error_message' => "Successfully.",
            'data' => $data,
            'url' => $url,
        ), 200);
    }

    
     public function income_percent()
    {
        $monthly_profit= 100;
        $user_id=3;
        $year=2021;
        $month= 12;
        $chk= DB::table('cron_table')->where('month',"!=",$month)->where('year',"!=",$year)->get()->count();
        if($chk!=0)
        {
        $com= DB::table('admin_config')->first();
        $data=DB::table('referal_income_report')->where('user_id',$user_id)->whereYear('date', '!=', $year)->whereMonth('date', '!=', $month)->get();
        if(count((array)$data)>0)
        {
           foreach($data as $ks=>$vs)
           {
              $array=array();
              $array['user_id']=1;
              $array['amount']=$monthly_profit*$com->commission/100;
              $array['date']=date('Y-m-d');
              DB::table('referal_income_report')->insert($array);
           }
        }
        
        }
    }
    



    public function store_data(Request $request)
    {
        //  dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message'=> 'required',
        ]);
        // dd($request->all());
        if ($validator->passes()) {
            // dd($request->all());

            $obj = new Contactus($request->all());
         
            $obj->save();

            return Response::json(['message' => 'Added new records','status'=>1]);

            // return response()->Json(['massage' => 'Added new records.','status'=>1]);
        }
      
        return response()->Json(['error' => $validator->errors()->all()]);
        // return response()->json(['new_body' => $greq->html, '#c_message' => $message],1);
    }

    public function help()
    {
        $data = AppControl::select(
            'whatsapp',
            'call_enable',
            'admin_contact_mob',
            'move_msg',
            'video_link_website',
            'video_link_withdraw',
            'video_link_game',
            'fb_link'
        )->first();

        return view('support', compact('data'));
    }
}
