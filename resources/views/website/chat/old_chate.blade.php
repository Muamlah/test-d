<!DOCTYPE HTML>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {!! settings()->script_google_analytics !!}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
    <title>منصة معاملة . كوم</title>
    {{-- @if(\Route::getCurrentRoute()->getActionName() != 'App\Http\Controllers\EservicesController@webdetails')
        @include('website.includes.meta')
    @endif --}}
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=611d620a24e1d800128eaebe&product=sop' async='async'></script>
    @yield('pageMeta')
    <style type="text/css">
        .page-item.active .page-link {
            border-color: #2d7335 !important;
            background-color: #2d7335 !important;
            color: white !important;
        }

        .pagination .page-link {
            color: black !important;
        }

        .service-provider-validator {
            padding: 10px 10px 0 10px;
            font-size: 13px;
        }
        .f-b, .f-b:hover{
            color: #fff
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/jquery.rateyo.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/style.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/main.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/flatpickr.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/fonts/css/fontawesome-all.min.css")}}">
    <link rel="manifest" href="{{asset("template-muamlah/_manifest.json")}}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset("template-muamlah/app/icons/icon-192x192.png")}}">

</head>

<body class="theme-light" data-background="none" data-highlight="green3">
<div id="preloader">
    <div class="spinner-border color-highlight" role="status"></div>
</div>

<div id="page">
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
    <div id="footer-bar" class="d-flex footer-bar-1 bg-white">
        <div class="mr-3 speach-icon">
            <a href="#" data-menu="menu-upload" class="bg-gray2-dark ml-2"><i class="fa fa-plus"></i></a>
        </div>
        <div class="flex-fill speach-input">
            <input type="text" class="form-control"  placeholder="أدخل رسالتك هنا" id="message_text">
        </div>
        <div class="ml-3 speach-icon">
            <button type="button" id="send_message" class="bg-btn-whatsapp  color-white mr-2 button-message"><i
                    class="fa fa-arrow-up"></i></button>
        </div>
    </div>

    <div  class=" page-content header-clear-medium whatsapp-bg" style="  overflow: scroll;">
        <div class="content">
            <div class="text-center mb-3 p-1 shadow-m chat-alert">
                <p class="font-11 lh-n1">لا تعطي كلمة المرور لأي شخص مهما كان،
                موظفي منصة معاملة لا يطلبون كلمة المرور ولا بياناتك السرية،
                كن حريصاً عليها</p>
            </div>
            <div id="scroll" class="content scroll"  id="messages">
                @foreach($message->children as $child)
                    @if(!is_null($child->file))
                        <div class="clearfix"></div>
                        <div class="speech-bubble speach-image speech-{{auth()->user()->id == $child->user_id ? 'left bg-msg-send mb-3' : 'right bg-msg-r mb-3'}} bg-highlight message-item" data-id="{{ $child->id }}">
                            @if($child->getFile('ext') == 'image')
                                <a href="{{$child->getFile()}}" download>
                                    <img class="img-fluid preload-img" src="{{$child->getFile()}}" data-src="{{$child->getFile()}}">
                                </a>
                            @else
                                <a href="{{$child->getFile()}}" download class="bg-highlight color-white mr-2 button-message m-3">
                                    <i class="fa fa-arrow-down"></i> تحميل الملف المرفق
                                </a>
                            @endif
                                </a>
                        </div>
                    @else
                        <div class="clearfix"></div>
                        <div class="speech-bubble speech-{{auth()->user()->id == $child->user_id ? 'left bg-msg-send mb-3' : 'right bg-msg-r mb-3'}}" data-id="{{ $child->id }}">
                            @if(auth()->user()->id == $child->user_id)
                                <p style="font-size: 13px">{{$child->name}}</p>
                            @else
                                <p style="font-size: 13px">المشرف: {{$child->name}}</p>
                            @endif
                            {!!$child->message!!}
                        </div>
                    @endif
                @endforeach
                <div id="children" class="order-chat">
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Content-->
    <div id="menu-upload" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="100"
         data-menu-effect="menu-over">
        <div class="list-group list-custom-small pl-2 mr-4">
            <a  href="javascript:;" onclick="uploadFile()">
                <i class="font-14 fa fa-file color-gray2-dark"></i>
                <span class="font-13">ملف</span>
                <i class="fa fa-angle-left"></i>
            </a>
            <a  href="javascript:;" onclick="uploadFile()">
                <i class="font-14 fa fa-image color-gray2-dark"></i>
                <span class="font-13">صورة</span>
                <i class="fa fa-angle-left"></i>
            </a>
        </div>
    </div>
    <form method="POST" enctype="multipart/form-data" id="ajax-file-upload" action="javascript:void(0)" style="visibility: hidden">
        @csrf
        <input type="hidden" name="parent_id" id="message_parent_id" value="{{$message->id}}">
        <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="file" placeholder="اختر الملف" id="file">
        <span class="text-danger">{{ $errors->first('file') }}</span>
    </form>
</div>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/jquery.js")}}"></script>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/custom.js")}}"></script>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/flatpickr.js")}}"></script>
<script type="text/javascript" src="{{asset("template-muamlah/scripts/jquery.rateyo.min.js")}}"></script>
<script>
    function sendMessage() {
        $('#message_text').css('border-color', '#ff000000');
        let message = $('#message_text').val();
        // console.log(message)
        if (message == "") {
            $('#message_text').css('border-color', '#ff000038');
            return;
        }
        $.ajax(
            {
                url: "{{route('chat.chat.new_message')}}",
                type: "POST",
                data: {
                    message: message,
                    _token: "{{csrf_token()}}",
                    parent_id: "{{$message->id}}"
                },
                beforeSend: function () {
                    $('#message_text').val("");

                    $('#message_text').css('border-color', '#ff000000');
                }
            })
            .done(function (data) {
                $('#message_text').css('border-color', '#ff000000');
                if (data.html != "") {
                    $('#message_text').val("");
                    // $('#children').append(data.html);
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                $('#message_text').css('border-color', '#ff000000');
                alert('الرجاء المحاولة مرة اخرى');
            });
    }

    $('#send_message').on('click', sendMessage);


    $('#message_text').on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            sendMessage();
        }
    });
