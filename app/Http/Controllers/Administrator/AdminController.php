<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\Point;
use App\Models\AdminControl;
use App\Models\Admin;
use App\Models\BlockUser;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use Helper;

class AdminController extends Controller
{
	public function __construct()
	{
	}

	public function admin_info()
	{
		return view('administrator.admin_info');
	}

	public function admin_control_setting()
	{
		$select = AdminControl::first();
		return view('administrator.admincontrolsetting.admincontrolsetting', compact('select'));
	}
	public function admin_setting()
	{
		$select = DB::table('app_controller')->first();
		// dd($select);
		return view('administrator.adminsetting', compact('select'));
	}

	public function admin_control_setting_store(Request $request)
	{

		$data = [
			'ad_name' => $request->ad_name,
			'ad_email' => $request->ad_email,
			'ad_whtsp' => $request->ad_whtsp,
			'ad_package_key' => $request->ad_package_key,
			'app_updated_version' => $request->app_updated_version,
			'force_update' => $request->force_update,
			'is_app_maintanace' => $request->is_app_maintanace,
			'till_date_maintanace' => $request->till_date_maintanace,
			'maintanace_message' => $request->maintanace_message,
			'maintanace_title' => $request->maintanace_title,
			'online_deposit' => $request->online_deposit,
			'whatsapp_deposit' => $request->whatsapp_deposit,
			'currency' => $request->currency,
			'wallet' => $request->wallet,
			'history' => $request->history,
			'transaction' => $request->transaction,
			'redeem' => $request->redeem,
			'rates' => $request->rates,
			'accesskey' => $request->accesskey,
			'commission' => $request->commission,
			'upiid' => $request->upiid,

		];
		if ($request->maintanace_image) {
			$path_original = public_path() . '/backend/uploads/admin_control';
			$file = $request->maintanace_image;
			$photo_name = time() . '-' . $file->getClientOriginalName();
			$file->move($path_original, $photo_name);
			$data['maintanace_image'] = $photo_name;
		}


		$select = AdminControl::first();
		if ($select) {
			$update = AdminControl::where('id', $select->id)->update($data);
		} else {
			$flight = AdminControl::create($data);
		}

		return redirect()->back()->with('success_message', 'Admin Control Setting has been updated successfully.');
	}

	public function admin_setting_store(Request $request)
	{
		// dd($request->all());
		$data = [
			'wallet' => $request->wallet,
			'history' => $request->history,
			'transaction' => $request->transaction,
			'online_deposit' => $request->online_deposit,
			'whatsapp' => $request->whatsapp,
			'redeem' => $request->redeem,
			'min_deposit' => $request->min_deposit,
			'min_redeem' => $request->min_redeem,
			'HarufMax' => $request->HarufMax,
			'HarufMin' => $request->HarufMin,
			'jodi_max' => $request->jodi_max,
			'jodi_min' => $request->jodi_min,
			'crossingMin' => $request->crossingMin,
			'crossingMax' => $request->crossingMax,
			'dep_pp' => $request->dep_pp,
			'dep_pytm' => $request->dep_pytm,
			'dep_gp' => $request->dep_gp,
			'with_pytm' => $request->with_pytm,
			'is_app_maintainance' => $request->is_app_maintainance,
			'result_on_off' => $request->result_on_off,
			'is_paly_on_off' => $request->is_paly_on_off,
			'offers' => $request->offers,
			'reffral' => $request->reffral,
			'app_status' => $request->app_status,
			'how_to_play' => $request->how_to_play,
			'nav_chart' => $request->nav_chart,
			'ref_comm' => $request->ref_comm,
			'admin_contact_mob' => $request->admin_contact_mob,

		];
		$select = DB::table('app_controller')->update($data);
		return redirect()->back()->with('success', 'Updated successfully');
	}
}
