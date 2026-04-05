<?PHP
$url = Request::segment(2);
$url1 = Request::segment(3);
$dashboardManagement = ['dashboard'];
$ankreportManagement = ['ank-report'];
$useripManagement = ['user-ip-list'];
$gamesManagement = ['gamemarket-name-list','gamemarket-rate-list'];
$declareresultManagement = ['result-list'];
$winningpredictionManagement = ['winning-prediction-list'];
$reportManagement = ['user-bidthistory-list','customer-sell-report-list','winningreport-list','transport-point-report-list','bid-winning-report-list','withdraw-report-list','add-fund-report-list','auto-deposit-history-list'];
$walletManagement = ['fund-request-list','withdraw-request-list','add-fund','bid-revert'];
$gameandnumberManagement = ['single-digit','jodi-digit','single-panna','double-panna','triple-panna','half-sangam','full-sangam'];
$noticeManagement = ['notice-list','add-notice'];
$starlineManagement = ['game-name-list','game-rate-list','bid-history-list','declare-result-list','result-history-list','sell-report-list','winning-report-list','winning-prediction'];
$galidisawarManagement = ['gali-disawar-game-name-list','gali-disawar-game-rate-list','gali-disawar-bid-history-list','gali-disawar-declare-result-list','gali-disawar-result-history-list','gali-disawar-sell-report-list','gali-disawar-winning-report-list','gali-disawar-winning-prediction'];
$depositManagementOld = ['deposit-pending-old','deposit-cancelled-old','deposit-success-old'];
$userqueriesManagement = ['user-queries'];
$depositManagement = ['deposit-pending','deposit-cancelled','deposit-success'];
$withdrawManagement = ['deposit-pending','deposit-cancelled','deposit-success'];
$websettingManagement = ['banner','app-image','apk-manager','video','page'];
$subAdminManagement = ['subadmin-list'];
$settingManagement = ['accont-list','setting-list','slider-list','how-to-play-list','setting-page'];
$adminrolesmodulesManagement = ['admin-group-roles','admin-list','admin-add'];
$subadminsManagement = ['sub-admin-list'];
$ServicesManagement = ['Services'];
$slidersManagement = ['category-list', 'category'];
$subcategoryManagement = ['sub-category-list', 'sub-category'];
$eventsManagement = ['events', 'events-list'];
$quotesManagement = ['callback-request', 'callback-request-list'];
$productManagement = ['product', 'product-list'];
$contactManagement = ['contact-us', 'contact-us-list'];
$newsletterManagement = ['newsletter-list'];
$teanManagement = ['page-list', 'page'];
$generalSettingManagement = ['general-setting'];
$admincontrolsettingManagement = ['admin-setting'];
$usersManagement = ['unapprove-user-list','active-user-list','inactive-user-list','playing-user-list','notplaying-user-list','online-user-list'];
$menusManagement = ['income-setting-list', 'level-list', 'repurchase-list'];
$projectsManagement = ['gallery-list', 'gallery'];
$EventManagement = ['aseenno-list', 'aseenno'];
$IndustriesManagement = ['demo-list', 'demo'];
//$mediaManagement=['meadia-list', 'meadia'];
$postManagement = ['blog-category-list', 'blog-category', 'blog-list', 'blog'];
$PartnersManagement = ['feedback-list', 'feedback'];
$supportManagement = ['support-list', 'support', 'add new'];
$subAdminManagement = ['sub-admin-list', 'sub-admin'];
$testimonialsManagement = ['review-list', 'review'];
$withdrawManagement = ['withdraw'];
$depositeManagement = ['deposite'];
$WinnerManagement = ['Winner'];
$gameManagement = ['game'];
$metaSeoManagement = ['pending-list', 'ongoing-list', 'complete-list', 'cancelled-list', 'package-view', 'all-list'];
$markatManagement = ['market'];
$paymentGetwayManagement = ['payment-getway'];
$gameload = [''];
$toptenuser = ['top-ten-user'];
$usercsv = ['user-csv'];
$userData=Session::get('user_adata');
?>

