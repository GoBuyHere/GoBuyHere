<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
	protected $table = 'store_types';
	protected $fillable = [];

	public function store(){
		return $this->hasMany('App\Store');
	}
}
