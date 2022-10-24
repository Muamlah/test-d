@if(isset($options))
    @php
        $opt = array_merge([
            'title'       => null,
            'sub_title'   => null,
            'description' => null,
            'image'       => null,
            'type'        => 'article',
            'url'         => null,
        ], $options);
    @endphp
    @section('htmlTag') @parent @endsection
    @section('pageMeta') 
        @parent
        <meta property="og:title" content="{{ (!is_null($opt['title'])) ? $opt['title'] . (is_null($opt['sub_title']) ? '' : ' | ') : '' }}{{ $opt['sub_title'] }}" />
        <meta property="og:type" content="{{ $opt['type'] }}" />
        @if(!is_null($opt['url']))
            <meta property="og:url" content="{{ $opt['url'] }}" />
        @endif
        @if(!is_null($opt['image']))
            <meta property="og:image" content="{!! $opt['image'] !!}" />
        @endif
        @if(!is_null($opt['description']))
            <meta property="og:description" content="{!! $opt['description'] !!}" />
        @endif
    @endsection
@endif

