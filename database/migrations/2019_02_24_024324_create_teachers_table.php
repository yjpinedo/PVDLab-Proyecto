<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('document_type', array_keys(__('app.selects.person.document_type')));
            $table->string('document', 12)->unique();
            $table->string('expedition_place', 50)->nullable();
            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->date('birth_date');
            $table->string('place_of_birth',50)->nullable();
            $table->enum('sex', array_keys(__('app.selects.person.sex')));
            $table->string('address', 50);
            $table->string('neighborhood', 50);
            $table->string('phone', 15)->nullable();
            $table->string('cellphone', 15)->nullable();
            $table->string('email')->unique();
            $table->string('title', 100)->nullable();
            $table->enum('title_type', array_keys(__('app.selects.teacher.title_type')))->nullable();
            $table->string('collage', 100)->nullable();
            $table->string('year', 4)->nullable();
            $table->enum('state', array_keys(__('app.selects.state')))->default(__('app.selects.state.ACTIVO'));
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
        Schema::dropIfExists('teachers');
    }
}
