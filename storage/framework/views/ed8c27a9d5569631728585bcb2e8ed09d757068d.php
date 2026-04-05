<?php $__env->startSection('content'); ?>
<section>
    <div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                       <div class="row">
                    <div class="col-md-4">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Withdraw Pending List</h5>
                        </div>
                        <!-- <div class="pull-right">
                            <a href="<?php echo e(route('add_gali_disawar_game')); ?>" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New Game</span></a>
                        </div> -->
                    </div>
                     </div>
                            <div class="col-md-4">
                                <input type="date" name="market_date" id="market_date"  class="form-control" placeholder="Select Date" required>
                            </div>
                            <div class="col-md-4">
                                <button type="button" onclick="get_data1()" class="btn btn-success">Search</button>
                            </div>
                    
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="withdraw_pending" class="table mb-0">
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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminmatka/public_html/resources/views/administrator/withdraw/pending.blade.php ENDPATH**/ ?>