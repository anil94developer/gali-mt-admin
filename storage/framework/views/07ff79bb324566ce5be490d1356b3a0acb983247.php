
<?php $__env->startSection('content'); ?>
<section>
    <div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Gali Disawar Winning Result Report List</h5>
                        </div>
                        <div class="pull-right">
                            <!-- <a href="<?php echo e(route('admin_market_create')); ?>" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                         <!-- <?php echo e(Form::open(array('url' => URL::to('administrator/dashboard'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data'))); ?> -->
	<form method="get">
		<div class="row">
			<div class="col-md-6">
				<?php 
				if(isset($_GET['market_date']))
				{
					$date = $_GET['market_date'];
				}else{
					$date = date('Y-m-d');
				}
				?>
				<input type="date" name="market_date" id="market_date" value="<?php echo e($date); ?>" class="form-control" placeholder="Select Date" required>
                
            </div>

			<div class="col-md-3">
                
				<select class="form-control " name="select_market" id="select_market" required>
                    <option value="">Select Market</option>
                    <?php $__currentLoopData = $market_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->market_id); ?>"><?php echo e($item->market_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
			</div>

			<div class="col-md-3">
			
                <button type="button" onclick="get_data()" class="btn btn-success">Search</button>

			</div>

			<div class="col-md-3">
				
			</div>
		</div>
	<?php echo e(Form::close()); ?>

                        
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="gd_winning_report" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>User Name</th>
                                                <th>Mobile</th>
                                                <th>Market Name</th>
                                                <th>Win Amount</th>
                                                <th>Bat key</th>
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
<script src="<?php echo e(asset('/backend/developer/js/GaliDisawar.js')); ?>"></script>
<script>
function myFunction(id) {  
  var copyText = document.getElementById("myInput_"+id);
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices
  navigator.clipboard.writeText(copyText.value);
  alert("Copied the text: " + copyText.value);
}
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/galidisawar/winning_report.blade.php ENDPATH**/ ?>