</script>
<script type="text/javascript">
    function uploadFile() {
        $('#file').click();
    }

    $("#file").change(function () {
        $("#ajax-file-upload").submit();
    });
    $(document).ready(function (e) {
        $('#ajax-file-upload').submit(function (e) {
            $('#message_text').val("");
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('chat.store_file')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.html != "") {
                        $('#message_text').val("");
                        // $('#children').append(data.html);
                        $('.menu-active').removeClass('menu-active');
                        $('.theme-light').removeClass('modal-open');
                        $('#footer-bar').removeClass('footer-menu-hidden');
                        var div  = document.getElementById('scroll');
                        console.log(div);
                        console.log('safsad');
                        $('.scroll').animate({
                            scrollTop: div.scrollHeight + div.clientHeight
                        }, 1);
                    }
                },
                error: function (data) {
                    alert(data);
                }
            });
        });
    });

    function getLastId() {
        var last_item = $('#children').find('.message-item').last();
        var last_id = 0;
        if (last_item.length > 0) {
            last_id = last_item.data('id');
        }
        return last_id
    }

    var last_id = '{{!empty($message->children->last()) ? $message->children->last()->id : 0}}';

    function seeNewMessages() {
        var parent_id = $('#message_parent_id').val();
        // console.log(last_id);
        $.ajax(
            {
                url: "{{route('chat.chat.see_new_message')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    parent_id: parent_id,
                    last_id: last_id
                }
            })
            .done(function (data) {
                if (data.html != "") {
                    $('#children').append(data.html);
                    last_id = getLastId();

                    var div = document.getElementById('scroll');
                    console.log(div);
                    div.scrollTop = div.scrollHeight - div.clientHeight;

                    console.log(div.scrollHeight );
                    console.log(div.clientHeight);
                    $('.scroll').animate({
                        scrollTop: 800
                    }, 1);

                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('الرجاء المحاولة مرة اخرى');
            });
    }

    setInterval(seeNewMessages, 3000);
</script>
</body>

</html>



{{--@extends('website.layout')--}}
{{--@section('content')--}}
{{--    <div id="footer-bar" class="d-flex footer-bar-1 bg-white">--}}
{{--        <div class="mr-3 speach-icon">--}}
{{--            <a href="#" data-menu="menu-upload" class="bg-gray2-dark ml-2"><i class="fa fa-plus"></i></a>--}}
{{--        </div>--}}
{{--        <div class="flex-fill speach-input">--}}
{{--            <input type="text" class="form-control"  placeholder="أدخل رسالتك هنا" id="message_text">--}}
{{--        </div>--}}
{{--        <div class="ml-3 speach-icon">--}}
{{--            <button type="button" id="send_message" class="bg-btn-whatsapp  color-white mr-2 button-message"><i--}}
{{--                    class="fa fa-arrow-up"></i></button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="page-content header-clear-medium whatsapp-bg">--}}

