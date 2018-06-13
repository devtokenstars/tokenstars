@php
    $lang = app('translator')->getLocale()
@endphp

<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <title>{{ trans('tokenstars-meta.index.title') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="title" content="{{ trans('tokenstars-meta.index.title') }}">
    <meta name="keywords" content="{{ trans('tokenstars-meta.index.keywords') }}">
    <meta name="description" content="{{ trans('tokenstars-meta.index.description') }}">

    <meta property="og:title" content="{{ trans('tokenstars-meta.index.og_title') }}"/>
    <meta property="og:description" content="{{ trans('tokenstars-meta.index.og_description') }}"/>
    <meta property="og:image" content="http://tokenstars.com/images/ace/og_image.jpg">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content= "{{ app('url')->current() }}" />

    <meta name="yandex-verification" content="eff113c081bf5af4" />
    <meta name="google-site-verification" content="2pPYktLC9TJhKxrmrWlh30p3eXSRq-MbLVHewsZqdic" />

    <link rel="icon" href="/favicon.ico?v=4">

    <link href="/build/lib.css" rel="stylesheet" />
    <link href="/build/landing-ace-v2.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,500,700&amp;subset=cyrillic" rel="stylesheet">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MHSBF5V');</script>
    <!-- End Google Tag Manager -->
    <script>
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
            results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        function paramToCookie(name) {
            param = getParameterByName(name)
            if(param != null && param != '') {
                setCookie(name, param, 100);
            }
        }

        if(document.referrer.indexOf("tokenstars.com") >=0 ) {
            setCookie("referrer", encodeURIComponent(document.referrer), 100);
        }
        paramToCookie("utm_source");
        paramToCookie("utm_medium");
        paramToCookie("utm_campaign");
        paramToCookie("utm_content");
        function addParam(param) {
            val = getCookie(param);
            if (!val) {
                val = getParameterByName(param);
            }
            res = "";
            if(val) {
                res = param + "=" + val;
            }
            return res;
        }

        function addParams(el_id) {
            params = [
                addParam("referrer"),
                addParam("utm_source"),
                addParam("utm_medium"),
                addParam("utm_campaign"),
                addParam("utm_content")
            ];
            params = params.filter(function(n){ return !!n;}).join("&");
            if(params) {
                if(document.getElementById(el_id)) {
                    document.getElementById(el_id).href += "?" + params;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function(){
            addParams("welcome-index-link-1");
            addParams("welcome-index-link-2");
            addParams("welcome-index-link-3");
        });
    </script>

</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45563499 = new Ya.Metrika({
                    id:45563499,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45563499" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHSBF5V"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/61f763f9dedebee4d6576f14efe8714e_1.js" async></script>
<header class="header--index">
    <div class="wrap wrap--narrow">
        <div class="header-logo header-logo--big">
            <img class="header-logo__image header-logo__image--big" alt="" src="/images/logo-platform-white.png" />
            <p class="header-logo__label">@lang('tokenstars-messages.menu.index_label')</p>
        </div>
        <div class="header-nav__mob-menu j-mob-menu"><span></span> <span></span> <span></span></div>
        <nav class="header-nav j-header-nav">
            <ul class="header-nav__list">
                <li class="header-nav__listitem header-nav__listitem--big">
                    <div class="header-nav__lang">
                        <i class="header-nav__flag flag-{{ $lang }}"></i>
                        <select class="header-nav__lang_selector j-lang-selector">
                            <option {{ $lang == 'en' ? 'selected' : '' }} value="/en">English</option>
                            <option {{ $lang == 'ru' ? 'selected' : '' }} value="/ru">Русский</option>
                            <option {{ $lang == 'ko' ? 'selected' : '' }} value="/ko">한국어</option>
                            <option {{ $lang == 'zh' ? 'selected' : '' }} value="/zh">中文（简体）</option>
                            <option {{ $lang == 'jp' ? 'selected' : '' }} value="/jp">日本語</option>
                        </select>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>
<section class="index-main-section alt-bg-color">
    <section class="section-holder">
        <div class="wrap wrap--narrow">
            <div class="row">
                <div class="col-md-4 push-md-4">
                    <a href="/team/" class="vertical-box">
                        <p class="big-font-size index-green-color medium-font infinite pulse">@lang('tokenstars-messages.verticals.success')</p>
                        <img class="vertical-box_image big-margin-before" src="/images/verticals/team.png">
                        <h2 class="vertical-box_title bold-font big-margin-before">TEAM</h2>
                        <label class="sub-title-size medium-font medium-margin-before">@lang('tokenstars-messages.verticals.rising_stars')</label>
                    </a>
                </div>
                <div class="col-md-4 pull-md-4">
                    <a href="/ace/" class="vertical-box">
                        <p class="big-font-size index-green-color medium-font">@lang('tokenstars-messages.verticals.success')</p>
                        <img class="vertical-box_image big-margin-before" src="/images/verticals/ace.png">
                        <h2 class="vertical-box_title bold-font big-margin-before">ACE</h2>
                        <label class="sub-title-size medium-font medium-margin-before">@lang('tokenstars-messages.verticals.tennis_players')</label>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="vertical-box vertical-box--disabled">
                        <p class="big-font-size medium-font">@lang('tokenstars-messages.verticals.soon')</p>
                        <img class="vertical-box_image big-margin-before" src="/images/verticals/star-disabled.png">
                        <h2 class="vertical-box_title bold-font big-margin-before">STAR</h2>
                        <label class="sub-title-size medium-font medium-margin-before">@lang('tokenstars-messages.verticals.celebrities')</label>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <a href="https://tokenstars.com/charity" target="_blank" class="section-holder christmas-banner j-christmas-banner">
            <div class="wrap wrap--narrow">
                <div class="christmas-close phone-only j-christmas-close">
                    <img src="/images/ace/tech-version/close-icon-red.png">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="christmas-banner-text">
                            <p class="big-font-size">@lang('tokenstars-messages.christmas.subtitle')</p>
                            <h3 class="title-size bold-font">@lang('tokenstars-messages.christmas.title')</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 huge-margin-before">
                        <div class="christmas-banner-images">
                            <img class="" src="/images/christmas/hingis.png"><img class="" src="/images/christmas/matthaus.png"><img class="" src="/images/christmas/redfoo.png"><img class="" src="/images/christmas/datsyuk.png"><img class="" src="/images/christmas/haas.png">
                        </div>
                    </div>
                </div>
            </div>
        </a>

    <section class="section-holder why section-top-line">
        <div class="why-bg"></div>
        <div class="wrap wrap--narrow">
            <div>
                <h2 class="section-title section-title--labeled bold-font">@lang('tokenstars-messages.why.blockchain')</h2>
                <p class="section-title-label">@lang('tokenstars-messages.why.index_label')</p>
            </div>
            <div class="row auto-clear">
                <div class="col-lg-4 col-md-6 huge-margin-before">
                    <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature1.title')</h3>
                    <p class="medium-margin-before">@lang('tokenstars-messages.why.feature1.text')</p>
                </div>
                <div class="col-lg-4 col-md-6 huge-margin-before">
                    <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature2.title')</h3>
                    <p class="medium-margin-before">@lang('tokenstars-messages.why.feature2.text')</p>
                </div>
                <div class="col-lg-4 col-md-6 huge-margin-before">
                    <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature3.title')</h3>
                    <p class="medium-margin-before">@lang('tokenstars-messages.why.feature3.text')</p>
                </div>
                <div class="col-lg-4 col-md-6 huge-margin-before">
                    <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature4.title')</h3>
                    <p class="medium-margin-before">@lang('tokenstars-messages.why.feature4.text')</p>
                </div>
                <div class="col-lg-4 col-md-6 huge-margin-before">
                    <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature5.title')</h3>
                    <p class="medium-margin-before">@lang('tokenstars-messages.why.feature5.text')</p>
                </div>
                <div class="col-lg-4 col-md-6 huge-margin-before">
                    <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature6.title')</h3>
                    <p class="medium-margin-before">@lang('tokenstars-messages.why.feature6.text')</p>
                </div>
            </div>
        </div>
    </section>
</section>

<footer class="footer">
    <div class="wrap wrap--narrow">
        <div class="row">
            <div class="col-md-6">
                <div class="big-margin-before">
                    <a href="/upload/files/privacy.pdf" target="_blank" class="footer-terms">@lang('tokenstars-messages.footer.privacy')</a>
                    <a href="/upload/files/terms.pdf" target="_blank" class="footer-terms">@lang('tokenstars-messages.footer.terms')</a>
                    <br />
                    <br />
                </div>
            </div>
            <div class="col-md-6">
                <div class="big-margin-before align-right">
                    <a href="mailto:ask@tokenstars.com" class="footer-mail">ask@tokenstars.com</a>
                    <br />
                    <br />
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset(mix('/build/scripts-min.js'))}}"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-103014111-1', 'auto');
    ga('require', 'linker');
    ga('linker:autoLink', ['teamtoken.tokenstars.com'] );
    ga('send', 'pageview');

    // Toggle mob menu
    $('.j-mob-menu').click(function() {
        $('.j-header-nav').toggleClass('opened');
        $('html').toggleClass('no-scroll')
    });
    $(window).on('resize', function(){
        $('.j-header-nav').removeClass('opened');
        $('html').removeClass('no-scroll')
    });



    // Lang selector
    $('.j-lang-selector').on('change blur', function( ) {
        location = this.value;
    });

</script>
</body>
</html>
