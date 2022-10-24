@foreach($eservices as $r)
    <div class="card card-style">
        <div class="content">
            <div class="d-flex mb-4">
                <div class="align-self-center">
                    <span class="icon icon-xxl rounded-m me-3">
                        <img src="{{asset('public/storage/').'/'.$r->img}}" width="80" class="rounded-sm">
                    </span>
                </div>
                <div class="align-self-center w-100 mr-2">
                    <h4>{{$r->service_name}}
{{--                        <strong class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">{{$r->price}}--}}
{{--                            ريال--}}
{{--                        </strong>--}}

                        @auth
                            @php
                                $type   = 'add';
                                $class  = 'deleted-from-favorite-2';
                                $style  = 'background-color:#258206 !important';
                                                                $text='مهتم';

                                if(auth()->check() && !$r->users()->where('user_id', auth()->id())->count()){
                                            $type   = 'add';
                                            $class  = 'deleted-from-favorite-2';
                                            $style  = 'background-color:#258206 !important';
                                             $text='مهتم';
                                        }else{
                                            $type   = 'delete';
                                            $class  = 'added-to-favorite-2';
                                            $style  = 'background-color:#DA4453 !important';
                                              $text='الغاء الاهتمام';
                                        }
                            @endphp
                            {{--                            @if(auth()->user()->level == 'provider')--}}
                            {{--                                @php--}}
                            {{--                                    $href = "#";--}}
                            {{--                                    $count = $r->customers()->count() - 3;--}}
                            {{--                                    $favorites = $r->customers()->orderBy('id','DESC')->limit(3)->get();--}}

                            {{--                                @endphp--}}
                            {{--                                --}}{{-- <a href="javascript:;" class="interested-service interested-service-{{$r->id}} {{$class}}" onclick="userRate({{$r->id}})">--}}
                            {{--                                    <input type="hidden" value="{{$type}}" class="favorit-type{{$r->id}}">--}}
                            {{--                                    <i class="fa fa-heart"></i>--}}
                            {{--                                </a> --}}
                            {{--                            @endif--}}
                        @endauth
                        @php
                            $count = $r->providers()->count() ;
                            $favorites = $r->providers()->orderBy('id','DESC')->limit(3)->get();
                        @endphp
                    </h4>
                    <p class="mb-0 opacity-60 line-height-s font-14">
                        {{$r->details}}
                    </p>
                </div>
            </div>
            <div class="divider mb-2"></div>

            <div class="d-flex mr-2">

                <div class="ml-auto">

                    <a href="{{route('supervisors',['service_id' => $r->id])}}">
                        @foreach($favorites as $favorite)
                            <img src="{{ $favorite->getImage() }}" class="float-right border border-white bg-yellow-light rounded-circle  @if(!$loop->first) mr-n3 @endif" width="35" height="35">
                        @endforeach

                    </a>
                    @if ($count)
                        <a href="{{route('supervisors',['service_id' => $r->id])}}" class="float-right pt-1 pr-2 font-12">{{$count}} مهتم بهذه الخدمة</a>
                    @endif




                </div>
                @auth
                    <div class="mr-auto">
                        <a href="javascript:;" onclick="userRate({{$r->id}})"
                           style="{{$style}}"
                           class="f-b interested-service-{{$r->id}} {{$class}} float-left rounded-xs text-uppercase float-left font-11 pr-3 pl-3 pb-1 pt-1">{{$text}}
                            <input type="hidden" value="{{$type}}" class="favorit-type{{$r->id}}">
                        </a>
                    </div>
                @endauth
            </div>

            <div class="divider mb-2 mt-2"></div>
            <div class="row mb-n2 text-center">
                <div class="col-12">
                    @if($electronic_user_count >= $setting->electronic_order_limit)
                        <a href="#" disabled  class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                            أطلب الخدمة
                        </a>

                    @else
                        <a href="{{route('webdetails',['slug' => \App\Helpers\HelperClass::strtoslug($r->service_name), 'id' => $r->id])}}"
                           class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                            أطلب الخدمة
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
