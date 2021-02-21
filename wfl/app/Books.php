<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    const STATUS_A = 1;
    const STATUS_B = 2;
    const STATUS_C = 3;
    const STATUS_D = 4;
    const STATUS_E = 5;
    const STATUS_F = 6;
    const STATUS_G = 7;
    const STATUS_H = 8;
    const STATUS_I = 9;
    const STATUS_J = 10;
    const STATUS_K = 11;
    const STATUS_L = 12;
    const STATUS_M = 13;
    const STATUS_N = 14;
    const STATUS_O = 15;
    const STATUS_P = 16;
    const STATUS_Q = 17;
    const STATUS_R = 18;
    const STATUS_S = 19;
    const STATUS_T = 20;
    const STATUS_U = 21;
    const STATUS_V = 22;
    const STATUS_W = 23;
    const STATUS_X = 24;
    const STATUS_Y = 25;
    const STATUS_Z = 26;

    // 用一个key $ind来装
    public function status($ind = null )
    {
        $arr = [
            self::STATUS_A => 'A',
            self::STATUS_B => 'B',
            self::STATUS_C => 'C',
            self::STATUS_D => 'D',
            self::STATUS_E => 'E',
            self::STATUS_F => 'F',
            self::STATUS_G => 'G',
            self::STATUS_H => 'H',
            self::STATUS_I => 'I',
            self::STATUS_J => 'J',
            self::STATUS_K => 'K',
            self::STATUS_L => 'L',
            self::STATUS_M => 'M',
            self::STATUS_N => 'N',
            self::STATUS_O => 'O',
            self::STATUS_P => 'P',
            self::STATUS_Q => 'Q',
            self::STATUS_R => 'R',
            self::STATUS_S => 'S',
            self::STATUS_T => 'T',
            self::STATUS_U => 'U',
            self::STATUS_V => 'V',
            self::STATUS_W => 'W',
            self::STATUS_X => 'X',
            self::STATUS_Y => 'Y',
            self::STATUS_Z => 'Z',

        ];
        //判断有无传值
        if ($ind !== null) {
            //判断key$ind是否存在于$arr 不存在返回SEX_UN
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[slef::STATUS_A];
        }
        return $arr;
    }

    const CLASSIFICATION_YES = 10;
    const CLASSIFICATION_NO = 20;
    public function classification($ind = null){
        $arr = [
            self::CLASSIFICATION_YES => '有',
            self::CLASSIFICATION_NO => '无',
        ];

        if ($ind !== null) {
            //判断key$ind是否存在于$arr 不存在返回SEX_UN
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[slef::CLASSIFICATION_YES];
        }
        return $arr;
    }


    public $table = 'books';

    protected $fillable = ['name', 'author', 'publisher','position','status','classification'];

    public $timestamps = true;

    public function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($val)
    {
        return $val;
    }
    public function fromDateTime($value)
    {
        return empty($value) ? $value : $this->getDateFormat();
    }
}
