<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Market;
use App\Models\Result;
use App\Models\Faq;
use URL;
use DB;
use Session;
use Validator;
use Response;
use Carbon\Carbon;


class PageController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function privacy_policynew()
    {
        return view('front.page.privacy_policynew');
    }
    public function contact_us_result()
    {
        return view('front.page.contact_us_result');
    }


    public function resultPage()
    {

        $currentDate = Carbon::now(); // Get the current date and time
        $todayDate = $currentDate->toDateString();
        // dd($todayDate);

        $Market = Market::whereNotNull('_id')->with('result')->orderBy('market_position', 'asc')->where('market_type', 3)->get();

        $ResultData = Result::with('market')->where('date', date('d-m-Y'))->orderBy('id', 'desc')->get();

        return view('front.page.resultPage', compact('Market', 'ResultData'));
    }


    public function market_delete_result_table()
    {
        // $data = DB::table('results_tbls')->where('market_id','SILVE')->delete();
        dd('yyyy');
    }
    public function product_list()
    {
        return view('front.page.product_list');
    }

    public function about_us()
    {
        return view('front.page.about_us');
    }

    public function blog()
    {
        return view('front.page.blog');
    }

    public function blog_details()
    {
        return view('front.page.blog_details');
    }

    public function contact_us()
    {
        return view('front.page.contact_us');
    }

    public function wishlist()
    {
        return view('front.page.wishlist');
    }

    public function cart()
    {
        return view('front.page.cart');
    }

    public function checkout()
    {
        return view('front.page.checkout');
    }

    public function term_conditions()
    {
        return view('front.page.term_conditions');
    }

    public function privacy_policy()
    {
        return view('front.page.privacy_policy');
    }


    public function my_account()
    {
        return view('front.page.my_account');
    }

    public function my_address()
    {
        return view('front.page.my_address');
    }

    public function my_order()
    {
        return view('front.page.my_order');
    }

    public function orders()
    {
        return view('front.page.orders');
    }

    public function success()
    {
        return view('front.page.success');
    }

    public function change_password()
    {
        return view('front.page.change_password');
    }

    public function faqPage(Request $request)
    {
        $data = Faq::where('banned', 1)->get();

        return response()->json(['data' => $data]);
    }



 



}
