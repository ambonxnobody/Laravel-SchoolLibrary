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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->unique();
            $table->longText('sinopsis')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('pengarang')->nullable();
            $table->integer('halaman')->nullable();
            $table->text('cover')->nullable();
            $table->year('tahunRilis')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('ebooks');
    }
};
