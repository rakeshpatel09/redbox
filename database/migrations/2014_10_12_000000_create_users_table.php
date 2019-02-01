<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('users_id')->unique();
            $table->string('user_name');
            $table->string('father_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            
            $table->string('address');
            $table->integer('city')->nullable();
            $table->string('district')->nullable();
            $table->integer('state')->nullable();
            $table->integer('country')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('nominee_email_id')->nullable();
            $table->string('adhar_photo')->nullable();
            $table->string('pan_photo')->nullable();
            $table->integer('user_status')->nullable();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
