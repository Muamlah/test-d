$(window).on("load", function () { 
    $(".menu").css("display", "block"), $("#preloader").addClass("preloader-hide");
}),
    $(document).ready(function () {
        "use strict";
        var e, t, a, o;
        function i() {
            var e = [
                ["none", "", "", ""],
                ["plum", "#6772A4", "#6772A4", "#3D3949"],
                ["violet", "#673c58", "#673c58", "#492D3D"],
                ["magenta3", "#413a65", "#413a65", "#2b2741"],
                ["red3", "#c62f50", "#6F1025", "#6F1025"],
                ["green3", "#6eb148", "#2d7335", "#2d7335"],
                ["pumpkin", "#E96A57", "#C15140", "#C15140"],
                ["dark3", "#535468", "#535468", "#343341"],
                ["red1", "#D8334A", "#BF263C", "#9d0f23"],
                ["red2", "#ED5565", "#DA4453", "#a71222"],
                ["orange", "#FC6E51", "#E9573F", "#ce3319"],
                ["yellow1", "#FFCE54", "#F6BB42", "#e6a00f"],
                ["yellow2", "#E8CE4D", "#E0C341", "#dbb50c"],
                ["yellow3", "#CCA64F", "#996A22", "#996A22"],
                ["green1", "#A0D468", "#8CC152", "#5ba30b"],
                ["green2", "#2ECC71", "#2ABA66", "#0da24b"],
                ["mint", "#48CFAD", "#37BC9B", "#0fa781"],
                ["teal", "#A0CECB", "#7DB1B1", "#158383"],
                ["aqua", "#4FC1E9", "#3BAFDA", "#0a8ab9"],
                ["sky", "#188FB6", "#0F5F79", "#0F5F79"],
                ["blue1", "#4FC1E9", "#3BAFDA", "#0b769d"],
                ["blue2", "#5D9CEC", "#4A89DC", "#1a64c6"],
                ["magenta1", "#AC92EC", "#967ADC", "#704dc9"],
                ["magenta2", "#8067B7", "#6A50A7", "#4e3190"],
                ["pink1", "#EC87C0", "#D770AD", "#c73c8e"],
                ["pink2", "#fa6a8e", "#fb3365", "#d30e3f"],
                ["brown1", "#BAA286", "#AA8E69", "#896b43"],
                ["brown2", "#8E8271", "#7B7163", "#584934"],
                ["gray1", "#F5F7FA", "#E6E9ED", "#c2c5c9"],
                ["gray2", "#CCD1D9", "#AAB2BD", "#88919d"],
                ["dark1", "#656D78", "#434A54", "#242b34"],
                ["dark2", "#3C3B3D", "#323133", "#1c191f"],
            ];
            "scrollRestoration" in history && (history.scrollRestoration = "manual"),
                $("a").on("click", function () {
                    if ("#" === $(this).attr("href")) return !1;
                }),
                $(".menu-hider").length || $("#page").append('<div class="menu-hider"><div>'),
                ($.fn.showMenu = function () {
                    $(this).addClass("menu-active"),
                        $("#footer-bar").addClass("footer-menu-hidden"),
                        setTimeout(function () {
                            $(".menu-hider").addClass("menu-active");
                        }, 250);
                }),
                ($.fn.hideMenu = function () {
                    $(this).removeClass("menu-active"), $("#footer-bar").removeClass("footer-menu-hidden"), $(".menu-hider").removeClass("menu-active");
                });
            var t = $(".menu"),
                a = ($("body"), $(".nav-fixed"), $("#footer-bar")),
                o = $("body").find(".menu-hider"),
                i = ($(".close-menu"), $(".header")),
                s = ($("#page"), $(".page-content"), $(".header, .page-content, #footer-bar")),
                n = $("a[data-menu]");
            t.each(function () {
                var e = $(this).data("menu-height"),
                    t = $(this).data("menu-width");
                $(this).data("menu-active");
                $(this).hasClass("menu-box-right") && $(this).css("width", t),
                    $(this).hasClass("menu-box-left") && $(this).css("width", t),
                    $(this).hasClass("menu-box-bottom") && $(this).css("height", e),
                    $(this).hasClass("menu-box-top") && $(this).css("height", e),
                    $(this).hasClass("menu-box-modal") && $(this).css({ height: e, width: t });
            }),
                n.on("click", function () {
                    t.removeClass("menu-active"), o.addClass("menu-active");
                    var e = $(this).data("menu"),
                        a = $("#" + e),
                        i = $("#" + e).data("menu-effect"),
                        n = a.data("menu-width"),
                        r = a.data("menu-height");
                    $("body").addClass("modal-open"),
                        a.hasClass("menu-header-clear") && o.addClass("menu-active-clear"),
                        a.hasClass("menu-box-bottom") && $("#footer-bar").addClass("footer-menu-hidden"),
                        "menu-parallax" === i &&
                            (a.hasClass("menu-box-bottom") && s.css("transform", "translateY(" + (r / 5) * -1 + "px)"),
                            a.hasClass("menu-box-top") && s.css("transform", "translateY(" + r / 5 + "px)"),
                            a.hasClass("menu-box-left") && s.css("transform", "translateX(" + n / 5 + "px)"),
                            a.hasClass("menu-box-right") && s.css("transform", "translateX(" + (n / 5) * -1 + "px)")),
                        "menu-push" === i &&
                            (a.hasClass("menu-box-bottom") && s.css("transform", "translateY(" + -1 * r + "px)"),
                            a.hasClass("menu-box-top") && s.css("transform", "translateY(" + r + "px)"),
                            a.hasClass("menu-box-left") && s.css("transform", "translateX(" + n + "px)"),
                            a.hasClass("menu-box-right") && s.css("transform", "translateX(" + -1 * n + "px)")),
                        "menu-push-full" === i && (a.hasClass("menu-box-left") && s.css("transform", "translateX(100%)"), a.hasClass("menu-box-right") && s.css("transform", "translateX(-100%)")),
                        (a = a.addClass("menu-active"));
                });
            var r = $("[data-auto-activate]");
            function l(e, t, a) {
                if (a) {
                    var o = new Date();
                    o.setTime(o.getTime() + 48 * a * 60 * 3600 * 1e3);
                    var i = "; expires=" + o.toGMTString();
                } else i = "";
                document.cookie = e + "=" + t + i + "; path=/";
            }
            function d(e) {
                for (var t = e + "=", a = document.cookie.split(";"), o = 0; o < a.length; o++) {
                    for (var i = a[o]; " " == i.charAt(0); ) i = i.substring(1, i.length);
                    if (0 == i.indexOf(t)) return i.substring(t.length, i.length);
                }
                return null;
            }
            function c(e) {
                l(e, "", -1);
            }
            function h() {
                $("body").append('<style id="transitions-remove">.btn, .header, #footer-bar, .menu-box, .menu-active{transition:all 0ms ease!important;}</style>'),
                    setTimeout(function () {
                        $("body").find("#transitions-remove").remove();
                    }, 10);
            }
            r.length && (r.addClass("menu-active"), o.addClass("menu-active")),
                $("body").removeClass("modal-open"),
                $(".menu-hider, .close-menu, .menu-close").on("click", function () {
                    return (
                        t.removeClass("menu-active"),
                        o.removeClass("menu-active menu-active-clear"),
                        s.css("transform", "translate(0,0)"),
                        o.css("transform", "translate(0,0)"),
                        $("#footer-bar").removeClass("footer-menu-hidden"),
                        $("body").removeClass("modal-open"),
                        !1
                    );
                });
            var u = $("[data-toggle-theme-switch], [data-toggle-theme], [data-toggle-theme-switch] input, [data-toggle-theme] input");
            function m() {
                $("body").removeClass("theme-light").addClass("theme-dark"), $("#dark-mode-detected").removeClass("disabled"), c("sticky_light_mode"), l("sticky_dark_mode", !0, 1);
            }
            function p() {
                $("body").removeClass("theme-dark").addClass("theme-light"), $("#dark-mode-detected").removeClass("disabled"), c("sticky_dark_mode"), l("sticky_light_mode", !0, 1);
            }
            function g() {
                const e = window.matchMedia("(prefers-color-scheme: dark)").matches,
                    t = window.matchMedia("(prefers-color-scheme: light)").matches;
                window.matchMedia("(prefers-color-scheme: no-preference)").matches;
                window.matchMedia("(prefers-color-scheme: dark)").addListener((e) => e.matches && m()),
                    window.matchMedia("(prefers-color-scheme: light)").addListener((e) => e.matches && p()),
                    window.matchMedia("(prefers-color-scheme: no-preference)").addListener((e) => e.matches && void $("#manual-mode-detected").removeClass("disabled")),
                    e && m(),
                    t && p();
            }
            $("[data-toggle-theme], [data-toggle-theme-switch]").on("click", function () {
                h(),
                    $("body").toggleClass("theme-light theme-dark"),
                    setTimeout(function () {
                        $("body").hasClass("detect-theme") && $("body").removeClass("detect-theme"),
                            $("body").hasClass("theme-light") && (c("sticky_dark_mode"), u.prop("checked", !1), l("sticky_light_mode", !0, 1)),
                            $("body").hasClass("theme-dark") && (c("sticky_light_mode"), u.prop("checked", !0), l("sticky_dark_mode", !0, 1));
                    }, 150);
            }),
                d("sticky_dark_mode") && (u.prop("checked", !0), $("body").removeClass("theme-light").addClass("theme-dark")),
                d("sticky_light_mode") && (u.prop("checked", !1), $("body").removeClass("theme-dark").addClass("theme-light")),
                $("body").hasClass("detect-theme") && g(),
                $(".detect-dark-mode").on("click", function () {
                    return $("body").addClass("detect-theme"), g(), !1;
                }),
                $(".disable-auto-dark-mode").on("click", function () {
                    return $("body").removeClass("detect-theme"), $(this).remove(), !1;
                }),
                $(".footer-bar-2, .footer-bar-4, .footer-bar-5").length &&
                    ($(".footer-bar-2 strong, .footer-bar-4 strong, .footer-bar-5 strong").length || $(".footer-bar-2 .active-nav, .footer-bar-4 .active-nav, .footer-bar-5 .active-nav").append("<strong></strong>")),
                $(".back-button, [data-back-button]").on("click", function () {
                    window.history.go(-1);
                });
            var f = $(".copyright-year, #copyright-year"),
                b = new Date().getFullYear();
            f.html(b);
            var v = $(".back-to-top, [data-back-to-top], .back-to-top-badge, .back-to-top-icon"),
                C = $(".back-to-top-badge, .back-to-top-icon");
            function y() {
                C.removeClass("back-to-top-visible");
            }
            v.on("click", function (e) {
                return e.preventDefault(), $("html, body, .page-content").animate({ scrollTop: 0 }, 350), !1;
            });
            var k = $(".scroll-ad");
            function w() {
                k.removeClass("scroll-ad-visible");
            }
            $(window).on("scroll", function () {
                var e = document.body.scrollHeight,
                    t = $(this).scrollTop() <= 150,
                    a = $(this).scrollTop() >= 0,
                    o = ($(this).scrollTop(), $(this).scrollTop() >= e - ($(window).height() + 300));
                !0 === t ? (y(), w(), $(".header-auto-show").removeClass("header-active")) : !0 === a && (C.addClass("back-to-top-visible"), k.addClass("scroll-ad-visible"), $(".header-auto-show").addClass("header-active")),
                    1 == o && (y(), w());
            });
            var x,
                F = $(".tab-controls");
            F.length &&
                ((x = $(".tab-controls a")),
                F.each(function () {
                    var e = $(this).parent().find(".tab-controls").data("tab-items"),
                        t = ($(this).width(), $(this).find("a[data-tab-active]")),
                        a = $("#" + t.data("tab")),
                        o = $(this).data("tab-active");
                    $(this)
                        .find("a[data-tab]")
                        .css("width", 100 / e + "%"),
                        t.addClass(o),
                        t.addClass("color-white"),
                        a.slideDown(0);
                }),
                x.on("click", function () {
                    var e = $(this).data("tab"),
                        t = $("#" + e),
                        a = $(this).parent().parent().find(".tab-content"),
                        o = ((a = $(this).parent().parent().parent().find(".tab-content")), $(this).data("tab-order"), $(this).parent().parent().find(".tab-controls").data("tab-active"));
                    $(this).parent().find(x).removeClass(o).removeClass("color-white"),
                        $(this).addClass(o).addClass("color-white"),
                        $(this).parent().find("a").removeClass("no-click"),
                        $(this).addClass("no-click"),
                        a.slideUp(250),
                        t.slideDown(250);
                })),
                $(".text-size-increase").click(function () {
                    $(".text-size-changer *").css("font-size", "+=1");
                }),
                $(".text-size-decrease").click(function () {
                    $(".text-size-changer *").css("font-size", "-=1");
                }),
                $(".text-size-default").click(function () {
                    $(".text-size-changer *").css("font-size", "");
                }),
                $("[data-search]").on("keyup", function () {
                    var e = $(this).val();
                    "" != e
                        ? ($(".search-header a").removeClass("disabled"),
                          $(".search-trending").addClass("disabled"),
                          $(".search-results").removeClass("disabled-search-list"),
                          $("[data-filter-item]").addClass("disabled-search-item"),
                          $('[data-filter-item][data-filter-name*="' + e.toLowerCase() + '"]').removeClass("disabled-search-item"))
                        : ($(".search-header a").removeClass("disabled"), $(".search-trending").removeClass("disabled"), $(".search-results").addClass("disabled-search-list"), $("[data-filter-item]").removeClass("disabled-search-item"));
                    var t = $(".search-no-results");
                    $(".search-results").find(".search-result-list.disabled-search-item").length ? t.removeClass("disabled") : t.addClass("disabled");
                }),
                $(".search-trending a").on("click", function () {
                    (jQuery.Event("keydown").which = 32), $(".search-trending").addClass("disabled");
                    var e = $(this).find("span").text().toLowerCase();
                    return (
                        $(".search-header a").removeClass("disabled"),
                        $(".search-header input").val(e),
                        $(".search-results").removeClass("disabled-search-list"),
                        $("[data-filter-item]").addClass("disabled-search-item"),
                        $('[data-filter-item][data-filter-name*="' + e.toLowerCase() + '"]').removeClass("disabled-search-item"),
                        $(".menu-search-trending").addClass("disabled-search-item"),
                        !1
                    );
                }),
                $(".search-header a").on("click", function () {
                    return (
                        $(".search-trending").removeClass("disabled"),
                        $(".menu-search-trending").removeClass("disabled-search-item"),
                        $(".search-results").addClass("disabled-search-list"),
                        $(".search-header input").val(""),
                        $(this).addClass("disabled"),
                        !1
                    );
                }),
                setTimeout(function () {
                    $(".user-slider").owlCarousel({ rtl: !0, loop: !1, margin: 20, nav: !1, lazyLoad: !0, items: 1, autoplay: !1, dots: !1, autoplayTimeout: 4e3 }),
                        $(".single-slider").owlCarousel({ rtl: !0, loop: !0, margin: 20, nav: !1, lazyLoad: !0, items: 1, autoplay: !0, autoplayTimeout: 4e3 }),
                        $(".cover-slider").owlCarousel({ rtl: !0, loop: !0, margin: 0, nav: !1, lazyLoad: !0, items: 1, autoplay: !0, autoplayTimeout: 6e3 }),
                        $(".double-slider").owlCarousel({ rtl: !0, loop: !0, margin: 20, nav: !1, lazyLoad: !1, items: 2, autoplay: !0, autoplayTimeout: 4e3 }),
                        $(".f-slider").owlCarousel({ rtl: !0, loop: !0, margin: 0, nav: !1, lazyLoad: !1, items: 2, autoplay: !0, autoplayTimeout: 4e3 }),
                        $(".task-slider").owlCarousel({ rtl: !0, loop: !0, margin: 20, nav: !1, stagePadding: 50, lazyLoad: !0, items: 2, autoplay: !1, autoplayTimeout: 4e3 }),
                        $(".next-slide, .next-slide-arrow, .next-slide-text, .cover-next").on("click", function () {
                            $(this).parent().find(".owl-carousel").trigger("next.owl.carousel");
                        }),
                        $(".prev-slide, .prev-slide-arrow, .prev-slide-text, .cover-prev").on("click", function () {
                            $(this).parent().find(".owl-carousel").trigger("prev.owl.carousel");
                        }),
                        $(".next-slide-user").on("click", function () {
                            $(this).closest(".owl-carousel").trigger("next.owl.carousel");
                        }),
                        $(".prev-slide-user").on("click", function () {
                            $(this).closest(".owl-carousel").trigger("prev.owl.carousel");
                        });
                }, 100),
                setTimeout(function () {
                    $(".owl-prev, .owl-next").addClass("bg-highlight");
                });
            var A = {
                Android: function () {
                    return navigator.userAgent.match(/Android/i);
                },
                iOS: function () {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Windows: function () {
                    return navigator.userAgent.match(/IEMobile/i);
                },
                any: function () {
                    return A.Android() || A.iOS() || A.Windows();
                },
            };
            A.any() || ($("body").addClass("is-not-ios"), $(".show-ios, .show-android").addClass("disabled"), $(".show-no-device").removeClass("disabled")),
                A.Android() &&
                    ($("body").addClass("is-not-ios"),
                    $("head").append('<meta name="theme-color" content="#FFFFFF"> />'),
                    $(".show-android").removeClass("disabled"),
                    $(".show-ios, .show-no-device, .simulate-android, .simulate-iphones").addClass("disabled")),
                A.iOS() && ($("body").addClass("is-ios"), $(".show-ios").removeClass("disabled"), $(".show-android, .show-no-device, .simulate-android, .simulate-iphones").addClass("disabled")),
                $("[data-toast]").on("click", function () {
                    return $(".toast, .snackbar-toast, .notification").toast("hide"), $("#" + $(this).data("toast")).toast("show"), !1;
                }),
                $("[data-dismiss]").on("click", function () {
                    var e = $(this).data("dismiss");
                    $("#" + e).toast("hide");
                }),
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                }),
                $('[data-toggle="collapse"]').length &&
                    $('[data-toggle="collapse"]').on("click", function (e) {
                        e.preventDefault();
                    }),
                $(".ios-input, .android-input, .classic-input").on("click", function () {
                    var e = $(this).attr("id"),
                        t = $("[data-switch=" + e + "]");
                    t.length && t.stop().animate({ height: "toggle" }, 250);
                }),
                $("[data-activate]").on("click", function () {
                    var e = $(this).data("activate");
                    $("#" + e).trigger("click");
                }),
                $("[data-trigger-switch]").on("click", function () {
                    var e = $(this).data("trigger-switch");
                    $("#" + e).prop("checked") ? $("#" + e).prop("checked", !1) : $("#" + e).prop("checked", !0);
                });
            var D,
                T,
                E,
                z,
                q,
                M,
                L = $(".business-hours");
            function S() {
                if ($(".is-on-homescreen").length) {
                    var e = screen.height;
                    $(".page-content, #page").css("min-height", e);
                }
                if (!$(".is-on-homescreen").length) {
                    e = window.innerHeight;
                    $(".page-content, #page").css("min-height", e);
                }
                $("[data-card-height]").each(function () {
                    var t = $(this).data("card-height"),
                        o = $(".header").height(),
                        s = $("#footer-bar").height();
                    $(this).css("height", t),
                        "cover" == t &&
                            (i.length && a.length ? ($(this).css("height", e - o - s), $(".map-full, .map-full iframe").css("height", e - o - s + 14)) : ($(this).css("height", e), $(".map-full, .map-full iframe").css("height", e)));
                });
            }
            if (
                (L.length &&
                    (function () {
                        if (L.length) {
                            var e = new Date(Date.now()),
                                t = "day-" + new Date().toLocaleDateString("en", { weekday: "long" }).toLowerCase(),
                                a = (e.getHours(), e.getMinutes(), $("." + t)),
                                o = L.data("closed-message").toString(),
                                i = L.data("closed-message-under").toString(),
                                s = L.data("opened-message").toString(),
                                n = L.data("opened-message-under").toString();
                            $("[data-monday]").data("open"),
                                $("[data-monday]").data("close"),
                                $(".business-hours").openingTimes({
                                    openingTimes: { Monday: ["08:00", "17:00"], Tuesday: ["08:00", "17:30"], Wednesday: ["08:00", "17:00"], Thursday: ["08:00", "17:00"], Friday: ["09:00", "18:55"], Saturday: ["09:00", "12:00"] },
                                    openClass: "bg-green1-dark is-business-opened",
                                    closedClass: "bg-red2-dark is-business-closed",
                                }),
                                L.hasClass("is-business-opened")
                                    ? ($(".show-business-opened").removeClass("disabled"),
                                      $(".show-business-closed").addClass("disabled"),
                                      L.find("h1").html(s),
                                      L.find("p").html(n),
                                      L.find("#business-hours-mail").remove(),
                                      a.addClass("bg-green1-dark"))
                                    : ($(".show-business-opened").addClass("disabled"),
                                      $(".show-business-closed").removeClass("disabled"),
                                      L.find("h1").html(o),
                                      L.find("p").html(i),
                                      L.find("#business-hours-call").remove(),
                                      a.addClass("bg-red2-dark")),
                                a.find("p").addClass("color-white");
                        }
                    })(),
                (function (e, t, a) {
                    if (a in t && t[a]) {
                        var o,
                            i = e.location,
                            s = /^(a|html)$/i;
                        e.addEventListener(
                            "click",
                            function (e) {
                                for (o = e.target; !s.test(o.nodeName); ) o = o.parentNode;
                                "href" in o && (o.href.indexOf("http") || ~o.href.indexOf(i.host)) && (e.preventDefault(), (i.href = o.href));
                            },
                            !1
                        ),
                            $(".add-to-home").addClass("disabled"),
                            $("body").addClass("is-on-homescreen");
                    }
                })(document, window.navigator, "standalone"),
                $(".simulate-android-badge").on("click", function () {
                    $(".add-to-home").removeClass("add-to-home-ios").addClass("add-to-home-visible add-to-home-android");
                }),
                $(".simulate-iphone-badge").on("click", function () {
                    $(".add-to-home").removeClass("add-to-home-android").addClass("add-to-home-visible add-to-home-ios");
                }),
                $(".add-to-home").on("click", function () {
                    $(".add-to-home").removeClass("add-to-home-visible");
                }),
                $(".simulate-android-banner").on("click", function () {
                    $("#menu-install-pwa-android, .menu-hider").addClass("menu-active");
                }),
                $(".simulate-ios-banner").on("click", function () {
                    $("#menu-install-pwa-ios, .menu-hider").addClass("menu-active");
                }),
                S(),
                $(window).resize(function () {
                    S();
                }),
                $(".show-map, .hide-map").on("click", function () {
                    $(".map-full .caption").toggleClass("deactivate-map"), $(".map-but-1, .map-but-2").toggleClass("deactivate-map"), $(".map-full .hide-map").toggleClass("activate-map");
                }),
                $(".card-scale")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("card-scale-image");
                    }),
                $(".card-grayscale")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("card-grayscale-image");
                    }),
                $(".card-rotate")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("card-rotate-image");
                    }),
                $(".card-blur")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("card-blur-image");
                    }),
                $(".card-hide")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find(".card-center, .card-bottom, .card-top, .card-overlay").toggleClass("card-hide-image");
                    }),
                $("#reading-progress-text").each(function (e) {
                    var t = $(this).text().split(" ").length,
                        a = Math.floor(t / 250),
                        o = t % 60;
                    $(".reading-progress-words").append(t), $(".reading-progress-time").append(a + ":" + o);
                }),
                $("[data-auto-show-ad]").length)
            ) {
                var B = $("[data-auto-show-ad]").data("auto-show-ad");
                setTimeout(function () {
                    $("[data-auto-show-ad]").trigger("click");
                }, 1e3 * B);
            }
            $("[data-timed-ad]").on("click", function () {
                var e = $(this).data("timed-ad"),
                    t = $("#" + $(this).data("menu"));
                o.addClass("no-click"), t.find(".ad-time-close").addClass("no-click"), t.find(".ad-time-close i").addClass("disabled"), t.find(".ad-time-close span").removeClass("disabled");
                var a = setInterval(function () {
                    if (--e <= 0)
                        return o.removeClass("no-click"), t.find(".ad-time-close").removeClass("no-click"), t.find(".ad-time-close i").removeClass("disabled"), t.find(".ad-time-close span").addClass("disabled"), void clearInterval(a);
                    t.find(".ad-time-close span").html(e);
                }, 1e3);
            }),
                (D = "01/19/2030 03:14:07 AM"),
                (D = (D = new Date(D)).getTime()),
                isNaN(D) ||
                    setInterval(function () {
                        var e = new Date(),
                            t = ((e = new Date(e.getUTCFullYear(), e.getUTCMonth(), e.getUTCDate(), e.getUTCHours(), e.getUTCMinutes(), e.getUTCSeconds())), parseInt((D - e.getTime()) / 1e3));
                        t >= 0 &&
                            ((T = parseInt(t / 31536e3)),
                            (t %= 31536e3),
                            (E = parseInt(t / 86400)),
                            (t %= 86400),
                            (z = parseInt(t / 3600)),
                            (t %= 3600),
                            (q = parseInt(t / 60)),
                            (t %= 60),
                            (M = parseInt(t)),
                            $(".countdown").length &&
                                (($(".countdown #years")[0].innerHTML = parseInt(T, 10)),
                                ($(".countdown #days")[0].innerHTML = parseInt(E, 10)),
                                ($(".countdown #hours")[0].innerHTML = ("0" + z).slice(-2)),
                                ($(".countdown #minutes")[0].innerHTML = ("0" + q).slice(-2)),
                                ($(".countdown #seconds")[0].innerHTML = ("0" + M).slice(-2))));
                    }, 1),
                $(".accordion-btn").on("click", function () {
                    $(this).addClass("no-click"),
                        $(".accordion-icon").removeClass("rotate-180"),
                        "true" == $(this).attr("aria-expanded") ? $(this).parent().find(".accordion-icon").removeClass("rotate-180") : $(this).parent().find(".accordion-icon").addClass("rotate-180"),
                        setTimeout(function () {
                            $(".accordion-btn").removeClass("no-click");
                        }, 250);
                }),
                $(".caption-scale")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("caption-scale-image");
                    }),
                $(".caption-grayscale")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("caption-grayscale-image");
                    }),
                $(".caption-rotate")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("caption-rotate-image");
                    }),
                $(".caption-blur")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find("img").toggleClass("caption-blur-image");
                    }),
                $(".caption-hide")
                    .unbind()
                    .bind("mouseenter mouseleave touchstart touchend", function () {
                        $(this).find(".caption-center, .caption-bottom, .caption-top, .caption-overlay").toggleClass("caption-hide-image");
                    }),
                $(".upload-file").length &&
                    $(".upload-file").change(function (e) {
                        !(function (e) {
                            if (e.files && e.files[0]) {
                                var t = new FileReader();
                                (t.onload = function (e) {
                                    $(".file-data img").attr("src", e.target.result), $(".file-data img").attr("class", "img-fluid rounded-xs mt-4");
                                }),
                                    t.readAsDataURL(e.files[0]);
                            }
                        })(this),
                            e.target.files[0].name,
                            $(".upload-file-data").removeClass("disabled"),
                            $(".upload-file-name").html(e.target.files[0].name),
                            $(".upload-file-modified").html(e.target.files[0].lastModifiedDate),
                            $(".upload-file-size").html(e.target.files[0].size / 1e3 + "kb"),
                            $(".upload-file-type").html(e.target.files[0].type);
                    }),
                $(".todo-list").length &&
                    ($(".todo-list a").each(function () {
                        $(this).find(".todo-icon").hasClass("far fa-square") ? $(this).removeClass("opacity-70") : $(this).addClass("opacity-70");
                    }),
                    $(".todo-list a").on("click", function () {
                        $(this).find(".todo-icon").toggleClass("far fa-square fa fa-check-square color-green1-dark"), $(this).find(".todo-icon").hasClass("far fa-square") ? $(this).removeClass("opacity-70") : $(this).addClass("opacity-70");
                    })),
                $(".check-age").length &&
                    $(".check-age").on("click", function () {
                        var e = $("#date-birth-day").val(),
                            t = $("#date-birth-month").val(),
                            a = $("#date-birth-year").val(),
                            o = new Date();
                        o.setFullYear(a, t - 1, e);
                        var i = new Date(),
                            s = new Date();
                        return (
                            s.setFullYear(o.getFullYear() + 18, t - 1, e),
                            i - s > 0 ? ($("#menu-age").removeClass("menu-active"), $("#menu-age-okay").addClass("menu-active")) : ($("#menu-age").removeClass("menu-active"), $("#menu-age-fail").addClass("menu-active")),
                            !0
                        );
                    }),
                $(".get-location").length &&
                    ("geolocation" in navigator
                        ? $(".location-support").html('Your browser and device <strong class="color-green2-dark">support</strong> Geolocation.')
                        : $(".location-support").html('Your browser and device <strong class="color-red2-dark">support</strong> Geolocation.'),
                    $(".get-location").on("click", function () {
                        $(this).addClass("disabled"),
                            (function () {
                                const e = document.querySelector(".location-coordinates");
                                navigator.geolocation
                                    ? ((e.textContent = "Locating"),
                                      navigator.geolocation.getCurrentPosition(
                                          function (t) {
                                              const a = t.coords.latitude,
                                                  o = t.coords.longitude;
                                              e.innerHTML = "<strong>Longitude:</strong> " + o + "<br><strong>Latitude:</strong> " + a;
                                              var i = "http://maps.google.com/maps?q=",
                                                  s = a + ",",
                                                  n = i + s + o + "&z=18&t=h&output=embed",
                                                  r = i + s + o + "&z=18&t=h";
                                              $(".location-map").after('<iframe class="location-map" src="' + n + '"></iframe> <div class="clearfix"></div>'),
                                                  $(".location-map")
                                                      .parent()
                                                      .after(" <a href=" + r + ' class="btn btn-full btn-m bg-red2-dark rounded-xs text-uppercase font-900 mb-n1 mt-3">View on Google Maps</a>');
                                          },
                                          function () {
                                              e.textContent = "Unable to retrieve your location";
                                          }
                                      ))
                                    : (e.textContent = "Geolocation is not supported by your browser");
                            })();
                    }));
            var I,
                _,
                O,
                W = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i,
                H = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/,
                Z = /[A-Za-z]{2}[A-Za-z]*[ ]?[A-Za-z]*/,
                ASD = /^(?:[\u0009-\u000D\u001C-\u007E\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDCF\uFDF0-\uFDFF\uFE70-\uFEFF]|(?:\uD802[\uDE60-\uDE9F]|\uD83B[\uDE00-\uDEFF])){0,30}$/,
                Y = /[A-Za-z]{2}[A-Za-z]*[ ]?[A-Za-z]*/,
                R = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/,
                U = /^(?:[\u0009-\u000D\u001C-\u007E\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDCF\uFDF0-\uFDFF\uFE70-\uFEFF]|(?:\uD802[\uDE60-\uDE9F]|\uD83B[\uDE00-\uDEFF])){0,30}$/,
                N = "<i class='fa fa-check color-green1-dark'></i>",
                G = "<i class='fa fa-exclamation-triangle color-red2-light'></i>";
            function V() {
                $(".offline-message").addClass("offline-message-active"),
                    $(".online-message").removeClass("online-message-active"),
                    setTimeout(function () {
                        $(".offline-message").removeClass("offline-message-active");
                    }, 2e3);
            }
            function j() {
                $(".online-message").addClass("online-message-active"),
                    $(".offline-message").removeClass("offline-message-active"),
                    setTimeout(function () {
                        $(".online-message").removeClass("online-message-active");
                    }, 2e3);
            }
            $(".input-required input, .input-required select, .input-required textarea").on("focusin keyup", function () {
                var e = $(this).parent().find("span").text();
                $(this).val() != e && "" != $(this).val() && ($(this).parent().find("span").addClass("input-style-1-active").removeClass("input-style-1-inactive"), $(this).parent().find("span").addClass("focus-act")),
                    "" === $(this).val() && ($(this).parent().find("span").removeClass("input-style-1-inactive input-style-1-active"), $(this).parent().find("span").addClass("focus-act"));
            }),
                $(".input-required input.flatpickr").on("focusin keyup", function () {
                    var e = $(this).parent().find("span").text();
                    $(this).val() != e && "" != $(this).val() && ($(this).parent().find("span").addClass("input-style-1-active").removeClass("input-style-1-inactive"), $("input.flatpickr-input").removeClass("color-trn")),
                        "" === $(this).val() && ($(this).parent().find("span").removeClass("input-style-1-inactive input-style-1-active"), $("input.flatpickr-input").addClass("color-trn"));
                }),
                $(".input-required input, .input-required select, .input-required textarea").on("focusout", function () {
                    $(this).parent().find("span").text();
                    "" === $(this).val() && ($(this).parent().find("span").removeClass("input-style-1-inactive input-style-1-active"), $(this).parent().find("span").removeClass("focus-act")),
                        $(this).parent().find("span").addClass("input-style-1-inactive");
                }),
                $(".input-required select").on("focusout", function () {
                    var e = $(this)[0].value;
                    "default" === e && ($(this).parent().find("em").html(G), $(this).parent().find("span").removeClass("input-style-1-inactive input-style-1-active")), "default" != e && $(this).parent().find("em").html(N);
                }),
                $('.input-required input[type="email"]').on("focusout", function () {
                    W.test($(this).val()) ? $(this).parent().find("em").html(N) : "" === $(this).val() ? $(this).parent().find("em").html("(مطلوب)") : $(this).parent().find("em").html(G);
                }),
                $('.input-required input[type="tel"]').on("focusout", function () {
                    H.test($(this).val()) ? $(this).parent().find("em").html(N) : "" === $(this).val() ? $(this).parent().find("em").html("(مطلوب)") : $(this).parent().find("em").html(G);
                }),
                $('.input-required input[type="password"]').on("focusout", function () {
                    Y.test($(this).val()) ? $(this).parent().find("em").html(N) : "" === $(this).val() ? $(this).parent().find("em").html("(مطلوب)") : $(this).parent().find("em").html(G);
                }),
                $('.input-required input[type="url"]').on("focusout", function () {
                    R.test($(this).val()) ? $(this).parent().find("em").html(N) : "" === $(this).val() ? $(this).parent().find("em").html("(مطلوب)") : $(this).parent().find("em").html(G);
                }),
                $('.input-required input[type="name"]').on("focusout", function () {
                    Z.test($(this).val()) ? $(this).parent().find("em").html(N) : "" === $(this).val() ? $(this).parent().find("em").html("(مطلوب)") : $(this).parent().find("em").html(G);
                }),
                $('.input-required input[type="text"]').on("focusout", function () {
                    ASD.test($(this).val()) ? $(this).parent().find("em").html(N) : "" === $(this).val() ? $(this).parent().find("em").html("(مطلوب)") : $(this).parent().find("em").html(G);
                }),
                $(".input-required textarea").on("focusout", function () {
                    U.test($(this).val()) ? $(this).parent().find("em").html(N) : "" === $(this).val() ? $(this).parent().find("em").html("(مطلوب)") : $(this).parent().find("em").html(G);
                }),
                (Date.prototype.toDateInputValue = function () {
                    var e = new Date(this);
                    return e.setMinutes(this.getMinutes() - this.getTimezoneOffset()), e.toJSON().slice(0, 10);
                }),
                $('input[type="date"]').val(new Date().toDateInputValue()),
                (Date.prototype.toDateInputValue = function () {
                    var e = new Date(this);
                    return e.setMinutes(this.getMinutes() - this.getTimezoneOffset()), e.toJSON().slice(0, 10);
                }),
                $('input[type="date"]').val(new Date().toDateInputValue()),
                $(".offline-message").length ||
                    ($("body").append('<p class="offline-message bg-red2-dark color-white center-text uppercase ultrabold">No internet connection detected</p> '),
                    $("body").append('<p class="online-message bg-green1-dark color-white center-text uppercase ultrabold">You are back online</p>')),
                $(".simulate-offline").on("click", function () {
                    V();
                }),
                $(".simulate-online").on("click", function () {
                    j();
                }),
                window.addEventListener("online", function (e) {
                    navigator.onLine, j();
                }),
                window.addEventListener("offline", function (e) {
                    V();
                }),
                $(".generate-qr-result, .generate-qr-auto").length &&
                    ((I = window.location.href),
                    (_ = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data="),
                    null != (O = $(".generate-qr-auto").attr("rel")) && "" != O && (I = O),
                    $(".generate-qr-auto").attr("src", _ + I),
                    $(".generate-qr-button").on("click", function () {
                        if ($(this).parent().find(".fa").hasClass("fa-exclamation-triangle"));
                        else {
                            var e = $(".generate-qr-input").val();
                            "" == !e &&
                                ($(".generate-qr-result").empty(),
                                setTimeout(function () {
                                    $(".generate-qr-result").append('<img class="mx-auto polaroid-effect shadow-l mt-4 delete-qr" width="200" src="' + _ + e + '" alt="img"><p class="font-11 text-center mb-0">' + e + "</p>");
                                }, 30));
                        }
                    })),
                $("[data-vibrate]").length &&
                    ($("[data-vibrate]").on("click", function () {
                        var e = $(this).data("vibrate");
                        window.navigator.vibrate(e);
                    }),
                    $(".start-vibrating").on("click", function () {
                        var e = $(".vibrate-demo").val();
                        window.navigator.vibrate(e);
                    }),
                    $(".stop-vibrating").on("click", function () {
                        window.navigator.vibrate(0), $(".vibrate-demo").val("");
                    }));
            var P = window.location.href,
                X = document.title;
            $(".shareToFacebook").prop("href", "https://www.facebook.com/sharer/sharer.php?u=" + P),
                $(".shareToLinkedIn").prop("href", "https://www.linkedin.com/shareArticle?mini=true&url=" + P + "&title=" + X + "&summary=&source="),
                $(".shareToTwitter").prop("href", "https://twitter.com/home?status=" + P),
                $(".shareToPinterest").prop("href", "https://pinterest.com/pin/create/button/?url=" + P),
                $(".shareToWhatsApp").prop("href", "whatsapp://send?text=" + P),
                $(".shareToMail").prop("href", "mailto:?body=" + P);
            var J = $(".preload-img");
            $(function () {
                J.lazyload({ threshold: 500 });
            }),
                $("[data-lightbox]").addClass("default-link"),
                lightbox.option({ alwaysShowNavOnTouchDevices: !0, resizeDuration: 200, wrapAround: !1 }),
                $("#lightbox")
                    .hammer()
                    .on("swipe", function (e) {
                        4 === e.gesture.direction ? $("#lightbox a.lb-prev").trigger("click") : 2 === e.gesture.direction && $("#lightbox a.lb-next").trigger("click");
                    }),
                $(".gallery-filter").length > 0 && ($(".gallery-filter").filterizr(), $(".gallery-filter-active").addClass("color-highlight")),
                $(".gallery-filter-controls li").on("click", function () {
                    $(".gallery-filter-controls li").removeClass("gallery-filter-active color-highlight"), $(this).addClass("gallery-filter-active color-highlight");
                });
            var Q = $(".gallery-views"),
                K = $(".gallery-view-controls a"),
                ee = $(".gallery-view-1-activate"),
                te = $(".gallery-view-2-activate"),
                ae = $(".gallery-view-3-activate");
            ee.on("click", function () {
                K.removeClass("color-highlight"), $(this).addClass("color-highlight"), Q.removeClass().addClass("gallery-views gallery-view-1");
            }),
                te.on("click", function () {
                    K.removeClass("color-highlight"), $(this).addClass("color-highlight"), Q.removeClass().addClass("gallery-views gallery-view-2");
                }),
                ae.on("click", function () {
                    K.removeClass("color-highlight"), $(this).addClass("color-highlight"), Q.removeClass().addClass("gallery-views gallery-view-3");
                });
            var oe = $("[data-search]");
            oe.length &&
                oe.on("keyup", function () {
                    var e = $(this).val();
                    $(this).parent().parent().find("[data-filter-item]"),
                        "" != e
                            ? ($(".search-results").removeClass("disabled-search-list"),
                              $("[data-filter-item]").addClass("disabled-search"),
                              $('[data-filter-item][data-filter-name*="' + e.toLowerCase() + '"]').removeClass("disabled-search"))
                            : ($(".search-results").addClass("disabled-search-list"), $("[data-filter-item]").removeClass("disabled-search"));
                });
            var ie,
                se,
                ne,
                re,
                le = "false";
            if (
                (jQuery(document).ready(function (e) {
                    function t(t, a) {
                        e(".formValidationError").hide(),
                            e(".fieldHasError").removeClass("fieldHasError"),
                            e("#" + t + " .requiredField").each(function (a) {
                                if ("" == e(this).val() || e(this).val() == e(this).attr("data-dummy"))
                                    return e(this).val(e(this).attr("data-dummy")), e(this).focus(), e(this).addClass("fieldHasError"), e("#" + e(this).attr("id") + "Error").fadeIn(300), !1;
                                if (e(this).hasClass("requiredEmailField")) {
                                    var o = "#" + e(this).attr("id");
                                    if (!/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(e(o).val())) return e(o).focus(), e(o).addClass("fieldHasError"), e(o + "Error2").fadeIn(300), !1;
                                }
                                "false" == le &&
                                    a == e("#" + t + " .requiredField").length - 1 &&
                                    (function (t, a) {
                                        le = "true";
                                        var o = e("#" + t).serialize();
                                        e.post(e("#" + t).attr("action"), o, function (a) {
                                            e("#" + t).addClass("disabled"), $(".contact-form").addClass("disabled"), e(".formSuccessMessageWrap").fadeIn(500);
                                        });
                                    })(t);
                            });
                    }
                    e(".formSuccessMessageWrap").hide(0),
                        e(".formValidationError").fadeOut(0),
                        e('input[type="text"], input[type="password"], textarea').focus(function () {
                            e(this).val() == e(this).attr("data-dummy") && e(this).val("");
                        }),
                        e("input, textarea").blur(function () {
                            "" == e(this).val() && e(this).val(e(this).attr("data-dummy"));
                        }),
                        e(".contactSubmitButton").on("click", function () {
                            return t(e(this).attr("data-formId")), !1;
                        });
                }),
                $(".chart").length > 0)
            ) {
                (ie = "scripts/charts.js"),
                    (se = function () {
                        var e = $("#wallet-chart"),
                            t = $("#pie-chart"),
                            a = $("#doughnut-chart"),
                            o = $("#polar-chart"),
                            i = $("#vertical-chart"),
                            s = $("#horizontal-chart"),
                            n = $("#line-chart");
                        e.length &&
                            new Chart(e, {
                                type: "pie",
                                data: { labels: ["Expenses", "Income"], datasets: [{ backgroundColor: ["#ED5565", "#A0D468"], borderColor: "rgba(255,255,255,0.5)", data: [7e3, 3e3] }] },
                                options: {
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    legend: { display: !0, position: "bottom", labels: { fontSize: 13, padding: 15, boxWidth: 12 } },
                                    tooltips: { enabled: !0 },
                                    animation: { duration: 1500 },
                                },
                            }),
                            t.length &&
                                new Chart(t, {
                                    type: "pie",
                                    data: { labels: ["Facebook", "Twitter", "WhatsApp"], datasets: [{ backgroundColor: ["#4A89DC", "#4FC1E9", "#A0D468"], borderColor: "rgba(255,255,255,0.5)", data: [7e3, 3e3, 2e3] }] },
                                    options: {
                                        responsive: !0,
                                        maintainAspectRatio: !1,
                                        legend: { display: !0, position: "bottom", labels: { fontSize: 13, padding: 15, boxWidth: 12 } },
                                        tooltips: { enabled: !0 },
                                        animation: { duration: 1500 },
                                    },
                                }),
                            a.length &&
                                new Chart(a, {
                                    type: "doughnut",
                                    data: { labels: ["Apple", "Samsung", "Google"], datasets: [{ backgroundColor: ["#CCD1D9", "#5D9CEC", "#FC6E51"], borderColor: "rgba(255,255,255,0.5)", data: [5500, 4e3, 3e3] }] },
                                    options: {
                                        responsive: !0,
                                        maintainAspectRatio: !1,
                                        legend: { display: !0, position: "bottom", labels: { fontSize: 13, padding: 15, boxWidth: 12 } },
                                        tooltips: { enabled: !0 },
                                        animation: { duration: 1500 },
                                        layout: { padding: { bottom: 30 } },
                                    },
                                }),
                            o.length &&
                                new Chart(o, {
                                    type: "polarArea",
                                    data: { labels: ["Windows", "Mac", "Linux"], datasets: [{ backgroundColor: ["#CCD1D9", "#5D9CEC", "#FC6E51"], borderColor: "rgba(255,255,255,0.5)", data: [7e3, 1e4, 5e3] }] },
                                    options: {
                                        responsive: !0,
                                        maintainAspectRatio: !1,
                                        legend: { display: !0, position: "bottom", labels: { fontSize: 13, padding: 15, boxWidth: 12 } },
                                        tooltips: { enabled: !0 },
                                        animation: { duration: 1500 },
                                        layout: { padding: { bottom: 30 } },
                                    },
                                }),
                            i.length &&
                                new Chart(i, {
                                    type: "bar",
                                    data: {
                                        labels: ["2010", "2015", "2020", "2025"],
                                        datasets: [
                                            { label: "iOS", backgroundColor: "#A0D468", data: [900, 1e3, 1200, 1400] },
                                            { label: "Android", backgroundColor: "#4A89DC", data: [890, 950, 1100, 1300] },
                                        ],
                                    },
                                    options: { responsive: !0, maintainAspectRatio: !1, legend: { display: !0, position: "bottom", labels: { fontSize: 13, padding: 15, boxWidth: 12 } }, title: { display: !1 } },
                                }),
                            s.length &&
                                new Chart(s, {
                                    type: "horizontalBar",
                                    data: {
                                        labels: ["2010", "2013", "2016", "2020"],
                                        datasets: [
                                            { label: "Mobile", backgroundColor: "#BF263C", data: [330, 400, 580, 590] },
                                            { label: "Responsive", backgroundColor: "#EC87C0", data: [390, 450, 550, 570] },
                                        ],
                                    },
                                    options: { legend: { display: !0, position: "bottom", labels: { fontSize: 13, padding: 15, boxWidth: 12 } }, title: { display: !1 } },
                                }),
                            n.length &&
                                new Chart(n, {
                                    type: "line",
                                    data: {
                                        labels: [2e3, 2005, 2010, 2015, 2010],
                                        datasets: [
                                            { data: [500, 400, 300, 200, 300], label: "Desktop Web", borderColor: "#D8334A" },
                                            { data: [0, 100, 300, 400, 500], label: "Mobile Web", borderColor: "#4A89DC" },
                                        ],
                                    },
                                    options: { responsive: !0, maintainAspectRatio: !1, legend: { display: !0, position: "bottom", labels: { fontSize: 13, padding: 15, boxWidth: 12 } }, title: { display: !1 } },
                                });
                    }),
                    (ne = document.body),
                    ((re = document.createElement("script")).src = ie),
                    (re.onload = se),
                    (re.onreadystatechange = se),
                    ne.appendChild(re);
            }
            "file:" === window.location.protocol && $("a").on("mouseover", function () {});
            var de = $(".generated-styles"),
                ce = $(".generated-highlight");
            function he(e) {
                var t;
                if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(e))
                    return 3 == (t = e.substring(1).split("")).length && (t = [t[0], t[0], t[1], t[1], t[2], t[2]]), "rgba(" + [((t = "0x" + t.join("")) >> 16) & 255, (t >> 8) & 255, 255 & t].join(",") + ",0.3)";
            }
            !(function () {
                if (null == (t = d("sticky-color-scheme"))) var t = $("body").data("highlight");
                if (null == (a = d("sticky-bg-scheme"))) var a = $("body").data("background");
                var o = e.map((e) => e[0]);
                if (o.indexOf(t) > -1) {
                    var i = o.indexOf(t),
                        s = o.indexOf(a),
                        n = e[i][2],
                        r = e[s][3] + ", " + e[s][1],
                        l = ".color-highlight{color:" + n + "!important}",
                        c = ".bg-highlight, .page-item.active a{background-color:" + n + "!important}",
                        h = ".footer-bar-1 .active-nav *, .footer-bar-3 .active-nav i{color:" + n + "!important} .footer-bar-2 strong, .footer-bar-4 strong, .footer-bar-5 strong{background-color:" + n + "!important; color:#FFF;}",
                        u = ".border-highlight{border-color:" + n + "!important}",
                        m = ".header-tab-active{border-color:" + n + "!important}",
                        p = "#page{background: linear-gradient(0deg, " + r + ")!important;} .bg-page{background: linear-gradient(0deg, " + r + ")!important }";
                    ce.length ||
                        ($("body").append('<style class="generated-highlight"></style>'),
                        $("body").append('<style class="generated-background"></style>'),
                        $(".generated-highlight").append(l, c, h, u, m),
                        $(".generated-background").append(p));
                }
            })(),
                $("[data-change-highlight]").on("click", function (t) {
                    var a = $(this).data("change-highlight");
                    $("body").attr("data-highlight", a), $(".generated-highlight").remove(), l("sticky-color-scheme", a, 1);
                    var o = e.map((e) => e[0]);
                    if (o.indexOf(a) > -1) {
                        var i = o.indexOf(a);
                        if (void 0 !== $(this).data("color-light")) var s = e[i][1];
                        else s = e[i][2];
                        var n = ".color-highlight{color:" + s + "!important}",
                            r = ".bg-highlight{background-color:" + s + "!important}",
                            d =
                                ".active-nav *{color:" +
                                s +
                                "!important} .active-nav2 strong{background-color:" +
                                s +
                                "!important}  .active-nav3 strong{background-color:" +
                                s +
                                "!important} .active-nav4 strong{border-color:" +
                                s +
                                "!important}",
                            c = ".border-highlight{border-color:" + s + "!important}";
                        $("body").append('<style class="generated-highlight"></style>'), $(".generated-highlight").append(n, r, d, c);
                    }
                }),
                $("[data-change-background]").on("click", function (t) {
                    var a = $(this).data("change-background");
                    l("sticky-bg-scheme", a, 1), $(".generated-background").remove();
                    var o = e.map((e) => e[0]).indexOf(a),
                        i = e[o][3] + ", " + e[o][1],
                        s = "#page{background: linear-gradient(0deg, " + i + ")!important;} .bg-page{background: linear-gradient(0deg, " + i + ")!important}";
                    $("body").append('<style class="generated-background"></style>'), $(".generated-background").append(s);
                }),
                de.length ||
                    ($("body").append('<style class="generated-styles"></style>'),
                    $(".generated-styles").append("/*Generated using JS for lower CSS file Size, Easier Editing & Faster Loading*/"),
                    e.forEach(function (e) {
                        $(".generated-styles").append(
                            ".bg-" +
                                e[0] +
                                "-light{ background-color: " +
                                e[1] +
                                "!important; color:#FFFFFF!important;} .bg-" +
                                e[0] +
                                "-light i, .bg-" +
                                e[0] +
                                "-dark i{color:#FFFFFF;} .bg-" +
                                e[0] +
                                "-dark{  background-color: " +
                                e[2] +
                                "!important; color:#FFFFFF!important;} .border-" +
                                e[0] +
                                "-light{ border-color:" +
                                e[1] +
                                "!important;} .border-" +
                                e[0] +
                                "-dark{  border-color:" +
                                e[2] +
                                "!important;} .color-" +
                                e[0] +
                                "-light{ color: " +
                                e[1] +
                                "!important;} .color-" +
                                e[0] +
                                "-dark{  color: " +
                                e[2] +
                                "!important;}"
                        );
                    }),
                    e.forEach(function (e) {
                        $(".generated-styles").append(
                            ".bg-fade-" +
                                e[0] +
                                "-light{ background-color: " +
                                he(e[1]) +
                                "!important; color:#FFFFFF;} .bg-fade-" +
                                e[0] +
                                "-light i, .bg-" +
                                e[0] +
                                "-dark i{color:#FFFFFF;} .bg-fade-" +
                                e[0] +
                                "-dark{  background-color: " +
                                he(e[2]) +
                                "!important; color:#FFFFFF;} .border-fade-" +
                                e[0] +
                                "-light{ border-color:" +
                                he(e[1]) +
                                "!important;} .border-fade-" +
                                e[0] +
                                "-dark{  border-color:" +
                                he(e[2]) +
                                "!important;} .color-fade-" +
                                e[0] +
                                "-light{ color: " +
                                he(e[1]) +
                                "!important;} .color-fade-" +
                                e[0] +
                                "-dark{  color: " +
                                he(e[2]) +
                                "!important;}"
                        );
                    }),
                    e.forEach(function (e) {
                        $(".generated-styles").append(".bg-gradient-" + e[0] + "{background-image: linear-gradient(to bottom, " + e[1] + " 0, " + e[2] + " 100%)}");
                    }),
                    [
                        ["facebook", "#3b5998"],
                        ["linkedin", "#0077B5"],
                        ["twitter", "#4099ff"],
                        ["google", "#d34836"],
                        ["whatsapp", "#34AF23"],
                        ["pinterest", "#C92228"],
                        ["sms", "#27ae60"],
                        ["mail", "#3498db"],
                        ["dribbble", "#EA4C89"],
                        ["phone", "#27ae60"],
                        ["skype", "#12A5F4"],
                        ["instagram", "#e1306c"],
                    ].forEach(function (e) {
                        $(".generated-styles").append(".bg-" + e[0] + "{background-color:" + e[1] + "!important; color:#FFFFFF;} .color-" + e[0] + "{color:" + e[1] + "!important;}");
                    }),
                    e.forEach(function (e) {
                        $(".generated-styles").append(".body-" + e[0] + "{background-image: linear-gradient(to bottom, " + e[1] + " 0, " + e[3] + " 100%)}");
                    }));
        }
        if ((setTimeout(i, 0), 0)) {
            function i() {}
            (e = "/template-muamlah/scripts/pwa.js"), (t = i), (a = document.body), ((o = document.createElement("script")).src = e), (o.onload = t), (o.onreadystatechange = t), a.appendChild(o);
        }
        $(".toast-info").on("click", function (e) {
            $(this).children(".info-bubble").toggleClass("info-bubble-show");
        }),
            $("#name-edit").on("click", function (e) {
                $(".info-profile").removeClass("d-flex"), $(".edit-profile").removeClass("d-none"), $(".edit-name").removeClass("d-none");
            }),
            $("#excerpt-edit").on("click", function (e) {
                $(".info-profile").removeClass("d-flex"), $(".edit-profile").removeClass("d-none"), $(".edit-excerpt").removeClass("d-none");
            });
    });
