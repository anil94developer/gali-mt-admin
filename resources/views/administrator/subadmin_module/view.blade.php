@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">View Users </h6>
                </div>
                <div class="pull-right">
                   <a href="{{route('admin_sub_admin')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <form class="form-horizontal" role="form">
                                <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">First Name:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->FullName!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Mobile:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->mob!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">DOB:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->dob!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Credit:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->credit!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Bound Diamonds:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->bonus_diamonds!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <hr>
                                            <h4>User Coins</h4>
                                            <table class="table table-condensed">
                                                <thead>
                                                <tr>
                                                    <th>money</th>
                                                    <th>upiId</th>
                                                    <th>TranID</th>
                                                    <th>transStatus</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($coin as $vs)
                                                <tr>
                                                    <td>{{$vs->money}}</td>
                                                    <td>{{$vs->upiId}}</td>
                                                    <td>{{$vs->TranID}}</td>
                                                    <td>{{$vs->transStatus}}</td>
                                                </tr>
                                               @endforeach
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>

                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/subAdmin.js')}}"></script>
<script>
	$('input[type=checkbox]').click(function(){
    // children checkboxes depend on current checkbox
    $(this).next().find('input[type=checkbox]').prop('checked',this.checked);
    // go up the hierarchy - and check/uncheck depending on number of children checked/unchecked
    $(this).parents('ul').prev('input[type=checkbox]').prop('checked',function(){
        return $(this).next().find(':checked').length;
    });
});
	</script>
@endpush
