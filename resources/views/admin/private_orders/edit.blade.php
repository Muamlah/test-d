@extends('admin.layouts.adminLayout')
@section('title')تعديل طلب التعميد الخاص  رقم {{$order->id}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            ادارة الطلبات
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.private_orders')}}" class="text-muted">قائمة طلبات التعميد الخاص</a>
        </li>
        <li class="breadcrumb-item text-muted">
            تعديل طلب التعميد الخاص  رقم {{$order->id}}
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات التعميد الخاص',
        'link1'         => route('admin.private_orders'),
        'title2'        => 'تعديل طلب تعميد خاص',
        'link2'         => 'javascript:;',

    ])
@endsection


@section('content')
    
    @if(session()->has('success'))
        <h2 style="color:green; text-align:center;"> {{Session::get('success')}} </h2>
        <br>
    @endif
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <div class="card-title">
                        <h3 class="fw-bolder">تعديل طلب التعميد الخاص  رقم {{$order->id}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a class="btn btn-success mr-2" href="{{route('admin.private_orders')}}">
                            طلبات التعميد الخاص
                        </a>
                    </div>
                </div>
                <!--begin::Form-->
                <div id="kt_account_profile_details" class="collapse show">
                    <form method="post" action="{{url('admin/private_orders/').'/'.$order->id}}" enctype="multipart/form-data" class="form" >
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="exampleSelectl">حالة الطلب</label>
                                    <select name="status_id"  class="form-control form-control-lg" id="exampleSelectl">

                                        @foreach($status as $item)
                                            <option @if($item->id == $order->status_id) {{'selected'}} @endif  value="{{$item->id}}"> {{$item->name}}</option>
                                        @endforeach



                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label>السعر:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$order->price}}" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>رقم العميل:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$order->user_phone}}" disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>رقم مقدم الخدمة:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$order->service_provider_phone}}"  disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>تاريخ الطلب :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$order->created_at}}"  disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>تاريخ الانتهاء :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$order->deadline}}"  disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label> تفاصيل الصفقة:</label>
                                    <div class="input-group">

                                        <textarea class="form-control" id="exampleTextarea" rows="3" disabled>{{$order->details}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- begin: Example Code-->
                            <!-- end: Example Code-->
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="submit" class="btn btn-primary mr-2">حفظ التغييرات</button>
                                    {{--                            <button type="reset" class="btn btn-secondary">Cancel</button>--}}
                                
                        </div>
                    </form>
                </div>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>

@endsection
