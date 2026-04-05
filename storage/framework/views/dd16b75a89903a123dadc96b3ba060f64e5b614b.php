<?php $__env->startSection('content'); ?>
<section>
    <div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Active User List</h5>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo e(route('add_user')); ?>" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="active_list" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>Password</th>
                                                <th>Mobile</th>
                                                <th>Balance</th>
                                                <th>Winnig</th>
                                                <th>Total Balance</th>
                                                <th>Withdraw</th>
                                                <th>Deposit</th>
                                                <th>Ref Code</th>
                                                <th>Ref By</th>
                                                <th>Date</th>
                                                <th>Banned</th>
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
<script src="<?php echo e(asset('/backend/developer/js/User.js')); ?>"></script>
<script>
function myFunction(id) {  
  var copyText = document.getElementById("myInput_"+id);
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices
  navigator.clipboard.writeText(copyText.value);
  alert("Copied the text: " + copyText.value);
}

function divFunction()
{
    confirm("Are you sure want to delete?")
}
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/user/active.blade.php ENDPATH**/ ?>