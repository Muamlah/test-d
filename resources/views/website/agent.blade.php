<!DOCTYPE HTML>
<html dir="rtl" lang="ar">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الوكلاء | منصة معاملة </title>
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


</head>


<body class="rtl home page-template page-template-templates page-template-home-ar page-template-templateshome-ar-php page page-id-9 wp-embed-responsive is-twentytwenty Show Button singular enable-search-modal missing-post-thumbnail has-no-pagination not-showing-comments show-avatars home-ar footer-top-visible">
{!! settings()->iframe_google_analytics !!}

<div class="border-bottom shadow">
    <div class="container">
        <div class="navbar sticky w-nav">
            <div class="row">
                <div class="col-6 my-auto">
                    <a href="/" aria-current="page" class="w-nav-brand">
                        <img width="50" alt="Faal logo" data-src="muamlah-main/assets/images/logo-muamlah.png" class="w-30logo ls-is-cached lazyloaded" src="muamlah-main/assets/images/logo-muamlah.png">
                        <noscript>
                            <img src="muamlah-main/assets/images/logo-muamlah.png" width="50" alt="Faal logo"></noscript>
                        <span class="fw-bolder align-middle">
                                منصة معاملة

                            </span>
                    </a>
                </div>
                <div class="col-6 my-auto text-start">
                    <a href="#" data-toast="notification-1" class="header-icon header-icon-4 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-bell fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M223.1 512C259.4 512 288 483.4 288 448H160C160 483.4 188.6 512 223.1 512zM439.4 362.3c-19.25-20.75-55.5-52-55.5-154.3c0-77.75-54.38-139.9-127.9-155.1V32c0-17.62-14.38-32-32-32S192 14.38 192 32v20.88C118.5 68.13 64.13 130.3 64.13 208c0 102.3-36.25 133.5-55.5 154.3C2.625 368.8 0 376.5 0 384c.125 16.38 13 32 32.13 32h383.8c19.12 0 32-15.62 32.13-32C448 376.5 445.4 368.8 439.4 362.3z"></path></svg><!-- <i class="fas fa-bell"></i> Font Awesome fontawesome.com --></a>
                    <a href="https://app.muamlah.com/messages/index" class="header-icon header-icon-3 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-envelope fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 352c-16.53 0-33.06-5.422-47.16-16.41L0 173.2V400C0 426.5 21.49 448 48 448h416c26.51 0 48-21.49 48-48V173.2l-208.8 162.5C289.1 346.6 272.5 352 256 352zM16.29 145.3l212.2 165.1c16.19 12.6 38.87 12.6 55.06 0l212.2-165.1C505.1 137.3 512 125 512 112C512 85.49 490.5 64 464 64h-416C21.49 64 0 85.49 0 112C0 125 6.01 137.3 16.29 145.3z"></path></svg><!-- <i class="fas fa-envelope"></i> Font Awesome fontawesome.com --></a>
                    <a href="https://app.muamlah.com/user/profile" class="header-icon header-icon-2 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-user fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path></svg><!-- <i class="fas fa-user"></i> Font Awesome fontawesome.com --></a>
                    <a href="#" data-back-button="" class="header-icon header-icon-1 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-arrow-left fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z"></path></svg><!-- <i class="fas fa-arrow-left"></i> Font Awesome fontawesome.com --></a>

                </div>
            </div>

            <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div></div>
    </div>
