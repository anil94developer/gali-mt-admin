@extends('administrator.layout.administrator')
@section('content')
<section>
    <div>
        <div class="row">            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h5 class="panel-title txt-dark">Deposit Management Pending List</h5>
                                </div>
                                <!-- <div class="pull-right">
                                    <a href="{{route('add_gali_disawar_game')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New Game</span></a>
                                </div> -->
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="market_date" id="market_date"  class="form-control" placeholder="Select Date" required>
                        </div>
                        <div class="col-md-4">
                            <button type="button" onclick="get_data11()" class="btn btn-success">Search</button>
                        </div>                    
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="deposit_pending" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>User Name</th>
                                                <th>Mobile</th>
                                                <th>Amount</th>
                                                <th>Re Mark</th>
                                                <th>Status</th>
                                                <th>Time</th>
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

<!-- Modal -->

<!-- Modal -->

@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/DepositManagement.js')}}"></script>
<script>

</script>

@endpush
