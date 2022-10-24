@extends('website.layout')
@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">دليل استخدام مقدم الخدمة</h1>
            </div>
        </div>
        <div class="card card-style">
            <div class="content text-center">
                <h2>التسجيل على الموقع</h2>
                <p>1- الضغط على زر تسجيل جديد على الصفحة الرئيسية</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/home.png")}}" alt=""></div>
                <p>2- التسجيل على قسم تسجيل جديد مقدم الخدمة إدخال جميع البيانات المطلوبة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/supervisor-login.png")}}" alt=""></div>
                <h2>طريقة تنفيد الخدمات الالكترونية</h2>
                <p>1- الذهاب إلى صفحة الطلبات قسم الخدمات الإلكترونية ثم إختيار الخدمة المناسبة لإنجازها و الضغط على
                    زر قبول
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/ordes-guide.png")}}" alt=""></div>
                <p>2- يتم إضافة مبلغ الخدمة الإلكترونية التي سيتم تنفيذها إلى الرصيد المعلق على محفظة مقدم الخدمة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
                <p>3- سوف يتم فتح محادثة بين العميل و مقدم الخدمة على
                    المحادثة الخاصة بمنصة معاملة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/chat.png")}}" alt=""></div>
                <p>4- جميع الخدمات التي يقوم بإنجازها مقدم الخدمة موجودة على صفحة خدماتي</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/myservices-guide.png")}}" alt=""></div>
                <p>5- يمكن لمقدم الخدمة تغيير حالة الطلب على حسب خطوات الإنجاز في صفحة الخدمة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/service_s.png")}}" alt=""></div>
                <p>6- بعد أن يتم إنجاز الخدمة و تأكيد الإستلام من العميل يتم تحويل المبلغ من الرصيد المعلق إلى
                    الرصيد المتاح
                    لسحب
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
                <h2>طريقة تنفيد طلب التعميد الخاص</h2>
                <p>1- عندما يقوم العميل بإرسال طلب تعميد خاص بواسطة رقم جوال مقدم الخدمة يتم إرسال تنبيه إلى مقدم
                    الخدمة لعرض الطلب على صفحة خدماتي</p>
                <div class="guide-img mt-3 mb-5">
                    <img src="{{asset("/template-muamlah/images/guide/myservices.png")}}" alt="">
                </div>
                <p>2- بعد أن يتم الإتفاق بين مقدم الخدمة و العميل سيتم إضافة مبلغ الخدمة إلى
                    الرصيد المعلق على محفظة مقدم الخدمة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
                <p>3- سيتم فتح محادثة بين مقدم الخدمة و العميل على
                    المحادثة الخاصة بمنصة معاملة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/chat.png")}}" alt=""></div>
                <p>4- يمكن لمقدم الخدمة تغيير حالة الطلب على حسب خطوات الإنجاز في صفحة الخدمة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/service_s.png")}}" alt=""></div>
                <p>5- بعد أن يتم إنجاز الخدمة و تأكيد الإستلام من العميل يتم تحويل المبلغ من الرصيد المعلق إلى
                    الرصيد المتاح
                    لسحب
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
                <h2>طريقة تنفيذ التعميد العام</h2>
                <p>1- الذهاب إلى صفحة الطلبات قسم طلبات عامة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/orders-page.png")}}" alt=""></div>
                <p>2- يقوم مقدم الخدمة بإضافة عرض على الطلب المناسب
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/supp_order.png")}}" alt=""></div>
                <p>3- بعد أن يتم الإتفاق بين مقدم الخدمة و العميل سيتم إضافة مبلغ الخدمة إلى
                    الرصيد المعلق على محفظة مقدم الخدمة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
                <p>4- سيتم فتح محادثة بين مقدم الخدمة و العميل على
                    المحادثة الخاصة بمنصة معاملة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/chat.png")}}" alt=""></div>
                <p>5- يمكن لمقدم الخدمة تغيير حالة الطلب على حسب خطوات الإنجاز في صفحة الخدمة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/service_s.png")}}" alt=""></div>
                <p>6- بعد أن يتم إنجاز الخدمة و تأكيد الإستلام من العميل يتم تحويل المبلغ من الرصيد المعلق إلى
                    الرصيد المتاح
                    لسحب
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
            </div>
        </div>
    </div>
    <!-- End of Page Content-->

@endsection
