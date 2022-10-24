@extends('website.layout')
@section('content')

  <!-- Page Content-->
  <div class="page-content header-clear-medium">
    <div class="card card-style bg-grey-c">
            <div class="content text-center">
                    <h1 class="mb-0 color-white">
                        {!! $page->title !!}
                    </h1>
                    <p class="mb-0 color-white font-12 bottom-10">تاريخ أخر تحديث:{!! \Carbon\Carbon::parse($page->updated_at)->format('Y-m-d') !!}</p>
            </div>
    </div>
    <div class="card card-style">
            <div class="content p-1">
                    <div class="elementor-text-editor elementor-clearfix">
                           {!! $page->details !!}
                    </div>
            </div>
    </div>
</div>
<!-- End of Page Content-->
@endsection