@extends('website.layout')
@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium page-settings">
        <div class="card card-style">
            <div class="content my-0">
                <div class="list-group list-custom-small">
                    @php
                     if(auth()->check() && auth()->user()->level == "provider"){
                            $pages = $pages->whereNotIn('key',['terms', 'privace'])->where('type', 'provider');
                        }else{
                            $pages = $pages->whereNotIn('key',['terms', 'privace'])->where('type', 'user');
                        }   
                    @endphp
                    @foreach($pages as $page)
                    <a href="{{route('pages.details', ['page' =>$page->id])}}"> <i class="fa font-14 fa-book-open rounded-s bg-yellow1-dark"></i>
                        <span class="font-15">{{$page->title}}</span> <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    @endforeach
                  
                </div>
            </div>
        </div>
    </div> <!-- End of Page Content-->

@endsection
