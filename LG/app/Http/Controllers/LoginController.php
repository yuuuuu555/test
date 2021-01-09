<?php

namespace App\Http\Controllers;

use App\Org\code\Code;
use App\Managers;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session as IlluminateSession;

class LoginController extends Controller
{


    public function loginIndex(Request $request)
    {
        // $users = new Users();
        // $manages = new Managers();
        if ($request->isMethod('Post')) {
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Users.Account' => 'required|min:2|max:20|regex:/[0-9A-Za-z]/',
                    'Users.Password' => 'required|integer',
                    'Users.Code' => 'required',
                ],
                [
                    //翻译
                    'required' => ':attribute 为必填项',
                    'min' => ':attribute 最少为2个字符',
                    'max' => ':attribute 超出字符限制',
                    'integer' => ':attribute 必须是整数',
                    'regex' => ':attribute 必须是数字或字母'
                ],
                [
                    //翻译
                    'Users.Account' => '账号',
                    'Users.Password' => '密码',
                    'Users.Code' => '验证码',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = $request->input('Users');
            // dd($data['Account']);
            // 验证码区分大小写, 用strtolower()都转换成小写
            if (strtolower($data['Code']) !== strtolower(session()->get('code'))) {
                return redirect('loginIndex')->with('error', '验证码错误');
            } else {
                if (!empty($data)) {
                    $dataName = $data['Account'];
                    // dd($dataName);
                    if ($data['rola'] == '用户') {
                        $dataUser = Users::where('account', $dataName)->first();
                        if (!empty($dataUser)) {
                            // $dataUserA = get_object_vars($dataUser['users']);
                            // dd($dataUserA);
                            if ($data['Password'] == $dataUser['password']) {
                                //想将$dataUser传到页面上
                                session_start();
                                $_SESSION['user'] = $dataUser;
                                return redirect('booksIndexU');
                            } else {
                                return redirect('loginIndex')->with('error', '密码错误');
                            }
                        } else {
                            return redirect('loginIndex')->with('error', '账号不存在');
                        }
                    } else {
                        $dataUser = Managers::where('account', $dataName)->first();
                        if (!empty($dataUser)) {
                            if ($data['Password'] == $dataUser['password']) {
                                session_start();
                                $_SESSION['user'] = $dataUser;
                                return redirect('usersIndex');
                            } else {
                                return redirect('loginIndex')->with('error', '密码错误');
                            }
                        } else {
                            return redirect('loginIndex')->with('error', '账号不存在');
                        }
                    }
                } else {
                    return redirect('loginIndex')->with('error', '请输入信息');
                }
            }
        }
        return view('login/login2');
    }

    //验证码
    public function code()
    {
        $code = new Code();
        return $code->make();
    }
    //退出登录
    public function loginout()
    {
        session_start();
        session_destroy();
        return redirect('loginIndex');
    }
    //注册
    public function register(Request $request)
    {
        $users  = new Users();

        //判断模式是post
        if ($request->isMethod('POST')) {
            //验证信息
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Users.name' => 'required|min:2|max:12',
                    'Users.age' => 'required|integer',
                    'Users.sex' => 'required|integer',
                    'Users.phone' => 'required|integer|regex:/^1[0-9]{10}$/',
                    'Users.account' => 'required|min:6|max:12|regex:/[0-9A-Za-z]/',
                    'Users.Code' => 'required',
                    'Users.password' => 'required|min:6|max:20',
                ],
                [
                    //翻译
                    'required' => ':attribute 为必填项',
                    'users.name.min' => ':attribute 最少为2个字符',
                    'max' => ':attribute 超出字符限制',
                    'Users.account.min' => ':attribute 最少为6个字符',
                    'integer' => ':attribute 必须是整数',
                    'regex' => ':attribute 格式不正确',
                    'Users.account.regex' => ':attribute 账号必须在6-12个字符以内且由数字或字母组成',
                    // 'Users.password.regex' => ':attribute 密码必须在6-20个字符以内',
                    // 'required' => ':attribute 为必填项',
                    // 'required' => ':attribute 为必填项'
                ],
                [
                    //翻译
                    'Users.name' => '真实姓名',
                    'Users.age' => '年龄',
                    'Users.sex' => '性别',
                    'Users.phone' => '电话',
                    'Users.account' => '账号',
                    'Users.password' => '密码',
                    'Users.Code' => '验证码',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //用$request指向在页面获取到的Users并赋值给$date
            
            $data = $request->input('Users');            
            // dd($data);
            $account = Users::where('account', $data['account'])->first();
            if (empty($account)) {
                // dd($data);
                $phone = Users::where('phone', $data['phone'])->first();
                if (empty($phone)) {
                    // $idcode = Users::where('idcode', $data['idcode'])->first();
                        //创建的同时判断是否创建成功
                        if (Users::create($data)) {                            
                            //闪存
                            return redirect('loginIndex')->with('success', '注册成功！');
                        } else {
                            return redirect()->back()->withInput()->with('error', '注册失败！');
                        }                    
                } else { 
                    return redirect()->back()->withInput()->with('error', '手机已被注册！');
                }
            } else { 
                // dd(old("Users[name]"));
                return redirect()->back()->withInput()->with('error', '账号已被注册！');
            }
        }
        return view('login.register' ,[
            'users' => $users,
        ]);
    }
    public function save(Request $request)
    {
        // 存到$date中
        $date = $request->input('Users');
        //获取一个模型
        $users = new Users();
        // 给模型赋值
        // 用$date里对应的值赋给$users模型里对应
        $users->name = $date['name'];
        $users->age = $date['age'];
        $users->sex = $date['sex'];
        $users->account = $date['account'];
        $users->idcode = $date['idcode'];
        $users->phone = $date['phone'];


        // var_dump($date);

        if ($users->save()) {
            return redirect('usersIndex');
        } else {
            return redirect()->back();
        }
    }
}
