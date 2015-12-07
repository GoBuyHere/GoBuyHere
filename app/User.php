<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
	/* Has Fields:
	 * name
	 * email
	 * password
	 * remembertoken
	 *
	 */

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];


    protected $hidden = ['password', 'remember_token'];

    public function groceryLists(){
	    return $this->hasMany('App\GroceryList');
    }

	public function recentList(){
		return $this->hasOne('App\RecentList');
	}

    public function stores(){
        return $this->belongsToMany('App\Store');
    }

	public function bothStores(){
		$stores = $this->stores()->with('storeType')->get();
		$nonStores = Store::with('storeType')->get();

		$tmp = $nonStores->diff($stores);


		return array($stores, $tmp);
	}

	public function newStores($idList){
		$stores = $this->stores;
		$oldIdList = array();
		foreach($stores as $store){
			$oldIdList[] = $store->id;
		}
		$diffNew = array_diff($idList,$oldIdList);
		$diffOld = array_diff($oldIdList,$idList);
		//var_dump($idList);
		//var_dump($oldIdList);
		var_dump($diffNew);
		var_dump($diffOld);
		//dd($diffOld);
		$flag = 'good';
		if($stores->count() == count($diffOld) && empty($diffNew)){
			$flag = 'bad';
		}
		elseif(empty($diffOld) && empty($diffNew)){
			$flag = 'no change';
		}


		if(!empty($diffOld)){
			$this->stores()->detach($diffOld);
		}

		if(!empty($diffNew)) {
			$this->stores()->attach($diffNew);
		}

		return $flag;


	}

	public function saveRecentList($flag, $storeId, $itemInfoIds, $qtys){

		$recentList = RecentList::firstOrNew(['user_id' => $this->id]);
		$recentList->store_id = $storeId;
		$recentList->save(); // list is saved;
		//delete old items
		RecentListItem::where('recent_list_id',$recentList->id)->delete(); // delete old items
		//add new items

		foreach($itemInfoIds as $i => $infoId){
			$item = Item::firstOrNew(['item_info_id' => $infoId, 'store_id' => $storeId]);
			if(!isset($item->price)){
				$item->price = 0;
				$item->save();
			}
			//create recentItems;
			RecentListItem::create(['item_id' => $item->id, 'recent_list_id' => $recentList->id, 'qty' => $qtys[$i]]);
		}
	}

}
