<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PointTable;
use App\Models\Point;
use App\Models\Admin;
use App\Models\Market;
use App\Models\BlockUser;
use App\Models\Walletreport;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;

class CsvController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function userwallet_report()
    {
        return view('administrator.csv.csv_file');
    }

    public function userwallet_report_download(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('mob', $request->mobile)->first();
        if (!$user) {
            return redirect()->back()->with('error_message', 'No user found for this mobile number.')->withInput();
        }

        $startDate = date('d-m-Y', strtotime($request->start_date));
        $end_date = date('d-m-Y', strtotime($request->end_date));

        $data = Walletreport::where('user_id', $user->user_id)
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $end_date)
            ->whereIn('tr_nature', ['TRDEPO002', 'TRWIN005'])
            ->get();

        $columns = ['User Name', 'Moble no.', 'Amount', 'Remark ', 'Transaction Id', 'Date Time'];

        return response()->streamDownload(function () use ($data, $user, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($data as $value) {
                fputcsv($file, [
                    $user->FullName ?? 'NA',
                    $user->mob ?? 'NA',
                    $value->tr_value ?? 'NA',
                    $value->tr_remark ?? 'NA',
                    $value->transaction_id ?? 'NA',
                    $value->date_time ?? 'NA',
                ]);
            }
            fclose($file);
        }, 'user-wallet-' . date('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

//     public function userWithdraw_report_download(Request $request)
//     {
//         // dd("dddd");
//         header("Content-type: text/csv");
//         header("Content-Disposition: attachment; filename=file.csv");
//         header("Pragma: no-cache");
//         header("Expires: 0");
//         $data = [];
//         $startDate = date('d-m-Y',strtotime($request->start_date));
//         $end_date = date('d-m-Y',strtotime($request->end_date));
// // dd($startDate);
//         $user = User::where('mob', $request->mobile)->first();
//         // $data = Walletreport::where('user_id', $user->user_id)->where('date','>=', $startDate)->where('date','<=', $end_date)->whereIn('tr_nature',['TRDEPO002','TRWIN005'])->get();
//         // dd($user->user_id);
//         // $data = DB::table('wallet_reports')->where('date','>=', $startDate)->where('date','<=', $end_date)->whereIn('tr_nature',['TRDEPO002','TRWIN005'])->get();
//         $data = DB::table('point_table')->where('tr_nature', 'TRWITH003')->where('date','>=', $startDate)->where('date','<=', $end_date)->where('tr_status','Success')->orderBy('id','desc')->get();
//         // dd($data);


//         $columns = array('User Name', 'Moble no.', 'Account Number', 'IFSC Code ', 'Amount' ,'Remark', 'Date', 'Time', 'Status');
//         $file = fopen('php://output', 'w');
//         fputcsv($file, $columns);
//         $i = 1;
//         foreach ($data as $value) {
//             // dd($value);
//             $user = User::where('user_id', $value->user_id)->first();
//             fputcsv($file, array(
//                 // $i,
//                 is_null($value) ? "NA" : $user->FullName,
//                 is_null($value) ? "NA" : $user->mob,
//                 is_null($value) ? "NA" : $value->account_no,
//                 is_null($value) ? "NA" : $value->ifsc_code,
//                 is_null($value) ? "NA" : $value->tr_value,
//                 is_null($value) ? "NA" : $value->tr_remark,
//                 is_null($value) ? "NA" : date('d-m-Y',strtotime($value->created_at)),
//                 is_null($value) ? "NA" : date('h:s A',strtotime($value->created_at)),
//                 is_null($value) ? "NA" : $value->tr_status,
//                 '',
//             ));
//             // $i++;
//         }
//     }
    
public function userWithdraw_report_download(Request $request)
{
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=file.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = [];
    $startDate = date('d-m-Y', strtotime($request->start_date));
    $endDate = date('d-m-Y', strtotime($request->end_date));
    
    $user = User::where('mob', $request->mobile)->first();
    $data = DB::table('point_table')
        ->where('tr_nature', 'TRWITH003')
        ->where('date', '>=', $startDate)
        ->where('date', '<=', $endDate)
        ->where('tr_status', 'Success')
        ->orderBy('id', 'desc')
        ->get();

    $columns = array('User Name', 'Mobile No.', 'Account Number', 'IFSC Code', 'Amount', 'Remark', 'Date', 'Time', 'Status');
    $file = fopen('php://output', 'w');
    fputcsv($file, $columns);

    foreach ($data as $value) {
        $user = User::where('user_id', $value->user_id)->first();
        fputcsv($file, array(
            is_null($user) ? "NA" : $user->FullName,
            is_null($user) ? "NA" : $user->mob,
            is_null($value) ? "NA" : "'" . $value->account_no . "'",
            is_null($value) ? "NA" : $value->ifsc_code,
            is_null($value) ? "NA" : $value->tr_value,
            is_null($value) ? "NA" : $value->tr_remark,
            is_null($value) ? "NA" : date('d-m-Y', strtotime($value->created_at)),
            is_null($value) ? "NA" : date('h:i A', strtotime($value->created_at)),
            is_null($value) ? "NA" : $value->tr_status,
        ));
    }

    fclose($file);
}


}