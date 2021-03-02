@extends('common/layouts')
@section('content')
    <?php
                // session_start();
                // $user = $_SESSION['user'];
                // dd(Auth::user());
                ?>
    <div class="panel panel-default">
        <div class="panel-heading">历史预约列表</div>
        <table class="table table-striped table-hover table-responsive">

            <tbody>
                {{-- 遍历获取 --}}
                @if(empty($history))
                无预约过的书籍记录，快去预约吧！！
                @else
                <thead>
                    <tr>
                        <th>书籍ID</th>
                        <th>书籍名称</th>
                        <th>书籍作者</th>
                        <th>预约状态</th>
                        <th>存入图书馆时间</th>
                        <th width="120">操作</th>
                    </tr>
                </thead>
                @foreach ($history as $historys)
                    <tr>
                        <th scope="row">{{ $historys->BookId }}</th>
                        <td>{{ $historys->BookName }}</td>
                        <td>{{ $historys->author }}</td>
                        <td>{{ $historys->status($historys->status)}}</td>
                        <td>{{ date('Y-m-d', $historys->created_at) }}</td>
                        <td><a href="{{ url('user/booksDetail', ['id' => $historys->BookId]) }}">详情</a>

                            <a href="{{ url('user/booksAppointment', ['idB' => $historys->BookId, 'idU' => auth::user()->id])}}"
                                onclick="if(confirm('确定再次预约此书么？') == false) return false;">预约</a>
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
