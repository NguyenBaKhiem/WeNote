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
            $table->string('password');
            $table->string('email_verification_code')->nullable();
            $table->unsignedTinyInteger('email_verified')->default(0);
            $table->unsignedTinyInteger('is_notified')->default(1)->comment('enable/disable notification');
            $table->string('username')->nullable();
            $table->string('phone_no', 20)->nullable();
            $table->string('full_name')->nullable();
            $table->date('dob')->nullable()->comment("date of birth");
            $table->unsignedTinyInteger('gender')->comment('sex of user, 1:male, 0:female]');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('avatar')->nullable();
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
