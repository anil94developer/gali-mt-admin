<?php
date_default_timezone_set('Asia/Kolkata');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GetwayController;

//admin controllers
use App\Http\Controllers\Administrator\PasswordController;
use App\Http\Controllers\Administrator\DashboardController;
use App\Http\Controllers\Administrator\SubAdminController;
use App\Http\Controllers\Administrator\SubAdminsController;
use App\Http\Controllers\Administrator\LoginController;
use App\Http\Controllers\Administrator\AdminController;
use App\Http\Controllers\Administrator\MarketController;
use App\Http\Controllers\Administrator\StarlineMarketController;
use App\Http\Controllers\Administrator\TransactionHistoryController;
use App\Http\Controllers\Administrator\ReportController;
use App\Http\Controllers\Administrator\PointController;
use App\Http\Controllers\Administrator\CheakgameController;
use App\Http\Controllers\Administrator\FaqController;
use App\Http\Controllers\Administrator\AnkreportController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\Administrator\GameManageController;
use App\Http\Controllers\Administrator\ResultController;
use App\Http\Controllers\Administrator\WinningPredictionController;
use App\Http\Controllers\Administrator\WalletController;
use App\Http\Controllers\Administrator\GameAndNumberController;
use App\Http\Controllers\Administrator\NoticeController;
use App\Http\Controllers\Administrator\StarlineController;
use App\Http\Controllers\Administrator\WithdrawManageController;
use App\Http\Controllers\Administrator\DepositManagementController;
use App\Http\Controllers\Administrator\DepositManagementOldController;
use App\Http\Controllers\Administrator\GaliDisawarController;
use App\Http\Controllers\Administrator\UserQueriesController;
use App\Http\Controllers\Administrator\WebSettingController;
use App\Http\Controllers\Administrator\SettingController;
use App\Http\Controllers\Administrator\AdminRolsModuleController;
use App\Http\Controllers\Administrator\GameLoadController;
use App\Http\Controllers\Administrator\ManageMarketController;
use App\Http\Controllers\Administrator\UserCommissionController;
use App\Http\Controllers\Administrator\PaymentGetwayController;
use App\Http\Controllers\Administrator\ScannerPaymentController;
use App\Http\Controllers\Administrator\CsvController;
use App\Http\Controllers\GetwayNewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
  Artisan::call('cache:clear');
  return "Cache is cleared";
});
Route::get('/config-clear', function () {
  Artisan::call('config:clear');
  Artisan::call('config:cache');
  return "config is cleared";
});

//front home page
Route::get('/', [HomeController::class, 'index']);
Route::get('/help', [HomeController::class, 'help']);
// Route::get('test-income', [HomeController::class, 'income_percent']);
Route::get('/results-data', [GetwayController::class, 'resultsss'])->name('results.index');
Route::get('/product/product-list', [PageController::class, 'product_list']);
Route::get('/product/details/wishlist', [PageController::class, 'wishlist']);
Route::get('/product/cart', [PageController::class, 'cart']);
Route::get('/product/checkout', [PageController::class, 'checkout']);
Route::get('/about-us', [PageController::class, 'about_us']);
Route::get('/blog', [PageController::class, 'blog']);
Route::get('/blog/blog-details', [PageController::class, 'blog_details']);
Route::get('/contact-us', [PageController::class, 'contact_us']);
Route::get('/term-conditions', [PageController::class, 'term_conditions']);
Route::get('/privacy-policy', [PageController::class, 'privacy_policy']);
Route::get('/privacy-policy-page', [PageController::class, 'privacy_policynew']);
Route::get('/contact-us-page', [PageController::class, 'contact_us_result']);
Route::get('/resultPage', [PageController::class, 'resultPage']);
Route::get('/faq-page', [PageController::class, 'faqPage']);

Route::get('/my-account', [PageController::class, 'my_account']);
Route::get('/my-address', [PageController::class, 'my_address']);
Route::get('/my-order', [PageController::class, 'my_order']);
Route::get('/orders', [PageController::class, 'orders']);
Route::get('/success', [PageController::class, 'success']);
Route::get('/change-password', [PageController::class, 'change_password']);
Route::get('/market-delete-result-table', [PageController::class, 'market_delete_result_table']);

Route::get('/payment-getway', [GetwayController::class, 'payment_getway2']);
Route::get('/payment-getway2', [GetwayNewController::class, 'payment_getway2']);
Route::any('getway-call-back-payment', [GetwayController::class, 'getway_callback']);
Route::get('redirect-payment', [GetwayController::class, 'redirect_payment']);

// Compatibility aliases (for deployments hitting "/public/*" directly)
Route::get('/public/payment-getway', [GetwayController::class, 'payment_getway2']);
Route::get('/public/payment-getway2', [GetwayNewController::class, 'payment_getway2']);
Route::any('/public/getway-call-back-payment', [GetwayController::class, 'getway_callback']);
Route::get('/public/redirect-payment', [GetwayController::class, 'redirect_payment']);

Route::any('user/upload-reciept', [GetwayController::class, 'upload_reciept']);

Route::get('/manual-recharge-store', [GetwayController::class, 'manualDeposit']);
Route::post('/user/manual-upload-recharge-store', [GetwayController::class, 'manual_upload_Deposit']);

/*chat-api's*/
Route::post('/chatstore', [HomeController::class, 'chatstore']);
Route::post('/chatstore-audio', [HomeController::class, 'chatstoreAudio']);
Route::post('/chatlist', [HomeController::class, 'chatlist']);

Auth::routes();
Route::group(['namespace' => 'Administrator', 'prefix' => 'administrator'], function () {
  Route::get('/', [LoginController::class, 'index'])->name('admin_index_page');
  Route::post('/authenticate', [LoginController::class, 'authenticate']);
  Route::post('/admin-login-otp', [LoginController::class, 'LoginOTP']);
  Route::get('/logout', [LoginController::class, 'logout'])->name('admin_logout');
  Route::get('/forget-password', [LoginController::class, 'forget_pass'])->name('admin_forget_pass');
  Route::post('/link-forget-password', [LoginController::class, 'forget_pass_send_link'])->name('admin_link_forget_pass');
  Route::get('/forget-change-password/{token}', [LoginController::class, 'forget_pass_token'])->name('admin_forget_pass_token');
  Route::post('/update-new-password', [LoginController::class, 'update_forget_pass'])->name('admin_update_forget_pass');
});


