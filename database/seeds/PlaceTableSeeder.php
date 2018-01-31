<?php

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlaceTableSeeder extends Seeder
{
	public function run()
	{
    	DB::table('places')->truncate();

  		$place = new Place();
        $place->title = 'Lauttasaaren kirkko';
				$place->description = 'Lauttasaaren kirkko sijaitsee Helsingissä, Lauttasaaren kaupunginosassa. Se vihittiin käyttöön 20. syyskuuta 1958';
        $place->lat = 60.16;
        $place->lng = 24.87;
				$place->open_hours = '09:00-21:00';
				$place->favorite = false;
		    $place->save();
			
				$place = new Place();
				$place->title = 'Linnanmäki';
				$place->description = 'Linnanmäki on Helsingissä Alppiharjun kaupunginosassa sijaitseva huvipuisto, joka avattiin vuonna 1950. Linnanmäellä on yli neljäkymmentä erilaista huvipuistolaitetta.';
				$place->lat = 60.19;
				$place->lng = 24.94;
				$place->open_hours = '09:00-20:00';
				$place->favorite = false;
				$place->save();

				$place = new Place();
				$place->title = 'Korkeasaaren eläintarha';
				$place->description = 'Korkeasaari on yksi maailman vanhimmista eläintarhoista. Korkeasaaressa pääset tutustumaan yli 150 eläinlajiin ja satoihin kasvilajeihin ympäri maailmaa.';
				$place->lat = 60.18;
				$place->lng = 24.98;
				$place->open_hours = '10:00-16:00';
				$place->favorite = true;
				$place->save();

				$place = new Place();
				$place->title = 'Näköalaravintola Haikaranpesä';
				$place->description = 'Haukilahden vesitornissa, 76 metriä merenpinnan yläpuolella sijaitseva näköalaravintola.';
				$place->lat = 60.16;
				$place->lng = 24.77;
				$place->open_hours = '11:00-16:00';
				$place->favorite = true;
				$place->save();
    }
}
