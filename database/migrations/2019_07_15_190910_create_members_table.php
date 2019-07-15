<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('document_type', array_keys(__('app.selects.person.document_type')));
            $table->string('document', 12)->unique();
            $table->string('name', 50);
            $table->string('last_name',50);;
            $table->enum('sex', array_keys(__('app.selects.person.sex')));
            $table->date('birth_date');
            $table->string('place_of_birth',50);
            $table->string('address', 50);
            $table->string('neighborhood', 50);
            $table->string('phone', 15)->nullable();
            $table->string('cellphone', 15)->nullable();
            $table->string('email')->unique();
            $table->string('occupation', 70)->nullable();
            $table->enum('ethnic_group',  array_keys(__('app.selects.person.ethnic_group')));
            $table->string('other_ethnic_group', 90)->nullable();
            $table->enum('stratum', array_keys(__('app.selects.person.stratum')));
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
        Schema::dropIfExists('members');
    }
}
