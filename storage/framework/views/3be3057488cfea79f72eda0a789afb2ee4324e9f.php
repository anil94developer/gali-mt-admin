<?php $__env->startSection('content'); ?>
<section>
    <div>
        <div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel-heading">
                                <h5 class="panel-title txt-dark">Withdraw Success List</h5>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class=" d-flex align-items-center mb-5">
                                <input type="date" name="market_date" id="market_date" class="form-control"
                                    placeholder="Select Date" required="">
                                <button type="button" onclick="get_data2()" class="btn btn-success m-0">Search</button>
                            </div>
                        </div>
                        <div class="col-md-5  col-sm-12">
                            <?php echo e(Form::open(array('url' => route('userwithdraw_report_download'), 'data-toggle' => 'validator', 'class' => '', 'enctype' => 'multipart/form-data'))); ?>

                            <div class=" d-flex align-items-center mb-5">
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    placeholder="Select Date" required="">
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    placeholder="Select Date" required="">
                                <button type="submit" class="btn btn-success m-0">CSV</button>

                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>

                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="withdraw_success" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>User Name</th>
                                                <th>Mobile</th>
                                                <th>Account No.</th>
                                                <th>IFSC Code</th>
                                                 <th>Upi Id</th>
                                                <th>Amount</th>
                                                <th>Re Mark</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                 <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    WithdrawManageData_success
<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/playon/admin/resources/views/administrator/withdraw/success.blade.php ENDPATH**/ ?>