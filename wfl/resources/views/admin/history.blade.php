@extends('common/layouts')
@section('content')
@include('common/selectH')
@include('common/message')
    <?php
                // session_start();
                // $user = $_SESSION['user'];
                // dd(Auth::user());
                ?>
    <div class="panel panel-default">
        <div class="panel-heading">预约中的书籍列表</div>
        <table class="table table-striped table-hover table-responsive">
            <tbody>
                {{-- 遍历获取 --}}
                @if($history == '0')
                无正在预约的书籍，快去预约吧！！
                @else

                <thead>
                    <tr>
                        <th>书籍ID</th>
                        <th>书籍名称</th>
                        <th>书籍作者</th>
                        <th>预约用户ID</th>
                        <th>预约用户姓名</th>
                        <th>预约状态</th>
                        <th>起始时间</th>
                        <th>结束时间</th>
                        <th width="120">操作</th>
                    </tr>
                </thead>
                @foreach ($history as $historys)
                    <tr>
                        <th scope="row">{{ $historys->BookId }}</th>
                        <td>{{ $historys->BookName }}</td>
                        <td>{{ $historys->author }}</td>
                        <td>{{ $historys->UserId }}</td>
                        <td>{{ $historys->UserName }}</td>
                        <td>{{ $historys->status($historys->status)}}</td>
                        <td>{{ date('Y-m-d H:i:s', $historys->created_at) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $historys->updated_at) }}</td>
                        <td><a href="{{ url('admin/appointingDetail', ['id' => $historys->id]) }}">详情</a>

                            <a href="{{ url('admin/historyDelete', ['id' => $historys->id]) }}"
                                onclick="if(confirm('确定删除此记录？') == false) return false;">删除记录</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div><div>
        <ul class="pagination pull-right">
            <div class="pull-right"></div>
            {{ $history->render() }}
        </ul>
    </div>

    </div>
@endif
@stop
