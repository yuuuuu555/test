<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [
        'name', 'account', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


// 主页
    public function index()
    {
        //分页
        // 从数据库查询
        $bookss = Books::paginate(10);
        $booksss = new Books();
        // 在页面中显示
        return view('books/index', [
            'bookss' => $bookss,
            'booksss' => $booksss,
        ]);
    }




}
