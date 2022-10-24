@foreach($users as $user)
@php
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
<div class="col-md-6">
    <div class="card card-style">
        <div class="content text-center">
            <img src="{{$user->getImage()}}" class="mx-auto rounded-circle shadow-xl"
                width="150" height="150">
            <h1 class="mt-4">{{$user->name}}</h1>
            @if ($user->verified)
            <p class="mb-2"> موثوق<i
                    class="fa fa-check-circle color-green1-dark scale-icon mr-2"></i>
            </p>
            @endif
            <span>
                @if($user->IsAgent())
                <div id="totla" rel="{{$total_avg}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                @endif
                <p class="font-9 mb-2">{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}</p>
                <p class="line-height-xl boxed-text-xl font-18 font-300">
                    {{$user->bio}}
                </p>
            </span>
            <div class="mb-2 mt-2">
                @if(auth()->user()->level == 'user')
                    @if(auth()->user()->agent_id == $user->id)
                        <a onclick="return confirm('هل أنت متأكد من إلغاء الوكالة؟')" href="{{route('user.cancel_agent',['agent_id' => $user->id])}}" data-id="{{$user->id}}"
                            class="set_agent icon shadow-xl icon-xl mr-2 ml-2 rounded-l bg-green2-dark pt-2 pb-2 pl-3 pr-3 color-white">إلغاء التوكيل
                        </a>
                    @else
                        <a onclick="return confirm('هل أنت متأكد من تعيين التوكيل؟')" href="{{route('user.set_agent',['agent_id' => $user->id])}}" data-id="{{$user->id}}"
                            class="set_agent icon shadow-xl icon-xl mr-2 ml-2 rounded-l bg-green2-dark pt-2 pb-2 pl-3 pr-3 color-white">توكيل
                        </a>
                    @endif
                @elseif(auth()->user()->IsAgent())
                    <a onclick="return confirm('هل أنت متأكد من إلغاء الوكالة؟')" href="{{route('user.refuse_agent',['client_id' => $user->id])}}" data-id="{{$user->id}}"
                        class="set_agent icon shadow-xl icon-xl mr-2 ml-2 rounded-l bg-green2-dark pt-2 pb-2 pl-3 pr-3 color-white">إلغاء التوكيل
                    </a>
                @endif
                <a href="{{route('chat.open_agent_chat', ['user_id2' => $user->id])}}" target="_blank"
                    class="icon shadow-xl icon-xl mr-2 ml-2 rounded-l bg-green2-dark pt-2 pb-2 pl-3 pr-3 color-white">فتح محادثة
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
