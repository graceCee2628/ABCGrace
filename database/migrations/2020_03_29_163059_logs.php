<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Logs extends Migration
{

    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_id')->nullable();
            $table->string('name')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        
    }
}
