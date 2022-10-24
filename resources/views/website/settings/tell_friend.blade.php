@extends('website.layout')

@section('content')

    <div class="page-content header-clear-medium">
        @if (Session::get('success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <h4 class="text-uppercase color-white">{{Session::get('success')}} !</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <h4 class="text-uppercase color-white"><strong class="mr-0 pr-0">{{'خطأ في إدخال البيانات '}}!</strong></h4>
                @foreach ($errors->all() as $error)
                    <strong class="alert-icon-text">{{ $error }}</strong><br>
                @endforeach
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">أخبر صديق</h1>
                <p class="color-white mt-n1 mb-0"></p>
            </div>
        </div>
        <div class="card card-style bg-theme pb-0">
            <div class="content">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl"
                     data-tab-items="2" data-tab-active="bg-green-muamlah color-white">
                    <a href="#" data-tab="tab-phone">رقم الهاتف</a>
                    <a href="#" data-tab-active data-tab="tab-email">البريد الإلكتروني</a>
                </div>
                <div class="clearfix mb-3"></div>
                <form action="{{route('tellFriendPost')}}" method="POST">
                    @csrf
                    <div class="tab-content" id="tab-email">
                        <div class="pt-2">
                            <div>
                                <div class=" input-style input-style-2 has-icon ">
                                    <i class="fa input-icon fa-envelope"></i>
                                    <span class="color-highlight input-style-1-inactive">الإيميل</span>
                                    <em>(مطلوب)</em>
                                    <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="tab-phone">
                        <div class="pt-2">
                            <div>
                                <div class=" input-style input-style-2 has-icon ">
                                    <i class="fa input-icon fa-phone"></i>
                                    <span class="color-highlight input-style-1-inactive">رقم الجوال</span>
                                    <em>(مطلوب)</em>
                                    <input class="form-control" name="phone" value="{{old('phone')}}" type="tel" title="يجب ان يكون رقم هاتف سعودي" pattern="(05)([0-9]{8})" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-m mt-2 mb-4 btn-full bg-green-c text-uppercase font-900">أرسل</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    
@endsection
