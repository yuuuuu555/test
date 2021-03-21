<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Books;
use App\Jobs\DelayOne;
use App\User;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function appointment($idB, $idU)
    {
        // user
        $user = User::find($idU);
        $account = $user->account;
        $email = $user->email;
        $nameU = $user->name;
        // book
        $book = Books::find($idB);
        $nameB = $book->name;
        $author = $book->author;
        $save = $book->save;
        $status = $book->status;

        $Bid = Appointment::where('UserId', $idU)->first();

        // 检查书籍是否有存量
        if ($save > '0') {
            // 检查是否在预约记录中找到这个人预约记录
            if (!empty($Bid)) {
                // 查找该用户的预约记录中正在预约的书本记录
                $num = Appointment::where('UserId', $idU)->where('status', '<', '4')->count();
                // dd($num);
                // 查看预约中的数量是否已达上限
                if ($num > 2) {
                    // 已达上限，预约失败
                    return redirect('user/books')->with('error', '您的预约数已达上限，预约失败');
                } else {
                    // 查询用户有没有预约过这本书
                    $B = Appointment::where('UserId', $idU)->where('BookId', $idB)->first();
                    if (!empty($B)) {
                        // 查看预约过这本书的记录是否都是已归还状态
                        $numOK = Appointment::where('UserId', $idU)->where('BookId', $idB)->where('status', '<', '5')->count();
                        // dd($numOK);
                        if (!empty($numOK)) {
                            // 正在预约中，预约失败
                            return redirect('user/books')->with('error', '您正在预约此书中，预约失败');
                        } else {
                            // 可以预约
                            // 余量减一
                            $Save = $save - '1';
                            // 判断余量如果为0
                            if ($Save == '0') {
                                // 更改书籍的状态为20=》无
                                $status = '20';
                                books::where('id', $idB)->update([
                                    'save' => $Save,
                                    'status' => $status,
                                ]);
                            }else{
                                books::where('id', $idB)->update([
                                    'save' => $Save,
                                ]);
                            }
                            $ok = appointment::create([
                                'account' => $account, 'BookId' => $idB, 'UserId' => $idU,
                                'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB, 'author' => $author, 'email' => $email,
                            ]);
                            return redirect('user/books')->with('success', '余量充足，预约成功，请在一天之内到图书馆借阅书籍，并在15天之内归还');
                        }
                    } else {
                        // 用户没预约过这本书，可以预约
                        // 余量减一
                        $Save = $save - '1';
                        // 判断余量如果为0
                        if ($Save == '0') {
                            // 更改书籍的状态为20=》无
                            $status = '20';
                            books::where('id', $idB)->update([
                                'save' => $Save,
                                'status' => $status,
                            ]);
                        }else{
                            books::where('id', $idB)->update([
                                'save' => $Save,
                            ]);
                        }
                        $ok = appointment::create([
                            'account' => $account, 'BookId' => $idB, 'UserId' => $idU,
                            'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB, 'author' => $author,'email' => $email,
                        ]);
                        return redirect('user/books')->with('success', '没预约过这本书，余量充足，预约成功，请在一天之内到图书馆借阅书籍，并在15天之内归还');
                    }
                }
            } else {
                //此人没有预约过任何书，可以预约
                // 余量减一
                $Save = $save - '1';
                // 判断余量如果为0
                if ($Save == '0') {
                    // 更改书籍的状态为20=》无
                    $status = '20';
                    books::where('id', $idB)->update([
                        'save' => $Save,
                        'status' => $status,
                    ]);
                }else{
                    books::where('id', $idB)->update([
                        'save' => $Save,
                    ]);
                }
                $ok = appointment::create([
                    'account' => $account, 'BookId' => $idB, 'UserId' => $idU,
                    'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB, 'author' => $author,'email' => $email,
                ]);
                return redirect('user/books')->with('success', '没有预约过任何书，余量充足，预约成功，请在一天之内到图书馆借阅书籍，并在15天之内归还');
            }
        } else {
            // 余量不足，排队 1 默认是2
            $statusA = '1';
            // 检查是否在预约记录中找到这个人预约记录
            if (!empty($Bid)) {
                // 查找该用户的预约记录中正在预约的书本记录
                $num = Appointment::where('UserId', $idU)->where('status', '<', '5')->count();
                // dd($num);
                // 查看预约中的数量是否已达上限
                if ($num > 2) {
                    // 已达上限，预约失败
                    return redirect('user/books')->with('error', '您的预约数已达上限，预约失败');
                } else {
                    // 查询用户有没有预约过这本书
                    $B = Appointment::where('UserId', $idU)->where('BookId', $idB)->first();
                    if (!empty($B)) {
                        // 查看预约过这本书的记录是否都是已归还状态
                        $numOK = Appointment::where('UserId', $idU)->where('BookId', $idB)->where('status', '<', '4')->count();
                        // dd($numOK);
                        if (!empty($numOK)) {
                            // 正在预约中，预约失败
                            return redirect('user/books')->with('error', '您正在预约此书中，预约失败');
                        } else {
                            // 可以预约

                            $ok = appointment::create([
                                'account' => $account, 'BookId' => $idB, 'UserId' => $idU,
                                'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB, 'author' => $author, 'status' => $statusA
                            ]);
                            return redirect('user/books')->with('success', '余量不足，预约成功，正在进行排队预约，预约时间较长建议预约余量充足的书籍');
                        }
                    } else {
                        // 用户没预约过这本书，可以预约
                        $ok = appointment::create([
                            'account' => $account, 'BookId' => $idB, 'UserId' => $idU,
                            'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB, 'author' => $author, 'status' => $statusA
                        ]);
                        return redirect('user/books')->with('success', '没预约过这本书，余量不足，预约成功，正在进行排队预约，预约时间较长建议预约余量充足的书籍');
                    }
                }
            } else {
                //此人没有预约过任何书，可以预约

                $ok = appointment::create([
                    'account' => $account, 'BookId' => $idB, 'UserId' => $idU,
                    'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB, 'author' => $author, 'status' => $statusA
                ]);
                return redirect('user/books')->with('success', '没有预约过任何书，余量不足，预约成功，正在进行排队预约，预约时间较长建议预约余量充足的书籍');
            }
        }
    }

    // 用户查看预约中的书籍
    public function appointing()
    {
        $id = auth::user()->id;
        // dd('$id');
        $appointing = Appointment::where('UserId', $id)->where('status', '<', '5')->first();

        // dd($appointing);
        if (!empty($appointing)) {
            // dd('ss');
            $appointing = Appointment::where('UserId', $id)->where('status', '<', '5')->paginate(10);

            // $num = $appointing['BookName'];
            // dd($num->BookName);
            // dd($appointing['UserId']);
            return view('users/Appointing', [
                'appointing' => $appointing,
            ]);
        } else {
            $appointing = '0';
            return view('users/Appointing', [
                'appointing' => $appointing,
            ]);
        }
    }

    // 取消预约中的书籍
    public function cancel($id)
    {
        $status = Appointment::where('id', $id)->value('status');
        if ($status == '3' || $status == '0') {
            return redirect('user/booksAppointing')->with('error', '取消预约失败，您已正在借阅此书，请尽快归还');
        } elseif ($status == '2') {
            // 如果是在提醒时取消
            Appointment::where('id', $id)->update(['status' => '6']);
            // dd($status);
            $new = Appointment::where('id', $id)->first();
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
                return redirect('user/booksAppointing')->with('success', '取消预约成功');
            } else {
                // 如果又人预约
                $data = Appointment::where('BookId', $new->BookId)->where('status', '1')->first()->update(['status', '2']);

                // 发通知
                Mail::send('emails.borrow', [
                    'data' => $data
                ], function ($message) use ($data) {
                    $message->to($data->email)->subject('回复');
                });
                // 延时任务
                return redirect('user/booksAppointing')->with('success', '取消预约成功');
            }
        } else {
            // 如果只在排队中取消
            Appointment::where('id', $id)->update(['status' => '6']);
            return redirect('user/booksAppointing')->with('success', '取消预约成功');
        }
    }


    // 用户的历史预约记录
    public function history()
    {
        $id = Auth::user()->id;
        // dd($id);
        $history = Appointment::where('UserId', $id)->where('status', '>', '4')->first();
        // dd($history);
        if (!empty($history)) {
            $history = Appointment::where('UserId', $id)->where('status', '>', '4')->paginate(10);
            return view('users/history', [
                'history' => $history,
            ]);
        } else {

            return view('users/history', [
                'history' => $history,
            ]);
        }
    }
}
