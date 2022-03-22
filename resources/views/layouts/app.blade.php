<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>


    @include('seo.index')
    <link rel="stylesheet" type="text/css" href="https://nafezly.com/css/cust-fonts.css">
    <link rel="stylesheet" type="text/css" href="https://nafezly.com/css/fontawsome.min.css">
    <link rel="stylesheet" type="text/css" href="https://nafezly.com/css/responsive-font.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

    <link rel="stylesheet" type="text/css" href="{{asset('/css/font-fileuploader.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.fileuploader.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.fileuploader-theme-dragdrop.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/main.css')}}">
    {!!$settings->header_code!!}
    @notifyCss
    @livewireStyles
    @if(auth()->check())
        @php
        if(session('seen_notifications')==null)
            session(['seen_notifications'=>0]);
        $notifications=auth()->user()->notifications()->orderBy('created_at','DESC')->limit(50)->get();
        $unreadNotifications=auth()->user()->unreadNotifications()->count();
        @endphp
    @endif
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        body,*{
            direction: rtl;
            text-align: start;

        }
        html{
            font-size: 16px;
        }
        /**:not(.fileuploader):not([class^=fa]):not([class^=vj]):not([class^=tie-]) {
            font-family: dubai, sans-serif;
        }*/
        .start-head {
            height: 20px;
            width: 12px;
            display: inline-block;
            background: #0194fe;
            position: relative;
            top: 5px;
            margin-left: 5px;
        }
        .main-box-stylex{
            box-shadow: 0 8px 16px 0 rgb(10 14 29 / 2%), 0 8px 64px 0 rgb(119 119 119 / 8%);
        }
    </style>
    @yield('styles')
</head>
<body>
    @yield('after-body')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">دخول</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">تسجيل</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        لوحة التحكم
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        تسجيل خروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="p-0">
            @yield('content')
        </main>
    </div>

    <input type="hidden" id="current_selected_editor">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>

    <script src="{{asset('/js/jquery.fileuploader.min.js')}}"></script>
    <script src="{{asset('/js/validatorjs.min.js')}}"></script>
    <script src="{{asset('/js/favicon_notification.js')}}"></script>
    <script src="{{asset('/js/main.js')}}"></script>
    @livewireScripts
    @notifyJs
    @include('layouts.scripts')
    @yield('scripts')

    <script>
        $(document).on("change", ".category_id", function () {


            var category_id = $(this).val();
            let attribute=$(this).parent().parent().find('.attribute');
            if (category_id) {

                $.ajax({
                    url: "{{ URL::to('ar/category') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        (attribute).empty();
                        $.each(data, function (key, value) {
                            // $(attribute).append('<option value="">اختر السمة</option>');

                            $(attribute).append('<option value="' + value['attribute']['id'] + '">' + value['attribute']['name']['ar'] + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
        $(document).on("change", ".attribute", function () {


            var attribute_id = $(this).val();

            let option=$(this).parent().parent().find('.option_id');
            if (attribute_id) {

                $.ajax({
                    url: "{{ URL::to('ar/attribute') }}/" + attribute_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        (option).empty();
                        $.each(data, function (key, value) {

                            $(option).append('<option value="' + value['id'] + '">' + value['name']['ar'] + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
        $(document).on("change", ".option_id", function () {


            var option_id = $(this).val();

            let price=$(this).parent().parent().find('.price');
            if (option_id) {

                $.ajax({
                    url: "{{ URL::to('ar/option') }}/" + option_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $(".price").empty();

                        $.each(data, function (key, value) {

                            $(".price").val(value); // could be done with a timeout to make sure the DOM inserting is done
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });

        var sum=0;
        var a = [];
        var b=[]
        $(document).on("change", ".option_price", function () {
            var _this=$(this);
            var attribute_id=_this.parent().find('input').val();

            $('.option_price').each(function(i, obj) {
                a[attribute_id]=parseInt($(this).val().trim());
                b[i]=a[attribute_id]
            });

            console.log(b);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                data: {b},
                url: "{{route('front.option')}}",
                success: function(msg){
                    $('.answer').html(msg);
                }
            });

        });

        $(document).on("change", ".total", function() {
            var sum = 0;
            alert(sum);
            $(".total").each(function(){
                sum += +$(this).val();
            });
            $(".total_v2").val(sum);
        });

    </script>
    {!!$settings->footer_code!!}
</body>
</html>
