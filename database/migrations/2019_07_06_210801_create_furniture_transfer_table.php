<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurnitureTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture_transfer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('furniture_id');
            $table->foreign('furniture_id')->references('id')->on('furniture');
            $table->unsignedInteger('transfer_id');
            $table->foreign('transfer_id')->references('id')->on('transfers');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniture_transfer');
    }
}
