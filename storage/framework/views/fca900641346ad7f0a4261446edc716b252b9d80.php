<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">View Game Details </h6>
                </div>
                <div class="pull-right">
                   
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
                                                        <label class="control-label col-md-3">Market Name:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_name; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Market ID:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_id; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Open Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_view_time_open; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Close Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_view_time_close; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Saturday Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_sunday_time_open; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Sunady Time:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo is_null($select)?"NA":$select->market_sunday_time_open; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Holiday Time:</label>
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

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/starline/view.blade.php ENDPATH**/ ?>