</div>
<div class="stickynavbar" style="will-change: opacity; opacity: 0;">
    <div class="container">
        <div data-collapse="medium" data-animation="default" data-duration="400" role="banner" class="navbar sticky w-nav">
            <div class="row">
                <div class="col-6 my-auto ">
                    <a href="/" aria-current="page" class="w-nav-brand">
                        <img width="50" alt="Faal logo" data-src="muamlah-main/assets/images/logo-muamlah.png" class="w-30logo ls-is-cached lazyloaded" src="muamlah-main/assets/images/logo-muamlah.png">
                        <noscript>
                            <img src="muamlah-main/assets/images/logo-muamlah.png" width="50" alt="Faal logo"></noscript>
                        <span class="fw-bolder align-middle">
                                منصة معاملة

                            </span>
                    </a>
                </div>
                <div class="col-6 my-auto text-start">
                    <a href="#" data-toast="notification-1" class="header-icon header-icon-4 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-bell fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M223.1 512C259.4 512 288 483.4 288 448H160C160 483.4 188.6 512 223.1 512zM439.4 362.3c-19.25-20.75-55.5-52-55.5-154.3c0-77.75-54.38-139.9-127.9-155.1V32c0-17.62-14.38-32-32-32S192 14.38 192 32v20.88C118.5 68.13 64.13 130.3 64.13 208c0 102.3-36.25 133.5-55.5 154.3C2.625 368.8 0 376.5 0 384c.125 16.38 13 32 32.13 32h383.8c19.12 0 32-15.62 32.13-32C448 376.5 445.4 368.8 439.4 362.3z"></path></svg><!-- <i class="fas fa-bell"></i> Font Awesome fontawesome.com --></a>
                    <a href="https://app.muamlah.com/messages/index" class="header-icon header-icon-3 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-envelope fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 352c-16.53 0-33.06-5.422-47.16-16.41L0 173.2V400C0 426.5 21.49 448 48 448h416c26.51 0 48-21.49 48-48V173.2l-208.8 162.5C289.1 346.6 272.5 352 256 352zM16.29 145.3l212.2 165.1c16.19 12.6 38.87 12.6 55.06 0l212.2-165.1C505.1 137.3 512 125 512 112C512 85.49 490.5 64 464 64h-416C21.49 64 0 85.49 0 112C0 125 6.01 137.3 16.29 145.3z"></path></svg><!-- <i class="fas fa-envelope"></i> Font Awesome fontawesome.com --></a>
                    <a href="https://app.muamlah.com/user/profile" class="header-icon header-icon-2 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-user fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path></svg><!-- <i class="fas fa-user"></i> Font Awesome fontawesome.com --></a>
                    <a href="#" data-back-button="" class="header-icon header-icon-1 text-dark mx-2 mx-md-3 font-12"><svg class="svg-inline--fa fa-arrow-left fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z"></path></svg><!-- <i class="fas fa-arrow-left"></i> Font Awesome fontawesome.com --></a>

                </div>
            </div>


            <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-1"></div></div>
    </div>
