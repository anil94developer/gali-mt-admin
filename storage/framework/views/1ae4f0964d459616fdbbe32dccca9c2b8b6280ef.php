<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Faq List</h5>
                    <div class="text-right"> <a href="<?php echo e(URL::to('administrator/faq/add-faq')); ?>" class="btn btn-info">Add New</a></div>

                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="datatable-fixed-header" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <!-- <th>Image</th> -->
                                    <!-- <th>Position </th>  -->
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<!-- Page-Level Scripts -->
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script>
    ASSET_URL = '<?php echo e(URL::asset('public')); ?>/';
    BASE_URL = '<?php echo e(URL::to('/')); ?>';
</script>
<script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('backend/developer/js/faq.js')); ?>"></script>
<script>
    $('.input-sm').attr('placeholder', "category,title");
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/faqs/index.blade.php ENDPATH**/ ?>