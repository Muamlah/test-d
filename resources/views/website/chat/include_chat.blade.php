@if(!is_null($message))
<div class="card card-overflow card-style" id="messages-card">
    <div class="card-body">
        <div class="header-clear-medium whatsapp-bg" style="position:relative;overflow: scroll;min-height:400px !important;max-height:400px;margin-bottom: 50px;padding:10px 0 50px 0;">
            <div class="content">
                <div class="text-center mb-3 p-1 shadow-m chat-alert">
                    <p class="font-11 lh-n1">لا تعطي كلمة المرور لأي شخص مهما كان،
                        موظفي منصة معاملة لا يطلبون كلمة المرور ولا بياناتك السرية،
                        كن حريصاً عليها</p>
                </div>
                <div id="scroll" class="content scroll" id="messages">
                    @foreach($message->children as $child)
                    @if(!is_null($child->file))
                    <div class="clearfix"></div>
                    <div class="speech-bubble speach-image speech-{{auth()->user()->id == $child->user_id ? 'left bg-msg-send mb-0' : 'right bg-msg-r mb-3'}} bg-highlight message-item"
                        data-id="{{ $child->id }}">
                        @if($child->getFile('ext') == 'image')
                        <a href="{{$child->getFile()}}" download>
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
                    <div class="speech-bubble speech-{{auth()->user()->id == $child->user_id ? 'left bg-msg-send mb-0' : 'right bg-msg-r mb-3'}}"
                        data-id="{{ $child->id }}">
                        @if(auth()->user()->id == $child->user_id)
                        {{-- <p style="font-size: 13px">{{$child->name}}</p> --}}
                        @else
                        {{-- <p style="font-size: 13px">المشرف: {{$child->name}}</p> --}}
                        @endif
                        <p style="font-size: 13px">{{$child->name}}</p>
                        {!!$child->message!!}
                    </div>
                    @endif
                    @endforeach
                    <div id="children" class="order-chat">
                    </div>
                </div>
            </div>
            
            <div id="footer-chat-bar" class="d-flex footer-bar-1 bg-white">
                <div class="mr-3 speach-icon">
                    <a href="#" id="open-upload-files" class="bg-gray2-dark ml-2"><i class="fa fa-plus"></i></a>
                </div>
                <div class="flex-fill speach-input">
                    <input type="text" class="form-control"  placeholder="أدخل رسالتك هنا" id="message_text">
                </div>
                <div class="ml-3 speach-icon">
                    <button type="button" id="send_message" class="bg-btn-whatsapp  color-white mr-2 button-message"><i
                            class="fa fa-arrow-up"></i></button>
                </div>
            </div>   
            <div id="upload-files">
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
        </div>
    </div>
</div>   

<form method="POST" enctype="multipart/form-data" id="ajax-file-upload" action="javascript:void(0)"
    style="visibility: hidden">
    @csrf
    <input type="hidden" name="parent_id" id="message_parent_id" value="{{$message->id}}">
    <input type="file" multiple accept="image/jpeg,image/jpg,image/png,application/pdf" name="file[]" placeholder="اختر الملف"
        id="file">
    <span class="text-danger">{{ $errors->first('file') }}</span>
</form>

<style>
    #footer-chat-bar {
        position: fixed;
        bottom: 5px;
        left: 15px;
        right: 15px;
        z-index: 98;
        background-color: rgba(249, 249, 249, .98);
        box-shadow: 0 -5px 10px 0 rgb(0 0 0 / 6%);
        min-height: 60px;
        display: flex;
        text-align: center;
        transition: all 350ms ease;
    }
    #messages-card .speech-bubble{
        margin-bottom: 15px !important;
    }
    #upload-files {
        background: #fff;
        border-radius: 10px;
        margin: 0 10px;
        position: relative;
        bottom: -45px;
        display: none;
        position: fixed;
        bottom: 75px;
        width: 85%;
    }
</style>
@section('script')
<script>
    function bscroll(){
        $('.whatsapp-bg').animate({
            scrollTop: 100000000
        }, 1);
    }
    bscroll();
    $(document).mouseup(function (e) {
        var container = $("#upload-files");
        if(!container.is(e.target) && 
        container.has(e.target).length === 0) {
            container.hide('slow');
        }
    });
    $('#open-upload-files').click(function(){
        $('#upload-files').toggle('slow');
    });
    function sendMessage() {
        $('#message_text').css('border-color', '#ff000000');
        let message = $('#message_text').val();
        // console.log(message)
        if (message == "") {
            $('#message_text').css('border-color', '#ff000038');
            return;
        }
        $.ajax(
            {
                url: "{{route('chat.chat.new_message')}}",
                type: "POST",
                data: {
                    message: message,
                    _token: "{{csrf_token()}}",
                    parent_id: "{{$message->id}}"
                },
                beforeSend: function () {
                    $('#message_text').val("");

                    $('#message_text').css('border-color', '#ff000000');
                }
            })
            .done(function (data) {
                $('#message_text').css('border-color', '#ff000000');
                if (data.html != "") {
                    $('#message_text').val("");
                    // $('#children').append(data.html);
                }
                bscroll();

            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                $('#message_text').css('border-color', '#ff000000');
                alert('الرجاء المحاولة مرة اخرى');
            });
    }

    $('#send_message').on('click', sendMessage);


    $('#message_text').on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            sendMessage();
        }
    });
</script>
<script type="text/javascript">
    function uploadFile() {
        $('#file').click();
    }

    $("#file").change(function () {
        $("#ajax-file-upload").submit();
    });
    $(document).ready(function (e) {
        $('#ajax-file-upload').submit(function (e) {
            $('#message_text').val("");
            e.preventDefault();
            var formData = new FormData(this);
            let TotalFiles = $('#file')[0].files.length; //Total files
            let file = $('#file')[0];
            for (let i = 0; i < TotalFiles; i++) {
                formData.append('file' + i, file.files[i]);
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('chat.store_file')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.html != "") {
                        $('#message_text').val("");
                        // $('#children').append(data.html);
                        $('.menu-active').removeClass('menu-active');
                        $('.theme-light').removeClass('modal-open');
                        $('#footer-bar').removeClass('footer-menu-hidden');
                        bscroll();
                    }
                    bscroll();

                },
                error: function (data) {
                    alert(data);
                }
            });
        });
    });

    function getLastId() {
        var last_item = $('#children').find('.message-item').last();
        var last_id = 0;
        if (last_item.length > 0) {
            last_id = last_item.data('id');
        }
        return last_id
    }

    var last_id = '{{!empty($message->children->last()) ? $message->children->last()->id : 0}}';

    function seeNewMessages() {
        var parent_id = $('#message_parent_id').val();
        // console.log(last_id);
        $.ajax(
            {
                url: "{{route('chat.chat.see_new_message')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    parent_id: parent_id,
                    last_id: last_id
                }
            })
            .done(function (data) {
                if (data.html != "") {
                    $('#children').append(data.html);
                    last_id = getLastId();

                    var div = document.getElementById('scroll');
                    console.log(div);
                    div.scrollTop = div.scrollHeight - div.clientHeight;

                    console.log(div.scrollHeight );
                    console.log(div.clientHeight);
                    bscroll();

                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('الرجاء المحاولة مرة اخرى');
            });
    }

    setInterval(seeNewMessages, 3000);

    
</script>    
@endsection
@endif