<?php

use App\Models\Keyword;
use Illuminate\Database\Seeder;

class KeywordTableSeeder extends Seeder
{
	public function run()
	{
    	DB::table('keywords')->truncate();

  		$keyword = new Keyword();
        $keyword->label = 'Ravintola';
		    $keyword->save();
    }
}
