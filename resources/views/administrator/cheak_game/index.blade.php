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
</style>
<section>
    <div>
        <div class="row">

            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Cheak Game Load</h5>
                        </div>

                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="market_list" class="table mb-0">
                                        <table class="table mb-0">
                                            <form method="GET">
                                                <thead>
                                                    <tr>
                                                        <th>

                                                            <div class="form-group ">
                                                                <label class="">Load Date</label>
                                                                <input type="date" class="form-control" name="date" required value="<?= @$_GET['date'] ?>">
                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group">
                                                                <label for="">Select Market</label>
                                                                <select class="form-control" name="market" required>
                                                                    <option value="" selected>--Select Market--</option>
                                                                    @foreach($market_data as $vs)
                                                                    <option value="{{$vs->market_id}}" <?php if (@$_GET['market'] ==  $vs->market_id) {
                                                                                                            echo "selected";
                                                                                                        } ?>>{{$vs->market_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group">
                                                                <label for="">Game Type</label>
                                                                <select class="form-control" name="gameType" required>
                                                                    <option value="" selected>--Select Game Type--</option>
                                                                    <option value="open" <?php if (@$_GET['gameType'] ==  'open') {
                                                                                                echo "selected";
                                                                                            } ?>>Open</option>
                                                                    <option value="close" <?php if (@$_GET['gameType'] ==  'close') {
                                                                                                echo "selected";
                                                                                            } ?>>Close</option>
                                                                    <option value="starline" <?php if (@$_GET['gameType'] ==  'starline') {
                                                                                                    echo "selected";
                                                                                                } ?>>Starline</option>
                                                                </select>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <form>
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <button type="submit" class="btn btn-primary">SEARCH GAME LOAD</button>
                                                                        <a href="{{URL::to('administrator/cheak-game-list')}}" class="btn btn-info">Refresh</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                        </table>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div>
        <div class="row">

            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <!-- <div class="pull-right">
                            <a href="" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a>
                        </div> -->
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="">
                                <div class="container">
                                    <h3>All Load</h3>
                                    <br><br>
                                    <?php $date = @$_GET['date'];
                                    $market = @$_GET['market'];
                                    ?>
                                    @if(count($single_digit)>0)
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Single Digit</h4>
                                            </div>
                                            <!-- <div class="col-md-1 num" id="bahartotal"></div> -->
                                        </div>
                                        @foreach($single_digit as $single)
                                        <div class="tyu">
                                            {{$single->pred_num}}<br>
                                            <?php
                                            $amt_total = Helper::gettotalnumberdata($single->game_type, $single->pred_num, $date_data);
                                            ?>
                                            <strong class="num">{{$amt_total}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(count($jodi_digit)>0)
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Jodi Digit</h4>
                                            </div>

                                        </div>
                                        @foreach($jodi_digit as $jodi1)
                                        <div class="tyu">
                                            {{$jodi1->pred_num}}<br>
                                            <?php
                                            $amt_total1 = Helper::gettotalnumberdata($jodi1->game_type, $jodi1->pred_num, $date_data);
                                            ?>
                                            <strong class="num">{{$amt_total1}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(count($singlepana)>0)
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Single Pana</h4>
                                            </div>

                                        </div>
                                        @foreach($singlepana as $singlepana1)
                                        <div class="tyu">
                                            {{$singlepana1->pred_num}}<br>
                                            <?php
                                            $amt_total2 = Helper::gettotalnumberdata($singlepana1->game_type, $singlepana1->pred_num, $date_data);
                                            ?>
                                            <strong class="num">{{$amt_total2}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(count($doublepana)>0)
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Double Pana</h4>
                                            </div>

                                        </div>
                                        @foreach($doublepana as $doublepana1)
                                        <div class="tyu">
                                            {{$doublepana1->pred_num}}<br>
                                            <?php
                                            $amt_total3 = Helper::gettotalnumberdata($doublepana1->game_type, $doublepana1->pred_num, $date_data);
                                            ?>
                                            <strong class="num">{{$amt_total3}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(count($triplepana)>0)
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Triple Pana</h4>
                                            </div>

                                        </div>
                                        @foreach($triplepana as $triplepana1)
                                        <div class="tyu">
                                            {{$triplepana1->pred_num}}<br>
                                            <?php
                                            $amt_total4 = Helper::gettotalnumberdata($triplepana1->game_type, $triplepana1->pred_num, $date_data);
                                            ?>
                                            <strong class="num">{{$amt_total4}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(count($halfsangam)>0)
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Half Sangam</h4>
                                            </div>

                                        </div>
                                        @foreach($halfsangam as $halfsangam1)
                                        <div class="tyu">
                                            {{$halfsangam1->pred_num}}/ {{$halfsangam1->close_sangam}}<br>
                                            <?php
                                            $amt_total5 = Helper::gettotalnumberdata($halfsangam1->game_type, $halfsangam1->pred_num, $date_data);
                                            ?>
                                            <strong class="num">{{$amt_total5}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(count($fullsangam)>0)
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Full Sangam</h4>
                                            </div>

                                        </div>
                                        @foreach($fullsangam as $fullsangam1)
                                        <div class="tyu">
                                            {{$fullsangam1->pred_num}} / {{$fullsangam1->close_sangam}}<br>
                                            <?php
                                            $amt_total6 = Helper::gettotalnumberdata($fullsangam1->game_type, $fullsangam1->pred_num, $date_data);
                                            ?>
                                            <strong class="num">{{$amt_total6}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->

<!-- Modal -->

@endsection
@push('scripts')

<script>
    var total = $('#jodi').val();
    var bahar = $('#bahar').val();
    var andar = $('#andar').val();
    $('#joditotal').html("Rs." + total);
    $('#bahartotal').html("Rs." + bahar);
    $('#andartotal').html("Rs." + andar);
</script>

@endpush