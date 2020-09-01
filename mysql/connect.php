<?php
    //连接 创建数据库 删除数据库




    $link = @mysqli_connect('localhost','root','') or die(mysqli_connect_error()) ;//@是屏蔽错误 逻辑运算，如果前面为真就短路  or不能用||代替
    // var_dump($conn);
    
    //创建数据库
    // $ret = mysqli_query($link,'create database abc charset utf8') or die(mysqli_error($link)); //创建名字为abc的数据库 ，mysqli_error为显示$link错误的函数
    
    //删除数据库,无法挽回
    // $ret = mysqli_query($link,'drop database abc') or die(mysqli_error($link));

    //创建表 与 列
    // create table a(
    //     ssd int [10],
    //     sds int [10]
    // );//[engine = innodb/myisam charset = utf8 comment = '']

?>