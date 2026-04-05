<?php
/**
 * Created by PhpStorm.
 * User: wingstud
 * Date: 10/8/17
 * Time: 12:49 PM
 */
?>

<?php $__env->startSection('content'); ?>

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
                      <a href="<?php echo e(URL::to('administrator/faq/faq-list')); ?>" class="pull-right btn btn-info btn-sm" >View All</a>
                    </div>
                  </div>
                    <!-- form start -->
                     <?php echo e(Form::model($slider,array('url' => 'administrator/faq/updatefaq/'.$slider->id, 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal'))); ?>

                   <div class="box-body">
                    
                       <div class="form-group">
                           <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Title<span class="text-danger">*</span></label>
                           <div class="col-md-6">
                               <?php echo e(Form::text('title',empty($slider->title) ? '' : $slider->title,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Title'])); ?>

                               <div class="error-message"><?php echo e($errors->first('title')); ?></div>
                           </div>
                       </div>
                       <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Description<span class="text-danger">*</span></label>
                          <div class="col-md-6">
                           
                              <?php echo e(Form::textarea('description',NULL,['class'=>'form-control','id'=>'description','required'=>'required','placeholder'=>'Enter Description'])); ?>

                              <div class="error-message"><?php echo e($errors->first('description')); ?></div>
                          </div>
                      </div>
                     
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" id="submit" value="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div> <!-- container -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <script type="text/javascript" src="<?php echo e(URL::asset('admin/plugins/jquery-validation/js/jquery.validate.min.js')); ?>"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('admin/developer/js/sub_admin.js')); ?>"></script>
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/playon/admin/resources/views/administrator/faqs/edit.blade.php ENDPATH**/ ?>