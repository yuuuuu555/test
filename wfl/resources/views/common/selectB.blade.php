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
    <div class="form-group" align = "center">书籍状态与书籍分类
        {{-- <label for="Booksss[classification]" class="col-sm-2 control-label" >书籍状态与书籍分类</label> --}}
        <select name="Books[status]">
            <option>显示所有</option>
            <option>显示有存量的</option>
        </select>
        <select name="Books[classification]">
            {{-- {{}} --}}
            <option type="select" name="Books[classification]">所有分类</option>
            @foreach ($booksss->classification() as $ind => $val)
                <option type="select" name="Books[classification]"
                    {{ $booksss->classification() == $ind ? 'checked' : '' }} value="{{ $ind }}">
                    {{ $val }}
                </option>
            @endforeach
        </select>
        <button ype="submit" onclick="javascript:this.form.action='booksSelectRetrieval'">检索</button>
    </div>

</form>

