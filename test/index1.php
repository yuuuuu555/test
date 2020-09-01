<?php
session_start();

//$studne = [];//定义一个数组


//在这里用$_POST存储输入的student数组
//而赋值给可以进行通信的$_SESSION['student'][]
if(!empty($_POST)){
    // $name = $_POST['name'];
    // $sex = $_POST['sex'];


    $_SESSION['student'][] = $_POST;

    header("location:index2.php");


    //$studne = $_POST;//把获取的元素全部放进$studen里
}
