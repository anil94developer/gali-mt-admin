
<?php $__env->startSection('content'); ?>

<section>
    <div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Apk Manager</h5>
                        </div>
                        <div class="pull-right">
                            
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <!-- <form> -->
                                    <!-- <?php echo csrf_field(); ?> -->
                                    <?php echo e(Form::open(array('url' => route('apk_manager_update'), 'data-toggle'=>'validator','method'=>'post' , 'class'=> '', 'enctype'=>'multipart/form-data'))); ?>

                                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo e($apkManager->id); ?>">
                                    <div class="col-md-6 form-group m-0">
                                        <label for="whatsapp" class="form-label">Whatsapp No.</label>
                                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="<?php echo e($apkManager->whatsapp); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="whatsapp" class="form-label">User Reg. No.</label>
                                        <input type="text" class="form-control" name="user_reg_no" id="user_reg_no" value="<?php echo e($apkManager->user_reg_no); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum Deposit</label>
                                        <input type="text" class="form-control" name="min_deposit" id="min_deposit" value="<?php echo e($apkManager->min_deposit); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum Deposit</label>
                                        <input type="text" class="form-control" name="max_deposit" id="max_deposit" value="<?php echo e($apkManager->max_deposit); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum jodi</label>
                                        <input type="text" class="form-control" name="jodi_min" id="jodi_min" value="<?php echo e($apkManager->jodi_min); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum jodi</label>
                                        <input type="text" class="form-control" name="jodi_max" id="jodi_max" value="<?php echo e($apkManager->jodi_max); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum Harruf</label>
                                        <input type="text" class="form-control" name="HarufMin" id="HarufMin" value="<?php echo e($apkManager->HarufMin); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum Harruf</label>
                                        <input type="text" class="form-control" name="HarufMax" id="HarufMax" value="<?php echo e($apkManager->HarufMax); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum Crossing</label>
                                        <input type="text" class="form-control" name="crossingMin" id="crossingMin" value="<?php echo e($apkManager->crossingMin); ?>">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum Crossing</label>
                                        <input type="text" class="form-control" name="crossingMax" id="crossingMax" value="<?php echo e($apkManager->crossingMax); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Minimum Redeem</label>
                                        <input type="text" class="form-control" name="min_redeem" id="inputEmail4" value="<?php echo e($apkManager->min_redeem); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputPassword4" class="form-label">Upi Id</label>
                                        <input type="text" class="form-control" name="upiId" id="inputPassword4" value="<?php echo e($apkManager->upiId); ?>">
                                    </div>
                                    
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance</label>
                                        <input type="text" class="form-control" name="is_app_maintainance" id="inputCity" value="<?php echo e($apkManager->is_app_maintainance); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 2</label>
                                        <input type="text" class="form-control" name="is_app_mentinance2" id="is_app_mentinance2" value="<?php echo e($apkManager->is_app_mentinance2); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 3</label>
                                        <input type="text" class="form-control" name="is_app_mentinance3" id="is_app_mentinance3" value="<?php echo e($apkManager->is_app_mentinance3); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 4</label>
                                        <input type="text" class="form-control" name="is_app_mentinance4" id="is_app_mentinance4" value="<?php echo e($apkManager->is_app_mentinance4); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 5</label>
                                        <input type="text" class="form-control" name="is_app_maintenance5" id="is_app_maintenance5" value="<?php echo e($apkManager->is_app_maintenance5); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">Version</label>
                                        <input type="text" class="form-control" name="version" id="version" value="<?php echo e($apkManager->version); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">Admin Contact Mobile</label>
                                        <input type="text" class="form-control" name="admin_contact_mob" id="inputCity" value="<?php echo e($apkManager->admin_contact_mob); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="whatsapp" class="form-label">Help line No.</label>
                                        <input type="text" class="form-control" name="help_line_number" id="help_line_number" value="<?php echo e($apkManager->help_line_number); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Imp Notice on Home</label>
                                        <input type="text" class="form-control" name="imp_notice_on_home" id="inputEmail4" value="<?php echo e($apkManager->imp_notice_on_home); ?>">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Telegram</label>
                                        <input type="text" class="form-control" name="telegram" id="inputEmail4" value="<?php echo e($apkManager->telegram); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Reffer Link</label>
                                        <input type="text" class="form-control" name="reffer_link" id="reffer_link" value="<?php echo e($apkManager->reffer_link); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Disable Market (0->Disable , 1->Enable)</label>
                                        <input type="text" class="form-control" name="market_disable" id="market_disable" value="<?php echo e($apkManager->market_disable); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Withdraw Disable (0->Disable , 1->Enable)</label>
                                        <input type="text" class="form-control" name="withdraw_disable" id="withdraw_disable" value="<?php echo e($apkManager->withdraw_disable); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Deposit Disable (0->Disable , 1->Enable)</label>
                                        <input type="text" class="form-control" name="deposit_disable" id="deposit_disable" value="<?php echo e($apkManager->deposit_disable); ?>">
                                    </div>

                                    <div class="col-md-12 form-group m-0">
                                        <label for="inputEmail4" class="form-label">How to Play</label>
                                        <input type="text" class="form-control" name="how_to_play" id="how_to_play" value="<?php echo e($apkManager->how_to_play); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Withdraw Open Time</label>
                                        <input type="time" class="form-control" name="withdraw_open_time" id="withdraw_open_time" value="<?php echo e($apkManager->withdraw_open_time); ?>">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Withdraw Close Time</label>
                                        <input type="time" class="form-control" name="withdraw_close_time" id="withdraw_close_time" value="<?php echo e($apkManager->withdraw_close_time); ?>">
                                    </div>


                                    <!-- <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Doublele Pana Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="<?php echo e($apkManager->double_pana_value2); ?>" >
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputEmail4" class="form-label">Triple Pana Value 1</label>
                                        <input type="number" class="form-control" id="inputEmail4" value="<?php echo e($apkManager->triple_pana_value1); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Triple Pana Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="<?php echo e($apkManager->triple_pana_value2); ?>">
                                    </div>
                                    
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Half Sangam Value 1</label>
                                        <input type="number" class="form-control" id="inputCity"  value="<?php echo e($apkManager->Half_Sangam_Value1); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Half Sangam Value 2</label>
                                        <input type="number" class="form-control" id="inputCity" value="<?php echo e($apkManager->Half_Sangam_Value1); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Fulll Sangam Value 1</label>
                                        <input type="number" class="form-control" id="inputCity" value="<?php echo e($apkManager->Half_Sangam_Value1); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Full Sangam Value 2</label>
                                        <input type="number" class="form-control" id="inputCity" value="<?php echo e($apkManager->Half_Sangam_Value2); ?>">
                                    </div> -->
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">Withdraw Otp</label>
                                        <input type="text" class="form-control" name="withdraw_otp" id="withdraw_otp" value="<?php echo e($apkManager->withdraw_otp); ?>">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                <!-- </form> -->
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
<script src="<?php echo e(asset('/backend/developer/js/GaliDisawar.js')); ?>"></script>
<script>

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgood/public_html/admin/resources/views/administrator/web_setting/apk_manager.blade.php ENDPATH**/ ?>