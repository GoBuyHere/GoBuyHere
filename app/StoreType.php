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


	public function stores(){
		return $this->hasMany('App\Store');
	}
}
