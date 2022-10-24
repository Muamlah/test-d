@extends('website.layout')
@section('content')

<div class="page-content header-clear-medium">
    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center">
            <h1 class="color-white mb-0">{{$message->subject}}</h1>
        </div>
    </div>
    <div class="card card-style">
        <div class="content" id="messages">
            <div class="clearfix"></div>
            <div class="speech-bubble speech-left bg-highlight">
                {!!$message->message!!}
            </div>
            @foreach($message->children as $child)
            @if(!is_null($child->file))
            <div class="clearfix"></div>
            <div class="speech-bubble speach-image speech-left bg-highlight">
                @if($child->getFile('ext') == 'image')
                <a href="{{$child->getFile()}}" download >
                    <img class="img-fluid preload-img" src="{{$child->getFile()}}" data-src="{{$child->getFile()}}">
                </a>
                @else
                <a href="{{$child->getFile()}}" download class="bg-highlight color-white mr-2 button-message m-3">
                    <i class="fa fa-arrow-down"></i> تحميل الملف المرفق
                </a>
                @endif
                </a>
            </div>
            @else
            <div class="clearfix"></div>
            <div class="speech-bubble speech-{{auth()->user()->id == $child->user_id ? 'left bg-highlight' : 'right color-black'}}">
                {!!$child->message!!}
            </div>
            @endif
            @endforeach

            <div id="children">
            </div>
            <div class="clearfix"></div>
            {{-- <em class="speech-read mb-3">Delivered & Read - 07:18 PM</em> --}}
            <div class="divider"></div>
            <form action="">
                <div class="d-flex">
                    <div class="mr-3 speach-icon">
                        <a href="#" data-menu="menu-upload" class="bg-gray2-dark ml-2 text-center"><i
                                class="fa fa-plus"></i></a>
                    </div>
                    <div class="flex-fill speach-input">
                        <textarea class="form-control" placeholder="أدخل رسالتك هنا" id="message_text"></textarea>
                    </div>
                    <div class="ml-3 speach-icon">
                        <button type="button" id="send_message" class="bg-highlight color-white mr-2 button-message"><i
                                class="fa fa-arrow-up"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="menu-upload" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="100"
data-menu-effect="menu-over">
    <div class="list-group list-custom-small pl-2 mr-4">
        <a href="javascript:;" onclick="uploadFile()">
        <i class="font-14 fa fa-file color-gray2-dark"></i>
        <span class="font-13">ملف</span>
        <i class="fa fa-angle-left"></i>
    </a>
    <a href="javascript:;" onclick="uploadFile()">
        <i class="font-14 fa fa-image color-gray2-dark"></i>
        <span class="font-13">صورة</span>
        <i class="fa fa-angle-left"></i>
    </a>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" id="ajax-file-upload" action="javascript:void(0)" style="visibility: hidden">
    @csrf
    <input type="hidden" name="parent_id" value="{{$message->id}}">
    <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="file" placeholder="اختر الملف" id="file">
    <span class="text-danger">{{ $errors->first('file') }}</span>
    </form>


@endsection

@section('script')
    <script>
        function sendMessage(){
            $('#message_text').css('border-color', '#ff000000');
            let message = $('#message_text').val();
            if(message == ""){
                $('#message_text').css('border-color', '#ff000038');
                return ;
            }
            $.ajax(
                {
                    url:   "{{route('messages.chat.new_message')}}",
                    type: "POST",
                    data : {
                        message : message,
                        _token : "{{csrf_token()}}",
                        parent_id : "{{$message->id}}"
                    },
                    beforeSend: function()
                    {
                        $('#message_text').css('border-color', '#ff000000');
                    }
                })
                .done(function(data)
                {
                    $('#message_text').css('border-color', '#ff000000');
                    if(data.html != ""){
                        $('#message_text').val("");
                        $('#children').append(data.html);
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    $('#message_text').css('border-color', '#ff000000');
                    alert('الرجاء المحاولة مرة اخرى');
                });
        }
        $('#send_message').on('click', sendMessage);


        $('#message_text').on('keypress',function(e) {
            if(e.which == 13) {
                e.preventDefault();
                sendMessage();
            }
        });
    </script>
    <script type="text/javascript">
        function uploadFile(){
            $('#file').click();
        }
        $("#file").change(function() {
            $("#ajax-file-upload").submit();
        });
        $(document).ready(function (e) {
        $('#ajax-file-upload').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('messages.store_file')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
            success: (data) => {
            if(data.html != ""){
                $('#message_text').val("");
                $('#children').append(data.html);
                $('#menu-upload').removeClass('menu-active');
            }
            },
            error: function(data){
            alert(data);
            }
        });
        });
        });
        </script>
@endsection
