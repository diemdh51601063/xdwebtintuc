<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class binhluan extends Model
{
       public $timestamps = false;

   protected $table = "binhluan";

   protected $primaryKey = 'id';

   public function tin()
        {
        	return $this->belongsTo('App\tin','id_tin');
        }

   public function admin()
        {
        	return $this->belongsTo('App\admin','id_admin');
        }
}
