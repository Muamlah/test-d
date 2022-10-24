@extends('website.layout')
@section('content')
<div class="page-content header-clear-medium">
    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center">
            <h1 class="color-white mb-0">الرسائل</h1>
        </div>
    </div>
    <div class="card card-style">
        <div class="content">
            @if ($errors->any())
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                @foreach($errors->all() as $error)
                <strong>{{$error}} </strong><br/>
                @endforeach
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
            @endif
            @if ($message = Session::get('success') )
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <strong>تم إرسال الرسالة بنجاح</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif
            <div class="accordion" id="accordion-1">
                <div class="mb-0">
                    <button class="btn accordion-btn" data-toggle="collapse" data-target="#collapse1">
                        <i class="fa fa-envelope color-green3-dark ml-2"></i>
                        رسالة جديدة
                        <i class="fa fa-plus font-10 accordion-icon"></i>
                    </button>

                    <div id="collapse1" class="collapse" data-parent="#accordion-1">
                        <div>

                            <form  method="post" action="{{route('messages.send')}}" role="form">
                                @csrf
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="input-icon fa fa-user"></i>
                                    <span class="color-highlight input-style-1-active">الإسم</span>
                                    <em>(مطلوب)</em>
                                    <input type="name" name="name" required class="form-control"  value="{{auth()->check() ? auth()->user()->full_name : ''}}">
                                </div>
                                <div class="input-style input-style-2 has-icon input-required mt-4">
                                    <i class="input-icon fa fa-at"></i>
                                    <span class="color-highlight input-style-1-active">الإيميل</span>
                                    <em>(مطلوب)</em>
                                    <input type="email" name="email" required class="form-control"  value="{{auth()->check() ? auth()->user()->email : ''}}">
                                </div>
                                <div class="input-style input-style-2 has-icon input-required mt-4">
                                    <i class="input-icon fa fa-heading"></i>
                                    <span class="color-highlight">الموضوع</span>
                                    <em>(مطلوب)</em>
                                    <input type="text" name="subject" required class="form-control">
                                </div>
                                <div class="input-style input-style-2 has-icon input-required mt-4">
                                    <i class="input-icon fa fa-comment-dots"></i>
                                    <span class="color-highlight">الرسالة</span>
                                    <em>(مطلوب)</em>
                                    <textarea style="color: #FFF;" class="textarea-height requiredField" name="message" required id="" cols="30"
                                        rows="10"></textarea>
                                </div>
                                <button type="submit"
                                    class="btn btn-full w-100 bg-green-c btn-m text-uppercase rounded-l shadow-l mb-3 mt-4 font-900">
                                    إرسال الرسالة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="messages"></div>

    <div  class="content shadow-l mb-0 ml-3 mr-3">
        <a data-page="1" data-link="{{route('messages.seeMoreMessages')}}" data-div="#messages" href="#"  class="see-more-data btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
            المزيد</a>
    </div>

</div>
@endsection
@section('script')
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
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('الرجاء المحاولة مرة اخرى');
                });
        });
        $(".see-more-data").click();

    </script>

@endsection
