<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
| created by Eng.Ahmed Ibrahim
*/

use Illuminate\Support\Facades\Route;

//Route::get('/','HomeController@index');

//Route::get('', function () {
//   echo 1;
//});

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
    Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login');
    Route::any('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
});

Route::group(['middleware' => ['admin'], 'as' => 'admin.'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('home');
    Route::get('/', 'Admin\HomeController@index')->name('index');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/most_common_words', 'Admin\DashboardController@mostCommonWords')->name('most_common_words');
    Route::get('/statistics', 'Admin\DashboardController@statistics')->name('statistics');
    Route::get('/order_statistics', 'Admin\DashboardController@order_statistics')->name('order_statistics');
    Route::get('/current_orders/{type}', 'Admin\HomeController@current_orders')->name('current_orders');
    Route::get('/reports_orders/list', 'Admin\OrdersController@index')->name('reports_orders_list');
    Route::get('/report_orders/{type}', 'Admin\OrdersController@report_orders')->name('report_orders');
    Route::post('get-data/report-private-orders','Admin\OrdersController@getReportPrivateOrder')
    ->name('get_report_private_orders');
    Route::post('get-data/report-public-orders','Admin\OrdersController@getReportPublicOrder')
    ->name('get_report_public_orders');
    Route::post('get-data/report-eservices-orders','Admin\OrdersController@getReportEservicesOrders')
    ->name('get_report_eservices_orders');
    Route::resource('admins',       'Admin\AdminsController');
    Route::get('/logs',             'Admin\AdminsController@logs')->name('logs');
    Route::post('/logs-get-data',   'Admin\AdminsController@get_all_logs')->name('logs.get-data');
    Route::post('/get-data/admins' ,'Admin\AdminsController@get_all')->name('admins.get-data');
    Route::get('admins/change/{id}' ,'Admin\AdminsController@edit')->name('admins.change');
    Route::get('admins/profile/update' ,'Admin\AdminsController@my_profile')->name('admins.my_profile');
    Route::patch('admins/profile/update_my_profile' ,'Admin\AdminsController@update_my_profile')->name('admins.update_my_profile');
    Route::get('admins/second_auth/form/{type}' ,'Admin\AdminsController@verify_form')->name('admins.verify_form');
    Route::post('admins/second_auth/verify' ,'Admin\AdminsController@verify')->name('admins.verify');

    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles-get-data', 'Admin\RolesController@get_all')->name('get_all');
    // قائمة الكلمات الممنوعة
    Route::resource('forbidden_words', 'Admin\ForbiddenWordController');
    Route::post('/get-data/forbidden_words', 'Admin\ForbiddenWordController@get_all');


    // chatbot routes
    Route::match(['get', 'post'], 'chatbotSendMessages', 'Admin\ChatAPIController@sendmessage')->name('chatbotSendMessages');

    Route::view('chatbotCreateGroup', 'admin/chatbot/create_group')->name('chatbotCreateGroup');
    Route::post('chatbotCreateGroup', 'Admin\ChatAPIController@creategroup')->name('chatbotCreateGroup');


    Route::get('chatbotSendGroupMessage', 'Admin\ChatAPIController@sendgroupmessage')->name('chatbotSendGroupMessage');
    Route::post('chatbotSendGroupMessage', 'Admin\ChatAPIController@sendgroupmessage')->name('chatbotSendGroupMessage');

    Route::get('chatbotSettings', 'Admin\ChatAPIController@settings')->name('chatbotSettings');
    Route::post('chatbotChangeSettings', 'Admin\ChatAPIController@change_settings')->name('chatbotChangeSettings');





    Route::resource('admins','Admin\AdminsController');
    Route::get('admins/delete/{id}','Admin\AdminsController@destroy')->name('admins.delete');
    Route::resource('roles','Admin\RolesController');
    // قائمة الكلمات الممنوعة
    Route::resource('forbidden_words','Admin\ForbiddenWordController');
    Route::post('/get-data/forbidden_words','Admin\ForbiddenWordController@get_all');


    ////  عرض الاعضاء (العملاء - مقدمي الخدمات )
    Route::get('users'                      ,'Admin\UsersController@indexUser')->name('indexUser');
    Route::get('service_providers'          ,'Admin\UsersController@indexProvider')->name('indexProvider');
    Route::get('/users/create'              ,'Admin\UsersController@create')->name('users.create');
    Route::post('/users/store'              ,'Admin\UsersController@store')->name('users.store');
    Route::get('/users/edit/{id}'           ,'Admin\UsersController@edit')->name('users.edit');
    Route::put('/users/update/{id}'         ,'Admin\UsersController@update')->name('users.update');
    Route::post('/get-data/users'           ,'Admin\UsersController@get_all');
    Route::post('/get-data/providers'       ,'Admin\UsersController@get_all_p');
    Route::get('user-informations/{id}'     ,'Admin\UsersController@userInformations')->name('userInformations');
    Route::get('/users/log/{id}'            ,'Admin\UsersController@log')->name('users.log');
    Route::get('/users/update-order/{id}'   ,'Admin\UsersController@updateOrder')->name('users.updateOrder');
    Route::post('/users/update-order/{id}'   ,'Admin\UsersController@updateOrderPost')->name('users.updateOrderPost');
    Route::post('/get-log/users'           ,'Admin\UsersController@get_log');
    Route::get('/users/reset_password/{id}'         ,'Admin\UsersController@resetPassword')->name('users.resetPassword');
    Route::post('/users/reset_password_post/{id}'    ,'Admin\UsersController@resetPasswordPost')->name('users.resetPasswordPost');
    Route::get('/users/create-request-balance/{id}','Admin\UsersController@createBalanceRequest')->name('createBalanceRequest');
    Route::post('/users/store-request-balance','Admin\UsersController@storeBalanceRequest')->name('storeBalanceRequest');

    Route::get('wrong-users'                            ,'Admin\UsersController@indexWrongUser')->name('indexWrongUser');
    Route::post('/get-data/wrong-users'                 ,'Admin\UsersController@get_all_wrong');

    Route::get('report-users'                           ,'Admin\UsersController@indexReportUser')->name('indexReportUser');
    Route::post('/get-data/report-users'                ,'Admin\UsersController@get_all_report');

    Route::get('all-report-users/{user_id}'             ,'Admin\UsersController@indexAllReportUser')->name('indexAllReportUser');

    // محفظة المنصة
    Route::get('wallet','Admin\WalletController@index')->name('wallet');
    Route::post('/get-data/wallet','Admin\WalletController@get_all');
    Route::get('/get-wallet/{type}/{search_period?}/{date_from?}/{date_to?}','Admin\WalletController@export')->name('wallet.export');

    // الاعدادات
    //رسوم التعميد
    Route::get('fees','Admin\SettingsController@getFees')->name('fees');
    Route::post('fees_update','Admin\SettingsController@updateFees')->name('updateFees');
    // اعدادات الموقع
    Route::get('settings','Admin\SettingsController@index')->name('settings');
    Route::post('settings_update','Admin\SettingsController@updateSettings')->name('updateSettings');

    // طلبات سحب الرصيد
    Route::get('balance_requests','Admin\WalletController@getBalanceRequests')->name('balance_requests');
    Route::post('/get-data/balance-requests','Admin\WalletController@get_all_balance_requests');

    Route::post('update_request/{id}','Admin\WalletController@updateBalanceRequests')->name('updateBalanceRequests');
    Route::get('balance_request/{id}','Admin\WalletController@getBalanceRequest')->name('balance_request');
    Route::post('update_request_details/{id}','Admin\WalletController@updateBalanceRequest')->name('updateBalanceRequest');
//    Route::post('store-request-balance','Admin\WalletController@storeBalanceRequest')->name('storeBalanceRequest');
    Route::get('user_orders/{user_id}','Admin\WalletController@getUserBalanceRequests')->name('user_balance_requests');
    Route::post('get-data/user-private-orders/{user_id}/{status?}','Admin\WalletController@getUserPrivateOrder')
    ->name('get_user_private_orders');
    Route::post('get-data/user-public-orders/{user_id}/{status?}','Admin\WalletController@getUserPublicOrder')
    ->name('get_user_public_orders');
    Route::post('get-data/user-eservices-orders/{user_id}/{status?}','Admin\WalletController@getUserEservicesOrders')
    ->name('get_user_eservices_orders');

// طلبات التعميد العام
    Route::get('public_orders','Admin\PublicOrderController@index')->name('public_orders');
    Route::put('public_orders/{id}/updateStatus','Admin\PublicOrderController@updateStatus')->name('public_orders.updateStatus');
    Route::post('/get-data/public-orders','Admin\PublicOrderController@get_all');
    Route::get('/public_orders/{order}','Admin\PublicOrderController@edit')->name('public_orders.edit');
    Route::get('following_public_orders/{order_id}','Admin\PublicOrderController@following_public_orders')->name('following_public_orders');
    Route::post('/get-data/following-public-orders/{order_id}','Admin\PublicOrderController@get_all_following');


Route::get('private_orders','PrivateOrderAdminController@list')->name('private_orders');
Route::get('/private_orders/{order}','PrivateOrderAdminController@edit');
Route::post('/get-data/private-orders','PrivateOrderAdminController@get_all');

Route::get('following_private_orders/{order_id}','PrivateOrderAdminController@followingPrivateOrders')->name('followingPrivateOrders');
Route::get('/following_private_orders/{order}/edit','PrivateOrderAdminController@followingPrivateOrdersEdit')->name('followingPrivateOrdersEdit');
Route::post('/get-data/following-private-orders/{order_id}','PrivateOrderAdminController@get_all_following');

Route::put('/private_orders/{order}','PrivateOrderAdminController@update')->name('private_orders.edit');
Route::put('/private_orders-following/{order}','PrivateOrderAdminController@updateFollowing')->name('private_orders_following.edit');

Route::get('transactions','PrivateOrderAdminController@transactions')->name('w_transactions');
Route::post('/get-data/transactions','PrivateOrderAdminController@get_all_transactions');

// EServices
Route::view('e_services/create','admin/eservices/create')->name('eservices.create');
Route::post('e_services/create','EservicesController@store');
Route::get('e_services/list','EservicesController@list')->name('eservices.list');
Route::post('/get-data/e-services','EservicesController@get_all');

Route::get('e_services/{eservices}/edit','EservicesController@edit')->name('e_services.edit');
Route::put('e_services/{eservices}/edit','EservicesController@update');
Route::get('e_services/delete/{eservices}','EservicesController@delete');
// Route::delete('e_services/{eservices}','EservicesController@destroy');



//sections
Route::view('sections/create','admin/sections/create')->name('create_new_section');
Route::post('sections/create','SectionsController@store');

Route::get('sections/list','SectionsController@list')->name('section_list');
Route::post('/get-data/sections' ,'SectionsController@get_all')->name('sections.get-data');
Route::get('/sections/delete/{id}' ,'SectionsController@delete')->name('sections.delete');

Route::get('sections/{section}/edit','SectionsController@edit');
Route::put('sections/{section}/edit','SectionsController@update');
Route::delete('sections/{section}','SectionsController@destroy');

//eservices orders
Route::get('eservices_orders/list','EservicesOrdersController@list')->name('eservices_orders_list');
Route::post('/get-data/eservices-orders','EservicesOrdersController@get_all');

Route::get('eservices_orders/{eservices_orders}/edit','EservicesOrdersController@edit')->name('eservices_orders.edit');
Route::put('eservices_orders/{eservices_orders}/edit','EservicesOrdersController@update');

//faq
Route::get('faq/index' ,'Admin\FaqController@index')->name('faq.index');
Route::get('faq/create' ,'Admin\FaqController@create')->name('faq.create');
Route::post('faq/store' ,'Admin\FaqController@store')->name('faq.store');
Route::get('faq/edit/{faq}' ,'Admin\FaqController@edit')->name('faq.edit');
Route::post('faq/save/{faq}' ,'Admin\FaqController@save')->name('faq.save');
Route::post('faq/get-data' ,'Admin\FaqController@get_all')->name('faq.get-data');
Route::get('faq/delete/{faq}' ,'Admin\FaqController@delete')->name('faq.get-delete');

//messages
Route::get('messages/index' ,'Admin\MessagesController@index')->name('messages.index');
Route::post('messages/get-data' ,'Admin\MessagesController@get_all')->name('messages.get-data');
Route::get('messages/show/{id}' ,'Admin\MessagesController@show')->name('messages.show');
Route::post('messages/reply' ,'Admin\MessagesController@reply')->name('messages.reply');
Route::post('/messages/new_message', 'Admin\MessagesController@newMessage')->name('messages.new_message');
Route::post('/except_ajax/see_new_message', 'Admin\MessagesController@seeNewMessage')->name('messages.see_new_message');
Route::any('/unreadNotifications', 'Admin\MessagesController@unreadNotifications')->name('unreadNotifications');
Route::any('/checkMessagesCount', 'Admin\MessagesController@checkMessagesCount')->name('checkMessagesCount');

//pages
Route::get('pages/index' ,'Admin\PagesController@index')->name('pages.index');
Route::get('pages/create' ,'Admin\PagesController@create')->name('pages.create');
Route::post('pages/store' ,'Admin\PagesController@store')->name('pages.store');

Route::post('pages/get-data' ,'Admin\PagesController@get_all')->name('pages.get-data');
Route::get('pages/edit/{page}' ,'Admin\PagesController@edit')->name('pages.edit');
Route::post('pages/save/{page}' ,'Admin\PagesController@save')->name('pages.save');
Route::get('pages/delete/{page}' ,'Admin\PagesController@delete')->name('pages.get-delete');

//coupon
Route::get('coupon/index' ,'Admin\CouponsController@index')->name('coupon.index');
Route::get('coupon/create' ,'Admin\CouponsController@create')->name('coupon.create');
Route::post('coupon/store' ,'Admin\CouponsController@store')->name('coupon.store');
Route::get('coupon/edit/{coupon}' ,'Admin\CouponsController@edit')->name('coupon.edit');
Route::post('coupon/save/{coupon}' ,'Admin\CouponsController@save')->name('coupon.save');
Route::post('coupon/get-data' ,'Admin\CouponsController@get_all')->name('coupon.get-data');
Route::get('coupon/delete/{coupon}' ,'Admin\CouponsController@delete')->name('coupon.get-delete');
Route::get('chat/{type}/{id}' ,'Admin\MessagesController@get_messages');

//config
Route::get('config/index' ,'Admin\ConfigsController@index')->name('config.index');
Route::get('config/create' ,'Admin\ConfigsController@create')->name('config.create');
Route::post('config/store' ,'Admin\ConfigsController@store')->name('config.store');
Route::get('config/edit/{config}' ,'Admin\ConfigsController@edit')->name('config.edit');
Route::post('config/save/{config}' ,'Admin\ConfigsController@save')->name('config.save');
Route::post('config/get-data' ,'Admin\ConfigsController@get_all')->name('config.get-data');
Route::get('config/delete/{config}' ,'Admin\ConfigsController@delete')->name('config.get-delete');
    Route::group(['prefix' => 'report', 'as' => 'report.', 'namespace' => 'Admin\Report'], function () {
        Route::get('/create', 'ReportController@create')->name('create');
        Route::post('/export', 'ReportController@export')->name('export');
    });

});
