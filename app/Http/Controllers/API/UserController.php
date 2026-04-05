<?php
namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Userkyc;
use Illuminate\Support\Str;
use App\Models\UserWallet;
use App\Models\Product;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\WithdrawWallet;
use Response;
use Auth;
use DB;
use URL;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    public function __construct()
    {
       // parent::__construct();
        // $this->middleware('auth');
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
            $user = User::where('user_id', $userid)->first();
            // dd($user);
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
            $user = User::where('user_id', $userid)->first();
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
            $user = User::where('user_id', $userid)->first();
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

    public function register(Request $request)
    {
        dd($request->all);
        $this->validate($request, [
            'username' => 'required',
            'mobile' => 'required|min:10|unique:users',
            'password' => 'required|min:6',
            'otp' => 'required',
        ]);
        if($request->sponsor_id){
            $select = User::where("sponsor_id", $request->sponsor_id)->first();
            if($select){
                $user = User::create([
                    'username' => $request->username,
                    'mobile' => $request->mobile,
                    'password' => bcrypt($request->password),
                    'simple_pass' => $request->password,
                    'otp' => $request->otp,
                    'sponsor_id' =>  strtoupper(substr(sha1(mt_rand()),17,6)),
                    'parent_id' => $request->sponsor_id,
                ]);

                $insert = new Userkyc();
               $insert->user_id = $user->id;
               $insert->save();
                $token = $user->createToken('LaravelAuthApp')->accessToken;
                 return response()->json(['status'=>1,'message' => "Registered Successfully"], 200);
            }else{
                return response()->json(['status'=>0,'message' => "Invalid Sponsor ID"], 200);
            }
        }else{
            $user = User::create([
                'username' => $request->username,
                'mobile' => $request->mobile,
                'password' => bcrypt($request->password),
                'simple_pass' => $request->password,
                'otp' => $request->otp,
                'sponsor_id' => strtoupper(substr(sha1(mt_rand()),17,6)),
            ]);
             $insert = new Userkyc();
               $insert->user_id = $user->id;
               $insert->save();
                $token = $user->createToken('LaravelAuthApp')->accessToken;
            return response()->json([ 'status'=>1,'message' => "Registered Successfully"], 200);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|min:10',
            'password' => 'required|min:6',
        ]);

        $data = [
            'mobile' => $request->mobile,
            'password' => $request->password
        ];
            $select = User::where("mobile", $request->mobile)->where('simple_pass', $request->password)->first();
            if($select){
                if($select->banned == "0"){
                    if (auth()->attempt($data)) {
                            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                            return response()->json(['token' => $token,'status'=>1,'message' => "Login Successfully", 'username'=>$select->username, 'mobile'=>$select->mobile, 'sponsor_id'=>$select->sponsor_id, 'parent_id'=>$select->parent_id, 'password'=>$select->simple_pass, 'otp'=>$select->otp], 200);
                        } else {
                            return response()->json(['error' => 'Unauthorised','status'=>0,'message' => "Something went wrong."], 401);
                        }
                }else{
                    return response()->json(['status'=>0,'message' => "This user is blocked"], 200);
                }
            }else{
                return response()->json(['status'=>0,'message' => "Invalid Mobile number or password"], 200);
            }
    }

    public function forget_password(Request $request){
         $this->validate($request, [
            'mobile' => 'required|min:10',
        ]);
        $select = User::where("mobile", $request->mobile)->first();
            if($select){
                if($select->banned == "0"){
                    $otp = rand(0000, 9999);
                    $token = User::where("mobile", $request->mobile)->update(['otp'=>$otp]);
                    return response()->json(['status'=>1,'message' => "OTP has been sent in your mobile.", 'mobile'=>$select->mobile, 'otp'=>$otp], 200);
                }else{
                    return response()->json(['status'=>0,'message' => "This user is blocked"], 200);
                }
            }else{
                return response()->json(['status'=>0,'message' => "Invalid Mobile number"], 200);
            }
     }

     public function get_wallet_data(Request $request){
        if(Auth::check()){
              $Withdrawn = UserWallet::select('amount','payment_status','payment_type', 'created_at')->where(['user_id'=> Auth::user()->id, 'payment_status'=>'success'])->get();
             return response()->json(['status'=>1,'message' => "User wallet data.", 'data'=>$Withdrawn], 200);
        }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }

     public function get_package_data(Request $request){
         if(Auth::check()){
              $product = Product::where('status', '1')->get();
             $path =url('/').'/backend/uploads/product';
              $m_array = [];
              foreach($product as $item){
                  $array = [];
                  $data = $this->get_product_status($item->id);
                  if($data){

                     $array['name'] = $item->name;
                     $array['amount'] = $item->amount;
                     $array['image'] = $item->image;
                     $array['commission_amt'] = $item->commission_amount;
                     $array['description'] = $item->description;
                     $array['purchase_status'] = 1;
                  }else{
                      $array['name'] = $item->name;
                     $array['amount'] = $item->amount;
                     $array['image'] = $item->image;
                     $array['commission_amt'] = $item->commission_amount;
                     $array['description'] = $item->description;
                     $array['purchase_status'] = 0;
                  }
                  $m_array[] = $array;
              }

             return response()->json(['status'=>1,'message' => "User package data.", 'data'=>$m_array, 'image_path'=>$path], 200);
        }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }

     public function get_product_status($id){
         $order = Order::select('product_id')->where('product_id', $id)->where('user_id', Auth::user()->id)->get()->count();
         return $order;
     }

     public function get_order_data(Request $request){
        if(Auth::check()){
              $order = Order::select('product_id', 'order_id')->where(['user_id'=> Auth::user()->id, 'payment_status'=>'success'])->get();
            //   dd($order);
              $path =url('/').'/backend/uploads/product';
              $m_array = [];
              foreach($order as $ks => $item){
                //   dd($item);
                    $select = Product::where('id', $item->product_id)->first();

                  $array = [];
                     $array['order_id'] = $item->order_id;
                     $array['name'] = $select->name;
                     $array['amount'] = $select->amount;
                     $array['image'] = $select->image;
                     $array['commission_amt'] = $select->commission_amount;
                     $array['description'] = $select->description;

                  $m_array[] = $array;
              }
             return response()->json(['status'=>1,'message' => "User Order data.", 'image_path'=>$path, 'data'=>$m_array], 200);
        }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }

     public function store_bank_info(Request $request){
          $this->validate($request, [
            'card_name' => 'required',
            'account_number' => 'required|min:9',
            'ifsc_code' => 'required|min:11',
        ]);


        if(Auth::check()){
                $array = [];
                $array['account_holder_name'] = $request->card_name;
                $array['account_number'] = $request->account_number;
                $array['ifsc_code'] = $request->ifsc_code;
                 $array['bank_name'] = $request->bank_name;

                Userkyc::where('user_id', Auth::user()->id)->update($array);


             return response()->json(['status'=>1,'message' => "Bank information has ben updated successfully.", 'data'=>$array], 200);
        }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }

     public function get_withdrawable_balance(){
        if(Auth::check()){
                 $deposit = UserWallet::where('user_id', Auth::user()->id)->where('payment_status', 'success')->where('payment_type', 'deposit')->sum('amount');
                  $withdrawn = UserWallet::where('user_id', Auth::user()->id)->where('payment_status', 'success')->where('payment_type', 'withdrawn')->sum('amount');
                $amount = $deposit - $withdrawn;
                //  dd($amount);
          return response()->json(['status'=>1,'message' => "user available amount.", 'amount'=>$amount], 200);
        }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }

     public function store_withdrawal_amount(Request $request){
         $this->validate($request, [
            'amount' => 'required',
        ]);

        if(Auth::check()){
                 $deposit = UserWallet::where('user_id', Auth::user()->id)->where('payment_status', 'success')->where('payment_type', 'deposit')->sum('amount');
                  $withdrawn = UserWallet::where('user_id', Auth::user()->id)->where('payment_status', 'success')->where('payment_type', 'withdrawn')->sum('amount');
                $amount = $deposit - $withdrawn;
                 if($amount > $request->amount){
                     $setting = GeneralSetting::first();
                     $mim_amt = $setting->minimum_amount;
                     if($request->amount > $mim_amt){
                         DB::table('withdraw_wallets')->insert(['user_id'=> Auth::user()->id, 'amount'=> $request->amount, 'wallet'=>'level', 'status'=>'pending']);
                         return response()->json(['status'=>1,'message' => "Request has been send successfully.", 'amount'=>$request->amount], 200);
                     }else{
                         $message = "Minimum amount should be ".$mim_amt;
                          return response()->json(['status'=>0,'message' => $message], 200);
                     }
                 }else{
                     return response()->json(['status'=>0,'message' => "Insufficient amount"], 200);
                 }
        }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }

     public function change_password(Request $request){
          $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if(Auth::check()){
          $select = User::where('id', Auth::user()->id)->where('simple_pass', $request->current_password)->first();
                 if($select){
                    $pass =[
                        'password' => bcrypt($request->new_password),
                        'simple_pass' => $request->new_password,
                        ];
                    User::where('id', Auth::user()->id)->where('simple_pass', $request->current_password)->update($pass);
                     return response()->json(['status'=>1,'message' => "Password has changed successfully."], 200);
                 }else{
                     return response()->json(['status'=>0,'message' => "Please enter correct current password"], 200);
                 }
        }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }

      public function logout(Request $request){
          if(Auth::check()){
                Auth::user()->update(['last_login' => date('d-m-y h:m:s')]);
                $user = Auth::user()->token();
                $user->revoke();
            return response()->json(['status'=>1,'message' => "Logout successfully."], 200);
          }else{
             return response()->json(['status'=>0,'message' => "Already logout"], 200);
        }
     }

      public function refferal_income(Request $request){
          if(Auth::check()){
                $select = User::where('id', Auth::user()->id)->first();
                $check = User::where('parent_id', $select->sponsor_id)->get();
                $id = [];
                foreach($check as $che){
                    $id[] = $che->id;
                }
                $user_wallet = WithdrawWallet::whereIn('user_id', $id)->where('wallet', 'refer')->sum('amount');
                // dd($user_wallet);

            return response()->json(['status'=>1,'message' => "Refferal income of user.", 'Total amount'=> $user_wallet], 200);
          }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
        }
     }


    public function news(Request $request){
            $select = UserWallet::with('user_data')->where('payment_type', "withdrawn")->take(10)->get();
          $array = [];
          foreach($select as $vs){
              $arr = [];
              $arr['name'] = $vs->user_data->username;
              $arr['mobile'] = $vs->user_data->mobile;
               $arr['date'] = date("d/m/Y",strtotime($vs->created_at));
                $arr['amount'] = $vs->amount;
                $array[] = $arr;
          }

        return response()->json(['status'=>1,'message' => "Top 10 news.", 'data'=> $array], 200);

     }

     public function personal_details(Request $request){
      if(Auth::check()){
        $select = User::where('id', Auth::user()->id)->first();
          $array = [];
            $array['name'] = $select->username;
            $array['mobile'] = $select->mobile;
            $array['sponsor_id'] = $select->sponsor_id;
            $array['parent_id'] = $select->parent_id;
            //   dd($array);
        return response()->json(['status'=>1,'message' => "User personal details.", 'data'=> $array], 200);
      }else{
         return response()->json(['status'=>0,'message' => "User is not login"], 200);
         }
     }

      public function store_create_package(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'stock' => 'required',
            'equipment_revenue' => 'required',
            'revenue_range' => 'required',
            'image' => 'required',
            ]);


             $insert = new Product;
            $insert->name = $request->name;
            $insert->slug = Str::slug($request->name, "-");
            $insert->stock = $request->stock;
            $insert->equipment_revenue = $request->equipment_revenue;
            $insert->revenue_range = $request->revenue_range;

            $images= $request->image;
            if($images){
                foreach($images as $img){
                    $path_original=public_path() . '/backend/uploads/product';
                    $file = $img;
                    $photo_name = time().'-'.$file->getClientOriginalName();
                    $file->move($path_original, $photo_name);
                    $insert->image = $photo_name;
                }
            }
            $insert->save();
            $package_id = $insert->id;

        return response()->json(['status'=>1,'message' => "Package as been created successfully.", 'package_id'=> $package_id, 'package_name'=>$request->name], 200);

     }

       public function store_create_revenue(Request $request){

        $this->validate($request, [
            'days' => 'required',
            'percent' => 'required',
            'image' => 'required',
            ]);


             $insert = new Revenue;
             $insert->percent = $request->percent;
            $insert->days = $request->days;

            $images= $request->image;
            if($images){
                foreach($images as $img){
                    $path_original=public_path() . '/backend/uploads/product';
                    $file = $img;
                    $photo_name = time().'-'.$file->getClientOriginalName();
                    $file->move($path_original, $photo_name);
                    $insert->image = $photo_name;
                }
            }
            $insert->save();
            $package_id = $insert->id;

        return response()->json(['status'=>1,'message' => "Revenue as been created successfully.", 'revenue_id'=> $package_id, 'days'=>$request->days, 'percent'=>$request->percent], 200);

     }


    public function store_orders(Request $request){
          if(Auth::check()){
              $this->validate($request,[
                  'product_id' => 'required',
                  ]);
                 $select = Product::where('id', $request->product_id)->first();
                 $qty = $select->stock - 1;
                 $update = Product::where('id', $request->product_id)->update(['stock'=>$qty]);
                 $array = [];
                 $array['user_id'] = Auth::user()->id;
                 $array['order_id'] = "#RL".rand('0000', '9999');
                 $array['product_id'] = $select->id;
                 $array['product_name'] = $select->name;
                 $array['payment_status'] = 'success';
                 $array['transction_id'] = "#RL".rand('0000000', '9999999');
                 $array['current_status'] = 'pending';

                $insert = Order::create($array);
                //   dd($insert->id);
                //   $array['order_id'] = $insert->id;
            return response()->json(['status'=>1,'message' => "Order has been placed successfully.", 'order_details'=> $array], 200);
          }else{
             return response()->json(['status'=>0,'message' => "User is not login"], 200);
         }
     }

}
