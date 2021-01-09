<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Managers extends Model{

    public $table = 'managers';

    protected $fillable = ['name', 'account', 'password', 'rola'];

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