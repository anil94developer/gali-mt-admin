@extends('administrator.layout.administrator')
@section('content')

<section>
    <div>
        <div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">

                        <div class="pull-right">
                            <form name="date_filter" id="date_filter" method="get">
                                <div class="col-md-12">
                                    <select name="market" required id="market">
                                        <option value="" selected>--Select Market--</option>
                                        @foreach($market as $vs)
                                        <option value="{{$vs->market_id}}">{{$vs->market_name}}</option>
                                        @endforeach
                                    </select>

                                    <label for="form_date">Form Date</label>
                                    <input type="date" id="from_date" name="startDate" required>
                                    <label for="form_date">To Date</label>
                                    <input type="date" id="to_date" name="endDate" required>
                                    <button type="button" onclick="get_wdata()" id="filter" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="winner" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Mobile</th>
                                                <th>Username</th>
                                                <th>Market</th>
                                                <th>Type</th>
                                                <th>Bat Type</th>
                                                <th>Bat Key</th>
                                                <th>Bet Amount</th>
                                                <th>Win Amount</th>
                                                <th>Time</th>

                                                <!-- <th>Device ID</th> -->
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
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
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/point.js')}}"></script>
@endpush