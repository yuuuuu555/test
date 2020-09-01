<?php
namespace app\index\controller;
// 24e3c07754c537d91c75c341498ac2f3
class Index
{   
    // 弹出权限申请框
    public function index()
    {
        // echo urldecode(23); 
        //授权之后跳转的页面地址
        echo urlencode('http://wuliyuyu.nat100.top/phpcode/wx/test/index.php');



        // 申请授权框
        // appid：测试号id\redirect_uri: 网址
        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx79f23dab2d44d225&redirect_uri=http%3A%2F%2F7wgxfj.natappfree.cc%2Fphpcode%2Fthinkphp5%2Fpublic%2Findex.php%2Findex%2Findex%2Flogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

        
        // return 'nima';
    }
    // 接收授权code和用户信息
    public function login(){
        // echo 'll';
        $code = requset() -> get('code');
        // $state = requset() -> get('state');
        var_dump($_GET);
        // echo requset() -> get('code');
        // $token = file_get_contents(' https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx79f23dab2d44d225&secret=24e3c07754c537d91c75c341498ac2f3&code=CcodeODE&grant_type=authorization_code');
    
        echo $code;
        
        // &grant_type=authorization_code








        // // 初始化code
        // $code = "";
        // // 获取code参数
        // $code = $_REQUEST["code"];

        // // 获取
        // $url_token = "";
        // $url_token = "https://api.weixin.qq.com/sns/oauth2/access_token";
        // $url_token = "?appid=wx79f23dab2d44d225&secret=24e3c07754c537d91c75c341498ac2f3";
        // $url_token = "&code=".$code;
        // $url_token = "&grant_type=authorization_code";

        // $neirong_token = "";
        // $neirong_token = file_get_contents($url_token);
        // echo $neirong_token;









    }
}



// https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx79f23dab2d44d225&redirect_uri=http%3A%2F%2F7wgxfj.natappfree.cc%2Fphpcode%2Fwx%2FInterface%2FtestInterface2.php%2Findex%2Findex%2Flogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect
// http%3A%2F%2F7wgxfj.natappfree.cc%2Fphpcode%2Fwx%2FInterface%2FtestInterface2.php
// https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx79f23dab2d44d225&redirect_uri=http%3A%2F%2Fuv64wd.natappfree.cc%2Fphpcode%2Fwx%2FInterface%2FtestInterface2.php%2Findex%2Findex%2Flogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect
// https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx79f23dab2d44d225&redirect_uri=http%3A%2F%2Fuv64wd.natappfree.cc%2Fphpcode%2Fwx%2Ftest%2Findex.php%2Findex%2Findex%2Flogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect