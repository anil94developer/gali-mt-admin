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
use App\Models\AppControl;
use App\Models\Banner;
use Session;
use Hash;
use DB;
use URL;
use App\Helpers\Helper;
use MongoDB\BSON\ObjectId;

class WebSettingController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function Banner()
    {
        return view('administrator.web_setting.banner');
    }
    public function App_image()
    {
        return view('administrator.web_setting.app_image');
    }
    public function Apk_manager()
    {
        $apkManager = AppControl::first();
        // dd$apkManager);
        return view('administrator.web_setting.apk_manager',compact('apkManager'));
    }
    public function video()
    {
        return view('administrator.web_setting.video');
    }
    public function page()
    {
        return view('administrator.web_setting.page');
    }

    public function Add_Banner()
    {
        return view('administrator.web_setting.add_banner');
    }


    public function getBannerData(Request $request)
    {   
        $requestData = $_REQUEST;
        $total = Banner::count();
        $Market = Banner::whereNotNull('id')->orderBy('id', 'desc');
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
            $nestedData[] = $item->description;
            $nestedData[] = '<img src="' . URL::to('/backend/uploads/banners/').'/'.$item->image.'" height="100" width="150">';

            if ($item->status) {
                $message = "'Are you sure you want to Inactive the Banner Status?'";
                $nestedData[] = '<a href="' . url('/administrator/status-update/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the Banner Status?'";
                $nestedData[] = '<a href="' . url('/administrator/status-update/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }

            $editLink = '<a href="' . url('/administrator/banner-edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete-Banner/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/view-Banner-details/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
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


    public function StoreBanner(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('add_banner')->withErrors($validator)->withInput();
            }

            // dd($request->all());
            $insert = new Banner;
            $insert->title = $request->title;
            // $insert->slug = str_slug($request->title, "-");
            $insert->description = $request->description;
            $insert->status = $request->status;

            if($request->image){
                $path_original=public_path() . '/backend/uploads/banners';
                $file = $request->image;
                $photo_name = time().'-'.$file->getClientOriginalName();
                $file->move($path_original, $photo_name);
                $insert->image = $photo_name;
            }

            $insert->save();

            return redirect()->route('banner')->with('success_message', 'One New Banner has been created successfully.');
    }

    public function Banner_Edit(Request $request)
    {
        $select = Banner::where('id',$request->id)->first();
        return view('administrator.web_setting.edit_banner',compact('select')); 
    }

    public function Banner_Update(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            //    dd('ioo');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert['title'] = $request->title;
        $insert['description'] = $request->description;
        if($request->image){
            $path_original=public_path() . '/backend/uploads/banners';
            $file = $request->image;
            $photo_name = time().'-'.$file->getClientOriginalName();
            $file->move($path_original, $photo_name);
            $insert['image'] = $photo_name;
        }

        DB::table('banner')->where('id', $request->markets_id)->update($insert);
        return redirect()->route('banner')->with('success_message', 'Banner updated successfully.');
    
    }

    public function Status_Update($id)
    {
        $response = DB::statement("UPDATE banner SET status =(CASE WHEN (status = 1) THEN 0 ELSE 1 END) where id = $id");
        if ($response) {
            Session::flash('success_message', 'status has been updated successfully!');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }
        return redirect()->back();
    }

    public function delete_Banner($id)
    {
        //   dd('dasds');
        if ($select = Banner::find($id)) {
            $select->delete();
            Session::flash('success_message', 'One Banner has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect()->back();
    }


    function viewDetails($id)
    {
        $select = Banner::where('id', $id)->first();
        return view('administrator.web_setting.viewBannerDetails', compact('select'));
    }
    public function StoreApk(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'whatsapp' => 'required',
            // 'description' => 'required',
            'min_deposit' => 'required',
            'imp_notice_on_home' => 'required',
            'min_redeem' => 'required',
            // 'upiId' => 'upiId',
            'is_app_maintainance' => 'required',
            'admin_contact_mob' => 'required',
            'telegram' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('store_apk')->withErrors($validator)->withInput();
            }
    
            // dd($request->all());
            // $insert = new AppControl;
            // $insert['']whatsapp = $request->whatsapp;
            // $insert->min_deposit = $request->min_deposit;
            // $insert->imp_notice_on_home = $request->imp_notice_on_home;
            // $insert->min_redeem = $request->min_redeem;
            // $insert->is_app_maintainance = $request->is_app_maintainance;
            // $insert->upiId = $request->upiId;
            // $insert->admin_contact_mob = $request->admin_contact_mob;
            // $insert->telegram = $request->telegram;
            $data = [
                'whatsapp' => $request->whatsapp,
                'min_deposit' => $request->min_deposit,
                'imp_notice_on_home' => $request->imp_notice_on_home,
                'min_redeem' => $request->min_redeem,
                'is_app_maintainance' => $request->is_app_maintainance,
                'upiId' => $request->upiId,
                'admin_contact_mob' => $request->admin_contact_mob,
                'telegram' => $request->telegram,
            ];
            
    
            // $insert->save();
            AppControl::where('id',1)->update($data);
    
            return redirect('administrator/apk-manager')->with('success_message', 'One New Apk has been created successfully.');
    }

    /**
     * Resolve app_controller document by Mongo _id (hex string vs ObjectId vs BSON string).
     */
    private function findAppControlByRouteId($id): ?AppControl
    {
        if ($id === null || $id === '') {
            return null;
        }

        $id = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', rawurldecode(trim((string) $id)));
        if ($id === '') {
            return null;
        }

        $row = AppControl::find($id);
        if ($row) {
            return $row;
        }

        $row = AppControl::where('_id', $id)->first();
        if ($row) {
            return $row;
        }

        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $row = AppControl::where('_id', new ObjectId($id))->first();
                if ($row) {
                    return $row;
                }
            } catch (\Throwable $e) {
                // invalid ObjectId
            }

            $doc = AppControl::raw(function ($collection) use ($id) {
                try {
                    return $collection->findOne(
                        ['$or' => [
                            ['_id' => $id],
                            ['_id' => new ObjectId($id)],
                        ]],
                        ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]
                    );
                } catch (\Throwable $e) {
                    return null;
                }
            });

            if ($doc !== null) {
                $attrs = is_array($doc) ? $doc : json_decode(json_encode($doc), true);
                if (is_array($attrs) && isset($attrs['_id'])) {
                    return (new AppControl)->newFromBuilder($attrs);
                }
            }
        }

        return null;
    }

    public function update_Apk_manager(Request $request)
    {
        $this->validate(
            $request,
            [
                // 'whatsapp' => 'required',
            ]
        );

        $apk = $this->findAppControlByRouteId($request->input('id'));
        if (!$apk) {
            return redirect()->route('apk_manager')->with('error_message', 'App settings record not found. Save the form again or contact support.');
        }

        $apk->update([
            'whatsapp' => $request->whatsapp,
            'help_line_number' => $request->help_line_number,
            'user_reg_no' => $request->user_reg_no,
            'min_deposit' => $request->min_deposit,
            'max_deposit' => $request->max_deposit,
            'min_redeem' => $request->min_redeem,
            'jodi_min' => $request->jodi_min,
            'jodi_max' => $request->jodi_max,
            'HarufMin' => $request->HarufMin,
            'HarufMax' => $request->HarufMax,
            'crossingMin' => $request->crossingMin,
            'crossingMax' => $request->crossingMax,
            'upiId' => $request->upiId,
            'is_app_maintainance' => $request->is_app_maintainance,
            'is_app_mentinance2' => $request->is_app_mentinance2,
            'is_app_mentinance3' => $request->is_app_mentinance3,
            'is_app_mentinance4' => $request->is_app_mentinance4,
            'is_app_maintenance5' => $request->is_app_maintenance5,
            'admin_contact_mob' => $request->admin_contact_mob,
            'imp_notice_on_home' => $request->imp_notice_on_home,
            'telegram' => $request->telegram,
            'reffer_link' => $request->reffer_link,
            'market_disable' => $request->market_disable,
            'withdraw_disable' => $request->withdraw_disable,
            'deposit_disable' => $request->deposit_disable,
            'how_to_play' => $request->how_to_play,
            'version' => $request->version,
            'withdraw_otp' => $request->withdraw_otp,
            'withdraw_open_time' => $request->withdraw_open_time,
            'withdraw_close_time' => $request->withdraw_close_time,
        ]);

        return redirect()->route('apk_manager')->with('success_message', 'App settings have been updated successfully.');
    }
    
}