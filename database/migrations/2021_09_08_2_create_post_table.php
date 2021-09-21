<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_type');
            $table->timestamps();
        });
        Storage::disk('public')->makeDirectory('upload');
        shell_exec('sudo chmod 777 -R '. storage_path('app/public/upload/'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $posts = \Illuminate\Support\Facades\DB::table('post');
        foreach ($posts as $post) {
            Schema::dropIfExists('comment_' . $post->id);
        }
        Storage::disk('public')->deleteDir('upload');
        Schema::dropIfExists('post');
    }
}
