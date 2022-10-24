<!DOCTYPE HTML>
<html dir="rtl" lang="ar">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية | منصة معاملة </title>
    @yield('pageMeta')
    <link rel='stylesheet' id='wp-block-library-rtl-css' href='muamlah-main/assets/css/style-rtl.min41a3.css' media='all'/>
    <link rel='stylesheet' id='contact-form-7-css' href='muamlah-main/assets/css/styles9dff.css' media='all'/>
    <link rel='stylesheet' id='contact-form-7-rtl-css' href='muamlah-main/assets/css/styles-rtl9dff.css' media='all'/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel='stylesheet' id='wpml-legacy-dropdown-0-css' href='muamlah-main/assets/css/style68b3.css' media='all'/>
    <link rel='stylesheet' id='parent-style-css' href='muamlah-main/assets/css/style41a3.css?ver=5.1' media='all'/>
    <link rel='stylesheet' id='style-rtl-css' href='muamlah-main/assets/css/style-rtl41a3.css?ver=5.1' media='all'/>
    <link rel='stylesheet' id='arabic-css' href='muamlah-main/assets/css/twentytwenty/assets/fonts/arabic41a3.css?ver=5.8'
          media='all'/>
    <link rel='stylesheet' id='normalize-css' href='muamlah-main/assets/css/normalize41a3.css?ver=5.8' media='all'/>
    <link rel='stylesheet' id='components-css' href='muamlah-main/assets/css/components41a3.css?ver=5.8' media='all'/>
    <link rel='stylesheet' id='marn-12-css' href='muamlah-main/assets/css/faal-1241a3.css?ver=5.2' media='all'/>
    <script src='muamlah-main/assets/js/jquery.minaf6c.js' id='jquery-core-js'></script>
    <script src='muamlah-main/assets/js/jquery-migrate.mind617.js' id='jquery-migrate-js'></script>
    <script src='muamlah-main/assets/js/script68b3.js' id='wpml-legacy-dropdown-0-js'></script>
    <script src='muamlah-main/assets/js/index8a54.js?ver=1.0.0' id='twentytwenty-js-js' async></script>
    <link rel="alternate" type="application/json" href="wp-json/wp/v2/pages/9.json"/>
    <link rel="icon" href="./muamlah-main/assets/images/logo-muamlah.png" sizes="32x32"/>
    <link rel="icon" href="./muamlah-main/assets/images/logo-muamlah.png" sizes="192x192"/>
    <link rel="apple-touch-icon" href="./muamlah-main/assets/images/logo-muamlah.png"/>
    <link rel="stylesheet" href="./muamlah-main/assets/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="./muamlah-main/assets/js/all.js"></script>


    <!-- Faal Style -->
    <link rel="stylesheet" href="./muamlah-main/assets/css/main.css">
    <meta name="msapplication-TileImage" content="./muamlah-main/assets/images/logo-muamlah.png"/>
    <script src="./muamlah-main/assets/js/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({google: {families: ["Inconsolata:400,700", "Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic", "DM Sans:regular,italic,500,500italic,700,700italic", "Fira Code:regular,600,700", "Caveat:regular,700"]}});</script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .d-print-none.o_livechat_button.openerp {
            bottom: 83px;
        }
        .o_thread_window.o_in_home_menu{
            boo
        }
    </style>
</head>


<body class="rtl home page-template page-template-templates page-template-home-ar page-template-templateshome-ar-php page page-id-9 wp-embed-responsive is-twentytwenty Show Button singular enable-search-modal missing-post-thumbnail has-no-pagination not-showing-comments show-avatars home-ar footer-top-visible">
{!! settings()->iframe_google_analytics !!}

<div class="border-bottom shadow">
    <div class="container">
        <div class="navbar sticky w-nav">
            <div class="row">
                <div class="col-6 my-auto">
                    <a href="{{url('/')}}" aria-current="page" class="w-nav-brand w--current">
                        <img width="50" alt="Faal logo" data-src="./muamlah-main/assets/images/logo-muamlah.png"
                             class="lazyload w-30logo" src="./muamlah-main/assets/images/logo-muamlah.png">
                        <noscript>
                            <img src="./muamlah-main/assets/images/logo-muamlah.png" width="50" alt="Faal logo"></noscript>
                        <span class="fw-bolder align-middle">
                                                        منصة معاملة

                        </span>
                    </a>
                </div>
                <div class="col-6 my-auto text-start">

                    <a href="#" data-toast="notification-1"
                       class="header-icon header-icon-4 text-dark mx-2 mx-md-3 font-12"><i class="fas fa-bell"></i></a>
                    <a href="{{route('messages.index')}}"
                       class="header-icon header-icon-3 text-dark mx-2 mx-md-3 font-12"><i class="fas fa-envelope"></i></a>
                    <a href="{{route('user.profile')}}"
                       class="header-icon header-icon-2 text-dark mx-2 mx-md-3 font-12"><i class="fas fa-user"></i></a>
                    <a href="#" data-back-button="" class="header-icon header-icon-1 text-dark mx-2 mx-md-3 font-12"><i
                            class="fas fa-arrow-left"></i></a>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="stickynavbar">
    <div class="container">
        <div data-collapse="medium" data-animation="default" data-duration="400" role="banner"
             class="navbar sticky w-nav">
            <div class="row">
                <div class="col-6 my-auto ">
                    <a href="{{url('/')}}" aria-current="page" class="w-nav-brand w--current">
                        <img width="50" alt="Faal logo" data-src="./muamlah-main/assets/images/logo-muamlah.png"
                             class="lazyload w-30logo" src="./muamlah-main/assets/images/logo-muamlah.png">
                        <noscript>
                            <img src="./muamlah-main/assets/images/logo-muamlah.png" width="50" alt="Faal logo"></noscript>
                        <span class="fw-bolder align-middle">
                                                        منصة معاملة

                        </span>
                    </a>
                </div>
                <div class="col-6 my-auto text-start">
                    {{--                    <a href="#" data-toast="notification-1"--}}
                    {{--                       class="header-icon header-icon-4 text-dark mx-2 mx-md-3 font-12"><i class="fas fa-bell"></i></a>--}}
                    {{--                    <a href="https://app.muamlah.com/messages/index"--}}
                    {{--                       class="header-icon header-icon-3 text-dark mx-2 mx-md-3 font-12"><i class="fas fa-envelope"></i></a>--}}
                    {{--                    <a href="https://app.muamlah.com/user/profile"--}}
                    {{--                       class="header-icon header-icon-2 text-dark mx-2 mx-md-3 font-12"><i class="fas fa-user"></i></a>--}}
                    {{--                    <a href="#" data-back-button="" class="header-icon header-icon-1 text-dark mx-2 mx-md-3 font-12"><i--}}
                    {{--                            class="fas fa-arrow-left"></i></a>--}}

                </div>
            </div>


        </div>
    </div>
