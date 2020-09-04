@extends('common/layouts')
@section('content')
    @include('common/message')
    @include('common/selectU')
    <div class="panel panel-default">
        <div class="panel-heading">用户列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>年龄</th>
                    <th>性别</th>
                    <th>添加时间</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
                {{-- 遍历获取 --}}
                @foreach ($userss as $users)
                    <tr>
                        <th scope="row">{{ $users->id }}</th>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->age }}</td>
                        <td>{{ $users->sex($users->sex) }}</td>
                        <td>{{ date('Y-m-d', $users->created_at) }}</td>
                        <td><a href="{{ url('usersDetail', ['id' => $users->id]) }}">详情</a>
                            <a href="{{ url('usersUpdate', ['id' => $users->id]) }}">修改</a>
                            <a href="{{ url('usersDelete', ['id' => $users->id]) }}"
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
            {{ $userss->render() }}
        </ul>
    </div>
    </div>

@stop
