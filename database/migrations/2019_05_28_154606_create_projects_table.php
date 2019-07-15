<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name', 90);
            $table->dateTime('date');
            $table->dateTime('start');
            $table->enum('type',  array_keys(__('app.selects.project.type')));
            $table->string('other_type', 90)->nullable();
            $table->string('description', 200);
            $table->enum('origin',  array_keys(__('app.selects.project.origin')));
            $table->string('other_origin', 90)->nullable();
            $table->enum('state',  array_keys(__('app.selects.project.state')));
            $table->enum('financing',  array_keys(__('app.selects.project.financing')));
            $table->string('financial_entity', 90)->nullable();
            $table->string('financing_description', 200)->nullable();
            $table->string('observations', 200)->nullable();
            $table->enum('concept',  array_keys(__('app.selects.project.concept')))->default('PENDIENTE');
            $table->unsignedInteger('beneficiary_id');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries');
            $table->unsignedInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->dateTime('reviewed_at');
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
        Schema::dropIfExists('projects');
    }
}
