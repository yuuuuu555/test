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
        @section('Style')
    @show
</head>
<style>
li{
		list-style:none;
	}
    a{
        text-decoration:none;
    }
    </style>
<body>
    <!-- 头部 -->
    <div class="jumbotron">
        @yield('header')
        <div class="container">

            <div style="float:right;;margin-left:10px;">
                <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" 
                       data-toggle="dropdown">
                       <?php
                       session_start();
                       echo $_SESSION['user']['name'];
                       ?> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <li><a href="{{ url('usersUpdate', ['id' => $_SESSION['user']->id]) }}">个人信息</a></li>
                        <li><a href="{{url('loginout')}}" 
                            onclick="if(confirm('确定退出？') == false) return false;">退出登录</a></li>
                    </ul>
                </li>
            </div>
            <div>
                <?php
                // session_start();
                echo $_SESSION['user']['rola'];
                // $rola = $_SESSION['user']['rola'];
                ?> 
            </div>
        </div>
    </div>
        <!-- 中间内容区域 -->
        <div class="container">
            <div class="row">
                <!-- 左侧菜单区域 -->
                <div class="col-md-3">
                    @section('leftmenu')
                    @if($_SESSION['user']['rola'] !== '用户')
                        {{-- 跳转与选中 --}}
                        <div class="list-group">
                            <a href="{{ url('usersIndex') }}" class="list-group-item 
                                {{ Request::getPathInfo() == '/usersIndex' ? 'active' : '' }}">用户列表</a>
                            <a href="{{ url('usersCreate') }}" class="list-group-item 
                                {{ Request::getPathInfo() == '/usersCreate' ? 'active' : '' }}">新增用户</a>
                            <a href="{{ url('booksIndexM') }}" class="list-group-item 
                                {{ Request::getPathInfo() == '/booksIndexM' ? 'active' : '' }}">图书列表</a>
                            <a href="{{ url('booksCreate') }}" class="list-group-item 
                                {{ Request::getPathInfo() == '/booksCreate' ? 'active' : '' }}">新增图书</a>
                        </div>

                        @else
                        <div class="list-group">
                        <a href="{{ url('booksIndexU') }}" class="list-group-item 
                                {{ Request::getPathInfo() == '/booksIndexU' ? 'active' : '' }}">图书列表</a>
                        </div>
                        @endif
                    @show
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
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous">
            </script>
            @section('javascript')
            @show
</body>

</html>
