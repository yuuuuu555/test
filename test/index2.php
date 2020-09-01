<?php
//$name = $_POST['name'];//post捕获name的信息
//判断name是否为空
//$student = [];//定义一个数组
//if(!empty($_POST)){
    // $name = $_POST['name'];
    // $sex = $_POST['sex'];

   //$studne = $_POST;//把获取的元素全部放进$studen里



   session_start();

   //判断$student有没有赋值
   //顺便获得通信信息赋值给$student
   $student = isset($_SESSION['student']) ? $_SESSION['student'] : [];


   var_dump($student);

//}
?>
<!DOCTYPE html>
<html
    lang="en">

<head>
    <meta
        charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>
        Document
    </title>
</head>

<body>
    <h3>添加信息
    </h3>

    <form
        action="index1.php"
        method="post">
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
    <hr />
    <h3>学生列表
    </h3>
    <table
        width="600"
        border="1">
        <tr>
            <th>姓名
            </th>
            <th>性别
            </th>

        </tr>
        <!-- <tr
            align="center">
            -$k为下标 -->
            <?php
            foreach($student as $value){
                echo '<tr align="center">';
                foreach($value as $k=>$v){
                    if($k == 'sex'){
                        echo "<td>".($v == 1?'男':'女')."</td>";
                    }else{
                        echo "<td>{$v}</td>";
                    }
                }
                echo '</tr>';
            }

            ?>
        <!-- </tr> -->
    </table>


</body>

</html> 