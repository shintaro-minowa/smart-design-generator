<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGptLogsTable extends Migration
{
    public function up()
    {
        Schema::create('gpt_logs', function (Blueprint $table) {
            $table->id();
            $table->json('request');
            $table->json('response');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gpt_logs');
    }
}
