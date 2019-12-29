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
            $table->bigIncrements('id');

            $table->string('email')->unique();
            $table->string('email_verification_code')->nullable();
            $table->unsignedTinyInteger('email_verified')->default(0);
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('full_name')->nullable();

            $table->string('phone_number', 20)->nullable();
            $table->text('avatar')->nullable();
            $table->date('dob')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->enum('role', ['normal_user', 'loyal_user', 'admin'])->default('normal_user');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('points')->default(0);

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
