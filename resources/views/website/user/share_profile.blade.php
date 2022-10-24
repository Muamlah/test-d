@extends('website.layout')
@include('website.meta.meta', [
    'options' => [
        'title' 	=> $user->getName(),
        'sub_title' 	=> $user->getName(),
        'description' 	=> 'حسابي على منصة معاملة',
        'image'         => $user->getQrCode(),
        'keywords' 	    => 'حسابي على منصة معاملة',
        'url' 	    => '',
    ],
])
@include('website.meta.facebook', [
    'options' => [
        'title' 	=> $user->getName(),
        'sub_title' 	=> $user->getName(),
        'description' 	=> 'حسابي على منصة معاملة',
        'image'         => $user->getQrCode(),
        'keywords' 	    => 'حسابي على منصة معاملة',
        'url' 	    => '',
    ],
])
@include('website.meta.google', [
    'options' => [
        'title' 	=> $user->getName(),
        'sub_title' 	=> $user->getName(),
        'description' 	=> 'حسابي على منصة معاملة',
        'image'         => $user->getQrCode(),
        'keywords' 	    => 'حسابي على منصة معاملة',
        'url' 	    => '',
    ],
])
@include('website.meta.telegram', [
    'options' => [
        'title' 	=> $user->getName(),
        'sub_title' 	=> $user->getName(),
        'description' 	=> 'حسابي على منصة معاملة',
        'image'         => $user->getQrCode(),
        'keywords' 	    => 'حسابي على منصة معاملة',
        'url' 	    => '',
    ],
])
@include('website.meta.twitter', [
    'options' => [
        'title' 	=> $user->getName(),
        'sub_title' 	=> $user->getName(),
        'description' 	=> 'حسابي على منصة معاملة',
        'image'         => $user->getQrCode(),
        'keywords' 	    => 'حسابي على منصة معاملة',
        'url' 	    => '',
    ],
])
@section('content')
<div class="page-content header-clear-medium">
    <div class="card card-style">
        <div class="content text-center">
            <img src="{{$user->getImage()}}" class="mx-auto rounded-circle shadow-xl" width="150">
            <h1 class="mt-4">{{$user->name}}</h1>
            {{-- <p class="mb-4">{{$user->bio}}</p> --}}
            @if ($user->verified)
                <p class="mb-2">مقدم خدمة موثوق<i class="fa fa-check-circle color-green1-dark scale-icon mr-2"></i>
            @endif
            </p>
            <span>
                <div id="totla" rel="{{$total_avg}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
            </span>
        </div>
        @if($avg_reviews)
            <div class="content">
                <div class="row mb-0">
                    <h4 class="col-6 font-600 text-center font-15">جودة الخدمة</h4>
                    <div class="col-6 mb-3">
                        <div id="quality-service" rel="{{$avg_reviews->quality_of_service}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">سرعة التنفيذ</h4>
                    <div class="col-6 mb-3">
                        <div id="execution-speed" rel="{{$avg_reviews->execution_speed}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">الاحترافية بالتعامل</h4>
                    <div class="col-6 mb-3">
                        <div id="dealing" rel="{{$avg_reviews->professionalism_in_dealing}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">التواصل والمتابعة</h4>
                    <div class="col-6 mb-3">
                        <div id="communication" rel="{{$avg_reviews->communication}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">التعامل معه مرّة أخرى</h4>
                    <div class="col-6 mb-3">
                        <div id="dealing_again" rel="{{$avg_reviews->deal_with_him_again}}" class="review-stars mr-auto ml-auto mb-0 mt-0"></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="content mb-0">
            <div class="tab-controls tabs-round tab-animated tabs-large shadow-xl" data-tab-items="3"
                data-tab-active="bg-highlight color-white">
                <a href="#" data-tab="tab-experience" >طلب تعميد خاص</a>
                <a href="#" {{$type == 'reviews' ? 'data-tab-active' : ''}} data-tab="tab-reviews">التقييمات</a>
                <a href="#" {{$type == 'experience' ? 'data-tab-active' : ''}} data-tab-active data-tab="tab-services">الخبرات</a>
            </div>
            <div class="clearfix mb-3"></div>
            <div class="tab-content" id="tab-experience">
                <div class="content m-3">
                    <a href="{{route('privateOrder.create', ['provider_phone' => $user->phone])}}" class="btn btn-m w-100 btn-full  bg-green-c mr-auto ml-auto font-900 text mt-4">
                        إرسال طلب تعميد خاص
                    </a>
                </div>
            </div>
            <div class="tab-content pb-3" id="tab-reviews">
                <div class="accordion mt-2" id="accordion-2">


                </div>
                <a href="javascript:;"
                        data-page="1" data-link="{{route('share_profile.show_more_reviews',['id'=>$user->id])}}"
                        data-div="#accordion-2"
                        class=" see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                المزيد</a>
            </div>
            <div class="tab-content pb-3" id="tab-services">
                <div class="accordion mt-2" id="accordion-3"></div>
                <div class="content mb-3">
                    <a href="javascript:;"
                        data-page="1" data-link="{{route('share_profile.show_more_services',['id'=>$user->id])}}"
                        data-div="#accordion-3"
                        class=" see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                        المزيد
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="update-menu" class="menu menu-box-modal rounded-m"
     data-menu-height="280"
     data-menu-width="310">
    <div class="mr-3 ml-3 mt-3">
        <div class="input-style has-icon input-style-1 input-required">
            <h2>الرجاء تحديد سعر الخدمة و مدة التنفيذ</h2>
        </div>
        <hr>
        <div class="lineBorder"></div>
        <form method="post" action="{{route('eserviceFavorite.update')}}"
              enctype="multipart/form-data" class="form-horizontal" role="form">
            {{ csrf_field() }}
            <input hidden id="user_id" name="user_id"  >
            <input hidden id="service_id" name="service_id"  >

            <div class="input-style has-icon input-style-1 input-required">
                <input name="price" type="number" placeholder="سعر الخدمة" required></input>
            </div>
            <div class="input-style has-icon input-style-1 input-required">
                <input name="date" type="number" placeholder="عدد الايام المطلوب لتنفيذ الخدمة" required></input>
            </div>

            <button type="submit"
                    class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">إرسال
            </button>
        </form>
    </div>
