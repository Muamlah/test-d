@extends('website.layout')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .update {
        font-size: 12px;
        color: #ddd;
        margin-left: 5px;

    }

    #profile-image:hover {
        border: 2px solid #ddd;
        cursor: pointer;

    }

    .custom-input {
        background: transparent;
        border: 0;
        border-bottom: 1px solid #2f3135;
    }
</style>
@endsection
@section('content')
<!-- Page Content-->
<div class="page-content header-clear-medium">

    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center mr-3">
            <h1 class="color-white mb-2">تقييم الخدمة</h1>
        </div>
    </div>
    <div class="card card-style">
        <div class="content text-center">
            <img src="{{ $user->image? '/public/storage/'.$user->image: '/public/template-muamlah/images/logo.png' }}" class="mx-auto rounded-circle shadow-xl" width="150">
            <h1 class="mt-4"> {{ $user->name }} </h1>
{{--            <p class="mb-4">"الحمدللّه بلا سبب, و لا طلب, الحمدللّه حمدا كاملا, الحمدللّه دائما و أبدا"</p>--}}
            @if ($user->verified)
            <p class="mb-2">هوية موثقة <i class="fa fa-check-circle color-green1-dark scale-icon mr-2"></i>
                @endif
            </p>
            <span>

                <div class="mr-auto ml-auto mb-0 mt-0 jq-ry-container" readonly="readonly" style="width: 120px;">
                    <div class="jq-ry-group-wrapper">
                        <div class="jq-ry-normal-group jq-ry-group">
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="gray">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="gray" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="gray" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="gray" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="gray" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                        </div>
                        <div class="jq-ry-rated-group jq-ry-group" style="width: {{ count($user->avgReviews) >0 ? ($user->avgReviews[0]->quality_of_service + $user->avgReviews[0]->execution_speed + $user->avgReviews[0]->professionalism_in_dealing + $user->avgReviews[0]->communication + $user->avgReviews[0]->deal_with_him_again) *4:0    }}%;">
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="#f39c12">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="#f39c12" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="#f39c12" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="#f39c12" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                            <!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="24px" height="24px" fill="#f39c12" style="margin-left: 0px;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon>
                            </svg>
                        </div>
                    </div>
                </div>

            </span>
        </div>
        <div class="content">
            <form class="form" method="POST" novalidate="novalidate" action="{{url('/user/make-reviews')}}" id="make_reviews">

                <div class="row mb-0">
                    <input type="hidden" name="provider_id" value="{{ $user->id }}">
                    <input type="hidden" name="order_type" value="{{ $order_type }}">
                    <input type="hidden" name="order_id" value="{{ $order_id }}">
                    <h4 class="col-6 font-600 text-center font-15">جودة الخدمة</h4>
                    <div class="col-6 mb-3">
                        <div id="quality-service" class="mr-auto ml-auto mb-0 mt-0"></div>
                        <input type="hidden" name="quality_of_service" value="0">
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">سرعة التنفيذ</h4>
                    <div class="col-6 mb-3">
                        <div id="execution-speed" class="mr-auto ml-auto mb-0 mt-0"></div>
                        <input type="hidden" name="execution_speed" value="0">
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">الاحترافية بالتعامل</h4>
                    <div class="col-6 mb-3">
                        <div id="professionalism_in_dealing" class="mr-auto ml-auto mb-0 mt-0"></div>
                        <input type="hidden" name="professionalism_in_dealing" value="0">
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">التواصل والمتابعة</h4>
                    <div class="col-6 mb-3">
                        <div id="communication" class="mr-auto ml-auto mb-0 mt-0"></div>
                        <input type="hidden" name="communication" value="0">
                    </div>
                    <h4 class="col-6 font-600 text-center font-15">التعامل معه مرّة أخرى</h4>
                    <div class="col-6 mb-3">
                        <div id="deal_with_him_again" class="mr-auto ml-auto mb-0 mt-0"></div>
                        <input type="hidden" name="deal_with_him_again" value="0">
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-info"></i>
                            <span>أترك تعليق</span>
                            <textarea class="textarea-height requiredField" name="comment" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="w-100 divider divider-margins"></div>
                <button class="btn btn-m w-100 btn-full rounded-l bg-yellow-c mr-auto ml-auto font-900 text mt-4">
                    تقييم الخدمة
                </button>
                <a href="{{route('website.home')}}" class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c mt-4">
                    تخطي التقييم
                </a>
            </form>
        </div>
    </div>
</div>
<!-- End of Page Content-->
@endsection
<!-- notification -->
<!-- End message-->




@section('script')
<script type="text/javascript" src="{{asset("/template-muamlah/scripts/jquery.js")}}"></script>
<script type="text/javascript" src="{{asset("/template-muamlah/scripts/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/template-muamlah/scripts/custom.js")}}"></script>
<script type="text/javascript" src="{{asset("/template-muamlah/scripts/flatpickr.js")}}"></script>
<script type="text/javascript" src="{{asset("/template-muamlah/scripts/jquery.rateyo.min.js")}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>


<!-- <script type="text/javascript" src="{{asset('public/admin/assets/js/pages/custom/login/send-rate.js')}}"></script> -->
<script>
    var HOST_URL = '{{config('app.url')}}'
</script>
<script>
    $(function() {
        $('#make_reviews').bind('submit', function(event) {

            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/user/make-reviews',
                data: $('form').serialize(),
                success: function() {
                    //alert('form was submitted');
                    //redirect to another page!
                    window.location.href = HOST_URL + '/settings';
                }
            });
        });




        var rateYo = $("#quality-service");
        var rateYoField = $("input[name='quality_of_service']");

        $(rateYo).rateYo({
            halfStar: true,
            onSet: function(rating, rateYoInstance) {
                $(rateYoField).val(rating);
            }
        });

        var rateYo2 = $("#execution-speed");
        var rateYoField2 = $("input[name='execution_speed']");

        $(rateYo2).rateYo({
            halfStar: true,
            onSet: function(rating, rateYoInstance) {
                $(rateYoField2).val(rating);
            }
        });

        var rateYo3 = $("#professionalism_in_dealing");
        var rateYoField3 = $("input[name='professionalism_in_dealing']");

        $(rateYo3).rateYo({
            halfStar: true,
            onSet: function(rating, rateYoInstance) {
                $(rateYoField3).val(rating);
            }
        });

        var rateYo4 = $("#communication");
        var rateYoField4 = $("input[name='communication']");

        $(rateYo4).rateYo({
            halfStar: true,
            onSet: function(rating, rateYoInstance) {
                $(rateYoField4).val(rating);
            }
        });

        var rateYo5 = $("#deal_with_him_again");
        var rateYoField5 = $("input[name='deal_with_him_again']");

        $(rateYo5).rateYo({
            halfStar: true,
            onSet: function(rating, rateYoInstance) {
                $(rateYoField5).val(rating);
            }
        });
    });
</script>
@endsection
