<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('title');
	        $table->text('description');
	        $table->string('member_link');
	        $table->string('free_link');
	        $table->string('share_link');
	        $table->longText('og_image');
	        $table->longText('files')->nullable();
	        $table->longText('categories')->nullable();
	        $table->integer('upgrade_link')->nullable();
	        $table->integer('notation')->nullable();
	        $table->integer('keyboard')->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
