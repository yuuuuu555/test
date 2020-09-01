<?php
    function find_student($stu, $name){//在数组$stu,里面找元素$name，name已用$_GET获得
        $result = [];//创建一个空数组
        foreach($stu as $key=>$student){//遍历数组获得的元素存放在$student中 下标名存放到$key
            if($student['name'] == $name){//判断如果存放元素的$student的值刚好等于$name获取的值
                $result = array_merge($student,['id'=>$key]);//将$student与(将$key获取到的下标用id来指向它)俩个数组合并，并赋值给$result
            break;
            }
        }
        if(empty($result)){//判断$result是否为空数组
            $ret = '查无此人';
        }else {
            $ret = $result;//如果不是就赋值
        }
        return $ret;//返回一个值
    }
    $filename = 'stu.txt';
    $name = $_GET['name'];
    //拿到班级信息
    $stu = [];
    //判断有无此文件
    if(file_exists($filename)){
        $stu = file($filename); //用里面的内容赋值给$stu
            foreach($stu as $k=>$value){
                $stu[$k] = json_decode($value,true);
            }
    }
    $info = find_student($stu,$name);//从找人函数里获取name值并且赋值到$info

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改数据</title>
</head>
<body>
    <form
        action=""
        method="post"><!-- 用于$_POST收集表单-->
        <p>姓名:<input
                type="text"
                name="name"
                value="<?php echo $info['name']; ?>"><!--value为text里面的值-->
        </p>
        <p>性别：<input
                type="radio"
                name="sex"
                value="1" <?php echo $info['sex'] == '1'? 'checked': '' ?>>
                男
                <input
                type="radio"
                name="sex"
                value="2" <?php echo $info['sex'] == '2'? 'checked': '' ?>>
                女
        </p>
        <!--checked为默认选择-->
        <input type = "hidden" name="" />
        <p><button>提交</button></p>
    </form> 
</body>
</html>