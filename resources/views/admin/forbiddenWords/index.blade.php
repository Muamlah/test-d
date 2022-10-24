@extends('admin.layouts.adminLayout')
@section('title')
    قائمة الكلمات الممنوعة
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' الإعدادات',
        'link1'         => 'javascript:;',
        'title2'        => ' الكلمات الممنوعة',
        'link2'         => route('admin.forbidden_words.index'),

    ])
@endsection

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            الاعدادات
        </li>
        <li class="breadcrumb-item text-muted">
            قائمة الكلمات الممنوعة
        </li>
    </ul>
@endsection
@section('content')
    <div class="card card-custom" style="padding: 20px;margin-bottom:30px">
        <div class="accordion accordion-toggle-arrow" id="accordionExample1">
            <div class="card">
                <div class="card-header">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false">
                        بحث متقدم
                    </div>
                </div>
                <div id="collapseOne1" class="collapse" data-parent="#accordionExample1" style="">
                    <div class="card-body">

                        <div class="row align-items-center">

                            <div class="col-md-4 my-2 my-md-0">
                                <div class="form-group">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="اكتب للبحث" id="kt_datatable_search_query" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">قائمة الكلمات الممنوعة </h3>
            </div>
            <div class="card-toolbar">

                <a class="btn btn-primary"  href="{{route('admin.forbidden_words.create')}}" >
                    <i class="flaticon2-plus"></i>اضافة</a>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">

            <div class="datatable datatable-bordered datatable-head-custom" id="kt-forbidden-word"></div>
            <!--end: Datatable-->
        </div>
    </div>


@endsection
@section('script')
    <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/forbidden-word.js') }}"></script>
{{--    <script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>--}}
{{--    <script src="{{ asset('admin-file/assets/js/pages/crud/forms/validation/e-services-form-controls.js') }}"></script>--}}
{{--    <script src="{{ asset('admin-file/assets/js/pages/crud/file-upload/image-input.js') }}"></script>--}}

    <script>
        function action_delete(id){

            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax(
                {
                    url: HOST_URL +'/admin/forbidden_words/'+id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (){
                        alert('تم الحذف بنجاخ')

                    },
                    error:function (){
                        console.log('error');

                    }
                });
        }
    </script>
@endsection
