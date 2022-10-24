@foreach($reviews as $review)
    @php
        $total = 0;
        $total += $review->quality_of_service;
        $total += $review->execution_speed;
        $total += $review->professionalism_in_dealing;
        $total += $review->communication;
        $total += $review->deal_with_him_again;
        $review_total_avg = $total / 5;
    @endphp
    <div class="row">
        <div class="col-4">
            <div class="content text-center">
                <img src="{{ $review->owner->getImage() }}" class="mx-auto rounded-circle shadow-xl" height="150" width="150">
                <h6 class="mt-4">{{ $review->owner->name }}</h6>
                <span>
                    <div rel="{{$review_total_avg}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    <p class="font-9 mb-2">{{$review->created_at->format('Y-m-d')}}</p>
                    <p class="line-height-xl boxed-text-xl font-18 font-300">
                        {{ $review->comment }}
                    </p>
                </span>
            </div>
        </div>
        <div class="col-8">
            <div class="content">
                <div class="row mb-0">
                    <h4 class="col-6 font-600 text-center font-15">جودة الخدمة</h4>
                    <div class="col-6 mb-3">
                        <div id="quality-service" rel="{{$review->quality_of_service}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">سرعة التنفيذ</h4>
                    <div class="col-6 mb-3">
                        <div id="execution-speed" rel="{{$review->execution_speed}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">الاحترافية بالتعامل</h4>
                    <div class="col-6 mb-3">
                        <div id="dealing" rel="{{$review->professionalism_in_dealing}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">التواصل والمتابعة</h4>
                    <div class="col-6 mb-3">
                        <div id="communication" rel="{{$review->communication}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">التعامل معه مرّة أخرى</h4>
                    <div class="col-6 mb-3">
                        <div id="dealing_again" rel="{{$review->deal_with_him_again}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 divider divider-margins"></div>
    </div>
@endforeach

