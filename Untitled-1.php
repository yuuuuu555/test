<form name="form" method="post" action="#">
 <lable>请输入数字:</lable>
 <input type="text" name="num" id="num">
 <input type="submit" name="sub" value="提交"><p>
</form>

<?php
// function abso($num){
// 	if($num>=0){
		
// 		return $num;
		
// 	}
// 	else{
// 		// echo 'fuck you';
// 		return $num*(-1);
// 	}
// }


if(isset($_POST['num'])&& $_POST['num']!=""){
	echo "你输入的数字是".$_POST['num'].",";
	// echo $_POST['num']."的绝对值是".abso($_POST['num']);
	echo "我".$_POST['num']."你老虎";
}
?>