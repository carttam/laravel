<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index();
            $table->unsignedTinyInteger('level')->unique();
        });
        \Illuminate\Support\Facades\DB::table('role')->insert(['type' => 'کاربر عادی', 'level' => '0']);
        \Illuminate\Support\Facades\DB::table('role')->insert(['type' => 'مدیر ارشد', 'level' => '255']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
