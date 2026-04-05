@extends('administrator.layout.administrator')
@section('content')
    <style>
        .tyu {
            width: 75px;
            border: 5px solid #4e204c;
            height: 70px;
            float: left;
        }

        .num {
            font-size: 25px;
            color: #7210a5;
        }

        .form-control {
            height: 52px;
        }

        .hello {
            height: 47px;
        }

        .button_custum_new {
            position: relative;
            background-image: none;
            border: none;
            outline: none;
            background-color: #3F51B5;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.2s ease-out;
            width: 100px;
            height: 41px;
            font-size: 14px;
            padding: 3px;
            border-radius: 5px;
        }

        .button_custum_new::after {
            content: '';
            display: block;
            position: absolute;
            width: 160px;
            height: 40px;
            background-color: black;
            z-index: -1;
            top: 10px;
            opacity: 0.3;
            filter: blur(5px);
            transition: all 0.2s ease-out;
        }

        .button_custum_new:hover::after {
            opacity: 0.5;
            filter: blur(20px);
            transform: translatey(10px) scalex(1.2);
        }

        .button_custum_new:active {
            background-color: #dd4b4b;
        }

        .button_custum_new:active::after {
            opacity: 0.3;
        }

        .loading {
            border-radius: 50px;
            width: 50px;
            height: 50px;

        }

        .button_custum_new.loading::after {
            width: 40px;
            left: 5px;
            top: 12px;
            border-radius: 100%;
        }

        .spinner {
            display: block;
            width: 34px;
            height: 34px;
            position: absolute;
            top: 8px;
            left: calc(50% - 17px);
            background: transparent;
            box-sizing: border-box;
            border-top: 4px solid white;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid transparent;
            border-radius: 100%;
            animation: spin 0.6s ease-out infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg)
            }
        }
    </style>
    <div class="container-fluid pt-25">

        <!-- Row -->
        <div class="">
            <div class="col-sm-12">
                <div class="">
                    <h5 class="panel-title txt-dark">Winner Number List</h5>
                </div>
            </div>

            <!-- {{ Form::open(array('url' => URL::to(''), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }} -->
            <form method="get">
                <div class="row">
                    <div class="col-md-3">
                        <?php 
                    if (isset($_GET['market_date'])) {
        $date = $_GET['market_date'];
    } else {
        $date = date('m/d/Y');
    }
    if (isset($_GET['select_market'])) {
        $select_market = $_GET['select_market'];
    } else {
        $select_market = ' ';
    }
    if (isset($_GET['dec_result'])) {
        $dec_result = $_GET['dec_result'];
    } else {
        $dec_result = '';
    }
                    ?>

                        <input type="date" name="market_date" id="market_date1" value="{{$date}}" class="form-control"
                            placeholder="Select Date" required>
                    </div>

                    <div class="col-md-3">
                        <select class="form-control" name="select_market" id="select_market" required>
                            <option value="">Select Market</option>
                            @foreach ($market_data as $item)
                                                    <option value="{{ (string) $item->getKey() }}" <?php    if ((string) $item->getKey() === (string) trim($select_market)) {
                                    echo "selected";
                                }?>>{{
                                    $item->market_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="number" class="form-control" name="dec_result" value="{{$dec_result}}"
                            placeholder="Declare Result" id="dec_result" required>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success hello">Search</button>
                    </div>
                </div>
            </form>

            <div class="">
                <div class="table-responsive">
                    <form action="{{URL::to('administrator/manage-market/winner-number-result-declear')}}" method="post">
                        @csrf
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username Name</th>
                                    <th scope="col">Mobile </th>
                                    <th scope="col">Game Type</th>
                                    <th scope="col">Market Name</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Bet Amount</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    $i = 1;
    $totalWinnerId = [];
                            ?>
                                @foreach($winnerUserListFinal as $vs)
                                                        @foreach($vs as $vss)
                                                                                <tr>
                                                                                    <th scope="row">{{$i}}</th>
                                                                                    <td>{{is_null($vss->user_data) ? "NA" : $vss->user_data->FullName}}</td>
                                                                                    <td>{{is_null($vss->user_data) ? "NA" : $vss->user_data->mob}}</td>
                                                                                    <?php
                                                            if ($vss->game_type == 8) {
                                                                $gametype = 'Jodi';
                                                            } else if ($vss->game_type == 9) {
                                                                $gametype = 'Andar';
                                                            } else if ($vss->game_type == 10) {
                                                                $gametype = 'Bahar';
                                                            }
                                                                                ?>
                                                                                    <td>{{$gametype}}</td>
                                                                                    <td>{{$vss->table_id}}</td>
                                                                                    <td>{{$vss->pred_num}}</td>
                                                                                    <td>{{$vss->tr_value}}</td>
                                                                                    <td>{{date('d-m-Y h:i:s A', strtotime($vss->date_time))}}</td>
                                                                                    <?php
                                                            if ($vss->is_win == 0) {
                                                                $iswin = '<span style="color:#BE6DB7;">Pending</span>';
                                                            } elseif ($vss->is_win == 1) {
                                                                $iswin = '<span style="color:green;">Win</span>';
                                                            } elseif ($vss->is_win == 2) {
                                                                $iswin = '<span style="color:red;">Lost</span>';
                                                            }
                                                                                ?>
                                                                                    <td>{!!$iswin!!}</td>
                                                                                    <td><input type="checkbox" id="{{$vss->_id}}" class="checkBoxClass" name="winSelected[]"
                                                                                            value="{{$vss->_id}}">
                                                                                        <input type="hidden" name="date" value="{{$date}}">
                                                                                        <input type="hidden" name="select_market" value="{{$select_market}}">
                                                                                        <input type="hidden" name="dec_result" value="{{$dec_result}}">
                                                                                        <?php        $totalWinnerId[] = $vss->_id;
                                                            $totalWinnerUser = implode(",", $totalWinnerId);
                                                                                        ?>
                                                                                        <input type="hidden" name="totalWinnerId" value="{{$totalWinnerUser}}">
                                                                                    </td>
                                                                                </tr>
                                                                                <?php        $i++; ?>
                                                        @endforeach
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        Select All <input type="checkbox" id="ckbCheckAll" /><br>
                                        <select name="paidUnpaid" required class="form-control">
                                            <option value="">Select</option>
                                            <option value="paid">Paid</option>
                                            <option value="unpaid">Unpaid</option>
                                            <option value="lost">Lost</option>
                                            <option value="UnLost">UnLost</option>
                                            <!-- <option value="delete">Delete</option> -->
                                        </select><br>
                                        <button class="button_custum_new" id="apporve">Submit </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('/backend/developer/js/Managemarket.js')}}"></script>
    <script>

        $(document).ready(function () {
            $("#ckbCheckAll").click(function () {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            });
        });

        // $(window).load(function () {
        //     window.setTimeout(function () {
        //         $.toast({
        //             heading: 'Welcome to Admin | Playonlineds',
        //             // text: 'Use the predefined ones, or specify a custom position object.',
        //             position: 'top-right',
        //             loaderBg: '#e69a2a',
        //             icon: 'success',
        //             hideAfter: 3500,
        //             stack: 6
        //         });
        //     }, 3000);
        // });
    </script>
    <script>
        var total = $('#jodi').val();
        var bahar = $('#bahar').val();
        var andar = $('#andar').val();
        $('#joditotal').html("Rs." + total);
        $('#bahartotal').html("Rs." + bahar);
        $('#andartotal').html("Rs." + andar);
    </script>
    <script>
        var button = $('.button_custum_new'),
            spinner = '<span class="spinner"></span>';

        button.click(function () {
            if (!button.hasClass('loading')) {
                button.toggleClass('loading').html(spinner);
            }
            else {
                button.toggleClass('loading').html(spinner);
                button.prop('disabled', false);
            }
        })

    </script>
@endpush