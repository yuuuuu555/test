@extends('common.layouts')

@section('content')
<link rel="stylesheet" type="text/css" href="./style.css">

<script type="text/javascript" src="./jquery.min.js"></script>
<script type="text/javascript" src="./vector.js"></script>

<script src="{{ URL::asset('./static/layouts/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('./static/layouts/js/vector.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('./static/layouts/css/style.css') }}">

<div id="container">
	<div id="output">
		<div class="containerT">
			<h1>用户注册</h1>
			<form class="form" id="entry_form" method="POST" action="{{ route('register') }}">
				@csrf
				<div>

					<input type="text" placeholder="姓名" id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
					@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
				</div>
				<div>

					<input type="text" placeholder="账号" id="account" type="account" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="account" autofocus>
					@error('account')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
                </div>
                <div>

					<input type="text" placeholder="邮箱" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
					@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
                </div>
                <div>
					<input type="password" placeholder="密码" id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
                <div>

					<input type="password" placeholder="再次输入密码" id="password-confirm" type="password" class="form-control  @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
				</div>
				<button type="submit" id="entry_btn">注册</button>
				<div id="prompt" class="prompt"></div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function(){
        Victor("container", "output");   //登陆背景函数
        $("#entry_name").focus();
        $(document).keydown(function(event){
            if(event.keyCode==13){
                $("#entry_btn").click();
            }
        });
    });
</script>

</body>
</html>
