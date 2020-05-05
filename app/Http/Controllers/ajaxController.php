<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhomtin;
use App\loaitin;

class ajaxController extends Controller
{
    public function getloaitin($id_nhomtin){

    		$loaitin=loaitin::where('id_nhomtin',$id_nhomtin)->get();
    		
    		foreach ($loaitin as $lt) 
    		{
   					 echo " <option  value='".$lt->id."'>".$lt->tenloaitin."</option>";

    		}
    }
}
