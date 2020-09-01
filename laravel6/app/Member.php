<?php

namespace App;

// use Illuminate\Database\Eloquent\Model; //重要 无字不行
//模型的新建
class Member extends Model{
    public static function getMember(){
        return 'member name is sean';
    }
}