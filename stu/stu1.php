<?php
    $filename = 'stu.txt';
    $stu = [];
    //判断有无此文件
    if(file_exists($filename)){
        $stu = file($filename); //用里面的内容赋值给$stu
            foreach($stu as $k=>$value){
                $stu[$k] = json_decode($value,true);
            }
    }
    $page_num = 4;//一页显示的数量
    $count = count($stu);//获得元素的数量
    $now_page = isset($_GET['page'])?$_GET['page']:1;//先判断是否有赋值，没有就1，这样进来就不会报错
    // 用$_GET获取网址上的page并赋值到$now_page
    $total_page = ceil($count/$page_num);//用ceil计算总页数的一进一发取整，并赋值
    if($now_page < $total_page){
        $next_page = $now_page + 1;
    }else {
        $next_page = $total_page;
    }//判断下一页是否超过总页数
    if($now_page > 1){
        $last_page = $now_page - 1;
    }else {
        $last_page = 1;
    }//判断上一页是否还有
    $offset = ($now_page-1) * $page_num;//页码
    $list = array_slice($stu, $offset, $page_num);//从数组钟抽出一段 在数组$stu的$page下标开始抽$page_num个元素
    //下面的foreach循环就变成循环$list
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>学生列表</title>
</head>
<body>
    <h3 style="text-align: center;"><a href="stu3.php">添加信息</a></h3>
    <hr />
    <h3 style="text-align: center;">学生列表</h3>
    <table
        width="600" border="1" align="center">
        <tr>
            <th>姓名</th>
            <th>性别</th>
            <th>操作</th>
        </tr>
        <!-- <tr
            align="center">
            -$k为下标 -->
            <?php
            foreach ($list as $value) {
                echo "<tr align='center'><td>{$value['name']}</td><td>".($value['sex']==1?'男':'女')."</td><td><a href = 'stu4.php?name={$value['name']}'>修改</a>|<a href = ''>删除</a></td></tr>'";
                //在地址栏上显示修改的人的姓名
            }
            ?>
        <tr>
            <td colspan = "4" align = "right">
                <?php echo $now_page.'/'.$total_page; ?>
                <a href = "?page=<?php echo $last_page;?>">上一页</a>
                <a href = "?page=<?php echo $next_page;?>">下一页</a><!-- n = $next_page上传到地址栏-->
            </td>
        </tr>
        <!-- </tr> -->
    </table>
</body>
</html> 