
<form class="form-horizontal" method="GET" action="">
<div class="form-group"><label for="data" class="col-sm-2 control-label"></label>
    <div class="col-sm-5"><input type="text" name="Users[data]"
            value=""
            class="form-control" id="data" placeholder="请输入">
        </div>
            <button type="submit" onclick="javascript:this.form.action='usersSelectID'">ID搜索</button>
            <button type="submit" onclick="javascript:this.form.action='usersSelectName'">名字搜索</button>
        <p class="form-control-static text-danger"></p>
</div>
</form>
