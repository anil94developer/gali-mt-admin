
<?php $__env->startSection('content'); ?>
<style>
    .tyu {
        width: 78px;
        border: 2px solid black;
        height: 80px;
        float: left;
    }

    /* .num {
        font-size: 25px;
        color: blue;
    } */
    .num {
        font-size: 25px;
        color: blue;
        display: block;
        text-align: center;
    }

    .tyu span {
        color: red;
        text-align: center;
        display: block;
    }

    @media  screen and (min-width: 966px) and (max-width:991px) {
        .tyu {
            width: 101px;
            height: 80px;
        }

    }

    @media (max-width:767px) {
        .tyu {
            width: 80px;
            height: 80px;
        }

        .tyu span {
            color: red;
            text-align: center;
            display: block;
        }

        .num {
            font-size: 25px;
            color: blue;
            display: block;
            text-align: center;
        }
    }

    @media  screen and (min-width: 360px) and (max-width:425px) {
        .tyu {
            width: 25%;
            height: 80px;
        }

    }
</style>
<section>
    <div>
        <div class="row">

            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view matka">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Check Game Load</h5>
                        </div>

                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">

                                    <table id="market_list" class="table mb-0">
                                        <table class="table mb-0">
                                            <form method="GET">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="form-group ">
                                                                <label class="">Load Date</label>
                                                                <input type="date" class="form-control" name="date"
                                                                    required value="<?= @$_GET['date'] ?>">
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group">
                                                                <label for="">Select Market</label>
                                                                <select class="form-control" name="market" required>
                                                                    <option value="" selected>--Select Market--</option>
                                                                    <?php $__currentLoopData = $market; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($vs->market_id); ?>" <?php if
                                                                        (@$_GET['market']==$vs->market_id) { echo
                                                                        "selected"; } ?>><?php echo e($vs->market_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </th>

                                                        <th>
                                                            <form>
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">SEARCH GAME
                                                                            LOAD</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                        </table>
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
        
        <div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h3>All Load</h3>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="container-fluid">
                        <?php
                            $date = request()->query('date', '');
                            $market = request()->query('market', '');
                        ?>

                        <div class="row">
                            <div class="col-md-1">
                                <h4>Jodi</h4>
                            </div>
                            <div class="col-md-1 num" id="joditotal"></div>
                        </div>

                        <div class="row">
                            <?php $totalSum = 0; ?>
                            <?php for($x = 1; $x <= 100; $x++): ?>

                                <?php
                                    $d = str_pad($x, 2, '0', STR_PAD_LEFT);
                                  
                                    $data = App\Helpers\Helper::getJodiNew($d, $date, $market);
                                    $totalSum += $data;
                                ?>
                                <div class="tyu">
                                    <span style="color:red;"><?php echo e($d == '100' ? '00' : $d); ?></span><br>
                                    <strong class="num" onclick="jodi11('<?php echo e($data); ?>', 'jodi', '<?php echo e($x); ?>')">
                                        <?php echo e($data > 0 ? $data : ''); ?>

                                    </strong>
                                </div>
                            <?php endfor; ?>
                            <input type="hidden" value="<?php echo e($totalSum); ?>" id="jodi">
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                <h4>Andar</h4>
                            </div>
                            <div class="col-md-1 num" id="andartotal"></div>
                        </div>

                        <div class="row">
                            <?php $totalSum1 = 0; ?>
                            <?php for($x = 1; $x <= 10; $x++): ?>
                                <?php
                                    $data = App\Helpers\Helper::getAndarNew($x, $date, $market);
                                    $totalSum1 += $data;
                                ?>
                                <div class="tyu">
                                    <span style="color:red;"><?php echo e($x == 10 ? '0' : $x); ?></span><br>
                                    <strong class="num" onclick="jodi11('<?php echo e($data); ?>', 'andar', '<?php echo e($x); ?>')">
                                        <?php echo e($data > 0 ? $data : ''); ?>

                                    </strong>
                                </div>
                            <?php endfor; ?>
                            <input type="hidden" value="<?php echo e($totalSum1); ?>" id="andar">
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                <h4>Bahar</h4>
                            </div>
                            <div class="col-md-1 num" id="bahartotal"></div>
                        </div>

                        <div class="row">
                            <?php $totalSum11 = 0; ?>
                            <?php for($x = 1; $x <= 10; $x++): ?>
                                <?php
                                    $data = App\Helpers\Helper::getBaharNew($x, $date, $market);
                                    $totalSum11 += $data;
                                ?>
                                <div class="tyu">
                                    <span style="color:red;"><?php echo e($x == 10 ? '0' : $x); ?></span><br>
                                    <strong class="num" onclick="jodi11('<?php echo e($data); ?>', 'bahar', '<?php echo e($x); ?>')">
                                        <?php echo e($data > 0 ? $data : ''); ?>

                                    </strong>
                                </div>
                            <?php endfor; ?>
                            <input type="hidden" value="<?php echo e($totalSum11); ?>" id="bahar">
                        </div>

                        <h2>Total: <?php echo e($totalSum + $totalSum1 + $totalSum11); ?></h2>

                        <div id="userbatlist" class="table-responsive"></div>
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
<script src="<?php echo e(asset('/backend/developer/js/DepositManagement.js')); ?>"></script>
<script>

</script>
<script>
    var total = $('#jodi').val();
    var bahar = $('#bahar').val();
    var andar = $('#andar').val();
    $('#joditotal').html("Rs." + total);
    $('#bahartotal').html("Rs." + bahar);
    $('#andartotal').html("Rs." + andar);


    function jodi11(number, market_type, bat_number) {
        var date = "<?php if(isset($_GET['date'])){ echo $_GET['date']; }?>";
        var market = "<?php if(isset($_GET['market'])){ echo $_GET['market']; }?>";
        // alert(date);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL + '/administrator/chk-bat-amount-gameload',
            type: 'POST',
            data: {
                number: number, market_type: market_type, bat_number: bat_number, date: date, market: market
            },
            success: function (data) {
                $('#userbatlist').html(data);
            },
            error: function () {
                console.log('There is some error in user deleting. Please try again.');
            }
        });
    }
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dubaimatka/public_html/Admin/resources/views/administrator/gameload/index.blade.php ENDPATH**/ ?>