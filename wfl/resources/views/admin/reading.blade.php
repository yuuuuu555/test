@extends('common/layouts')
@section('content')
@include('common/selectA')
<div>
@include('common/message')
</div>
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
                @if(empty($reading))
                无正在借阅的书籍，快去预约吧！！
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
                @foreach ($reading as $readings)
                    <tr>
                        <th scope="row">{{ $readings->BookId }}</th>
                        <td>{{ $readings->BookName }}</td>
                        <td>{{ $readings->author }}</td>
                        <td>{{ $readings->UserId }}</td>
                        <td>{{ $readings->UserName }}</td>
                        <td>{{ $readings->status($readings->status)}}</td>
                        <td>{{ date('Y-m-d H:i:s', $readings->created_at) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $readings->updated_at) }}</td>
                        <td><a href="{{ url('admin/appointingDetail', ['id' => $readings->id]) }}">详情</a>

                            <a href="{{ url('admin/give_back', ['id' => $readings->id])}}"
                                onclick="if(confirm('检查书籍无误且是否完善，并确定是否归还书籍') == false) return false;">归还书籍</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div><div>
        <ul class="pagination pull-right">
            <div class="pull-right"></div>
            {{ $reading->render() }}
        </ul>
    </div>

    </div>
@endif
@stop
