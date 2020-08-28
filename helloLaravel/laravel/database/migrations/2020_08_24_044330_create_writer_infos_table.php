<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWriterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('writer_infos', function (Blueprint $table) {
            $table->bigIncrements('id');                // 게시글 번호
            $table->bigInteger('board_pid')->default('0');  // 게시글 덧글용 번호
            $table->string('user_id');                         // 작성자 ID
            $table->string('genre')->default('무관');    // 글 장르
            $table->string('title');                          // 글 제목
            $table->longText('contents');                     // 글 내용
            $table->timestamps();                                    // 날짜

            $table->foreign('user_id')->references('name')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('writer_infos');
    }
}
