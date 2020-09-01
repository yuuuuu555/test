<?php

    // 文件操作 == 增删改查

    // 文件路径
    $filename = 'new.txt';

    


    if(!file_exists($filename)){
        echo "文件{$filename}不存在";
        die();
    }
    // 打开文件 r 以什么方式打开 r（只读） r+（读写） w（写） w+（读写） a（写） a+（读写）
    $fp = fopen($filename, 'r');

    //取得文件大小
    $file_size = filesize($filename);


    //读取文件的长度，读多少
    $str = fread($fp, $file_size);


    // while(!feof($fp)){
    //     $str = fread($fp, );
    //     echo $str;
    // }

    //关闭文件
    fclose($fp);


    