<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $both = $user->bothStores();

        //dd($stores);
        return view('store',['user' => $user, 'myStores' => $both[0], 'otherStores' => $both[1]]);
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
	    $stores = $request->input('store');
	    $flag = '';
	    if(isset($stores)){
		    $flag = $user->newStores($stores);
	    }
	    else{
		    $flag = $user->newStores([]);
	    }

	    if($flag == 'good'){
		    return Redirect::route('stores')->with('gmessage', ' Your stores have been saved!');
	    }
	    elseif($flag == 'bad'){
		    return Redirect::route('stores')->with('bmessage', ' You removed all of your stores!');
	    }
	    elseif($flag == 'no change'){
		    return Redirect::route('stores')->with('imessage', ' No new Stores were saved');
	    }



	    //return view('store',['user' => $user, 'myStores' => $both[0], 'otherStores' => $both[1]])->with('message','Completed!');

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
