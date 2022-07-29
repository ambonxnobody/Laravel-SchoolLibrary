<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Wali Kelas',
            'username' => 'wali-kelas',
            'role' => 'wali-kelas',
            'kelas_id' => '1',
        ]);
        User::factory()->create([
            'name' => 'Guru',
            'username' => 'guru',
            'role' => 'guru',
        ]);
        User::factory()->create([
            'name' => 'Siswa',
            'username' => 'siswa',
            'role' => 'siswa',
            'kelas_id' => '1',
        ]);

        // User::factory(4)->create([
        //     'role' => 'admin',
        // ]);


        //GURU START
        /*
            User::factory(8)->create([
                'role' => 'guru',
            ]);
            for ($i = 1; $i <= 14; $i++) {
                User::factory()->create([
                    'kelas_id' => $i,
                    'role' => 'wali-kelas',
                ]);
            }
        */
        //GURU END

        //SISWA START
        /*
            User::factory(24)->create([
                'kelas_id' => '1',
                'role' => 'siswa',
            ]);
            User::factory(24)->create([
                'kelas_id' => '2',
                'role' => 'siswa',
            ]);
            User::factory(22)->create([
                'kelas_id' => '3',
                'role' => 'siswa',
            ]);
            User::factory(21)->create([
                'kelas_id' => '4',
                'role' => 'siswa',
            ]);
            User::factory(27)->create([
                'kelas_id' => '5',
                'role' => 'siswa',
            ]);
            User::factory(27)->create([
                'kelas_id' => '6',
                'role' => 'siswa',
            ]);
            User::factory(27)->create([
                'kelas_id' => '7',
                'role' => 'siswa',
            ]);
            User::factory(27)->create([
                'kelas_id' => '8',
                'role' => 'siswa',
            ]);
            User::factory(28)->create([
                'kelas_id' => '9',
                'role' => 'siswa',
            ]);
            User::factory(30)->create([
                'kelas_id' => '10',
                'role' => 'siswa',
            ]);
            User::factory(30)->create([
                'kelas_id' => '11',
                'role' => 'siswa',
            ]);
            User::factory(28)->create([
                'kelas_id' => '12',
                'role' => 'siswa',
            ]);
            User::factory(25)->create([
                'kelas_id' => '13',
                'role' => 'siswa',
            ]);
            User::factory(26)->create([
                'kelas_id' => '14',
                'role' => 'siswa',
            ]);
        */
        //SISWA END

        // BUKU & E-BOOK START
        Buku::create([
            'judul' => 'BINA FIQIH 6 untuk MI Kelas VI',
            'stok' => 10,
            'jumlah' => 10,
            'sinopsis' => '<p>Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual.</p><p>Keunggulan produk:</p><p>- Dilengkapi dengan info fiqih, berisi uraian seputar kajian fiqih sebagai tambahan pengetahuan terkait materi yang sedang dipelajari.</p><p>- Studi kasus, berisi kasus-kasus yang berkaitan dengan kehidupan sehari-hari untuk melatih keterampilan berpikir siswa dalam menyelesaikan masalah.</p><p>- Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami hukum-hukum atau syariat Islam dengan lebih baik.</p>',
            'excerpt' => 'Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'TIM BKG',
            'cover' => 'cover-buku/1.jpg',
            'tahunRilis' => '2021',
        ]);
        Buku::create([
            'judul' => 'BINA FIQIH 5 untuk MI Kelas V',
            'stok' => 10,
            'jumlah' => 10,
            'sinopsis' => '<p>Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual.</p><p>Keunggulan produk:</p><p>- Dilengkapi dengan info fiqih, berisi uraian seputar kajian fiqih sebagai tambahan pengetahuan terkait materi yang sedang dipelajari.</p><p>- Studi kasus, berisi kasus-kasus yang berkaitan dengan kehidupan sehari-hari untuk melatih keterampilan berpikir siswa dalam menyelesaikan masalah.</p><p>- Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami hukum-hukum atau syariat Islam dengan lebih baik.</p>',
            'excerpt' => 'Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'TIM BKG',
            'cover' => 'cover-buku/2.jpg',
            'tahunRilis' => '2021',
        ]);
        Buku::create([
            'judul' => 'ESPS MATEMATIKA 5 SD Kelas V',
            'stok' => 5,
            'jumlah' => 5,
            'sinopsis' => '<p>Erlangga Straight Point Series (ESPS) Matematika disusun berdasarkan Kurikulum 2013 Revisi.</p><p>A. Materi pembelajaran simple dan modern</p><p>- Simple, materi disajikan dengan visualisasi yang jelas, sehingga siswa dapat memahami Ilmu Pengetahuan Alam dengan mudah.</p><p>- Modern, buku ini didukung oleh media pembelajaran dalam bentuk digital agar peserta didik dapat memahami </p>penjelasan materi.</p><p>B. Mengacu pada penilaian pengetahuan, keterampilan, dan sikap</p><p>- Kegiatan disajikan sebagai sarana untuk menilai aspek keterampilan dan sikap.</p><p>- Latihan ulangan disajikan sebagai sarana menilai aspek pengetahuan.</p>',
            'excerpt' => 'Erlangga Straight Point Series (ESPS) Matematika disusun berdasarkan Kurikulum 2013 Revisi...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'Gunanto & Dhesy Adhalia',
            'cover' => 'cover-buku/3.jpg',
            'tahunRilis' => '2020',
        ]);
        Buku::create([
            'judul' => 'Buku IPA klas 6 Revisi,  Erlangga.',
            'stok' => 5,
            'jumlah' => 5,
            'penerbit' => 'Erlangga',
            'pengarang' => 'Irene & Khristiyono',
            'cover' => 'cover-buku/4.jpg',
            'tahunRilis' => '2013',
        ]);
        Buku::create([
            'judul' => 'BINA BELAJAR AL-QURAN & HADITS 4 untuk MI Kelas IV',
            'stok' => 7,
            'jumlah' => 7,
            'sinopsis' => '<p>Buku Bina Al-Quran dan Hadits ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual.</p><p>Keunggulan produk:</p><p>- Dilengkapi dengan fitur tilawah dan disertai dengan penerjemahan arti per kata.</p><p>- Studi kasus, berisi kasus-kasus yang berkaitan dengan kehidupan sehari-hari untuk melatih keterampilan berpikir siswa dalam menyelesaikan masalah.</p><p>- Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami dan menghayati kandungan dalam Al-Quran dan Hadits.</p>',
            'excerpt' => 'Buku Bina Al-Quran dan Hadits ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'TIM BKG',
            'cover' => 'cover-buku/5.jpg',
            'tahunRilis' => '2021',
        ]);
        Buku::create([
            'judul' => 'AYO BELAJAR BAHASA ARAB 3 untuk MI Kelas III',
            'stok' => 7,
            'jumlah' => 7,
            'sinopsis' => '<p>Buku Ayo Belajar Bahasa Arab ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Buku ini memuat materi kosakata baru, percakapan, bacaan serta latihan-latihan sederhana untuk meningkatkan kemampuan siswa dalam berbahasa Arab.</p><p>Keunggulan produk:</p><p>Dilengkapi dengan ilustrasi menarik agar proses pembelajaran lebih menyenangkan dan tidak membosankan.</p><p>QR Code yang berisi audio, untuk mengasah keterampilan mendengar peserta didik.</p><p>Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami dan menghayati kandungan dalam Al-Quran dan Hadits.</p>',
            'excerpt' => 'Buku Ayo Belajar Bahasa Arab ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Buku ini memuat materi kosakata baru, percakapan, bacaan serta latihan-latihan sederhana untuk meningkatkan kemampuan siswa dalam berbahasa Arab...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'Firman Hamdani',
            'cover' => 'cover-buku/6.jpg',
            'tahunRilis' => '2021',
        ]);

        Ebook::create([
            'judul' => 'BINA FIQIH 6 untuk MI Kelas VI',
            'sinopsis' => '<p>Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual.</p><p>Keunggulan produk:</p><p>- Dilengkapi dengan info fiqih, berisi uraian seputar kajian fiqih sebagai tambahan pengetahuan terkait materi yang sedang dipelajari.</p><p>- Studi kasus, berisi kasus-kasus yang berkaitan dengan kehidupan sehari-hari untuk melatih keterampilan berpikir siswa dalam menyelesaikan masalah.</p><p>- Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami hukum-hukum atau syariat Islam dengan lebih baik.</p>',
            'excerpt' => 'Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'TIM BKG',
            'cover' => 'cover-buku/1.jpg',
            'tahunRilis' => '2021',
        ]);
        Ebook::create([
            'judul' => 'BINA FIQIH 5 untuk MI Kelas V',
            'sinopsis' => '<p>Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual.</p><p>Keunggulan produk:</p><p>- Dilengkapi dengan info fiqih, berisi uraian seputar kajian fiqih sebagai tambahan pengetahuan terkait materi yang sedang dipelajari.</p><p>- Studi kasus, berisi kasus-kasus yang berkaitan dengan kehidupan sehari-hari untuk melatih keterampilan berpikir siswa dalam menyelesaikan masalah.</p><p>- Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami hukum-hukum atau syariat Islam dengan lebih baik.</p>',
            'excerpt' => 'Buku Fiqih ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'TIM BKG',
            'cover' => 'cover-buku/2.jpg',
            'tahunRilis' => '2021',
        ]);
        Ebook::create([
            'judul' => 'ESPS MATEMATIKA 5 SD Kelas V',
            'sinopsis' => '<p>Erlangga Straight Point Series (ESPS) Matematika disusun berdasarkan Kurikulum 2013 Revisi.</p><p>A. Materi pembelajaran simple dan modern</p><p>- Simple, materi disajikan dengan visualisasi yang jelas, sehingga siswa dapat memahami Ilmu Pengetahuan Alam dengan mudah.</p><p>- Modern, buku ini didukung oleh media pembelajaran dalam bentuk digital agar peserta didik dapat memahami </p>penjelasan materi.</p><p>B. Mengacu pada penilaian pengetahuan, keterampilan, dan sikap</p><p>- Kegiatan disajikan sebagai sarana untuk menilai aspek keterampilan dan sikap.</p><p>- Latihan ulangan disajikan sebagai sarana menilai aspek pengetahuan.</p>',
            'excerpt' => 'Erlangga Straight Point Series (ESPS) Matematika disusun berdasarkan Kurikulum 2013 Revisi...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'Gunanto & Dhesy Adhalia',
            'cover' => 'cover-buku/3.jpg',
            'tahunRilis' => '2020',
        ]);
        Ebook::create([
            'judul' => 'Buku IPA klas 6 Revisi,  Erlangga.',
            'penerbit' => 'Erlangga',
            'pengarang' => 'Irene & Khristiyono',
            'cover' => 'cover-buku/4.jpg',
            'tahunRilis' => '2013',
        ]);
        Ebook::create([
            'judul' => 'BINA BELAJAR AL-QURAN & HADITS 4 untuk MI Kelas IV',
            'sinopsis' => '<p>Buku Bina Al-Quran dan Hadits ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual.</p><p>Keunggulan produk:</p><p>- Dilengkapi dengan fitur tilawah dan disertai dengan penerjemahan arti per kata.</p><p>- Studi kasus, berisi kasus-kasus yang berkaitan dengan kehidupan sehari-hari untuk melatih keterampilan berpikir siswa dalam menyelesaikan masalah.</p><p>- Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami dan menghayati kandungan dalam Al-Quran dan Hadits.</p>',
            'excerpt' => 'Buku Bina Al-Quran dan Hadits ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Materi dalam buku ini dirancang sedemikian rupa sehingga mengarah ke model pembelajaran peserta didik aktif dan pembelajaran kontekstual...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'TIM BKG',
            'cover' => 'cover-buku/5.jpg',
            'tahunRilis' => '2021',
        ]);
        Ebook::create([
            'judul' => 'AYO BELAJAR BAHASA ARAB 3 untuk MI Kelas III',
            'sinopsis' => '<p>Buku Ayo Belajar Bahasa Arab ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Buku ini memuat materi kosakata baru, percakapan, bacaan serta latihan-latihan sederhana untuk meningkatkan kemampuan siswa dalam berbahasa Arab.</p><p>Keunggulan produk:</p><p>Dilengkapi dengan ilustrasi menarik agar proses pembelajaran lebih menyenangkan dan tidak membosankan.</p><p>QR Code yang berisi audio, untuk mengasah keterampilan mendengar peserta didik.</p><p>Beragam aktivitas lainnya yang mendorong peserta didik untuk lebih memahami dan menghayati kandungan dalam Al-Quran dan Hadits.</p>',
            'excerpt' => 'Buku Ayo Belajar Bahasa Arab ini disusun sesuai KIKD KMA No. 183 Tahun 2019. Buku ini memuat materi kosakata baru, percakapan, bacaan serta latihan-latihan sederhana untuk meningkatkan kemampuan siswa dalam berbahasa Arab...',
            'penerbit' => 'Erlangga',
            'pengarang' => 'Firman Hamdani',
            'cover' => 'cover-buku/6.jpg',
            'tahunRilis' => '2021',
        ]);
        // BUKU & E-BOOK END

        // KATEGORI START
        Kategori::create([
            'nama' => 'Mata Pelajaran',
        ]);
        Kategori::create([
            'nama' => 'Fiqih',
        ]);
        Kategori::create([
            'nama' => 'Matematika',
        ]);
        Kategori::create([
            'nama' => 'Ilmu Pengetahuan Alam',
        ]);
        Kategori::create([
            'nama' => 'Al Quran & Hadits',
        ]);
        Kategori::create([
            'nama' => 'Bahasa Arab',
        ]);
        Kategori::create([
            'nama' => 'Novel',
        ]);
        Kategori::create([
            'nama' => 'Cergam',
        ]);
        Kategori::create([
            'nama' => 'Komik',
        ]);
        Kategori::create([
            'nama' => 'Ensiklopedi',
        ]);
        Kategori::create([
            'nama' => 'Nomik',
        ]);
        Kategori::create([
            'nama' => 'Antologi',
        ]);
        Kategori::create([
            'nama' => 'Dongeng',
        ]);
        Kategori::create([
            'nama' => 'Biografi',
        ]);
        Kategori::create([
            'nama' => 'Catatan Harian',
        ]);
        Kategori::create([
            'nama' => 'Novelet',
        ]);
        Kategori::create([
            'nama' => 'Fotografi',
        ]);
        Kategori::create([
            'nama' => 'Karya Ilmiah',
        ]);
        Kategori::create([
            'nama' => 'Tafsir',
        ]);
        Kategori::create([
            'nama' => 'Kamus',
        ]);
        Kategori::create([
            'nama' => 'Panduan',
        ]);
        Kategori::create([
            'nama' => 'Atlas',
        ]);
        Kategori::create([
            'nama' => 'Buku Ilmiah',
        ]);
        Kategori::create([
            'nama' => 'Teks',
        ]);
        Kategori::create([
            'nama' => 'Majalah',
        ]);
        Kategori::create([
            'nama' => 'Buku Digital',
        ]);
        // KATEGORI END

        // KELAS START
        Kelas::create([
            'nama' => '1A'
        ]);
        Kelas::create([
            'nama' => '1B'
        ]);
        Kelas::create([
            'nama' => '2A'
        ]);
        Kelas::create([
            'nama' => '2B'
        ]);
        Kelas::create([
            'nama' => '3A'
        ]);
        Kelas::create([
            'nama' => '3B'
        ]);
        Kelas::create([
            'nama' => '3C'
        ]);
        Kelas::create([
            'nama' => '4A'
        ]);
        Kelas::create([
            'nama' => '4B'
        ]);
        Kelas::create([
            'nama' => '5A'
        ]);
        Kelas::create([
            'nama' => '5B'
        ]);
        Kelas::create([
            'nama' => '5C'
        ]);
        Kelas::create([
            'nama' => '6A'
        ]);
        Kelas::create([
            'nama' => '6B'
        ]);
        // KELAS END

        // KATEGORI BUKU DAN E-BOOK START
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [1, 1]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [1, 2]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [2, 1]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [2, 2]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [3, 1]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [3, 3]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [4, 1]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [4, 4]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [5, 1]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [5, 5]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [6, 1]);
        DB::insert('INSERT INTO kategori_buku (buku_id, kategori_id) VALUES (?, ?)', [6, 6]);

        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [1, 1]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [1, 2]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [2, 1]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [2, 2]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [3, 1]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [3, 3]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [4, 1]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [4, 4]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [5, 1]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [5, 5]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [6, 1]);
        DB::insert('INSERT INTO kategori_ebook (ebook_id, kategori_id) VALUES (?, ?)', [6, 6]);
        // KATEGORI BUKU DAN E-BOOK END
    }
}
