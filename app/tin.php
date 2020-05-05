<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tin extends Model
{
    public $timestamps = false;

    protected $table = "tin";

	protected $primaryKey = 'id';

    public function loaitin()
        {
        	return $this->belongsTo('App\loaitin','id_loaitin');
        }

    public function binhluan()
        {
        	return $this->hasMany('App\binhluan','id_tin');
        }
}
