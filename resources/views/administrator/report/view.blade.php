@extends('administrator.layout.administrator')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Child Report </h5>
                        <div class="text-right"><a href="{{ URL::to('administrator/bonus-report') }}" class="btn btn-info">Back</a>
                            
                        </div>
                        <div class="ibox-content" style="padding-left: 24px;">
                            <div class="p-70">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">Username<span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
									{{$users->FullName}}
                                    </div>
                                </div>
                                
                                    <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">Mobile<span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        {{$users->mob}}

                                    </div>
                                    
                                </div>
								 <div class="form-group row">
								<label for="inputEmail3" class="col-sm-4 form-control-label">Child<span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        {{$child}}

                                    </div>
                                </div>
								<div class="form-group row">
								<label for="inputEmail3" class="col-sm-4 form-control-label">Total Played<span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        {{$pamt}}

                                    </div>
                                </div>
								<div class="form-group row">
								<label for="inputEmail3" class="col-sm-4 form-control-label">Commission<span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        {{$comm}}

                                    </div>
                                </div>
								<div class="form-group row">
								<label for="inputEmail3" class="col-sm-4 form-control-label">Join Date<span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        {{date('d-m-Y',strtotime($users->created_at))}}

                                    </div>
                                </div>
								
								<div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Child Report</h5>
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
                                    <table id="child_report" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>Mobile Number</th>
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

                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
    </div>
    <script type="text/javascript" src="{{ URL::asset('public/admin/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
   
    @endsection
@push('scripts')
<script>
var user_id="{{$users->ref_code}}"; 
</script>
<script src="{{asset('/backend/developer/js/report.js')}}"></script>
@endpush

