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
                            <h5 class="panel-title txt-dark">Transaction History</h5>
                        </div>
                        <div class="pull-right">
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="transactionhistory" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
												<th>Mobile</th>
                                                <th>T-Type</th>
                                                <th>Amount</th>
                                                <th>Transaction Id</th>
                                                <th>DateTime</th>
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
<script src="{{asset('/backend/developer/js/transactionhistory.js')}}"></script>
@endpush
