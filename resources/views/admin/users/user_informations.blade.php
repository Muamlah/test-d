@extends('admin.layouts.adminLayout')
@section('title') الاعضاء
@endsection

@section('style')
    <style>
        .transaction-table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        .transaction-table td, .transaction-table th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            text-align: right
        }
        .transaction-table tr:nth-child(even) {
            background-color: #dddddd;
        }
        #tab-invoice a h3 , #tab-invoice a p{
            color: #000
        }
        #tab-invoice a{
            padding: 0 20px
        }
        .color-green1-dark{
            color: #8CC152!important;
        }
        .color-red2-dark {
            color: #DA4453!important;
        }
        .color-blue2-dark {
            color: #4A89DC!important;
        }
        .font-14 {
            font-size: 14px!important;
        }
        .font-15 {
            font-size: 15px!important;
        }
        .font-16 {
            font-size: 16px!important;
        }
        .font-17 {
            font-size: 17px!important;
        }
        #bills .card{
            padding: 0 20px
        }
        .btn.btn-full.btn-l.rounded-l.font-800.text-uppercase.bg-green-c{
            width: 100%;
            background-image: linear-gradient(287deg ,#63d471 0%,#018c36 74%);
            padding: 10px !important;
            color: #fff;
        }
        .bg-green3-dark{
            background: #11a711;
            color: #fff;
            border-radius: 10px;
            margin: 20px;
            font-size: 14px;
            padding: 0px 10px !important;
        }
    </style>
@endsection
@section('content')

    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card card-custom">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0" style="font-weight: bold">معلومات العضو</h3>
                    </div>
                    @if($user->level == 'user')
                        <div class="card-toolbar">
                            <a class="btn btn-success mr-2" href="{{route('admin.indexUser')}}">
                                العملاء
                            </a>
                        </div>
                    @else
                        <div class="card-toolbar">
                            <a class="btn btn-success mr-2" href="{{route('admin.indexProvider')}}">
                                مقدمي الخدمات
                            </a>
                        </div>
                    @endif
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">الملف الشخصي</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">سجل الحركة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">الفواتير</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="balance-tab" data-toggle="tab" href="#balance" role="tab" aria-controls="balance" aria-selected="false">الأرصدة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">الحساب البنكي</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent" style="min-height: 300px;margin-top:30px">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">الاسم: </label>
                            <div class="col-lg-9 fv-row">
                                <span>{{$user->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">رقم الهاتف: </label>
                            <div class="col-lg-9 fv-row">
                                <span>{{$user->phone}}</span>
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">البريد الإلكتروني: </label>
                            <div class="col-lg-9 fv-row">
                                <span>{{$user->email}}</span>
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">نوع العضو: </label>
                            <div class="col-lg-9 fv-row">
                                @if($user->level == 'user')
                                    <span>عميل</span>
                                @else
                                    <span>مقدم خدمة</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">الحالة: </label>
                            <div class="col-lg-9 fv-row">
                                @if($user->status == 'active')
                                    <span>فعال</span>
                                @else
                                    <span>غير فعال</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">توثيق الهوية: </label>
                            <div class="col-lg-9 fv-row">
                                @if($user->verified == 1)
                                    <span>الهوية موثقة</span>
                                @else
                                    <span>الهوية غير موثقة</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">العنوان: </label>
                            <div class="col-lg-9 fv-row">
                                <span>{{$user->address}}</span>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 0 30px" class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card card-style">
                            <div class="content mb-0">
                                <div id="transactions">
                                    <table class="transaction-table">
                                        <tr>
                                            <th>العملية</th>
                                            <th>المقدار</th>
                                            <th>التاريخ</th>
                                        </tr>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->description}}</td>
                                                <td>
                                                    @if($item->type == 'deposit')
                                                        <span style="color: green">{{$item->amount}} ريال</span>
                                                    @else
                                                        <span style="color: red">{{$item->amount}} ريال</span>
                                                    @endif
                                                </td>
                                                <td>{{$item->created_at->format('d-m-Y')}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 0 20px" class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="tab-content" id="tab-invoice">
                            <div id="bills">
                                @include('website.wallet.ajax-view.bills')
                            </div>
                            <div class="content shadow-l mb-0">
                                @if($invoices->count()>5)
                                    <a data-page="2" data-link="{{route('user.seeMoreBills')}}"
                                       data-div="#bills" href="javascript:;"
                                       class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                        المزيد</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div style="padding: 0 30px" class="tab-pane fade" id="balance" role="tabpanel" aria-labelledby="balance-tab">
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">الرصيد الكلي: </label>
                            <div class="col-lg-9 fv-row">
                                <span>{{$user->total_balance}} ريال</span>
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">رصيد الطلبات: </label>
                            <div class="col-lg-9 fv-row">
                                <span>{{$user->pinding_balance}} ريال</span>
                            </div>
                        </div>
                        <div class="row mb-6" style="padding: 0 30px">
                            <label style="font-weight: bold" class="col-lg-3">الرصيد المتاح: </label>
                            <div class="col-lg-9 fv-row">
                                <span>{{$user->available_balance}} ريال</span>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 0 30px" class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                        @if(!empty($user->creditCard))
                            <div class="row mb-6" style="padding: 0 30px">
                                <label style="font-weight: bold" class="col-lg-3">اسم البنك: </label>
                                <div class="col-lg-9 fv-row">
                                    <span>{{$user->creditCard->bank_name}}</span>
                                </div>
                            </div>
                            <div class="row mb-6" style="padding: 0 30px">
                                <label style="font-weight: bold" class="col-lg-3">اسم صاحب الحساب: </label>
                                <div class="col-lg-9 fv-row">
                                    <span>{{$user->creditCard->name}}</span>
                                </div>
                            </div>
                            <div class="row mb-6" style="padding: 0 30px">
                                <label style="font-weight: bold" class="col-lg-3">آيبان: </label>
                                <div class="col-lg-9 fv-row">
                                    <span>{{$user->creditCard->account_number}}</span>
                                </div>
                            </div>
                            <div class="row mb-6" style="padding: 0 30px">
                                <label style="font-weight: bold" class="col-lg-3">رقم الحساب: </label>
                                <div class="col-lg-9 fv-row">
                                    <span>{{$user->creditCard->number}}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.see-more').click(function() {
           let div = $($(this).data('div')); //div to append
           let link = $(this).data('link'); //current URL
           let page = $(this).data('page'); //get the next page #
           let thisSeeMore =$(this);
           console.log(page);
           let href = link + '?page='+ page; //complete URL
           $.ajax(
               {
                   url:   href,
                   data: {

                   },
                   type: "get",
                   beforeSend: function()
                   {
                       thisSeeMore.html('جاري التحميل....');
                   }
               })
               .done(function(data)
               {
                   if(data.html == ""){
                       thisSeeMore.html('لا يوجد المزيد');
                       thisSeeMore.hide(1000);
                       return;
                   }
                   thisSeeMore.data('page',page + 1); //update page #
                   $(data.html).hide().appendTo(div).show(1000);
                   thisSeeMore.html('المزيد');
               })
               .fail(function(jqXHR, ajaxOptions, thrownError)
               {
                   alert('الرجاء المحاولة مرة اخرى');
               });
        });
    </script>
@endsection
