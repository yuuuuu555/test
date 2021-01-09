<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>

    <style>
        .contain p {
            font-size: 15px;
            color: red;
        }
    
    </style>
    <div>

    <div>
        @include('common.message')
    </div>

        <form method="POST" action="">
            @csrf
            <div>
                <div>
                    <input type="text" name="Users[Account]" value="" class="form-control" id="publisher" placeholder="请输入账号">
                </div>
                <div class="contain">
                    <p >{{ $errors->first('Users.Account') }}</p>
                </div>
            </div>
            <div>
                <div>
                    <input type="password" name="Users[Password]" value="" class="form-control" id="publisher"
                        placeholder="请输入密码">
                </div>
                <div class="contain">
                    <p>{{ $errors->first('Users.Password') }}</p>
                </div>
            </div>
            <div>
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
            <div>
                <select name="Users[rola]">
                    <label>
                    <option type = "select" name = "Users[rola]">
                        用户
                    </option>
                    <option type = "select" name = "Users[rola]">
                        管理员
                    </option>
                    </label>
                </select>
            </div>
            <button>登录</button>
        </form>
    </div>
<div>
<a href="{{url('register')}}">注册</a>
</div>
</body>

</html>
