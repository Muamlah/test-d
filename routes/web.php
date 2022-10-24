<?php

use App\Models\PrivateOrder;
use Illuminate\Support\Facades\Route;
use App\Traits\WhatsappGroupTrait;
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

Route::get('chat', 'Admin\ChatAPI@test');
//
//Route::get('/chat', function () {
//    WhatsappGroupTrait,
//   $data= PrivateOrder::find(100262);
//    $this->createWhatsappGroup($data);
//
//});


Route::post('password/phone', 'Website\Auth\ForgotPasswordController@sendPasswordByPhone')->name('password.phone')->middleware('throttle:7,60');

Route::get('/eservices/ajax/{last_id}', 'EservicesController@ajaxlist');
Route::any('/test', 'Website\ARBController@test');
Route::any('/unreadNotifications', 'Website\UserController@unreadNotifications')->name('unreadNotifications');
Route::any('/checkMessagesCount', 'Website\ChatController@checkMessagesCount')->name('checkMessagesCount');

Route::get('/test-2', 'Website\ARBController@generate_alrajhi_form');
Route::get('/payment-rag    ', 'Website\ARBController@check_alrajhi_response')->name('payment');


Route::get('/eservices/see-more', 'EservicesController@seeMore')->name('eServices.seeMore');


Route::get('/eservices', 'EservicesController@weblist')->name('weblist');
Route::post('/eservice-favorite', 'EservicesController@eserviceFavorite')->name('eserviceFavorite');
Route::get('/eservice-favorite-index', 'EservicesController@eserviceFavoriteIndex')->name('eserviceFavorite.index');
Route::post('/eservice-favorite-update', 'EservicesController@eserviceFavoriteUpdate')->name('eserviceFavorite.update');

Route::get('/section/{id}', 'EservicesController@databysection');
Route::get('section/eservices/{id}/see-more', 'EservicesController@sectionEservicesSeeMore')->name('section.eservices.seeMore');
Route::get('/eservices/supervisors/{service_id}', 'EservicesController@supervisors')->name('supervisors');
Route::get('/eservices/more_supervisors/', 'EservicesController@more_supervisors')->name('more_supervisors');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/eservices/{slug?}', 'EservicesController@webdetails')->name('webdetails');

    Route::get('/pay_eservice/{order_id}', 'EservicesOrdersController@payEservice')->name('payEservice');
    Route::post('/order_eservice/{eservice}', 'EservicesOrdersController@store');
    Route::post('/eservices_order/accept/{order_id}', 'EservicesOrdersController@accept');
    Route::get('/eservices_order/see-more', 'EservicesOrdersController@seeMore')->name('eServicesOrder.seeMore');
    Route::get('/eservices_order/provider-see-more', 'EservicesOrdersController@providerSeeMore')->name('eServices.providerSeeMore');
    Route::get('/eservices_orders/show/{order_id}', 'EservicesOrdersController@show_order')->name('eservices_orders.show');
    Route::get('/eservices_orders/myservice_details/{order_id}', 'EservicesOrdersController@show_myservice');

    Route::post('/eservices_orders/update-status/{order_id}/{status}', 'EservicesOrdersController@update_status');
    Route::post('/eservices_orders/update-status-client/{order_id}/{status}', 'EservicesOrdersController@update_status_client');
    Route::post('/eservices-orders/sendSMSOTP/{id}', 'EservicesOrdersController@sendSMSOTP')->name('eservicesOrders.sendSMS')->middleware('throttle:1,5,sendSMSOTP');
    // Route::get('/eservices/{id}', 'EservicesController@webdetails');
    Route::post('/share', 'EservicesController@shareCount')->name('shareCount');
    Route::get('/payment', 'EservicesController@payment');

    Route::get('eservices_orders/open-chat/{id}', 'EservicesOrdersController@open_chat')->name('eservices_orders.open_chat');

    Route::get('/eservices_orders/add_price/{order_id}/{service_id}/{slug}',
    'EservicesOrdersController@addPrice')->name('eservices_orders.addPrice');
    Route::post('/eservices_orders/add_price_post',
    'EservicesOrdersController@addPricePost')->name('eservices_orders.addPricePost');
});

//Route::view('/payment', 'website.eservices.payment');


