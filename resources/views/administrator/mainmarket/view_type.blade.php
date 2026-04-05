@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">View Market Type </h6>
                </div>
                <div class="pull-right">
                   <a href="{{route('admin_market_type')}}" class="btn btn-danger">Go Back</a>
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
                                                        <label class="control-label col-md-3"> Name:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->tbl_name!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Text:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->tbl_txt!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Minimum Point:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->min_point!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Image:</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static"> <img src="{{asset('/backend/uploads/tbl_types/'.$select->tbl_image)}}" alt="tbl_image" width="100px"> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Code :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->tbl_code!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Price Lot :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->price_lot!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Commision :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->commision!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">picker:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->lot_time!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">picker</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->time_interval!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">picker</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->start_time!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">picker</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->end_time!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Minimum</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->min_point_play!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Maximum</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! $select->max_point_allowed!!} </p>
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
