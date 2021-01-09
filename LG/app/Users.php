<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{


    const SEX_UN = 10;
    const SEX_MAN = 20;
    const SEX_WOMAN = 30;
    // 用一个key $ind来装
    public function sex($ind = null)
    {
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_MAN => '男',
            self::SEX_WOMAN => '女'
        ];
        //判断有无传值
        if ($ind !== null) {
            //判断key$ind是否存在于$arr 不存在返回SEX_UN
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[slef::SEX_UN];
        }
        return $arr;
    }


    public $table = 'users';

    protected $fillable = ['name', 'age', 'sex', 'password', 'account', 'phone'];

    public $timestamps = false;

//     public function getDateFormat()
//     {
//         return time();
//     }

//     protected function asDateTime($val)
//     {
//         return $val;
//     }
//     public function fromDateTime($value)
//     {
//         return empty($value) ? $value : $this->getDateFormat();
//     }
}
