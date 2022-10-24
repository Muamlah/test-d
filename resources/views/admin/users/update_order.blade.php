@extends('admin.layouts.adminLayout')
@section('title')تعديل الطلب الخاص بالمستخدم
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' مستخدمين أصحاب رصيد خاطئ',
        'link1'         => 'javascript:;',
        'title2'        => ' تعديل الطلب الخاص بالمستخدم',
        'link2'         => route('admin.indexWrongUser'),

    ])
@endsection

@section('content')

    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">تعديل الطلب الخاص بالمستخدم </div>
                </div>
                <form method="post" action="{{route('admin.users.updateOrderPost',['id'=>$user->id])}}" class="form" role="form" id="kt_project_settings_form">
                    {{ csrf_field() }}

                    @if(session()->has('success'))
                        <h3 style="color:green; text-align:center;"> تم التحديث بنجاح </h3>
                        <br>
                    @endif
                    @if(session()->has('error'))
                        <h3 style="color:red; text-align:center;"> {{\session()->get('error')}} </h3>
                        <br>
                    @endif

                    <div class="card-body p-9">
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3"> الرصيد الكلي</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$user->total_balance }}" name="total_balance" class="form-control form-control-solid">
                            </div>

                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">الرصيد المتاح</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$user->available_balance }}" name="available_balance" class="form-control form-control-solid">
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">الرصيد قيد الإنتظار</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$user->pinding_balance }}" name="pinding_balance" class="form-control form-control-solid">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_project_settings_submit">حفظ</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
<style>
    .filter-option-inner-inner{
        text-align: right
    }
</style>
@endsection