@extends('admin.layouts.adminLayout') @section('title') قائمة عمليات النظام @endsection @section('content')
<div class="post fs-base d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container">
        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">قائمة بعمليات النظام</span>
                        </h3> </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-150px">#</th>
                                    <th class="min-w-120px">التاريخ والوقت</th>
                                    <th class="min-w-120px">رقم العميل</th>
                                    <th class="min-w-120px">التفاصيل</th>
                                    <th class="min-w-140px">المبلغ</th>
                                    <th class="min-w-120px">نوع العملية</th>

                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach($transactions as $r)
                                <tr>
                                    <td> {{$r->id}} </td>
                                    <td> {{$r->created_at}} </td>

                                    <td> {{$r->user->phone}} </td>


                                    <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$r->description}}</a> </td>

                                    <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$r->amount}} ريال </a> </td>
                                    <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$r->amount}} ريال </a> </td>

                                    <td>

                                 <?php
                                if($r->type == "withdrawal") { ?>
                                <span class="badge badge-light-danger" style="font-weight: bolder;">
                                سحب
                                </span>
                                <?php } ?>

                                <?php if($r->type == "deposit") { ?>
                                <span class="badge badge-light-success" style="font-weight: bolder;">
                                ايداع
                                </span>
                                <?php } ?>

                                 </td>


                                </tr> @endforeach </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
</div> @endsection
