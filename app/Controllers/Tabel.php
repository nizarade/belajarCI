<?php

namespace App\Controllers; 

use App\Models\MahasiswaModel;
class Tabel extends BaseController 
{
    public function index(): string 
    {
        // Data yang akan ditampilkan di tabel
        $mahasiswaModel = new MahasiswaModel();
        $daftarMahasiswa = $mahasiswaModel->orderBy('nim', 'asc')->findAll();

        $data = [
            'judul_halaman' => "Daftar Mahasiswa",
            'mahasiswa_data' => $daftarMahasiswa
        ];
        // Memuat view dan mengirimkan data ke view
        // CodeIgniter 4 menggunakan helper view()
        return view('tabel_view', $data);
    }
}