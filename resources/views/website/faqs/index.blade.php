@extends('website.layout')
@section('content')
<div class="page-content header-clear-medium">
    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center">
            <h1 class="color-white mb-0">الأسئلة الشائعة</h1>
            <p class="color-white mt-n1 mb-0">لقد تم طرح هذه الأسئلة كثيرًا ، لذلك أنشأنا هذا القسم الصغير لمساعدتك في تحديد ما تحتاجه بشكل أسرع
            </p>
        </div>
    </div>
    <div class="card card-style">

        <div class="content mb-2">

            <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl"
                        data-tab-items="3" data-tab-active="bg-green-muamlah color-white">
                        @foreach($types as $key => $type)
                        <a href="#" data-tab-{{$loop->first ? 'active' : ''}} data-tab="{{$key}}-faq" class="tab-title">{{$type['title']}}</a>
                        @endforeach
                    </div>
                    <div class="clearfix mb-3"></div>
                    @foreach($types as $key => $type)
                    @php
                      $data = $faqs->where('type', $key);  
                    @endphp
                    <div class="tab-content" id="{{$key}}-faq">
                        <div class="pt-2">
                            @foreach($data as $faq)
                            <div class="d-flex">
                                <div class="pt-1">
                                    <h5 data-activate="question-{{ $faq->id }}" class="font-600">{!! $faq->question !!}</h5>
                                </div>
                                <div class="mr-auto mr-1 pl-0 ml-n3">
                                    <div class="custom-control classic-switch">
                                        <input type="checkbox" class="classic-input" id="question-{{ $faq->id }}">
                                        <label class="custom-control-label" for="question-{{ $faq->id }}"></label>
                                        <i class="fa fa-angle-down font-11 color-green1-dark"></i>
                                    </div>
                                </div>
                            </div>
                            <div data-switch="question-{{ $faq->id }}" class="switch-is-unchecked">
                                <p class="pb-3">
                                    {!! $faq->answer !!}
                                </p>
                            </div>

                            @if(!$loop->last)
                            <div class="divider mt-2 mb-2"></div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                    @endforeach
           
        </div>
    </div>
</div>

@endsection