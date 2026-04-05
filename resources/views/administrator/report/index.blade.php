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
                            <h5 class="panel-title txt-dark">Bonus Report</h5>
                        </div>
                        <div class="pull-right">
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
							         <label for="form_date">Form Date</label>
                                    <input type="date" id="from_date" name="startDate" required>
                                    <label for="form_date">To Date</label>
                                    <input type="date" id="to_date" name="endDate" required>
                                    <button type="button" onclick="get_wdata()" id="filter" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="report" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>Mobile Number</th>
                                                <th>Child</th>
                                                <th>Total Played</th>
                                                <th>Commission</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
										
										<tfoot>
							<tr>
							<th></th>
                            <th>Total=</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
							</tr>
						     </tfoot>
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
<script src="{{asset('/backend/developer/js/report.js')}}"></script>
@endpush
