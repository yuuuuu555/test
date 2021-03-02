<div>
    逾期{{$time}}
</div>
<div>
    需缴纳{{$pay}}元
</div>
<div>
    <a href="{{ url('admin/pay_out', ['id' => $id])}}"
        onclick="if(confirm('检查书籍无误且是否完善，并确定是否归还书籍，确认是否缴清拖欠金额') == false) return false;">确认缴清</a>
</div>

<div>
    <a href="{{ url('admin/reading')}}">未还款</a>
</div>
