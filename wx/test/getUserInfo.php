<?php

session_start();
header("Content-type: text/html; charset=utf-8");
$appid = "wx79f23dab2d44d225";  //填写你公众号的appid
$secret = "24e3c07754c537d91c75c341498ac2f3";  //填写你公众号的secret
$code = $_GET["code"];
 
//第一步:取得openid
$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
$oauth2 = getJson($oauth2Url);
  
//第二步:根据全局access_token和openid查询用户信息  
$access_token = $oauth2["access_token"];  
$openid = $oauth2['openid'];  
$get_user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$userinfo = getJson($get_user_info_url);
 
//打印用户信息
  print_r($userinfo);
 
function getJson($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}
// $a = "10";
// $dizhi = "http://wuliyuyu.nat100.top/phpcode/wx/test/shuchu.php";

// header("Location:".$dizhi);

// var_dump($userinfo);
// $openid = $userinfo['openid'];
// $nickname = $userinfo['nickname'];
// $sex = $userinfo['sex'];
// $language = $userinfo['language'];
// $city = $userinfo['city'];
// $province = $userinfo['province'];
// $country = $userinfo['country'];
// $headimgurl = $userinfo['headimgurl'];
// $privilege = $userinfo['privilege'];
// // echo $openid;
// // header('$headimgurl;');

// print_r($openid);
if(!empty($userinfo)){
  $_SESSION['userInfo'][] = $userinfo;

  header("location:printuserinfo.php");
}else {
  echo "为空";
}