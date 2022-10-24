@extends('website.layout')
@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div class="card card-style" data-card-height="500">
            <div class="card-center">
                <img class="mb-3 mx-auto" width="120" src="{{asset("/template-muamlah/images/logo.png")}}">
                <h1 class="text-center font-20">منصة معاملة . كوم</h1>
                <p class="boxed-text-l text-center opacity-80 mt-3 mb-3">
                    شكرا على التسجيل سيتم التواصل معك قريبا.<br>
                </p>
                <a href="https://t.me/muamlah"
                   class="btn btn-xl font-900 text-uppercase bg-green2-dark btn-center-xl">إنضم لمجتمع منصة
                    معاملة على التليجرام</a>
            </div>
            <div class="card-overlay bg-white opacity-90"></div>
        </div>
    </div>
    <!-- End of Page Content-->
@endsection
