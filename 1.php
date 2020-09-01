<?php 
$str = "1234567890";
$str1 = strrev($str);
echo $str1."<br>";
$str2 = str_split($str1,3);
print_r($str2);
echo "<br>";
$str3 = implode(",",$str2);
echo $str3."<br>";
echo strrev($str3);
?> 