@extends('common.layouts')

@section('content')
<div class="panel panel-default">
                <div class="panel-heading">书籍详情</div>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <td width="50%">ID</td>
                        <td>{{$books->id}}</td>
                    </tr>
                    <tr>
                        <td>书籍名称</td>
                        <td>{{$books->name}}</td>
                    </tr>
                    <tr>
                        <td>作者</td>
                        <td>{{$books->author}}</td>
                    </tr>
                    <tr>
                        <td>出版社</td>
                        <td>{{$books->publisher}}</td>
                    </tr>
                    <tr>
                        <td>分类</td>
                        <td>{{$books->status($books->status)}}</td>
                    </tr>
                    <tr>
                        <td>状态</td>
                        <td>{{$books->classification($books->classification)}}</td>
                    </tr>
                    <tr>
                        <td>添加日期</td>
                        <td>{{date('Y-m-d',$books->craeted_at)}}</td>
                    </tr>
                    <tr>
                        <td>最后修改</td>
                        <td>{{date('Y-m-d',$books->updated_at)}}</td>
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
