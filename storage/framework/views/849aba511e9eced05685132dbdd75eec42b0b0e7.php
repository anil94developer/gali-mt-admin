<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Edit User Details </h6>
                    </div>
                    <div class="pull-right">
                        <a href="<?php echo e(URL::to('administrator/user/active-user-list')); ?>" class="btn btn-danger">Go Back</a>
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-wrap">
                                    <?php echo e(Form::open(['url' => route('edit_store_data'), 'data-toggle' => 'validator', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'])); ?>

                                    <input type="hidden" name="markets_id" value="<?php echo e($select->id); ?>">
                                    <div class="form-body">
                                        <hr class="light-grey-hr" />
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Name<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text"class="form-control" name="FullName"
                                                            placeholder="Name" value="<?php echo e($select->FullName); ?>" required>
                                                        <?php $__errorArgs = ['FullName'];
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
                                                    <label class="control-label col-md-4">Password<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text"class="form-control" name="us_pass"
                                                            placeholder="Password" value="<?php echo e($select->us_pass); ?>" required>
                                                        <?php $__errorArgs = ['us_pass'];
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
                                                    <label class="control-label col-md-4">Reffer By<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text"class="form-control" name="ref_by"
                                                            placeholder="Reffer By" value="<?php echo e($select->ref_by ?? ''); ?>" >
                                                        <?php $__errorArgs = ['ref_by'];
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
                                            

                                            

                                            



                                            <div class="form-actions mt-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit"
                                                                    class="btn btn-success  mr-10">Submit</button>
                                                                <button type="reset"
                                                                    class="btn btn-default">Cancel</button>
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

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/user/edit.blade.php ENDPATH**/ ?>