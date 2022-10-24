@component('mail::message')
<div style="direction: rtl ;font-size: 16px; text-align:right;" >
السلام عليكم {{ $details['name'] }}
</div>
<br>
<br>
    <div style="direction: rtl ;font-size: 16px; text-align:right;" >
كود تفعيل حسابك على منصة معاملة: <b>{{ $details['code'] }}</b>
    </div>
<br>
<br>
<div style="direction: rtl ;font-size: 16px; text-align:right;" >
تنبيه : لا تشارك هذا الرمز مع اي شخص لحماية حسابك
</div>
<br>
<br>
<div style="direction: rtl ;font-size: 16px; text-align:right ;" >
شكراً
</div>
<div style="direction: rtl ;font-size: 16px; text-align:right;" >
{{ config('app.name') }}
</div>
@endcomponent
