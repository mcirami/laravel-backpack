<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTableTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
	        $table->string('username')->nullable();
	        $table->string('address')->nullable();
	        $table->string('city')->nullable();
	        $table->string('state')->nullable();
	        $table->integer('postal_code')->nullable();
	        $table->string('country')->nullable();
	        $table->integer('phone')->nullable();
	        $table->integer('cvv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
