<?php $__env->startSection('content'); ?>
<section>
    <div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                      <div class="row">
                        <div class="col-md-12">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h5 class="panel-title txt-dark">Deposit Management Cancelled List</h5>
                                </div>
                                <!-- <div class="pull-right">
                                    <a href="<?php echo e(route('add_gali_disawar_game')); ?>" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New Game</span></a>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="market_date" id="market_date"  class="form-control mob_bottom1" placeholder="Select Date" required>
                        </div>
                        <div class="col-md-6">
                            <button type="button" onclick="get_data()" class="btn btn-success mob_bottom2">Search</button>
                        </div>

                        <div class="col-md-4 mt-10">
                            <div class="pay_btn">
                                <div>
                                    <label for="html">Select All</label>
                                    <input type="checkbox" class="form-control" style="display: revert;width:100%;" id="ckbCheckAll">
                                </div>
                                <div class="pay_button">
                                    <!-- Pass the onclick event to the pay function -->
                                    <button class="btn btn-success"  id="approve" onclick="DepositSuccess()">Approve</button>
                                </div>                 
                            </div> 
                        </div>
                    
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="deposit_cancelled" class="table mb-0">
                                        <thead>
                                            <tr>
                                            <th>Sr.</th>
                                                <th>User Name</th>
                                               <th>Mobile</th>
                                                <th>Amount</th>
                                                <th>ReMark</th>
                                                <!-- <th>Date</th> -->
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <!-- <th>Action</th> -->
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
    var button = document.getElementById("approve");
    button.addEventListener("click", function() {
        button.disabled = true;
    });
</script>


<script>
    function DepositSuccess() {
        var checkboxes = document.querySelectorAll('.checkBoxClass:checked'); 
        var userIds = [];
        checkboxes.forEach(function(checkbox) {
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
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/deposit_management/cancelled.blade.php ENDPATH**/ ?>