Route::group(['namespace' => 'Website'], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::any('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('following-order/create-without-login', 'FollowingOrderController@createWithoutLogin')->name('createWithoutLogin');
    Route::post('following-order/store-without-login', 'FollowingOrderController@storeWithoutLogin')->name('followingOrder.storeWithoutLogin');
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('customer-register', 'Auth\RegisterController@showCustomerRegistrationForm')->name('customer.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ForgotPasswordController@reset')->name('password.request');
    //dd('hi');
    Route::get('/', 'HomeController@index')->name('website.home');
    Route::get('provider', 'HomeController@provider')->name('website.provider');
    Route::get('affiliate', 'HomeController@affiliate')->name('website.affiliate');
    Route::get('customers', 'HomeController@customers')->name('website.customers');
    Route::get('pricing', 'HomeController@pricing')->name('website.pricing');
    Route::get('agent', 'HomeController@agent')->name('website.agent');
    Route::get('supervisor-guide', 'HomeController@supervisorGuide')->name('website.supervisorGuide');
    Route::get('customer-guide', 'HomeController@customerGuide')->name('website.customerGuide');
    Route::post('settings/update-image', 'SettingsController@updateProfileImage')->name('website.update-image');
    Route::post('settings/update-profile', 'SettingsController@updateProfile')->name('website.update-profile');
    Route::post('settings/update-work-status', 'SettingsController@updateWorkStatus')->name('website.update-work-status');
    Route::get('tell-friend', 'SettingsController@tellFriend')->name('tellFriend');
    Route::post('tell-friend-post', 'SettingsController@tellFriendPost')->name('tellFriendPost');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('settings/select_agent', 'UserController@selectAgent')->name('user.select_agent');

    // الطلبات العامة
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/provider-see-more', 'OrderController@providerSeeMore')->name('orders.providerSeeMore');
    Route::get('/orders/user-see-more', 'OrderController@userSeeMore')->name('orders.userSeeMore');
    Route::get('/orders/eservices-see-more', 'OrderController@eservicesSeeMore')->name('orders.eservicesSeeMore');

    Route::get('public_settings', 'SettingsController@public_settings')->name('website.public_settings');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('settings', 'SettingsController@index')->name('website.settings');
        Route::get('settings/notifications', 'SettingsController@notifications')->name('website.settings.notifications');
        Route::post('settings/update_notification_status', 'SettingsController@update_notification_status')->name('website.settings.update_notification_status');

        //checkDate
        //        Route::get('/checkDate','WebsiteController@checkDate')->name('checkDate');


        //فحص اليوزر اذا فعل الحساب عن طريق كود التفعيل
        Route::get('phone/verify', 'PhoneVerificationController@show')->name('phoneVerification.notice');
        Route::post('phone/verify', 'PhoneVerificationController@verify')->name('phoneVerification.verify');

        Route::group(['middleware' => ['verified_phone']], function () {
            // الطلباااااات
            Route::post('/search-forbidden', 'OrderController@searchWord')->name('search-forbidden');


            Route::group(['prefix' => 'public_orders', 'as' => 'publicOrders.'], function () {
                // اضافة طلب تعميد عام
                Route::post('/store', 'OrderController@store')->name('store');
                Route::post('/storeProvider', 'OrderController@storeProvider')->name('storeProvider');
                // العروض
                Route::get('/offers/{id}', 'OffersController@index')->name('offers.show');
                Route::get('/{id}/add_offer', 'OffersController@create')->name('offers.create');
                Route::get('/{id}/edit_offer', 'OffersController@edit')->name('offers.edit');
                Route::post('/{id}/addOffer', 'OffersController@addOffer')->name('offers.addOffer');
                Route::patch('/{id}/editOffer', 'OffersController@editOffer')->name('offers.editOffer');
                Route::post('/acceptOffer/{offer_id}/{order_id}', 'OffersController@acceptOffer')->name('offers.acceptOffer');
                Route::get('/{id}/show', 'OffersController@show')->name('offers.showDetails');
                Route::get('/calculatePrice', 'OffersController@calculatePrice')->name('calculatePrice');
            });


            Route::get('notifications/{id}/show', 'NotificationController@show')->name('notifications.show');
            Route::group(['prefix' => 'following-order', 'as' => 'followingOrder.'], function () {
                //تعميد التابع
                Route::get('{privateOrder}/create', 'FollowingOrderController@create')->name('create');
                Route::post('store', 'FollowingOrderController@store')->name('store');

                // تعميد التابع للطلبات العامة
                Route::get('{publicOrder}/public_order_create', 'FollowingOrderController@createPublic')->name('createPublic');
                Route::post('storePublic', 'FollowingOrderController@storePublic')->name('storePublic');

                //                Route::get('/following_order/{id}', 'FollowingOrderController@details');
                //                Route::post('/following_order/{id}', 'FollowingOrderController@details');
            });

            Route::group(['prefix' => 'following-public-order', 'as' => 'followingPublicOrder.'], function () {
                //تعميد التابع
                Route::get('{publicOrder}/create', 'FollowingOrderController@createPublic')->name('create');
                Route::post('store', 'FollowingOrderController@store')->name('storePuplic');
                //
            });
            Route::group(['prefix' => 'my-orders', 'as' => 'privateOrder.'], function () {
                // طلباتي (تعميد خاص)
                Route::get('', 'PrivateOrderController@index')->name('index');
                Route::get('see-more', 'PrivateOrderController@seeMore')->name('seeMore');
                Route::get('/create', 'PrivateOrderController@create')->name('create');
                Route::post('/store', 'PrivateOrderController@store')->name('store');
                Route::get('{id}/show', 'PrivateOrderController@show')->name('show');
                Route::get('{privateOrder}/edit', 'PrivateOrderController@edit')->name('edit');
                Route::put('{privateOrder}/update', 'PrivateOrderController@update')->name('update');
                Route::post('/check-service-provider-phone', 'PrivateOrderController@checkServiceProviderPhone')->name('check-service-provider-phone');
                Route::get('/maping-private-order', 'PrivateOrderController@mapingPrivateOrder')->name('mapingPrivateOrder');

                Route::get('open-chat/{id}', 'PrivateOrderController@open_chat')->name('open_chat');


                Route::post('/send-sms/{id}', 'PrivateOrderController@sendSMSOTP')->name('sendSMS')->middleware('throttle:2,5,sendSMSOTP');
                Route::post('/send-email/{id}', 'PrivateOrderController@sendEmail')->name('sendEmail');
                Route::post('/update-status/{id}/{status}', 'PrivateOrderController@updateStatus')->name('updateStatus');
                //checkDate
                Route::get('/check-date', 'PrivateOrderController@checkDate')->name('checkDate');
            });

            Route::group(['prefix' => 'my-orders/public_orders', 'as' => 'publicOrders.'], function () {
                // طلباتي (تعميد عام)
                Route::get('/{id}/show', 'PublicOrderController@showDetails')->name('showDetails');
                Route::get('/{id}/edit', 'PublicOrderController@edit')->name('edit');
                Route::put('/{id}/update', 'PublicOrderController@update')->name('update');

                Route::post('/update-status/{id}/{status}', 'PublicOrderController@updateStatus')->name('updateStatus');

                Route::post('/send-sms/{id}', 'PublicOrderController@sendSMSOTP')->name('sendSMS')->middleware('throttle:2,5,sendSMSOTP');

                Route::post('/send-email/{id}', 'PublicOrderController@sendEmail')->name('sendEmail');

                Route::get('see-more', 'PublicOrderController@seeMore')->name('seeMore');
                Route::get('see-more-market', 'PublicOrderController@seeMoreMarket')->name('seeMoreMarket');
                Route::get('see-more-my-service', 'PublicOrderController@seeMoreMyService')->name('seeMoreMyService');


                //  Route::post('/send-sms/{id}', 'PublicOrderController@sendSMSOTP')->name('sendSMS');
                Route::get('open-chat/{id}', 'PublicOrderController@open_chat')->name('open_chat');


            });



            Route::group(['prefix' => 'hyperpay', 'as' => 'hyperpay.'], function () {
                Route::get('/response/{id}/{type}/{offer_id?}', 'HyperpayController@response')->name('response');
                Route::get('/{id}/{type}/{offer_id?}', 'HyperpayController@index')->name('index');
            });
            Route::group(['prefix' => 'payment', 'as' => 'rajhiBank.'], function () {
                //                Route::post('/response/{id}/{type}', 'ARBController@response')->name('response');
                Route::get('/{id}/{type}', 'ARBController@index')->name('index');
            });
            Route::group(['prefix' => 'payment', 'as' => 'balance.'], function () {
//                Route::post('/response/{id}/{type}', 'ARBController@response')->name('response');
                Route::get('/{id}', 'BalanceController@private_order_index')->name('private_order_index');
                Route::get('private_order/payment_from_balance/{id}', 'BalanceController@private_order_payment_from_balance')->name('private_order_payment_from_balance');

                Route::get('public_order/balance/{id}/{offer_id?}', 'BalanceController@public_order_index')->name('public_order_index');
                Route::get('public_order/payment_from_balance/{id}/{offer_id?}', 'BalanceController@public_order_payment_from_balance')->name('public_order_payment_from_balance');
//                Route::get('/{id}', 'BalanceController@index')->name('index');
                Route::get('eservice-pay/balance/{id}', 'BalanceController@eservicePay')->name('eservicePay');
                Route::get('eservice-store/balance/{id}', 'BalanceController@eserviceStore')->name('eserviceStore');
                Route::get('eservice-store-second/balance/{id}', 'BalanceController@eserviceStoreSecond')->name('eserviceStoreSecond');

            });

            Route::group(['prefix' => 'private-service', 'as' => 'privateService.'], function () {
                // خدماتي (تعميد خاص)
                Route::get('', 'PrivateServiceController@index')->name('index');
                Route::get('see-more', 'PrivateServiceController@seeMore')->name('seeMore');
                Route::get('/{id}', 'PrivateServiceController@show')->name('show');
                Route::post('/update-status/{id}/{status}', 'PrivateServiceController@updateStatus')->name('updateStatus');
//                Route::get('/update-status/{id}/{status}', 'PrivateServiceController@updateStatus')->name('updateStatus');
            });

            Route::group(['prefix' => 'public_services', 'as' => 'publicService.'], function () {
                // خدماتي (تعميد عام)
                Route::get('/{id}', 'PublicServiceController@show')->name('show');
                Route::post('/update-status/{id}/{status}', 'PublicServiceController@updateStatus')->name('updateStatus');
            });

            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
                ////تفعيل الحساب عن طريق الكود التفعيل
                Route::get('/confirm-code/{id}', 'Auth\RegisterController@confirmCode')->name('confirmCode');
                Route::post('/active-code', 'Auth\RegisterController@activeCode')->name('activeCode');

                Route::get('/profile', 'UserController@profile')->name('profile');
                Route::post('/update-profile', 'UserController@updateProfile')->name('updateProfile');
                Route::post('/store-files', 'UserController@storeFiles')->name('storeFiles');

                Route::get('{type}/verify', 'VerificationController@show')->name('verificationController.notice');
                Route::post('{type}/verify', 'VerificationController@verify')->name('verification.verify');

                Route::get('/reviews', 'ReviewController@reviews')->name('reviews');
                Route::get('/reviews-form/{order_type}/{order_id}/{provider_id}', 'ReviewController@reviewsForm')->name('reviewsForm');
                Route::post('/make-reviews', 'ReviewController@makeReviews')->name('makeReviews');


                // بيانات الحساب البنكي
                //                Route::get('/credit_card', 'Muamlah\UserDashboardController@getCreditCard')->name('creditCard');
                Route::post('/update-credit-card', 'UserController@updateCreditCard')->name('updateCreditCard');
                // الفواتير
                //                Route::get('/invoices', 'Muamlah\UserDashboardController@getInvoices')->name('invoices');
                // الرصيد
                Route::get('/wallet', 'WalletController@index')->name('balance');
                Route::post('/wallet/use/gift', 'WalletController@use_gift')->name('use_gift');
                Route::get('/seeMoreTransactions', 'WalletController@seeMoreTransactions')->name('seeMoreTransactions');
                Route::get('/seeMoreBills', 'WalletController@seeMoreBills')->name('seeMoreBills');
                Route::get('/seeMoreBalanceRequest', 'WalletController@seeMoreBalanceRequest')->name('seeMoreBalanceRequest');
                Route::get('/print_pdf/{id}/{type}', 'WalletController@print_pdf')->name('print_pdf');

                Route::post('/withdrawal', 'WalletController@withdrawalBalance')->name('withdrawal');

                //                Route::post('/edit_value/{order}', 'PrivateOrderController@edit_value');
                //                Route::get('/edit_value/{order}', 'PrivateOrderController@edit_value');
                //                Route::post('/update_order_value/{order}', 'PrivateOrderController@update_order_value');
                //                Route::post('/new_value_update/{order}', 'PrivateOrderController@new_value_update');

                Route::get('/agents/list', 'UserController@agents_list')->name('agents_list');
                Route::get('/agents/more_data', 'UserController@agents_more_data')->name('agents_more_data');
                Route::get('/agents/set_agent/{agent_id}', 'UserController@set_agent')->name('set_agent');
                Route::get('/agents/cancel_agent/{agent_id}', 'UserController@cancel_agent')->name('cancel_agent');
                Route::get('/agents/refuse_agent/{client_id}', 'UserController@refuse_agent')->name('refuse_agent');
            });
        });
    });

    Route::get('/faqs/index', 'FaqController@index')->name('faqs.index');
    Route::get('/pages/updates', 'PagesController@updates')->name('pages.updates');
    Route::get('/pages/index', 'PagesController@index')->name('pages.index');
    Route::get('/pages/details/{page}', 'PagesController@details')->name('pages.details');
    Route::get('/pages/manual', 'PagesController@manual')->name('pages.manual');
    Route::get('/thanks', 'PagesController@thanks')->name('page.thanks');

    //messsages
    Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
        Route::get('/index', 'MessagesController@index')->middleware('auth:web')->name('index');
        Route::get('/seeMoreMessages', 'MessagesController@seeMoreMessages')->name('seeMoreMessages');
        Route::get('/chat/{message_id}', 'MessagesController@chat')->name('chat');
        Route::post('/chat/new_message', 'MessagesController@newMessage')->name('chat.new_message');

        Route::get('/support', 'MessagesController@form')->name('form');
        Route::post('/support/send', 'MessagesController@send')->name('send');
        Route::post('/store_file', 'MessagesController@storeFile')->name('store_file');
    });

    //chat
    Route::group(['middleware' => ['auth'],'prefix' => 'chat', 'as' => 'chat.'], function () {
//        Route::get('/index', 'MessagesController@index')->middleware('auth:web')->name('index');
//        Route::get('/seeMoreMessages', 'MessagesController@seeMoreMessages')->name('seeMoreMessages');
        Route::get('/{message_id}', 'ChatController@chat')->name('start');
        Route::get('open_agent_chat/{user_id2}', 'ChatController@open_agent_chat')->name('open_agent_chat');
        Route::post('/chat/new_message', 'ChatController@newMessage')->name('chat.new_message');
        Route::post('/except_ajax/see_new_message', 'ChatController@seeNewMessage')->name('chat.see_new_message');
//        Route::get('/support', 'MessagesController@form')->name('form');
        Route::post('/send', 'ChatController@send')->name('send');
        Route::post('/store_file', 'ChatController@storeFile')->name('store_file');
    });

});

