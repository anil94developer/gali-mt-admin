
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
                        <input type="date" name="market_date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control"
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
                        <input type="number" class="form-control" name="dec_result" placeholder="Declare Result"
                            id="dec_result" required>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success hello">Add Result</button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

                <br>
                <br>
                <div class="table-responsive">
                    <form method="GET" action="<?php echo e(url('administrator/manage-market/update-result')); ?>" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label>From Date</label>
                                <input type="date" name="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>To Date</label>
                                <input type="date" name="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>">
                            </div>
                            <div class="col-md-4 d-flex align-items-center mt-25">
                                <button type="submit" class="btn btn-success mr-2">Filter</button>
                                <a href="<?php echo e(url('administrator/manage-market/update-result')); ?>"
                                    class="btn btn-primary">Reset</a>
                            </div>
                        </div>
                    </form>
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
                            <?php $i = 1;?>
                            <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($i); ?></th>
                                    <td><?php echo e($vs->market_id); ?></td>
                                    <td><?php echo e($vs->result); ?></td>
                                    <td><?php echo e(date('d-m-Y',strtotime($vs->date_time_result))); ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm editBtn" data-id="<?php echo e($vs->id); ?>"
                                            data-market_id="<?php echo e($vs->market_id); ?>" data-result="<?php echo e($vs->result); ?>"
                                            data-date_time_result="<?php echo e($vs->date_time_result); ?>">
                                            Edit
                                        </button>
                                        <a href="<?php echo e(URL::to('administrator/manage-market/update-result-delete/' . $vs->id)); ?>"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                <?php    $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>


        </div>
    </div>

    <!-- Edit Result Modal -->
    <div class="modal fade" id="editResultModal" tabindex="-1" role="dialog" aria-labelledby="editResultLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="<?php echo e(url('administrator/manage-market/update-result-data')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Market Result</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Market ID</label>
                            <input type="text" class="form-control" name="market_id" id="edit_market_id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Result</label>
                            <input type="text" class="form-control" name="result" id="edit_result" required>
                        </div>
                        <div class="form-group">
                            <label>Date Time Result</label>
                            <input type="datetime-local" class="form-control" name="date_time_result"
                                id="edit_date_time_result" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('/backend/developer/js/Managemarket.js')); ?>"></script>
    <script>
        // $(window).load(function () {
        //     window.setTimeout(function () {
        //         $.toast({
        //             heading: 'Welcome to Admin | Playonlineds',
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

         document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const market_id = this.dataset.market_id;
                const result = this.dataset.result;
                const date_time_result = this.dataset.date_time_result;

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_market_id').value = market_id;
                document.getElementById('edit_result').value = result;
                document.getElementById('edit_date_time_result').value = date_time_result;

                $('#editResultModal').modal('show');
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/managemarket/update_result.blade.php ENDPATH**/ ?>