</div>
<div class="site-body">
    <div class="container pt-5">
        <div class="row1 pt-4">
            <div class="row1-col photo">
                <img loading="lazy" alt="" data-src="muamlah-main/assets/images/map.png" width="85%" class=" lazyloaded" src="muamlah-main/assets/images/map.png">
                <noscript><img src="wp-content/uploads/2021/06/5.png" loading="lazy" alt=""></noscript>
                <div class="invesibledivider _36"></div>
                <h4>نظام الوكيل المعتمد</h4>
                <div class="maxed_paragraph">
                    <p style="line-height: 1.5em;">
                        يمكن للشركات الربط مع الوكيل الالكتروني لإدارة جميع أعمالها لدى الجهات الحكومية
                        بحيث تقوم الشركات السعودية باختيار الوكيل المناسب من قائمة الوكلاء المعتمدين لدينا و تربط معه
                        جميع خدماتها .
                        <br>
                        فقط اختر الوكيل المناسب من صفحة الوكلاء  :    <a href="{{route('user.agents_list')}}" class="button dark w-button">الوكلاء</a>

                    </p>
                </div>
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

                    </div>
                </div>
                <div class="invesibledivider _36"></div>
                <div class="maxed_paragraph">
                    <h4>كيف أتعاقد مع الوكيل ؟</h4>
                    <ul class="ps-0 pe-4">
                        <li class="mt-1 mb-2 text-muted">اختر الوكيل المناسب من قائمة الوكلاء</li>
                        <li class="mt-1 mb-2 text-muted">توقيع العقد الالكتروني مع الوكيل</li>
                        <li class="mt-1 mb-2 text-muted">اختر الخدمة المناسب</li>
                        <li class="mt-1 mb-2 text-muted">في أسفل صفحة الطلب , اختر علامة توكيل الوكيل ليقوم بمتابعة
                            الطلب</li>
                        <li class="mt-1 mb-2 text-muted">ادفع قيمة الطلب لمنصة معاملة</li>
                        <li class="mt-1 mb-2 text-muted">سوف يتابع الوكيل طلباتك مع مقدمي الخدمات حتى تسليم الخدمة</li>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="section">
        <div class="container pt-4">
            <div class="row justify-content-center w-100 mx-auto aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-10 text-center">
                    <h2 class="my-3 pt-2">الأسئلة الشائعة</h2>
                    <div class="accordion accordion-flush" id="faqlist">
                        <div class="accordion-item mb-3 shadow-sm text-end border">
                            <h3 class="accordion-header mt-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-circle-question fa-w-16 ms-2 text-success" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-question" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-18 0-32-14-32-32s13.1-32 32-32c17.1 0 32 14 32 32S273.1 400 256 400zM325.1 258L280 286V288c0 13-11 24-24 24S232 301 232 288V272c0-8 4-16 12-21l57-34C308 213 312 206 312 198C312 186 301.1 176 289.1 176h-51.1C225.1 176 216 186 216 198c0 13-11 24-24 24s-24-11-24-24C168 159 199 128 237.1 128h51.1C329 128 360 159 360 198C360 222 347 245 325.1 258z"></path></svg><!-- <i class="fas fa-question-circle ms-2 text-success"></i> Font Awesome fontawesome.com -->
                                    ماهي خدمة الوكيل ؟
                                </button>
                            </h3>
                            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="">
                                <div class="accordion-body">
                                    الوكيل هو شخص يقوم بجميع أعمال الشركة من خدمات حكومية عن بعد ,
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 shadow-sm text-end border">
                            <h3 class="accordion-header mt-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-circle-question fa-w-16 ms-2 text-success" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-question" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-18 0-32-14-32-32s13.1-32 32-32c17.1 0 32 14 32 32S273.1 400 256 400zM325.1 258L280 286V288c0 13-11 24-24 24S232 301 232 288V272c0-8 4-16 12-21l57-34C308 213 312 206 312 198C312 186 301.1 176 289.1 176h-51.1C225.1 176 216 186 216 198c0 13-11 24-24 24s-24-11-24-24C168 159 199 128 237.1 128h51.1C329 128 360 159 360 198C360 222 347 245 325.1 258z"></path></svg><!-- <i class="fas fa-question-circle ms-2 text-success"></i> Font Awesome fontawesome.com -->
                                    ماهي ميزة الوكيل الالكتروني ؟
                                </button>
                            </h3>
                            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="">
                                <div class="accordion-body">
                                    تتميز خدمة الوكيل بالتعامل المباشر بحيث يمكنك توكيل وتفويض شخص واحد فقط لإدارة طلبات الشركة عن بعد .
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 shadow-sm text-end border">
                            <h3 class="accordion-header mt-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-circle-question fa-w-16 ms-2 text-success" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-question" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-18 0-32-14-32-32s13.1-32 32-32c17.1 0 32 14 32 32S273.1 400 256 400zM325.1 258L280 286V288c0 13-11 24-24 24S232 301 232 288V272c0-8 4-16 12-21l57-34C308 213 312 206 312 198C312 186 301.1 176 289.1 176h-51.1C225.1 176 216 186 216 198c0 13-11 24-24 24s-24-11-24-24C168 159 199 128 237.1 128h51.1C329 128 360 159 360 198C360 222 347 245 325.1 258z"></path></svg><!-- <i class="fas fa-question-circle ms-2 text-success"></i> Font Awesome fontawesome.com -->
                                    كم هي تكاليف الوكيل ؟
                                </button>
                            </h3>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="">
                                <div class="accordion-body">
                                    هي نفس تكاليف و رسوم الخدمات , لا يوجد رسوم إضافية عند استخدام ميزة الوكيل الالكتروني
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 shadow-sm text-end border">
                            <h3 class="accordion-header mt-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-circle-question fa-w-16 ms-2 text-success" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-question" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-18 0-32-14-32-32s13.1-32 32-32c17.1 0 32 14 32 32S273.1 400 256 400zM325.1 258L280 286V288c0 13-11 24-24 24S232 301 232 288V272c0-8 4-16 12-21l57-34C308 213 312 206 312 198C312 186 301.1 176 289.1 176h-51.1C225.1 176 216 186 216 198c0 13-11 24-24 24s-24-11-24-24C168 159 199 128 237.1 128h51.1C329 128 360 159 360 198C360 222 347 245 325.1 258z"></path></svg><!-- <i class="fas fa-question-circle ms-2 text-success"></i> Font Awesome fontawesome.com -->
                                    ماهي مجالات عمل الوكيل ؟
                                </button>
                            </h3>
                            <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="">
                                <div class="accordion-body">
                                    مجال عمل الوكيل : الخدمات الحكومية الالكترونية و مراجعة الجهات الحكومية لإنجاز أعمال الشركة .
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 shadow-sm text-end border">
                            <h3 class="accordion-header mt-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-circle-question fa-w-16 ms-2 text-success" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-question" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-18 0-32-14-32-32s13.1-32 32-32c17.1 0 32 14 32 32S273.1 400 256 400zM325.1 258L280 286V288c0 13-11 24-24 24S232 301 232 288V272c0-8 4-16 12-21l57-34C308 213 312 206 312 198C312 186 301.1 176 289.1 176h-51.1C225.1 176 216 186 216 198c0 13-11 24-24 24s-24-11-24-24C168 159 199 128 237.1 128h51.1C329 128 360 159 360 198C360 222 347 245 325.1 258z"></path></svg><!-- <i class="fas fa-question-circle ms-2 text-success"></i> Font Awesome fontawesome.com -->
                                    كيف أتعاقد مع الوكيل ؟

                                </button>
                            </h3>
                            <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="">
                                <div class="accordion-body">
                                   ادخل صفحة الوكلاء و استعرض الملف الشخصي و خدمات الوكيل المناسب<br>
                                    تعاقد مع وكيلك بعقد يتم الاتفاق عليه بين الطرفين<br>
                                    تفويض الوكيل رسميا على حسابات الشركة في منصات الجهات الحكومية<br>
                                    توكيل الوكيل بوكالة رسمية من ناجز .
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 shadow-sm text-end border">
                            <h3 class="accordion-header mt-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-6" aria-expanded="false">
                                    <svg class="svg-inline--fa fa-circle-question fa-w-16 ms-2 text-success" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-question" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-18 0-32-14-32-32s13.1-32 32-32c17.1 0 32 14 32 32S273.1 400 256 400zM325.1 258L280 286V288c0 13-11 24-24 24S232 301 232 288V272c0-8 4-16 12-21l57-34C308 213 312 206 312 198C312 186 301.1 176 289.1 176h-51.1C225.1 176 216 186 216 198c0 13-11 24-24 24s-24-11-24-24C168 159 199 128 237.1 128h51.1C329 128 360 159 360 198C360 222 347 245 325.1 258z"></path></svg><!-- <i class="fas fa-question-circle ms-2 text-success"></i> Font Awesome fontawesome.com -->
                                    كيف أطلب خدمة من الوكيل ؟

                                </button>
                            </h3>
                            <div id="faq-content-6" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="">
                                <div class="accordion-body">
                                    بعد التعاقد و تفويض الوكيل , يمكنك فتح المحاثة و الطلب مباشرة من الوكيل , هذا كل شيء .
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--                <div class="row w-100 mx-auto">-->
            <!--                    <div class="col-md-12">-->
            <!--                        <h2 class="text-center my-3">آراء العملاء</h2>-->
            <!--                        <div class="owl-carousel owl-theme">-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="item me-5">-->
            <!--                                <div class="testimonial-item position-relative py-4 px-5-e rounded-10 shadow mx-3 my-2 bg-white h-100">-->
            <!--                                    <img src="https://warqaa.ormediaco.com/storage/../front/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img position-absolute end-n-40 rounded-10 w-90px contain" width="90px" height="90px" alt="">-->
            <!--                                    <h3>احمد علي</h3>-->
            <!--                                    <p>-->
            <!--                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها-->
            <!--                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--                                    </p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->

        </div>

    </div>