</div>
<div class="herosection">
    <div class="herocontentwrapper">
        <div class="herocontent">
            <div class="heroimage">
                <div class="background-video w-background-video w-background-video-atom mvi" style="background-image: url('muamlah-main/assets/images/first-DD.jpeg');
pointer-events: none;
width: 100%;
background-position: center;
background-size: 100%;
background-repeat: no-repeat;">
                    <div class="herovideoshadow"></div>
                </div>
            </div>
            <div class="container">
                <h1 class="herotitle">نساعد الشركات و رواد الأعمال من</h1>
                <div class="herotyped">
                    <div class="typed-words home"></div>
                </div>
                <div class="invesibledivider _24 hideonmobile"></div>

            </div>
        </div>
    </div>
</div>
<div class="solutionsbarsection">
    <div class="container">
        <div class="solutionsbarmargin">
            <div class="herobuttonsequalizer">
                <a href="#sec-1" class="herobutton left w-inline-block">
                    <div class="herobutton_textdev">
                        <h1 class="servicestabs">
                                    <span class="heading2span">
                                        <strong class="bold-text-2">
                                            الخدمات الإلكترونية<br>
                                        </strong>
                                    </span>
                            <!-- والمقاهي                         -->
                        </h1>
                    </div>
                </a>
                <div class="herobuttons_secondwrapper">
                    <a href="#pricing" class="herobutton center w-inline-block">
                        <div class="herobutton_textdev">
                            <h1 class="servicestabs">
                                        <span class="heading2span">
                                            <strong class="bold-text-2">
                                             الباقات<br></strong>
                                        </span>
                                <!-- والمحلات                         -->
                            </h1>
                        </div>
                    </a>
                    <a href="{{route('website.agent')}}" class="herobutton right w-inline-block">
                        <div class="herobuttonsfloatinglabel-copy">
                            جديد
                        </div>
                        <div class="herobutton_textdev">
                            <h1 class="servicestabs">
                                        <span class="heading2span">
                                            <strong class="bold-text-2">
                                            الوكلاء<br></strong>
                                        </span>
                                <!-- مع  معاملةى                               -->
                            </h1>
                        </div>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-body">
    <div>
        <div class="container pt-5" id="sec-1">
            <div class="row1 inverted mt-2">
                <div class="row1-col">
                    <h6 class="solution restaurants mb-2">نظام عصري، متقدم، سريع، وسهل الإستخدام.</h6>
                    <h3 class="h1">
                        ميزات لرواد الأعمال
                    </h3>
                    <div class="invesibledivider _8"></div>
                    <div class="invesibledivider _36"></div>

                    <div class="bullet-row maxed">
                        <div>
                            <img width="40" alt="icon" class="bullet-row-icons lazyload"
                                 src="muamlah-main/assets/images/icons/online.svg">
                            <h3 class="itemtext">سوق الخدمات online</h3>
                            <p class="paragraph greyish">
                                أكثر من 150 خدمة , حدد احتياجاتك من الخدمات الالكترونية و ادفع حسب الطلب فقط بأسعار
                                رمزية
                            </p>
                        </div>
                        <div>
                            <img width="40" alt="icon" class="bullet-row-icons lazyload"
                                 src="./muamlah-main/assets/images/icons/screen.svg">
                            <noscript>
                                <img src="./muamlah-main/assets/images/icons/screen.svg" width="40" alt="icon"
                                     class="bullet-row-icons"></noscript>
                            <h3 class="itemtext">
                                الخدمات المساندة
                            </h3>
                            <p class="paragraph greyish">
                                نتابع أحدث القرارات و ندرب مقدمي الخدمات
                                نحن على اطلاع كامل بكل تحديثات الجهات الحكومية التي تخص قطاع الأعمال .
                            </p>
                        </div>
                        <div><img width="40" alt="icon" class="bullet-row-icons lazyload"
                                  src="./muamlah-main/assets/images/icons/cloud.svg">
                            <noscript><img src="./muamlah-main/assets/images/icons/cloud.svg" width="40" alt="icon"
                                           class="bullet-row-icons"></noscript>
                            <h3 class="itemtext"> الأمان</h3>
                            <p class="paragraph greyish">
                                ادفع عند الإنجاز فقط , أو لا تدفع شيء أبدا استعد كافة مستحقاتك إذا لم ينجز مقدم الخدمة
                                طلبك على الوجه الأكمل
                            </p>
                        </div>
                        <div><img width="40" alt="icon" class="bullet-row-icons lazyload"
                                  src="./muamlah-main/assets/images/icons/phone.svg">
                            <noscript><img src="wp-content/uploads/2021/06/Asset-4.svg" width="40" alt="icon"
                                           class="bullet-row-icons"></noscript>
                            <h3 class="itemtext">التوافق</h3>
                            <p class="paragraph greyish">
                                توافق أعمالك مع المتطلبات الحكومية أصبح أمر حتمي يحتاج خبرات متعددة , لحسن الحظ نمارسها
                                يوميا
                            </p>
                        </div>
                    </div>
                    <div class="invesibledivider _8"></div>
                    <div class="invesibledivider _36"></div>
                    <a href="https://app.muamlah.com/eservices" class="button dark w-button">إكتشف المزيد</a>
                </div>
                <div class="row1-col photo">
                    <img loading="lazy" alt="" data-src="./muamlah-main/assets/images/logos.jpeg" class="lazyload"
                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                    <noscript><img src="wp-content/uploads/2021/06/1.png" loading="lazy" alt=""></noscript>
                </div>
            </div>
            <div class="invesibledivider _75"></div>
        </div>
    </div>
    <div>
        <div class="bg-point" style="padding: 50px 30px ; margin: 40px 0 ">
            <div class="container">
                <div data-elementor-type="section" data-elementor-id="1620" class="elementor elementor-1620">
                    <div class="elementor-inner">
                        <div class="elementor-section-wrap">
                            <section
                                class="elementor-section elementor-top-section elementor-element elementor-element-45b994f7 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="45b994f7" data-element_type="section"
                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-container elementor-column-gap-extended">
                                    <div class="elementor-row">
                                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-1c231122"
                                             data-id="1c231122" data-element_type="column">
                                            <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-element-2c74c415 elementor-widget elementor-widget-wpb-counter"
                                                         data-id="2c74c415" data-element_type="widget"
                                                         data-widget_type="wpb-counter.default">
                                                        <div class="elementor-widget-container">
                                                            <div id="wpb-counter-2c74c415" class="wpb-counter v-layout">

                                                                <div class="wpb-counter-icon"><i aria-hidden="true"
                                                                                                 class="fas fa-user"></i>
                                                                </div>


                                                                <div class="wpb-counter-number" data-endingnumber="1700"
                                                                     data-animduration="1000" data-scrollanim="">
                                                                    <p>
                                                                        <span class="counter"
                                                                              data-count="40000">0</span>
                                                                    </p>
                                                                </div>


                                                                <div class="wpb-counter-title  counter-desc">عميل</div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-4d02509"
                                             data-id="4d02509" data-element_type="column">
                                            <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-element-a970946 elementor-widget elementor-widget-wpb-counter"
                                                         data-id="a970946" data-element_type="widget"
                                                         data-widget_type="wpb-counter.default">
                                                        <div class="elementor-widget-container">
                                                            <div id="wpb-counter-a970946" class="wpb-counter v-layout">

                                                                <div class="wpb-counter-icon icon-2"><i
                                                                        aria-hidden="true" class="far fa-building"></i>
                                                                </div>


                                                                <div class="wpb-counter-number" data-endingnumber="172"
                                                                     data-animduration="1250" data-scrollanim="">
                                                                    <p>
                                                                        <span class=" counter"
                                                                              data-count="7000">0</span>
                                                                    </p>
                                                                </div>


                                                                <div class="wpb-counter-title  counter-desc">منشأة</div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-7a5f92d3"
                                             data-id="7a5f92d3" data-element_type="column">
                                            <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-element-51e86676 elementor-widget elementor-widget-wpb-counter"
                                                         data-id="51e86676" data-element_type="widget"
                                                         data-widget_type="wpb-counter.default">
                                                        <div class="elementor-widget-container">
                                                            <div id="wpb-counter-51e86676" class="wpb-counter v-layout">

                                                                <div class="wpb-counter-icon icon-2"><i
                                                                        aria-hidden="true"
                                                                        class="fas fa-map-marked"></i></div>


                                                                <div class="wpb-counter-number " data-endingnumber="37"
                                                                     data-animduration="1500" data-scrollanim="">
                                                                    <p>
                                                                        <span class="counter"
                                                                              data-count="11000">0</span>
                                                                    </p>
                                                                </div>
                                                                <div class="wpb-counter-title counter-desc">مقدم خدمة
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-57d34050"
                                             data-id="57d34050" data-element_type="column">
                                            <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-element-24c6f6de elementor-widget elementor-widget-wpb-counter"
                                                         data-id="24c6f6de" data-element_type="widget"
                                                         data-widget_type="wpb-counter.default">
                                                        <div class="elementor-widget-container">
                                                            <div id="wpb-counter-24c6f6de" class="wpb-counter v-layout">

                                                                <div class="wpb-counter-icon icon-2"><i
                                                                        aria-hidden="true"
                                                                        class="fas fa-shopping-bag"></i></div>


                                                                <div class="wpb-counter-number" data-endingnumber="110"
                                                                     data-animduration="1750" data-scrollanim=""
                                                                     data-seperator="">
                                                                    <p>
                                                                        <span class=" counter "
                                                                              data-count="100000">0</span>
                                                                    </p></div>


                                                                <div class="wpb-counter-title counter-desc  ">طلب</div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container pt-5">
            <div class="row1 pt-4">
                <div class="row1-col photo">
                    <img loading="lazy" alt="" data-src="./muamlah-main/assets/images/map.png" width="85%" class="lazyload"
                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                    <noscript><img src="wp-content/uploads/2021/06/5.png" loading="lazy" alt=""></noscript>
                </div>
                <div class="row1-col">
                    <h6 class="solution restaurants mt-3">سريعة و آمنة</h6>
                    <div class="invesibledivider _8"></div>
                    <h1 class="h1">الوكيل الالكتروني المعتمد</h1>
                    <div>
                        <div class="invesibledivider _24"></div>
                        <div class="badge bordered">توكيل</div>
                        <div class="badge bordered">تفويض</div>
                        <div class="badge bordered">إدارة المعاملات</div>
                        <div class="badge bordered">مراجعة الجهات</div>

                        <div class="invesibledivider _24"></div>
                        <div class="maxed_paragraph">
                            <ul class="ps-0 pe-4">
                                <li class="mt-1 mb-2 text-muted">مراجعة الوكيل للجهات الحكومية</li>
                                <li class="mt-1 mb-2 text-muted">تفويض الوكيل بالتعاقد مع أي مقدم خدمة</li>
                                <li class="mt-1 mb-2 text-muted">إدارة الطلبات بالنيابة عن الشركة</li>
                                <li class="mt-1 mb-2 text-muted">للوكيل إدارة الفروع في جميع المدن .</li>
                                <li class="mt-1 mb-2 text-muted">للوكيل إدارة معاملات الشركة في أي مدينة بميزة بتوكيل
                                    الغير .
                                </li>
                            </ul>
                            <div class="d-flex w-100 mb-3 pe-3">
                                <img src="muamlah-main/assets/images/1631309614.jpg" width="40px" height="40px"
                                     class="contain mx-1 filter" alt="">
                                <img src="muamlah-main/assets/images/1631309687.jpg" width="40px" height="40px"
                                     class="contain mx-1 filter" alt="">
                                <img src="muamlah-main/assets/images/1631309731.jpg" width="40px" height="40px"
                                     class="contain mx-1 filter" alt="">
                                <img src="muamlah-main/assets/images/1631309786.jpg" width="40px" height="40px"
                                     class="contain mx-1 filter" alt="">
                                <img src="muamlah-main/assets/images/1631309828.jpg" width="40px" height="40px"
                                     class="contain mx-1 filter" alt="">
                                <img src="muamlah-main/assets/images/1631309861.jpg" width="40px" height="40px"
                                     class="contain mx-1 filter" alt="">
                                <img src="muamlah-main/assets/images/1631309906.jpg" width="40px" height="40px"
                                     class="contain mx-1 filter" alt="">
                            </div>

                        </div>
                    </div>
                    <a href="{{route('website.agent')}}" class="button dark w-button">حلول الأعمال من منصة معاملة</a>

                    <div class="invesibledivider _36"></div>
                </div>
            </div>
        </div>
        <!--                <div class="invesibledivider _75"></div>-->
    </div>
