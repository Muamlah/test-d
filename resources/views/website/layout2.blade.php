<!DOCTYPE HTML>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {!! settings()->script_google_analytics !!}
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
    <title>منصة معاملة . كوم</title>
    {{-- @if(\Route::getCurrentRoute()->getActionName() != 'App\Http\Controllers\EservicesController@webdetails')
        @include('website.includes.meta')
    @endif --}}
{{--    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=611d620a24e1d800128eaebe&product=sop' async='async'></script>--}}
    @yield('pageMeta')
    <style type="text/css">
        .wallet-tabs{
            width: 25% !important;
        }
        .page-item.active .page-link {
            border-color: #2d7335 !important;
            background-color: #2d7335 !important;
            color: white !important;
        }

        .pagination .page-link {
            color: black !important;
        }
        .page-content{
            transform: none !important;
        }
        .service-provider-validator {
            padding: 10px 10px 0 10px;
            font-size: 13px;
        }
        .f-b, .f-b:hover{
            color: #fff
        }
        .old-price{
            font-size: 16px;
            text-decoration: line-through;
            color: #fa0505;
        }
        .discount{
            color:red;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/jquery.rateyo.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/style.css?v=10")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/main.css?v=10")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/flatpickr.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/fonts/css/fontawesome-all.min.css")}}">
    <link rel="manifest" href="{{asset("template-muamlah/_manifest.json")}}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset("template-muamlah/app/icons/icon-192x192.png")}}">
    @yield('style')
    <script src="https://cdn.pagesense.io/js/muamlah/1601c5fd30c5411ebc01e29a7fe966d7.js"></script>

</head>

<body class="theme-light " data-background="none" data-highlight="green3">
{!! settings()->iframe_google_analytics !!}
<div id="preloader">
    <div class="spinner-border color-highlight" role="status"></div>
</div>

<div id="page">
    @if (Session::get('login_success') )
        <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" style="z-index: 1000;margin-top: 50px;" role="alert">
            <span><i class="fa fa-check"></i></span>
            <strong>{{Session::get('login_success')}}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;
            </button>
        </div>
    @endif
    <div class="header header-demo header-logo-right">
        <a href="{{url('/')}}" class="header-logo"><span class="title-logo">منصة معاملة</span></a>
        <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
        <a href="{{route('user.profile')}}" class="header-icon header-icon-2"><i class="fas fa-user"></i></a>
        <a href="{{route('messages.index')}}" class="header-icon header-icon-3"><i class="fas fa-envelope"></i><span class="badge bg-red2-dark h-auto" id="messages-count" style="{{$un_seen_messages_count == 0 ? "opacity:0" : ''}}">{{$un_seen_messages_count}}</span></a>
        @guest
            <a href="#" data-toast="notification-1" class="header-icon header-icon-4"><i class="fas fa-bell"></i></a>
            <div id="notification-1" data-dismiss="notification-1" data-autohide="false"
                 class="notification notification-ios sm-screen bg-gray2-dark notch-push fade hide">
            <span class="notification-icon">
                <i class="fa fa-bell"></i>
                <em>التنبيهات</em>
                <i data-dismiss="notification-1" class="fa fa-times-circle"></i>
            </span>

            </div>
        @else

            <a href="javascript:;"  data-toast="notification-1" class="header-icon header-icon-4"><i class="fas fa-bell"></i>@if(Auth::user()->unreadNotifications->count() !=0) <span class="badge bg-red2-dark h-auto" id="notification-count">{{Auth::user()->unreadNotifications->count()}}</span>@endif</a>

            <div id="notification-1" data-dismiss="notification-1"  data-autohide="false"
                 class="notification notification-ios sm-screen bg-gray2-dark notch-push fade hide">
            <span class="notification-icon">
                <i class="fa fa-bell"></i>
                <em>التنبيهات</em>
                <i data-dismiss="notification-1" class="fa fa-times-circle"></i>
            </span>
                <span id="unreadNotifications">


                @foreach (Auth::user()->unreadNotifications as $notification)
                    {{--                        <a href="{{  route ('notifications.show',$notification->id)}}"> {{$notification->data['message']}}</a>--}}
                    {{--                        <div class="divider mb-2 mt-2"></div>--}}
                    <a href="{{  route ('notifications.show',$notification->id)}}">
                        <p class="pt-2">
                            {{$notification->data['message']}}
                        </p>
                    </a>
                    <div class="w-100 divider mb-2 bg-divider"></div>
                @endforeach
                </span>
            </div>

        @endguest
    </div>
    <div id="footer-bar" class="footer-bar-1">
        @yield('footer-top')
        <a href="{{route('website.home')}}" class="{{ (strpos(Route::currentRouteName(), 'website.home') === 0) ? 'active-nav' : '' }} "><i class="fa fa-home"></i><span>الصفحة الرئيسية</span></a>
        <a href="{{ route('weblist')}}" class="{{ (strpos(Route::currentRouteName(), 'weblist') === 0) ? 'active-nav' : '' }} "><i class="fa fa-briefcase"></i><span>الخدمات</span></a>
        <a href="{{route('privateOrder.create')}}" class="{{ (strpos(Route::currentRouteName(), 'privateOrder.create') === 0) ? 'active-nav' : '' }} "><i class="fa fa-star"></i><span>تعميد</span></a>
        <a href="{{ route('orders.index') }}" class="{{ (strpos(Route::currentRouteName(), 'orders.index') === 0) ? 'active-nav' : '' }} "><i class="fa fa-box-open"></i><span>الطلبات</span></a>
        {{-- <a href="{{ route('privateOrder.index') }}" class="{{ (strpos(Route::currentRouteName(), 'privateOrder.index') === 0) ? 'active-nav' : '' }} "><i class="fa fa-box-open"></i><span>الطلبات</span></a> --}}
        @if(auth()->check())
            <a href="{{ route('website.settings') }}" class="{{ (strpos(Route::currentRouteName(), 'website.settings') === 0) ? 'active-nav' : '' }} "><i class="fa fa-cog"></i><span>الإعدادات</span></a>
        @else
            <a href="{{ route('website.public_settings') }}" class="{{ (strpos(Route::currentRouteName(), 'website.public_settings') === 0) ? 'active-nav' : '' }} "><i class="fa fa-cog"></i><span>الإعدادات</span></a>
        @endif
    </div>
    <!-- Page Content-->
{{-- <div class="page-content header-clear-medium">--}}
@yield('content')
{{-- </div>--}}
<!-- End of Page Content-->

</div>

<script type="text/javascript" src="{{asset("template-muamlah/scripts/jquery.js")}}"></script>
@include('website.includes.desktop_firebase_notifications')
<script type="text/javascript" src="{{asset("template-muamlah/scripts/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/custom.js")}}"></script>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/flatpickr.js")}}"></script>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/jquery.rateyo.min.js")}}"></script>
@yield('script')

<script>

    function toEnglishNumber(strNum) {
        var pn = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
        var en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        var an = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
        var cache = strNum;
        for (var i = 0; i < 10; i++) {
            var regex_fa = new RegExp(pn[i], 'g');
            var regex_ar = new RegExp(an[i], 'g');
            cache = cache.replace(regex_fa, en[i]);
            cache = cache.replace(regex_ar, en[i]);
        }
        return cache;
    }
    $('input[type="number"],input[type="phone"],input[type="tel"],input[name="phone"],input[name="phone_numer"],input[name="price"]').on('input', function() {
        var val = $(this).val();
        $(this).val(toEnglishNumber(val));
    });
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('كلمة المرور متطابقة').css('color', 'green');
            $('#pass_save').removeAttr('disabled')

        } else {
            $('#pass_save').attr('disabled', 'true')
            $('#message').html('كلمة المرور غير متطابقة').css('color', 'red');
        }

    });
