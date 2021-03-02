<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    const CLASSIFICATION_A = 1;
    const CLASSIFICATION_B = 2;
    const CLASSIFICATION_C = 3;
    const CLASSIFICATION_D = 4;
    const CLASSIFICATION_E = 5;
    const CLASSIFICATION_F = 6;
    const CLASSIFICATION_G = 7;
    const CLASSIFICATION_H = 8;
    const CLASSIFICATION_I = 9;
    const CLASSIFICATION_J = 10;
    const CLASSIFICATION_K = 11;
    const CLASSIFICATION_L = 12;
    const CLASSIFICATION_M = 13;
    const CLASSIFICATION_N = 14;
    const CLASSIFICATION_O = 15;
    const CLASSIFICATION_P = 16;
    const CLASSIFICATION_Q = 17;
    const CLASSIFICATION_R = 18;
    const CLASSIFICATION_S = 19;
    const CLASSIFICATION_T = 20;
    const CLASSIFICATION_U = 21;
    const CLASSIFICATION_V = 22;
    const CLASSIFICATION_W = 23;
    const CLASSIFICATION_X = 24;
    const CLASSIFICATION_Y = 25;
    const CLASSIFICATION_Z = 26;

    // 用一个key $ind来装
    public function classification($ind = null )
    {
        $arr = [
            self::CLASSIFICATION_A => 'A',
            self::CLASSIFICATION_B => 'B',
            self::CLASSIFICATION_C => 'C',
            self::CLASSIFICATION_D => 'D',
            self::CLASSIFICATION_E => 'E',
            self::CLASSIFICATION_F => 'F',
            self::CLASSIFICATION_G => 'G',
            self::CLASSIFICATION_H => 'H',
            self::CLASSIFICATION_I => 'I',
            self::CLASSIFICATION_J => 'J',
            self::CLASSIFICATION_K => 'K',
            self::CLASSIFICATION_L => 'L',
            self::CLASSIFICATION_M => 'M',
            self::CLASSIFICATION_N => 'N',
            self::CLASSIFICATION_O => 'O',
            self::CLASSIFICATION_P => 'P',
            self::CLASSIFICATION_Q => 'Q',
            self::CLASSIFICATION_R => 'R',
            self::CLASSIFICATION_S => 'S',
            self::CLASSIFICATION_T => 'T',
            self::CLASSIFICATION_U => 'U',
            self::CLASSIFICATION_V => 'V',
            self::CLASSIFICATION_W => 'W',
            self::CLASSIFICATION_X => 'X',
            self::CLASSIFICATION_Y => 'Y',
            self::CLASSIFICATION_Z => 'Z',

        ];
        //判断有无传值
        if ($ind !== null) {
            //判断key$ind是否存在于$arr 不存在返回SEX_UN
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::CLASSIFICATION_A];
        }
        return $arr;
    }

    const STATUS_YES = 10;
    const STATUS_NO = 20;
    public function status($ind = null){
        $arr = [
            self::STATUS_YES => '有',
            self::STATUS_NO => '无',
        ];

        if ($ind !== null) {
            //判断key$ind是否存在于$arr 不存在返回SEX_UN
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::STATUS_YES];
        }
        return $arr;
    }


    public $table = 'books';

    protected $fillable = ['name', 'author', 'publisher','position','status','classification', 'save'];

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
