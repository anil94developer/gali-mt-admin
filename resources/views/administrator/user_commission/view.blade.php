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
                            <h5 class="panel-title txt-dark"> View User Commission Details</h5>
                           
                        </div>
                        <div class="pull-right">
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                           
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">                              
                                <div class="table-responsive">
                                    <table id="user_commission" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>User Name</th>
                                                <th>Mobile</th>
                                                <th>batId</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            <?php $i=1; ?>
                                            @foreach($viewuser as $vs)                                            
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$vs->user_data->FullName}}</td>
                                                <td>{{$vs->user_data->mob}}</td>
                                                <td>{{$vs->batId}}</td>
                                                <td>{{$vs->amount}}</td>
                                                <td>{{$vs->status}}</td>
                                                <td>{{$vs->date}}</td>
                                            </tr>
                                            <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="footertoalentry"></div>
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
<!-- <script src="{{asset('/backend/developer/js/reportss.js')}}"></script> -->
<script>

    $(document).ready(function () {

    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
});
</script>
@endpush
