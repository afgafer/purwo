<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',33);
            $table->string('file',100);
            $table->text('desc');
            //$table->dateTime('waktu');
            $table->enum('status',['0','1','2']);
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            //$table->string('uploader',33);
            $table->unsignedBigInteger('dest_id');
            $table->index('dest_id');
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
        Schema::dropIfExists('images');
    }
}
