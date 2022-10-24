@extends('website.layout')
@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">دليل استخدام العميل</h1>
            </div>
        </div>
        <div class="card card-style">
            <div class="content text-center">
                <h2>التسجيل على الموقع</h2>
                <p>1- الضغط على زر تسجيل جديد على الصفحة الرئيسية</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/home.png")}}" alt=""></div>
                <p>2- التسجيل على قسم تسجيل جديد عميل وملأ جميع البيانات المطلوبة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/customer-login.png")}}" alt=""></div>
                <h2>طريقة طلب الخدمات الالكترونية</h2>
                <p>1- الذهاب إلى صفحة الخدمات</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/eservice-guide.png")}}" alt=""></div>
                <p>2- أطلب الخدمة المناسبة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/eservice-guide-2.png")}}" alt=""></div>
                <p>3- قم بإدخال تفاصيل الطلب ثم إضغط على زر أطلب الخدمة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/eservice-guide-3.png")}}" alt=""></div>
                <p>5- سوف يتم توجيه العميل إلى صفحة الدفع</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/payment-guide.png")}}" alt=""></div>
                <p>6- بعد الدفع سيتم إضافة المبلغ إلى رصيدك على المحفظة وبعد تأكيد إستلام الطلب سوف يتم خصم المبلغ
                    من الرصيد</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
                <p>7- بعد أن يتم قبول الطلب من طرف مقدم الخدمة سوف يتم فتح محادثة بين العميل و مقدم الخدمة على
                    المحادثة الخاصة بمنصة معاملة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/chat.png")}}" alt=""></div>
                <p>8- لتتبع حالة الطلب إضغط على زر طلباتي في صفحة الإعدادات</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/setting-guide.png")}}" alt=""></div>
                <p>9- على صفحة طلباتي قسم الخدمات الإلكترونية يمكنك تتبع حالات طلبات الخدمات الإلكترونية التي قمت
                    بطلبها</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/myorder-guide.png")}}" alt=""></div>
                <p>10- عندما يقوم مقدم الخدمة بإنجاز الطلب و تسليمه سوف يتم إرسال تنبيه لتأكيد إستلام الطلب على صفحة
                    الطلب</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/eservice-status-guide.png")}}" alt=""></div>
                <h2>طريقة طلب التعميد الخاص</h2>
                <p>1- الذهاب إلى صفحة التعميد</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/private-orders-guide.png")}}" alt=""></div>
                <p>2- على قسم طلب تعميد خاص قم بإدخال رقم جوال مقدم الخدمة و تفاصيل الطلب ثم إضغط على زر إرسال
                    الطلب، سوف يتم إرسال رسالة نصية لمقدم الخدمة على رقم الجوال
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/private-orders-guide-2.png")}}" alt=""></div>
                <p>3- بعد قبول تنفيد طلب التعميد من طرف مقدم الخدمة و الإتفاق على قيمة التعميد سوف يتم توجيه العميل
                    إلى صفحة الدفع
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/payment-guide.png")}}" alt=""></div>
                <p>4- بعد إتمام عملية الدفع سوف يتم فتح محادثة بين العميل و مقدم الخدمة على المحادثة الخاصة بمنصة
                    معاملة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/chat.png")}}" alt=""></div>
                <p>5- لتتبع حالة الطلب إضغط على زر طلباتي في صفحة الإعدادات</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/setting-guide.png")}}" alt=""></div>
                <p>6- على صفحة طلباتي قسم طلبات التعميد يمكنك تتبع حالات طلبات التعميد الخاص التي قمت
                    بطلبها</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/page-order-guide.png")}}" alt=""></div>
                <p>7- عندما يقوم مقدم الخدمة بإنجاز الطلب و تسليمه سوف يتم إرسال تنبيه لتأكيد إستلام الطلب على صفحة
                    الطلب</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/eservice-status-guide.png")}}" alt=""></div>
                <p>8- بعد تأكيد إستلام الطلب من طرف العميل سوف يتم خصم المبلغ من رصيد العميل على المحفظة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
                <h2>طريقة طلب التعميد العام</h2>
                <p>1- الذهاب إلى صفحة التعميد</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/public-order-guide.png")}}" alt=""></div>
                <p>2- على قسم طلب تعميد عام قم بإدخال تفاصيل الطلب ثم إضغط على زر إرسال
                    الطلب
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/public-order.png")}}" alt=""></div>
                <p>3- سوف يتم إضافة طلب التعميد على صفحة الطلبات لإستقبال عروض مقدمي الخدمات
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/orders-page.png")}}" alt=""></div>
                <p>4- يمكنك الإطلاع على العروض التي تم تقديمها على صفحة الطلب و قبول العرض المناسب
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/public-order-guide-2.png")}}" alt=""></div>
                <p>5- بعد أن يتم قبول العرض المناسب سوف يتم توجيه العميل إلى صفحة الدفع
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/payment-guide.png")}}" alt=""></div>
                <p>6- بعد إتمام عملية الدفع سوف يتم فتح محادثة بين العميل و مقدم الخدمة على المحادثة الخاصة بمنصة
                    معاملة
                </p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/chat.png")}}" alt=""></div>
                <p>7- لتتبع حالة الطلب إضغط على زر طلباتي في صفحة الإعدادات</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/setting-guide.png")}}" alt=""></div>
                <p>8- على صفحة طلباتي قسم طلبات التعميد يمكنك تتبع حالات طلبات التعميد العام التي قمت
                    بطلبها</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/page-order-guide.png")}}" alt=""></div>
                <p>9- عندما يقوم مقدم الخدمة بإنجاز الطلب و تسليمه سوف يتم إرسال تنبيه لتأكيد إستلام الطلب على صفحة
                    الطلب</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/eservice-status-guide.png")}}" alt=""></div>
                <p>10- بعد تأكيد إستلام الطلب من طرف العميل سوف يتم خصم المبلغ من رصيد العميل على المحفظة</p>
                <div class="guide-img mt-3 mb-5"><img src="{{asset("/template-muamlah/images/guide/wallet-guide-2.png")}}" alt=""></div>
            </div>
        </div>
    </div>
    <!-- End of Page Content-->

@endsection