</div>

<div id="update" class="menu-hider "><div></div></div>
@endsection

@section('script')

<script>
    function update(user_id,service_id){
        $('#update').addClass('menu-active');
        $('#update-menu').addClass('menu-active');
        $('#service_id').val(service_id);
        $('#user_id').val(user_id);
    }
    function review(){
        $(".review-stars").each(function(i, obj) {
            var rateYo = $(this);
            var stars = rateYo.attr('rel');
            $(rateYo).rateYo({
                halfStar: true,
                rating: stars,
                readOnly: true,
            });
        });
    }
    review();
</script>

<script>

    $('.see-more').click(function() {
       let div = $($(this).data('div')); //div to append
       let link = $(this).data('link'); //current URL
       let page = $(this).data('page'); //get the next page #
       let thisSeeMore =$(this);
       console.log(page);
       let href = link + '?page='+ page; //complete URL
       $.ajax(
           {
               url:   href,
               data: {

               },
               type: "get",
               beforeSend: function()
               {
                   thisSeeMore.html('جاري التحميل....');
               }
           })
           .done(function(data)
           {
               if(data.html == ""){
                   thisSeeMore.html('لا يوجد المزيد');
                   thisSeeMore.hide(1000);
                   return;
               }
               thisSeeMore.data('page',page + 1); //update page #
               $(data.html).hide().appendTo(div).show(1000);
               thisSeeMore.html('المزيد');
               review();
           })
           .fail(function(jqXHR, ajaxOptions, thrownError)
           {
               alert('الرجاء المحاولة مرة اخرى');
           });
   });
   $('.see-more').click();
</script>
@endsection
