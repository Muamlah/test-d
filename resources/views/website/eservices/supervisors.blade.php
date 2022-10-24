@extends('website.layout')
@section('content')

  <!-- Page Content-->
  <div class="page-content header-clear-medium">
    <div class="card card-style">
        <div id="supervisors"></div>
        <div class="mb-4 mt-5 pl-3 pr-3">
            <a data-page="1" data-link="{{route('more_supervisors')}}" data-div="#supervisors" href="#"
                class="see-more-data btn btn-full btn-m btn-plus shadow-l m-auto rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                المزيد</a>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(function () {
        $(".review-stars").each(function(i, obj) {
            var rateYo = $(this);
            var stars = rateYo.attr('rel');
            $(rateYo).rateYo({
                halfStar: true,
                rating: stars,
                readOnly: true,
            });
        });

    });
</script>
    <script>
        $(".see-more-data").click(function() {
            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            // alert(page)
            let thisSeeMore =$(this);
            let href = link + '?page='+ page; //complete URL
            $.ajax(
                {
                    url:   href,
                    data:   {
                        service_id: '{{$service_id}}'
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
                        thisSeeMore.hide();
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
        $(".see-more-data").click();
       
    </script>

@endsection