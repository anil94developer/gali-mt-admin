<!doctype html>
<html>
<?php echo $__env->make('front.includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>

<div class="main"> 

  <?php echo $__env->make('front.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('content'); ?>
  <?php echo $__env->make('front.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('scripts'); ?>

</div>
</body>
</html>
<?php /**PATH /home/playon/admin/resources/views/front/layout/layout.blade.php ENDPATH**/ ?>