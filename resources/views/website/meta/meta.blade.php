@if(isset($options))
    @php
        $opt = array_merge([
            'title'       => null,
            'sub_title'   => null,
            'description' => null,
            'image' => null,
        ], $options);
    @endphp
    @section('htmlTag') @parent @endsection
    @section('pageMeta') 
        <title>{{ (!is_null($opt['title'])) ? $opt['title'] . (is_null($opt['sub_title']) ? '' : ' | ') : '' }}{{ $opt['sub_title'] }} </title>
        <meta name="description" content="{{ $opt['description'] }}">
        <meta name="image" content="{{ $opt['image'] }}"/>
       

        <link rel="canonical" href="{{Request::fullUrl()}}">

        @parent
    @endsection
@endif