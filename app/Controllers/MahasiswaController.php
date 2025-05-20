<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException; // Untuk error 404

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;
    protected $helpers = ['form', 'url']; // Load helper form dan url

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemsPerPage = 10;
        $pagerGroupName = 'mahasiswa'; // Nama grup pager, berguna jika ada >1 pager di halaman

        $keyword = $this->request->getGet('keyword');

        $mahasiswaQuery = $this->mahasiswaModel->search($keyword);

      

        // Dapatkan halaman saat ini dari query string, default ke 1 jika tidak ada
        // CI4 Pager akan otomatis menggunakan ?page_NAMAGRUP=X
        $currentPage = $this->request->getVar('page_' . $pagerGroupName) ? (int)$this->request->getVar('page_' . $pagerGroupName) : 1;

        $data = [
            'judul_halaman' => 'Daftar Mahasiswa',
            // Gunakan paginate() dari model
            'mahasiswa_data' => $mahasiswaQuery->orderBy('nim', 'ASC')->paginate($itemsPerPage, $pagerGroupName),
            // Kirim pager instance ke view
            'pager' => $this->mahasiswaModel->pager,
            'currentPage' => $currentPage, // Opsional, untuk info tambahan jika perlu
            'itemsPerPage' => $itemsPerPage, // Opsional, untuk info tambahan jika perlu
            'keyword' => $keyword
        ];
        return view('tabel_view', $data); // Sesuaikan nama view jika berbeda
    }

    /**
     * Show the form for creating a new resource.
     * (Akan kita bahas di langkah selanjutnya jika Anda ingin fitur Tambah)
     */
    public function create()
    {
        $data = [
            'judul_halaman' => 'Tambah Data Mahasiswa',
            'validation' => \Config\Services::validation() // Kirim service validasi ke view
        ];
        return view('mahasiswa_form', $data); // Buat view ini nanti
    }

    /**
     * Store a newly created resource in storage.
     * (Akan kita bahas di langkah selanjutnya jika Anda ingin fitur Tambah)
     */
    public function store()
    {
        // Aturan validasi
        $rules = [
            'nim' => 'required|is_unique[mahasiswa.nim]|max_length[20]',
            // 'foto'          => [ 
            //     'label' => 'Foto Profil',
            //     'rules' => 'uploaded[foto]' 
            //         . '|is_image[foto]' 
            //         . '|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]' 
            //         // . '|max_size[foto,2048]', 
            // ],
            // 'foto_ktp'      => [ 
            //     'label' => 'Foto KTP',
            //     'rules' => 'uploaded[foto_ktp]'
            //         . '|is_image[foto_ktp]'
            //         . '|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]'
            //         // . '|max_size[foto_ktp,2048]',
            // ],
            'nama_lengkap' => 'required|max_length[100]',
            'program_studi' => 'permit_empty|max_length[100]',
            'fakultas' => 'permit_empty|max_length[100]',
            'angkatan' => 'permit_empty|integer|exact_length[4]',
            'email' => 'permit_empty|valid_email|is_unique[mahasiswa.email]'
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form dengan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileFoto = $this->request->getFile('foto');
        $fileFotoKTP = $this->request->getFile('foto_ktp');
        

        $namaFoto = $fileFoto->getRandomName();
        $fileFoto->move('img/mahasiswa', $namaFoto);

        $namaFotoKTP = $fileFotoKTP->getRandomName();
        $fileFotoKTP->move('img/mahasiswa', $namaFotoKTP);
        // Ambil data dari POST request
        $this->mahasiswaModel->save( [
            'nim' => $this->request->getPost('nim'),
            'foto' => $namaFoto,
            'foto_ktp' => $namaFotoKTP,
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'program_studi' => $this->request->getPost('program_studi'),
            'fakultas' => $this->request->getPost('fakultas'),
            'angkatan' => $this->request->getPost('angkatan'),
            'email' => $this->request->getPost('email'),
        ]);
        // if ($this->mahasiswaModel->save($dataToSave)) {
            return redirect()->to('/mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan.');
        // } else {
            // return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data mahasiswa.');
        // }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id = null)
    {
        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            throw PageNotFoundException::forPageNotFound('Mahasiswa dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'judul_halaman' => 'Edit Data Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'validation' => \Config\Services::validation() // Kirim service validasi ke view
        ];
        return view('mahasiswa_form', $data); // Buat view ini nanti
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id = null)
    {


        $mahasiswa = $this->mahasiswaModel->find($id);
        if (!$mahasiswa) {
            throw PageNotFoundException::forPageNotFound('Mahasiswa dengan ID ' . $id . ' tidak ditemukan.');
        }

        $nimRule = 'required|max_length[20]|is_unique[mahasiswa.nim,id,' . $id . ']';
        $emailRule = 'permit_empty|valid_email|is_unique[mahasiswa.email,id,' . $id . ']';

        $rules = [
            'nim' => $nimRule,
            'nama_lengkap' => 'required|max_length[100]',
            'alamat' => 'permit_empty|max_length[100]',
            'program_studi' => 'permit_empty|max_length[100]',
            'fakultas' => 'permit_empty|max_length[100]',
            'angkatan' => 'permit_empty|integer|exact_length[4]',
            'email' => $emailRule
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form edit dengan error

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari POST request
        $dataToUpdate = [
            'nim' => $this->request->getVar('nim'), // Bisa getPost atau getVar
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'program_studi' => $this->request->getVar('program_studi'),
            'fakultas' => $this->request->getVar('fakultas'),
            'angkatan' => $this->request->getVar('angkatan'),
            'email' => $this->request->getVar('email'),
        ];

        if ($this->mahasiswaModel->update($id, $dataToUpdate)) {
            return redirect()->to('/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
        } else {
            // Seharusnya, jika model->update gagal, dia akan throw exception atau return false
            // Anda bisa tambahkan logging error di sini
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id = null)
    {
        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            // Opsi 1: Tampilkan pesan error jika data tidak ditemukan
            // return redirect()->to('/mahasiswa')->with('error', 'Data mahasiswa tidak ditemukan.');

            // Opsi 2: Throw PageNotFoundException (lebih standar untuk API atau jika URL diakses langsung)
            throw PageNotFoundException::forPageNotFound('Mahasiswa dengan ID ' . $id . ' tidak ditemukan untuk dihapus.');
        }

        if ($this->mahasiswaModel->delete($id)) {
            return redirect()->to('/mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus.');
        } else {
            // Jika delete gagal (jarang terjadi jika data ada, kecuali ada constraint FK)
            return redirect()->to('/mahasiswa')->with('error', 'Gagal menghapus data mahasiswa.');
        }
    }
}
