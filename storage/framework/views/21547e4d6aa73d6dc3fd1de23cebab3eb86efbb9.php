<?php $__env->startSection('content'); ?>
<section>
    <div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">User Game Report List</h5>
                        </div>
                        <div class="pull-right">
                           
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="UserGameReport" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Game Name</th>
                                                <th>Game Type</th>
                                                <th>Bet No.</th>
                                                <th>Amount</th>
                                                <!-- <th>Session</th> -->
                                                <th>Time</th>
                                                <th>Date</th>
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

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminmatka/public_html/resources/views/administrator/user/usergameReport.blade.php ENDPATH**/ ?>