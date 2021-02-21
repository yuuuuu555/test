<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Exceptions\AuthenticatesLogout;

class LoginController extends Controller
{
    use AuthenticatesUsers, AuthenticatesLogout {
        AuthenticatesLogout::logout insteadof AuthenticatesUsers;
    }
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/books';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest.admin')->except('logout');
    }
    /**
     * 显示后台登录模板
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    /**
     * 使用 admin guard
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }
    /**
     * 重写验证时使用的用户名字段
     */
    public function username()
    {
        return 'account';
    }
}
