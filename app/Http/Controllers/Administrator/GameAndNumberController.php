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

class GameAndNumberController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function single_digit()
    {
        return view('administrator.gameAndnumber.single_digit');
    }
    public function jodi_digit()
    {
        return view('administrator.gameAndnumber.jodi_digit');
    }
    public function single_panna()
    {
        return view('administrator.gameAndnumber.single_panna');
    }
    public function double_panna()
    {
        return view('administrator.gameAndnumber.double_panna');
    }
    public function triple_panna()
    {
        return view('administrator.gameAndnumber.triple_panna');
    }
    public function half_sangam()
    {
        return view('administrator.gameAndnumber.half_sangam');
    }
    public function full_sangam()
    {
        return view('administrator.gameAndnumber.full_sangam');
    }

    
}