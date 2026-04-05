
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
    .form-control{
        height: 52px;
    }
    .hello{
        height: 47px;
    }
</style>
<div class="container-fluid pt-25">

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">  
            <div class="pull-left">
                <h5 class="panel-title txt-dark">User Reffer List</h5>
            </div>
        </div>

    <!-- <?php echo e(Form::open(array('url' => URL::to(''), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data'))); ?> -->
    <form method="get">
        <div class="row">
            <div class="col-md-3">
                <?php 
                if(isset($_GET['mob']))
                {
                    $mob = $_GET['mob'];
                }
                ?>
                <input type="text" class="form-control" name="mob" id="mob" placeholder="Enter Mobile Number" required>
                
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-success hello">Search</button>
            </div>
        </div>

    <?php echo e(Form::close()); ?>

<br>
Name : <?php echo e(@$user->FullName); ?><br> Ref_by : <?php echo e(@$user->ref_code); ?> 
<br>
<form action="<?php echo e(URL::to('administrator/manage-market/winner-number-result-declear')); ?>" method="post">
    <?php echo csrf_field(); ?>
   <div class="table-responsive">
     <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">User Name</th>
        <th scope="col">Mobile </th>
        <th scope="col">ref_by</th>
        <th scope="col">ref_code</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i =1;
        ?>
        <?php $__currentLoopData = @$array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ks=>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <th scope="row"><?php echo e($i); ?></th>
        <td><?php echo e(is_null(@$vs->FullName)?"NA":@$vs->FullName); ?></td>
        <td><?php echo e(is_null(@$vs->mob)?"NA":@$vs->mob); ?></td>
        <td><?php echo e(is_null(@$vs)?"NA":@$vs->ref_by); ?></td>
        <td><?php echo e(is_null(@$vs)?"NA":@$vs->ref_code); ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </tbody>
    </table>
   </div>
    </form>
      

</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('/backend/developer/js/Managemarket.js')); ?>"></script>
<script>

$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
});

    $(window).load(function() {
        window.setTimeout(function() {
            $.toast({
                heading: 'Welcome to Admin | Dubai King',
                // text: 'Use the predefined ones, or specify a custom position object.',
                position: 'top-right',
                loaderBg: '#e69a2a',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
        }, 3000);
    });
</script>

<?php $__env->stopPush(); ?>



<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/user/toptenuser.blade.php ENDPATH**/ ?>