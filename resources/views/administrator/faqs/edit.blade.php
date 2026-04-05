<?php
/**
 * Created by PhpStorm.
 * User: wingstud
 * Date: 10/8/17
 * Time: 12:49 PM
 */
?>
@extends('administrator.layout.administrator')
@section('content')

    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content" style="margin-top: 29px; background:#fff; padding-bottom: 60px;">
            <div class="container-fluid">
                <div class="row coin-add">
                    <div class="col-sm-6">
                        <h2 class="header-title">Edit Faq</h2>
                    </div>
                    <div class="col-sm-6">
                      <a href="{{ URL::to('administrator/faq/faq-list') }}" class="pull-right btn btn-info btn-sm" >View All</a>
                    </div>
                  </div>
                    <!-- form start -->
                     {{ Form::model($slider,array('url' => 'administrator/faq/updatefaq/'.$slider->id, 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal')) }}
                   <div class="box-body">
                    
                       <div class="form-group">
                           <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Title<span class="text-danger">*</span></label>
                           <div class="col-md-6">
                               {{Form::text('title',empty($slider->title) ? '' : $slider->title,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Title'])}}
                               <div class="error-message">{{ $errors->first('title') }}</div>
                           </div>
                       </div>
                       <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Description<span class="text-danger">*</span></label>
                          <div class="col-md-6">
                           
                              {{Form::textarea('description',NULL,['class'=>'form-control','id'=>'description','required'=>'required','placeholder'=>'Enter Description'])}}
                              <div class="error-message">{{ $errors->first('description') }}</div>
                          </div>
                      </div>
                     
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" id="submit" value="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div> <!-- container -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <script type="text/javascript" src="{{ URL::asset('admin/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ URL::asset('admin/developer/js/sub_admin.js') }}"></script>
@stop

@push('scripts')
<script>
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('description');
    }
</script>
@endpush
