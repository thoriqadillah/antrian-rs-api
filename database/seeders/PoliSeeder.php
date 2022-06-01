<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('polis')->insert([
            'nama_poli' => "Poliklinik Gigi",
            'deskripsi' => "Poliklinik gigi merupakan salah satu pelayanan kesehatan gigi dan mulut berupa pemeriksaan kesehatan gigi dan mulut, pengobatan dan pemberian tindakan medis kesehatan gigi dan mulut seperti penambalan gigi, pencabutan gigi dan pembersihan karang gigi."
        ]);
        DB::table('polis')->insert([
            'nama_poli' => "Poliklinik Umum",
            'deskripsi' => "Poliklinik umum merupakan salah satu layanan yang memberikan pelayanan berupa pemeriksaan kesehatan, pengobatan dan penyuluhan kepada pasien atau masyarakat umum berusia dewasa. Pelayanan kesehatan dilakukan oleh dokter dan perawat yang memiliki sertifikat standar."
        ]);
        DB::table('polis')->insert([
            'nama_poli' => "Poliklinik Anak",
            'deskripsi' => "Poliklinik anak merupakan pelayanan konsultasi kesehatan dan pertumbuhan khusus anak dan bayi yang ditangani oleh dokter spesialis anak yang berpengalaman, profesional dan ramah terhadap anak. Pelayanan poli anak juga meliputi pemberian imunisasi bayi serta booster untuk anak."
        ]);
    }
}
