
@extends('website.layout')

@section('content')

        <div class="page-content header-clear-medium">
            <div class="card card-style bg-grey-c card-order" data-card-height="130">
                <div class="card-center text-center mr-3">
                    <h1 class="color-white mb-0">{{$section->name}}</h1>
                    <p class="color-white mt-n1 mb-0"></p>
                </div>
            </div>
            <div id="sectionEservices">
                @include('website.eservices.ajax-view.section_eservices_data')
            </div>
            @if($eservices->count()==10)
                <a data-page="2" data-link="{{route('section.eservices.seeMore',$section->id)}}" data-div="#sectionEservices" href="#"  class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                    المزيد</a>
        @endif


        <!--    <div class="content shadow-l mb-0">
                <a href="#" class="btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                    المزيد</a>
            </div> -->


        </div>

        @endsection

@section('script')
    <script>
        function userRate(service_id){

            var token           = "{{ csrf_token() }}";
            @guest
            var provider_id     = 0;
            @else
            var provider_id     = "{{auth()->user()->id}}";

            @endguest
            var type            = $(`.favorit-type${service_id}`).val();
            $.ajax({
                url:   "{{route('eserviceFavorite')}}",
                data: {
                    _token:token , service_id: service_id , provider_id: provider_id , type: type
                },
                type: "post",
                beforeSend: function()
                {

                }
            })
            .done(function(data){
                // console.log(data.type);
                if(data.type == 'added_to_favorite'){
                    $(`.favorit-type${service_id}`).val('delete');
                    $(`.interested-service-${service_id}`).addClass('added-to-favorite');
                    $(`.interested-service-${service_id}`).removeClass('deleted-from-favorite');
                    $(`.interested-service-${service_id}`).css('background-color', '').css('background-color','#DA4453');
                    $(`.interested-service-${service_id}`).html('الغاء الاهتمام');
                    alert('تمت الإضافة إلى المفضلة');
                }else{
                    $(`.favorit-type${service_id}`).val('add');
                    $(`.interested-service-${service_id}`).addClass('deleted-from-favorite');
                    $(`.interested-service-${service_id}`).removeClass('added-to-favorite');
                    $(`.interested-service-${service_id}`).css('background-color', '').css('background-color','#258206');
                    $(`.interested-service-${service_id}`).html('مهتم');
                    alert('تم الحذف من المفضلة');
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError){
                alert('الرجاء المحاولة مرة اخرى');
            });
        }

    </script>
    <script>
        $(".see-more").click(function() {
            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            let thisSeeMore =$(this);
            console.log(page);
            let href = link + '?page='+ page; //complete URL
            $.ajax(
                {
                    url:   href,
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
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('الرجاء المحاولة مرة اخرى');
                });
        });
    </script>

@endsection

