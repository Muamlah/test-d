@if(isset($options))
    @php
        $opt = array_merge([
            'title'       => null,
            'sub_title'   => null,
            'description' => null,
            'image'       => null,
            'type'        => 'summary_large_image',
            'url'         => null,
        ], $options);
    @endphp
    @section('htmlTag') @parent @endsection
    @section('pageMeta') 
        @parent
        <meta name="twitter:card" content="{{ $opt['type'] }}">
        <meta name="twitter:title" content="{{ (!is_null($opt['title'])) ? $opt['title'] . (is_null($opt['sub_title']) ? '' : ' | ') : '' }}{{ $opt['sub_title'] }}">
        @if(!is_null($opt['description']))
            <meta name="twitter:description" content="{!! Str::limit($opt['description'], 500, '...') !!}">
        @endif
        {{-- <-- Twitter Summary card images must be at least 120x120px --> --}}
        @if(!is_null($opt['image']))
            <meta name="twitter:image" content="{!! $opt['image'] !!}">
            <meta name="twitter:image:src" content="{!! $opt['image'] !!}">
            <meta name="twitter:image:alt" content="{!! $opt['title'] !!}">
        @endif
    @endsection
@endif