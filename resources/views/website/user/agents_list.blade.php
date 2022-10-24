@extends('website.layout')
@section('style')

<style>

</style>
@endsection
@section('content')
 <!-- Page Content-->
 <div class="page-content header-clear-medium">
     
    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center mr-3">
            <h1 class="color-white mb-0">الوكلاء</h1>
        </div>
    </div>
    @if ($message = Session::get('success') )
    <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif
    <div class="row" id="agents">
    </div>
    <div class="mb-4 pl-3 pr-3">
        <a href="javascript:;"
            data-page="1" data-link="{{route('user.agents_more_data')}}" data-div="#agents"
            class=" see-more-data btn btn-full btn-m btn-plus shadow-l m-auto rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
            المزيد</a>
    </div>
</div>
<!-- End of Page Content-->

@endsection
@section('script')
<script>
    
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
                    $(".review-stars").each(function(i, obj) {
                        var rateYo = $(this);
                        var stars = rateYo.attr('rel');
                        $(rateYo).rateYo({
                            halfStar: true,
                            rating: stars,
                            readOnly: true,
                        });
                    });
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('الرجاء المحاولة مرة اخرى');
                });
        });
        $(".see-more-data").click();
       
    </script>

@endsection
