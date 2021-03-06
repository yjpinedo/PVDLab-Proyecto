<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('progress', array_keys(__('app.selects.course.progress')))->default(__('app.selects.course.progress.INSCRITO'));
            $table->unsignedInteger('beneficiary_id');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
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
        Schema::dropIfExists('beneficiary_course');
    }
}
