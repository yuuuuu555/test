@extends('common.layouts')

@section('content')
<div class="panel panel-default">
                <div class="panel-heading">预约详情</div>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <td width="50%">ID</td>
                        <td>{{$appointing->id}}</td>
                    </tr>
                    <tr>
                        <td>用户账号</td>
                        <td>{{$appointing->account}}</td>
                    </tr>
                    <tr>
                        <td>预约用户姓名</td>
                        <td>{{$appointing->UserName}}</td>
                    </tr>
                    <tr>
                        <td>预约用户ID</td>
                        <td>{{$appointing->UserId}}</td>
                    </tr>
                    <tr>
                        <td>书籍名称</td>
                        <td>{{$appointing->BookName}}</td>
                    </tr>
                    <tr>
                        <td>作者</td>
                        <td>{{$appointing->author}}</td>
                    </tr>
                    <tr>
                        <td>书籍状态</td>
                        <td>{{$appointing->status($appointing->status)}}</td>
                    </tr>
                    <tr>
                        <td>书籍分类</td>
                        <td>{{$appointing->classification($appointing->classification)}}</td>
                    </tr>
                    <tr>
                        <td>添加日期</td>
                        <td>{{date('Y-m-d',$appointing->craeted_at)}}</td>
                    </tr>
                    <tr>
                        <td>最后修改</td>
                        <td>{{date('Y-m-d',$appointing->updated_at)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <a type="button" class="btn btn-primary" href="{{url()->previous()}}">返回</a>
        </div>
        </div>
    </div>
</div>
@stop
