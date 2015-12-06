<?php

use Illuminate\Database\Seeder;
use App\Store;
use App\StoreType;
use App\User;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $walmart = StoreType::create(array('type' => 'Walmart'));

        $target = StoreType::create(array('type' => 'Target'));

	    $publix = StoreType::create(array('type' => 'Publix'));

	    $winnDixie = StoreType::create(array('type' => 'Winn-Dixie'));

        $w1 = new Store(array('address' => '1501 Skyland Blvd E',
            'city' => 'Tuscaloosa',
            'state' => 'AL',
            'zipcode' => '35405'));

        $w2 = new Store(array('address' => '5710 McFarland Blvd',
            'city' => 'Northport',
            'state' => 'AL',
            'zipcode' => '35476'));

        $t1 = new Store(array('address' => '1901 13th Ave E',
            'city' => 'Tuscaloosa',
            'state' => 'AL',
            'zipcode' => '35404'));


        $walmart->stores()->saveMany([$w1,$w2]);
        $target->stores()->save($t1);

        $users = User::all();
	    foreach($users as $user){
		    $user->stores()->saveMany([$w1,$w2,$t1]);
	    }

	    $p1 = new Store(array('address' => '2300 McFarland Blvd',
		    'city' => 'Northport',
		    'state' => 'AL',
		    'zipcode' => '35476'));

	    $p2 = new Store(array('address' => '1190 University Blvd',
		    'city' => 'Tuscaloosa',
		    'state' => 'AL',
		    'zipcode' => '35401'));

	    $p3 = new Store(array('address' => '4851 Rice Mine Rd NE #200',
		    'city' => 'Tuscaloosa',
		    'state' => 'AL',
		    'zipcode' => '35406'));

	    $p4 = new Store(array('address' => '1101 Southview Ln',
		    'city' => 'Tuscaloosa',
		    'state' => 'AL',
		    'zipcode' => '35405'));


	    $wn1 = new Store(array('address' => '10 McFarland Blvd',
		    'city' => 'Northport',
		    'state' => 'AL',
		    'zipcode' => '35476'));

	    $wn2 = new Store(array('address' => '4205 University Blvd E',
		    'city' => 'Tuscaloosa',
		    'state' => 'AL',
		    'zipcode' => '35404'));

	    $wn3 = new Store(array('address' => '9750 Alabama Hwy 69 S',
		    'city' => 'Tuscaloosa',
		    'state' => 'AL',
		    'zipcode' => '35405'));

	    $publix->stores()->saveMany([$p1,$p2,$p3,$p4]);
	    $winnDixie->stores()->saveMany([$wn1,$wn2,$wn3]);


    }
}
