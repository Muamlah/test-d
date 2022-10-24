@if(isset($options))
    @php
        $opt = array_merge([
            'title'       => null,
            'sub_title'   => null,
            'description' => null,
            'keywords'    => null,
            'image'       => null,
            'type'        => 'website',
            'url'         => null,
        ], $options);
    @endphp
    @section('htmlTag') @parent @endsection
    @section('pageMeta')
        @parent
        <meta property="og:type" content="website" />

        <meta property="og:title" content="{{ (!is_null($opt['title'])) ? $opt['title'] . (is_null($opt['sub_title']) ? '' : ' | ') : '' }}{{ $opt['sub_title'] }}" />
        @if(!is_null($opt['url']))
            <meta property="og:url" content="{{ $opt['url'] }}" />
        @endif
        @if(!is_null($opt['image']))
            <meta property="og:image" content="{!! $opt['image'] !!}" />
        @endif
        @if(!is_null($opt['description']))
            <meta property="og:description" content="{!! $opt['description'] !!}" />
        @endif
        @if(!is_null($opt['keywords']))
            <meta property="og:keywords" content="{!! $opt['keywords'] !!}" />
        @endif
        <meta property="og:image:width" content="450"/>
        <meta property="og:image:height" content="298"/>
    @endsection
@endif

