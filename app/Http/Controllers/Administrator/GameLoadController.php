<?php

namespace App\Http\Controllers\Administrator; //admin add

use App\Http\Requests;
use App\Http\Controllers\Controller;   // using controller class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\PaymentGatwaySetting;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Market;
use App\Models\GameLoad;
use App\Models\Point;
use DB;
use URL;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class GameLoadController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth.admin:admin');
    }
    public function admin_gameload_list()
    {
        
        // if (!empty($_REQUEST)) {
        if (!empty($_REQUEST) && isset($_REQUEST['market']) && isset($_REQUEST['date'])) {
            
            $market_name = Market::where('market_id', $_REQUEST['market'])->first();
            $date = date('d-m-Y', strtotime($_REQUEST['date']));
            $total_count = GameLoad::where('table_id', $_REQUEST['market'])->where('date', $date)->get();
            // dd($total_count);
            $total_winner = GameLoad::where('table_id', $_REQUEST['market'])->where('date', $date)->where('win_value', 1)->get();
            // dd($total_count);
            $market = Market::whereNotNull('app_id')->where('market_type', 3)->get();
            // dd( $market);
            return view('administrator.gameload.index', compact('market', 'total_count', 'market_name', 'total_winner'));
        }

        $total_count = [];
        $market = Market::where('market_type', 3)->get();
       
        return view('administrator.gameload.index', compact('market', 'total_count'));

    }
    public function admin_kalyan_game_load(Request $request)
    {
        if (!empty($_REQUEST)) {
            $market_name = Market::where('market_id', $_REQUEST['market'])->first();
            $date = date('d-m-Y', strtotime($_REQUEST['date']));
            // dd($date);
            $total_count = GameLoad::where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->count();
            $total_sum = GameLoad::where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->sum('tr_value');
            $total_winner = GameLoad::where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('win_value', 1)->count();
            $total_winner_sum = GameLoad::where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('win_value', 1)->sum('win_value');



            $single_digit = GameLoad::where('game_type', '1')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $jodi_digit = GameLoad::where('game_type', '2')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $singlepana = GameLoad::where('game_type', '3')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $doublepana = GameLoad::where('game_type', '4')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $triplepana = GameLoad::where('game_type', '5')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $halfsangam = GameLoad::where('game_type', '6')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $fullsangam = GameLoad::where('game_type', '7')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('game_type', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            // dd($total_count);

            $market_data = Market::get();
            // return view('administrator.cheak_game.index', compact('market', 'total_count', 'market_name', 'total_winner'));
        } else {
            $total_count = 0;
            $total_sum = 0;
            $total_winner = 0;
            $total_winner_sum = 0;
            $total_winner = [];
            $market_name = '';
            $market_data = Market::where('market_type', '2')->get();
            $date = date('d-m-Y');
            $single_digit = GameLoad::where('game_type', '1')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $jodi_digit = GameLoad::where('game_type', '2')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $singlepana = GameLoad::where('game_type', '3')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $doublepana = GameLoad::where('game_type', '4')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $triplepana = GameLoad::where('game_type', '5')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $halfsangam = GameLoad::where('game_type', '6')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $fullsangam = GameLoad::where('game_type', '7')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            // dd($single_digit);
        }
        // dd($date);
        $date_data = $date;
        // return view('administrator.cheak_game.index', compact('market', 'total_count'));
        return view('administrator.gameload.kalyan', compact('market_data', 'total_count', 'market_name', 'total_winner', 'total_count', 'total_sum', 'total_winner_sum', 'total_winner', 'single_digit', 'jodi_digit', 'singlepana', 'doublepana', 'triplepana', 'halfsangam', 'fullsangam', 'date_data'));
    }
    public function chk_bat_amount_gameload(Request $request)
    {
        // dd($request->all());
        // if($request->bat_number >0 && $request->bat_number <9){
        //     $batnumber = '0'.$request->bat_number;
        //     // dd($batnumber);
        // }
        if ($request->bat_number == '100') {
            $batnumber = 0;
        } else {
            if($request->bat_number < 10){
            $batnumber = '0'.$request->bat_number;

            }else{

                $batnumber = $request->bat_number;
            }
        }
        if ($request->bat_number == '100') {
            $batnumber = 0;
        }
        if ($request->market_type == 'jodi') {
            // dd("2222222");
            $game_type = 8;
        } elseif ($request->market_type == 'andar') {
            $game_type = 9;
            if ($request->bat_number == '10') {
                $batnumber = 0;
            }else{
                // dd($request->bat_number);
                $batnumber = intval($request->bat_number);
            }
        } elseif ($request->market_type == 'bahar') {
            $game_type = 10;
            if ($request->bat_number == '10') {
                $batnumber = 0;
            }else{
                // dd($request->bat_number);
                $batnumber = intval($request->bat_number);
            }
        }
        if ($request->date) {
            $date = date('d-m-Y', strtotime($request->date));
            $total_data = GameLoad::with('user_data')->where('table_id', $request->market)->where('date', $date)->where('pred_num', $batnumber)->where('game_type', $game_type)->get();
        } else {
            // dd($batnumber.'and'.$game_type);
            $date = date('d-m-Y');
            $total_data = GameLoad::with('user_data')->where('pred_num', $batnumber)->where('game_type', $game_type)->where('date', $date)->get();
        }
        // dd($total_data);
        return view('administrator.gameload.batlist', compact('total_data'));
    }
}