@extends('website.layout')
@section('content')
<div class="page-content header-clear-medium page-settings">
    <div class="card card-style">
        <div class="content my-0">
            <div class="list-group list-custom-small">
                <a data-trigger-switch="switch-2" href="#">
                <i class="fa font-14 fa-bell rounded-s bg-plum-dark"></i>
                 <span class="font-15">إستلام
                        إشعارات الخدمات الإلكترونية</span>
                    <div class="custom-control scale-switch ios-switch"> <input type="checkbox"
                            class="ios-input update-settings-input" id="switch-2" {{$eservices_orders_notifications == '1' ? 'checked' : ''}}
                            data-checked="{{$eservices_orders_notifications}}"> <label class="custom-control-label update-settings-label"
                            for="switch-2" id="switch-2-label"></label> </div> <i class="fa fa-chevron-right opacity-30"></i>
                </a> 
                <a data-trigger-switch="switch-3" href="#"><i
                        class="fa font-14 fa-bell rounded-s bg-violet-light"></i> <span class="font-15">إستلام
                        إشعارات طلبات التعميد</span>
                    <div class="custom-control scale-switch ios-switch"> <input type="checkbox"
                            class="ios-input update-settings-input" id="switch-3" {{$public_private_orders_notifications == '1' ? 'checked' : ''}}
                            data-checked="{{$public_private_orders_notifications}}"> <label class="custom-control-label update-settings-label"
                            for="switch-3" id="switch-3-label"></label> </div> <i class="fa fa-chevron-right opacity-30"></i>
                </a> 
            </div>
        </div>
    </div>
</div> 
@endsection

@section('script')
    <script>
        $("#switch-2-label").on('click', function(e) {

            let input_value = $('#switch-2').data('checked');

            if(input_value == '1'){
                $('#switch-2').data('checked','off');
                var status = '0';
            }else{
                $('#switch-2').data('checked','on');
                var status = '1';
            }
            var type = 'eservices_orders_notifications';
            $.ajax({
                url:   "{{route('website.settings.update_notification_status')}}",
                data: {
                    status: status,
                    type: type,
                    _token: '{{csrf_token()}}'
                },
                type: "post",
                success: function (data) {

                },
                error: function (reject) {
                    if( reject.status === 401 ) {
                        $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                        $('.alert-box').show();
                    }
                }
            });
        });

        $("#switch-3-label").on('click', function(e) {

        let input_value = $('#switch-3').data('checked');

        if(input_value == '1'){
            $('#switch-3').data('checked','off');
            var status = '0';
        }else{
            $('#switch-3').data('checked','on');
            var status = '1';
        }
        var type = 'public_private_orders_notifications';
        $.ajax({
            url:   "{{route('website.settings.update_notification_status')}}",
            data: {
                status: status,
                type: type,
                _token: '{{csrf_token()}}'
            },
            type: "post",
            success: function (data) {

            },
            error: function (reject) {
                if( reject.status === 401 ) {
                    $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                    $('.alert-box').show();
                }
            }
        });
    });
    </script>
@endsection
