<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimationSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimation_spaces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('estimation_id');
            $table->foreign('estimation_id')->references('id')->on('estimations')->onDelete('cascade');
            $table->string('name');
            $table->decimal('size_x', 5, 2);
            $table->decimal('size_y', 5, 2);
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
        Schema::drop('estimation_spaces');
    }
}
