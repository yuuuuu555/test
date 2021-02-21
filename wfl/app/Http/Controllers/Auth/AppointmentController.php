<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Books;
use App\User;

class AppointmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function appointment($idB, $idU)
    {
        // 可能找到好几个
        // $Bid = Appointment::where('UserId', $idU)->value('BookId');
        // $Bstatus = User::where('id', $a)->value('name', 'account', 'email');

        // user
        $user = User::find($idU);
        $account = $user->account;
        $email = $user->email;
        $nameU = $user->name;


        // book
        $book = Books::find($idB);
        $nameB = $book->name;

        // dd($account, $email, $nameU, $nameB);

        $Bid = Appointment::where('UserId', $idU)->value('BookId');
        // 找到这个人预约这本书有几个记录怎么办？？？？？？？？？？？？？？？？？？？？？？？
        // 加个条件：直接匹配除了已归还的，还有没有其他的，如果有‘且’找出的数量>2就不能预约
        // 最多可以预约三本

        // 检查是否在预约记录中找到这个人预约记录
        if (!empty($Uid)) {
            // 检查这个人是否预约过这本书
            if ($Bid == $idB) {
                $Bstatus = Appointment::where('UserId', $idB)->value('status');
                // 检查这个人是否已经归还这本书
                if ($Bstatus !== 5) {
                    // 此人预约过的书已归还，可以再次预约
                    $ok = appointment::insert(['account' => $account,'BookId' => $idB, 'UserId' => $idU,
             'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB]);
                } else {
                    // 正在预约中，预约失败
                }
            } else {
                // 此人没有预约过此书，可以预约
                $ok = appointment::insert(['account' => $account,'BookId' => $idB, 'UserId' => $idU,
                'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB]);
            }
        } else {
            // 此人没有预约过任何书，可以预约
            $ok = appointment::insert(['account' => $account,'BookId' => $idB, 'UserId' => $idU,
            'UserEmail' => $email, 'UserName' => $nameU, 'BookName' => $nameB]);
        }
    }
    public function add(){

    }
}
