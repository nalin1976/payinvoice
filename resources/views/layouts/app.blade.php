<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Pay Invoices') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ URL::asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}">Home</a> &nbsp;&nbsp; &nbsp;&nbsp;
                                <a class="nav-link" href="{{url('/provider/create')}}">Create Provider</a> &nbsp;&nbsp;
                                <a class="nav-link" href="{{url('/provider/edit')}}">Edit Provider</a> &nbsp;&nbsp;

                            </li>


                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
