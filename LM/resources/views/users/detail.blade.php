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
                        <td>年龄</td>
                        <td>{{$users->age}}</td>
                    </tr>
                    <tr>
                        <td>性别</td>
                        <td>{{$users->sex($users->sex)}}</td>
                    </tr>
                    <tr>
                        <td>添加日期</td>
                        <td>{{date('Y-m-d',$users->craeted_at)}}</td>
                    </tr>
                    <tr>
                        <td>最后修改</td>
                        <td>{{date('Y-m-d',$users->updated_at)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop