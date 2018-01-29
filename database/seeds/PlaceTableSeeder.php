<?php

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlaceTableSeeder extends Seeder
{
	public function run()
	{
    	DB::table('places')->truncate();

  		$place = new Place();
        $place->title = 'Minkin koti';
				$place->description = 'Koti rauhallisella seudulla';
        $place->lat = 60.2026;
        $place->lng = 24.7224;
				$place->open_hours = '08:00-16:00';
				$place->favorite = false;
		    $place->save();
    }
}
