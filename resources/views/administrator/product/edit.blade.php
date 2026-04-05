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
                        <h2 class="header-title">Edit Product</h2>
                    </div>
                    <div class="col-sm-6">
                      <a href="{{ URL::to('administrator/product') }}" class="pull-right btn btn-info btn-sm" >View All</a>
                    </div>
                  </div>
                    <!-- form start -->
                     {{ Form::model($slider,array('url' => 'administrator/product/edit-store/'.$slider->id, 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal')) }}
                   <div class="box-body">
                    
                       <div class="form-group">
                           <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Name<span class="text-danger">*</span></label>
                           <div class="col-md-6">
                               {{Form::text('name',empty($slider->name) ? '' : $slider->name,['class'=>'form-control','id'=>'name','placeholder'=>'Enter Name'])}}
                               <div class="error-message">{{ $errors->first('name') }}</div>
                           </div>
                       </div>
                       <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Description<span class="text-danger">*</span></label>
                          <div class="col-md-6">
                           
                              {{Form::textarea('description',NULL,['class'=>'form-control','id'=>'description','required'=>'required','placeholder'=>'Enter Description'])}}
                              <div class="error-message">{{ $errors->first('description') }}</div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Amount<span class="text-danger">*</span></label>
                          <div class="col-md-6">
                           
                              {{Form::text('amount',NULL,['class'=>'form-control','id'=>'amount','required'=>'required','placeholder'=>'Enter Amount'])}}
                              <div class="error-message">{{ $errors->first('amount') }}</div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Sale Price<span class="text-danger">*</span></label>
                          <div class="col-md-6">
                           
                              {{Form::text('sale_price',NULL,['class'=>'form-control','id'=>'sale_price','required'=>'required','placeholder'=>'Enter Sale Price'])}}
                              <div class="error-message">{{ $errors->first('sale_price') }}</div>
                          </div>
                      </div>
                      <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Product Image</label>
                          <div class="col-sm-6">
                             <?PHP
                             $img=empty($slider->product_images) ? '':$slider->product_images;
                             ?>
                             <img src="{{ URL::asset('/public/backend/uploads/product/'.$img) }}" height="100" width="150">

                             <input type="file" class="form-control" name="product_images" id="product_images">
                             <div class="error-message">{{ $errors->first('product_images') }}</div>
                                 <input type="hidden" value="{{ $slider->product_images or ''}}" name="old_img">
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
    <script language="JavaScript" type="text/javascript" src="{{ URL::asset('admin/developer/js/product.js') }}"></script>
@stop

@push('scripts')
<script>
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('description');
    }
</script>
@endpush
