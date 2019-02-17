<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('desc');
            $table->string('email');
            $table->string('phone');
            $table->string('website');
            $table->integer('price');
            $table->string('address1');
            $table->string('city');
            $table->string('state',20);
            $table->string('zipcode',20);
            $table->text('owner_name');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spots');
    }
}
