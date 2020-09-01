<?php
namespace App\Http\Middleware;
use Closure;
class Activity{
    public function handle($request, Closure $next){
        if(time() <= strtotime('2020-08-19')){
            return redirect('activity0');
        }else{
            return $next($request);
        }
    }
}