<?php echo $__env->make('administrator.includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="la-anim-1"><img class="loader" src="<?php echo e(asset('administrator/images/loading.gif')); ?>"></div>
</div>
<!-- /Preloader -->
<div class="wrapper theme-1-active pimary-color-red">
    <?php echo $__env->make('administrator.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('administrator.includes.left_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
    <div class="page-wrapper">

 <?php if(Session::has('success_message')): ?>
    <div class="alert alert-success alert-dismissable" id="successMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo e(Session::get('success_message')); ?></p>
        <div class="clearfix"></div>
    </div>
 <?php endif; ?>
 <?php if(Session::has('error_message')): ?>
    <div class="alert alert-info alert-dismissable" id="successMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="zmdi zmdi-info-outline pr-15 pull-left"></i><p class="pull-left"><?php echo e(Session::get('error_message')); ?></p>
        <div class="clearfix"></div>
    </div>
 <?php endif; ?>
  <?php echo $__env->yieldContent('content'); ?>

  <footer class="footer container-fluid pl-30 pr-30">
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>2025 &copy;  Playonlineds</p>
        </div>
    </div>
</footer>
</div>
</div>
</div>
<?php echo $__env->make('administrator.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
<script>
      setTimeout(function(){
          $("#successMessage").css("display", "none");
          }, 3000);
</script>
</body>
</html>

<?php /**PATH C:\wamp64\www\adminmt\resources\views/administrator/layout/administrator.blade.php ENDPATH**/ ?>