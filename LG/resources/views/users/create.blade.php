@extends('common.layouts')

@section('content')
    @include('common.validator')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">新增用户</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="">
                @csrf
                <div class="form-group"><label for="account" class="col-sm-2 control-label">账号</label>
                    <div class="col-sm-5"><input type="text" name="Users[account]" {{-- 保持已填数据old
                            判断是否提交的数据，如果不是就从数据库调取--}} {{--
                            新建页面进入无传值所以没有数据就用old 而修改页面在usercontroller里的方法传值进来 --}}
                            value="{{ isset(old('Users')['name']) ? old('Users')['account'] : $users->name }}"
                            class="form-control" id="account" placeholder="请输入账号"></div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Users.name') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-5"><input type="text" name="Users[password]" {{-- 保持已填数据old
                            判断是否提交的数据，如果不是就从数据库调取--}} {{--
                            新建页面进入无传值所以没有数据就用old 而修改页面在usercontroller里的方法传值进来 --}}
                            value="{{ isset(old('Users')['name']) ? old('Users')['password'] : $users->name }}"
                            class="form-control" id="password" placeholder="请输入密码"></div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Users.name') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="phone" class="col-sm-2 control-label">手机号码</label>
                    <div class="col-sm-5"><input type="text" name="Users[phone]" {{-- 保持已填数据old
                            判断是否提交的数据，如果不是就从数据库调取--}} {{--
                            新建页面进入无传值所以没有数据就用old 而修改页面在usercontroller里的方法传值进来 --}}
                            value="{{ isset(old('Users')['name']) ? old('Users')['phone'] : $users->name }}"
                            class="form-control" id="phone" placeholder="请输入电话"></div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Users.name') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="name" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-5"><input type="text" name="Users[name]" {{-- 保持已填数据old
                            判断是否提交的数据，如果不是就从数据库调取--}} {{--
                            新建页面进入无传值所以没有数据就用old 而修改页面在usercontroller里的方法传值进来 --}}
                            value="{{ isset(old('Users')['name']) ? old('Users')['name'] : $users->name }}"
                            class="form-control" id="name" placeholder="请输入姓名"></div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Users.name') }}</p>
                    </div>
                </div>
                <div class="form-group"><label for="age" class="col-sm-2 control-label">年龄</label>
                    <div class="col-sm-5"><input type="text" name="Users[age]"
                            value="{{ isset(old('Users')['name']) ? old('Users')['age'] : $users->age }}"
                            class="form-control" id="age" placeholder="请输入年龄"></div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Users.age') }}</p>
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
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Users.sex') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
