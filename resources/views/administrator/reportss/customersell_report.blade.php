@extends('administrator.layout.administrator')
@section('content')
<section>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
        .sell-report-box {
            border: 3px dotted #555;
            margin: 10px auto;
            padding: 8px;
            font-size: 25px;
            text-align: center;
            font-weight: 700;
            color: #b85b93;
        }

        .sr_td_data .form-group .st_br_ht,
        .sr_td_data .form-group .st_br_hb {
            border-bottom: 1px solid black;
            padding: 5px;
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .badge-success {
            color: #fff;
            background-color: #8dbf42;
        }

        .badge-danger {
            color: #fff;
            background-color: #e7515a;
        }

        .badge-report {
            min-width: 50px;
        }

        .st_br_hb {
            text-align-last: center;
        }

        .st_br_ht {
            text-align-last: center;
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            min-height: 1px;
            padding: 2.25rem;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
        }

        .sr_td_data .form-group {
            border: 1px solid #000;
            border-left: none;
            padding: 0;
        }

        .sr_td_data .form-group.st_br_l {
            border-left: 1px solid #000;
        }

        .badge-report {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            -webkit-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }

        .sr_td_data .form-group .st_br_hb {
            border-bottom: none;
        }

        .widget-content-area {
            padding: 20px;
            position: relative;
            background-color: #fff;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .p-3 {
            padding: 1rem !important;
        }

        body {
            background: #f1f2f3 !important
        }

        .layout-spacing {
            padding-bottom: 40px;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }


        element.style {}

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        user agent stylesheet div {
            display: block;
        }

        .main-container {
            min-height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            padding: 10px 0 0 10px;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            overflow: hidden;
        }

        .bootstrap-select>.dropdown-toggle {
            position: relative;
            width: 100%;
            text-align: right;
            white-space: nowrap;
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .form-group label,
        label {
            font-size: 15px;
            color: #067082;
            letter-spacing: 1px;
        }

        :not(.input-group)>.bootstrap-select.form-control:not([class*=col-]) {
            width: 100%;
        }

        .form-group .bootstrap-select,
        .form-horizontal .bootstrap-select,
        .form-inline .bootstrap-select {
            margin-bottom: 0;
        }

        .bootstrap-select:not(.input-group-btn),
        .bootstrap-select[class*=col-] {
            float: none;
            display: inline-block;
            margin-left: 0;
        }

        .bootstrap-select.form-control {
            margin-bottom: 0;
            padding: 0;
            border: none;
            height: auto;
        }

        .bootstrap-select {
            width: 220px\0;
            vertical-align: middle;
        }

        .bootstrap-select>select {
            position: absolute !important;
            bottom: 0;
            left: 50%;
            display: block !important;
            width: 0.5px !important;
            height: 100% !important;
            padding: 0 !important;
            opacity: 0 !important;
            border: none;
            z-index: 0 !important;
        }
    </style>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>

<body>
    <div class="container">
        <div class="layout-px-spacing">
            <div class="row mt-5" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <form class="p-3" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group mb-4">
                                        <label>Date</label>
                                        <input type="date" class="form-control" id="from_date" name="from_date"
                                            value="2023-01-17">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-4 reloaded-divs">
                                        <label>Game Name</label>
                                        <div class="dropdown bootstrap-select form-control"><select
                                                class="selectpicker form-control" name="game_id" title="Select Game"
                                                id="slect_job_cat" value="" tabindex="-98">
                                                <option class="bs-title-option" value=""></option>
                                                <option value="All">All</option>
                                                <option value="94">
                                                    MAIN BAZAR </option>
                                                <option value="95">
                                                    RAJDHANI NIGHT </option>
                                                <option value="98">
                                                    KALYAN NIGHT </option>
                                                <option value="101">
                                                    MILAN NIGHT </option>
                                                <option value="102">
                                                    SUPREME NIGHT </option>
                                                <option value="103">
                                                    MADHUR NIGHT </option>
                                                <option value="104">
                                                    MUMBAI NIGHT </option>
                                                <option value="105">
                                                    SRIDEVI NIGHT </option>
                                                <option value="106">
                                                    MUMBAI BAZAR </option>
                                                <option value="107">
                                                    KALYAN </option>
                                                <option value="109">
                                                    SUPREME DAY </option>
                                                <option value="110">
                                                    MILAN DAY </option>
                                                <option value="111">
                                                    RAJDHANI DAY </option>
                                                <option value="113">
                                                    MADHUR DAY </option>
                                                <option value="114">
                                                    TIME BAZAR </option>
                                                <option value="115">
                                                    SRIDEVI </option>
                                                <option value="116">
                                                    MADHUR MORNING </option>
                                                <option value="117">
                                                    KALYAN MORNING </option>
                                                <option value="118">
                                                    MILAN MORNING </option>
                                                <option value="119">
                                                    MUMBAI MORNING </option>
                                            </select><button type="button"
                                                class="btn dropdown-toggle btn-light bs-placeholder"
                                                data-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                                aria-haspopup="listbox" aria-expanded="false" data-id="slect_job_cat"
                                                title="Select Game">
                                                <div class="filter-option">
                                                    <div class="filter-option-inner">
                                                        <div class="filter-option-inner-inner">Select Game</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <div class="dropdown-menu ">
                                                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group mb-4 reloaded-divs">
                                        <label>Game Type</label>
                                        <div class="dropdown bootstrap-select form-control"><select
                                                class="selectpicker form-control" name="game_type"
                                                title="Select Game Type" id="slect_job_cat" value="" tabindex="-98">
                                                <option class="bs-title-option" value=""></option>
                                                <option value="All">All</option>
                                                <option value="single_digit">Single Digit</option>
                                                <option value="jodi_digit">Jodi Digit</option>
                                                <option value="single_panna">Single Panna</option>
                                                <option value="double_panna">Double Panna</option>
                                                <option value="triple_panna">Triple Panna</option>
                                            </select><button type="button"
                                                class="btn dropdown-toggle btn-light bs-placeholder"
                                                data-toggle="dropdown" role="combobox" aria-owns="bs-select-2"
                                                aria-haspopup="listbox" aria-expanded="false" data-id="slect_job_cat"
                                                title="Select Game Type">
                                                <div class="filter-option">
                                                    <div class="filter-option-inner">
                                                        <div class="filter-option-inner-inner">Select Game Type</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <div class="dropdown-menu ">
                                                <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 text-centre">
                                    <button type="submit" class="btn btn-primary" style="margin-top:30px;" name="filter"
                                        value="filter">Submit</button>
                                    <button class="btn btn-danger" id="clearrr_cat"
                                        style="color:azure; margin-top:30px;"><a
                                            href=" https://matkagold.com/report_user_bid_history_list/report">Clear</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-5" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <center class="sell-report-box">
                            <h4>Single Digit</h4>
                        </center>
                        <form method="post">
                            <div class="mb-4 mt-4">
                                <div class="row">
                                    <!-- Zero Configuration  Starts-->
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mytable">
                                                    <div class="row sr_td_data">
                                                        <div class="form-group bord st_br_l col-md-2">
                                                            <h5 class="st_br_ht">Digit</h5>
                                                            <h5 class="st_br_hb">Point</h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">0</h5>
                                                            <h5 class="st_br_hb">
                                                                <?php $value = Helper::get_bet_num_amt('0','1');?>
                                                                <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">1</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('1','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">2</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('2','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">3</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('3','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">4</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('4','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">5</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('5','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                    <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">6</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('6','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                    <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">7</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('7','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                    ?>
                                                                    <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php } 
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge> 
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">8</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('8','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                    <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">9</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('9','1');?>
                                                            <?php if($value <=0)
                                                                { 
                                                                ?>
                                                                    <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                 ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-5" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <center class="sell-report-box">
                            <h4>Jodi Digit</h4>
                        </center>
                        <form method="post">
                            <div class="mb-4 mt-4">
                                <div class="row">
                                    <!-- Zero Configuration  Starts-->
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mytable">
                                                    <div class="row sr_td_data">
                                                        <div class="form-group bord st_br_l col-md-2">
                                                            <h5 class="st_br_ht">Digit</h5>
                                                            <h5 class="st_br_hb">Point</h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">00</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('0','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                            <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">01</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('1','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">02</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('2','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">03</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('3','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">04</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('4','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">05</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('5','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">06</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('6','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">07</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('7','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">08</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('8','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">09</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('9','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">10</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('10','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">11</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('11','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">12</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('12','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">13</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('13','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">14</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('14','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">15</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('15','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">16</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('16','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">17</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('17','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">18</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('18','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">19</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('19','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">20</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('20','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">21</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('21','2');?>
                                                            <?php
                                                            if($value <=0){
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">22</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('22','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">23</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('23','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">24</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('24','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">25</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('25','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">26</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('26','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">27</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('27','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">28</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('28','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">29</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('29','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">30</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('30','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">31</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('31','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">32</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('32','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">33</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('33','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">34</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('34','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">35</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('35','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">36</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('36','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">37</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('37','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">38</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('38','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">39</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('39','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">40</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('40','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">41</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('41','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">42</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('42','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">43</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('43','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">44</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('44','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">377</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('44','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">46</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('46','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">47</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('47','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">48</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('48','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">49</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('49','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">50</h5>
                                                            <h5 class="st_br_hb">
                                                                <?php $value = Helper::get_bet_num_amt('50','2');?>
                                                                <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">51</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('51','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">52</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('52','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">53</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('53','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">54</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('54','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">55</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('55','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">56</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('56','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">57</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('57','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">58</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('58','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">59</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('59','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">60</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('60','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">61</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('61','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">62</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('62','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">63</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('63','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">64</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('64','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">65</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('65','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">66</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('66','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">67</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('67','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">68</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('68','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">69</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('69','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">70</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('70','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">71</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('71','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">72</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('72','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">73</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('73','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">74</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('74','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">75</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('75','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">76</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('76','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">77</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('77','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">78</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('78','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">79</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('79','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">80</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('80','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">81</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('81','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">82</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('82','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">83</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('83','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">84</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('84','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">85</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('85','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">86</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('86','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">87</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('87','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">88</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('88','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">89</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('89','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">90</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('90','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">91</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('91','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">92</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('92','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">93</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('93','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">94</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('94','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">95</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('95','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">96</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('96','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">97</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('97','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">98</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('98','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">99</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('99','2');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                            ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                            }
                                                            ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-5" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <center class="sell-report-box">
                            <h4>Single Panna</h4>
                        </center>
                        <form method="post">
                            <div class="mb-4 mt-4">
                                <div class="row">
                                    <!-- Zero Configuration  Starts-->
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mytable">
                                                    <div class="row sr_td_data">
                                                        <div class="form-group bord st_br_l col-md-2">
                                                            <h5 class="st_br_ht">Digit</h5>
                                                            <h5 class="st_br_hb">Point</h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">120</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('120','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">123</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('123','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">124</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('124','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">125</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('125','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">126</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('126','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">127</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('127','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">128</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('128','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">129</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('129','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">130</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('130','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">134</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('134','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">135</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('135','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">136</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('136','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">137</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('137','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">138</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('138','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">139</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('139','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">140</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('140','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">145</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('145','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">146</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('146','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">147</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('147','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">148</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('148','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">149</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('149','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">150</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('150','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">156</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('156','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">157</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('157','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">158</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('158','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">159</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('159','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">160</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('160','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">167</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('167','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">168</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('168','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">169</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('169','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">170</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('170','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">178</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('178','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">179</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('179','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">180</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('180','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">189</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('189','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">190</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('34','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">230</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('230','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">234</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('234','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">235</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('235','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">236</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('236','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">237</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('237','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">238</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('238','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">239</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('239','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">240</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('240','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">245</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('245','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">246</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('246','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">247</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('247','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">248</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('248','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">249</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('249','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">250</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('250','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">256</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('256','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">257</h5>
                                                            <h5 class="st_br_hb">
                                                                <?php $value = Helper::get_bet_num_amt('257','3');?>
                                                                <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">258</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('258','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">259</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('259','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">260</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('260','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">267</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('267','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">268</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('268','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">269</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('269','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">270</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('270','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">278</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('278','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">279</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('279','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">280</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('280','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">289</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('289','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">290</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('290','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">340</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('340','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">345</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('345','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">346</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('346','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">347</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('347','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">348</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('348','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">349</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('349','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">350</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('350','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">356</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('356','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">357</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('357','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">358</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('358','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">359</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('359','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">360</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('360','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">367</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('367','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">368</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('368','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">369</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('369','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">370</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('370','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">378</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('378','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">379</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('379','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">380</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('380','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">389</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('389','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">390</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('390','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">450</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('450','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">456</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('456','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">457</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('457','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">458</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('458','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">459</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('459','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">460</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('460','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">467</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('467','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">468</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('468','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">469</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('469','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">470</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('470','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">478</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('478','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">479</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('479','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">480</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('480','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">489</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('489','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">490</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('490','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">560</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('560','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">567</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('567','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">568</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('568','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">569</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('569','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">570</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('570','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">578</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('578','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">579</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('579','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">580</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('580','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">589</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('589','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">590</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('590','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">670</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('670','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">678</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('678','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">679</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('679','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">680</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('680','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">689</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('689','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">690</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('690','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">780</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('780','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">789</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('789','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">790</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('790','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">890</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('890','3');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-5" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <center class="sell-report-box">
                            <h4>Double Panna</h4>
                        </center>
                        <form method="post">
                            <div class="mb-4 mt-4">
                                <div class="row">
                                    <!-- Zero Configuration  Starts-->
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mytable">
                                                    <div class="row sr_td_data">
                                                        <div class="form-group bord st_br_l col-md-2">
                                                            <h5 class="st_br_ht">Digit</h5>
                                                            <h5 class="st_br_hb">Point</h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">100</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('100','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">110</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('110','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">112</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('112','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">113</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('113','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">114</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('114','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">115</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('115','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">116</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('116','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">117</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('117','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">118</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('118','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">119</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('119','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">122</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('122','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">133</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('133','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">144</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('144','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">155</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('155','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">166</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('166','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">177</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('177','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">188</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('188','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">199</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('199','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">200</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('200','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">220</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('220','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">223</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('223','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">224</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('224','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">225</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('225','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">226</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('226','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">227</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('227','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">228</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('228','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">229</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('229','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">233</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('233','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">244</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('244','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">255</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('255','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">266</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('266','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">277</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('277','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">288</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('288','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">299</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('299','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">300</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('300','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">330</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('330','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">334</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('334','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">335</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('335','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">336</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('336','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">337</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('337','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">338</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('338','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">339</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('339','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">344</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('344','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">355</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('355','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">366</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('388','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">377</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('377','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">388</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('388','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">399</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('399','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">400</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('400','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">440</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('440','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">445</h5>
                                                            <h5 class="st_br_hb">
                                                                <?php $value = Helper::get_bet_num_amt('445','4');?>
                                                                <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">446</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('446','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">447</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('447','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">448</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('448','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">449</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('449','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">455</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('455','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">466</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('466','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">477</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('477','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">488</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('488','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">499</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('499','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">500</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('500','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">550</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('550','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">556</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('556','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">557</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('557','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">558</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('558','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">559</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('559','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">566</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('566','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">577</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('577','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">588</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('588','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">599</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('599','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">600</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('600','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">660</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('660','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">667</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('667','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">668</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('668','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">669</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('669','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">677</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('677','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">688</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('688','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">699</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('699','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">700</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('700','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">770</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('770','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">778</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('778','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">779</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('779','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">788</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('788','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">799</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('799','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">800</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('800','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">880</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('880','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">889</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('889','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">899</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('899','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">900</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('900','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">990</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('990','4');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-5" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <center class="sell-report-box">
                            <h4>Triple Panna</h4>
                        </center>
                        <form method="post">
                            <div class="mb-4 mt-4">
                                <div class="row">
                                    <!-- Zero Configuration  Starts-->
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mytable">
                                                    <div class="row sr_td_data">
                                                        <div class="form-group bord st_br_l col-md-2">
                                                            <h5 class="st_br_ht">Digit</h5>
                                                            <h5 class="st_br_hb">Point</h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">000</h5>
                                                            <h5 class="st_br_hb">
                                                                <?php $value = Helper::get_bet_num_amt('000','5');?>
                                                                <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">111</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('111','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-success">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">222</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('222','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">333</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('333','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">444</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('444','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">555</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('555','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">666</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('666','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">777</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('777','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">888</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('888','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="form-group bord col-md-1">
                                                            <h5 class="st_br_ht">999</h5>
                                                            <h5 class="st_br_hb">
                                                            <?php $value = Helper::get_bet_num_amt('999','5');?>
                                                            <?php
                                                            if ($value <= 0) {
                                                                ?>
                                                                <badge class="badge-report badge-danger">{{$value}}</badge>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <badge class="badge-report badge-success">{{$value}}</badge>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
</section>
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/reportss.js')}}"></script>
@endpush
