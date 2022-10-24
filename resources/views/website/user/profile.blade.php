@extends('website.layout')
@section('style')
<style>
    .update {
        font-size: 12px;
        color: #ddd;
        margin-left: 5px;

    }

    #profile-image:hover {
        border: 2px solid #ddd;
        cursor: pointer;

    }

    .custom-input {
        background: transparent;
        border: 0;
        border-bottom: 1px solid #2f3135;
    }
    .upload-file2 {
        text-indent: -999px;
        outline: none;
        width: 100%;
        height: 45px;
        color: rgba(0,0,0,0)!important;
        cursor: pointer;
    }
    .parent-percentage{
        width: 300px;
        background: #898989;
        position: absolute;
        height: 10px;
        margin: 10px;
        border-radius: 10px;
        box-shadow: 0 0 7px 2px rgb(68 80 89 / 47%);
    }
    .child-percentage{
        background: green;
        position: absolute;
        height: 10px;
        margin: 10px;
        border-radius: 10px;
    }
</style>
@endsection
@section('content')
<!-- Page Content-->
<div class="page-content header-clear-medium">


    @if ($message = Session::get('success') )
        <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif
    @guest

    <div class="card card-style">
        <div class="d-flex content">
            <div class="flex-grow-1">
                <div>
                    <h1 class="font-700 mb-1">إسم صاحب الحساب</h1>
                    <p class="mb-0 pb-1 pl-3">
                        "الحمدللّه بلا سبب, و لا طلب, الحمدللّه حمدا كاملا, الحمدللّه
                        دائما و أبدا"
                    </p>
                </div>
            </div>
            <div>
                <img src="{{asset("/template-muamlah/images/pictures/faces/1s.png")}}" data-src="{{asset("/template-muamlah/images/pictures/faces/1s.png")}}" width="80" height="80" class="rounded-circle mt- shadow-xl preload-img">
            </div>
        </div>
    </div>
    @else
    <div class="card card-style">
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-12">
                    <i class="fa fa-tasks rounded-s bg-magenta2-dark font-14"></i>
                    <span class="font-15">اكتمال الملف الشخصي {{$width}}%</span>
                </div>
                <div class="col-md-12 col-12">
                    <span class="parent-percentage"></span>
                    <span class="child-percentage" style="width:{{$width*3}}px"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-box mr-3 ml-3 rounded-s bg-red2-dark " role="alert" style="display: none;">
        <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
        <h4 class="text-uppercase color-white errors-text"></h4>
        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    <div class="card card-style">
        <div class="d-flex content">
            <div class="flex-grow-1">
                {{-- <div>
                    <h3 class="mt-2 mb-1 font-700"><a class="update" href="javascript:;" onclick="update('user-name');"><i class="fas fa-pencil-alt"></i></a> <input type="text" value="{{ auth()->user()->name }}" class="custom-input user-name" data-field="user-name" style="display:none" maxlength="60"> <span id="user-name">{{ !empty(auth()->user()->name) ? auth()->user()->name : "الاسم المستعار" }}</span></h3>
                    <p class="font-12 mt-n1 mb-0 pb-0"><a class="update" href="javascript:;" onclick="update('user-bio');"><i class="fas fa-pencil-alt"></i></a> <input type="text" value="{{ auth()->user()->bio }}" class="custom-input user-bio" data-field="user-bio" style="display:none" maxlength="100"> <span id="user-bio">{{ !empty(auth()->user()->bio) ?  auth()->user()->bio : '--------'}}</span></p>
                </div> --}}
                <div class="card-profile-qr">
                    <div class="d-flex  info-profile">
                        <div>
                            <h3 class="mt-2 mb-0 font-700">
                                <span id="user-name">
                                    {{ !empty(auth()->user()->name) ? auth()->user()->name : "الاسم المستعار" }}
                                </span>
                                <i id="name-edit" class="fas fa-pen font-12 mr-2 opacity-50"></i>
                            </h3>
                            <p class="font-12 mt-n1 mb-0 pb-0">
                                <span id="user-bio">
                                    {{ !empty(auth()->user()->bio) ?  auth()->user()->bio : '--------'}}
                                </span>
                                <i id="excerpt-edit" class="fas fa-pen font-12 mr-2 opacity-50"></i>
                            </p>
                        </div>
                    </div>
                    <div class="d-none edit-profile">
                        <div class="d-flex m-3">
                            <div
                                class="input-style edit-name d-none w-100 ml-2 mt-auto mb-auto input-style-2 has-icon input-required">
                                <i class="fa input-icon fa-user-alt"></i>
                                <span class="input-style-1-active font-900">الإسم المستعار</span>
                                <input class="form-control user-name" type="text" value="{{ !empty(auth()->user()->name) ? auth()->user()->name : "الاسم المستعار" }}">
                            </div>
                            <div
                                class="input-style edit-excerpt d-none w-100 ml-2 mt-auto mb-auto input-style-2 has-icon input-required">
                                <i class="fa input-icon fa-user-alt"></i>
                                <span class="input-style-1-active font-900">نبذة عنك</span>
                                <textarea class="requiredField user-bio" name="" id="" cols="30" rows="10">{{ !empty(auth()->user()->bio) ?  auth()->user()->bio : '--------'}}
                                </textarea>
                            </div>
                            <div class="m-auto">
                                <button class="btn btn-full w-100 bg-green-c btn-m text-uppercase rounded-sm shadow-l font-900 edit-profile-btn">حفظ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="position: relative;">
                <img data-src="{{auth()->user()->getImage()}}" src="{{auth()->user()->getImage()}}" class="ml-3 rounded-circle shadow-l preload-img" width="80" height="80" id="profile-image">
                @if ($user->verified)
                <img src="{{ @asset("/template-muamlah/images/icons/verification-badge.svg") }}" style="position: absolute; bottom:0; right:0;">
                @endif
                <input type="file" id="image" name="profile_image" style="display:none" accept="image/*">
            </div>
        </div>
    </div>
    @endguest
    @if ($errors->any())
    <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
        <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
        @foreach ($errors->all() as $error)
        <h4 class="text-uppercase color-white">{{$error}} !</h4>
        @endforeach

        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;
        </button>
    </div>
    @endif

    <form method="post" action="{{route('user.updateProfile')}}" enctype="multipart/form-data" class="form-horizontal" role="form">
        {{ csrf_field() }}
        <div class="card card-style">
            <div class="content mb-0">
                <h2 class="mb-4">بيانات صاحب الحساب</h2>
                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-user"></i>
                    <span class="color-highlight input-style-1-active">الإسم</span>
                    <em>(مطلوب)</em>
                    <input type="text" name="name" required value="{{@$user->name}}" class="form-control">
                </div>
                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-at"></i>
                    <span class="color-highlight input-style-1-active">الإيميل</span>
                    <em>(مطلوب)</em>
                    <input type="email" value="{{@$user->email}}" name="email" class="form-control">
                </div>
                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-flag"></i>
                    <span class="color-highlight input-style-1-active">الجنسية</span>
                    <em>(مطلوب)</em>
                    <input type="text" name="nationality" required value="{{@$user->nationality}}" class="form-control">
                </div>
                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-map-marker"></i>
                    <span class="color-highlight input-style-1-active">العنوان</span>
                    <em>(مطلوب)</em>
                    <input type="text" required name="address" placeholder="العنوان" class="form-control" value="{{@$user->address}}">
                </div>
                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-phone"></i>
                    <span class="color-highlight input-style-1-active">رقم الجوال</span>
                    <em>(مطلوب)</em>
                    <input type="phone" name="phone" placeholder="رقم الموبايل" value="{{@$user->phone}}" class="form-control">
                </div>

                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-user"></i>
                    <span class="color-highlight input-style-1-active">حساب فيسبوك</span>
                    <em>(اختياري)</em>
                    <input type="text" name="facebook"  value="{{@$user->facebook}}" class="form-control">
                </div>
                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-user"></i>
                    <span class="color-highlight input-style-1-active">حساب انستغرام</span>
                    <em>(اختياري)</em>
                    <input type="text" name="instagram"  value="{{@$user->instagram}}" class="form-control">
                </div>
                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-user"></i>
                    <span class="color-highlight input-style-1-active">حساب لينكد ان</span>
                    <em>(اختياري)</em>
                    <input type="text" name="linkedin"  value="{{@$user->linkedin}}" class="form-control">
                </div>
                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-user"></i>
                    <span class="color-highlight input-style-1-active">حساب تويتر</span>
                    <em>(اختياري)</em>
                    <input type="text" name="twitter"  value="{{@$user->twitter}}" class="form-control">
                </div>
                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-user"></i>
                    <span class="color-highlight input-style-1-active">حساب واتس اب</span>
                    <em>(اختياري)</em>
                    <input type="text" name="whatsapp"  value="{{@$user->whatsapp}}" class="form-control">
                </div>

                <div class="file-data text-center mt-4">
                    <input type="file" name="file" id="upload-file" class="upload-file border rounded-s" accept="image/*">
                    <p class="upload-file-text color-highlight" id="upload-file-text-lable">إرفاق صورة الهوية</p>
                    @if($user->getFile() != "")
                    <img src="{{$user->getFile()}}" width="100px" id="file">
                    @else
                    <img src="{{asset("/template-muamlah/images/logo.png")}}" width="100px" id="file">
                    @endif

                </div>
                <div class="text-center mt-4">
                    <input type="file" name="commercial_register" id="commercial_register" class="upload-file2 border rounded-s" accept="image/*,application/pdf">
                    <p class="upload-file-text color-highlight" id="upload-file-text-lable-2">السجل التجاري</p>
                </div>
                <div class="text-center mt-5" id="commercial_register_file">
                    @if($user->getCommercialRegister() != "")
                    <a href="{{$user->getFile()}}" download>تنزيل السجل التجاري</a>
                    @endif
                </div>
                <br><br>
                <div class="mb-4">
                    <div class="fac fac-radio fac-default"><span></span>
                        <input id="box2-fac-radio" type="radio" {{$user->activation_type == "email" ? 'checked' : ''}} name="activation_type" value="email">
                        <label for="box2-fac-radio">تفعيل الحساب بواسطة الإيميل</label>
                    </div>
                    <div class="fac fac-radio fac-default"><span></span>
                        <input id="box3-fac-radio" type="radio" {{$user->activation_type != "email" ? 'checked' : ''}} name="activation_type" value="sms">
                        <label for="box3-fac-radio">تفعيل الحساب بواسطة رقم الجوال</label>
                    </div>
                </div>
                <button class="btn btn-full w-100 bg-green-c btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">حفظ</button>

            </div>
        </div>
    </form>
    <div class="card card-style">
        <div class="content mb-0">
            <h2 class="mb-4">تغيير كلمة المرور</h2>
            <form method="post" action="{{route('user.updateProfile')}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                {{ csrf_field() }}

                <div class="input-style input-style-2 input-required">
                    <span class="color-highlight input-style-1-active">كلمة المرور الجديدة</span>
                    <em>(مطلوب)</em>
                    <input type="password" required id="password" class="form-control" name="password" value="" placeholder="كلمة المرور">
                </div>
                <div class="input-style input-style-2 input-required">
                    <span class="color-highlight input-style-1-active">تأكيد كلمة المرور الجديدة</span>
                    <em>(مطلوب)</em>
                    <input type="password" required id="confirm_password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور">
                </div>
                <div class="input-style input-style-2 input-required">
                    <span class="color-highlight input-style-1-active">كلمة المرور القديمة</span>
                    <em>(مطلوب)</em>
                    <input type="password" required id="current_password" name="current_password" value="" class="form-control" placeholder=" كلمة المرور الحالية">
                </div>
                <span id='message'></span>
                <button id="pass_save" class="btn btn-full w-100 bg-green-c btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">حفظ</button>
            </form>
        </div>
    </div>
   @if(!is_null($agent = $user->agent))
    <div class="text-center">
    @php
        $avg_reviews = $agent->avgReviews->first();
        $total_avg = 0;
        if(!is_null($avg_reviews)){
            $total = 0;
            $total += $avg_reviews->quality_of_service;
            $total += $avg_reviews->execution_speed;
            $total += $avg_reviews->professionalism_in_dealing;
            $total += $avg_reviews->communication;
            $total += $avg_reviews->deal_with_him_again;
            $total_avg = $total / 5;
        }
        if($agent->name==''){
            $agent->name=$agent->phone;
        }
    @endphp
    <div class="col-md-6 d-inline-block">
        <div class="card card-style">
            <h2 class="m-4 text-center">الوكيل</h2>
            <div class="content text-center">
                <img src="{{$agent->getImage()}}" class="mx-auto rounded-circle shadow-xl"
                    width="150">
                <h1 class="mt-4">{{$agent->name}}</h1>
                @if ($agent->verified)
                <p class="mb-2">وكيل موثوق<i
                        class="fa fa-check-circle color-green1-dark scale-icon mr-2"></i>
                </p>
                @endif
                <span>
                    <div id="totla" rel="{{$total_avg}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    <p class="font-9 mb-2">{{\Carbon\Carbon::parse($agent->created_at)->format('Y-m-d')}}</p>
                    <p class="line-height-xl boxed-text-xl font-18 font-300">
                        {{$agent->bio}}
                    </p>
                </span>
                <div class="mb-2 mt-2">
                    <a href="{{route('chat.open_agent_chat', ['user_id2' => $agent->id])}}" target="_blank"
                        class="icon shadow-xl icon-xl mr-2 ml-2 rounded-l bg-green2-dark pt-2 pb-2 pl-3 pr-3 color-white">فتح محادثة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
