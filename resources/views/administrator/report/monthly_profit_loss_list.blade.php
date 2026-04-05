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
                            <h5 class="panel-title txt-dark">Monthly Profit/Loss Report</h5>
                        </div>
                        <div class="pull-right">
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
							 <label for="form_date">Month</label>
                                    <select id="month">
                                    <option value="">Month</option>
                                    <?PHP for($i=1;$i<=12;$i++): ?>    
                                        <option value="{{$i}}">{{$i}}</option>
                                     <?PHP endfor; ?>    
                                    </select>
                                    <label for="form_date">Year</label>
                                    <select id="year">
                                    <option value="">Year</option>
                                    <?PHP for($i=22;$i<=30;$i++): ?>    
                                        <option value="20{{$i}}">20{{$i}}</option>
                                     <?PHP endfor; ?>    
                                    </select>
                                    <button type="button" onclick="get_mpldata()" id="filter" class="btn btn-success">Submit</button>
    
									
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="mpl_report" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Date</th>
                                                <th>Profit/Loss</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
										
										<tfoot>
							<tr>
							<th>Total=</th>
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
