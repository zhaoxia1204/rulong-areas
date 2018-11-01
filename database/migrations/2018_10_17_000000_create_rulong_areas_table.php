<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulongAreasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rulong_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sn')->unsigned();
            $table->integer('psn')->unsigned();
            $table->string('province');
            $table->string('city');
            $table->string('area');
            $table->string('name');
            $table->string('shortname');
            $table->string('type', 50);
            $table->string('cnname');
            $table->string('enname');
            $table->string('info');
            $table->string('shortinfo');
            $table->integer('zone')->unsigned();
            $table->integer('zip')->unsigned();
            $table->decimal('lng', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->integer('depth')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rulong_areas');
    }

}
