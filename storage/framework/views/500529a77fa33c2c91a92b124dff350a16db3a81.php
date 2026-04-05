
<?php $__env->startSection('content'); ?>

<style>
    .pull-right{
        margin-left: 900px;
        margin-bottom: 10px;
    }
    .main-content {
        margin-top: 30px;
    }
</style>
    <section>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Deposit Managment History(<?php echo e(date('d-m-Y',strtotime($date))); ?>)</h4>
                                <div class="page-title-right">
                                    <!-- <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Deposit Managment(<?php echo e($date); ?>)</a></li>
                                        <li class="breadcrumb-item active">Deposit Managment History</li>
                                    </ol> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Deposit Managment List</h5>
                                    <div class="pull-right">
                                        
                                    </div>
                                    <!-- <div class="table-responsive"> -->
                                        <!-- <table id="profit_loss_view" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>User Name</th>
                                                    <th>Amount</th>
                                                     <th>Re Mark</th>
                                                    <th>Time</th> 
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                                <//?php $i=1; ?>
                                                <?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th><//?php $i ?> </th>
                                                    <th></th> <//?php is_null($item->user_data)?"NA":$item->user_data->FullName ?> </th>
                                                    <th><//?php $item->tr_value ?> </th>
                                                    <th><//?php $item->tr_remark ?> </th>
                                                    <th><//?php date("h:i:s", strtotime($item->created_at)) ?> </th>
                                                    <th><//?php date("d-m-Y", strtotime($item->created_at)) ?> </th>
                                                    <th> <//?php $item->tr_status ?></th>                                                  
                                                    
                                                </tr>
                                                <//?php $i++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                
                                                
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table> -->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>User Name</th>
                                                    <th>Mobile</th>
                                                    <th>Amount</th>
                                                    <th>ReMark</th>
                                                    <th>Date</th>
                                                    <th>Time</th> 
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; ?>
                                            <?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?= $i ?> </td>
                                                    <td> <?= is_null($item->user_data)?"NA":$item->user_data->FullName ?></td>
                                                    <td> <?= is_null($item->user_data)?"NA":$item->user_data->mob ?></td>
                                                    <td><?= is_null($item->tr_value)?"NA":$item->tr_value ?> </td>
                                                    <td><?= is_null($item->tr_remark)?"NA":$item->tr_remark ?> </td>
                                                    <td><?= date("d-m-Y", strtotime($item->date)) ?> </td>
                                                    <td><?= date("h:i:s A", strtotime($item->created_at)) ?> </td>
                                                    <td> <?= is_null($item->tr_status)?"NA":$item->tr_status ?></td>                                             
                                                </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                            </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
    </section>

    <!-- Modal -->

    <!-- Modal -->
    


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('/backend/developer/js/subAdmin.js')); ?>"></script>
<script>

	</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/deposit_management/view.blade.php ENDPATH**/ ?>