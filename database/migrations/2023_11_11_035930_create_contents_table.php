<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->text('full_html')->nullable(); // 全体のHTML構造
            $table->text('body_html')->nullable(); // <body>タグ内のHTML
            $table->text('style_css')->nullable(); // CSSスタイル
            $table->text('script_js')->nullable(); // JavaScriptコード
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
