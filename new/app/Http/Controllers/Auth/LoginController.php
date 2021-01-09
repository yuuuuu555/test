<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request){
    //     //获取表单输入
    //     $account = $request->input('account');
    //     $password = $request->input('password');
    //     //获取用户信息
    //     $user = User::where('account',$account)->first();
    //     //数据库中取的密码
    //     $pass = $user->password;
    //     $str = Hash::make($pass);
    //     if (Hash::check($password, $pass)) {
    //         Auth::login($user);
    //         return redirect('/home');
    //     }else{
    //         return redirect('/login');
    //     }
    // }
    public function username(){
        return 'account';
    }

}
