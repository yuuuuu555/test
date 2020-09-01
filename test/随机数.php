<?php
    function get_rand_str($len=4){
        //array_merge合并数组
        //range创建范围函数
        $arr = array_merge(range(0,9),range('a','z'),range('A','Z'));
        //shuffle打乱数组
        shuffle($arr);
        $str = '';
        for($i = 0;$i<$len;$i++){
            $rand = rand(0,61);
            $str .= $arr[$rand];
        }
        return $str;
    }
    echo get_rand_str(6);
    //先创建一组数组，打乱，然后循环输出62个中的某一个