{{--        <div class="content"  id="messages">--}}
{{--            @foreach($message->children as $child)--}}
{{--                @if(!is_null($child->file))--}}
{{--                    <div class="clearfix"></div>--}}
{{--                    <div class="speech-bubble speach-image speech-left bg-highlight message-item" data-id="{{ $child->id }}">--}}
{{--                        @if($child->getFile('ext') == 'image')--}}
{{--                            <a href="{{$child->getFile()}}" download>--}}
{{--                                <img class="img-fluid preload-img" src="{{$child->getFile()}}" data-src="{{$child->getFile()}}">--}}
{{--                            </a>--}}
{{--                        @else--}}
{{--                            <a href="{{$child->getFile()}}" download class="bg-highlight color-white mr-2 button-message m-3">--}}
{{--                                <i class="fa fa-arrow-down"></i> تحميل الملف المرفق--}}
{{--                            </a>--}}
{{--                            @endif--}}
{{--                            </a>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="clearfix"></div>--}}
{{--                    <div class="speech-bubble speech-{{auth()->user()->id == $child->user_id ? 'left bg-msg-send mb-3' : 'right bg-msg-r mb-3'}}" data-id="{{ $child->id }}">--}}
{{--                        {!!$child->message!!}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--                <div id="children" class="order-chat">--}}
{{--        </div>--}}


