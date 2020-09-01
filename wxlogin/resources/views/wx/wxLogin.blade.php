<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<div>
    <form method="POST" action="">
    <td>请选择绑定还是新账号</td>
    <div class="form-group"><label for="id" class="col-sm-2 control-label">账号</label>
        <div class="col-sm-5">
            <input type="text" name="wx_id" 
                value="" class="form-control"
                id="wx_id" placeholder="请输入"></div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger"></p>
        </div>
    </div>
    <div class="form-group"><label for="id" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-5">
            <input type="text" name="wx_password" 
                value="" class="form-control"
                id="wx_password" placeholder="请输入"></div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger"></p>
        </div>
    </div>
    <button type="submit" href="{{ url('wxRegister') }}" class="list-group-item 
    {{ Request::getPathInfo() == '/wxRegister' ? 'active' : '' }}">绑定已有账号</button>
    <button type="submit" >注册新账号</button>
</div>

<?php
// if (isset($_POST)) {
//     var_dump($_POST);
// }


?>





</form>
</body>

</html>
