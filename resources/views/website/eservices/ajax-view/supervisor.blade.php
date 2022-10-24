@foreach($supervisors as $supervisor)
    @if(isset($supervisor->provider))
        @php
            $user = $supervisor->provider;
            $avg_reviews = $user->avgReviews->first();
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
            if($user->name==''){
                $user->name=$user->phone;
            }
        @endphp
        <div class="content text-center">
            <img src="{{$user->getImage()}}" class="mx-auto rounded-circle shadow-xl" width="150">
            <h1 class="mt-4">{{$user->name}}</h1>
            @if ($user->verified)
                <p class="mb-2">
                    مقدم خدمة موثوق
                    <i class="fa fa-check-circle color-green1-dark scale-icon mr-2"></i>
                </p>
            @endif
            <span>
                <div id="totla" rel="{{$total_avg}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                <p class="font-9 mb-2">{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}</p>
                <p class="line-height-xl boxed-text-xl font-18 font-300">
                    {{$user->bio}}
                </p>
            </span>
            <div class="mb-2 mt-2">
                <a href="{{route('share_profile', ['slug'=> \App\Helpers\HelperClass::strtoslug($user->name),'id'=>$user->id,'type'=>'reviews'])}}" 
                    class="icon shadow-xl icon-m rounded-l bg-yellow1-dark pt-2 pb-2 pl-3 pr-3 color-white">
                    التقييمات
                </a>
                <a href="{{route('privateOrder.create', ['provider_phone' => $user->phone])}}" 
                    class="icon shadow-xl icon-xl mr-2 ml-2 rounded-l bg-green2-dark pt-2 pb-2 pl-3 pr-3 color-white">
                    طلب تعميد خاص
                </a>
                <a href="{{route('share_profile', ['slug'=> \App\Helpers\HelperClass::strtoslug($user->name),'id'=>$user->id,'type'=>'experience'])}}" 
                    class="icon shadow-xl icon-m rounded-l bg-blue1-dark pt-2 pb-2 pl-3 pr-3 color-white">
                    الخبرات
                </a>
            </div>
        </div>
        <div class="w-100 divider divider-margins"></div>
    @endif
@endforeach
