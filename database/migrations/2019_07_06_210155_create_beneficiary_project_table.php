<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_project', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('beneficiary_id');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('beneficiary_project');
    }
}
