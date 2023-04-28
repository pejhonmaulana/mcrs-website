<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tempat_kuliner_id');
            $table->integer('tempat_parkir')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('pegawai')->nullable();
            $table->integer('menu')->nullable();
            $table->integer('akses_jalan')->nullable();
            $table->integer('musholla')->nullable();
            $table->integer('overall')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tempat_kuliner_id')->references('id')->on('tempat_kuliners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};