</script>
<script type="text/javascript">

    function get_user() {
        console.log('50') ;
    }
    function check_messages_count() {
        $.ajax({
            url: "{{ route('checkMessagesCount') }}",
            type: "GET",
            data: {
                _token: "{{csrf_token()}}",
            },
            success: function (response) {
                if (response.error == 0) {
                    if(response.data != 0){
                        $('#messages-count').html(response.data).css('opacity','1');
                    }
                }
            }
        });
    }
    setInterval(check_messages_count, 60000);
    function unreadNotifications() {
        $('#unreadNotifications').html("");
        $.ajax({
            url: "{{ route('unreadNotifications') }}",
            type: "GET",
            data: {
                _token: "{{csrf_token()}}",
            },
            success: function (response) {
                if (response.error == 0) {
                    $('#unreadNotifications').html(response.data);
                }
            }
        });
    }

if (document.getElementById('basicFlatpickr')!=null){
    var f1 = flatpickr(document.getElementById('basicFlatpickr'), {
        defaultDate: Date.now(),
        disableMobile: "true",
    });
    // var f2 = flatpickr(document.getElementById('timeFlatpickr'), {
    //     enableTime: true,
    //     noCalendar: true,
    //     dateFormat: "H:i",
    //     defaultDate: "23:00"
    // });
    var f1 = flatpickr($('.max-date'), {
        defaultDate: Date.now(),
        minDate: Date.now(),
        disableMobile: "true",
    });
}



</script>
<script type="text/javascript" id="zsiqchat">
        var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "10e51a53118a1e3bc608ee086d2640f0b1d6b3e27f0d0d6a8f2b895ccadf0caa", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);
    </script>
</body>
<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '430028418749905');
    fbq('track', 'PageView');
</script>

<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=430028418749905&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->
</html>
