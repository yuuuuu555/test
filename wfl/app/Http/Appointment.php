<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //


    public $table = 'appointment';

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
