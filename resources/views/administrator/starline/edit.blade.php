@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Edit Game</h6>
                </div>
                <div class="pull-right">
                   <a href="{{route('game_name_list')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                {{ Form::open(array('url' => route('edit_store'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }}
                                <input type="hidden" name="markets_id" value="{{$select->id}}">
                                <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">
                                        <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Market Name<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="time"class="form-control" name="market_name" placeholder="Market Name" value="{{$select->market_name}}" required >
                                                        @error('market_name')
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
                                                    <label class="control-label col-md-4">Open Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="time"class="form-control" name="market_view_time_open"   placeholder="Open Time" value="{{$select->market_view_time_open}}" required>
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
                                                    <label class="control-label col-md-4">Close Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="market_view_time_close"   placeholder="Close Time" value="{{$select->market_view_time_close}}" required>
                                                        @error('market_view_time_close')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!--<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Saturday Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="market_saturday_time_open" placeholder="Saturday Time"  value="{{$select->market_saturday_time_open}}" required>
                                                        @error('market_saturday_time_open')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>
                                            </div>-->

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Result Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="market_sunday_time_open" placeholder="Sunday Time" value="{{$select->market_sunday_time_open}}"  required>
                                                        @error('market_sunday_time_open')
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
                                                    <label class="control-label col-md-4">Market Position<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="market_position" placeholder="Market Position" value="{{$select->market_position}}"  required>
                                                        @error('market_position')
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
                                                    <label class="control-label col-md-3">Market Sunday Off?</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" @if($select->market_sunday_off=="Y") checked @endif; 
															name="market_sunday_off" id="radio14" value="Y" >
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" @if($select->market_sunday_off=="N") checked @endif;  name="market_sunday_off" id="radio16" value="N">
                                                            <label for="radio16"> NO </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is Time Limit Applied?</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="is_time_limit_applied" id="radio14" value="1" @if($select->is_time_limit_applied==1) checked @endif;>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="is_time_limit_applied" id="radio16" value="0" @if($select->is_time_limit_applied==0) checked @endif;>
                                                            <label for="radio16"> NO </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											
											<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Market Saturday Off?</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="market_saturday_off" id="radio14" value="Y" @if($select->market_saturday_off=="Y") checked @endif;>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="market_saturday_off" id="radio16" value="N" @if($select->market_saturday_off=="N") checked @endif; >
                                                            <label for="radio16"> NO </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
												
											<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">CloseByAdmin?</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="close_by_admin" id="radio14" value="Y" @if($select->close_by_admin=="Y") checked @endif;>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="close_by_admin" id="radio16" value="N" @if($select->close_by_admin=="N") checked @endif;>
                                                            <label for="radio16"> NO </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											
											<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is No Limit Game?</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="is_no_limit_game" id="radio14" value="1" @if($select->is_no_limit_game==1) checked @endif;>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="is_no_limit_game" id="radio16" value="0" @if($select->is_no_limit_game==0) checked @endif;>
                                                            <label for="radio16"> NO </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Holiday</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="is_holiday" id="radio14" value="1" @if($select->is_holiday==1) checked @endif;>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="is_holiday" id="radio16" value="0" @if($select->is_holiday==0) checked @endif;>
                                                            <label for="radio16"> NO </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Status</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="status" id="radio14" value="1" @if($select->status==1) checked @endif;>
                                                            <label for="radio14"> Enable </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="status" id="radio16" value="0" @if($select->status==0) checked @endif;>
                                                            <label for="radio16"> Disable </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                         
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

<script type="text/javascript">
$('.datepicker').datepicker({
});

	</script>
@endpush
