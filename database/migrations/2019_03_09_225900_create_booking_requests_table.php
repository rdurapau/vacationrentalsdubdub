<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('spot_id');
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->string('name',100);
            $table->string('phone',50);
            $table->string('email',70);
            $table->string('dates',50);
            $table->timestamp('created_at')->useCurrent();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_requests');
    }
}
