<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token',30)->unique();
            $table->unsignedBigInteger('spot_id');
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->datetime('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edit_tokens');
    }
}
