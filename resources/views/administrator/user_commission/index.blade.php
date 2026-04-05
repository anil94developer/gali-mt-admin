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
                            <h5 class="panel-title txt-dark">User Commission</h5>
                           
                        </div>
                        <div class="pull-right">
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                           
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                        <form action="{{URL::to('administrator/user-commission/distribute')}}" method="post">
                            @csrf
                            <div class="table-wrap mt-40">
                                 
                             <div class="pay_btn">
                                <div>
                              <label for="html">Select All</label>
                               <input type="checkbox" class="form-control" style="display: revert;width:100%;" id="ckbCheckAll" />
                                </div>
                                <div class="pay_button">
                              <button class="btn btn-success">Pay</button></div>
                              </div>
                              
                                <div class="table-responsive">
                                    <table id="user_commission" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>User Name(Who bated)</th>
                                                <th>Mobile</th>
                                                <!-- <th>batId</th> -->
                                                <th>Amount</th>
                                                <th>Commission</th>
                                                <th>Status</th>
                                                <th>Market</th>
                                                <th>Date</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>                                               
                                            
                                        </tbody>
                                    </table>
                                    <div class="footertoalentry"></div>
                                </div>
                            </div>
                        </form>
                       
                            <div  class="submit_commission">                                
                                <div class="form-group">
                                    <input type="date" value="date" name="date" id="date">
                                </div>                                 

                                <button class="btn btn-primary" onclick="getdata()">Submit</button>
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
<script src="{{asset('/backend/developer/js/reportss.js')}}"></script>
<script>

    $(document).ready(function () {

    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
});
</script>
@endpush
