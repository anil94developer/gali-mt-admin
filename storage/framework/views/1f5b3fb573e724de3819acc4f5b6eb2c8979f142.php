<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header ibox-content">
        <h3>
            <strong>Change Password</strong>
        </h3>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box-info ibox-content">
                    <div class="box-header with-border">
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php echo Form::open(array('url' =>  route('admin_update_change_pass'), 'class' => 'form-horizontal','id'=>'change-password')) ?>
                        <div class="box-body ">
                            <div class="form-group">
                                <label for="current_password" class="col-sm-3 control-label">Enter Current Password <span
                                            class="star_important">*</span></label>
                                <div class="col-sm-4">
                                    <input type="password" required name="current_password" class="form-control"
                                           id="current_password" placeholder="Current Password"
                                           aria-describedby="current_password"/>
							                    <?php $__errorArgs = ['current_password'];
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

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Enter New Password <span
                                            class="star_important">*</span></label>
                                <div class="col-sm-4">
                                    <input type="password" required name="password" class="form-control" id="password"
                                           placeholder="New Password" aria-describedby="password"/>
                                    <div class="error-message"><?php echo e($errors->first('password')); ?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-3 control-label">Confirm Password <span
                                            class="star_important">*</span></label>
                                <div class="col-sm-4">
                                    <input type="password" required name="password_confirmation" class="form-control"
                                           id="password_confirmation" placeholder="Confirm Password"
                                           aria-describedby="password_confirmation"/>
                                    <div class="error-message"><?php echo e($errors->first('password_confirmation')); ?></div>
                                </div>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer ">
                            <div class="col-sm-offset-3 col-sm-2">
                                <button type="submit" class="btn btn-info">Change Password</button>
                            </div>
                        </div><!-- /.box-footer -->
                        <?php echo e(Form::close()); ?>

                </div><!-- /.box -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div> <script src="<?php echo e(URL::asset('public/admin/js/jquery-3.1.1.min.js')); ?>"></script>    <script src="<?php echo e(URL::asset('public/admin/js/bootstrap.min.js')); ?>"></script>    <script src="<?php echo e(URL::asset('public/admin/js/plugins/metisMenu/jquery.metisMenu.js')); ?>"></script>    <script src="<?php echo e(URL::asset('public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>    <script src="<?php echo e(URL::asset('public/admin/js/plugins/dataTables/datatables.min.js')); ?>"></script>    <!-- Custom and plugin javascript -->    <script src="<?php echo e(URL::asset('public/admin/js/inspinia.js')); ?>"></script>    <script src="<?php echo e(URL::asset('public/admin/js/plugins/pace/pace.min.js')); ?>"></script>    <!-- Page-Level Scripts -->    <script>        ASSET_URL = '<?php echo e(URL::asset('public')); ?>/';        BASE_URL='<?php echo e(URL::to('/')); ?>';    </script>
<script>
	$("#current_password").on("keydown", function (e) {
	return e.which !== 32;
	});
	$("#password").on("keydown", function (e) {
	return e.which !== 32;
	});
	$("#password_confirmation").on("keydown", function (e) {
	return e.which !== 32;
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/change_password.blade.php ENDPATH**/ ?>