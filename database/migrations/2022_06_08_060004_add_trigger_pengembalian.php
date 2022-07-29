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
            'CREATE TRIGGER pengembalian AFTER INSERT ON pengembalians FOR EACH ROW
            BEGIN
                UPDATE peminjamen p SET p.jumlah = p.jumlah - NEW.jumlah WHERE p.id = NEW.peminjaman_id;
            END'
        );
        // DB::unprepared(
        //     'CREATE TRIGGER ubah_pengembalian AFTER UPDATE ON pengembalians FOR EACH ROW
        //     BEGIN
        //         UPDATE peminjamen p SET p.jumlah = p.jumlah - NEW.jumlah + OLD.jumlah WHERE p.id = NEW.peminjaman_id;
        //     END'
        // );
        DB::unprepared(
            'CREATE TRIGGER hapus_pengembalian AFTER DELETE ON pengembalians FOR EACH ROW
            BEGIN
                UPDATE peminjamen p SET p.jumlah = p.jumlah + OLD.jumlah WHERE p.id = OLD.peminjaman_id;
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
        DB::unprepared('DROP TRIGGER `pengembalian`');
        // DB::unprepared('DROP TRIGGER `ubah_pengembalian`');
        DB::unprepared('DROP TRIGGER `hapus_pengembalian`');
    }
};
