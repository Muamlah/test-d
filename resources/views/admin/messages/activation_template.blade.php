@component('mail::message')
    {{ $details['title'] }}

    {{ $details['body'] }}
    شكراً,
    {{ config('app.name') }}
@endcomponent
