<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhomtin;
use App\loaitin;


class nhomtinController extends Controller
{
    public function demo()
    {
    	$a=nhomtin::find(1);


    	foreach ($a->loaitin as $value) {
    		echo $value->id;
    	}
    	
    }
}
