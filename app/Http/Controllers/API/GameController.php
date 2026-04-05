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
use Carbon\Carbon;
use App\Http\Controllers\Controller;
class GameController extends Controller
{
    public function __construct()
    {
       // parent::__construct();
        // $this->middleware('auth');
    }

    public function result_history(Request $request)
    {
        if($request->from)
         {
             $from = Carbon::createFromFormat('d-m-Y', $request->from);
            }else{
                 if($request->type == '2')
                    {   
                     return response()->json(['status'=>0,'message' => "Please Fill Start Date"], 200);
                    }
            }
            if($request->to)
            {
                $to = Carbon::createFromFormat('d-m-Y', $request->to);
            }else{
                $date34 = date('d-m-Y');
                $to = Carbon::createFromFormat('d-m-Y', $date34);
            }
            // dd('[[[sssss');


        if($request->type == '1')
        {   
            $data = DB::table('results_tbls')->select('date','result','id')->where('market_id',$request->market_id)->orderBy('id','desc')->get();

        }else{
            if($from != '' && $to != 'to')
            {
            $data1 = DB::table('results_tbls')->select('date','result','id')->where('market_id',$request->market_id)->orderBy('id','asc')->get();
            $dataa = [];
            $final = [];
            foreach($data1 as $vs)
            {
                 $date = Carbon::createFromFormat('d-m-Y', $vs->date);
                if($date >= $from && $date <= $to)
                {
                    $dataa = $vs->id;
                    $final[] = $dataa;
                }
            }
             $data = DB::table('results_tbls')->select('date','result','id')->where('market_id',$request->market_id)->whereIn('id',$final)->orderBy('id','asc')->get();
            }
        }
      
        if(count($data)>0){
         return response()->json(['status'=>1,'message' => "Result Found", 'data'=>$data], 200);
        }else{
            return response()->json(['status'=>0,'message' => "NO Result Found"], 200);
        }
    }

    

}
