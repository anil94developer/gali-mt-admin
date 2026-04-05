<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Admin | Dubai King </title>
    <link rel="shortcut icon" type="image/favicon" href="<?php echo e(asset('/front/images/fevicon.ico')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<!-- Morris Charts CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('backend/vendors/bower_components/morris.js/morris.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('backend/dist/css/treeview.css')); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo e(asset('backend/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo e(asset('backend/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/dist/css/style.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css')); ?>" />
    <script>
        BASE_URL="<?php echo e(URL::to('/')); ?>";
    </script>
</head>

<?php /**PATH /home/dubaiking/public_html/Admin/resources/views/administrator/includes/head.blade.php ENDPATH**/ ?>