</div>
<div class="section">
    <div class="pricing pt-5" id="pricing">
        <div class="container pt-5">
            <div class="rowing-table2">
                <div class="w-100">
                    <h3 class="h2 pt-3">الباقات</h3>
                    <h3 class="h6 lh-base text-muted w-75 mx-auto">اختر الخدمة حسب الطلب من الأعلى أو اشترك في الباقة
                        الشهرية
                        جميع طلباتك قيد التنفيذ فقط اخترالباقة التي تناسب أعمالك وارسل طلبك ثم اترك لنا متابعة الطلب
                        والتنفيذ . .</h3>
                </div>
                <div class="parent grid-2">
                    <div class="col-12 h-100 wow bounceInUp" data-wow-duration="1.2s">
                        <div class="pricing-card h-100 text-right pricing-card-parent">
                            <div class="discount">
                                عرض محدود
                            </div>
                            <div class="pricing-name lh-base text-center">
                                <span class="h2 mb-0 fw-bolder">باقة رواد الأعمال</span>
                                <h5 class="edit-font "><span class="text-decoration-line-through h3 mb-0 edit-font">3000 ريال </span><span
                                        class=" mx-1 h3 mb-0 edit-font">- 50%</span></h5>
                                1500<span class="h3"> ريال </span>
                            </div>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                            إدارة خدمات وزارة الموارد البشرية
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>فتح ملف منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب ملف منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار رخصة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث بيانات منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم بلاغ تغيب</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد رخصة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>وثيقة العمل الحر</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل عامل بين الفروع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل خدمات وافد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>أجير - إعارة موظف مؤقت</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>توثيق عقد عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إنهاء عقد عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة زيارة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار شهادة السعودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل تابع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تغيير مهنة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء رخص العمل بغرض الخروج النهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار رخص العمل بغرض الخروج النهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                            إدارة خدمات وزارة التجارة
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>حجز اسم تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري رئيسي و تحول الفرع لرئيسي لمؤسسة لسعودي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار سجل تجاري فرعي لشركة مساهمة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار سجل تجاري للخليجيين</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>حجز إسم تجاري للخليجيين</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل ملكية سجل تجاري لشخص متوفي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحويل السجل من فرعي إلى رئيسي لمؤسسة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التحويل من شركة إلى مؤسسة رئيسي - فرعي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إيداع القوائم المالية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري لمؤسسة لشخص متوفي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري فرعي لشركة مساهمة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري رئيسي لفرع شركة خليجية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري رئيسي لشركة وطنية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري فرعي لشركة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري رئيسي لفرع شركة أجنبية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحويل شركة رئيسي إلى مؤسسة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد السجل التجاري لشركة مهنية أو مختلطة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل سجل تجاري لشركة مساهمة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                aria-expanded="false" aria-controls="flush-collapseThree">
                                            مدد
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingThree"
                                         data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع ملف حماية الأجور</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>توثيق عقد عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل حساب</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-4">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-4"
                                                aria-expanded="false" aria-controls="flush-collapse-4">
                                            إدارة خدمات التأمينات الاجتماعية
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-4" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-4" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار شهادة لمنشأة منتهية النشاط</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل ملكية المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تغير مدير حساب الفروع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل حساب تأمينات أون لاين لمنشأة مسجلة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إنهاء نشاط منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إدارة ملاك المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار شهادة منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث الأجور</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل بيانات المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل الكيان القانوني للمنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إدارة مشرفي المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل نوع المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-5">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-5"
                                                aria-expanded="false" aria-controls="flush-collapse-5">
                                            إدارة خدمات هيئة الزكاة و الدخل
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-5" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-5" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع إقرار ضريبي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل الإقرار الزكوي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التسجيل في الزكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم اعتراض</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب اعتراض على غرامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الإفراج عن عقد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع إقرار زكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل إقرار زكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب استخدام طريقة الخصم النسبي لضريبة المدخلات</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب استرداد أموال ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل مجموعة في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل الأشخاص المؤهلين للإسترداد في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل تفاصيل تسجيل ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب تغيير فترة تقديم الإقرارات</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب اعتراض على إعادة التقييم</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>الشهادة الفورية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل بيانات التسجيل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب إعادة طباعة شهادة ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الإفراج عن الضمان البنكي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>دفع الزكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل إقرار ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الحصول على شهادة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>استخراج شهادة الضريبة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء التسجيل في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب قرار تفسيري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب خطة دفع ضريبة القيمة المضافة بالتقسيط</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل الأفراد في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>دفع الضريبة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم إقرار ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التسجيل في ضريبة القيمة المضافة (منشآت)</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم الإقرار الزكوي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء تسجيل شركة قابضة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل شركة قابضة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الدفع بالتقسيط</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>استخراج شهادة زكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل إقرار ضريبي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل في الضريبة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-6">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-6"
                                                aria-expanded="false" aria-controls="flush-collapse-6">
                                            إدارة خدمات وزارة العدل
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-6" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-6" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار وكالة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>صحيفة دعوى</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>حضور جلسة عن بعد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم طلب تنفيذ</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب تأجيل جلسة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-7">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-7"
                                                aria-expanded="false" aria-controls="flush-collapse-7">
                                            إدارة خدمات وزارة الشؤون البلدية والقروية والإسكان

                                        </button>
                                    </h2>
                                    <div id="flush-collapse-7" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-7" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تصريح بالأنشطة التجارية 24 ساعة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل ملكية رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار كرت صحي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-8">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-8"
                                                aria-expanded="false" aria-controls="flush-collapse-8">
                                            إدارة خدمات أبشر أعمال
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-8" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-8" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد إقامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار جواز</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تمديد تأشيرة زيارة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل خدمات عمالة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تبليغ تغيب عن العمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث معلومات جواز</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد جواز</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة خروج نهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تمديد تأشيرة خروج و عودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء تأشيرة خروج و عودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تصاريح السفر</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>بدل فاقد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار إقامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء تأشيرة خروج نهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل مهنة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد إقامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة خروج و عودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-pr-card">
                                <div class="d-flex  mx-auto text-center mt-4">
                                    <span class="h5 me-auto my-auto ms-2">عدد الموظفين :</span>
                                    <input type="button" class="btn edit-font px-10px btn-sm rounded-10 border" value="-" id="minus1" />
                                    <input type="text" id="quantity1" value="10" min="10" class="w-17 text-center border-0 h-32 edit-font"
                                           name="quantity1" disabled />
                                    <input type="button" class="ms-auto btn edit-font btn-sm rounded-10 border" value="+" id="plus1" />
                                </div>
                                <div class="pricing-btn mt-4">
                                    <button class="custom-btn mx-0">إختر الباقة</button>
                                    <a href="{{route('website.pricing')}}">
                                        <button class="custom-btn mx-0 mt-2">مقارنة الباقات</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 h-100 wow bounceInLeft" data-wow-duration="1.2s">
                        <div class="pricing-card h-100 text-right pricing-card-parent">
                            <div class="discount">
                                <strong>عرض محدود
                                </strong>
                            </div>
                            <div class="pricing-name lh-base text-center">
                                <span class="d-block mb-3 h2 mb-0 fw-bolder">باقة الشركات</span>
                                4500<span class="h3"> ريال </span>

                            </div>
                            <div class="accordion accordion-flush" id="accordionFlushExample1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne1">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1"
                                                aria-expanded="false" aria-controls="flush-collapseOne1">
                                            وزارة الموارد البشرية والتنمية الاجتماعية
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne1" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingOne1" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>فتح ملف منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب ملف منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار رخصة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث بيانات منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم بلاغ تغيب</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد رخصة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>وثيقة العمل الحر</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل عامل بين الفروع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل خدمات وافد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>أجير - إعارة موظف مؤقت</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>توثيق عقد عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إنهاء عقد عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة زيارة عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار شهادة السعودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل تابع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تغيير مهنة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء رخص العمل بغرض الخروج النهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار رخص العمل بغرض الخروج النهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo1">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo1"
                                                aria-expanded="false" aria-controls="flush-collapseTwo1">
                                            وزارة التجارة
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo1" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingTwo1" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>حجز اسم تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري رئيسي و تحول الفرع لرئيسي لمؤسسة لسعودي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار سجل تجاري فرعي لشركة مساهمة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار سجل تجاري للخليجيين</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>حجز إسم تجاري للخليجيين</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل ملكية سجل تجاري لشخص متوفي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحويل السجل من فرعي إلى رئيسي لمؤسسة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التحويل من شركة إلى مؤسسة رئيسي - فرعي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إيداع القوائم المالية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري لمؤسسة لشخص متوفي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري فرعي لشركة مساهمة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري رئيسي لفرع شركة خليجية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري رئيسي لشركة وطنية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>شطب سجل تجاري فرعي لشركة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد سجل تجاري رئيسي لفرع شركة أجنبية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحويل شركة رئيسي إلى مؤسسة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد السجل التجاري لشركة مهنية أو مختلطة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل سجل تجاري لشركة مساهمة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree1">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseThree1"
                                                aria-expanded="false" aria-controls="flush-collapseThree1">
                                            مدد
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree1" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingThree1" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع ملف حماية الأجور</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>توثيق عقد عمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل حساب</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-41">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-41"
                                                aria-expanded="false" aria-controls="flush-collapse-41">
                                            المؤسسة العامة للتأمينات الاجتماعية
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-41" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-41" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار شهادة لمنشأة منتهية النشاط</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل ملكية المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تغير مدير حساب الفروع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل حساب تأمينات أون لاين لمنشأة مسجلة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إنهاء نشاط منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إدارة ملاك المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار شهادة منشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث الأجور</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل بيانات المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل الكيان القانوني للمنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إدارة مشرفي المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل نوع المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-51">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-51"
                                                aria-expanded="false" aria-controls="flush-collapse-51">
                                            هيئة الزكاة و الدخل
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-51" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-51" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع إقرار ضريبي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل الإقرار الزكوي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التسجيل في الزكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم اعتراض</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب اعتراض على غرامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الإفراج عن عقد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع إقرار زكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل إقرار زكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب استخدام طريقة الخصم النسبي لضريبة المدخلات</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب استرداد أموال ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل مجموعة في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل الأشخاص المؤهلين للإسترداد في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل تفاصيل تسجيل ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب تغيير فترة تقديم الإقرارات</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب اعتراض على إعادة التقييم</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>الشهادة الفورية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل بيانات التسجيل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب إعادة طباعة شهادة ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الإفراج عن الضمان البنكي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>دفع الزكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل إقرار ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الحصول على شهادة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>استخراج شهادة الضريبة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء التسجيل في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب قرار تفسيري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب خطة دفع ضريبة القيمة المضافة بالتقسيط</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل الأفراد في ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>دفع الضريبة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم إقرار ضريبة القيمة المضافة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التسجيل في ضريبة القيمة المضافة (منشآت)</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم الإقرار الزكوي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء تسجيل شركة قابضة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل شركة قابضة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب الدفع بالتقسيط</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>استخراج شهادة زكاة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل إقرار ضريبي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل في الضريبة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-61">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-61"
                                                aria-expanded="false" aria-controls="flush-collapse-61">
                                            وزارة العدل
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-61" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-61" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار وكالة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>صحيفة دعوى</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>حضور جلسة عن بعد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تقديم طلب تنفيذ</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>طلب تأجيل جلسة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-71">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-71"
                                                aria-expanded="false" aria-controls="flush-collapse-71">
                                            وزارة الشؤون البلدية والقروية والإسكان

                                        </button>
                                    </h2>
                                    <div id="flush-collapse-71" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-71" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تصريح بالأنشطة التجارية 24 ساعة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل ملكية رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء رخصة نشاط تجاري</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار كرت صحي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-81">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-81"
                                                aria-expanded="false" aria-controls="flush-collapse-81">
                                            أبشر أعمال
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-81" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-81" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد إقامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار جواز</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تمديد تأشيرة زيارة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل خدمات عمالة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تبليغ تغيب عن العمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث معلومات جواز</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد جواز</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة خروج نهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تمديد تأشيرة خروج و عودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء تأشيرة خروج و عودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تصاريح السفر</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>بدل فاقد</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار إقامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء تأشيرة خروج نهائي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل مهنة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد إقامة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار تأشيرة خروج و عودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-91">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-91"
                                                aria-expanded="false" aria-controls="flush-collapse-91">
                                            وزارة الخارجية
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-91" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-91" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تأشيرات رجال الاعمال</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تأشيرات الزيارة الشخصية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التفويض الإلكتروني للتأشيرات</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تأشيرات زيارات العمل</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تمديد تأشيرات العودة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تأشيرات الزيارات التجارية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تأشيرات الزيارة العائلية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-910">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-910"
                                                aria-expanded="false" aria-controls="flush-collapse-910">
                                            الغرفة السعودية
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-910" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-910" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>فتح اشتراك الغرف التجارية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تصديق طلبات خدمات</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>وزارة الخارجية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إضافة توقيع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث وتعديل بيانات المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع وإضافة الملاحظات عن المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>نقل ملكية المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تسجيل وتفعيل الخدمات الإلكترونية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>رفع أو تخفيض درجة المنشأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تصدیق مطابقة التوقيع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إلغاء توقيع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل التوقيع</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-911">
                                        <button class="accordion-button collapsed p-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-911"
                                                aria-expanded="false" aria-controls="flush-collapse-911">
                                            وزارة الاستثمار
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-911" class="accordion-collapse collapse"
                                         aria-labelledby="flush-heading-911" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="pricing-features list-unstyled mt-0 text-right">
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصدار ترخيص تجاري بشريك سعودي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>إصـدار ترخيـص تجـاري أجنـبي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>ترخيص المقرات الإقليمية</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>التعديل على حصص  الشركاء</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>دمج الشركات</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تجديد التراخيص</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>زيادة رأس المال</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل الاسـم التجـاري للشـركـة أو أحـد الشـركاء</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث التراخيص لغرض التصفيـة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تعديل جنسية المستثمر الأجنبي</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تحديث بيانات تـواصل المنشـأة</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>تخفيض رأس المال</span>
                                                    <!-- <i class="fas fa-times-circle false"></i> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-pr-card">
                                <div class="d-flex  mx-auto text-center mt-4">
                                    <span class="h5 me-auto my-auto ms-2">عدد الموظفين :</span>
                                    <input type="button" class="btn edit-font px-10px btn-sm rounded-10 border"
                                           value="-" id="minus1"/>
                                    <input type="text" id="quantity1" value="10" min="10"
                                           class="w-17 text-center border-0 h-32 edit-font" name="quantity1" disabled/>
                                    <input type="button" class="ms-auto btn edit-font btn-sm rounded-10 border"
                                           value="+" id="plus1"/>
                                </div>
                                <div class="pricing-btn mt-4">
                                    <button class="custom-btn mx-0">إختر الباقة</button>
                                    <a href="{{route('website.pricing')}}">
                                        <button class="custom-btn mx-0 mt-2">مقارنة الباقات</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<script src="./muamlah-main/assets/js/typed.min.js"></script>
