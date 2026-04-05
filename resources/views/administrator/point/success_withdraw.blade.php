@extends('administrator.layout.administrator')
@section('content')
<section>
    <div>
        <div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Withdraw Success List </h5>
                        </div>
                        <div class="pull-right">
                         <!-- <form name="date_filter" id="date_filter" method="get">
                                <div class="col-md-12">
                                    <label for="form_date">Form Date</label>
                                    <input type="date" id="from_date" name="startDate" required>
                                    <label for="form_date">To Date</label>
                                    <input type="date" id="to_date" name="endDate" required>
                                    <button type="button" onclick="get_data()" id="filter" class="btn btn-success">Submit</button>
                                </div>
                                </form> -->
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="success_withdraw" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Mobile</th>
                                                <th>Username</th>
                                                <th>Transaction ID</th>
                                                <th>Win Value</th>
                                                <th>Tr. value</th>
                                                <th>Tr. value type</th>
                                                <th>Tr status</th>
                                                <th>Value update by</th>
                                                <th>Amount Transfer</th>
                                                
                                                <th>Date</th>
                                               
                                                 <th>Action</th> 
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
