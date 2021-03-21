<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>图书管理 - @yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('./static/layouts/css/layouts.css') }}"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="{{ URL::asset('./static/layouts/js/jquery.min.js') }}"></script>
    {{-- 下拉框标签页 --}}
    <script src="{{ URL::asset('./static/layouts/js/bootstrap.min2.js') }}"></script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @section('Style')
    @show
</head>
<style>
    li {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

</style>

<body>
    <!-- 头部 -->
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="nav-link" href="{{ url('/') }}">
                    {{ config('图书管理系统', '图书管理系统') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('USER Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('ADMIN Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('USER Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                {{-- 登出事件 --}}
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- <main class="py-4">
            @yield('content')
        </main> --}}
    </div>
    <!-- 中间内容区域 -->
    <div class="container">
        <div class="row">
            <!-- 左侧菜单区域 -->
            <div class="col-md-3">
                @auth
                    @if (Auth::user()->role == 2)
                        {{-- 跳转与选中 --}}
                        <div class="list-group">
                            <a href="{{ url('admin/usersIndex') }}"
                                class="list-group-item
                                            {{ Request::getPathInfo() == 'admin/usersIndex' ? 'active' : '' }}">用户列表</a>
                            <a href="{{ url('admin/books') }}"
                                class="list-group-item
                                            {{ Request::getPathInfo() == 'admin/books' ? 'active' : '' }}">图书列表</a>
                            <a href="{{ url('admin/booksCreate') }}"
                                class="list-group-item
                                            {{ Request::getPathInfo() == 'admin/booksCreate' ? 'active' : '' }}">新增图书</a>
                            <a href="{{ url('admin/Appointing') }}"
                                class="list-group-item
                                            {{ Request::getPathInfo() == 'admin/Appointing' ? 'active' : '' }}">正在预约的书籍</a>
                                            <a href="{{ url('admin/reading') }}"
                                class="list-group-item
                                            {{ Request::getPathInfo() == 'admin/reading' ? 'active' : '' }}">正在借阅的书籍</a>
                            <a href="{{ url('admin/history') }}"
                                class="list-group-item
                                            {{ Request::getPathInfo() == 'admin/history' ? 'active' : '' }}">预约总记录</a>
                        </div>


                    @elseif(Auth::user()->role == 1)
                        {{-- 跳转与选中 --}}
                        <div class="list-group">

                            <a href="{{ url('user/books') }}"
                                class="list-group-item
                                                                    {{ Request::getPathInfo() == 'user/books' ? 'active' : '' }}">图书列表</a>
                            <a href="{{ url('user/userdetail', ['id' => Auth::user()->id]) }}"
                                class="list-group-item
                                                                    {{ Request::getPathInfo() == 'user/userdetail' ? 'active' : '' }}">个人信息</a>
                            <a href="{{ url('user/booksAppointing') }}"
                                class="list-group-item
                                                                    {{ Request::getPathInfo() == 'user/booksAppointing' ? 'active' : '' }}">正在预约的书籍</a>
                            <a href="{{ url('user/booksHistory') }}"
                                class="list-group-item
                                                                    {{ Request::getPathInfo() == 'user/booksHistory' ? 'active' : '' }}">历史预约记录</a>
                        </div>

                    @else
                    @endif
                @endauth


            </div>




            <!-- 右侧内容区域 -->
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
        <!-- 尾部 -->
        @section('footer')
            <div class="jumbotron" style="margin: 0;">
                <div class="container"><span> 2020 图书管理系统 </span></div>
            </div>
        @show
        <script src="{{ URL::asset('./static/layouts/js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('./static/layouts/js/bootstrap.min.js') }}"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
        </script>
        @section('javascript')
        @show
</body>

</html>