`@endif
</div>

@endsection

@section('script')
<script>

    // change work status
    $(".work-status-label").on('click', function(e) {

        let input_value = $('.work-status-input').data('checked');

        if (input_value == 'online') {
            $('.work-status-input').data('checked', 'offline');
            var work_status = 'offline';
        } else {
            $('.work-status-input').data('checked', 'online');
            var work_status = 'online';
        }

        $.ajax({
            url: "{{route('website.update-work-status')}}",
            data: {
                work_status: work_status,
                _token: '{{csrf_token()}}'
            },
            type: "post",
            success: function(data) {

            },
            error: function(reject) {
                if (reject.status === 401) {
                    $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                    $('.alert-box').show();
                }
            }
        });
    });
</script>

<script>
    $("#name-edit").on('click', function (e) {
        $(".info-profile").removeClass('d-flex');
        $(".edit-profile").removeClass('d-none');
        $(".edit-name").removeClass('d-none');
    });

    $("#excerpt-edit").on('click', function (e) {
        $(".info-profile").removeClass('d-flex');
        $(".edit-profile").removeClass('d-none');
        $(".edit-excerpt").removeClass('d-none');
    });

    $(".edit-profile-btn").on('click', function (e) {
        $(".info-profile").addClass('d-flex');
        $(".edit-profile").addClass('d-none');
        $(".edit-excerpt").addClass('d-none');
        $(".edit-name").addClass('d-none');
        updateData();
    });

    $('#profile-image').click(function() {
        $('#image').click();
    });

    function handleUpload(event) {
        $('.alert-box').hide();
        var file = this.files[0];
        if (!file) return;
        var formData = new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('image', file);
        return $.ajax({
            type: 'POST',
            url: '{{route("website.update-image")}}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#profile-image').attr('src', data.url);
            },
            error: function(reject) {
                if (reject.status === 401) {
                    $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                    $('.alert-box').show();
                }
                if (reject.status === 422) {
                    $(".errors-text").append("الملف غير مطابق للمعاير, يجب أن تكون صورة لا تتجاوز ال 2 ميغابايت");
                    $('.alert-box').show();
                }
            }
        });
    }

    function handleUploadFile(event) {
        $('.alert-box').hide();
        $('#upload-file-text-lable').text('جاري التحميل ...');
        var file = this.files[0];
        if (!file) return;
        var formData = new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('file', file);
        return $.ajax({
            type: 'POST',
            url: '{{route("user.storeFiles")}}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#file').attr('src', data.url);
                $('#upload-file-text-lable').text('إرفاق صورة الهوية');

            },
            error: function(reject) {
                $('#upload-file-text-lable').text('إرفاق صورة الهوية');
                if (reject.status === 401) {
                    $('#upload-file-text-lable').text("لا تملك الصلاحية للقيام بهذه العملية");
                }
                if (reject.status === 422) {
                    $('#upload-file-text-lable').text("الملف غير مطابق للمعاير, يجب أن تكون صورة لا تتجاوز ال 2 ميغابايت");
                }
                alert('حدث خطأ!');
            }
        });
    }

    function handleUploadCommercialRegister(event) {
        $('.alert-box').hide();
        $('#upload-file-text-lable-2').text('جاري التحميل ...');
        var file = this.files[0];
        if (!file) return;
        var formData = new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('commercial_register', file);
        return $.ajax({
            type: 'POST',
            url: '{{route("user.storeFiles")}}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#commercial_register_file').html('<a href="'+data.url+'" download>تنزيل السجل التجاري</a>')
                $('#upload-file-text-lable-2').text('السجل التجاري');

            },
            error: function(reject) {
                $('#upload-file-text-lable-2').text('السجل التجاري');
                if (reject.status === 401) {
                    $('#upload-file-text-lable-2').text("لا تملك الصلاحية للقيام بهذه العملية");

                }
                if (reject.status === 422) {
                    $('#upload-file-text-lable-2').text("الملف غير مطابق للمعاير, يجب أن يكون ملف لا يتجاوز ال 2 ميغابايت");

                }
                alert('حدث خطأ!');
            }
        });
    }

    $('#image').on('change', handleUpload);
    $('#upload-file').on('change', handleUploadFile);
    $('#commercial_register').on('change', handleUploadCommercialRegister);

    function update(field) {
        $('#' + field).hide();
        $('.' + field).show();
    }

    function updateData(field) {
        $('#' + field).show();
        $('.' + field).hide();
        let name = $(".user-name").val();
        let bio = $(".user-bio").val();

        $.ajax({
            url: "{{route('website.update-profile')}}",
            data: {
                name: name,
                bio: bio,
                _token: '{{csrf_token()}}'
            },
            type: "post",
            success: function(data) {

                $("#user-name").text(data.name);
                $("#user-bio").text(data.bio);
            },
            error: function(reject) {
                if (reject.status === 401) {
                    $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                    $('.alert-box').show();
                }
                console.log(reject.status === 422);
                if (reject.status === 422) {

                    $(".errors-text").append("يجب ان لايتجاوز النص المدخل عن 255 محرف");
                    $('.alert-box').show();
                }
            }
        });
    }
    $('.custom-input').keydown(function(e) {
        var field = $(this).data('field');
        if (e.keyCode == 13) {
            updateData(field);
        }
    });
    $('.custom-input').blur(function(e) {
        var field = $(this).data('field');
        updateData(field);

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
