<?php

namespace App\Http\Controllers;

use App\wxLogin;
// use think\Session;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class WxLoginController extends Controller
{


    public function yemian()
    {
        return view('wx/login');
    }

    public function wxLogin(Request $request)
    {
        //获取code
        //code码是直接从地址栏传递过来所以直接get
        $code =  $_GET['code'];


        //根据code换取access_token
        $get_ac_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=&secret=SECRET&code={$code}&grant_type=authorization_code";
        // 可用CURL来请求
        $res_data = file_get_contents($get_ac_url); //获得JS数据
        //将获得的数据转换成一个数组 每个code只能获取一次
        $res_arr = json_decode($res_data, true);


        //根据access_token获取用户信息
        $get_user_url = "https://api.weixin.qq.com/sns/auth?access_token={$res_arr['access_token']}&openid={$res_arr['access_openid']}";
        //返回json格式数据
        $user_data = file_get_contents($get_user_url);
        //避免重复调用数据 将json数据进行缓存
        Session::set('user_data', $user_data);

        // 判断是否已经授权  查询数据库是否有相同的openid
        $users  = new Users();
        $usersOpenid  = $user_data['openid'];
        $users_openid = Users::where("openid")->get();
        if(!empty($users_openid)){


            foreach($users as $openid){
                if($openid['openid'] == $usersOpenid){
                    //合并数组
                    $userss = $openid + $users;
                    return view('', ['userss' => $userss]);
                }else{
                    return view('wx/wxLogin');
                }
            }




            // foreach($users_openid as $opid){
            //     //如果存在，就获取数据跳转到已经登录的个人页面
            //     if($opid == $usersOpenid){
            //         return view('', ['users' => $users]);
            //     }else{
            //         //否则跳转到注册页面
            //         return view('', []);
            //     }
            // }
            
        }

        // $users_openid = Users::where("openid", "=", "$usersOpenid")->get();
        if ($usersOpenid == $users_openid) { } else {
            //提醒用户注册账户或者绑定已有账户
            return view('wx/wxLogin', []);
        }
        // dd($request);


        //保存用户信息

        // 初始化用户登陆状态
        // echo $code;
    }

    public function wxRegister(Request $request)
    {
        $users  = new Users();
        dd($request);
        //判断模式是post
        if ($request->isMethod('POST')) {
            //验证信息
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Users.name' => 'required|min:2|max:20',
                    'Users.age' => 'required|integer',
                    'Users.sex' => 'required|integer'
                ],
                [
                    //翻译
                    'required' => ':attribute 为必填项',
                    'min' => ':attribute 最少为2个字符',
                    'max' => ':attribute 超出字符限制',
                    'integer' => ':attribute 必须是整数'
                    // 'required' => ':attribute 为必填项',
                    // 'required' => ':attribute 为必填项'
                ],
                [
                    //翻译
                    'Users.name' => '姓名',
                    'Users.age' => '年龄',
                    'Users.sex' => '性别',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            //用$request指向在页面获取到的Users并赋值给$date
            $date = $request->input('Users');

            //创建的同时判断是否创建成功
            if (Users::ulogin($date)) {
                //闪存
                return redirect('usersIndex')->with('success', '添加成功！');
            } else {
                return redirect()->back();
            }
        }
        // dd($users);
        return view('users/ulogin', [
            'users' => $users,
        ]);
    }
}
