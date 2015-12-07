<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RecentList;
use Auth;
use App\RecentListItem;
use App\Http\Requests;
use App\Store;
use App\Item;
use App\Http\Controllers\Controller;

class RecentListController extends Controller
{

    public function saveList(Request $request){
        //get info from $request
        $flag = $request->input('choose_button');
        $storeId = $request->input('store')[$flag];
        $itemInfoIds = $request->input('itemId');
        $qtys = $request->input('qty');

        $user = Auth::user(); //get user


        $user->saveRecentList($flag, $storeId, $itemInfoIds,$qtys);




        return redirect()->route('recent');


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user(); //get user
        $recentList = $user->recentList()->with('store')->first();
        if($recentList == null){
            return view('error',['message' => 'Sorry, You do no have a Recent List yet.']);
        }
        //dd($recentList);
        $store = $recentList->store;
        $total = $recentList->totalPrice();
        $recentListItems = $recentList->recentListItems()->with('item')->get();
        //dd($recentListItems);

        return view('recent', ['total' => $total,'recentListItems' => $recentListItems, 'store' => $store]);
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


        $amounts = $request->input('amount');
        $ids = $request->input('itemIds');
        //dd($request);
        $flag = "whoops";
        foreach($amounts as $key => $amount){
            if(is_numeric($amount)){
                $flag = 'good';
                $val = number_format($amount * 100 ,0,'','');
                $item = Item::findorFail($ids[$key]);
                $item->price = $val;
                $item->save();

            }

        }
        if($flag == "whoops"){
            return redirect()->route('recent')->with('imessage','You did not enter any prices!');
        }

        return redirect()->route('recent')->with('gmessage', 'Your prices have been saved!');
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