// import users routes

Route::get('/import/users/customers', 'ImportUsersController@imaportCustomers');
Route::get('/import/users/providers', 'ImportUsersController@imaportProviders');

//firebase
Route::group(['prefix' => 'firebase', 'as' => 'firebase.'], function () {
    Route::post('/save_web_token', 'Website\FirebaseController@save_web_token')->name('save_web_token');
    Route::get('/test', 'Website\FirebaseController@test')->name('test');
});
Route::get('/share/profile/{slug}/{id}/{type}', 'Website\UserController@share_profile')->name('share_profile');
Route::get('/share/profile/show_more_services/{id}', 'Website\UserController@show_more_services')->name('share_profile.show_more_services');
Route::get('/share/profile/show_more_reviews/{id}', 'Website\UserController@show_more_reviews')->name('share_profile.show_more_reviews');

Route::get('/order_eservice/notify_customers', 'EservicesOrdersController@notify_customers');
Route::get('/public_orders/notify_customers', 'Website\PublicOrderController@notify_customers');
Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap.index');
Route::get('/eservices/maps/sitemap.xml', 'SitemapController@eservices_sitemap')->name('eservices.sitemap');
Route::get('/providers/maps/sitemap.xml', 'SitemapController@providers_sitemap')->name('providers.sitemap');
Route::get('/invoice/view/{code}/{type}', 'Website\WalletController@view_invoice')->name('view_invoice');

//Zoho
Route::group(['prefix' => 'zoho', 'as' => 'zoho.', 'namespace' => 'Zoho'], function () {
    Route::get('/createContacts', 'MainController@createContacts')->name('createContacts');
    Route::get('/createVendors', 'MainController@createVendors')->name('createVendors');
});

Route::get('/odoo-login', 'Website\OdooController@login');
Route::get('/odoo-newUser', 'Website\OdooController@newUser');
