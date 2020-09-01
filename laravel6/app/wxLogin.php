<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class wxLogin extends Model{
    //指定表名
    //已经在config里的database将t_设置
    // protected $table = 'student'; 
    //指定id
    // protected $primaryKey = 'id';
    //指定可以批量赋值的列
    // protected $fillable = ['userName', 'password'];
    //指定不可以批量赋值
    // protected $guarded = [];

    //自动增加创始时间和修改时间 true/开 false/关
    // public $timestamps = true;
    //获取时间
    // public function getDateFormat(){
    //     return time();
    // }
    //设置返回原字符
    // public function asDateTime($val){
    //     return $val;
    // }

}