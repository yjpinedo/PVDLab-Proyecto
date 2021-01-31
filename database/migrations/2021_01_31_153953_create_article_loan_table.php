<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_loan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id')->references('id')->on('loans');
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
        Schema::dropIfExists('article_loan');
    }
}
