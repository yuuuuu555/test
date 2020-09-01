<?php
//scope=snsapi_userinfo实例
$appid='wx79f23dab2d44d225'; //填写你公众号的appid
$redirect_uri = urlencode ( 'http://wuliyuyu.nat100.top/phpcode/wx/test/getUserInfo.php' ); //回调页面 getUserInfo.php 不能写错
$url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
header("Location:".$url);
