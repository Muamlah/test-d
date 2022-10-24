@extends('website.layout')
@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium page-settings">
        <div class="card card-style">
            <div class="content my-0">
                <div class="list-group list-custom-small">
                        @php
                            if(auth()->check() && auth()->user()->level == "provider"){
                                $first_pages = $pages->whereNotIn('key',['terms', 'privace'])->where('type', 'provider');
                            }else{
                                $first_pages = $pages->whereNotIn('key',['terms', 'privace'])->where('type', 'user');
                            }
                        @endphp
                        @foreach($first_pages as $page)
                            <a href="{{route('pages.details', ['page' =>$page->id])}}" class="mt-2 mb-2"> <i class="fa font-14 fa-book-open rounded-s bg-yellow1-dark"></i> <span class="font-15">{{$page->title}}</span> <i class="fa fa-chevron-left opacity-30"></i> </a>
                        @endforeach

                    <a href="{{route('faqs.index')}}"> <i class="fa font-14 fa-question-circle rounded-s bg-orange-dark"></i>
                        <span class="font-15">الأسئلة الشائعة</span> <i class="fa fa-chevron-left opacity-30"></i>
                    </a>

                    <a href="{{route('messages.form')}}" class="mt-2 mb-2">
                        <i class="fa font-14 fa-headset rounded-s bg-green2-dark"></i> <span class="font-15">خدمة
                        العملاء</span> <i class="fa fa-chevron-left opacity-30"></i> </a>

                    @php $page = $pages->where('key', '=', 'terms')->first(); @endphp
                    @if(!is_null($page))
                        <a href="{{route('pages.details', ['page' =>$page->id])}}" class="mt-2 mb-2">
                            <i class="fa font-14 fa-asterisk rounded-s bg-brown1-dark"></i> <span class="font-15">{{$page->title}}</span> <i class="fa fa-chevron-left opacity-30"></i> </a>
                    @endif
                    @php $page = $pages->where('key', '=', 'privace')->first(); @endphp
                    @if(!is_null($page))
                        <a href="{{route('pages.details', ['page' =>$page->id])}}" class="mt-2 mb-2 border-0"> <i
                                class="fa font-14 fa-shield-alt rounded-s bg-gray2-dark"></i>
                            <span class="font-15">{{$page->title}}</span> <i class="fa fa-chevron-left opacity-30"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- End of Page Content-->
    <style>
        .list-custom-small .accordion .accordion-btn {
            border-bottom: solid 1px rgba(0, 0, 0, 0.05) !important;
        }
    </style>
@endsection
