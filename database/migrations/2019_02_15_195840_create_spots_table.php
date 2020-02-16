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
            $table->bigIncrements('id');
            $table->string('name');
            
            $table->text('desc');
            $table->string('email');
            $table->string('phone');
            $table->string('website')->nullable();

            $table->integer('baths');
            $table->integer('beds');
            $table->integer('sleeps');
            $table->integer('sqft');

            $table->string('address1');
            $table->string('city');
            $table->string('state', 20);
            $table->string('postal_code', 20);
            $table->decimal('lng', 10, 7)->nullable();
            $table->decimal('lat', 10, 7)->nullable();

            $table->boolean('is_approved')->default(false);
            $table->smallInteger('moderation_status')->default(0);
            $table->integer('moderated_by')->unsigned()->nullable();
            $table->datetime('moderated_at')->nullable();
            $table->unsignedInteger('owner_id');
            $table->softDeletes();
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
