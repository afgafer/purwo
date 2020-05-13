<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',33);
            $table->string('file',100)->nullable();
            $table->string('contact',13);
            $table->text('address');
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->text('desc')->nullable();
            //$table->bigInteger('id_user')->unsigned()->unique();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
