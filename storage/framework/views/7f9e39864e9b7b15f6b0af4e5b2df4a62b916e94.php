<?php $__env->startSection('content'); ?>
<section>
    <div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Date Wise Deposit List</h5>
                        </div>
                         <div class="pull-right">
                            
                            <form method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php 
                                        if(isset($_GET['deposit_date']))
                                        {
                                            $date = $_GET['deposit_date'];
                                        }else{
                                            // $date = date('Y-d-m');
                                            $date = "null";
                                        }
                                        ?>
                                        <input type="date" name="deposit_date" id="deposit_date" value="<?php echo e($date); ?>" class="form-control" placeholder="Select Date" required>
                                        
                                    </div>
                        
                                    <div class="col-md-3">
                                        <button type="button" onclick="get_data12()" class="btn btn-success">Search</button>
                                    </div>
                        
                                    <div class="col-md-3">
                                        <a href="<?php echo e(URL::to('/administrator/game/deposit-dateway-pending')); ?>" class="btn btn-success" >Refresh</a>
                                    </div>
                                </div>
                            <?php echo e(Form::close()); ?>

                        </div> 
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="date_withdraw_pending" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <!-- <th>User Name</th> -->
                                                <!-- <th>Mobile</th> -->
                                                <th>Amount</th>
                                                <th>Count</th>
                                                <!-- <th>Re Mark</th> -->
                                                <th>Date</th>
                                                <!-- <th>Time</th> -->
                                                <th>status</th>
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
<script src="<?php echo e(asset('/backend/developer/js/DepositManagement.js')); ?>"></script>
<script>

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/deposit_management/datewaypending.blade.php ENDPATH**/ ?>