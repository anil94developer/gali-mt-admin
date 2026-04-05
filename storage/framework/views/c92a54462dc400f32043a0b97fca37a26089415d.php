<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Edit Sub Admin </h6>
                </div>
                <div class="pull-right">
                   <a href="<?php echo e(route('admin_subadmins')); ?>" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <?php echo e(Form::open(array('url' => route('admin_subadmin_edit_store'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data'))); ?>

                                <input type="hidden" name="id" value="<?php echo e($select->id); ?>">
                                <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">
                                            <input type="hidden" name="ad_id" value="<?php echo e($select->ad_id); ?>">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4"> UserName<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="userid" value="<?php echo e($select->userid); ?>" id="userid" placeholder=" Userrname">
                                                        <?php $__errorArgs = ['userid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>

                                          

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Email</label>
                                                    <div class="col-md-7">
                                                        <input disabled type="email" class="form-control" name="email"  id="email" placeholder="Email" value="<?php echo e($select->email); ?>">
                                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Mobile<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="mobile" value="<?php echo e($select->mobile); ?>" id="mobile" placeholder="mobile">
                                                        <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Password<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="password" class="form-control" name="password" value="<?php echo e($select->password); ?>" placeholder="Password"  required>
                                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Confirm Password<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="password" class="form-control" name="password_confirmation" value="<?php echo e($select->password_confirmation); ?>" placeholder="Confirm Password" required>
                                                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i><?php echo e($message); ?>

                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div> -->

                                            
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Role ID<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <div class="permission-section">
                                                    <?PHP $permission= explode(",",$select->role_id); ?>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="withdraw_managment" id="withdraw_managment" <?PHP if(in_array('withdraw_managment',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="withdraw_managment">Withdraw
                                                                    Managment</label>
                                                                <ul>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="pending_withdraw"
                                                                            id="pending_withdraw" <?PHP if(in_array('pending_withdraw',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="pending_withdraw">Pending
                                                                            Withdraw</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="success_withdraw"
                                                                            id="success_withdraw" <?PHP if(in_array('success_withdraw',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="success_withdraw">Success
                                                                            Withdraw</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="cancelled_withdraw"
                                                                            id="cancelled_withdraw" <?PHP if(in_array('cancelled_withdraw',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="cancelled_withdraw">Cancelled
                                                                            Withdraw</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="date_wise_success_withdraw"
                                                                            id="date_wise_success_withdraw" <?PHP if(in_array('date_wise_success_withdraw',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="date_wise_success_withdraw">Date
                                                                            Wise
                                                                            Success Withdraw</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="deposit_managment" id="deposit_managment"  <?PHP if(in_array('deposit_managment',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="deposit_managment">Deposit Managment</label>
                                                                <ul>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="pending_deposit"
                                                                            id="pending_deposit" <?PHP if(in_array('pending_deposit',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="pending_deposit">Pending
                                                                            Deposit</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="success_deposit"
                                                                            id="success_deposit" <?PHP if(in_array('success_deposit',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="success_deposit">Success
                                                                            Deposit</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="cancelled_deposit"
                                                                            id="cancelled_deposit" <?PHP if(in_array('cancelled_deposit',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="cancelled_deposit">Cancelled
                                                                            Deposit</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="date_wise_success_deposit"
                                                                            id="date_wise_success_deposit" <?PHP if(in_array('date_wise_success_deposit',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="date_wise_success_deposit">Date Wise
                                                                            Success Deposit</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]" value="users"
                                                                    id="users" <?PHP if(in_array('users',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="users">Users</label>
                                                                <ul>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="all_users" id="all_users" <?PHP if(in_array('all_users',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="all_users">All Users</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="inactive_users" id="inactive_users" <?PHP if(in_array('inactive_users',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="inactive_users">Inactive
                                                                            Users</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="today_users" id="today_users" <?PHP if(in_array('today_users',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="today_users">Today Users</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="today_online_users"
                                                                            id="today_online_users" <?PHP if(in_array('today_online_users',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="today_online_users">Today Online
                                                                            Users</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="user_game_report"
                                                                            id="user_game_report" <?PHP if(in_array('user_game_report',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="user_game_report">User Game
                                                                            Report</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="game_load" id="game_load" <?PHP if(in_array('game_load',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="game_load">Game Load</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="notice_managment" id="notice_managment" <?PHP if(in_array('notice_managment',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="notice_managment">Notice Managment</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="manage_result" id="manage_result" <?PHP if(in_array('manage_result',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="manage_result">Manage Result</label>
                                                                <ul>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="update_result" id="update_result" <?PHP if(in_array('update_result',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="update_result">Update Result</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="winner_number" id="winner_number" <?PHP if(in_array('winner_number',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="winner_number">Winner Number</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="user_commission" id="user_commission" <?PHP if(in_array('user_commission',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="user_commission">User Commission</label>
                                                                <ul>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="users_commision"
                                                                            id="users_commision" <?PHP if(in_array('users_commision',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="users_commision">User
                                                                            Commission</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="user_commission_pay_list"
                                                                            id="user_commission_pay_list" <?PHP if(in_array('user_commission_pay_list',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="user_commission_pay_list">User
                                                                            Commission Pay List</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="game_managment" id="game_managment"  <?PHP if(in_array('game_managment',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="game_managment">Game Managment</label>
                                                                <ul>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="game_name_list" id="game_name_list" <?PHP if(in_array('game_name_list',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="game_name_list">Game Name
                                                                            List</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="bid_history_list"
                                                                            id="bid_history_list" <?PHP if(in_array('bid_history_list',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="bid_history_list">Bid History
                                                                            List</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="declare_result_list"
                                                                            id="declare_result_list" <?PHP if(in_array('declare_result_list',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="declare_result_list">Declare Result
                                                                            List</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="winning_report_list"
                                                                            id="winning_report_list" <?PHP if(in_array('winning_report_list',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="winning_report_list">Winning Report
                                                                            List</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="faq_manage" id="faq_manage" <?PHP if(in_array('faq_manage',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="faq_manage">Faq Manage</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="payment_getway" id="payment_getway" <?PHP if(in_array('payment_getway',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="payment_getway">Payment Getway</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="user_reffer_list" id="user_reffer_list" <?PHP if(in_array('user_reffer_list',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="user_reffer_list">User Reffer List</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="user_wallet_data" id="user_wallet_data" <?PHP if(in_array('user_wallet_data',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="user_wallet_data">User Wallet Data</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="we_setting_manage" id="we_setting_manage" <?PHP if(in_array('we_setting_manage',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="we_setting_manage">Web Setting
                                                                    Manage</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="dashboard" id="dashboard" <?PHP if(in_array('dashboard',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="dashboard">Dashboard</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 border-1">
                                                            <div class="permission-item">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="subadmin" id="subadmin" <?PHP if(in_array('subadmin',$permission)): echo 'checked'; endif; ?>>
                                                                <label for="subadmin">Sub Admin</label>
                                                                <ul>
                                                                    <li>
                                                                        <input type="checkbox" name="permission[]"
                                                                            value="subadmin_child" id="subadmin_child" <?PHP if(in_array('subadmin_child',$permission)): echo 'checked'; endif; ?>>
                                                                        <label for="subadmin_child">Sub Admin</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                </div>
                                    </div>
                                    <div class="form-actions mt-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-success  mr-10">Submit</button>
                                                        <button type="reset" class="btn btn-default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
                                        </div>
                                    </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .permission-section {
        padding: 10px 0;
    }

    .permission-item {
        margin-bottom: 10px;
        /* border: 1px solid; */
        padding: 5px;
        /* border-radius: 5px; */
    }

    .permission-item ul {
        margin: 5px 0 0 20px;
        padding: 0;
        list-style-type: none;
    }

    .permission-item input[type="checkbox"] {
        margin-right: 5px;
    }

    .permission-item label {
        font-size: 16px;
        color: #333;
    }

    .permission-item {
        border: 1px solid;
        padding: 5px;
        border-radius: 5px;
    }
    .form-group input {
        width: auto;
        height: auto;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('/backend/developer/js/subAdmin.js')); ?>"></script>
<script>
        // $('input[type=checkbox]').click(function () {
        //     // children checkboxes depend on current checkbox
        //     $(this).next().find('input[type=checkbox]').prop('checked', this.checked);
        //     // go up the hierarchy - and check/uncheck depending on number of children checked/unchecked
        //     $(this).parents('ul').prev('input[type=checkbox]').prop('checked', function () {
        //         return $(this).next().find(':checked').length;
        //     });
        // });

        $(document).ready(function () {
            function updateParentCheckbox(checkbox) {
                var parentCheckbox = checkbox.parents('ul').prev('input[type=checkbox]');

                // Get the count of checked checkboxes and total checkboxes (children)
                var checkedCount = checkbox.parents('ul').find('input[type=checkbox]:checked').length;
                var totalCount = checkbox.parents('ul').find('input[type=checkbox]').length;

                // If all children are checked, set the parent checkbox to checked
                if (checkedCount === totalCount) {
                    parentCheckbox.prop('checked', true).prop('indeterminate', false);
                }
                // If none of the children are checked, set the parent checkbox to unchecked
                else if (checkedCount === 0) {
                    parentCheckbox.prop('checked', false).prop('indeterminate', false);
                }
                // If some children are checked, set the parent checkbox to indeterminate
                else {
                    parentCheckbox.prop('checked', false).prop('indeterminate', true);
                }
            }

            $('input[type=checkbox]').click(function () {
                var checkbox = $(this);

                // If the checkbox has child checkboxes (nested <ul>), update their state
                if (checkbox.siblings('ul').length > 0) {
                    var isChecked = checkbox.prop('checked');
                    checkbox.siblings('ul').find('input[type=checkbox]').prop('checked', isChecked).prop('indeterminate', false);
                }

                // Update the parent checkbox state
                updateParentCheckbox(checkbox);
            });

            // Update parent checkbox state whenever any checkbox state changes
            $('input[type=checkbox]').change(function () {
                var checkbox = $(this);
                updateParentCheckbox(checkbox);
            });

            // On page load, initialize all parent checkboxes based on their children's state
            $('input[type=checkbox]').each(function () {
                updateParentCheckbox($(this));
            });
        });



    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('administrator.layout.administrator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminmatka/public_html/resources/views/administrator/subadmin/edit.blade.php ENDPATH**/ ?>