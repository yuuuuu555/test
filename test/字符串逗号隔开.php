<?php
function douhao($str){
    $str = strrev($str); //反转字符串
    $str = chunk_split($str,3,',');//字符串$str每隔3个字符加上一个,  最后无论有几个字符都加上,
    $str = strrev($str); //反转字符串
    $str = trim($str,',');//去除字符串$str的首位字符
    //$str = substr($str,1);//去除字符串第1个字符
    return $str;
}
$str = '12648162946192486';
$str = douhao($str);
echo $str;