<script>
    var typed = new Typed(".typed-words", {
        strings: ["تنظيم خدمات قسم الموارد البشرية", "التوافق مع المتطلبات الحكومية", "إنجاز المعاملات في أي مدينة"],
        typeSpeed: 75,
        backSpeed: 50,
        backDelay: 800,
        startDelay: 500,
        loop: true,
        showCursor: false,
        cursorChar: "|",
        attr: null,
    });

</script>
@include('website.footer')

    <script src="./muamlah-main/assets/js/jquery-3.5.1.min.dc5e7f18c8bde9.js" type="text/javascript"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="muamlah-main/assets/js/faal-12.js" type="text/javascript"></script>
    <style id="ht_ctc_fromcenter">@keyframes ht_ctc_fromcenter {
                                      from {
                                          transform: scale(0);
                                      }
                                      to {
                                          transform: scale(1);
                                      }
                                  }

        .ht-ctc {
            animation: ht_ctc_fromcenter .25s;
        }</style>
    <style id="ht-ctc-animations">.ht_ctc_animation {
            animation-duration: 1s;
            animation-fill-mode: both;
            animation-delay: 3s;
            animation-iteration-count: 2;
        }</style>
    <style id="ht-ctc-an-bounce">@keyframes bounce {
                                     from, 20%, 53%, to {
                                         animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                                         transform: translate3d(0, 0, 0)
                                     }
                                     40%, 43% {
                                         animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                                         transform: translate3d(0, -30px, 0) scaleY(1.1)
                                     }
                                     70% {
                                         animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                                         transform: translate3d(0, -15px, 0) scaleY(1.05)
                                     }
                                     80% {
                                         transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                                         transform: translate3d(0, 0, 0) scaleY(0.95)
                                     }
                                     90% {
                                         transform: translate3d(0, -4px, 0) scaleY(1.02)
                                     }
                                 }

        .ht_ctc_an_bounce {
            animation-name: bounce;
            transform-origin: center bottom
        }</style>

    <div class="ht-ctc ht-ctc-chat ctc-analytics  ctc_wp_desktop style-3 " id="ht-ctc-chat "
         style="display: none;  position: fixed; bottom: 15px; right: 15px;"
         data-return_type="chat"
         data-style="3"
         data-number="966555067553"
         data-pre_filled=""
         data-is_ga_enable="yes"
         data-is_fb_pixel="yes"
         data-webandapi="webapi"
         data-display_mobile="show"
         data-display_desktop="hide"
         data-css="display: none; cursor: pointer; z-index: 99999999;"
         data-position="position: fixed; bottom: 15px; right: 15px;"
         data-position_mobile="position: fixed; bottom: 10px; right: 0px;"
         data-show_effect="From Center"
         data-no_number="added"
         data-an_type='ht_ctc_an_bounce'>
        <div class="ht_ctc_desktop_chat">
            <div style="display:flex;justify-content:center;align-items:center;flex-direction:row-reverse; ">
                <p class="ht-ctc-cta  ht-ctc-cta-hover "
                   style="padding: 0px 16px; line-height: 1.6; ; background-color: #25d366; color: #ffffff; border-radius:10px; margin:0 10px;  display: none; order: 0; ">
                    Chat with us on WhatsApp</p>
                <svg style="pointer-events:none; display:block; height:50px; width:50px;" width="50px" height="50px"
                     viewBox="0 0 1219.547 1225.016">
                    <path fill="#E0E0E0"
                          d="M1041.858 178.02C927.206 63.289 774.753.07 612.325 0 277.617 0 5.232 272.298 5.098 606.991c-.039 106.986 27.915 211.42 81.048 303.476L0 1225.016l321.898-84.406c88.689 48.368 188.547 73.855 290.166 73.896h.258.003c334.654 0 607.08-272.346 607.222-607.023.056-162.208-63.052-314.724-177.689-429.463zm-429.533 933.963h-.197c-90.578-.048-179.402-24.366-256.878-70.339l-18.438-10.93-191.021 50.083 51-186.176-12.013-19.087c-50.525-80.336-77.198-173.175-77.16-268.504.111-278.186 226.507-504.503 504.898-504.503 134.812.056 261.519 52.604 356.814 147.965 95.289 95.36 147.728 222.128 147.688 356.948-.118 278.195-226.522 504.543-504.693 504.543z"/>
                    <linearGradient id="htwaicona-chat" gradientUnits="userSpaceOnUse" x1="609.77" y1="1190.114"
                                    x2="609.77" y2="21.084">
                        <stop offset="0" stop-color="#20b038"/>
                        <stop offset="1" stop-color="#60d66a"/>
                    </linearGradient>
                    <path fill="url(#htwaicona-chat)"
                          d="M27.875 1190.114l82.211-300.18c-50.719-87.852-77.391-187.523-77.359-289.602.133-319.398 260.078-579.25 579.469-579.25 155.016.07 300.508 60.398 409.898 169.891 109.414 109.492 169.633 255.031 169.57 409.812-.133 319.406-260.094 579.281-579.445 579.281-.023 0 .016 0 0 0h-.258c-96.977-.031-192.266-24.375-276.898-70.5l-307.188 80.548z"/>
                    <image overflow="visible" opacity=".08" width="682" height="639"
                           transform="translate(270.984 291.372)"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF"
                          d="M462.273 349.294c-11.234-24.977-23.062-25.477-33.75-25.914-8.742-.375-18.75-.352-28.742-.352-10 0-26.25 3.758-39.992 18.766-13.75 15.008-52.5 51.289-52.5 125.078 0 73.797 53.75 145.102 61.242 155.117 7.5 10 103.758 166.266 256.203 226.383 126.695 49.961 152.477 40.023 179.977 37.523s88.734-36.273 101.234-71.297c12.5-35.016 12.5-65.031 8.75-71.305-3.75-6.25-13.75-10-28.75-17.5s-88.734-43.789-102.484-48.789-23.75-7.5-33.75 7.516c-10 15-38.727 48.773-47.477 58.773-8.75 10.023-17.5 11.273-32.5 3.773-15-7.523-63.305-23.344-120.609-74.438-44.586-39.75-74.688-88.844-83.438-103.859-8.75-15-.938-23.125 6.586-30.602 6.734-6.719 15-17.508 22.5-26.266 7.484-8.758 9.984-15.008 14.984-25.008 5-10.016 2.5-18.773-1.25-26.273s-32.898-81.67-46.234-111.326z"/>
                    <path fill="#FFF"
                          d="M1036.898 176.091C923.562 62.677 772.859.185 612.297.114 281.43.114 12.172 269.286 12.039 600.137 12 705.896 39.633 809.13 92.156 900.13L7 1211.067l318.203-83.438c87.672 47.812 186.383 73.008 286.836 73.047h.255.003c330.812 0 600.109-269.219 600.25-600.055.055-160.343-62.328-311.108-175.649-424.53zm-424.601 923.242h-.195c-89.539-.047-177.344-24.086-253.93-69.531l-18.227-10.805-188.828 49.508 50.414-184.039-11.875-18.867c-49.945-79.414-76.312-171.188-76.273-265.422.109-274.992 223.906-498.711 499.102-498.711 133.266.055 258.516 52 352.719 146.266 94.195 94.266 146.031 219.578 145.992 352.852-.118 274.999-223.923 498.749-498.899 498.749z"/>
                </svg>
            </div>
        </div>
    </div>

    <script src='muamlah-main/assets/js/325.appc169.js' id='ht_ctc_app_js-js'></script>
    <script src='muamlah-main/assets/js/coblocks-animation86a0.js?ver=2.22.6' id='coblocks-animation-js'></script>
    <script src='muamlah-main/assets/js/scripts9dff.js?ver=5.3.2' id='contact-form-7-js'></script>
    <script src='muamlah-main/assets/js/smush-lazy-load.min688f.js?ver=3.8.4' id='smush-lazy-load-js'></script>
    <script src='muamlah-main/assets/js/wp-embed.min41a3.js' id='wp-embed-js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>

    <!-- <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./muamlah-main/assets/js/webfont.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // $('#plus').click(function add() {
        //     var $qtde = $("#quantity");
        //
        //     var a = $qtde.val();
        //
        //     a++;
        //     // $("#minus").attr("disabled", !a);
        //     $qtde.val(a);
        // });
        // $("#minus").attr($("#quantity").val());
        //
        // $('#minus').click(function minust() {
        //     var $qtde = $("#quantity");
        //     var b = $qtde.val();
        //     if (b >= 11) {
        //         b--;
        //         $qtde.val(b);
        //     } else {
        //         $("#minus").attr("disabled", true);
        //     }
        // });

        /* On change */
        $(document).ready(function () {
            function updatePrice() {
                $("#total-price").val(parseFloat($("#quantity").val() * 150));
            }

            // On the click of an input, update the price
            $(document).on("click", "input", updatePrice);
        });
    </script>
    <script>
        $('#plus1').click(function add1() {
            var $qtde = $("#quantity1");

            var a = $qtde.val();

            a++;
            $("#minus1").attr("disabled", !a);
            $qtde.val(a);
        });
        $("#minus1").attr($("#quantity1").val());

        $('#minus1').click(function minust1() {
            var $qtde = $("#quantity1");
            var b = $qtde.val();
            if (b >= 11) {
                b--;
                $qtde.val(b);
            } else {
                $("#minus1").attr("disabled", true);
            }
        });

        /* On change */
        $(document).ready(function () {
            function updatePrice1() {
                var price = ($("#quantity1").val());
                var price2 = ($("#total-price1").val());
                var total = (price);
                $("#total-price1").val(total * 200 + 2500);

            }

            // On the click of an input, update the price
            $(document).on("click", "input", updatePrice1);
        });
    </script>
    <script>
        $(document).ready(function ($) {
            //Check if an element was in a screen
            function isScrolledIntoView(elem) {
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height();
                var elemTop = $(elem).offset().top;
                var elemBottom = elemTop + $(elem).height();
                return ((elemBottom <= docViewBottom));
            }

            //Count up code
            function countUp() {
                $('.counter').each(function () {
                    var $this = $(this), // <- Don't touch this variable. It's pure magic.
                        countTo = $this.attr('data-count');
                    ended = $this.attr('ended');

                    if (ended != "true" && isScrolledIntoView($this)) {
                        $({countNum: $this.text()}).animate({
                                countNum: countTo
                            },
                            {
                                duration: 2500, //duration of counting
                                easing: 'swing',
                                step: function () {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function () {
                                    $this.text(this.countNum);
                                }
                            });
                        $this.attr('ended', 'true');
                    }
                });
            }

            //Start animation on page-load
            if (isScrolledIntoView(".counter")) {
                countUp();
            }
            //Start animation on screen
            $(document).scroll(function () {
                if (isScrolledIntoView(".counter")) {
                    countUp();
                }
            });
        });

    </script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            rtl: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        })
    </script>
