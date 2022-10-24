<html lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>منصة معاملة . كوم</title>
    <link rel="stylesheet" type="text/css" href="{{asset('template-muamlah/styles/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template-muamlah/styles//style.css')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logo.png">
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
</head>

<body>
    <div class="container bg-white">
        <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
            style="border:1px solid #fff;background-color:#fff;color:#000;width:100%;margin:auto;height:85px;">
            <tr>
                <td style="width:100%;">
                    <div style="text-align:center;font-size:22px;color:#2d7335;font-weight:900;">
                        فاتورة
                    </div>
                </td>
            </tr>
        </table>
        <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
            style="margin:0px;height:200px;width:100%;margin:auto;font-size:18px;border:1px solid #fff;background-color:#fff;color:#000;">
            <tr>
                <td style="width:50%;text-align:center;color:#000;font-weight: 900;">
                    <img src="https://app.muamlah.com/public/template-muamlah/images/logo.png" style="width:110px;" />
                    <span style="text-align: center;display: block;margin-top: 8px;">
                        منصة معاملة . كوم
                    </span>

                </td>
                <td style="width:50%;text-align:center;color: #000;">
                    مؤسسة تعميد الإنجاز
                    لتقنية المعلومات<br />سجل تجاري 4031209968<br />الرقم الضريبي
                    310111504600003<br />مكة المكرمة
                </td>
            </tr>
        </table>

        <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
            style="border:1px solid #fff;background-color:#fff;color:#000;padding:0px;width:100%;margin:auto;font-size:16px;">
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    كود الفاتورة
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {{$order->invoice_code}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    حالة الطلب
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    تم التسليم
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    رقم الطلب
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    #{{$order->id}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    مقدم الخدمة
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {!! $order->provider->getFirstName()  !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    طالب الخدمة
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {!! $order->user->getFirstName() !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    التاريخ
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {!! $order->created_at !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:125px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td style="border-bottom: 1px solid #0000000d;width:100%;text-align:right;">
                                    تفاصيل التعميد<br>
                                    {!! $order->details !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    قيمة التعميد
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {{$order->price}} ريال
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    رسوم التعميد
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {{$order->fees}} ريال
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    ضريبة القيمة المضافة
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {{$order->value_added_tax}} ريال
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    الإجمالي
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0000000d;background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {{$order->total_amount}} ريال
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <table dir="rtl" valign="middle" border="0" cellpadding="4" cellspacing="0"
                        style="font-weight:700;margin:0px;height:50px;width:80%;margin: auto;font-size:14px;">
                        <tbody>
                            <tr>
                                <td style="background-color:#fff;width: 50%;font-size:16px;text-align: right;">
                                    المبلغ المدفوع
                                </td>
                                <td style="background-color:#fff;width: 50%;font-size:16px;text-align: left;">
                                    {{$order->total_amount}} ريال
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <img class="qrcode border mx-auto polaroid-effect" src="https://api.qrserver.com/v1/create-qr-code?data={{$share_link}}&size=200x200">
        <div class="text-center" style="width:100%;margin:auto;padding:22px 0;font-size:13px;background:#fff;">
            <hr style="margin: auto;width: 90%;">
            منصة معاملة . كوم | منصة الخدمات الإلكترونية تجمع بين العملاء و مقدمي الخدمات<br>
            تطبيق الشروط و الأحكام <span>https://app.muamlah.com/terms</span><br>
            مؤسسة تعميد الإنجاز لتقنية المعلومات / مكة المكرمة - الرصيفة - شارع المنصورية - هاتف : ٠
        </div>
    </div>

    <script>

    </script>
</body>

