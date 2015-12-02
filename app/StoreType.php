<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
	/* Has Fields:
	 * type
	 *
	 */
	protected $table = 'store_types';
	protected $fillable = [];

	public function store(){
		return $this->hasMany('App\Store');
	}
}
