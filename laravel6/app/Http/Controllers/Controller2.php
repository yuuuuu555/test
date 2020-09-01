<?php
namespace App\Http\Controllers;
use App\Member; //指向member
class Controller2 extends Controller{
    public function info(){
        // return 'menmber-info';
        // return view('member-info');
        return Member::getMember();
    }
}