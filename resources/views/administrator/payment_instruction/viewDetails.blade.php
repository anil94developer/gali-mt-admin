@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">View Payment Instruction Details </h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('payment_instruction_list')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <form class="form-horizontal" role="form">
                                    <div class="form-body">
                                        <hr class="light-grey-hr" />
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Title:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static">
                                                                {!! is_null($select) ? "NA" : $select->title!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            @if($select->file)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Image/video:</label>
                                                        <div class="col-md-9">
                                                            <!-- <p class="form-control-static"> <img src="' . URL::to('/backend/uploads/banner/').'/'.$select->image.'" height="100" width="150"> </p> -->
                                                            <!-- <img src="{{ URL::asset('/backend/uploads/payment_instruction/'.$select->file)}}" height="100px" width="100px" class="img-responvice"> -->
                                                             
                                                            <video width="320" height="240" controls>
                                                                <source
                                                                    src="{{URL::asset('backend/uploads/payment_instruction/' . $select->file)}}"
                                                                    type="video/mp4">
                                                            </video>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Description :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static">
                                                                {!! is_null($select) ? "NA" : $select->description!!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Status</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static">
                                                                {!! is_null($select) ? "NA" : $select->status!!} </p>
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