<!-- Facebook Pixel Code -->
{{--<script>--}}
{{--    !function(f,b,e,v,n,t,s)--}}
{{--    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?--}}
{{--        n.callMethod.apply(n,arguments):n.queue.push(arguments)};--}}
{{--        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';--}}
{{--        n.queue=[];t=b.createElement(e);t.async=!0;--}}
{{--        t.src=v;s=b.getElementsByTagName(e)[0];--}}
{{--        s.parentNode.insertBefore(t,s)}(window, document,'script',--}}
{{--        'https://connect.facebook.net/en_US/fbevents.js');--}}
{{--    fbq('init', '430028418749905');--}}
{{--    fbq('track', 'PageView');--}}
{{--</script>--}}

{{--<noscript><img height="1" width="1" style="display:none"--}}
{{--               src="https://www.facebook.com/tr?id=430028418749905&ev=PageView&noscript=1"--}}
{{--    /></noscript>--}}
<!-- End Facebook Pixel Code -->
<link rel="stylesheet" href="https://erp.muamlah.com/im_livechat/external_lib.css"/> <script type="text/javascript" src="https://erp.muamlah.com/im_livechat/external_lib.js"></script> <script type="text/javascript" src="https://erp.muamlah.com/im_livechat/loader/1"></script>

</body>
</html>
