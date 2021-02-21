<?php
namespace App\Exceptions;
use Illuminate\Http\Request;

trait AuthenticatesLogout
{
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->forget($this->guard()->getName());
        $request->session()->regenerate();
        
        //这里稍微做了处理，根据不同的模块返回不同的路由
        $urlInfo = $this->getTemplatePath($request);
        if(strtolower($urlInfo['modules']) == 'admin'){
            $url = '/admin';
        }else{
            $url = '/';
        }
        return redirect($url);
    }
}