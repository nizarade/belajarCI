<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now()->toDateTimeString();
        $dosen_data = [
            [
                'nidn' => '0012037801',
                'nama_lengkap' => 'Prof. Dr. Budi Santoso, M.Kom.',
                'program_studi' => 'Teknik Informatika',
                'fakultas' => 'Ilmu Komputer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nidn' => '0025087502',
                'nama_lengkap' => 'Dr. Siti Aminah, S.T., M.Eng.',
                'program_studi' => 'Sistem Informasi',
                'fakultas' => 'Ilmu Komputer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // ... dosen lainnya
        ];

        if (!empty($dosen_data)) {
            $this->db->table('dosen')->insertBatch($dosen_data);
            echo count($dosen_data) . " data dosen berhasil ditambahkan.\n";
        } else {
            echo "Tidak ada data dosen untuk di-seed.\n";
        }
    }
}