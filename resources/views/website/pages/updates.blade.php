@extends('website.layout')
@section('content')

    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-2">تحديثات</h1>
                <p class="color-white mt-1 mb-0">{{\Carbon\Carbon::now()->format('Y-m-d')}}</p>
            </div>
        </div>
        @foreach($pages as $page)
        <div class="card card-style">
            <div class="content text-center">
                <h2>{{$page->title}}</h2>
                <p>
                    {!! $page->details !!}
                </p>
            </div>
        </div>
        @endforeach
    </div>
@endsection