@foreach($services as $service)
<div class="card card-style">
    <div class="content">
        <div class="d-flex mb-4">
            <div class="align-self-center">
                <span class="icon icon-xxl rounded-m me-3"><img src="{{asset('public/storage'.'/'.$service->img)}}" width="80"
                        class="rounded-sm"></span>
            </div>
            <div class="align-self-center w-100 mr-2">
                <h4>{{$service->service_name}}
                    @if($service->pivot->price!=0)
                    <strong
                        class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">  {{$service->pivot->price}} ريال</strong>
                    @endif
                    @if($service->pivot->price!=0)
                    <strong style=" margin-left: 5px;"
                        class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">  مدة التنفيذ  {{$service->pivot->date}} ايام</strong>
                    @endif
                </h4>
                <p class="mb-0 opacity-60 line-height-s font-14">
                    {{$service->details}}
                </p>
                @if($service->pivot->price!=0)
                    <p class="mb-0 opacity-60 line-height-s font-14">

                    </p>
                @endif
                <br>
                @if(request()->id==Auth::id() && $service->pivot->price==0)
                <p style="color: red" class="mb-0 opacity-60 line-height-s font-14">
                  <b>الرجاء اضافة سعر الخدمة و مدة التنفيذ</b>
                </p>
                @elseif(request()->id!=Auth::id() && $service->pivot->price==0)
                    <p style="color: red" class="mb-0 opacity-60 line-height-s font-14">
                        <b>الرجاء التواصل مع مقدم الخدمة لتحديد السعر و المدة</b>
                    </p>
                @endif
            </div>
        </div>
        <div class="divider mb-2 mt-n2"></div>
        <div class="row mb-n2 text-center">
            @if(request()->id==Auth::id())
            <div class="col">
                <a  href="#" onclick="update({{request()->id}},{{$service->id}});" data-menu="update"  class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                    تعديل السعر
                </a>
            </div>
          @else
            <div class="col">
                <a href="{{route('webdetails',['slug' => \App\Helpers\HelperClass::strtoslug($service->service_name), 'id' => $service->id, 'provider_id' => request()->id])}}" class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                    أطلب الخدمة
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endforeach