Route::group(['namespace' => 'Administrator', 'prefix' => 'administrator', 'middleware' => ['auth.administrator:administrator']], function () {

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');

  //////////////////////////////////////////////OLD ROUTE//////////////////////////////////////////////
  Route::get('/change-password', [PasswordController::class, 'change_password'])->name('admin_change_pass');
  Route::post('/update-change-password', [PasswordController::class, 'update_change_password'])->name('admin_update_change_pass');

  Route::get('/product', [ProductController::class, 'index'])->name('product_index');
  Route::get('/product-create', [ProductController::class, 'create'])->name('product_create');
  Route::post('/product-store', [ProductController::class, 'store'])->name('product_store');
  Route::post('/product/getproductData', [ProductController::class, 'getproductData'])->name('admin_getproductData');
  Route::get('/product/view/{id}', [ProductController::class, 'view']);
  Route::get('/product/delete/{id}', [ProductController::class, 'delete']);
  Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
  Route::post('/product/edit-store', [ProductController::class, 'edit_store']);


  //sub admin
  Route::get('/subadmin-list', [SubAdminsController::class, 'index'])->name('admin_subadmins');
  Route::get('/subadmin-create', [SubAdminsController::class, 'create'])->name('admin_create');
  Route::post('/subadmin-store', [SubAdminsController::class, 'store'])->name('subadmin_store');
  Route::post('/subadmin/getsubadminsData', [SubAdminsController::class, 'getsubadminsData'])->name('admin_getsubadminsData');
  Route::get('/subadmin/view/{id}', [SubAdminsController::class, 'view'])->name('admin_subadmin_view');
  Route::get('/subadmin/delete/{id}', [SubAdminsController::class, 'delete'])->name('admin_subadmin_delete');
  Route::get('/subadmin/edit/{id}', [SubAdminsController::class, 'edit'])->name('admin_subadmin_edit');
  Route::post('/subadmin/edit-store', [SubAdminsController::class, 'edit_store'])->name('admin_subadmin_edit_store');
  Route::post('/active/getSubAdminData', [SubAdminController::class, 'getactive_user_Data'])->name('getactive_user_Data');
  Route::get('/user/update-status/{id}', [SubAdminController::class, 'update_status'])->name('update_status');
  Route::get('/user/delete/{id}', [SubAdminController::class, 'delete_data'])->name('delete_data');


  // Sub-Admin Controller as a user
  Route::get('/sub-admin-list', [SubAdminController::class, 'index'])->name('admin_sub_admin');
  Route::get('/block-user-list', [SubAdminController::class, 'block_user_list'])->name('block_user_list');
  Route::post('/withdraw/store', [SubAdminController::class, 'withdraw_store'])->name('withdraw_store');
  Route::post('/deposit/store', [SubAdminController::class, 'deposit_store'])->name('deposit_store');
  Route::get('/today-user-list', [SubAdminController::class, 'today_user_list'])->name('today_user_list');
  Route::post('/today/getTodayuserData', [SubAdminController::class, 'getTodayuserData'])->name('admin_getTodayuserData');


  Route::post('/sub-admin/getSubAdminData', [SubAdminController::class, 'getSubAdminData'])->name('admin_getSubAdminData');
  Route::post('/block/getSubAdminData', [SubAdminController::class, 'getblock_user_Data'])->name('getblock_user_Data');
  Route::get('/sub-admin/create', [SubAdminController::class, 'create'])->name('admin_sub_admin_create');
  Route::post('/sub-admin/store', [SubAdminController::class, 'store'])->name('admin_sub_admin_store');
  Route::get('/sub-admin/edit/{id}', [SubAdminController::class, 'edit'])->name('admin_sub_admin_edit');
  Route::post('/sub-admin/edit-update', [SubAdminController::class, 'edit_update'])->name('admin_sub_admin_edit_store');
  Route::get('/sub-admin/view/{id}', [SubAdminController::class, 'view'])->name('admin_sub_admin_view');
  Route::get('/sub-admin/delete/{id}', [SubAdminController::class, 'delete'])->name('admin_sub_admin_delete');
  Route::get('/sub-admin/change-password/{id}', [SubAdminController::class, 'change_password'])->name('admin_sub_admin_change_password');
  Route::post('/sub-admin/store-change-password', [SubAdminController::class, 'store_change_password'])->name('admin_sub_admin_store_change_password');
  Route::post('/get-user-list', [SubAdminController::class, 'get_user_list'])->name('admin_sub_admin_get_user_list');
  Route::post('/get-user-detail', [SubAdminController::class, 'get_user_detail'])->name('admin_sub_admin_get_user_detail');
  Route::get('/trash-sub-admin-list', [SubAdminController::class, 'trash_index'])->name('admin_trash_sub_admin');
  Route::post('/sub-admin/getTrashSubAdminData', [SubAdminController::class, 'getTrashSubAdminData'])->name('admin_getTrashSubAdminData');
  Route::get('/sub-admin/restore/{id}', [SubAdminController::class, 'restore'])->name('admin_sub_admin_restore');
  Route::get('/sub-admin/update-status/{id}', [SubAdminController::class, 'updateStatus'])->name('admin_sub_admin_updateStatus');

  //point controller
  Route::get('/withdraw-point/list', [PointController::class, 'withdraw_point_list'])->name('withdraw_point_list');
  Route::post('/withdraw_point/getpointData', [PointController::class, 'get_withdraw_point'])->name('get_withdraw_point');
  Route::get('/withdraw-pending-point/list', [PointController::class, 'withdraw_pending_point_list'])->name('withdraw_pending_point_list');
  Route::get('/withdraw/update-pending/{id}', [PointController::class, 'update_pending'])->name('admin_withdraw_update_pending');
  Route::get('/withdraw/update-success/{id}', [PointController::class, 'update_success'])->name('admin_withdraw_update_success');


  Route::post('/withdraw_pending_point/getPendingpointData', [PointController::class, 'get_withdraw_pending_point'])->name('get_withdraw_pending_point');
  Route::get('/withdraw-success-point/list', [PointController::class, 'withdraw_success_point_list'])->name('withdraw_success_point_list');
  Route::post('/withdraw_success_point/getSuccesspointData', [PointController::class, 'get_withdraw_Success_point'])->name('get_withdraw_Success_point');
  Route::get('/withdraw-reject-point/list', [PointController::class, 'withdraw_reject_point_list'])->name('withdraw_reject_point_list');
  Route::post('/withdraw_reject_point/getRejectpointData', [PointController::class, 'get_withdraw_reject_point'])->name('get_withdraw_reject_point');



  Route::get('/deposit-point/list', [PointController::class, 'deposit_point_list'])->name('deposit_point_list');
  Route::post('/deposit_point/getpointData', [PointController::class, 'get_deposit_point'])->name('get_deposit_point');

  //winner
  Route::get('/winner-point/list', [PointController::class, 'winner_point_list'])->name('winner_point_list');
  Route::post('/winner_point/getpointData', [PointController::class, 'get_winner_point'])->name('get_winner_point');

  //bet information
  Route::get('/bet-point/list', [PointController::class, 'bet_list'])->name('bet_list');
  Route::get('/bet-report', [PointController::class, 'bet_report'])->name('bet_report');
  Route::post('/bet_point/getpointData', [PointController::class, 'get_bet_point'])->name('get_bet_point');
  Route::post('/bet_point/number-update', [PointController::class, 'bet_number_update'])->name('bet_number_update');

  Route::get('/point-withdraw/accpet/{id}', [PointController::class, 'accept_withdraw'])->name('accept_withdraw');
  Route::get('/point-withdraw/declined/{id}', [PointController::class, 'declined_withdraw'])->name('declined_withdraw');

  Route::get('/admin-info', [AdminController::class, 'admin_info'])->name('admin_info');
  Route::get('/admin-control-setting', [AdminController::class, 'admin_control_setting'])->name('admin_control_setting');
  Route::post('/admin-control-setting-store', [AdminController::class, 'admin_control_setting_store'])->name('admin_control_setting_store');


  //admin setting
  Route::get('/admin-setting', [AdminController::class, 'admin_setting'])->name('admin_setting');
  Route::get('/profit-loss-list', [PointController::class, 'profit_loss_list'])->name('profit_loss_list');
  Route::get('/monthly-profit-loss-list', [PointController::class, 'monthly_profit_loss_list'])->name('monthly_profit_loss_list');



  Route::get('/bonus/view/{slug1}', [PointController::class, 'bonus_view'])->name('bonus_view');
  Route::get('/bonus/pay/{slug1}', [PointController::class, 'pay_bonus'])->name('pay_bonus');
  Route::get('/bonus-market/view/{slug1}', [PointController::class, 'bonus_market_view'])->name('bonus_market_view');
  Route::post('/admin-setting-store', [AdminController::class, 'admin_setting_store'])->name('admin_setting_store');
  Route::post('/bonus/getchildData', [PointController::class, 'getchildData'])->name('getchildData');
  Route::post('/bonus/getMarketData', [PointController::class, 'getMarketData'])->name('getMarketData');
  Route::post('/report/getPlData', [PointController::class, 'getPlData'])->name('getPlData');
  Route::post('report/getMPlData', [PointController::class, 'getMPlData'])->name('getMPlData');
  Route::get('pl-market/view/{slug1}', [PointController::class, 'pl_merket'])->name('pl_merket');

  Route::get('/admin-store', [AdminController::class, 'admin_store'])->name('admin_store');
  Route::get('/bonus-report', [PointController::class, 'bonus_report'])->name('bonus_report');
  Route::post('/bonus_report/getBonusData', [PointController::class, 'get_bonus_data'])->name('get_bonus_data');

  //market
  // Route::get('/market-list', [MarketController::class, 'index'])->name('admin_market');
  // Route::post('/market/getmarketData', [MarketController::class, 'getmarketData'])->name('admin_getmarketData');
  // Route::get('/market/create', [MarketController::class, 'create'])->name('admin_market_create');
  // Route::post('/market/store', [MarketController::class, 'store'])->name('admin_market_store');
  // Route::get('/market/delete/{id}', [MarketController::class, 'delete'])->name('admin_market_delete');
  // Route::get('/market/update-status/{id}', [MarketController::class, 'update_status'])->name('admin_market_update_status');
  // Route::get('/market/edit/{id}', [MarketController::class, 'edit'])->name('admin_market_edit');
  // Route::post('/market/edit-store', [MarketController::class, 'edit_store'])->name('admin_market_edit_store');
  // Route::get('/market/view/{id}', [MarketController::class, 'view'])->name('admin_market_view');
  // Route::get('/market/result/{id}', [MarketController::class, 'result'])->name('admin_market_result');
  // Route::get('/market/result-close/{id}', [MarketController::class, 'result_close'])->name('admin_market_result_close');
  // Route::post('/market-result', [MarketController::class, 'admin_result'])->name('admin_resultmarket');
  // Route::post('/market-result-close', [MarketController::class, 'admin_result_close'])->name('admin_result_close');
  // Route::get('/market/history', [MarketController::class, 'history'])->name('admin_market_history');
  // Route::get('/market/update-holiday/{id}', [MarketController::class, 'update_holiday'])->name('admin_market_update_holiday');

  //starlinemarket
  // Route::get('/starline-market-list', [StarlineMarketController::class, 'index'])->name('admin_starline_market');
  // Route::post('/starline-market/getstarline-marketData', [StarlineMarketController::class, 'getstarline_marketData'])->name('admin_getstarline_marketData');
  // Route::get('/starline-market/create', [StarlineMarketController::class, 'create'])->name('admin_starline_market_create');
  // Route::post('/starline-market/store', [StarlineMarketController::class, 'store'])->name('admin_starline_market_store');
  // Route::get('/starline-market/delete/{id}', [StarlineMarketController::class, 'delete'])->name('admin_starline_market_delete');
  // Route::get('/starline-market/update-status/{id}', [StarlineMarketController::class, 'update_status'])->name('admin_starline_market_update_status');
  // Route::get('/starline-market/edit/{id}', [StarlineMarketController::class, 'edit'])->name('admin_starline_market_edit');
  // Route::post('/starline-market/edit-store', [StarlineMarketController::class, 'edit_store'])->name('admin_starline_market_edit_store');
  // Route::get('/starline-market/view/{id}', [StarlineMarketController::class, 'view'])->name('admin_starline_market_view');
  // Route::get('/starline-market/result/{id}', [StarlineMarketController::class, 'result'])->name('admin_starline_market_result');
  // Route::post('/starline-market-result', [StarlineMarketController::class, 'admin_result_starline'])->name('admin_result_starline');
  // Route::get('/starline-market/history', [StarlineMarketController::class, 'history'])->name('admin_starline_market_history');
  // Route::get('/starline-market/update-holiday/{id}', [StarlineMarketController::class, 'update_holiday'])->name('admin_starline_market_update_holiday');

  //market type
  // Route::get('/market-type-list', [MarketController::class, 'market_type'])->name('admin_market_type');
  // Route::get('/market-type-create', [MarketController::class, 'market_type_create'])->name('admin_market_type_create');
  // Route::post('/market/type-store', [MarketController::class, 'market_type_store'])->name('admin_market_type_store');
  // Route::post('/market/type/getmarkettypeData', [MarketController::class, 'getmarkettypeData'])->name('admin_getmarkettypeData');
  // Route::get('/market-type/delete/{id}', [MarketController::class, 'delete_type'])->name('admin_market_type_delete');
  // Route::get('/market-type/view/{id}', [MarketController::class, 'view_type'])->name('admin_market_view_type');
  // Route::get('/market-type/edit/{id}', [MarketController::class, 'edit_type'])->name('admin_market_edit_type');
  // Route::any('/market-type/edit-store', [MarketController::class, 'edit_store_type'])->name('admin_market_edit_store_type');


  Route::get('/market-list', [MarketController::class, 'index'])->name('admin_market');
  Route::post('/market/getmarketData', [MarketController::class, 'getmarketData'])->name('admin_getmarketData');

  //babaji market/ main market type 3
  Route::get('/babaji-market-list', [MarketController::class, 'babajiindex'])->name('babaji_market_list');
  Route::post('/market/getmarketbabajiData', [MarketController::class, 'getmarketbabajiData']);
  Route::get('/main-market/create', [MarketController::class, 'main_create'])->name('admin_main_market_create');
  Route::post('/main-market/store', [MarketController::class, 'main_store'])->name('admin_main_market_store');
  Route::get('/main-market/update-status/{id}', [MarketController::class, 'update_mainmarket_status'])->name('admin_mainmarket_market_update_status');
  Route::get('/mainmarket-market/view/{id}', [MarketController::class, 'mainmarket_view'])->name('admin_mainmarket_view');
  Route::get('/market/main-market-delete/{id}', [MarketController::class, 'main_market_delete'])->name('admin_main_market_delete');
  //------------//




  Route::get('/market/create', [MarketController::class, 'create'])->name('admin_market_create');
  Route::post('/market/store', [MarketController::class, 'store'])->name('admin_market_store');
  Route::get('/market/delete/{id}', [MarketController::class, 'delete'])->name('admin_market_delete');
  Route::get('/market/update-status/{id}', [MarketController::class, 'update_status'])->name('admin_market_update_status');
  Route::get('/market/edit/{id}', [MarketController::class, 'edit'])->name('admin_market_edit');
  Route::post('/market/edit-store', [MarketController::class, 'edit_store'])->name('admin_market_edit_store');
  Route::get('/market/view/{id}', [MarketController::class, 'view'])->name('admin_market_view');
  Route::get('/market/result/{id}', [MarketController::class, 'result'])->name('admin_market_result');
  Route::get('/market/result-close/{id}', [MarketController::class, 'result_close'])->name('admin_market_result_close');
  // Route::get('/market/result-open/{id}', [MarketController::class, 'result_open'])->name('admin_market_result_open');
  Route::post('/market-result', [MarketController::class, 'admin_result'])->name('admin_resultmarket');
  Route::post('/market-result-close', [MarketController::class, 'admin_result_close'])->name('admin_result_close');
  Route::get('/market/history', [MarketController::class, 'history'])->name('admin_market_history');
  Route::get('/market/update-holiday/{id}', [MarketController::class, 'update_holiday'])->name('admin_market_update_holiday');

  //starlinemarket
  Route::get('/starline-market-list', [StarlineMarketController::class, 'index'])->name('admin_starline_market');
  Route::post('/starline-market/getstarline-marketData', [StarlineMarketController::class, 'getstarline_marketData'])->name('admin_getstarline_marketData');
  Route::get('/starline-market/create', [StarlineMarketController::class, 'create'])->name('admin_starline_market_create');
  Route::post('/starline-market/store', [StarlineMarketController::class, 'store'])->name('admin_starline_market_store');
  Route::get('/starline-market/delete/{id}', [StarlineMarketController::class, 'delete'])->name('admin_starline_market_delete');
  Route::get('/starline-market/update-status/{id}', [StarlineMarketController::class, 'update_status'])->name('admin_starline_market_update_status');
  Route::get('/starline-market/edit/{id}', [StarlineMarketController::class, 'edit'])->name('admin_starline_market_edit');
  Route::post('/starline-market/edit-store', [StarlineMarketController::class, 'edit_store'])->name('admin_starline_market_edit_store');
  Route::get('/starline-market/view/{id}', [StarlineMarketController::class, 'view'])->name('admin_starline_market_view');
  Route::get('/starline-market/result/{id}', [StarlineMarketController::class, 'result'])->name('admin_starline_market_result');
  Route::post('/starline-market-result', [StarlineMarketController::class, 'admin_result_starline'])->name('admin_result_starline');
  Route::get('/starline-market/history', [StarlineMarketController::class, 'history'])->name('admin_starline_market_history');
  Route::get('/starline-market/update-holiday/{id}', [StarlineMarketController::class, 'update_holiday'])->name('admin_starline_market_update_holiday');

  //market type
  Route::get('/market-type-list', [MarketController::class, 'market_type'])->name('admin_market_type');
  Route::get('/market-type-create', [MarketController::class, 'market_type_create'])->name('admin_market_type_create');
  Route::post('/market/type-store', [MarketController::class, 'market_type_store'])->name('admin_market_type_store');
  Route::post('/market/type/getmarkettypeData', [MarketController::class, 'getmarkettypeData'])->name('admin_getmarkettypeData');
  Route::get('/market-type/delete/{id}', [MarketController::class, 'delete_type'])->name('admin_market_type_delete');
  Route::get('/market-type/view/{id}', [MarketController::class, 'view_type'])->name('admin_market_view_type');
  Route::get('/market-type/edit/{id}', [MarketController::class, 'edit_type'])->name('admin_market_edit_type');
  Route::any('/market-type/edit-store', [MarketController::class, 'edit_store_type'])->name('admin_market_edit_store_type');

  //cheak game loadeing
  Route::get('/cheak-game-list', [CheakgameController::class, 'index'])->name('admin_cheak_game_load');


  //admin setting
  Route::get('/admin-control-setting', [AdminController::class, 'admin_control_setting'])->name('admin_control_setting');
  Route::post('/admin-control-setting-store', [AdminController::class, 'admin_control_setting_store'])->name('admin_control_setting_store');
  Route::get('/admin-transaction-history', [TransactionHistoryController::class, 'admin_transaction_history'])->name('admin_transaction_history');
  Route::post('/transaction-history/gettransactionData', [TransactionHistoryController::class, 'gettransactionData'])->name('gettransactionData');

  //ReportController
  Route::get('/admin-report', [ReportController::class, 'admin_report'])->name('admin_report');
  Route::post('/admin-report/getReportData', [ReportController::class, 'getReportData'])->name('getReportData');
  Route::get('/result-report', [ReportController::class, 'result'])->name('result');
  Route::post('/result_report/getResultData', [ReportController::class, 'getResultData'])->name('getResultData');

  // User commission
  Route::get('/user-commission/index', [UserCommissionController::class, 'user_comm_index'])->name('user_comm_index');
  Route::post('/user-commission/getData-list', [UserCommissionController::class, 'getUserCommission'])->name('getUserCommission');
  Route::post('/user-commission/distribute', [UserCommissionController::class, 'getUserCommission_distribute'])->name('getUserCommission_distribute');
  Route::get('/view-user-commission/{id}', [UserCommissionController::class, 'View_UserCommission'])->name('viewusercommission');
  Route::get('/user-commission-pay-list', [UserCommissionController::class, 'UserCommissionPayList'])->name('usercommissionpaylist');
  Route::post('/get-user-commission-pay-data', [UserCommissionController::class, 'getUserCommissionPayData'])->name('getUserCommissionPay');

  //Instruction and faq
  Route::get('/faq/faq-list', [FaqController::class, 'index'])->name('faqindex');
  Route::post('/faq/getfaqData', [FaqController::class, 'getfaqData']);
  Route::get('/faq/add-faq', [FaqController::class, 'add_faq']);
  Route::post('/faq/storefaq', [FaqController::class, 'store']);
  Route::get('/faq/faq-edit/{id}', [FaqController::class, 'edit_faq']);
  Route::post('/faq/updatefaq/{id}', [FaqController::class, 'updatefaq']);
  Route::post('/faq/updatefaq/{id}', [FaqController::class, 'updatefaq']);
  Route::get('/faq/delete/{id}', [FaqController::class, 'delete']);
  Route::get('/faq/update-status/{id}', [FaqController::class, 'update_status']);

  Route::get('/add-instruction', [FaqController::class, 'add_instruction']);
  Route::post('/instruction/storeinstruction', [FaqController::class, 'store_instruction']);

  Route::get('/add-notice', [FaqController::class, 'add_notice']);
  Route::post('/Notice/storeNotice', [FaqController::class, 'store_Notice']);
  //////////////////////////////////////////////OLD ROUTE//////////////////////////////////////////////

  //Ank Reprot controller
  Route::get('/ank-report', [AnkreportController::class, 'index'])->Name('ank_report');

  //User controller
  Route::get('/user-ip-list', [UserController::class, 'user_ip_list'])->Name('user_ip');
  Route::post('/user/get-user-ip-data', [UserController::class, 'getUserIpData'])->Name('get_user_ip_data');
  Route::get('/user/view-user-ip-data/{device_id}', [UserController::class, 'userIpview'])->Name('user_ip_view');
  Route::get('/add-user', [UserController::class, 'add_user'])->Name('add_user');
  Route::post('/store-user', [UserController::class, 'store_user'])->Name('store_user');
  Route::get('/user/active-user-list', [UserController::class, 'active_user'])->Name('active_user');
  Route::post('/user/get-active-user-data', [UserController::class, 'getActiveUserData'])->Name('get_active_user_data');
  Route::get('/user/edit/{id}', [UserController::class, 'Edit'])->Name('edit');
  Route::get('/user/banned/status/{id}', [UserController::class, 'UserBnned'])->Name('user_banned');
  Route::post('/user/edit-store', [UserController::class, 'edit_store'])->Name('edit_store_data');
  Route::get('/user/view/{id}', [UserController::class, 'view_user'])->Name('view_user');
  Route::get('/active/user/delete/{id}', [UserController::class, 'delete_active_user'])->Name('delete_active_user');
  Route::get('/user/inactive-user-list', [UserController::class, 'Inactive_user'])->Name('Inactive_user');
  Route::post('/user/get-inactive-user-data', [UserController::class, 'getInactiveUserData'])->Name('get_Inactive_user_data');
  Route::get('/user/playing-user-list', [UserController::class, 'playing_user'])->Name('playing_user');
  Route::post('/user/get-playing-user-data', [UserController::class, 'getPlayingUserData'])->Name('get_playing_user_data');
  Route::get('/user/notplaying-user-list', [UserController::class, 'notplaying_user'])->Name('notplaying_user');
  Route::post('/user/get-notplaying-user-data', [UserController::class, 'getNotplayedUserData'])->Name('get_notplaying_user_data');
  Route::get('/user/notplaying-edit/{id}', [UserController::class, 'notplaying_Edit'])->Name('notplaying_edit_data');
  Route::post('/user/notplaying-edit-store', [UserController::class, 'notplaying_edit_store'])->Name('notplaying_edit_store_data');
  Route::get('/user/online-user-list', [UserController::class, 'online_user'])->Name('online_user');
  Route::post('/user/get-online-user-data', [UserController::class, 'getOnlineUserData'])->Name('get_Online_user_data');
  Route::get('/unapprove-user-list', [UserController::class, 'unapprove_user'])->Name('unapprove_user');

  Route::get('/user-game-report-list', [UserController::class, 'UserGameReport'])->Name('user_game_report_list');
  Route::post('/get-user-game-report-data', [UserController::class, 'GetUserGameReportData'])->Name('get_user_game_report_data');

  Route::get('/user/today-user-list', [UserController::class, 'today_user'])->Name('today_user');
  Route::post('/user/get-today-user-data', [UserController::class, 'gettodayUserData'])->Name('get_today_user_data');

  Route::get('/user/deposit/{id}', [UserController::class, 'deposit'])->Name('deposit');
  Route::post('/user/user-deposit', [UserController::class, 'user_deposit'])->Name('user_deposit');

  Route::get('/user/withdraw/{id}', [UserController::class, 'withdrow'])->Name('withdrow');
  Route::post('/user/user-withdrow', [UserController::class, 'user_withdrow'])->Name('user_withdrow');

  Route::get('/user/win-amount-withdrow/{id}', [UserController::class, 'Win_withdrow'])->Name('win_withdrow');
  Route::post('/user/win-amount-withdrow-store', [UserController::class, 'user_win_withdrow'])->Name('user_win_withdrow');

  Route::get('/user/wallet-history/{id}', [UserController::class, 'User_Wallet_History'])->Name('user_wallet_history');

  Route::get('/user/top-ten-user', [UserController::class, 'TopTenUser'])->Name('top_ten_user');
  Route::get('/user/commission-list', [UserController::class, 'User_commission_list'])->Name('user_commission_list');
  Route::get('/user/report/{id}', [UserController::class, 'User_report'])->Name('user_report_list');

  Route::get('/user/user-reffer-report', [UserController::class, 'UserRefferReport'])->Name('UserRefferReport');
  Route::get('/user/reffer_report_view/{id}', [UserController::class, 'reffer_report_view'])->Name('reffer_report_view');


  //Game Management controller
  Route::get('/game/gamemarket-name-list', [GameManageController::class, 'game_name_list'])->Name('gamemarket_name_list');
  Route::get('/game/add-gamemarket', [GameManageController::class, 'Add_game'])->Name('add_gamemarket');
  Route::post('/game/store-gamemarket', [GameManageController::class, 'store_game'])->Name('store_gamemarket');
  Route::get('/game/view/{id}', [GameManageController::class, 'view_game'])->Name('view_gamemarket');
  Route::get('/game/edit/{id}', [GameManageController::class, 'edit_game'])->Name('edit_gamemarket');
  Route::post('/game/edit-store', [GameManageController::class, 'edit_store_game'])->Name('edit_store_gamemarket');
  Route::get('/game/delete/{id}', [GameManageController::class, 'delete_game'])->Name('delete_gamemarket');
  Route::post('/game/get-game-name-list', [GameManageController::class, 'getGamenameData'])->Name('get_game_list');
  Route::get('/game/gamemarket-rate-list', [GameManageController::class, 'game_rate_list'])->Name('gamemarket_rate_list');
  Route::post('/game/get-game-rate-list', [GameManageController::class, 'getGamerateData'])->Name('get_game_rate_list');


  //Declare result Management controller
  Route::get('/result-list', [ResultController::class, 'index'])->Name('result_list');
  Route::post('/get-result-data', [ResultController::class, 'get_resultData'])->Name('get_result_data');

  //Winning Prediction Management Controller
  Route::get('/winning-prediction-list', [WinningPredictionController::class, 'index'])->Name('winning_prediction_list');
  Route::post('/winning-prediction-data', [WinningPredictionController::class, 'get_WinningPredictionData'])->Name('get_winning_prediction_data');

  //Report Management Controller
  Route::get('/report/user-bidthistory-list', [ReportController::class, 'user_bidhistory'])->Name('user_bidhistory');
  Route::post('/report/get-userbid-Data', [ReportController::class, 'getbidhistoryData'])->name('getbidhistoryData');
  Route::get('/report/customer-sell-report-list', [ReportController::class, 'customer_sell_report'])->Name('customer_sell_report');
  Route::get('/report/winningreport-list', [ReportController::class, 'winning_report'])->Name('winning_report_list');
  Route::post('/report/get-winningReport-Data', [ReportController::class, 'getwinningReportData'])->name('getwinningReportData');
  Route::get('/report/transport-point-report-list', [ReportController::class, 'transport_point_report'])->Name('transport_point_report');
  Route::post('/report/get-transfarPoint-Data', [ReportController::class, 'gettransfarPointData'])->name('gettransfarPointData');
  Route::get('/report/bid-winning-report-list', [ReportController::class, 'bid_winning_report'])->Name('bid_winning_report');
  Route::post('/report/get-bidWinning-Data', [ReportController::class, 'getbidWinningData'])->name('getbidWinningData');
  Route::get('/report/withdraw-report-list', [ReportController::class, 'withdraw_report'])->Name('withdraw_report');
  Route::post('/report/get-withdrawReport-Data', [ReportController::class, 'getwithdrawReportData'])->name('getwithdrawReportData');
  Route::get('/report/add-fund-report-list', [ReportController::class, 'add_fund_report'])->Name('add_fund_report');
  Route::post('/report/get-addfundReport-Data', [ReportController::class, 'getaddfundReportData'])->name('getaddfundReportData');
  Route::get('/report/auto-deposit-history-list', [ReportController::class, 'auto_deposit_history'])->Name('auto_deposit_history');
  Route::post('/report/get-autoDeposit-Data', [ReportController::class, 'getautoDepositData'])->name('getautoDepositData');

  // Withdraw Management Controller
  Route::get('/fund-request-list', [WalletController::class, 'fund_request'])->Name('fund_request');
  Route::post('/get-fund-request-data', [WalletController::class, 'get_fundrequestData'])->Name('get_fund_request_data');
  Route::get('/withdraw-request-list', [WalletController::class, 'withdraw_request'])->Name('withdraw_request');
  Route::get('/add-fund', [WalletController::class, 'add_fund'])->Name('add_fund');
  Route::get('/bid-revert', [WalletController::class, 'bid_revert'])->Name('bid_revert');

  //Game&number Controller
  Route::get('/gmaeandnumber/single-digit', [GameAndNumberController::class, 'single_digit'])->Name('single_digit');
  Route::get('/gmaeandnumber/jodi-digit', [GameAndNumberController::class, 'jodi_digit'])->Name('jodi_digit');
  Route::get('/gmaeandnumber/single-panna', [GameAndNumberController::class, 'single_panna'])->Name('single_panna');
  Route::get('/gmaeandnumber/double-panna', [GameAndNumberController::class, 'double_panna'])->Name('double_panna');
  Route::get('/gmaeandnumber/triple-panna', [GameAndNumberController::class, 'triple_panna'])->Name('triple_panna');
  Route::get('/gmaeandnumber/half-sangam', [GameAndNumberController::class, 'half_sangam'])->Name('half_sangam');
  Route::get('/gmaeandnumber/full-sangam', [GameAndNumberController::class, 'full_sangam'])->Name('full_sangam');

  //Notice Controller
  Route::get('/notice-list', [NoticeController::class, 'index'])->Name('notice_list');
  Route::post('/get-notice-data', [NoticeController::class, 'getNoticeData'])->Name('getNoticeData');
  Route::get('/notice-edit/{id}', [NoticeController::class, 'edit_notice_data'])->Name('edit_notice_data');
  Route::post('/notice-editStore', [NoticeController::class, 'StoreNoticeData'])->Name('StoreNoticeData');
  Route::get('/delete-data/{id}', [NoticeController::class, 'DeleteNotice'])->Name('DeleteNotice');
  Route::get('/add-notice', [NoticeController::class, 'add_notice'])->Name('add_notice');
  Route::post('/store-notice', [NoticeController::class, 'store'])->Name('store');

  Route::get('/app-notice-list', [NoticeController::class, 'app_index'])->Name('app_notice_list');
  Route::post('/get-app-notice-data', [NoticeController::class, 'getAppNoticeData'])->Name('getAppNoticeData');
  Route::get('/app-notice-edit/{id}', [NoticeController::class, 'edit_app_notice_data'])->Name('edit_app_notice_data');
  Route::post('/app-notice-editStore', [NoticeController::class, 'StoreAppNoticeData'])->Name('StoreAppNoticeData');
  Route::get('/update-is-disaplay/{id}', [NoticeController::class, 'update_is_display'])->name('update_isdisplay');

  //Starline Management Controller
  Route::get('/game-name-list', [StarlineController::class, 'index'])->Name('game_name_list');
  Route::post('/get-game-data', [StarlineController::class, 'getGameData'])->Name('get_game_data');
  Route::get('/add-starline-market', [StarlineController::class, 'add_starline_market'])->Name('add_starline_gamemarket');
  Route::post('/store-starline-market', [StarlineController::class, 'store_starline_market'])->Name('store_starline_gamemarket');
  Route::get('/view/{id}', [StarlineController::class, 'view'])->Name('view');
  Route::get('/edit/{id}', [StarlineController::class, 'edit'])->Name('edit');
  Route::post('/edit-store', [StarlineController::class, 'edit_store'])->Name('edit_store');
  Route::get('/delete/{id}', [StarlineController::class, 'delete'])->name('game_delete');
  Route::get('/result/{id}', [StarlineController::class, 'result'])->name('market_result');
  // Route::get('/result-close/{id}', [StarlineController::class, 'result_close'])->name('market_result_close');
  Route::get('/update-status/{id}', [StarlineController::class, 'update_status'])->name('market_update_status');
  Route::get('/game-rate-list', [StarlineController::class, 'game_rate'])->Name('starline-market/result');
  Route::post('/get-game-rate-data', [StarlineController::class, 'getGamerate_Data'])->Name('getGamerate_Data');
  Route::get('/bid-history-list', [StarlineController::class, 'bid_history'])->Name('bid_history');
  Route::post('/market/get-bid-history-data', [StarlineController::class, 'getBidHistoryData'])->Name('get_bid_history_data');
  Route::get('/declare-result-list', [StarlineController::class, 'declare_result'])->Name('declare_result');
  Route::post('/get-declare-data', [StarlineController::class, 'getDeclareData'])->Name('get_declare_data');
  Route::get('/result-history-list', [StarlineController::class, 'result_history'])->Name('result_history');
  Route::post('/get-result-history-data', [StarlineController::class, 'getResultHistoryData'])->Name('get_result_history_data');
  Route::get('/sell-report-list', [StarlineController::class, 'sell_report'])->Name('sell_report');
  Route::get('/winning-report-list', [StarlineController::class, 'winning_report'])->Name('winning_report');
  Route::post('/get-winning-report-data', [StarlineController::class, 'getWinningReportData'])->Name('get_winning_report_data');
  Route::get('/winning-prediction', [StarlineController::class, 'winning_prediction'])->Name('winning_prediction');
  Route::post('/get-winning-prediction-data', [StarlineController::class, 'getWinningPredictionData'])->Name('get_winning_prediction_data');


  //Withdraw Management
  Route::get('/game/withdraw-name-list', [WithdrawManageController::class, 'withdraw_list'])->Name('withdraw_name_list');
  Route::get('/game/add-withdraw', [WithdrawManageController::class, 'withdraw_game'])->Name('add_gamemarket');
  Route::post('/get-withdrow-data', [WithdrawManageController::class, 'WithdrawManageData'])->Name('withdrow_data');
  Route::post('/get-datewithdrow-data', [WithdrawManageController::class, 'DateWithdrawManageData'])->Name('withdrow_data');
  Route::get('/game/withdraw-pending', [WithdrawManageController::class, 'withdraw_pending'])->Name('withdraw_pending');
  Route::get('/game/withdraw-dateway-pending', [WithdrawManageController::class, 'withdraw_dateway_pending'])->Name('withdraw_dateway_pending_list');
  Route::post('/withdraw-cancelled', [WithdrawManageController::class, 'withdraw_cancel'])->Name('withdraw_cancel');
  // Route::get('/success-withdraw-cancelled/{id}', [WithdrawManageController::class, 'success_withdraw_cancel'])->Name('success_withdraw_cancel');
  Route::post('/withdraw-approve', [WithdrawManageController::class, 'withdraw_approve'])->Name('withdraw_approve');
  Route::get('/withdraw-reverse/{id}', [WithdrawManageController::class, 'withdraw_reverse'])->Name('withdraw_reverse');
  Route::post('/get-withdrow-data-success', [WithdrawManageController::class, 'WithdrawManageData_success'])->Name('withdrow_data_success');
  Route::get('/game/withdraw-success', [WithdrawManageController::class, 'withdraw_success'])->Name('withdraw_success_list');
  Route::get('/game/withdraw-success-view/{date}', [WithdrawManageController::class, 'withdraw_success_view'])->Name('withdraw_success_view');
  Route::post('/get-withdrow-data-cancelled', [WithdrawManageController::class, 'WithdrawManageData_cancelled'])->Name('withdrow_data_cancelled');
  Route::get('/game/withdraw-cancelled', [WithdrawManageController::class, 'withdraw_cancelled'])->Name('withdraw_cancelled_list');
  Route::get('/withdraw-view-dataa/{id}', [WithdrawManageController::class, 'withdraw_view_dataa'])->Name('withdraw_view');
  Route::post('/game/gwithdraw-rate-list', [WithdrawManageController::class, 'withdrawdata'])->Name('withdrawdata_list');


  // Deposit Management
  Route::get('/game/deposit-name-list', [DepositManagementController::class, 'deposit_list'])->Name('deposit_name_list');
  Route::get('/game/add-deposit', [DepositManagementController::class, 'deposit_game'])->Name('add_gamemarket');
  Route::post('/get-deposit-data-pending', [DepositManagementController::class, 'depositManageData_pending'])->Name('deposit_data');
  Route::get('/game/deposit-pending', [DepositManagementController::class, 'deposit_pending'])->Name('deposit_pending');
  // Route::get('/deposit-cancelled/{id}', [DepositManagementController::class, 'deposit_cancel'])->Name('deposit_cancel');
  Route::post('/deposit-cancelled', [DepositManagementController::class, 'deposit_cancel'])->Name('deposit_cancel');
  // Route::get('/success-deposit-cancelled/{id}', [DepositManagementController::class, 'success_deposit_cancel'])->Name('success_deposit_cancel');
  Route::post('/success-deposit-cancelled', [DepositManagementController::class, 'success_deposit_cancel'])->Name('success_deposit_cancel');
  // Route::get('/deposit-approve/{id}', [DepositManagementController::class, 'deposit_approve'])->Name('deposit_approve');
  Route::post('/deposit-approve', [DepositManagementController::class, 'deposit_approve'])->Name('deposit_approve');
  Route::post('/get-deposit-data-success', [DepositManagementController::class, 'depositManageData_success'])->Name('deposit_data_success');
  Route::get('/game/deposit-success', [DepositManagementController::class, 'deposit_success'])->Name('deposit_success');
  Route::get('/game/deposit-success-view/{date}', [DepositManagementController::class, 'deposit_success_view'])->Name('deposit_success_view_list');
  Route::post('/get-deposit-data-cancelled', [DepositManagementController::class, 'depositManageData_cancelled'])->Name('deposit_data_cancelled');
  Route::get('/game/deposit-cancelled', [DepositManagementController::class, 'deposit_cancelled'])->Name('deposit_cancelled');
  Route::post('/game/gdeposit-rate-list', [DepositManagementController::class, 'depositdata'])->Name('depositdata_list');
  Route::get('/game/deposit-dateway-pending', [DepositManagementController::class, 'deposit_dateway_pending'])->Name('deposit_dateway_pending');
  Route::post('/get-datedeposit-data', [DepositManagementController::class, 'DatedepositManageData'])->Name('deposit_data');
  Route::get('/deposit-view-dataa/{id}', [DepositManagementController::class, 'deposit_view_dataa'])->Name('deposit_view');
  Route::get('/edit-deposit-pending-data/{id}', [DepositManagementController::class, 'Edit_Deposit_Pending_Data'])->Name('edit_deposit_pending_data');
  Route::post('/update-deposit-pending-data', [DepositManagementController::class, 'Update_Deposit_Pending_Data'])->Name('update_deposit_pending_data');
  

  

  /* Old Deposit Managment */
  Route::get('/game/deposit-name-list-old', [DepositManagementOldController::class, 'deposit_list'])->Name('deposit_name_list_old');
  Route::get('/game/add-deposit-old', [DepositManagementOldController::class, 'deposit_game'])->Name('add_gamemarket_old');
  Route::post('/get-deposit-data-pending-old', [DepositManagementOldController::class, 'depositManageData_pending'])->Name('deposit_data_old');
  Route::get('/game/deposit-pending-old', [DepositManagementOldController::class, 'deposit_pending'])->Name('deposit_pending_old');
  // Route::get('/deposit-cancelled/{id}', [DepositManagementOldController::class, 'deposit_cancel'])->Name('deposit_cancel');
  Route::post('/deposit-cancelled-old', [DepositManagementOldController::class, 'deposit_cancel'])->Name('deposit_cancel_old');
  // Route::get('/success-deposit-cancelled/{id}', [DepositManagementOldController::class, 'success_deposit_cancel'])->Name('success_deposit_cancel');
  Route::post('/success-deposit-cancelled-old', [DepositManagementOldController::class, 'success_deposit_cancel_old'])->Name('success_deposit_cancel');
  // Route::get('/deposit-approve/{id}', [DepositManagementOldController::class, 'deposit_approve'])->Name('deposit_approve');
  Route::post('/deposit-approve-old', [DepositManagementOldController::class, 'deposit_approve'])->Name('deposit_approve_old');
  Route::post('/get-deposit-data-success-old', [DepositManagementOldController::class, 'depositManageData_success'])->Name('deposit_data_success_old');
  Route::get('/game/deposit-success-old', [DepositManagementOldController::class, 'deposit_success'])->Name('deposit_success_old');
  Route::get('/game/deposit-success-view-old/{date}', [DepositManagementOldController::class, 'deposit_success_view'])->Name('deposit_success_view_list_old');
  Route::post('/get-deposit-data-cancelled-old', [DepositManagementOldController::class, 'depositManageData_cancelled'])->Name('deposit_data_cancelled_old');
  Route::get('/game/deposit-cancelled-old', [DepositManagementOldController::class, 'deposit_cancelled'])->Name('deposit_cancelled_old');
  Route::post('/game/gdeposit-rate-list-old', [DepositManagementOldController::class, 'depositdata'])->Name('depositdata_list_old');
  Route::get('/game/deposit-dateway-pending-old', [DepositManagementOldController::class, 'deposit_dateway_pending'])->Name('deposit_dateway_pending_old');
  Route::post('/get-datedeposit-data-old', [DepositManagementOldController::class, 'DatedepositManageData'])->Name('deposit_data_old');
  Route::get('/deposit-view-dataa-old/{id}', [DepositManagementOldController::class, 'deposit_view_dataa'])->Name('deposit_view_old');
  Route::get('/edit-deposit-pending-data-old/{id}', [DepositManagementOldController::class, 'Edit_Deposit_Pending_Data'])->Name('edit_deposit_pending_data-old_old');
  Route::post('/update-deposit-pending-data-old', [DepositManagementOldController::class, 'Update_Deposit_Pending_Data'])->Name('update_deposit_pending_data_old');




  //Gali Disawar Management Controller
  Route::get('/gali-disawar-game-name-list', [GaliDisawarController::class, 'index'])->Name('gali_disawar_game_name_list');
  Route::post('/get-disawar-game-data', [GaliDisawarController::class, 'GaliDisawarGameData'])->Name('gali_disawar_game_data');

  Route::get('/add-gd-game', [GaliDisawarController::class, 'Add_Gdgame'])->Name('add_gali_disawar_game');
  Route::get('/result-close/{id}', [GaliDisawarController::class, 'result_close'])->name('result_close');
  Route::post('/result-gd-game-declear', [GaliDisawarController::class, 'result_Gdgame_declear'])->Name('result_Gdgame_declear');
  Route::post('/store-gd-game', [GaliDisawarController::class, 'store_Gdgame'])->Name('store_gali_disawar_game');
  Route::get('/edit-gd-game/{id}', [GaliDisawarController::class, 'edit_Gdgame'])->Name('edit_gali_disawar_game');
  Route::post('/edit-store-gd-game', [GaliDisawarController::class, 'edit_store_Gdgame'])->Name('edit_store_gali_disawar_game');
  Route::get('/gali-disawar/update-status/{id}', [GaliDisawarController::class, 'update_gd_status'])->name('gali_disawar_market_update_status');
  Route::get('/gali-disawar-game-rate-list', [GaliDisawarController::class, 'gd_game_rate'])->Name('gali_disawar_game_rate_list');
  Route::get('/gali-disawar-bid-history-list', [GaliDisawarController::class, 'gd_bid_history'])->Name('gali_disawar_bid_history');
  Route::post('/get-gd-bid-history-Data', [GaliDisawarController::class, 'Gd_BidHistoryData'])->Name('gd_bid_history_data');
  Route::get('/gali-disawar-declare-result-list', [GaliDisawarController::class, 'gd_declare_result'])->Name('gali_disawar_declare_result');
  Route::post('/get-gd-declare-result-Data', [GaliDisawarController::class, 'get_Gd_declareResultData'])->Name('gd_declare_result_data');
  Route::get('/gali-disawar-result-history-list', [GaliDisawarController::class, 'gd_result_history'])->Name('gali_disawar_result_history');
  Route::post('/get-gd-result-history-Data', [GaliDisawarController::class, 'get_Gd_ResultHistoryData'])->Name('gd_result_history_data');
  Route::get('/gali-disawar-sell-report-list', [GaliDisawarController::class, 'gd_sell_report'])->Name('gali_disawar_sell_report');
  Route::get('/gali-disawar-winning-report-list', [GaliDisawarController::class, 'gd_winning_report'])->Name('gali_disawar_winning_report');
  Route::post('/get-gd-winning-report-Data', [GaliDisawarController::class, 'get_Gd_WinningReportData'])->Name('gd_winning_report_data');
  Route::get('/gali-disawar-winning-prediction', [GaliDisawarController::class, 'gd_winning_prediction'])->Name('gali_disawar_winning_prediction');
  Route::post('/get-gd-winning-prediction-Data', [GaliDisawarController::class, 'get_Gd_WinningPredictionData'])->Name('gd_winning_prediction_data');
  Route::post('/betsDelete', [GaliDisawarController::class, 'betsDelete'])->Name('bets.delete');


  // Manage Market
  Route::get('/manage-market/update-result', [ManageMarketController::class, 'update_result'])->Name('update_result_index');
   Route::post('/manage-market/update-result-data', [ManageMarketController::class, 'updateResultData'])->Name('updateResultData');
  Route::post('/manage-market/update-result-store', [ManageMarketController::class, 'update_result_store'])->Name('update_result_store');
  Route::get('/manage-market/update-result-delete/{id}', [ManageMarketController::class, 'update_result_delete'])->Name('update_result_delete');

  Route::get('/manage-market/winner-number', [ManageMarketController::class, 'winner_number'])->Name('winner_number_index');
  Route::post('/manage-market/winner-number-list', [ManageMarketController::class, 'winner_numberData'])->Name('winner_number_data');
  Route::post('/manage-market/winner-number-result-declear', [ManageMarketController::class, 'winner_numberData_result_declear'])->Name('winner_numberData_result_declear');


  //User quries Controller
  Route::get('/user-queries', [UserQueriesController::class, 'index'])->Name('user_queries');

  //Web Setting Management Controller
  Route::get('/banner', [WebSettingController::class, 'Banner'])->Name('banner');
  Route::get('/add-banner', [WebSettingController::class, 'Add_Banner'])->Name('add_banner');
  Route::post('/store-banner', [WebSettingController::class, 'StoreBanner'])->Name('store_banner');
  Route::post('/store-apk', [WebSettingController::class, 'StoreApk'])->Name('store_apk');
  Route::post('/get-banner-data', [WebSettingController::class, 'getBannerData'])->Name('get_banner_data');
  Route::get('/banner-edit/{id}', [WebSettingController::class, 'Banner_Edit'])->Name('banner_edit');
  Route::post('/banner-update', [WebSettingController::class, 'Banner_Update'])->Name('banner_update');
  Route::get('/status-update/{id}', [WebSettingController::class, 'Status_Update'])->Name('status_update');
  Route::get('/delete-Banner/{id}', [WebSettingController::class, 'delete_Banner'])->Name('delete_Banner');
  Route::get('/view-Banner-details/{id}', [WebSettingController::class, 'viewDetails'])->Name('viewDetails');
  Route::get('/app-image', [WebSettingController::class, 'App_image'])->Name('app_image');
  Route::get('/apk-manager', [WebSettingController::class, 'Apk_manager'])->Name('apk_manager');
  Route::post('/update-apk-manager', [WebSettingController::class, 'update_Apk_manager'])->Name('apk_manager_update');
  Route::get('/video', [WebSettingController::class, 'video'])->Name('video');
  Route::get('/page', [WebSettingController::class, 'page'])->Name('page');

  //Setting Management Controller
  Route::get('/accont-list', [SettingController::class, 'Account'])->Name('account');
  Route::get('/setting-list', [SettingController::class, 'setting'])->Name('setting');
  Route::get('/slider-list', [SettingController::class, 'slider'])->Name('slider');
  Route::get('/how-to-play-list', [SettingController::class, 'how_To_Play'])->Name('how_To_Play');
  Route::get('/setting-page', [SettingController::class, 'setting_page'])->Name('setting_page');

  //Admin and Rols Module Controller
  Route::get('/admin-group-roles', [AdminRolsModuleController::class, 'admin_group_roles'])->Name('admin_group_roles');
  Route::get('/admin-list', [AdminRolsModuleController::class, 'admin_list'])->Name('admin_list');
  Route::get('/admin-add', [AdminRolsModuleController::class, 'admin_add'])->Name('admin_add');

  //gameload
  Route::get('/admin-game_load_list', [GameLoadController::class, 'admin_gameload_list'])->Name('game_load_list');
  Route::post('/chk-bat-amount-gameload', [GameLoadController::class, 'chk_bat_amount_gameload'])->Name('chk_bat_amount_gameload');
  Route::get('/admin-kalyan_game_load', [GameLoadController::class, 'admin_kalyan_game_load'])->Name('kalyan_game_load');

  Route::get('/payment-getway', [PaymentGetwayController::class, 'index'])->Name('index_page');
  Route::post('/get-payment-getway-data', [PaymentGetwayController::class, 'Get_paymentGetway_Data'])->Name('payment_getwayData');
  Route::get('/add-payment-getway', [PaymentGetwayController::class, 'Add_PaymentGetway'])->Name('add_payment_getway');
  Route::post('/store-payment-getway-data', [PaymentGetwayController::class, 'StorePaymentGetwayData'])->Name('store_payment_getwayData');
  Route::get('/payment-getway/update-status/{id}', [PaymentGetwayController::class, 'update_status'])->name('payment_getway_update_status');
  
  Route::get('/payment-instruction/list', [PaymentGetwayController::class, 'PaymentInstruction'])->name('payment_instruction_list');
  Route::post('/get-payment-instruction-data',[PaymentGetwayController::class,'Get_PaymentInstructionData'])->name('get_payment_instruction_data');
  Route::get('/update-payment-instruction-status/{id}', [PaymentGetwayController::class, 'update_paymen_instruction_status'])->name('update_payment_instruction_status');
  Route::get('/payment-instruction-details/{id}', [PaymentGetwayController::class, 'viewPaymentInstructionDetails'])->Name('view_payment_instruction_Details');
  Route::get('/edit-payment-instruction/{id}', [PaymentGetwayController::class, 'PaymentInstructionEdit'])->name('edit_payment-instruction');
  Route::post('payment-instruction-update', [PaymentGetwayController::class, 'PaymentInstructionUpdate'])->name('payment_instruction_update');

  //Scanner Payment
  Route::get('/scanner-payment', [ScannerPaymentController::class, 'index'])->name('scanner_payment');
  Route::post('/get-scanner-payment-data', [ScannerPaymentController::class, 'Get_ScannerpaymentData'])->name('get_scanner_payment_data');
  Route::get('/add-qrcode', [ScannerPaymentController::class, 'Add_qrcode'])->name('add_qrcode');
  Route::post('/store-qrcode', [ScannerPaymentController::class, 'StoreQrcode'])->Name('store_qrcode');
  Route::get('/update-qr-code-status/{id}', [ScannerPaymentController::class, 'update_qrcode_status'])->name('update_qr_code_status');
  Route::get('/edit-qr-code/{id}', [ScannerPaymentController::class, 'Qr_Code_Edit'])->name('edit_qr_code');
  Route::post('qr-code-update', [ScannerPaymentController::class, 'Qr_code_Update'])->Name('qr_code_update');
  Route::get('/qr-code-details/{id}', [ScannerPaymentController::class, 'viewQrcodeDetails'])->Name('view_qr_code_Details');
  Route::get('/delete-qr-code/{id}', [ScannerPaymentController::class, 'delete_Qr_Code'])->Name('delete_qr_code');

  Route::get('/user-csv', [CsvController::class, 'userwallet_report'])->Name('userwallet_report');
  // GET used when opening URL in browser — POST form submits the real download
  Route::get('/user-csv-download', function () {
      return redirect()->route('userwallet_report')->with('error_message', 'Please fill the form on this page and click download (POST).');
  });
  Route::post('/user-csv-download', [CsvController::class, 'userwallet_report_download'])->Name('userwallet_report_download');
  Route::post('/user-withdraw-report-download', [CsvController::class, 'userWithdraw_report_download'])->Name('userwithdraw_report_download');

});