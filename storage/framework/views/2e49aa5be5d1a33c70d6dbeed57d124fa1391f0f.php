
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
</style>
<div class="container-fluid pt-25">

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="pull-left">
                <h5 class="panel-title txt-dark">Update Result List</h5>
            </div>
        </div>

        <!-- <?php echo e(Form::open(array('url' => URL::to(''), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data'))); ?> -->
        <form method="post" action="<?php echo e(URL::to('administrator/manage-market/update-result-store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="market_date" value="<?php echo e(date('m-d-Y')); ?>" class="form-control"
                        placeholder="Select Date" required>

                </div>

                <div class="col-md-3">

                    <select class="form-control" name="select_market" id="select_market" required>
                        <option value="">Select Market</option>
                        <?php $__currentLoopData = $market_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->market_id); ?>"><?php echo e($item->market_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" name="dec_result" placeholder="Declare Result" id="dec_result" required>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-success hello">Add Result</button>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Market Name</th>
                            <th scope="col">Result</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i =1;?>
                        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($i); ?></th>
                            <td><?php echo e($vs->market_id); ?></td>
                            <td><?php echo e($vs->result); ?></td>
                            <td><?php echo e($vs->date_time_result); ?></td>
                            <td><a href="<?php echo e(URL::to('administrator/manage-market/update-result-delete/'.$vs->id)); ?>"
                                    class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('/backend/developer/js/Managemarket.js')); ?>"></script>
<script>
    // $(window).load(function () {
    //     window.setTimeout(function () {
    //         $.toast({
    //             heading: 'Welcome to Admin | Dubai King',
    //             // text: 'Use the predefined ones, or specify a custom position object.',
    //             position: 'top-right',
    //             loaderBg: '#e69a2a',
    //             icon: 'success',
    //             hideAfter: 3500,
    //             stack: 6
    //         });
    //     }, 3000);
    // });
</script>
<script>
    var total = $('#jodi').val();
    var bahar = $('#bahar').val();
    var andar = $('#andar').val();
    $('#joditotal').html("Rs." + total);
    $('#bahartotal').html("Rs." + bahar);
    $('#andartotal').html("Rs." + andar);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/managemarket/update_result.blade.php ENDPATH**/ ?>