<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::guard('admins')->check())
                                        {{ Auth::user()->name }} 
                                        <span class="caret"></span>
                                    @elseif(Auth::guard('students')->check())    
                                     {{ Auth::user()->name }} 
                                    
                                     @elseif(Auth::guard('teachers')->check())    
                                     {{ Auth::user()->name }} 
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">    
                                    @if(Auth::guard('admins')->check())
                                    <a class="dropdown-item" href="{{ url('admin/profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ url('admin/logout') }}">Logout</a>    
                                    @elseif(Auth::guard('students')->check())
                                     <a class="dropdown-item" href="{{ url('student/profile') }}">Profile</a>
                                     <a class="dropdown-item" href="{{ url('student/logout') }}">Logout</a>
                                     @elseif(Auth::guard('teachers')->check()) 
                                     <a class="dropdown-item" href="{{ url('teacher/profile') }}">Profile</a>
                                     <a class="dropdown-item" href="{{ url('teacher/logout') }}">Logout</a>
                                    @endif 
                                </div>
                            </li>
                        @endguest
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
<script type="text/javascript">
$(".alert-success,.alert-danger").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success,.alert-danger").slideUp(2000);
});
</script>