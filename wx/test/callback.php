<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
$info=$_GET;
$code = $_GET['code'];
$state = $_GET['state'];
$rand=$_SESSION["wx_rand"];
//扫码后同意授权 code 有值,判断 rand 是否异常
if($code=='' && $rand!==$state) {
 exit();
}else{
    $appid = '';      //自己的id和秘钥
    $appsecret = '';

    //通过code获取access_token
    $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
    $token = json_decode(file_get_contents($token_url), true);
    $r_token=$token['refresh_token'];

    //刷新或续期access_token

    $refresh_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$r_token;
    $refresh_token = json_decode(file_get_contents($refresh_token_url), true);
    $access_token=$refresh_token['access_token'];
    $openid=$refresh_token['openid'];

    //检验授权凭证（access_token）是否有效 有效期为 2小时
    $verify_access_token_url='https://api.weixin.qq.com/sns/auth?access_token='.$access_token.'&openid='.$openid;
    $res = json_decode(file_get_contents($verify_access_token_url), true);

    //获取 unionid
    if ($res['errcode']==0 && $res['errmsg']== ok) {
        $user_info_url='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $user_info = json_decode(file_get_contents($user_info_url), true);
        //var_dump($user_info);exit();
        $unionid=$user_info['unionid'];//unionid为唯一,可区分用户,绑定unionid就可以进行登录了
    }
}
?>