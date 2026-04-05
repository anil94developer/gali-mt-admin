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
                                    <h5 class="panel-title txt-dark">User Wallet History</h5>
                                </div>
                                <!-- <div class="pull-right">
                                    <a href="<?php echo e(route('add_gali_disawar_game')); ?>" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New Game</span></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table id="deposit_pending" class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Transaction Id</th>
                                            <th>Re Mark</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $user_wallet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ks=> $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                        
                                            <tr>
                                                <td><?php echo e($ks+1); ?></td>
                                                <td><?php echo e($vs->tr_value); ?></td>
                                                <td><?php echo e($vs->type); ?></td>
                                                <td><?php echo e($vs->transaction_id); ?></td>
                                                <td><?php echo e($vs->tr_remark); ?></td>
                                                <?php if($vs->tr_status == "Pending"): ?>
                                                <td style="color:red"><?php echo e($vs->tr_status); ?></td>
                                                <?php else: ?>
                                                <td style="color:green"><?php echo e($vs->tr_status); ?></td>
                                                <?php endif; ?>
                                                <td><?php echo e($vs->created_at); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </form>
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

    <!-- <script src="<?php echo e(asset('/backend/developer/js/DepositManagement.js')); ?>"></script> -->

    <script>
        var button = document.getElementById("approve");
        button.addEventListener("click", function () {
            button.disabled = true;
        });
    </script>
    <script>
        var cancelbutton = document.getElementById("cancel");
        cancelbutton.addEventListener("click", function () {
            cancelbutton.disabled = true;
        });
    </script>


    <script>
        $(document).ready(function () {
            $("#ckbCheckAll").click(function () {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            });
        });
    </script>

    <script>
        function DepositSuccess() {
            var checkboxes = document.querySelectorAll('.checkBoxClass:checked');
            var userIds = [];
            checkboxes.forEach(function (checkbox) {
                userIds.push(checkbox.value);
            });
            // Get the CSRF token value
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                url: "<?php echo e(URL::to('administrator/deposit-approve')); ?>", 
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    userIds: userIds,
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <script>
        function DepositCancel() {
            var checkboxes = document.querySelectorAll('.checkBoxClass:checked');
            var userIds = [];
            checkboxes.forEach(function (checkbox) {
                userIds.push(checkbox.value);
            });
            // Get the CSRF token value
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                url: "<?php echo e(URL::to('administrator/deposit-cancelled')); ?>", 
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    userIds: userIds,
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>



<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/user/userwallet_history.blade.php ENDPATH**/ ?>