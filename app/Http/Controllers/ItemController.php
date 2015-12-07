<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Store;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;

class ItemController extends Controller
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
	    $items = $list->getActiveItems();


	    $storeInfo = $list->getOrderedStores( $items );
        //dd( array_slice($storeInfo,0,3));


        //need to warn if no stores!!
        if(empty($storeInfo)){
	        return view('error',['message'=> 'Sorry, you need to add a store before you can compare prices.']);
        }
	    elseif($items->count() == 0){
		    return view('error',['message' => 'Sorry, you need to add items to your shopping list.']);
	    }
	    else{
		    return view('compare_list',['user' => $user,'list' => $list, 'items' => $items ,'store' => array_slice($storeInfo,0,3)]);
	    }

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
        //
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
