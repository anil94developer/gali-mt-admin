
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Add Qr Code </h6>
                </div>
                <div class="pull-right">
                    <a href="<?php echo e(route('scanner_payment')); ?>" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <?php echo e(Form::open(array('url' => route('store_qrcode'), 'data-toggle' => 'validator', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'))); ?>

                                <div class="form-body">
                                    <hr class="light-grey-hr" />
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Title<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="title"
                                                        placeholder="Enter Title" required>
                                                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger alert-dismissable alert-style-1">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                aria-hidden="true">×</button>
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
                                                <label class="control-label col-md-4">Qr Code <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="file" class="form-control" name="image"
                                                        placeholder="Select Image" required>
                                                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger alert-dismissable alert-style-1">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                aria-hidden="true">×</button>
                                                            <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                        </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
    <script src="<?php echo e(asset('/backend/developer/js/market.js')); ?>"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $('.timepicker').timepicker({

        });

    </script>

    <script type="text/javascript">
        $('.datepicker').datepicker({
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaimatka/public_html/Admin/resources/views/administrator/scanner_payment/add_qrcode.blade.php ENDPATH**/ ?>