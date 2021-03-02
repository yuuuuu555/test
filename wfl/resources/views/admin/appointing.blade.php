@extends('common/layouts')
@section('content')
@include('common/selectA')
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
                @if($appointing == '0')
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
                @foreach ($appointing as $appointings)
                    <tr>
                        <th scope="row">{{ $appointings->BookId }}</th>
                        <td>{{ $appointings->BookName }}</td>
                        <td>{{ $appointings->author }}</td>
                        <td>{{ $appointings->UserId }}</td>
                        <td>{{ $appointings->UserName }}</td>
                        <td>{{ $appointings->status($appointings->status)}}</td>
                        <td>{{ date('Y-m-d H:i:s', $appointings->created_at) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $appointings->updated_at) }}</td>
                        <td><a href="{{ url('admin/appointingDetail', ['id' => $appointings->id]) }}">详情</a>

                            <a href="{{ url('admin/booksCancel', ['id' => $appointings->id])}}"
                                onclick="if(confirm('确定取消预约此书么？如果取消后再次预约可能会重新进行排队。') == false) return false;">取消预约</a>
                            <a href="{{ url('admin/lend', ['id' => $appointings->id])}}"
                                onclick="if(confirm('确定借出此书么？请确认。') == false) return false;">借出书籍</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div><div>
        <ul class="pagination pull-right">
            <div class="pull-right"></div>
            {{ $appointing->render() }}
        </ul>
    </div>

    </div>
@endif
@stop
