@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Edit  Market </h6>
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
                                {{ Form::open(array('url' => route('admin_market_edit_store_type'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }}
                                <input type="hidden" name="id" value="{{$select->id}}">
                                <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">
                                        <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Name<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="tbl_name" placeholder=" Name" value="{{$select->tbl_name}}" required >
                                                        @error('tbl_name')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Text<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="tbl_txt" placeholder="Text" value="{{$select->tbl_txt}}" required >
                                                        @error('tbl_txt')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Minimum point<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="min_point"   placeholder="Minimum point" value="{{$select->min_point}}" required>
                                                        @error('market_view_time_open')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Image</label>
                                                    <div class="col-md-7">
                                                        <input type="file" class="form-control" name="tbl_image">
                                                        <img src="{{asset('/backend/uploads/tbl_types/'.$select->tbl_image)}}" alt="y" width="100px">
                                                        <input type="hidden" name="old_image" value="{{$select->tbl_image}}">
                                                        @error('image')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Code<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="tbl_code"   placeholder="Code " value="{{$select->tbl_code}}" required>
                                                        @error('tbl_code')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">price Lot<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="price_lot" placeholder="Price Lot"  value="{{$select->price_lot}}" required>
                                                        @error('price_lot')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Commision <span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="commision" placeholder="Commision " value="{{$select->commision}}"  required>
                                                        @error('commision')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Lot Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="lot_time" placeholder="Lot Time" value="{{$select->lot_time}}"  required>
                                                        @error('lot_time')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Interval Time <span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="time_interval" placeholder="Interval Time "  value="{{$select->time_interval}}" required>
                                                        @error('updated_time_date')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Start Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="start_time" placeholder="Start Time"  value="{{$select->start_time}}" required>
                                                        @error('start_time')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">End Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="end_time" placeholder="End Time"  value="{{$select->end_time}}" required>
                                                        @error('end_time')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Minimum<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="min_point_play" placeholder="Minimum "  value="{{$select->min_point_play}}" required>
                                                        @error('min_point_play')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Maximum<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="max_point_allowed" placeholder="picker "  value="{{$select->max_point_allowed}}" required>
                                                        @error('max_point_allowed')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Status</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="status" id="radio14" value="1" checked>
                                                            <label for="radio14"> Enable </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="status" id="radio16" value="0">
                                                            <label for="radio16"> Disable </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                         
                                    <div class="form-actions mt-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-success  mr-10">Submit</button>
                                                        <button type="reset" class="btn btn-default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
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
<script src="{{asset('/backend/developer/js/market.js')}}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$('.timepicker').timepicker({
});

	</script>
@endpush
