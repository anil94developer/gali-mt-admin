<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Add New Market</h6>
                </div>
                <div class="pull-right">
                   <a href="<?php echo e(route('admin_market')); ?>" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <?php echo e(Form::open(array('url' => route('admin_market_store'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data'))); ?>

                                    <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Market Name<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="market_name" placeholder="Market Name" required >
                                                        <?php $__errorArgs = ['market_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Open Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="time"class="form-control"  name="market_view_time_open"   placeholder="Open Time" required>
                                                        <?php $__errorArgs = ['market_view_time_open'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Close Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="market_view_time_close"   placeholder="Close Time" required>
                                                        <?php $__errorArgs = ['market_view_time_close'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Saturday Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="market_saturday_time_open" placeholder="Saturday Time"  required>
                                                        <?php $__errorArgs = ['market_saturday_time_open'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>-->

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Result Time<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="time" class="form-control" name="market_sunday_time_open" placeholder="Sunday Time"  required>
                                                        <?php $__errorArgs = ['market_sunday_time_open'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                          

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Holiday</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="is_holiday" id="radio14" value="1" >
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="is_holiday" id="radio16" value="0" checked>
                                                            <label for="radio16"> NO </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Market Sunday Off?</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="market_sunday_off" id="radio14" value="Y" >
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="market_sunday_off" id="radio16" value="N" checked>
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
                                                            <input type="radio" name="is_time_limit_applied" id="radio14" value="1" checked>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="is_time_limit_applied" id="radio16" value="0">
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
                                                            <input type="radio" name="is_no_limit_game" id="radio14" value="1" checked>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="is_no_limit_game" id="radio16" value="0">
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
                                                            <input type="radio" name="market_saturday_off" id="radio14" value="Y">
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="market_saturday_off" id="radio16" value="N" checked>
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
                                                            <input type="radio" name="close_by_admin" id="radio14" value="Y">
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="close_by_admin" id="radio16" value="N" checked>
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
                                                            <input type="radio" name="is_no_limit_game" id="radio14" value="1" checked>
                                                            <label for="radio14"> YES </label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="is_no_limit_game" id="radio16" value="0">
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
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('/backend/developer/js/subAdmin.js')); ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script> -->
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/market/create.blade.php ENDPATH**/ ?>