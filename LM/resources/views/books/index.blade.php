@extends('common/layouts')
@section('content')
    @include('common/message')
    @include('common/selectB')
    <div class="panel panel-default">
        <div class="panel-heading">书籍列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>书籍名称</th>
                    <th>书籍作者</th>
                    <th>书籍出版社</th>
                    <th>书籍分类</th>
                    <th>书本状态</th>
                    <th>存入图书馆时间</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
                {{-- 遍历获取 --}}
                @foreach ($bookss as $books)
                    <tr>
                        <th scope="row">{{ $books->id }}</th>
                        <td>{{ $books->name }}</td>
                        <td>{{ $books->author }}</td>
                        <td>{{ $books->publisher }}</td>
                        <td>{{ $books->status($books->status) }}</td>
                        <td>{{ $books->classification($books->classification) }}</td>
                        <td>{{ date('Y-m-d', $books->created_at) }}</td>
                        <td><a href="{{ url('booksDetail', ['id' => $books->id]) }}">详情</a>
                            <a href="{{ url('booksUpdate', ['id' => $books->id]) }}">修改</a>
                            <a href="{{ url('booksDelete', ['id' => $books->id]) }}"
                                onclick="if(confirm('确定删除？') == false) return false;">删除</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- 分页 与控制器连用 直接贴代码即可 -->
    <div>
        <ul class="pagination pull-right">
            <div class="pull-right"></div>
            {{ $bookss->render() }}
        </ul>
    </div>

    </div>

@stop
