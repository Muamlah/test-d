<!DOCTYPE HTML>
<html lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>منصة معاملة . كوم</title>
    <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logo.png">
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
</head>
<body class="p-5">
<div style="font-size:14px;">
    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
        style="border:1px solid #44a0dd;background-color:#44a0dd;color:#fff;margin:0px;padding:0px;width:100%;text-align:right;">
        <tr>
            <td style="width:100%;">
                <div style="text-align:center;font-size:22px;">
                    <b>فاتورة</b>
                </div>
            </td>
        </tr>
    </table>
    <br />&nbsp;
    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
        style="margin:0px;padding:0px;width:100%;text-align:right;font-size:16px;">
        <tr>
            <td style="width:50%;">
                <div style="text-align:center;">
                    <img src="https://app.muamlah.com/public/template-muamlah/images/logo.png" style="width:102px;" />
                </div>
            </td>
            <td style="width:50%;">
                @if(!is_null($order->provider))
                <b>{!! $order->provider->name !!}</b>
                <p>{!! $order->provider->bio !!}</p>
                @endif
                <br/>
                سجل تجاري 4031209968 <br/>
                الرقم الضريبي 310111504600003  <br/>
                مكة المكرمة 
            </td>
            
        </tr>

    </table>
    <br />&nbsp;<br />
    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
        style="margin:0px;padding:0px;width:100%;text-align:right;font-size:16px;">
        <tr>
            <td style="width:50%;">
                <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                    style="margin:0px;padding:0px;width:100%;text-align:right;font-size:14px;">
                    <tr>
                        <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:30%;font-size:12px;">
                            الفاتورة #
                        </td>
                        <td style="border:1px solid #44a0dd;width:70%;font-size:12px;">
                            {{trans('common.'.request()->type)}}-{{$order->id}}
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:30%;font-size:12px;">
                            التاريخ
                        </td>
                        <td style="border:1px solid #44a0dd;width:70%;font-size:12px;">
                            {{\Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:30%;font-size:12px;">
                            المبلغ
                        </td>
                        <td style="border:1px solid #44a0dd;width:70%;font-size:12px;">
                            {{$order->total_amount}} ريال
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width:50%;">
                &nbsp;
            </td>
        </tr>
    </table>
    <br />&nbsp;<br />
    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
        style="margin:0px;padding:0px;width:100%;text-align:right;font-size:14px;">
        <tr>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:15%;font-size:12px;">
                رقم التعميد
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:45%;font-size:12px;">
                تفاصيل التعميد
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:15%;font-size:12px;">
                قيمة التعميد
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:10%;font-size:12px;">
                رسوم التعميد
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:15%;font-size:12px;">
                الإجمالي
            </td>
        </tr>
        <tr>
            <td style="border:1px solid #44a0dd;width:15%;">
                {{$order->id}}
            </td>
            <td style="border:1px solid #44a0dd;width:45%;font-size:12px;">{!!$order->details!!}<br />
                طلب تعميد من صاحب الرقم {!! $order->user->phone !!}
                <br />
                إلى مقدم الخدمة رقم {!! $order->provider->phone !!}
            </td>
            <td style="border:1px solid #44a0dd;width:15%;font-size:12px;">
                {{$order->price}} ريال
            </td>
            <td style="border:1px solid #44a0dd;width:10%;font-size:12px;">
                {{$order->fees}} ريال
            </td>
            <td style="border:1px solid #44a0dd;width:15%;font-size:12px;">
                {{$order->total_amount}} ريال
            </td>
        </tr>
    </table><br />&nbsp;<br />
    {{-- <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
        style="margin:0px;padding:0px;width:100%;text-align:right;font-size:14px;">
        <tr>
            <td style="border:1px solid #44a0dd;width:100%;font-size:12px;">سجل المدفوعات</td>
        </tr>
        <tr>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:20%;font-size:12px;">
                Card or account holder
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:20%;font-size:12px;">
                Card Number
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:10%;font-size:12px;">
                Brand
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:20%;font-size:12px;">
                transaction receipt
            </td>
            <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:30%;font-size:12px;">
                bank
            </td>
        </tr>
        <tr>
            <td style="border:1px solid #44a0dd;width:20%;font-size:12px;">
                account holder
            </td>
            <td style="border:1px solid #44a0dd;width:20%;font-size:12px;">'
                56562367676762767676327</td>
            <td style="border:1px solid #44a0dd;width:10%;font-size:12px;">
                mada</td>
            <td style="border:1px solid #44a0dd;width:20%;font-size:12px;">
                378787
            </td>
            <td style="border:1px solid #44a0dd;width:30%;font-size:12px;">
                الراجحي
            </td>
        </tr>
    </table> --}}
    <br />&nbsp;<br />
    <table dir="rtl" valign="middle" border="0" cellpadding="0" cellspacing="0"
        style="margin:0px;padding:0px;width:100%;text-align:right;font-size:16px;">
        <tr>
            <td style="width:50%;">
                &nbsp;
            </td>
            <td style="width:50%;">
                <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                    style="margin:0px;padding:0px;width:100%;text-align:right;font-size:14px;">
                    <tr>
                        <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:60%;font-size:12px;">
                            ضريبة القيمة المضافة <span style="color:#494949;">15%</span>
                        </td>
                        <td style="border:1px solid #44a0dd;width:40%;font-size:12px;">
                            {{$order->value_added_tax}} ريال
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #44a0dd;background-color:#c7e3f5;width:60%;font-size:12px;">
                            المبلغ المدفوع
                        </td>
                        <td style="border:1px solid #44a0dd;width:40%;font-size:12px;">
                            {{$order->total_amount}} ريال
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr>
    <div class="text-center" style="text-align: center">منصة معاملة . كوم | منصة الخدمات الإلكترونية تجمع بين العملاء و مقدمي الخدمات<br>
    تطبيق الشروط و الأحكام /terms/com.muamlah.www<br>
    مؤسسة تعميد الإنجاز لتقنية المعلومات / مكة المكرمة - الرصيفة - شارع المنصورية - هاتف : ٠</div>
</div>

</body>