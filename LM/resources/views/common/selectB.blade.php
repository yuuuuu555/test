<form class="form-horizontal" method="GET" action="">
    <div class="form-group"><label for="data" class="col-sm-2 control-label"></label>
        <div class="col-sm-5"><input type="text" name="Books[data]" value="" class="form-control" id="data"
                placeholder="请输入">
        </div>
        <button type="submit" onclick="javascript:this.form.action='booksSelectID'">书籍编号搜索</button>
        <button type="submit" onclick="javascript:this.form.action='booksSelectName'">书名搜索</button>
        <p class="form-control-static text-danger"></p>
    </div>
</form>
<form class="form-horizontal" method="GET" action="">
    <div class="form-group"><label for="Booksss[classification]" class="col-sm-2 control-label">书籍状态</label>
        <select name="Booksss[classification]">
            <option>显示所有</option>
            <option>显示有存量的</option>

        </select>
        <button ype="submit" onclick="javascript:this.form.action='booksSelectRetrieval'">检索</button>
    </div>
</form>
<form class="form-horizontal" method="GET" action="">
    <div class="form-group"><label for="status" class="col-sm-2 control-label">书籍分类</label>
        <select name="Books[status]">
            @foreach ($booksss->status() as $ind => $val)

                <option type="select" name="Books[status]"
                    {{ $booksss->status() == $ind ? 'checked' : '' }} value="{{ $ind }}">
                    {{ $val }}
                </option>
            @endforeach
        </select>
        <button type="submit" onclick="javascript:this.form.action='booksSelectStatus'">分类</button>
    </div>
</form>
