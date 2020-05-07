<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('meals', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
           // $table->integer('user_id');
            //$table->string('kegiatan_id');
             $table->unsignedInteger('user_id');
              $table->unsignedInteger('kegiatan_id');
            $table->string('ns_siang',5)->nullable();
            $table->string('tkno_siang',5)->nullable();
            $table->string('tamu_siang',5)->nullable();

            $table->string('ss_malam',5)->nullable();
            $table->string('ns_malam',5)->nullable();
            $table->string('tkno_malam',5)->nullable();
            $table->string('tamu_malam',5)->nullable();

            $table->string('ss_lembur',5)->nullable();
            $table->string('ns_lembur',5)->nullable();
            $table->string('tkno_lembur',5)->nullable();
            $table->string('tamu_lembur',5)->nullable();

            $table->timestamps();
           
            $table->foreign('user_id')->references('id')-> on('users')-> onDelete('cascade');
            $table->foreign('kegiatan_id')->references('id')-> on('kegiatans')-> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
