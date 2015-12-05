<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\ItemInfo;
use Auth;
use App\GroceryListItem;
use DB;

class GroceryListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $user = Auth::user();
	    $list = $user->groceryLists->first();
	    $items = $list->groceryListItems;

	    //$groceryList = $groceryLists(0);
        return view('grocery_list', ['user' => $user,'list' => $list, 'items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


	    $user = Auth::user();
		$list = $user->groceryLists()->where('name', '=',$request->input('groceryList'))->first();

	    $groceryListItems = $list->grocerylistItems;

		$newList = array();
        $names = $request->input('name');
	    $qtys = $request->input('qty');
	    $actives = $request->input('active');
		$itemInfoList = array();
        for($i=0;$i<count($names);$i++){
	        if($names[$i] != "") {
		        $itemInfo = ItemInfo::firstOrCreate(['name' => $names[$i]]);

		        $newGroceryItem = $list->groceryListItems()->where('item_info_id','=',$itemInfo->id)->first();
		        $groceryIdList = $groceryListItems->map(function($item, $key){
			        return $item->id;
		        });


		        //dd($groceryIdList);
		        //dd($newGroceryItem);

		        if(isset($newGroceryItem) && (($key = $groceryListItems->search($newGroceryItem)) !==false )){
			        //dd($groceryListItems);


			        $groceryListItems->forget($key);
			        //dd($groceryListItems);
			        $newGroceryItem->qty = $qtys[$i];
			        $newGroceryItem->active = $actives[$i];
			        $newGroceryItem->save();


			        $newList[] = $newGroceryItem;
		        }
		        else{

			        $newGroceryItem = new GroceryListItem(['qty' => $qtys[$i], 'active' => $actives[$i]]);
			        $newGroceryItem->groceryList()->associate($list);
			        $newGroceryItem->itemInfo()->associate($itemInfo);
			        $newGroceryItem->save();
			        $newList[] = $newGroceryItem;
		        }
	        }
        }
	    foreach($groceryListItems as $delItem){
		    echo '<p>' . "DELETE" . '</p>' ;
		    $delItem->delete();
	    }




	    //$items = $newList;
	    $items = $list->groceryListItems;
	    //$groceryList = $groceryLists(0);
	    return view('grocery_list', ['user' => $user,'list' => $list, 'items' => $items]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
