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
                   <a href="{{route('banner')}}" class="btn btn-danger">Go Back</a>
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
                                                        <label class="control-label col-md-3">Title:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->title!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Description:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> {!! is_null($select)?"NA":$select->description!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Image:</label>
                                                        <div class="col-md-9">
                                                            <!-- <p class="form-control-static"> <img src="' . URL::to('/backend/uploads/banner/').'/'.$select->image.'" height="100" width="150"> </p> -->
                                                            <img src="{{ URL::asset('/backend/uploads/banners/'.$select->image)}}" height="100px" width="100px" class="img-responvice">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
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
