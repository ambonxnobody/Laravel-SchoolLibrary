<?php

use Illuminate\Support\Facades\DB;
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
        DB::unprepared(
            'CREATE TRIGGER peminjaman AFTER INSERT ON peminjamen FOR EACH ROW
            BEGIN
                UPDATE bukus b SET b.stok = b.stok - NEW.jumlah WHERE b.id = NEW.buku_id;
            END'
        );
        DB::unprepared(
            'CREATE TRIGGER ubah_peminjaman AFTER UPDATE ON peminjamen FOR EACH ROW
            BEGIN
                UPDATE bukus b SET b.stok = b.stok - NEW.jumlah + OLD.jumlah WHERE b.id = NEW.buku_id;
            END'
        );
        DB::unprepared(
            'CREATE TRIGGER hapus_peminjaman AFTER DELETE ON peminjamen FOR EACH ROW
            BEGIN
                UPDATE bukus b SET b.stok = b.stok + OLD.jumlah WHERE b.id = OLD.buku_id;
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `peminjaman`');
        DB::unprepared('DROP TRIGGER `ubah_peminjaman`');
        DB::unprepared('DROP TRIGGER `hapus_peminjaman`');
    }
};
