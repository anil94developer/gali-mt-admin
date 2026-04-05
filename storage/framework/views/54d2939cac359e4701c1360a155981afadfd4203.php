<?php $__env->startSection('content'); ?>
<style>
    .mb-2 {
        margin-bottom: 10px;
    }
</style>
<section>
    <div>
        <div class="row">

            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="">
                        <div class="">
                            <h5 class="panel-title txt-dark">Withdraw DateWise List</h5>
                        </div>
                        <div class="">
                            

                            <?php echo e(Form::open(array('url' => route('userwallet_report_download'), 'data-toggle' => 'validator', 'class' => '', 'enctype' => 'multipart/form-data'))); ?>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class=" mb-2">
                                        <input type="date" name="start_date" id="withdraw_date" class="form-control"
                                            placeholder="Select Date" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" mb-2">
                                        <input type="date" name="end_date" id="withdraw_date" class="form-control"
                                            placeholder="Select Date" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" mb-2">
                                        <input type="number" name="mobile" id="withdraw_date" class="form-control"
                                            placeholder="enter mobile" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class=" mb-2">
                                        <button type="submmit" class="btn btn-success"> Download CSV File</button>
                                    </div>
                                </div>


                            </div>
                            <?php echo e(Form::close()); ?>


                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->

<!-- Modal -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('/backend/developer/js/Withdraw.js')); ?>"></script>
    <script>

    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin.playonlineds.net/public_html/resources/views/administrator/csv/csv_file.blade.php ENDPATH**/ ?>