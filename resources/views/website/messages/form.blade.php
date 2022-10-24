@extends('website.layout')
@section('content')
<div id="page">

    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center">
                <h1 class="color-white mb-0">خدمة العملاء</h1>
                <p class="color-white mt-n1 mb-0">سيقوم أحد المشرفين بالرد على رسائلكم بأقرب وقت ممكن</p>
            </div>
        </div>
        @if ($errors->any())
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                @foreach($errors->all() as $error)
                <strong>{{$error}} </strong><br/>
                @endforeach
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if ($message = Session::get('success') )
        <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
            <span><i class="fa fa-check"></i></span>
            <strong>تم إرسال الرسالة بنجاح</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
        </div>
        @endif
        <div class="card card-style">
            <div class="content">
                <form method="post" action="{{route('messages.send')}}" role="form">
                    @csrf
                    <div class="input-style input-style-2 has-icon input-required">
                        <i class="input-icon fa fa-user"></i>
                        <span class="color-highlight {{auth()->check() ? 'focus-act' : ''}} ">الإسم</span>
                        <em>(مطلوب)</em>
                        <input type="name" name="name" required class="form-control" value="{{auth()->check() ? auth()->user()->getName() : ''}}">
                    </div>
                    <div class="input-style input-style-2 has-icon input-required mt-4">
                        <i class="input-icon fa fa-at"></i>
                        <span class="color-highlight {{auth()->check() ? 'focus-act' : ''}}">الإيميل</span>
                        <em>(مطلوب)</em>
                        <input type="email" name="email" required class="form-control" value="{{auth()->check() ? auth()->user()->email : ''}}">
                    </div>
                    <div class="input-style input-style-2 has-icon input-required mt-4">
                        <i class="input-icon fa fa-heading"></i>
                        <span class="color-highlight">الموضوع</span>
                        <em>(مطلوب)</em>
                        <input type="text" name="subject" required class="form-control">
                    </div>
                    <div class="input-style input-style-2 has-icon input-required mt-4">
                        <i class="input-icon fa fa-comment-dots"></i>
                        <span class="color-highlight">الرسالة</span>
                        <em>(مطلوب)</em>
                        <textarea style="color: #FFF;" class="textarea-height requiredField" name="message" required id="" cols="30"
                            rows="10"></textarea>
                    </div>
                    <button type="submit"
                        class="btn btn-full w-100 bg-green-c btn-m text-uppercase rounded-l shadow-l mb-3 mt-4 font-900">
                        إرسال الرسالة</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Page Content-->
</div>

@endsection
