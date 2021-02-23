<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChainesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chaines', function (Blueprint $table) {
            $table->id();

            $table->string('chaine_name', 100);
            $table->integer('view')->nullable()->default(0);
            $table->integer('like')->nullable()->default(0);
            $table->string('categorie', 500)->default('All');
           
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
        Schema::dropIfExists('chaines');
    }
}
