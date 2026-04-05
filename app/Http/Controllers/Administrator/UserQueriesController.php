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

class UserQueriesController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.user_queries.index');
    }

    
}