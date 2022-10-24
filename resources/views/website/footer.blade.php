<div class="footer">
    <div class="container-2">
        <div class="footer-row">
            <div class="footer-left">
                <p class="footer-sub-text"> منصة معاملة : منصة الخدمات الالكترونية</p>
                <ul role="list" class="social-icons-list w-list-unstyled">
                    <li class="list-item">
                        <a href="#" target="_blank" class="button-circle button-small bg-white w-inline-block">
                            <img alt=""
                                 data-src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d43621948c201e9929a_twitter.svg"
                                 class="social-icon lazyload"
                                 src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                            <noscript>
                                <img src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d43621948c201e9929a_twitter.svg"
                                     alt="" class="social-icon">
                            </noscript>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="#" target="_blank" class="button-circle button-small bg-white w-inline-block">
                            <img alt=""
                                 data-src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d436219486b9ae99294_linkedin.svg"
                                 class="social-icon lazyload"
                                 src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                            <noscript>
                                <img src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d436219486b9ae99294_linkedin.svg"
                                     alt="" class="social-icon">
                            </noscript>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="button-circle button-small bg-white w-inline-block">
                            <img alt=""
                                 data-src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d436219486f36e992b8_instagram.svg"
                                 class="social-icon lazyload"
                                 src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                            <noscript>
                                <img src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d436219486f36e992b8_instagram.svg"
                                     alt="" class="social-icon">
                            </noscript>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="#" target="_blank" class="button-circle button-small bg-white w-inline-block"><img
                                alt=""
                                data-src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d436219480c66e992d6_facebook.svg"
                                class="social-icon lazyload"
                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                            <noscript><img
                                    src="https://uploads-ssl.webflow.com/5f384d433eba5defe032c524/5f384d436219480c66e992d6_facebook.svg"
                                    alt="" class="social-icon"></noscript>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-right">
                <div class="footer-menu-column">
                    <h6 class="h6-small">حول الشركة
                    </h6>
                    <ul role="list" class="link-list w-list-unstyled">
                        <!-- dynamic Solutions menu -->
                        <li>
                            <a href="#" class="hover-link text-white"> الإتصال بنا</a>
                        </li>
                        <li>
                            <a href="#" class="hover-link text-white"> الوظائف </a>
                        </li>
                        <li>
                            <a href="#" class="hover-link text-white"> مدونة معاملة </a>
                        </li>
                        <li>
                            <a href="#" class="hover-link text-white"> إتفاقية الشروط والأحكام </a>
                        </li>
                        <li>
                            <a href="#" class="hover-link text-white"> الخدمات </a>
                        </li>
                        <!-- dynamic Solutions menu end -->
                    </ul>
                </div>
            </div>

            <div class="footer-menu-column">
                <h6 class="h6-small"> الخدماتنا
                </h6>
                <ul role="list" class="link-list w-list-unstyled">
                    <li>
                        <a href="{{route('website.agent')}}" class="hover-link text-white">    	الوكلاء </a>
                    </li>
                    <li>
                        <a href="{{route('website.provider')}}" class="hover-link text-white">   مقدمي الخدمات  </a>
                    </li>
                    <li>
                        <a href="{{route('user.agents_list')}}" class="hover-link text-white">         الشراكات  </a>
                    </li>
                    <li>
                        <a href="{{route('website.customers')}}" class="hover-link text-white">        العملاء  </a>
                    </li>
                    <li>
                        <a href="{{route('website.affiliate')}}" class="hover-link text-white">         التسويق بالعمولة  </a>
                    </li>

                </ul>
            </div>
            @guest()
                <div class="footer-menu-column">
                    <h6 class="h6-small">العملاء
                    </h6>
                    <ul role="list" class="link-list w-list-unstyled">
                        <li>
                            <a href="{{route('login')}}" data-menu="menu-signin"
                               class="hover-link text-white">تسجيل الدخول</a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="hover-link text-white">تسجيل مقدم
                                خدمة</a>
                        </li>
                        <li>
                            <a href="{{route('customer.register')}}" class="hover-link text-white">تسجيل عميل</a>
                        </li>

                    </ul>
                </div>
            @endguest
        </div>
    </div>
    <div id="footer-bar" class="footer-bar-1 d-flex bottom-0 w-100 start-0">
        <a href="{{route('website.home')}}" class="{{ (strpos(Route::currentRouteName(), 'website.home') === 0) ? 'active-nav' : '' }} "><i class="fa fa-home"></i><span> الرئيسية</span></a>
        <a href="{{ route('weblist')}}" class="{{ (strpos(Route::currentRouteName(), 'weblist') === 0) ? 'active-nav' : '' }} "><i class="fa fa-briefcase"></i><span>الخدمات</span></a>
        <a href="{{route('privateOrder.create')}}" class="{{ (strpos(Route::currentRouteName(), 'privateOrder.create') === 0) ? 'active-nav' : '' }} "><i class="fa fa-star"></i><span>تعميد</span></a>
        <a href="{{ route('orders.index') }}" class="{{ (strpos(Route::currentRouteName(), 'orders.index') === 0) ? 'active-nav' : '' }} "><i class="fa fa-box-open"></i><span>الطلبات</span></a>
        {{-- <a href="{{ route('privateOrder.index') }}" class="{{ (strpos(Route::currentRouteName(), 'privateOrder.index') === 0) ? 'active-nav' : '' }} "><i class="fa fa-box-open"></i><span>الطلبات</span></a> --}}
        @if(auth()->check())
            <a href="{{ route('website.settings') }}" class="{{ (strpos(Route::currentRouteName(), 'website.settings') === 0) ? 'active-nav' : '' }} "><i class="fa fa-cog"></i><span>الإعدادات</span></a>
        @else
            <a href="{{ route('website.public_settings') }}" class="{{ (strpos(Route::currentRouteName(), 'website.public_settings') === 0) ? 'active-nav' : '' }} "><i class="fa fa-cog"></i><span>الإعدادات</span></a>
        @endif
    </div>
</div>
