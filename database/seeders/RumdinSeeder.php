<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rumdin;
use Illuminate\Support\Facades\DB;

class RumdinSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Rumdin::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ========================================
        // DATA RUMDIN SAT POLAIRUD (15 data)
        // Lokasi: Jalan Pengadilan Lama No. 45
        // Kategori: polres_satpolairud
        // TANAH ID: 10 (TANAH SAT POLAIRUD)
        // Terdiri dari: 3 Rumdin Kasat + 12 Asrama Polisi
        // ========================================
        $rumdin_sat_polairud = [
            // Rumah Dinas Kasat (3 data)
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Kasat',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'IPTU M.ANANG TRI S, S.H',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'PS. KASAT POLAIRUD - RUMDIN KASAT',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Kasat',
                'type' => 'Type 55/55 m2',
                'penghuni' => null,
                'luas' => 55.00,
                'status' => 'Kosong',
                'alamat' => 'Jl. Pengadilan Lama Rt 02/05 Ds Pangandaran Kec/Kab Pangandaran',
                'kondisi' => 'RR',
                'keterangan' => 'RUMDIN KASAT',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Kasat',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'BRIPKA HARY PAHLEVY',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'PS. KANIT BINPOLMAS SATBINMAS - RUMDIN KASAT',
            ],

            // Asrama Polisi (12 data)
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIPKA TASIKUN',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'BA SAT POLAIRUD - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIPTU JULIO ABDUL SYUKUR',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'BAMIN BAG LOG - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIGPOL NIAR HARTINI, S.H.',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'BANIT IV SAT RESKRIM - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'AIPDA SUKISNO WIDADA',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'PS. KANIT HARKAN KAPAL SAT POLAIRUD - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIPKA DENI SUGIANTO INDAH',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'PS. KASUBNIT TINDAK SAT POLAIRUD - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIPKA CEPI ARIANTO, S.H',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'PS. KANIT GAKKUM SAT POLAIRUD - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIPKA YUDIANTO',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'BA POLSEK PADAHERANG - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIPKA DEDI KURNIAWAN ATMAJA, S.H.',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'PS. PAUR SUBBAGBINOPS BAG OPS - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => null,
                'luas' => 36.00,
                'status' => 'Kosong',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46387',
                'kondisi' => 'RR',
                'keterangan' => 'ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => 'BRIPDA HENDI',
                'luas' => 36.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'kondisi' => 'RR',
                'keterangan' => 'BA SITIK - ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => null,
                'luas' => 36.00,
                'status' => 'Kosong',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46387',
                'kondisi' => 'RR',
                'keterangan' => 'ASRAMA POLISI',
            ],
            [
                'tanah_id' => 10,
                'kategori' => 'polres_satpolairud',
                'polsek_nama' => null,
                'nama_bangunan' => 'Asrama Polisi',
                'type' => 'Type 36/36 m2',
                'penghuni' => null,
                'luas' => 36.00,
                'status' => 'Kosong',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46388',
                'kondisi' => 'RR',
                'keterangan' => 'ASRAMA POLISI',
            ],
        ];

        // ========================================
        // DATA RUSUS POLRES PANGANDARAN (15 data)
        // Lokasi: Jalan Raya Cijulang No. 69
        // Kategori: polres_rusus
        // TANAH ID: 11 (TANAH POLRES PANGANDARAN)
        // Terdiri dari: 15 Rumah Dinas Khusus untuk Pejabat Tinggi
        // ========================================
        $rusus_polres = [
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'KOMPOL USER SUPIYAN S,H, M.M.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46387',
                'kondisi' => 'B',
                'keterangan' => 'WAKAPOLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'KOMPOL SUBARJA, S.IP.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46387',
                'kondisi' => 'B',
                'keterangan' => 'KABAG OPS POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'AKP ANTONIUS EKO HARIYADI',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46387',
                'kondisi' => 'B',
                'keterangan' => 'KABAG REN POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'AKP WAHYU HIDAYAT, S.H.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46389',
                'kondisi' => 'B',
                'keterangan' => 'KABAG LOG POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'AKP IDAS WARDIAS, S.H., M.H.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46401',
                'kondisi' => 'B',
                'keterangan' => 'KASAT RESKRIM POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'AKP AGUS MULYADI, S.H.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46401',
                'kondisi' => 'B',
                'keterangan' => 'KASAT INTELKAM POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'AKP DADANG S.H., M.H.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46402',
                'kondisi' => 'B',
                'keterangan' => 'KASAT RESNARKOBA POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'AKP DIDI SUTARDI',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46402',
                'kondisi' => 'B',
                'keterangan' => 'KASAT BINMAS POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'IPDA HENDRAWAN, S.H.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46404',
                'kondisi' => 'B',
                'keterangan' => 'KANIT TURJAWALI SATLANTAS POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'IPDA MARET DANIEL',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46404',
                'kondisi' => 'B',
                'keterangan' => 'KASUBSIDUMAS SIWAS POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => 'IPDA YUDHISTIRA SEZARIANKY SOFYAN, S.T.Han.',
                'luas' => 55.00,
                'status' => 'Dihuni',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46406',
                'kondisi' => 'B',
                'keterangan' => 'KA SPKT POLRES PANGANDARAN',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => null,
                'luas' => 55.00,
                'status' => 'Kosong',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46407',
                'kondisi' => 'B',
                'keterangan' => '-',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => null,
                'luas' => 55.00,
                'status' => 'Kosong',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46408',
                'kondisi' => 'B',
                'keterangan' => '-',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => null,
                'luas' => 55.00,
                'status' => 'Kosong',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46409',
                'kondisi' => 'B',
                'keterangan' => '-',
            ],
            [
                'tanah_id' => 11,
                'kategori' => 'polres_rusus',
                'polsek_nama' => null,
                'nama_bangunan' => 'Rumah Dinas Khusus',
                'type' => 'Type 55/55 m2',
                'penghuni' => null,
                'luas' => 55.00,
                'status' => 'Kosong',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46410',
                'kondisi' => 'B',
                'keterangan' => '-',
            ],
        ];

        // File terlalu panjang, saya lanjutkan di comment berikutnya dengan data Polsek

        // ========================================
        // DATA POLSEK PANGANDARAN (19 data)
        // Lokasi: Jalan Merdeka No. 175
        // Kategori: polsek_rumdin
        // TANAH ID: 5 (TANAH POLSEK PANGANDARAN)
        // Terdiri dari: 1 Rumdin Kapolsek + 18 Asrama Polisi
        // ========================================
        $polsek_pangandaran = [
            // Rumah Dinas Kapolsek (1 data)
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Rumah Dinas Kapolsek', 'type' => 'Type 55/55 m2', 'penghuni' => 'AKP NANDANG ROKHMANA, S.H., M.H', 'luas' => 55.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'KAPOLSEK PANGANDARAN - RUMDIN KAPOLSEK'],
            // Asrama Polisi (18 data)
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'BRIPTU FAJAR MUSTOFA', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'BHABINKAMTIBMAS DS PANANJUNG'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'BRIPTU PANJI Y.A', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'ANGGOTA SAT LANTAS - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'IPDA DAHLAN', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'KASIKEU POLRES PANGANDARAN - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'AIPDA AWAN AGUS GUNAWAN,S.H.', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'PS. KASUBSILUHKUM SIKUM - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'AIPTU FERY IRAWAN', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'PS. PANIT II BINMAS - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'BRIPKA DENI RAHAMAN,S.H', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'PS. PANIT 2 UNIT SAMAPTA - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'BRIPKA JENI TRESNA WIGUNA', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'PANIT OPSNAL 2 RESKRIM - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'PENATA YATI SURYAWATI, A.Md.Keb.', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'KASIDOKKES - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => null, 'luas' => 36.00, 'status' => 'Kosong', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => null, 'luas' => 36.00, 'status' => 'Kosong', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'KANTOR PELAYANAN SIM', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'DIALIH FUNGSIKAN - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'KANTOR PELAYANAN SIM', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'DIALIH FUNGSIKAN - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'AIPDA GALIH GANJAR PERMANA', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396', 'kondisi' => 'RR', 'keterangan' => 'BA SATLANTAS - ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => null, 'luas' => 36.00, 'status' => 'Kosong', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46398', 'kondisi' => 'RR', 'keterangan' => 'ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => null, 'luas' => 36.00, 'status' => 'Kosong', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46400', 'kondisi' => 'RR', 'keterangan' => 'ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => null, 'luas' => 36.00, 'status' => 'Kosong', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46400', 'kondisi' => 'RR', 'keterangan' => 'ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => null, 'luas' => 36.00, 'status' => 'Kosong', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46400', 'kondisi' => 'RR', 'keterangan' => 'ASRAMA POLISI'],
            ['tanah_id' => 5, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Pangandaran', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => null, 'luas' => 36.00, 'status' => 'Kosong', 'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46400', 'kondisi' => 'RR', 'keterangan' => 'ASRAMA POLISI'],
        ];

        // ========================================
        // DATA POLSEK KALIPUCANG (5 data)
        // Lokasi: Jalan Raya Kalipucang No. 396
        // Kategori: polsek_rumdin
        // TANAH ID: 4 (TANAH POLSEK KALIPUCANG)
        // Terdiri dari: 1 Rumdin Kapolsek + 4 Asrama Polisi
        // ========================================
        $polsek_kalipucang = [
            ['tanah_id' => 4, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Kalipucang', 'nama_bangunan' => 'Rumah Dinas Kapolsek', 'type' => 'Type 55/55 m2', 'penghuni' => 'KANTOR SAT LANTAS POLSEK KALIPUCANG', 'luas' => 55.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec. Kalipucang, Kab. Pangandaran Jawa Barat 46397', 'kondisi' => 'RR', 'keterangan' => 'DIALIH FUNGSIKAN - RUMDIN KAPOLSEK'],
            ['tanah_id' => 4, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Kalipucang', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'AKP IMAN SUDIRMAN', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec. Kalipucang, Kab. Pangandaran Jawa Barat 46397', 'kondisi' => 'RR', 'keterangan' => 'KAPOLSEK KALIPUCANG - ASRAMA POLISI'],
            ['tanah_id' => 4, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Kalipucang', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'AIPDA APEP WARDIANA', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec. Kalipucang, Kab. Pangandaran Jawa Barat 46397', 'kondisi' => 'RR', 'keterangan' => 'PS. KA SPKT / POLSEK KALIPUCANG - ASRAMA POLISI'],
            ['tanah_id' => 4, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Kalipucang', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'KANTOR INTELKAM', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec. Kalipucang, Kab. Pangandaran Jawa Barat 46397', 'kondisi' => 'RR', 'keterangan' => 'DIALIH FUNGSIKAN - ASRAMA POLISI'],
            ['tanah_id' => 4, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Kalipucang', 'nama_bangunan' => 'Asrama Polisi', 'type' => 'TYPE 36/36 m2', 'penghuni' => 'BRIPKA GITA PERSADA', 'luas' => 36.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec. Kalipucang, Kab. Pangandaran Jawa Barat 46397', 'kondisi' => 'RR', 'keterangan' => 'PS. KA SPKT II POLSEK KALIPUCANG - ASRAMA POLISI'],
        ];

        // ========================================
        // DATA POLSEK SIDAMULIH (1 data)
        // Lokasi: Jalan Raya Sidamulih No. 158
        // Kategori: polsek_rumdin
        // TANAH ID: 6 (TANAH POLSEK SIDAMULIH)
        // Terdiri dari: 1 Rumdin Kapolsek
        // ========================================
        $polsek_sidamulih = [
            ['tanah_id' => 6, 'kategori' => 'polsek_rumdin', 'polsek_nama' => 'Sidamulih', 'nama_bangunan' => 'Rumah Dinas Kapolsek', 'type' => 'Type 55/55 m2', 'penghuni' => 'KANTOR SAT RESKRIM POLSEK SIDAMULIH', 'luas' => 55.00, 'status' => 'Dihuni', 'alamat' => 'Jalan Raya Sidamulih No. 158, Desa Pajaten, Kec. Sidamulih, Kab. Pangandaran Jawa Barat 46365', 'kondisi' => 'RR', 'keterangan' => 'DIALIH FUNGSIKAN - RUMDIN KAPOLSEK'],
        ];

        // ========================================
        // GABUNGKAN SEMUA DATA
        // ========================================
        $allData = array_merge(
            $rumdin_sat_polairud, // 15 data - Tanah ID 10
            $rusus_polres,        // 15 data - Tanah ID 11
            $polsek_pangandaran,  // 19 data - Tanah ID 5
            $polsek_kalipucang,   // 5 data  - Tanah ID 4
            $polsek_sidamulih     // 1 data  - Tanah ID 6
        );
        // Total: 55 data

        // ========================================
        // INSERT DATA KE DATABASE
        // ========================================
        foreach ($allData as $data) {
            Rumdin::create($data);
        }

        // ========================================
        // TAMPILKAN DETAIL DATA
        // ========================================
        $this->command->info('');
        $this->command->info('╔════════════════════════════════════════════════════════════╗');
        $this->command->info('║              DETAIL DATA RUMAH DINAS (RUMDIN)              ║');
        $this->command->info('╠════════════════════════════════════════════════════════════╣');
        $this->command->info('║ POLRES - Satpolairud (Tanah ID 10)       : ' . str_pad(count($rumdin_sat_polairud), 2, ' ', STR_PAD_LEFT) . ' records  ║');
        $this->command->info('║ POLRES - Rusus (Tanah ID 11)             : ' . str_pad(count($rusus_polres), 2, ' ', STR_PAD_LEFT) . ' records  ║');
        $this->command->info('║ POLSEK - Pangandaran (Tanah ID 5)        : ' . str_pad(count($polsek_pangandaran), 2, ' ', STR_PAD_LEFT) . ' records  ║');
        $this->command->info('║ POLSEK - Kalipucang (Tanah ID 4)         : ' . str_pad(count($polsek_kalipucang), 2, ' ', STR_PAD_LEFT) . ' records  ║');
        $this->command->info('║ POLSEK - Sidamulih (Tanah ID 6)          : ' . str_pad(count($polsek_sidamulih), 2, ' ', STR_PAD_LEFT) . ' records  ║');
        $this->command->info('╠════════════════════════════════════════════════════════════╣');
        $this->command->info('║ TOTAL                                    : ' . str_pad(count($allData), 2, ' ', STR_PAD_LEFT) . ' records  ║');
        $this->command->info('╚════════════════════════════════════════════════════════════╝');
        $this->command->info('');
        $this->command->info('✓ Data Rumdin berhasil di-seed ke database!');
    }
}