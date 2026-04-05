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
                <div class="col-sm-12">
                    <h2 class="header-title">Add Product</h2>
                    <br>
                </div>
            </div>
            <!-- form start -->
            {{ Form::open(array('url' => 'administrator/product-store','class'=>'form-horizontal','enctype'=>'multipart/form-data','name'=>'add_slider')) }}
            <div class="box-body">



                <!-- <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Slider Image<span class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input type="file" class="form-control" name="image" id="images">
                        <div class="error-message">{{ $errors->first('image') }}</div>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Name<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="name" id="name" class="form-control">
                        <div class="error-message">{{ $errors->first('name') }}</div>
                    </div>
                </div>
             

                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Amount<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="amount" id="amount" class="form-control">
                        <div class="error-message">{{ $errors->first('amount') }}</div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Sale Price<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="sale_price" id="sale_price" class="form-control">
                        <div class="error-message">{{ $errors->first('sale_price') }}</div>
                    </div>
                </div>

                <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Slider Image<span class="text-danger">*</span></label>
                          <div class="col-sm-6">
                              <input type="file" class="form-control" name="product_images" id="product_images">
                              <div class="error-message">{{ $errors->first('product_images') }}</div>
                          </div>
                      </div>
             
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Description<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        {{Form::textarea('description',NULL,['class'=>'form-control','id'=>'description','required'=>'required','placeholder'=>'Enter Description'])}}
                        <div class="error-message">{{ $errors->first('description') }}</div>
                    </div>
                </div>

            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <button type="submit" id="submit" name="add_slider" class="btn btn-primary">Submit</button>

            </div>
        </div>
        {{ Form::close() }}
    </div> <!-- container -->
</div> <!-- container -->
</div> <!-- content -->
</div>
<script type="text/javascript" src="{{ URL::asset('admin/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
<!-- <script language="JavaScript" type="text/javascript" src="{{ URL::asset('admin/developer/js/sub_admin.js') }}"></script> -->
@stop

@push('scripts')
<script>
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('description');
    }
</script>
@endpush