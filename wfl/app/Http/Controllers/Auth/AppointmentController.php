<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Appointment;

class AppointmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function appointment($idU, $idB)
    {
        $Uid = Appointment::where('UserId', $idU);
        if(!empty($Uid)){

        }



    }
}
