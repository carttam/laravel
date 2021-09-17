<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('full_name','80')->index();
            $table->string('email')->unique()->index();
            $table->string('password')->index();
            $table->string('secret_key','65')->unique()->nullable()->index();
            $table->string('phone_number','10')->unique();
            $table->unsignedBigInteger('role_id')->index();
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('user');
    }
}
