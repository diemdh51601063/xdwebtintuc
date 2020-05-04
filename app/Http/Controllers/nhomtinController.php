<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhomtin;


class nhomtinController extends Controller
{
    public function demo()
    {
    	$a=nhomtin::all();
    	var_dump($a);
    }
}
