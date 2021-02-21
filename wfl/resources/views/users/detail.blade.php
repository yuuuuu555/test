@extends('common.layouts')

@section('content')
<div class="panel panel-default">
                <div class="panel-heading">用户详情</div>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <td width="50%">ID</td>
                        <td>{{$users->id}}</td>
                    </tr>
                    <tr>
                        <td>姓名</td>
                        <td>{{$users->name}}</td>
                    </tr>
                    <tr>
                        <td>账号</td>
                        <td>{{$users->account}}</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>{{$users->email}}</td>
                    </tr>

                    </tbody>
                </table>
                <div>
                    <a type="button" class="btn btn-primary" href="{{url()->previous()}}">返回</a>
            </div>
            </div>
        </div>
    </div>
</div>
@stop