<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="<?PHP if (in_array($url, $dashboardManagement)) { echo ""; } ?>" href="<?php echo e(route('admin_dashboard')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">Dashboard</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
       
        
        
        <?php if(Helper::check_permission($userData->id,'users')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $usersManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#userm">
                <div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">Users</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="userm" class=" collapse-level-1  collapse <?PHP if (in_array($url, $usersManagement)) { echo "in"; } ?>">
            <?php if(Helper::check_permission($userData->id,'all_users')): ?>
                <li>
                    <!-- <a href="<?php echo e(route('unapprove_user')); ?>">Un Approved Users</a> -->
                    <a href="<?php echo e(route('active_user')); ?>">Active Users</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'inactive_users')): ?>
                <li>
                    <a href="<?php echo e(route('Inactive_user')); ?>">InActive Users</a>
                </li>
            <?php endif; ?>
                <!-- <li>
                    <a href="<?php echo e(route('playing_user')); ?>">Playing Users</a>
                </li> -->
                
            <?php if(Helper::check_permission($userData->id,'today_users')): ?>
                <li>
                    <a href="<?php echo e(route('today_user')); ?>">Today Users</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'today_online_users')): ?>
                <li>
                    <a href="<?php echo e(route('online_user')); ?>">Today Online Users</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'user_game_report')): ?>
                <li>
                    <a href="<?php echo e(route('user_game_report_list')); ?>">Users Game Report</a>
                </li>
            <?php endif; ?>
            <li>
                    <a href="<?php echo e(route('UserRefferReport')); ?>">Users Reffer Report</a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        
        <!-- <li>
            <a class="<?PHP if (in_array($url, $useripManagement)) { echo ""; } ?>" href="<?php echo e(route('user_ip')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">User Ip List</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li> -->
       

         <!--  changed on 08-02-2023-->
         
    <!--changes end -->

    
        <!-- <li>
            <a class="<?PHP if (in_array($url, $declareresultManagement)) { echo ""; } ?>" href="<?php echo e(route('result_list')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">Declare Result</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li> -->
        

        <!-- <li>
            <a class="<?PHP if (in_array($url, $reportManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#reportm">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Report Management</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="reportm" class=" collapse-level-1  collapse <?PHP if (in_array($url, $reportManagement)) { echo "in"; } ?>">
                <li>
                    <a href="<?php echo e(route('user_bidhistory')); ?>">User bidhistory list</a>
                </li>
                <li>
                    <a href="<?php echo e(route('customer_sell_report')); ?>">Customer sell Report List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('winning_report_list')); ?>">Winning Report list</a>
                </li>
               
                <li>
                    <a href="<?php echo e(route('bid_winning_report')); ?>">Bid Winning Report List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('withdraw_report')); ?>">Withdraw Report List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('add_fund_report')); ?>">Add Fund Report List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('auto_deposit_history')); ?>">Auto Deposit History List</a>
                </li>
            </ul>
        </li> -->
        <?php if(Helper::check_permission($userData->id,'withdraw_managment')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $withdrawManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#noticemm">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Withdraw Management</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="noticemm" class=" collapse-level-1  collapse <?PHP if (in_array($url, $withdrawManagement)) { echo "in"; } ?>">
                <?php if(Helper::check_permission($userData->id,'pending_withdraw')): ?>
                <li>
                    <a href="<?php echo e(route('withdraw_pending')); ?>">Pending</a>
                </li>
                <?php endif; ?>
                <?php if(Helper::check_permission($userData->id,'success_withdraw')): ?>
                <li>
                    <a href="<?php echo e(route('withdraw_success_list')); ?>">Success</a>
                </li>
                <?php endif; ?>
                <?php if(Helper::check_permission($userData->id,'cancelled_withdraw')): ?>
                <li>
                    <a href="<?php echo e(route('withdraw_cancelled_list')); ?>">Cancelled</a>
                </li>
                <?php endif; ?>
                <?php if(Helper::check_permission($userData->id,'date_wise_success_withdraw')): ?>
                <li>
                    <a href="<?php echo e(route('withdraw_dateway_pending_list')); ?>">Date Wise Success</a>
                </li>
                <?php endif; ?>
                <!-- <li>
                    <a href="<?php echo e(route('add_notice')); ?>">Notice Add</a>
                </li> -->
            </ul>
        </li>
        <?php endif; ?>

        <?php if(Helper::check_permission($userData->id,'deposit_managment')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $depositManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#noticem11">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Deposit Management</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="noticem11" class=" collapse-level-1  collapse <?PHP if (in_array($url, $depositManagement)) { echo "in"; } ?>">
                <?php if(Helper::check_permission($userData->id,'pending_deposit')): ?>
                <li>
                    <a href="<?php echo e(route('deposit_pending')); ?>">Pending</a>
                </li>
                <?php endif; ?>
                <?php if(Helper::check_permission($userData->id,'success_deposit')): ?>
                <li>
                    <a href="<?php echo e(route('deposit_success')); ?>">Success</a>
                </li>
                <?php endif; ?>

                
                <?php if(Helper::check_permission($userData->id,'cancelled_deposit')): ?>
                <li>
                    <a href="<?php echo e(route('deposit_cancelled')); ?>">Cancelled</a>
                </li>
                <?php endif; ?>
                <?php if(Helper::check_permission($userData->id,'date_wise_success_deposit')): ?>
                <li>
                    <a href="<?php echo e(route('deposit_dateway_pending')); ?>">Date Wise Success</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        
        <!-- Old Deposit Management -->
      
        <!-- Old Deposit Management -->

        
        <!-- <li>
            <a class="<?PHP if (in_array($url, $gameandnumberManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#gameanm">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Game and Number</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="gameanm" class=" collapse-level-1  collapse <?PHP if (in_array($url, $gameandnumberManagement)) { echo "in"; } ?>">
                <li>
                    <a href="<?php echo e(route('single_digit')); ?>">Single Digit</a>
                </li>
                <li>
                    <a href="<?php echo e(route('jodi_digit')); ?>">Jodi Digit</a>
                </li>
                <li>
                    <a href="<?php echo e(route('single_panna')); ?>">Single Panna</a>
                </li>
                <li>
                    <a href="<?php echo e(route('double_panna')); ?>">Double Panna</a>
                </li>
                <li>
                    <a href="<?php echo e(route('triple_panna')); ?>">Triple Panna</a>
                </li>
                <li>
                    <a href="<?php echo e(route('half_sangam')); ?>">Half Sangam</a>
                </li>
                <li>
                    <a href="<?php echo e(route('full_sangam')); ?>">Full Sangam</a>
                </li>
            </ul>
        </li> -->
        <?php if(Helper::check_permission($userData->id,'game_load')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $gameload)) { echo ""; } ?>" href="<?php echo e(route('game_load_list')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">Game Load</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php endif; ?>
        <!-- <li>
            <a class="<?PHP if (in_array($url, $gameload)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#gameload">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Game Load</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="gameload" class=" collapse-level-1  collapse <?PHP if (in_array($url, $gameload)) { echo "in"; } ?>">
                <li>
                    <a href="<?php echo e(route('game_load_list')); ?>">Main Market Load</a>
                </li>
                
            </ul>
        </li> -->
        <?php if(Helper::check_permission($userData->id,'notice_managment')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $noticeManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#noticem">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Notice Management</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="noticem" class=" collapse-level-1  collapse <?PHP if (in_array($url, $noticeManagement)) { echo "in"; } ?>">
                
                <li>
                    <a href="<?php echo e(route('app_notice_list')); ?>">App Notice List</a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        
        <?php if(Helper::check_permission($userData->id,'manage_result')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $galidisawarManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#managmarket">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Manage Result</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="managmarket" class=" collapse-level-1  collapse <?PHP if (in_array($url, $galidisawarManagement)) { echo "in"; } ?>">
            <?php if(Helper::check_permission($userData->id,'update_result')): ?>
                <li>
                    <a href="<?php echo e(route('update_result_index')); ?>">Update Result</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'winner_number')): ?>  
                <li>
                    <a href="<?php echo e(route('winner_number_index')); ?>">Winner Number</a>
                </li>
            <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if(Helper::check_permission($userData->id,'user_commission')): ?>  
        <li>
            <a class="<?PHP if (in_array($url, $galidisawarManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#usercomm">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">User Commission</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="usercomm" class=" collapse-level-1  collapse <?PHP if (in_array($url, $galidisawarManagement)) { echo "in"; } ?>">
            <?php if(Helper::check_permission($userData->id,'users_commision')): ?>  
                <li>
                    <a href="<?php echo e(route('user_comm_index')); ?>">User Commission</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'user_commission_pay_list')): ?>  
                <li>
                    <a href="<?php echo e(route('usercommissionpaylist')); ?>">User Commission pay list</a>
                </li>
            <?php endif; ?>
                
            </ul>
        </li>
        <?php endif; ?>


        <?php if(Helper::check_permission($userData->id,'game_managment')): ?>  
        <li>
            <a class="<?PHP if (in_array($url, $galidisawarManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#galidisawarm">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Game Management</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="galidisawarm" class=" collapse-level-1  collapse <?PHP if (in_array($url, $galidisawarManagement)) { echo "in"; } ?>">
            <?php if(Helper::check_permission($userData->id,'game_name_list')): ?> 
                <li>
                    <a href="<?php echo e(route('gali_disawar_game_name_list')); ?>">Game Name List</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'bid_history_list')): ?> 
                <li>
                    <a href="<?php echo e(route('gali_disawar_bid_history')); ?>">Bid History List</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'declare_result_list')): ?> 
                <li>
                    <a href="<?php echo e(route('gali_disawar_declare_result')); ?>">Declare Result List</a>
                </li>
            <?php endif; ?>
            <?php if(Helper::check_permission($userData->id,'winning_report_list')): ?> 
                <li>
                    <a href="<?php echo e(route('gali_disawar_winning_report')); ?>">Winning Report List</a>
                </li>
            <?php endif; ?>   
            </ul>
        </li>
        <?php endif; ?>
        <!-- <li>
            <a class="<?PHP if (in_array($url, $userqueriesManagement)) { echo ""; } ?>" href="<?php echo e(route('user_queries')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">User queries</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li> -->
        <?php if(Helper::check_permission($userData->id,'faq_manage')): ?> 
        <li>
            <a class="<?PHP if (in_array($url, $ankreportManagement)) { echo ""; } ?>" href="<?php echo e(route('faqindex')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">Faq Manage</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Helper::check_permission($userData->id,'payment_getway')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $paymentGetwayManagement)) { echo ""; } ?>" href="<?php echo e(route('index_page')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">Payment Getway</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Helper::check_permission($userData->id,'user_reffer_list')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $toptenuser)) { echo ""; } ?>" href="<?php echo e(route('top_ten_user')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">User Reffer List</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Helper::check_permission($userData->id,'user_wallet_data')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $usercsv)) { echo ""; } ?>" href="<?php echo e(route('userwallet_report')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">User wallet Data</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Helper::check_permission($userData->id,'we_setting_manage')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $websettingManagement)) { echo ""; } ?>" href="<?php echo e(route('apk_manager')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">Web Setting Manage</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Helper::check_permission($userData->id,'subadmin')): ?>
        <li>
            <a class="<?PHP if (in_array($url, $subAdminManagement)) { echo ""; } ?>" href="<?php echo e(route('admin_subadmins')); ?>">
                <div class="pull-left"><i class="fa fa-tachometer mr-20"></i><span class="right-nav-text">SubAdmin</span></div>
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php endif; ?>



       
        
        <!-- <li>
            <a class="<?PHP if (in_array($url, $settingManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#settingm">
                <div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Setting</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="settingm" class=" collapse-level-1  collapse <?PHP if (in_array($url, $settingManagement)) { echo "in"; } ?>">
                <li>
                    <a href="<?php echo e(route('account')); ?>">Account List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('setting')); ?>">Setting List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('slider')); ?>">Slider List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('how_To_Play')); ?>">How to Play List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('setting_page')); ?>">Page</a>
                </li>
            </ul>
        </li> -->
        <!-- <li>
            <a class="<?PHP if (in_array($url, $adminrolesmodulesManagement)) { echo ""; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#adminrolesmodules">
                <div class="pull-left"><i class="fa fa-google-wallet mr-20"></i><span class="right-nav-text">Admin & Roles Modules</span></div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i><span class="label label-success"></span></div>
                <div class="clearfix"></div>
            </a>
            <ul id="adminrolesmodules" class=" collapse-level-1  collapse <?PHP if (in_array($url, $adminrolesmodulesManagement)) { echo "in"; } ?>">
                <li>
                    <a href="<?php echo e(route('admin_group_roles')); ?>">Admin Group Roles</a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin_list')); ?>">Admin List</a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin_add')); ?>">Admin Add</a>
                </li>
            </ul>
        </li> -->

        <li>
            <hr class="light-grey-hr mb-10" />
        </li>

        
    </ul>
</div><?php /**PATH /home/admin.playonlineds.net/public_html/resources/views/administrator/includes/left_sidebar.blade.php ENDPATH**/ ?>