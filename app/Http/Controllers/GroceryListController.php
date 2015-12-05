<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Redirect;
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
	    $items = $list->groceryListItems()->orderBy('position')->get();

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
	    $items = $list->storeChanges($request);
	    $button = $request->input('compare_button');
		if(isset($button)){
			return redirect()->route('comp');
		}
	    else{
		    return view('grocery_list', ['user' => $user,'list' => $list, 'items' => $items]);
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
