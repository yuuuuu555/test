<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        .contain p {
            font-size: 15px;
            color: red;
        }
    
    </style>
    @include('common.validator')
    @include('common.message')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">注册</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="">
                @csrf
                <div class="form-group"><label for="account" class="col-sm-2 control-label">账号</label>
                    <div class="col-sm-5"><input type="text" name="Users[account]" {{-- 保持已填数据old
                            判断是否提交的数据，如果不是就从数据库调取--}} {{--
                            新建页面进入无传值所以没有数据就用old 而修改页面在usercontroller里的方法传值进来 --}}
                            value="{{ isset(old('Users')['name']) ? old('Users')['account'] : $users->account }}"
                            class="form-control" id="account" placeholder="请输入姓名"></div>
                    <div class="contain">
                        <p>{{ $errors->first('Users.account') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="name" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-5"><input type="text" name="Users[name]" {{-- 保持已填数据old
                            判断是否提交的数据，如果不是就从数据库调取--}} {{--
                            新建页面进入无传值所以没有数据就用old 而修改页面在usercontroller里的方法传值进来 --}}
                            value="{{ isset(old('Users')['name']) ? old('Users')['name'] : $users->name }}"
                            class="form-control" id="name" placeholder="请输入姓名"></div>
                    <div class="contain">
                        <p>{{ $errors->first('Users.name') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="age" class="col-sm-2 control-label">年龄</label>
                    <div class="col-sm-5"><input type="text" name="Users[age]"
                            value="{{ isset(old('Users')['name']) ? old('Users')['age'] : $users->age }}"
                            class="form-control" id="age" placeholder="请输入年龄"></div>
                    <div class="contain">
                        <p>{{ $errors->first('Users.age') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="sex" class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-5">
                        {{-- ???????????????????????????????????
                        --}}
                        <select name="Users[sex]">
                            @foreach ($users->sex() as $ind => $val)
                                <label class="radio-inline">
                                    <option type="select" name="Users[sex]" 
                                    {{ $users->sex() == $ind ? 'checked' : '' }} value="{{ $ind }}">
                                    {{ $val }}
                                        {{-- <input type="radio" name="Users[sex]"
                                            {{ $users->sex() == $ind ? 'checked' : '' }} value="{{ $ind }}">{{ $val }}
                                        --}}
                                </label>
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="contain">
                        <p>{{ $errors->first('Users.sex') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="phone" class="col-sm-2 control-label">手机</label>
                    <div class="col-sm-5"><input type="text" name="Users[phone]"
                            value="{{ isset(old('Users')['name']) ? old('Users')['phone'] : $users->phone }}"
                            class="form-control" id="phone" placeholder="请输入年龄"></div>
                    <div class="contain">
                        <p>{{ $errors->first('Users.phone') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-5"><input type="text" name="Users[password]"
                            value="{{ isset(old('Users')['name']) ? old('Users')['password'] : $users->password }}"
                            class="form-control" id="password" placeholder="请输入密码"></div>
                    <div class="contain">
                        <p>{{ $errors->first('Users.password') }}</p>
                    </div>
                </div>
                <div>
                    <div><label for="code" class="col-sm-2 control-label">验证码</label></div>
                    <div>
                        <input type="code" name="Users[Code]" value="" class="form-control" id="publisher" placeholder="请输入验证码">
                        {{-- 由于浏览器刷新时会查找有无缓存，如果有则不会重新加载，所以在后面加上一个随机数让他重新加载
                        --}}
                        <img src="{{ url('loginCode') }}" alt="" onclick="this.src='{{ url('loginCode') }}?'+Math.random()">
                    </div>
                    <div class="contain">
                        <p>{{ $errors->first('Users.Code') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
            <div>
                <a href="{{url('loginIndex')}}">返回登录界面</a>
                </div>
        </div>
    </div>
</body>
</html>