{{--    </div>--}}
{{--    <!-- End of Page Content-->--}}
{{--    <div id="menu-upload" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="100"--}}
{{--         data-menu-effect="menu-over">--}}
{{--        <div class="list-group list-custom-small pl-2 mr-4">--}}
{{--            <a href="#">--}}
{{--                <i class="font-14 fa fa-file color-gray2-dark"></i>--}}
{{--                <span class="font-13">ملف</span>--}}
{{--                <i class="fa fa-angle-left"></i>--}}
{{--            </a>--}}
{{--            <a href="#">--}}
{{--                <i class="font-14 fa fa-image color-gray2-dark"></i>--}}
{{--                <span class="font-13">صورة</span>--}}
{{--                <i class="fa fa-angle-left"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}{{--    --}}
{{--    <div class="page-content header-clear-medium">--}}
{{--        <div class="card card-style bg-grey-c card-order" data-card-height="130">--}}
{{--            <div class="card-center text-center">--}}
{{--                <h1 class="color-white mb-0">{{$message->subject}}</h1>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card card-style  whatsapp-bg">--}}
{{--            <div class="content" id="messages">--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="speech-bubble speech-left bg-msg-send " data-id="{{ $message->id }}">--}}
{{--                    {!!$message->message!!}--}}
{{--                </div>--}}
{{--                @foreach($message->children as $child)--}}
{{--                    @if(!is_null($child->file))--}}
{{--                        <div class="clearfix"></div>--}}
{{--                        <div class="speech-bubble speach-image speech-left bg-highlight message-item" data-id="{{ $child->id }}">--}}
{{--                            @if($child->getFile('ext') == 'image')--}}
{{--                                <a href="{{$child->getFile()}}" download>--}}
{{--                                    <img class="img-fluid preload-img" src="{{$child->getFile()}}" data-src="{{$child->getFile()}}">--}}
{{--                                </a>--}}
{{--                            @else--}}
{{--                                <a href="{{$child->getFile()}}" download class="bg-highlight color-white mr-2 button-message m-3">--}}
{{--                                    <i class="fa fa-arrow-down"></i> تحميل الملف المرفق--}}
{{--                                </a>--}}
{{--                                @endif--}}
{{--                                </a>--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="clearfix"></div>--}}
{{--                        <div class="speech-bubble   speech-{{auth()->user()->id == $child->user_id ? 'left bg-msg-r' : 'right bg-msg-send'}}" data-id="{{ $child->id }}">--}}
{{--                            {!!$child->message!!}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                <div id="children" class="order-chat">--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <em class="speech-read mb-3">Delivered & Read - 07:18 PM</em>--}}

{{--            </div>--}}
{{--            <form action="">--}}
{{--                <div class="d-flex footer-bar-1 bg-white" style="min-height: 60px">--}}
{{--                    <div class="mr-3 speach-icon">--}}
{{--                        <a href="#" data-menu="menu-upload" class="bg-gray2-dark ml-2 text-center"><i--}}
{{--                                class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="flex-fill speach-input">--}}
{{--                        <textarea class="form-control" placeholder="أدخل رسالتك هنا" id="message_text"></textarea>--}}
{{--                    </div>--}}
{{--                    <div class="ml-3 speach-icon">--}}
{{--                        <button type="button" id="send_message" class="bg-btn-whatsapp  color-white mr-2 button-message"><i--}}
{{--                                class="fa fa-arrow-up"></i></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div id="menu-upload" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="100"--}}
{{--         data-menu-effect="menu-over">--}}
{{--        <div class="list-group list-custom-small pl-2 mr-4">--}}
{{--            <a href="javascript:;" onclick="uploadFile()">--}}
{{--                <i class="font-14 fa fa-file color-gray2-dark"></i>--}}
{{--                <span class="font-13">ملف</span>--}}
{{--                <i class="fa fa-angle-left"></i>--}}
{{--            </a>--}}
{{--            <a href="javascript:;" onclick="uploadFile()">--}}
{{--                <i class="font-14 fa fa-image color-gray2-dark"></i>--}}
{{--                <span class="font-13">صورة</span>--}}
{{--                <i class="fa fa-angle-left"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <form method="POST" enctype="multipart/form-data" id="ajax-file-upload" action="javascript:void(0)" style="visibility: hidden">--}}
{{--        @csrf--}}
{{--        <input type="hidden" name="parent_id" id="message_parent_id" value="{{$message->id}}">--}}
{{--        <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="file" placeholder="اختر الملف" id="file">--}}
{{--        <span class="text-danger">{{ $errors->first('file') }}</span>--}}
{{--    </form>--}}



{{--    <div id="page">--}}
{{--        <div class="header header-demo header-logo-right">--}}
{{--            <a href="home.html" class="header-logo"> <span class="title-logo">منصة معاملة</span> </a>--}}
{{--            <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>--}}
{{--            <a href="profile.html" class="header-icon header-icon-2"><i class="fas fa-user"></i></a>--}}
{{--            <a href="#" class="header-icon header-icon-3"><i class="fas fa-envelope"></i><span--}}
{{--                    class="badge bg-red2-dark h-auto">5</span></a>--}}
{{--            <a href="#" class="header-icon header-icon-4"><i class="fas fa-bell"></i></a>--}}
{{--        </div>--}}
{{--        <div id="footer-bar" class="d-flex footer-bar-1 bg-white">--}}
{{--            <div class="mr-3 speach-icon">--}}
{{--                <a href="#" data-menu="menu-upload" class="bg-gray2-dark ml-2"><i class="fa fa-plus"></i></a>--}}
{{--            </div>--}}
{{--            <div class="flex-fill speach-input">--}}
{{--                <input type="text" class="form-control" placeholder="أدخل رسالتك هنا">--}}
{{--            </div>--}}
{{--            <div class="ml-3 speach-icon">--}}
{{--                <a href="#" class="bg-btn-whatsapp mr-2"><i class="fa fa-arrow-up"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="page-content header-clear-medium whatsapp-bg">--}}

{{--            <div class="content">--}}
{{--                <div class="speech-bubble speech-right bg-msg-r">--}}
{{--                    السلام عليكم ورحمة اللّه وبركاته--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="speech-bubble speech-left bg-msg-send mb-0">--}}
{{--                    وعليكم السلام ورحمة اللّه وبركاته--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <em class="speech-read mb-3"><i class="fas fa-check-double check-color"></i></em>--}}
{{--                <div class="speech-bubble speech-left bg-msg-send mb-0">--}}
{{--                    كيف يمكنني مساعدتك--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <em class="speech-read mb-3"><i class="fas fa-check-double check-color"></i></em>--}}
{{--                <div class="speech-bubble speech-right bg-msg-r">--}}
{{--                    تعميد رقم #67667--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <p class="text-center mb-0 font-11">اليوم, 1:45 AM</p>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="speech-bubble speech-left bg-msg-send mb-0">--}}
{{--                    تم إنجاز التعميد--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <em class="speech-read mb-3"><i class="fas fa-check-double check-color"></i></em>--}}
{{--                <div class="speech-bubble speech-right bg-msg-r">--}}
{{--                    تم الإستلام--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="speech-bubble speech-right bg-msg-r">--}}
{{--                    شكرا--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="speech-bubble speech-left bg-msg-send mb-0">--}}
{{--                    عفوا--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <em class="speech-read mb-3"><i class="fas fa-check-double check-color"></i></em>--}}
{{--                <p class="text-center mb-0 font-11">منذ 25 دقيقة</p>--}}
{{--                <div class="speech-bubble speech-right bg-msg-r">--}}
{{--                    سعيد بتعامل معك--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="speech-bubble speech-last speech-left bg-msg-send">--}}
{{--                    مرحبا بك في أي وقت--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <em class="speech-read mb-3"><i class="fas fa-check-double"></i></em>--}}
{{--            </div>--}}


{{--        </div>--}}
{{--        <!-- End of Page Content-->--}}
{{--        <div id="menu-upload" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="100"--}}
{{--             data-menu-effect="menu-over">--}}
{{--            <div class="list-group list-custom-small pl-2 mr-4">--}}
{{--                <a href="#">--}}
{{--                    <i class="font-14 fa fa-file color-gray2-dark"></i>--}}
{{--                    <span class="font-13">ملف</span>--}}
{{--                    <i class="fa fa-angle-left"></i>--}}
{{--                </a>--}}
{{--                <a href="#">--}}
{{--                    <i class="font-14 fa fa-image color-gray2-dark"></i>--}}
{{--                    <span class="font-13">صورة</span>--}}
{{--                    <i class="fa fa-angle-left"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@section('script')--}}

{{--@endsection--}}
