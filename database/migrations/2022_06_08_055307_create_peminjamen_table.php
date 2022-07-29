<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('jumlah');
            $table->integer('arsip');
            $table->enum('status', ['Dipinjam', 'Dikembalikan', 'Waktunya Dikembalikan', 'Penyerahan']);
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('peminjamen');
    }
};
