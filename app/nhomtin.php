<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhomtin extends Model
{

	protected $table = "nhomtin";
	public $timestamps = false;
	protected $primaryKey="id";

   public function loaitin()
   {
   	return $this->hasMany('App\loaitin','id_nhomtin','id');
   }
}
