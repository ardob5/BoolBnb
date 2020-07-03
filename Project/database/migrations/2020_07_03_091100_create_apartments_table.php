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

            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->integer('room_number');
            $table->integer('bath_number');
            $table->integer('area');
            $table->string('address');
            $table->string('image');
            $table->float('latitude');
            $table->float('longitude');
            $table->bigInteger('views') -> default(0);

            $table->bigInteger('user_id') -> unsigned() -> index();

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
