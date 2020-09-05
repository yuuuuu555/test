<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use App\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // 主页
    public function index()
    {
        //分页
        $userss = Users::paginate(10);

        return view('users/index', [
            'userss' => $userss,
        ]);
    }
    // 新建
    public function create(Request $request)
    {
        $users  = new Users();

        //判断模式是post
        if ($request->isMethod('POST')) {
            //验证信息

            // $this->validate(
            //     $request,
            //     [
            //         //限制条件
            //         'Users.name' => 'required|min:2|max:20',
            //         'Users.age' => 'required|integer',
            //         'Users.sex' => 'required|integer'
            //     ],
            //     [
            //         //翻译
            //         'required' => ':attribute 为必填项',
            //         'min' => ':attribute 最少为2个字符',
            //         'max' => ':attribute 超出字符限制',
            //         'integer' => ':attribute 必须是整数'
            //         // 'required' => ':attribute 为必填项',
            //         // 'required' => ':attribute 为必填项'

            //     ],
            //     [
            //         //翻译
            //         'Users.name' => '姓名',
            //         'Users.age' => '年龄',
            //         'Users.sex' => '性别',
            //     ]
            // );

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
            if (Users::create($date)) {
                //闪存
                return redirect('usersIndex')->with('success', '添加成功！');
            } else {
                return redirect()->back();
            }
        }
        // dd($users);
        return view('users/create', [
            'users' => $users,
        ]);
    }

    //获取传来的数据 Request
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

        // var_dump($date);

        if ($users->save()) {
            return redirect('usersIndex');
        } else {
            return redirect()->back();
        }
    }

    // 修改
    // requeste获取post请求 页面要有methon=post
    public function update(Request $request, $id)
    {
        $users = Users::find($id);

        if ($request->isMethod('POST')) {
            // 验证
            $this->validate(
                $request,
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

            // 取出里面的值
            $date = $request->input('Users');
            //重新赋值
            $users->name = $date['name'];
            $users->age = $date['age'];
            $users->sex = $date['sex'];

            if ($users->save()) {
                return redirect('usersIndex')->with('success', '修改成功！');
            }
        }

        return view('users/update', [
            'users' => $users
        ]);
    }
    //详情
    public function detail($id)
    {
        $users = Users::find($id);


        return view('users.detail', [
            'users' => $users
        ]);
    }
    public function delete($id)
    {
        $users = Users::find($id);
        if ($users->delete()) {
            return redirect('usersIndex')->with('success', '删除成功' . $id);
        } else {
            return redirect('usersIndex')->with('error', '删除失败' . $id);
        }
    }
    //查名字    
    public function selectName(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // 限定传入的值不能为空
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Users.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // dd($request);
            if (!empty($request)) {
                //将页面存在Users[..]里的数据放到$users里
                $users = $request->input('Users');
                // dd($users);
                if (!empty($users['data'])) {
                    $num = $users['data'];
                    // dd($num);
                    // 从数据库获得对应数据
                    $userss = Users::where('name', $num)
                        ->get();
                    // dd($userss);

                    // 判断有无某项数据，否则查无此人
                    if (count($userss)) {
                        // dd($userss);
                        // 分页
                        $userss = Users::where('name', $num)->paginate(10);
                        return view('users/index', [
                            'userss' => $userss,
                        ]);
                    } else {
                        return redirect('usersIndex')->with('error', '查无此人');
                    }
                }
            } else {
                return redirect('usersIndex')->with('error', '查无此人');
            }
        }
    }
    //id查询
    public function selectID(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // dd($request);
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Users.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //将页面存在Users[..]里的数据放到$users里
            $users = $request->input('Users');
            // dd($users);
            //查名字
            if (!empty($users['data'])) {
                $num = $users['data'];
                // dd($num);
                // 从数据库获得对应数据 返回的是一个object类型
                $userss0 = Users::where('id', $num)
                    ->get();
                // 用count（）判断object类型是否为空 否则查无此人
                if (count($userss0)) {
                    // dd($userss);
                    // 分页
                    $userss = Users::where('id', $num)->paginate(10);
                    return view('users/index', [
                        'userss' => $userss,
                    ]);
                } else {
                    return redirect('usersIndex')->with('error', '查无此人');
                }
            } else {
                return redirect('usersIndex')->with('error', '查无此人');
            }
        }
    }
}
