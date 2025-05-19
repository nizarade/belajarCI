<?php

namespace App\Database\Seeds;

// use App\Models\DosenModel;
use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        // $dosenModel = new DosenModel();
        // $dosen_records = $dosenModel->select('id')->findAll();

        // $dosen_ids = array_column($dosen_records, 'id');


        $mahasiswa_data = [

            [
                'nim' => '140119005',
                'foto' => 'foto140119005.jpg',
                'foto_ktp' => 'ktp140119005.jpg',
                'nama_lengkap' => 'Eko Wijaya',
                'program_studi' => 'Teknik Elektro',
                'fakultas' => 'Teknik',
                'angkatan' => 2019,
                'email' => 'eko.w@example.ac.id'
            ],
            [
                'nim' => '150120006',
                'foto' => 'foto150120006.jpg',
                'foto_ktp' => 'ktp150120006.jpg',
                'nama_lengkap' => 'Putri Susanto',
                'program_studi' => 'Sastra Inggris',
                'fakultas' => 'Ilmu Budaya',
                'angkatan' => 2020,
                'email' => 'putri.s@example.ac.id'
            ],
            [
                'nim' => '160121007',
                'foto' => 'foto160121007.jpg',
                'foto_ktp' => 'ktp160121007.jpg',
                'nama_lengkap' => 'Joko Kurniawan',
                'program_studi' => 'Ilmu Komunikasi',
                'fakultas' => 'Ilmu Sosial dan Politik',
                'angkatan' => 2021,
                'email' => 'joko.k@example.ac.id'
            ],
            [
                'nim' => '130222008',
                'foto' => 'foto130222008.jpg',
                'foto_ktp' => 'ktp130222008.jpg',
                'nama_lengkap' => 'Wati Setiawan',
                'program_studi' => 'Akuntansi',
                'fakultas' => 'Ekonomi dan Bisnis',
                'angkatan' => 2022,
                'email' => 'wati.s@example.ac.id'
            ],
            [
                'nim' => '110123009',
                'foto' => 'foto110123009.jpg',
                'foto_ktp' => 'ktp110123009.jpg',
                'nama_lengkap' => 'Agus Rahayu',
                'program_studi' => 'Teknik Informatika',
                'fakultas' => 'Ilmu Komputer',
                'angkatan' => 2023,
                'email' => 'agus.r@example.ac.id'
            ],
            [
                'nim' => '120219010',
                'foto' => 'foto120219010.jpg',
                'foto_ktp' => 'ktp120219010.jpg',
                'nama_lengkap' => 'Sri Hidayat',
                'program_studi' => 'Sistem Informasi',
                'fakultas' => 'Ilmu Komputer',
                'angkatan' => 2019,
                'email' => 'sri.h@example.ac.id'
            ],
            [
                'nim' => '170120011',
                'foto' => 'foto170120011.jpg',
                'foto_ktp' => 'ktp170120011.jpg',
                'nama_lengkap' => 'Bayu Saputra',
                'program_studi' => 'Hukum',
                'fakultas' => 'Hukum',
                'angkatan' => 2020,
                'email' => 'bayu.s@example.ac.id'
            ],
            [
                'nim' => '180121012',
                'foto' => 'foto180121012.jpg',
                'foto_ktp' => 'ktp180121012.jpg',
                'nama_lengkap' => 'Indah Gunawan',
                'program_studi' => 'Psikologi',
                'fakultas' => 'Psikologi',
                'angkatan' => 2021,
                'email' => 'indah.g@example.ac.id',
            ],
            // [
            //     'nim' => '140222013',
            //     'foto' => 'foto140222013.jpg',
            //     'foto_ktp' => 'ktp140222013.jpg',
            //     'nama_lengkap' => 'Andi Siregar',
            //     'program_studi' => 'Teknik Mesin',
            //     'fakultas' => 'Teknik',*/
            //     'angkatan' => 2022,
            //     'email' => 'andi.s@example.ac.id'
            // ],
            // [
            //     'nim' => '150223014',
            //     'foto' => 'foto150223014.jpg',
            //     'foto_ktp' => 'ktp150223014.jpg',
            //     'nama_lengkap' => 'Citra Purnama',
            //     'program_studi' => 'Sastra Jepang',
            //     'fakultas' => 'Ilmu Budaya',
            //     'angkatan' => 2023,
            //     'email' => 'citra.p@example.ac.id'
            // ],
            // [
            //     'nim' => '110119015',
            //     'foto' => 'foto110119015.jpg',
            //     'foto_ktp' => 'ktp110119015.jpg',
            //     'nama_lengkap' => 'Fajar Maulana',
            //     'program_studi' => 'Teknik Informatika',
            //     'fakultas' => 'Ilmu Komputer',
            //     'angkatan' => 2019,
            //     'email' => 'fajar.m@example.ac.id'
            // ],
            // [
            //     'nim' => '130120016',
            //     'foto' => 'foto130120016.jpg',
            //     'foto_ktp' => 'ktp130120016.jpg',
            //     'nama_lengkap' => 'Lia Abdullah',
            //     'program_studi' => 'Manajemen Bisnis',
            //     'fakultas' => 'Ekonomi dan Bisnis',
            //     'angkatan' => 2020,
            //     'email' => 'lia.a@example.ac.id'
            // ],
            // [
            //     'nim' => '140321017',
            //     'foto' => 'foto140321017.jpg',
            //     'foto_ktp' => 'ktp140321017.jpg',
            //     'nama_lengkap' => 'Yoga Hakim',
            //     'program_studi' => 'Teknik Sipil',
            //     'fakultas' => 'Teknik',
            //     'angkatan' => 2021,
            //     'email' => 'yoga.h@example.ac.id'
            // ],
            // [
            //     'nim' => '160222018',
            //     'foto' => 'foto160222018.jpg',
            //     'foto_ktp' => 'ktp160222018.jpg',
            //     'nama_lengkap' => 'Dini Nasution',
            //     'program_studi' => 'Hubungan Internasional',
            //     'fakultas' => 'Ilmu Sosial dan Politik',
            //     'angkatan' => 2022,
            //     'email' => 'dini.n@example.ac.id'
            // ],
            // [
            //     'nim' => '120223019',
            //     'foto' => 'foto120223019.jpg',
            //     'foto_ktp' => 'ktp120223019.jpg',
            //     'nama_lengkap' => 'Rahmat Firmansyah',
            //     'program_studi' => 'Sistem Informasi',
            //     'fakultas' => 'Ilmu Komputer',
            //     'angkatan' => 2023,
            //     'email' => 'rahmat.f@example.ac.id'
            // ],
            // [
            //     'nim' => '190119020',
            //     'foto' => 'foto190119020.jpg',
            //     'foto_ktp' => 'ktp190119020.jpg',
            //     'nama_lengkap' => 'Nur Wahyuni',
            //     'program_studi' => 'Farmasi',
            //     'fakultas' => 'Farmasi',
            //     'angkatan' => 2019,
            //     'email' => 'nur.w@example.ac.id'
            // ],
            // [
            //     'nim' => '200120021',
            //     'foto' => 'foto200120021.jpg',
            //     'foto_ktp' => 'ktp200120021.jpg',
            //     'nama_lengkap' => 'Reza Santoso',
            //     'program_studi' => 'Kedokteran',
            //     'fakultas' => 'Kedokteran',
            //     'angkatan' => 2020,
            //     'email' => 'reza.s@example.ac.id'
            // ],
            // [
            //     'nim' => '110121022',
            //     'foto' => 'foto110121022.jpg',
            //     'foto_ktp' => 'ktp110121022.jpg',
            //     'nama_lengkap' => 'Anisa Effendi',
            //     'program_studi' => 'Teknik Informatika',
            //     'fakultas' => 'Ilmu Komputer',
            //     'angkatan' => 2021,
            //     'email' => 'anisa.e@example.ac.id'
            // ],
            // [
            //     'nim' => '130222023',
            //     'foto' => 'foto130222023.jpg',
            //     'foto_ktp' => 'ktp130222023.jpg',
            //     'nama_lengkap' => 'Dimas Halim',
            //     'program_studi' => 'Akuntansi',
            //     'fakultas' => 'Ekonomi dan Bisnis',
            //     'angkatan' => 2022,
            //     'email' => 'dimas.h@example.ac.id'
            // ],
            // [
            //     'nim' => '140123024',
            //     'foto' => 'foto140123024.jpg',
            //     'foto_ktp' => 'ktp140123024.jpg',
            //     'nama_lengkap' => 'Mega Kusuma',
            //     'program_studi' => 'Teknik Elektro',
            //     'fakultas' => 'Teknik',
            //     'angkatan' => 2023,
            //     'email' => 'mega.k@example.ac.id'
            // ],
            // [
            //     'nim' => '150119025',
            //     'foto' => 'foto150119025.jpg',
            //     'foto_ktp' => 'ktp150119025.jpg',
            //     'nama_lengkap' => 'Arif Ramadhan',
            //     'program_studi' => 'Sastra Inggris',
            //     'fakultas' => 'Ilmu Budaya',
            //     'angkatan' => 2019,
            //     'email' => 'arif.r@example.ac.id'
            // ],
            // [
            //     'nim' => '160120026',
            //     'foto' => 'foto160120026.jpg',
            //     'foto_ktp' => 'ktp160120026.jpg',
            //     'nama_lengkap' => 'Dian Utami',
            //     'program_studi' => 'Ilmu Komunikasi',
            //     'fakultas' => 'Ilmu Sosial dan Politik',
            //     'angkatan' => 2020,
            //     'email' => 'dian.u@example.ac.id'
            // ],
            // [
            //     'nim' => '170121027',
            //     'foto' => 'foto170121027.jpg',
            //     'foto_ktp' => 'ktp170121027.jpg',
            //     'nama_lengkap' => 'Faisal Nugroho',
            //     'program_studi' => 'Hukum',
            //     'fakultas' => 'Hukum',
            //     'angkatan' => 2021,
            //     'email' => 'faisal.n@example.ac.id'
            // ],
            // [
            //     'nim' => '180122028',
            //     'foto' => 'foto180122028.jpg',
            //     'foto_ktp' => 'ktp180122028.jpg',
            //     'nama_lengkap' => 'Hana Lubis',
            //     'program_studi' => 'Psikologi',
            //     'fakultas' => 'Psikologi',
            //     'angkatan' => 2022,
            //     'email' => 'hana.l@example.ac.id'
            // ],
            // [
            //     'nim' => '120223029',
            //     'foto' => 'foto120223029.jpg',
            //     'foto_ktp' => 'ktp120223029.jpg',
            //     'nama_lengkap' => 'Gilang Maryani',
            //     'program_studi' => 'Sistem Informasi',
            //     'fakultas' => 'Ilmu Komputer',
            //     'angkatan' => 2023,
            //     'email' => 'gilang.m@example.ac.id'
            // ],
            // [
            //     'nim' => '140419030',
            //     'foto' => 'foto140419030.jpg',
            //     'foto_ktp' => 'ktp140419030.jpg',
            //     'nama_lengkap' => 'Fitri Simanjuntak',
            //     'program_studi' => 'Arsitektur',
            //     'fakultas' => 'Teknik',
            //     'angkatan' => 2019,
            //     'email' => 'fitri.s@example.ac.id'
            // ],
            // [
            //     'nim' => '110120031',
            //     'foto' => 'foto110120031.jpg',
            //     'foto_ktp' => 'ktp110120031.jpg',
            //     'nama_lengkap' => 'Kevin Putra',
            //     'program_studi' => 'Teknik Informatika',
            //     'fakultas' => 'Ilmu Komputer',
            //     'angkatan' => 2020,
            //     'email' => 'kevin.p@example.ac.id'
            // ],
        ];

        // $mahasiswa_to_insert = [];
        // foreach($mahasiswa_data as $mhs){
        //     $mahasiswa_to_insert[] = array_merge($mhs, [
        //         'id_dosen' => $dosen_ids[array_rand($dosen_ids)]
        //     ]);
        // }

        // if (!empty($mahasiswa_to_insert)) {
        //     $this->db->table('mahasiswa')->insertBatch($mahasiswa_to_insert);
        // } else {
        //     echo "Tidak ada data mahasiswa untuk di-seed.\n";
        // }

        if(!empty($mahasiswa_data)){
            $this->db->table('mahasiswa')->insertBatch($mahasiswa_data);
        } else {
            echo "Tidak ada data mahasiswa untuk di-seed.\n";
        }
    }
}
