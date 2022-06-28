<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('title',150);
            $table->text('description');
            $table->smallInteger('squared_meters');
            $table->string('address',255);
            $table->float('lat',7,5);
            $table->float('lng',7,5);
            $table->tinyInteger('room_number');
            $table->tinyInteger('bed_number');
            $table->tinyInteger('bath_number');
            $table->boolean('is_visible')->default(true);
            $table->float('daily_price',6,2);
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
        Schema::dropIfExists('apartments');
    }
}
