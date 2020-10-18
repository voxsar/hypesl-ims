<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link href="{{asset('css/themes/lite-purple.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/plugins/perfect-scrollbar.min.css')}}" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css">
        @stack('css')
        <script src="https://kit.fontawesome.com/3ba891c68b.js" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="text-left">
        <div class="app-admin-wrap layout-sidebar-compact sidebar-dark-purple clearfix">
            <div class="main-content-wrap d-flex flex-column">
                <div id="app" class="main-content">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="{{asset('js/plugins/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/plugins/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('js/scripts/script.min.js')}}"></script>
        <script src="{{asset('js/scripts/sidebar.compact.script.min.js')}}"></script>
        <script src="{{asset('js/scripts/customizer.script.min.js')}}"></script>
        <script src="{{asset('js/plugins/echarts.min.js')}}"></script>
        <script src="{{asset('js/scripts/echart.options.min.js')}}"></script>
        <script src="{{asset('js/scripts/dashboard.v1.script.min.js')}}"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js" type="text/javascript"></script>
        @stack('scripts')
        @stack('models')
    </body>
</html>