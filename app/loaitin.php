<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaitin extends Model
{
     public $timestamps = false;

   protected $table = "loaitin";

   protected $primaryKey = "id";




   public function nhomtin()
        {
          return $this->belongsTo('App\nhomtin','id_nhomtin');
        }

   public function tin()
        {
     	    return $this->hasMany('App\tin','id_loaitin');
        }
}
