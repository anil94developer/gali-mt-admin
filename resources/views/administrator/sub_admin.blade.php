@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Admin Info</h6>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                {{ Form::open(array('url' => route('admin_store'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }}
                                    <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Contact Mobile<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="contact_mobile" value="{{old('contact_mobile')}}" id="contact_mobile" placeholder="Contact Mobile">
                                                        @error('contact_mobile')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Whatsapp No<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="whatsapp_no" value="{{old('whatsapp_no')}}" id="whatsapp_no" placeholder="Whatsapp No">
                                                        @error('whatsapp_no')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">UPI Id<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="upi_id"  id="upi_id" placeholder="upi_id" value="{{old('upi_id')}}">
                                                        @error('upi_id')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
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
