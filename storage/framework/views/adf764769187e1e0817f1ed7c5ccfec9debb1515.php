
<?php $__env->startSection('content'); ?>
    <style>
        .tyu {
            width: 75px;
            border: 5px solid #4e204c;
            height: 70px;
            float: left;
        }

        .num {
            font-size: 25px;
            color: #7210a5;
        }

        .form-control {
            height: 52px;
        }

        .hello {
            height: 47px;
        }

        .table-responsive {
            overflow-x: visible;
        }
    </style>
    <div class="container-fluid pt-25">

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left">
                    <h5 class="panel-title txt-dark">User Reffer Report View</h5>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Mobile </th>
                            <th scope="col">ref Code</th>
                            <th scope="col">ref By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php $__currentLoopData = @$users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ks => $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php    //print_r($vs->user_id);die; ?>
                            <tr>
                                <th scope="row"><?php echo e($i); ?></th>
                                <td><?php echo e($vs->user_id ?? 'NA'); ?></td>
                                <td><?php echo e($vs->FullName ?? 'NA'); ?></td>
                                <td><?php echo e($vs->mob ?? 'NA'); ?></td>
                                <td><?php echo e($vs->ref_code ?? 'NA'); ?></td>
                                <td><?php echo e($vs->ref_by ?? 'NA'); ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/user/reffer_report_view.blade.php ENDPATH**/ ?>