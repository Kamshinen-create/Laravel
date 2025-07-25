<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ getFile('icon', @$general->favicon) }}">
    <title>
        @if (@$general->sitename)
            {{ __(@$general->sitename) . '-' }}
        @endif
        {{ __(@$pageTitle) }}
    </title>


    <link href="{{ asset('asset/common/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/common/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/common/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/common/css/font-awsome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/common/css/iziToast.min.css') }}">
    <link href="{{ asset('asset/theme6/frontend/css/style.css') }}" rel="stylesheet">

    @stack('style')

</head>

<body>
    @if (@$general->preloader_status)
        <div id="preloader"></div>
    @endif

    @if (@$general->analytics_status)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ @$general->analytics_key }}"></script>
        <script>
            'use strict'
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());
            gtag("config", "{{ @$general->analytics_key }}");
        </script>
    @endif

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="d-flex flex-wrap align-items-center">
                <div class="logo me-auto me-lg-0 ">
                    <a href="{{ route('home') }}">
                        @if (@$general->whitelogo)
                            <img class="img-fluid rounded sm-device-img text-align"
                                src="{{ getFile('logo', @$general->whitelogo) }}" width="100%" alt="pp">
                        @else
                            <h4>{{ __('No Logo Found') }}</h4>
                        @endif
                    </a>
                </div>
            </div>
            <div class="header-right d-flex">
                <select class="changeLang" aria-label="Default select example">
                    @foreach ($language_top as $top)
                        <option value="{{ $top->short_code }}"
                            {{ session('locale') == $top->short_code ? 'selected' : '' }}>
                            {{ __(ucwords($top->name)) }}
                        </option>
                    @endforeach
                </select>
                <div class="dropdown ms-3">
                    <button class="dropdown-toggle user-toggle-menu" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        
                            <img src="{{ getFile('user', @Auth::user()->image, true) }}" alt="pp">
                        
                        <span class="ms-2">{{ auth()->user()->full_name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('user.2fa') }}">{{ __('2FA') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">{{ __('Settings') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.logout') }}">{{ __('Logout') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header><!-- End Header -->

    <main id="main" class="dashboard-main">
        <section class="dashboard-section">

            @include(template().'layout.user_sidebar')
            @yield('content2')
        </section>
    </main>

    @php
        $content = content('contact.content');
        $contentlink = content('footer.content');
        $footersociallink = element('footer.element');
        $serviceElements = element('service.element');
    @endphp

    <script src="{{ asset('asset/common/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/common/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/theme6/frontend/js/feather.min.js') }}"></script>
    <script src="{{ asset('asset/common/js/slick.min.js') }}"></script>
    <script src="{{ asset('asset/common/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('asset/theme6/frontend/js/user_dashboard.js') }}"></script>

    @stack('script')
    @if (@$general->twak_allow)
        <script type="text/javascript">
            'use strict'
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = "https://embed.tawk.to/{{ @$general->twak_key }}";
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            "use strict";
            iziToast.error({
                message: "{{ session('error') }}",
                position: 'topRight'
            });
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            "use strict";
            iziToast.success({
                message: "{{ session('success') }}",
                position: 'topRight'
            });
        </script>
    @endif

    @if (session()->has('notify'))
        @foreach (session('notify') as $msg)
            <script>
                "use strict";
                iziToast.{{ $msg[0] }}({
                    message: "{{ trans($msg[1]) }}",
                    position: "topRight"
                });
            </script>
        @endforeach
    @endif

    @if (@$errors->any())
        <script>
            "use strict";
            @foreach ($errors->all() as $error)
                iziToast.error({
                message: '{{ __($error) }}',
                position: "topRight"
                });
            @endforeach
        </script>
    @endif


    <script>
        'use strict'
        var url = "{{ route('user.changeLang') }}";

        $(".changeLang").change(function() {
            if ($(this).val() == '') {
                return false;
            }
            window.location.href = url + "?lang=" + $(this).val();
        });

        feather.replace();

        // responsive menu slideing
        $(".d-sidebar-menu>li>a").on("click", function() {
            var element = $(this).parent("li");
            if (element.hasClass("open")) {
                element.removeClass("open");
                element.find("li").removeClass("open");
                element.find("ul").slideUp(500, "linear");
            } else {
                element.addClass("open");
                element.children("ul").slideDown();
                element.siblings("li").children("ul").slideUp();
                element.siblings("li").removeClass("open");
                element.siblings("li").find("li").removeClass("open");
                element.siblings("li").find("ul").slideUp();
            }
        });

        $('.sidebar-open-btn').on('click', function() {
            $(this).toggleClass('active');
            $('.d-sidebar').toggleClass('active');
        });
    </script>
</body>

</html>
