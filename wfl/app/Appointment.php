<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //

    const APPOINTMENT_A = 1;
    const APPOINTMENT_B = 2;
    const APPOINTMENT_C = 3;
    const APPOINTMENT_D = 4;
    const APPOINTMENT_E = 5;
    public function appointment($ind = null){
        $arr = [
            self::APPOINTMENT_A => '排队中',
            self::APPOINTMENT_B => '提醒中',
            self::APPOINTMENT_C => '借阅中',
            self::APPOINTMENT_D => '已到期',
            self::APPOINTMENT_E => '已归还',
        ];

        if ($ind !== null) {
            //判断key$ind是否存在于$arr 不存在返回SEX_UN
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[slef::APPOINTMENT_A];
        }
        return $arr;
    }

    public $table = 'appointments';

    protected $fillable = ['Account', 'BookId', 'UserId', 'UserEmail', 'UserName', 'BookName', 'status'];

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
