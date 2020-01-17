<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitySpotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenity_spot', function (Blueprint $table) {
            $table->bigInteger('amenity_id')->unsigned()->index();
            $table->foreign('amenity_id')->references('id')->on('amenities');
            $table->bigInteger('spot_id')->unsigned()->index();
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->primary(['spot_id', 'amenity_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenity_spot');
    }
}
