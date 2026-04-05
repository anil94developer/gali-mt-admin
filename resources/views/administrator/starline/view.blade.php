@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">View Game Details </h6>
                </div>
                <div class="pull-right">
                   {{-- <a href="{{route('admin_market')}}" class="btn btn-danger">Go Back</a> --}}
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
                                                        <label class="control-label col-md-3">Market Name:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->market_name!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Market ID:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->market_id!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Open Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->market_view_time_open!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Close Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->market_view_time_close!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Saturday Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->market_sunday_time_open!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Sunady Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->market_sunday_time_open!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Holiday Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->is_holiday!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Date</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->updated_time_date!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Status</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->status!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                          
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

	</script>
@endpush
