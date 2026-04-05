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
use App\Models\BlockUser;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;

class SettingController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function Account()
    {
        return view('administrator.setting.account_list');
    }
    public function setting()
    {
        return view('administrator.setting.setting_list');
    }
    public function slider()
    {
        return view('administrator.setting.slider_list');
    }
    public function how_To_Play()
    {
        return view('administrator.setting.howtoplay_list');
    }
    public function setting_page()
    {
        return view('administrator.setting.page');
    }

    
}