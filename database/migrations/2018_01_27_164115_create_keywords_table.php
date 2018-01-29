<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label',124)->unique();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('keyword_place', function (Blueprint $table) {
            $table->integer('place_id');
            $table->integer('keyword_id');
            $table->primary(['place_id', 'keyword_id']);

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keywords');

        Schema::dropIfExists('keyword_place');
    }
}
