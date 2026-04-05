<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">User Details </h6>
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
                                <form class="form-horizontal" role="form">
                                <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Full Name : </label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->FullName; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Mobile : </label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->mob; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Gender : </label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->us_gender; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Date Of Birth :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->dob; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">E-mail
                                                            
                                                        
                                                        :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->dob; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Address :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_sunday_time_open; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Pin Code :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_sunday_time_open; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">District Name :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_sunday_time_open; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">State Name :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->is_holiday; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Status</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->status; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                          
                                            </div>
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
<script>

	</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaimatka/public_html/Admin/resources/views/administrator/user/view.blade.php ENDPATH**/ ?>