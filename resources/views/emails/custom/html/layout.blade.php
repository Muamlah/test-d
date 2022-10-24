<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset("template-muamlah/styles/1.css")}}"> --}}
    @include('emails.custom.html.css')
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

    </style>
</head>
<body>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="header">
                            <a href="{{\Request::getHost()}}" style="display: inline-block;">
                                <img class="logo" src="{{asset("/template-muamlah/images/logo.png")}}">
                            </a>
                            <h4>منصة معاملة . كوم</h4>
                            <p class="rtl-direction">
                                منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية .
                            </p>
                            <p class="rtl-direction">
                                <span style="font-weight: bold">منصة معاملة . كوم</span>
                                    تعمل بنظام P2P كمنصة في مجال الاقتصاد التشاركي . .
                            </p>
                        </td>
                    </tr>
                        
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td class="content-cell">
                                        <h1 class="text-right">عزيزي المشرف</h1>
                                        <p class="text-right">{{$message1}}</p>
                                        <p class="text-right">{{$message2}}</p>
                                        <p class="text-right">شكراً لك.. مع أطيب التحيات</p>
                                        <h1 class="rtl-direction">Muamlah</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td class="content-cell" align="center">
                                        © 2021 Muamlah. All rights reserved.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
