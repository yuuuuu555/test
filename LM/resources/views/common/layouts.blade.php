<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>图书管理 - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    @section('Style')
    @show
</head>

<body>
    <!-- 头部 -->
    @section('header')
        <div class="jumbotron">
            <div class="container">
                <h2>图书管理</h2>
                <p>管理员</p>
            </div>
        </div>
        <!-- 中间内容区域 -->
        <div class="container">
            <div class="row">
                <!-- 左侧菜单区域 -->
                <div class="col-md-3">
                @section('leftmenu')

                    {{-- 跳转与选中 --}}
                    <div class="list-group">
                        <a href="{{ url('usersIndex') }}" class="list-group-item 
                        {{ Request::getPathInfo() == '/usersIndex' ? 'active' : '' }}">用户列表</a>
                        <a href="{{ url('usersCreate') }}" class="list-group-item 
                        {{ Request::getPathInfo() == '/usersCreate' ? 'active' : '' }}">新增用户</a>
                        <a href="{{ url('booksIndex') }}" class="list-group-item 
                        {{ Request::getPathInfo() == '/booksIndex' ? 'active' : '' }}">图书列表</a>
                        <a href="{{ url('booksCreate') }}" class="list-group-item 
                        {{ Request::getPathInfo() == '/booksCreate' ? 'active' : '' }}">新增图书</a>
                    </div>
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
        <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
        </script>
        @section('javascript')
        @show
</body>

</html>
