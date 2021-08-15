<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('national_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('image')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('overview')->nullable()->default("Threre is No Overview");
            $table->string('university')->nullable();
            $table->string('specialization')->nullable();
            $table->string('experience')->nullable()->default("Threre is No Experience");
            $table->integer('rate')->default(0);
            $table->string('credit')->default(0);
            $table->enum('type', ['developer', 'client']);
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
