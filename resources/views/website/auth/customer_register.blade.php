@extends('website.layout')
@section('style')
<style>
    /* The message box is shown when the user clicks on the password field */
    #message-user {
        display: none;
        padding: 10px;
    }

    #message-user h4,
    #message-user h6 {
        font-size: 13px !important;
    }

    #message-provider {
        display: none;
        padding: 10px;
    }

    #message-confirmation-provider {
        display: none;
        padding: 10px;
    }

    #message-confirmation-user {
        display: none;
        padding: 10px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        content: "✔";
    }
</style>
@endsection
@section('content')
<!-- Page Content-->
<div class="page-content header-clear-medium">
    @if (count($errors) > 0)
    <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
        <h4 class="text-uppercase color-white"><strong>{{'خطأ في إدخال البيانات '}}!</strong></h4>
        @foreach ($errors->all() as $error)
        <strong class="alert-icon-text">{{ $error }}</strong><br>
        @endforeach
        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif
    <div class="card card-style bg-theme pb-0">
        <div class="content">
            <div class="text-center mb-3">
                <h3 class="font-900 font-35">تسجيل جديد عميل</h3>
                <p class="font-11">ليس لديك حساب؟ سجل هنا.</p>
            </div>
            <div class="clearfix mb-3"></div>
            <div class="pt-2">
                <form method="post" action="{{ route('register') }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="typeUser" value="user">
                    <div class=" input-style input-style-2 has-icon input-required">
                        <i class="fa input-icon fa-user"></i>
                        <span class="color-highlight input-style-1-inactive">الاسم</span>
                        <em>(مطلوب)</em>
                        <input class="form-control" name="name" required  type="name" placeholder="">
                    </div>
                    <div class=" input-style input-style-2 has-icon input-required">
                        <i class="fa input-icon fa-envelope"></i>
                        <span class="color-highlight input-style-1-inactive">الإيميل</span>
                        <em>(مطلوب)</em>
                        <input class="form-control" name="email" required type="email" placeholder="">
                    </div>
                    <div class=" input-style input-style-2 has-icon input-required">
                        <i class="fa input-icon fa-phone"></i>
                        <span class="color-highlight input-style-1-inactive">رقم الجوال</span>
                        <em>(مطلوب)</em>
                        <input class="form-control" name="phone" required  type="tel" title="يجب ان يكون رقم هاتف سعودي" pattern="(05)([0-9]{8})" placeholder="">
                    </div>

                    <div class="input-style input-style-2  has-icon input-required">
                        <i class="fa input-icon fa-lock"></i>
                        <span class="color-highlight">كلمة المرور</span>
                        <em>(مطلوب)</em>
                        <input class="form-control validate" type="password" id="psw-user" required title="يجب ان تحتوي كلمة السر على حروف وارقام ولا تقل عن 8 خانات" name="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}">
                    </div>
                    <div class="input-style input-style-2  has-icon input-required">
                        <i class="fa input-icon fa-lock"></i>
                        <span class="color-highlight">تأكيد كلمة المرور</span>
                        <em>(مطلوب)</em>
                        <input class="form-control" id="password-confirmation-user" name="password_confirmation" type="password" placeholder="">
                        <p class="invalid" id="message-confirmation-user">كلمة المرور غير متطابقة</p>
                    </div>
                    <div id="message-user">
                        <h4>كلمة المرور يجب أن تكون :</h4>
                        <h6 id="length" class="invalid">على الأقل 8 حروف</h6>
                        <h6 id="letter" class="invalid">تحتوي على أحرف</h6>
                        <h6 id="number" class="invalid">تحتوي على أرقام</h6>
                    </div>
{{--                    <div class="mb-4">--}}
{{--                        <div class="fac fac-radio fac-default"><span></span>--}}
{{--                            <input id="box2-fac-radio" type="radio" checked name="activation_type" value="email">--}}
{{--                            <label for="box2-fac-radio">تفعيل الحساب بواسطة الإيميل</label>--}}
{{--                        </div>--}}
{{--                        <div class="fac fac-radio fac-default"><span></span>--}}
{{--                            <input id="box3-fac-radio" type="radio" name="activation_type" value="sms">--}}
{{--                            <label for="box3-fac-radio">تفعيل الحساب بواسطة رقم الجوال</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div>
                        <input id="accept_terms" type="checkbox" value="1" name="accept_terms" required>
                        <label for="accept_terms"><a href="{{route('pages.details', ['page' => 7])}}" target="_blank"> قرأت
                                وأوافق على الشروط والأحكام</a> و <a href="{{route('pages.details', ['page' => 8])}}" target="_blank"> سياسة الخصوصية</a></label>
                    </div>
                    <button type="submit" class="btn btn-m mt-2 mb-4 btn-full bg-green-c text-uppercase font-900">تسجيل</button>
                </form>
            </div>
        </div>

    </div>
    {{-- <div class="card card-style bg-theme pb-0">--}}
    {{-- <div class="content">--}}
    {{-- <div class="text-center mb-3">--}}
    {{-- <h3 class="font-900 font-35">إفتح حساباً جديداً</h3>--}}
    {{-- <p class="font-11">هل لديك حساب؟ <a href="{{route('login')}}">تسجيل دخول</a></p>--}}
    {{-- </div>--}}
    {{-- <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="2" data-tab-active="bg-green-muamlah color-white">--}}
    {{-- <a href="#" data-tab-active data-tab="tab-private">تسجيل جديد عميل</a>--}}
    {{-- <a href="#" data-tab="tab-public">تسجيل جديد مقدم خدمة</a>--}}
    {{-- </div>--}}
    {{-- <div class="clearfix mb-3"></div>--}}



    {{-- <div class="tab-content" id="tab-private">--}}
    {{-- <div class="pt-2">--}}
    {{-- <form method="post" action="{{ route('register') }}" enctype="multipart/form-data" role="form">--}}
    {{-- {{ csrf_field() }}--}}
    {{-- <input type="hidden" name="typeUser" value="user">--}}
    {{-- <div class=" input-style input-style-2 has-icon input-required">--}}
    {{-- <i class="fa input-icon fa-phone"></i>--}}
    {{-- <span class="color-highlight input-style-1-inactive">رقم الجوال</span>--}}
    {{-- <em>(مطلوب)</em>--}}
    {{-- <input type="tel" name="phone" required title="يجب ان يكون رقم هاتف سعودي" pattern="(05)([0-9]{8})" placeholder="رقم الموبايل">--}}
    {{-- </div>--}}
    {{-- <div class="input-style input-style-2  has-icon input-required">--}}
    {{-- <i class="fa input-icon fa-phone"></i>--}}
    {{-- <span class="color-highlight">كلمة المرور</span>--}}
    {{-- <em>(مطلوب)</em>--}}
    {{-- <input type="password" id="psw-user" autocomplete required title="يجب ان تحتوي كلمة السر على حروف وارقام ولا تقل عن 8 خانات" name="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" class="validate">--}}
    {{-- </div>--}}
    {{-- <div class="input-style input-style-2  has-icon input-required">--}}
    {{-- <i class="fa input-icon fa-phone"></i>--}}
    {{-- <span class="color-highlight"> تاكيد كلمة المرور</span>--}}
    {{-- <em>(مطلوب)</em>--}}
    {{-- <input type="password" id="password-confirmation-user" required name="password_confirmation" class="validate">--}}
    {{-- <p class="invalid" id="message-confirmation-user">كلمة المرور غير متطابقة</p>--}}
    {{-- </div>--}}
    {{-- <div id="message-user">--}}
    {{-- <h4>يجب ان تحوي كلمة المرور على ما يلي:</h4>--}}
    {{-- <h6 id="letter" class="invalid">احرف </h6>--}}
    {{-- <h6 id="number" class="invalid">ارقام</h6>--}}
    {{-- <h6 id="length" class="invalid">الحد الادنى 8 حروف</h6>--}}
    {{-- </div>--}}
    {{-- <button type="submit" class="btn btn-m mt-2 mb-4 btn-full bg-green-c text-uppercase font-900">تسجيل</button>--}}
    {{-- </form>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class="tab-content" id="tab-public">--}}
    {{-- <div class="pt-2">--}}
    {{-- <form method="post" action="{{ route('register') }}" enctype="multipart/form-data" role="form">--}}
    {{-- {{ csrf_field() }}--}}
    {{-- <input type="hidden" name="typeUser" value="provider">--}}
    {{-- <div class=" input-style input-style-2 has-icon input-required">--}}
    {{-- <i class="fa input-icon fa-phone"></i>--}}
    {{-- <span class="color-highlight input-style-1-inactive">رقم الجوال</span>--}}
    {{-- <em>(مطلوب)</em>--}}
    {{-- <input type="tel" name="phone" required title="يجب ان يكون رقم هاتف سعودي" pattern="(05)([0-9]{8})" placeholder="رقم الموبايل">--}}
    {{-- </div>--}}

    {{-- <div class="input-style input-style-2  has-icon input-required">--}}
    {{-- <i class="fa input-icon fa-phone"></i>--}}
    {{-- <span class="color-highlight">كلمة المرور</span>--}}
    {{-- <em>(مطلوب)</em>--}}
    {{-- <input type="password" id="psw-provider" required title="يجب ان تحتوي كلمة السر على حروف وارقام ولا تقل عن 8 خانات" name="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" class="validate">--}}
    {{-- </div>--}}
    {{-- <div class="input-style input-style-2  has-icon input-required">--}}
    {{-- <i class="fa input-icon fa-phone"></i>--}}
    {{-- <span class="color-highlight"> تاكيد كلمة المرور</span>--}}
    {{-- <em>(مطلوب)</em>--}}
    {{-- <input type="password" id="password-confirmation-provider" required name="password_confirmation" class="validate">--}}
    {{-- <p class="invalid" id="message-confirmation-provider">كلمة المرور غير متطابقة</p>--}}
    {{-- </div>--}}
    {{-- <div id="message-provider">--}}
    {{-- <h4>يجب ان تحوي كلمة المرور على ما يلي:</h4>--}}
    {{-- <h6 id="letter-provider" class="invalid">احرف </h6>--}}
    {{-- <h6 id="number-provider" class="invalid">ارقام</h6>--}}
    {{-- <h6 id="length-provider" class="invalid">الحد الادنى 8 حروف</h6>--}}
    {{-- </div>--}}
    {{-- <button type="submit" class="btn btn-m mt-2 mb-4 btn-full bg-green-c text-uppercase font-900">تسجيل جديد</button>--}}
    {{-- </form>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}

    {{-- </div>--}}
</div>
<!-- End of Page Content-->

@endsection
@section('script')
<script>
    var myInput = document.getElementById("psw-user");
    var letter = document.getElementById("letter");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    //
    // var myInput_provider = document.getElementById("psw-provider");
    // var letter_provider = document.getElementById("letter-provider");
    // var number_provider = document.getElementById("number-provider");
    // var length_provider = document.getElementById("length-provider");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
        document.getElementById("message-user").style.display = "block";
    }

    // myInput_provider.onfocus = function() {
    //     document.getElementById("message-provider").style.display = "block";
    // }

    // When the user clicks outside of the password field, hide the message box
    // myInput.onblur = function() {
    //     document.getElementById("message").style.display = "none";
    // }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
        // Validate characters
        var characters = /[A-za-z]/g;
        var characters2 = /[\u0621-\u064A]/g;
        if (myInput.value.match(characters) || myInput.value.match(characters2)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }


        // Validate numbers
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        // Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
    // myInput_provider.onkeyup = function() {
    //     // Validate characters
    //     var characters = /[A-za-z]/g;
    //     if (myInput_provider.value.match(characters)) {
    //         letter_provider.classList.remove("invalid");
    //         letter_provider.classList.add("valid");
    //     } else {
    //         letter_provider.classList.remove("valid");
    //         letter_provider.classList.add("invalid");
    //     }
    //
    //
    //     // Validate numbers
    //     var numbers = /[0-9]/g;
    //     if (myInput_provider.value.match(numbers)) {
    //         number_provider.classList.remove("invalid");
    //         number_provider.classList.add("valid");
    //     } else {
    //         number_provider.classList.remove("valid");
    //         number_provider.classList.add("invalid");
    //     }
    //
    //     // Validate length
    //     if (myInput_provider.value.length >= 8) {
    //         length_provider.classList.remove("invalid");
    //         length_provider.classList.add("valid");
    //     } else {
    //         length_provider.classList.remove("valid");
    //         length_provider.classList.add("invalid");
    //     }
    // }
</script>
<script>
    $('#psw-provider, #password-confirmation-provider').on('keyup', function() {
        if (($('#psw-provider').val() != $('#password-confirmation-provider').val()) && ($('#password-confirmation-provider').val() != '' && $('#psw-provider').val() != '')) {
            $('#message-confirmation-provider').css('display', 'block')
        } else {
            $('#message-confirmation-provider').css('display', 'none')
        }
    });
    $('#psw-user, #password-confirmation-user').on('keyup', function() {
        if (($('#psw-user').val() != $('#password-confirmation-user').val()) && ($('#password-confirmation-user').val() != '' && $('#psw-user').val() != '')) {
            $('#message-confirmation-user').css('display', 'block')
        } else {
            $('#message-confirmation-user').css('display', 'none')
        }
    });


    $( document ).ready(function() {
        var test = $('.alert-icon-text').text();
        if(test == ' رقم الموبايل  موجود  .'){
            $('.alert-icon-text').text('رقمك مسجل مسبقا ، يمكنك استعادة كلمة المرور و تسجيل الدخول');
        }
    });

    $('input[name=activation_type]').change(function(){
        var value = $( 'input[name=activation_type]:checked' ).val();
        if(value == "email"){
            $('input[name=email]').prop('required',true);
            $('#required-email-label').text('(مطلوب)');
        }else{
            $('input[name=email]').prop('required',false);
            $('#required-email-label').text('');
        }
    });

</script>
@endsection
