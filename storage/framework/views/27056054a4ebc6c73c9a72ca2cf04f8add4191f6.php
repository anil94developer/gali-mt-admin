
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">View Payment Instruction Details </h6>
                </div>
                <div class="pull-right">
                    <a href="<?php echo e(route('payment_instruction_list')); ?>" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <form class="form-horizontal" role="form">
                                    <div class="form-body">
                                        <hr class="light-grey-hr" />
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Title:</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static">
                                                                <?php echo is_null($select) ? "NA" : $select->title; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php if($select->file): ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Image/video:</label>
                                                        <div class="col-md-9">
                                                            <!-- <p class="form-control-static"> <img src="' . URL::to('/backend/uploads/banner/').'/'.$select->image.'" height="100" width="150"> </p> -->
                                                            <!-- <img src="<?php echo e(URL::asset('/backend/uploads/payment_instruction/'.$select->file)); ?>" height="100px" width="100px" class="img-responvice"> -->
                                                             
                                                            <video width="320" height="240" controls>
                                                                <source
                                                                    src="<?php echo e(URL::asset('backend/uploads/payment_instruction/' . $select->file)); ?>"
                                                                    type="video/mp4">
                                                            </video>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Description :</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static">
                                                                <?php echo is_null($select) ? "NA" : $select->description; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Status</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static">
                                                                <?php echo is_null($select) ? "NA" : $select->status; ?> </p>
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
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaimatka/public_html/Admin/resources/views/administrator/payment_instruction/viewDetails.blade.php ENDPATH**/ ?>