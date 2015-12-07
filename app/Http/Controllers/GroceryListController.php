<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\User;
use App\ItemInfo;
use Auth;
use App\GroceryList;
use DB;
use Illuminate\Support\Collection;

class GroceryListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    if(!Auth::check()){
		    return view('grocery_list', ['user' => 0, 'items' => new Collection()]);
	    }
	    $user = Auth::user();
	    $list = GroceryList::firstOrCreate(['user_id' => $user->id]);
	    $items = $list->groceryListItems()->orderBy('position')->get();

	    //$groceryList = $groceryLists(0);
        return view('grocery_list', ['user' => 1,'list' => $list, 'items' => $items]);
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


        $flag = 'good';
	    $user = Auth::user();
		$list = Grocerylist::where('user_id', $user->id)->first();
	    $items = $list->storeChanges($request);

	    $button = $request->input('compare_button');
		if(isset($button)){
			return redirect()->route('comp');
		}
	    else{
            if(!empty($items) ){
                return Redirect::route('shopping')->with('gmessage', ' Your items have been saved!');
            }
            else{
                return Redirect::route('shopping')->with('bmessage', ' You removed all of your Items!');
            }

	    }





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
