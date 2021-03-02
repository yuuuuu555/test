<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Books;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function appointing()
    {
        $appointing = Appointment::where('status', '<', '5')->paginate(10);
        return view('admin/Appointing', [
            'appointing' => $appointing,
        ]);
    }

    public function history()
    {
        $history = Appointment::select()->paginate(10);
        return view('admin/history', [
            'history' => $history,
        ]);
    }

    public function cancel($id)
    {
        $status = Appointment::where('id', $id)->value('status');
        if ($status == '3' || $status == '0') {
            return redirect('admin/Appointing')->with('error', '取消预约失败，您已正在借阅此书，请尽快归还');
        } elseif ($status == '2') {
            // 如果是在提醒时取消

            $new = Appointment::where('id', $id)->update(['status' => '6']);
            $next = Appointment::where('BookId', $new->BookId)->where('status', '1')->first();

            // 如果没有人预约
            if (empty($next->id)) {
                // 更新书本余量和书本状态

                // 找书的id
                // $BookId = Appointment::where('id', $id)->value('BookId');
                // 找书的存量
                $save = Books::where('id', $new->BookId)->value('save');
                $saves = $save + 1;
                $ok = Books::where('id', $new->BookId)->update([
                    'save' => $saves,
                    'status' => '10',
                ]);
                return redirect('admin/Appointing')->with('success', '取消预约成功');
            } else {
                $idY = Appointment::where('BookId', $new->BookId)->where('status', '1')->first()->update(['status', '2']);
                // 发通知

                // 延时任务
                return redirect('admin/Appointing')->with('success', '取消预约成功');
            }
        } else {
            // 如果只在排队中取消
            Appointment::where('id', $id)->update(['status' => '6']);
            return redirect('admin/booksAppointing')->with('success', '取消预约成功');
        }
    }
    //查用户名字
    public function selectUserName(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // 限定传入的值不能为空
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // dd($request);
            if (!empty($request)) {
                //将页面存在Users[..]里的数据放到$users里
                $appointing = $request->input('Appointing');
                // dd($users);
                if (!empty($appointing['data'])) {
                    $num = $appointing['data'];
                    // dd($num);
                    // 从数据库获得对应数据
                    $appointing = Appointment::where('UserName', $num)->orWhere('UserName', 'like', '%' . $num . '%')->where('status', '<', '5')
                        ->first();
                    // dd($userss);

                    // 判断有无某项数据，否则查无此人
                    if (!empty($appointing)) {
                        // dd($userss);
                        // 分页
                        $appointing = Appointment::where('UserName', $num)->orWhere('UserName', 'like', '%' . $num . '%')->where('status', '<', '5')->paginate(10);
                        return view('admin/appointing', [
                            'appointing' => $appointing,
                        ]);
                    } else {
                        return redirect('admin/Appointing')->with('error', '查无此人');
                    }
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    //用户id查询
    public function selectUserID(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // dd($request);
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //将页面存在Users[..]里的数据放到$users里
            $appointing = $request->input('Appointing');
            // dd($appointing);
            //查名字
            if (!empty($appointing['data'])) {
                $num = $appointing['data'];
                // dd($num);
                // 从数据库获得对应数据 返回的是一个object类型
                $appointing = Appointment::where('UserId', $num)->where('status', '<', '5')
                    ->get();
                // 用count（）判断object类型是否为空 否则查无此人
                if (count($appointing)) {
                    // dd($userss);
                    // 分页
                    $appointing = Appointment::where('UserId', $num)->where('status', '<', '5')->paginate(10);
                    return view('admin/Appointing', [
                        'appointing' => $appointing,
                    ]);
                } else {
                    return redirect('admin/Appointing')->with('error', '查无此人');
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    // 查书籍名字
    public function selectBookName(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // 限定传入的值不能为空
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // dd($request);
            if (!empty($request)) {
                //将页面存在Users[..]里的数据放到$users里
                $appointing = $request->input('Appointing');
                // dd($users);
                if (!empty($appointing['data'])) {
                    $num = $appointing['data'];
                    // dd($num);
                    // 从数据库获得对应数据
                    $appointing = Appointment::where('BookName', $num)->orWhere('BookName', 'like', '%' . $num . '%')->where('status', '<', '5')
                        ->first();
                    // dd($userss);

                    // 判断有无某项数据，否则查无此人
                    if (!empty($appointing)) {
                        // dd($userss);
                        // 分页
                        $appointing = Appointment::where('BookName', $num)->orWhere('BookName', 'like', '%' . $num . '%')->where('status', '<', '5')->paginate(10);
                        return view('admin/appointing', [
                            'appointing' => $appointing,
                        ]);
                    } else {
                        return redirect('admin/Appointing')->with('error', '查无此人');
                    }
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    //书籍id查询
    public function selectBookID(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // dd($request);
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //将页面存在Users[..]里的数据放到$users里
            $appointing = $request->input('Appointing');
            // dd($appointing);
            //查名字
            if (!empty($appointing['data'])) {
                $num = $appointing['data'];
                // dd($num);
                // 从数据库获得对应数据 返回的是一个object类型
                $appointing = Appointment::where('BookId', $num)->where('status', '<', '5')
                    ->get();
                // 用count（）判断object类型是否为空 否则查无此人
                if (count($appointing)) {
                    // dd($Bookss);
                    // 分页
                    $appointing = Appointment::where('BookId', $num)->where('status', '<', '5')->paginate(10);
                    return view('admin/Appointing', [
                        'appointing' => $appointing,
                    ]);
                } else {
                    return redirect('admin/Appointing')->with('error', '查无此人');
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    // 预约中详情
    public function appointingDetail($id)
    {
        $appointing = Appointment::find($id);


        return view('common/appointingDetail', [
            'appointing' => $appointing
        ]);
    }


    //查用户名字
    public function HselectUserName(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // 限定传入的值不能为空
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // dd($request);
            if (!empty($request)) {
                //将页面存在Users[..]里的数据放到$users里
                $appointing = $request->input('Appointing');
                // dd($users);
                if (!empty($appointing['data'])) {
                    $num = $appointing['data'];
                    // dd($num);
                    // 从数据库获得对应数据
                    $appointing = Appointment::where('UserName', $num)->orWhere('UserName', 'like', '%' . $num . '%')
                        ->first();
                    // dd($userss);

                    // 判断有无某项数据，否则查无此人
                    if (!empty($appointing)) {
                        // dd($userss);
                        // 分页
                        $appointing = Appointment::where('UserName', $num)->orWhere('UserName', 'like', '%' . $num . '%')->paginate(10);
                        return view('admin/appointing', [
                            'appointing' => $appointing,
                        ]);
                    } else {
                        return redirect('admin/Appointing')->with('error', '查无此人');
                    }
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    //用户id查询
    public function HselectUserID(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // dd($request);
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //将页面存在Users[..]里的数据放到$users里
            $appointing = $request->input('Appointing');
            // dd($appointing);
            //查名字
            if (!empty($appointing['data'])) {
                $num = $appointing['data'];
                // dd($num);
                // 从数据库获得对应数据 返回的是一个object类型
                $appointing = Appointment::where('UserId', $num)
                    ->get();
                // 用count（）判断object类型是否为空 否则查无此人
                if (count($appointing)) {
                    // dd($userss);
                    // 分页
                    $appointing = Appointment::where('UserId', $num)->paginate(10);
                    return view('admin/Appointing', [
                        'appointing' => $appointing,
                    ]);
                } else {
                    return redirect('admin/Appointing')->with('error', '查无此人');
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    // 查书籍名字
    public function HselectBookName(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // 限定传入的值不能为空
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // dd($request);
            if (!empty($request)) {
                //将页面存在Users[..]里的数据放到$users里
                $appointing = $request->input('Appointing');
                // dd($users);
                if (!empty($appointing['data'])) {
                    $num = $appointing['data'];
                    // dd($num);
                    // 从数据库获得对应数据
                    $appointing = Appointment::where('BookName', $num)->orWhere('BookName', 'like', '%' . $num . '%')
                        ->first();
                    // dd($userss);

                    // 判断有无某项数据，否则查无此人
                    if (!empty($appointing)) {
                        // dd($userss);
                        // 分页
                        $appointing = Appointment::where('BookName', $num)->orWhere('BookName', 'like', '%' . $num . '%')->paginate(10);
                        return view('admin/appointing', [
                            'appointing' => $appointing,
                        ]);
                    } else {
                        return redirect('admin/Appointing')->with('error', '查无此人');
                    }
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    //书籍id查询
    public function HselectBookID(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // dd($request);
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Appointing.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //将页面存在Users[..]里的数据放到$users里
            $appointing = $request->input('Appointing');
            // dd($appointing);
            //查名字
            if (!empty($appointing['data'])) {
                $num = $appointing['data'];
                // dd($num);
                // 从数据库获得对应数据 返回的是一个object类型
                $appointing = Appointment::where('BookId', $num)
                    ->get();
                // 用count（）判断object类型是否为空 否则查无此人
                if (count($appointing)) {
                    // dd($Bookss);
                    // 分页
                    $appointing = Appointment::where('BookId', $num)->paginate(10);
                    return view('admin/Appointing', [
                        'appointing' => $appointing,
                    ]);
                } else {
                    return redirect('admin/Appointing')->with('error', '查无此人');
                }
            } else {
                return redirect('admin/Appointing')->with('error', '查无此人');
            }
        }
    }
    // 删除记录
    public function delete($id)
    {
        $users = Appointment::find($id);
        if ($users->delete()) {
            return redirect('usersIndex')->with('success', '删除成功' . $id);
        } else {
            return redirect('usersIndex')->with('error', '删除失败' . $id);
        }
    }


    // 正在借阅
    public function reading()
    {
        $reading = Appointment::where('status', '3')->orwhere('status', '0')->paginate(10);
        // dd($reading);
        return view('admin/reading', [
            'reading' => $reading
        ]);
    }
    // 还书
    public function give_back($id)
    {
        $now = Appointment::where('id', $id);
        if ($now->status == '0') {
            // 逾期
            $time_now = Carbon::now();
            $time_borrow = $id->updated_at;

            $time = ($time_now - $time_borrow) / 86400;
            $pay = $time * 0.1;
            return view('admin/pay', [
                'time' => $time,
                'pay' => $pay,
                'id' => $id,
            ]);
        } elseif ($now->status == '3') {
            //状态为借阅中
            Appointment::where('status', $id)->update(['status' => '5']);
            // 还书后，提醒下一个预约此书的人来借书
            $next = Appointment::where('BookId', $now->BookId)->where('status', '1')->first();
            if (empty($next->id)) {
                // 无人排队中
                // 查找书籍的存量
                $save = Books::where('id', $now->BookId)->value('save');
                $saves = $save + 1;
                Books::where('id', $now->BookId)->update([
                    'status' => '10',
                    'save' => $saves,
                ]);
                return redirect('history')->with('success', $id . '还书成功1');
            } else {
                // 有人排队
                $ok = Appointment::where('id', $next->id)->update(['status' => '2']);
                // 提醒人来拿书

                // 延时任务1

                return redirect('history')->with('success', $id . '还书成功2');
            }
        } else {
            return redirect()->back()->with('此书不在借阅中，禁止操作');
        }
        // $give_back = Appointment::where('id', $id)->update(['status' => '5']);
    }
    // 成功还款同时还书
    public function pay_out($id)
    {
        // 更改已还书状态
        $ok = Appointment::where('id', $id)->update(['status' => '5']);

        // 提醒下一个人
        $man = Appointment::where('id', $ok->BookId)->where('status', '1')->first();
        if (empty($man->id)) {
            // 如果没有人预约这本书了
            return redirect('reading')->with('success', '还款成功1');
        } else {
            // 此书有人在借
            $ok = Appointment::where('id', $man->id)->update(['status' => '2']);
            // 提醒人来拿书

            // 延时任务1

            return redirect('reading')->with('success', '还款成功');
        }
    }
    // 借书
    public function lend($id)
    {
        // 判断状态是否在提醒中
        $person = Appointment::where('id', $id)->value('status');
        if (!empty($person == '2')) {
            // 状态在提醒中
            $ok = Appointment::where('id', $id)->update(['status' => '3']);
            // 延时任务2

            return redirect('admin/reading')->with('success', '借出成功' . $id);
        } else {
            return redirect('admin/Appointing')->with('error', '未符合借出条件，借出失败' . $id);
        }
    }
}
