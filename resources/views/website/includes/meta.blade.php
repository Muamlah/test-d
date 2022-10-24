@if(!isset($meta_title))
    @php $meta_title = "منصة معاملة . كوم" @endphp
@endif
@if(!isset($meta_description))
    @php $meta_description = "منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية ." @endphp
@endif
@if(!isset($meta_image))
    @php $meta_image = asset("/template-muamlah/images/logo.png") @endphp
@endif
    <meta name="title" content="{{$meta_title}}">
    <meta name="description" content="{{$meta_description}}">

{{-- facebook meta --}}
    <meta property="og:image" content="{{$meta_image}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{request()->url()}}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content=" {{$meta_description}}" />
<meta property="fb:app_id" content="" />

{{-- twitter meta --}}
    <meta name="twitter:title" content="{{$meta_title}}" />
    <meta name="twitter:description" content="{{$meta_description}}" />
    <meta name="twitter:image" content="{{$meta_image}}" />
    <meta name="twitter:image:src" content="{{$meta_image}}" />
