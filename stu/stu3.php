<?php
    //判断$_POST是否获取post表单
    if(!empty($_POST)){
        $student = $_POST;//将表单赋值给$student
        $student = json_encode($student);//将表单编译成为字符串
        $num = file_put_contents('stu.txt', $student."\n", FILE_APPEND);//将表单写入文件
        //判断是否写入文件
        if($num > 0){
            die("<script>alert('成功');location.href = 'stu1.php';</script>");
        }else{
            die("<script>alert('失败');location.href = 'stu3.php';</script>");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>信息录入</title>
</head>
<body>
    <form
        action=""
        method="post"><!-- 用于$_POST收集表单-->
        <p>姓名:<input
                type="text"
                name="name"
                value="">
        </p>
        <p>性别：<input
                type="radio"
                name="sex"
                value="1">男<input
                type="radio"
                name="sex"
                value="2"
                checked>女
        </p>
        <!--checked为默认选择-->
        <p><button>提交</button>
        </p>
    </form>
</body>
</html>