</div>


<script src="muamlah-main/assets/js/typed.min.js"></script>
<script>
    var typed = new Typed(".typed-words", {
        strings: ["انجاز المعاملات", "متابعة الطلبات", "طلب الخدمات"],
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
    <script src="muamlah-main/assets/js/jquery-3.5.1.min.dc5e7f18c8bde9.js" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="assets/js/faal-12.js" type="text/javascript"></script>
    <style id="ht_ctc_fromcenter">
        @keyframes ht_ctc_fromcenter {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        .ht-ctc {
            animation: ht_ctc_fromcenter .25s;
        }
    </style>
    <style id="ht-ctc-animations">
        .ht_ctc_animation {
            animation-duration: 1s;
            animation-fill-mode: both;
            animation-delay: 3s;
            animation-iteration-count: 2;
        }
    </style>
    <style id="ht-ctc-an-bounce">
        @keyframes bounce {

            from,
            20%,
            53%,
            to {
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                transform: translate3d(0, 0, 0)
            }

            40%,
            43% {
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
        }
    </style>

    <div class="ht-ctc ht-ctc-chat ctc-analytics  ctc_wp_desktop style-3 " id="ht-ctc-chat " style="display: none;  position: fixed; bottom: 15px; right: 15px;" data-return_type="chat" data-style="3" data-number="966555067553" data-pre_filled="" data-is_ga_enable="yes" data-is_fb_pixel="yes" data-webandapi="webapi" data-display_mobile="show" data-display_desktop="hide" data-css="display: none; cursor: pointer; z-index: 99999999;" data-position="position: fixed; bottom: 15px; right: 15px;" data-position_mobile="position: fixed; bottom: 10px; right: 0px;" data-show_effect="From Center" data-no_number="added" data-an_type="ht_ctc_an_bounce">
        <div class="ht_ctc_desktop_chat">
            <div style="display:flex;justify-content:center;align-items:center;flex-direction:row-reverse; ">
                <p class="ht-ctc-cta  ht-ctc-cta-hover " style="padding: 0px 16px; line-height: 1.6; ; background-color: #25d366; color: #ffffff; border-radius:10px; margin:0 10px;  display: none; order: 0; ">
                    Chat with us on WhatsApp</p>
                <svg style="pointer-events:none; display:block; height:50px; width:50px;" width="50px" height="50px" viewBox="0 0 1219.547 1225.016">
                    <path fill="#E0E0E0" d="M1041.858 178.02C927.206 63.289 774.753.07 612.325 0 277.617 0 5.232 272.298 5.098 606.991c-.039 106.986 27.915 211.42 81.048 303.476L0 1225.016l321.898-84.406c88.689 48.368 188.547 73.855 290.166 73.896h.258.003c334.654 0 607.08-272.346 607.222-607.023.056-162.208-63.052-314.724-177.689-429.463zm-429.533 933.963h-.197c-90.578-.048-179.402-24.366-256.878-70.339l-18.438-10.93-191.021 50.083 51-186.176-12.013-19.087c-50.525-80.336-77.198-173.175-77.16-268.504.111-278.186 226.507-504.503 504.898-504.503 134.812.056 261.519 52.604 356.814 147.965 95.289 95.36 147.728 222.128 147.688 356.948-.118 278.195-226.522 504.543-504.693 504.543z"></path>
                    <linearGradient id="htwaicona-chat" gradientUnits="userSpaceOnUse" x1="609.77" y1="1190.114" x2="609.77" y2="21.084">
                        <stop offset="0" stop-color="#20b038"></stop>
                        <stop offset="1" stop-color="#60d66a"></stop>
                    </linearGradient>
                    <path fill="url(#htwaicona-chat)" d="M27.875 1190.114l82.211-300.18c-50.719-87.852-77.391-187.523-77.359-289.602.133-319.398 260.078-579.25 579.469-579.25 155.016.07 300.508 60.398 409.898 169.891 109.414 109.492 169.633 255.031 169.57 409.812-.133 319.406-260.094 579.281-579.445 579.281-.023 0 .016 0 0 0h-.258c-96.977-.031-192.266-24.375-276.898-70.5l-307.188 80.548z"></path>
                    <image overflow="visible" opacity=".08" width="682" height="639" transform="translate(270.984 291.372)"></image>
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF" d="M462.273 349.294c-11.234-24.977-23.062-25.477-33.75-25.914-8.742-.375-18.75-.352-28.742-.352-10 0-26.25 3.758-39.992 18.766-13.75 15.008-52.5 51.289-52.5 125.078 0 73.797 53.75 145.102 61.242 155.117 7.5 10 103.758 166.266 256.203 226.383 126.695 49.961 152.477 40.023 179.977 37.523s88.734-36.273 101.234-71.297c12.5-35.016 12.5-65.031 8.75-71.305-3.75-6.25-13.75-10-28.75-17.5s-88.734-43.789-102.484-48.789-23.75-7.5-33.75 7.516c-10 15-38.727 48.773-47.477 58.773-8.75 10.023-17.5 11.273-32.5 3.773-15-7.523-63.305-23.344-120.609-74.438-44.586-39.75-74.688-88.844-83.438-103.859-8.75-15-.938-23.125 6.586-30.602 6.734-6.719 15-17.508 22.5-26.266 7.484-8.758 9.984-15.008 14.984-25.008 5-10.016 2.5-18.773-1.25-26.273s-32.898-81.67-46.234-111.326z"></path>
                    <path fill="#FFF" d="M1036.898 176.091C923.562 62.677 772.859.185 612.297.114 281.43.114 12.172 269.286 12.039 600.137 12 705.896 39.633 809.13 92.156 900.13L7 1211.067l318.203-83.438c87.672 47.812 186.383 73.008 286.836 73.047h.255.003c330.812 0 600.109-269.219 600.25-600.055.055-160.343-62.328-311.108-175.649-424.53zm-424.601 923.242h-.195c-89.539-.047-177.344-24.086-253.93-69.531l-18.227-10.805-188.828 49.508 50.414-184.039-11.875-18.867c-49.945-79.414-76.312-171.188-76.273-265.422.109-274.992 223.906-498.711 499.102-498.711 133.266.055 258.516 52 352.719 146.266 94.195 94.266 146.031 219.578 145.992 352.852-.118 274.999-223.923 498.749-498.899 498.749z"></path>
                </svg>
            </div>
        </div>
    </div>

    <script src="assets/js/325.appc169.js" id="ht_ctc_app_js-js"></script>
    <script src="assets/js/coblocks-animation86a0.js?ver=2.22.6" id="coblocks-animation-js"></script>
    <script src="assets/js/scripts9dff.js?ver=5.3.2" id="contact-form-7-js"></script>
    <script src="assets/js/smush-lazy-load.min688f.js?ver=3.8.4" id="smush-lazy-load-js"></script>
    <script src="assets/js/wp-embed.min41a3.js" id="wp-embed-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- <script>
/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
</script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="muamlah-main/assets/js/webfont.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#plus').click(function add() {
            var $qtde = $("#quantity");

            var a = $qtde.val();

            a++;
            $("#minus").attr("disabled", !a);
            $qtde.val(a);
        });
        $("#minus").attr($("#quantity").val());

        $('#minus').click(function minust() {
            var $qtde = $("#quantity");
            var b = $qtde.val();
            if (b >= 11) {
                b--;
                $qtde.val(b);
            } else {
                $("#minus").attr("disabled", true);
            }
        });

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
                        $({ countNum: $this.text() }).animate({
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


</div></body></html>
