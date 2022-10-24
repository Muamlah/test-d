@extends('admin.layouts.adminLayout')
@section('title')تعديل طلب التعميد العام  رقم {{$order->id}}
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
            <a href="{{route('admin.public_orders')}}" class="text-muted">قائمة طلبات الخدمات الإلكترونية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            تعديل طلب خدمة  رقم {{$order->id}}
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات طلبات الخدمات الإلكترونية',
        'link1'         => route('admin.public_orders'),
        'title2'        => 'تعديل طلب خدمة',
        'link2'         => 'javascript:;',

    ])
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('success'))
                <h2 style="color:green; text-align:center;"> {{Session::get('success')}} </h2>
                <br>
            @endif
            @if(session()->has('error'))
                <h2 style="color:red; text-align:center;"> {{Session::get('error')}} </h2>
                <br>
            @endif
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <div class="card-title">
                        <h3 class="fw-bolder">تعديل طلب التعميد العام  رقم {{$order->id}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a class="btn btn-success mr-2" href="{{route('admin.public_orders')}}">
                            طلبات الخدمات الإلكترونية
                        </a>
                    </div>
                </div>
                <!--begin::Form-->
                <form method="post" action="{{url('admin/public_orders/'.$order->id.'/updateStatus')}}" enctype="multipart/form-data" class="form" >
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="exampleSelectl">حالة الطلب</label>
                                <select name="status"  class="form-control form-control-lg" id="exampleSelectl">
                                    @foreach($status as $item)
                                        <option @if($item->id == $order->status) {{'selected'}} @endif  value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach


                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>السعر:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{@$order->price}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>رقم العميل:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{@$order->user->phone}}" disabled/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>رقم مقدم الخدمة:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{@$order->provider->phone}}"  disabled />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>تاريخ الطلب :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{@$order->created_at}}"  disabled />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>تاريخ الانتهاء :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{@$order->deadline}}"  disabled />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label> عنوان الطلب:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{@$order->title}}"  disabled />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label> تفاصيل الطلب:</label>
                                <div class="input-group">

                                    <textarea class="form-control" id="exampleTextarea" rows="3" disabled>{{@$order->details}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- begin: Example Code-->
                        <!-- end: Example Code-->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary mr-2">حفظ التغييرات</button>
                            </div>

                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>

@endsection
