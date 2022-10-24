@component('mail::message')
    <div style="direction: rtl ;font-size: 16px; text-align:right;">
        السلام عليكم {{ $details['name'] }}
    </div>
    <br>
    <br>
    <div style="direction: rtl ;font-size: 16px; text-align:right;">
        تم اعادة تعين كلمة المرور بنجاح
    </div>
    <br>
    <br>
    <div style="direction: rtl ;font-size: 16px; text-align:right;">
        اسم المستخدمة: <b>{{ $details['userName'] }}</b>
    </div>
    <div style="direction: rtl ;font-size: 16px; text-align:right;">
        كلمة المرور: <b>{{ $details['password'] }}</b>
    </div>
    <br>
    <br>
    <div style="direction: rtl ;font-size: 16px; text-align:right;">
        رابط المنصة <a href="{{ config('app.url') }}">{{ config('app.url') }}</a> نسعد بخدمتكم على مدار ٢٤ ساعة
    </div>
    <br>
    <br>
    <div style="direction: rtl ;font-size: 16px; text-align:right ;">
        شكراً
    </div>
    <div style="direction: rtl ;font-size: 16px; text-align:right;">
        {{ config('app.name') }}
    </div>
@endcomponent
