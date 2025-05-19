<?php

namespace App\Controllers;

use App\Models\DosenModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DosenController extends BaseController
{
    protected DosenModel $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
    }

    // Cocok dengan: $routes->get('/', 'DosenController::index');
    public function index()
    {
        $itemsPerPage = 10;
        $pagerGroupName = 'dosen';
        $currentPage = $this->request->getVar('page_' . $pagerGroupName) ?: 1;
        $data = [
            'judul_halaman' => 'Daftar Dosen',
            'dosen_data'    => $this->dosenModel->orderBy('nama_lengkap', 'ASC')->paginate($itemsPerPage, $pagerGroupName),
            'pager'         => $this->dosenModel->pager,
            'currentPage'   => $currentPage,
            'itemsPerPage'  => $itemsPerPage,
        ];
        return view('tabel_view_dosen', $data);
    }

    // Cocok dengan: $routes->get('create', 'DosenController::create');
    public function create()
    {

        $data = [
            'judul_halaman' => 'Tambah Dosen Baru',
            'validation'    => \Config\Services::validation()
        ];
        return view('dosen/create', $data);
    }

    // Cocok dengan: $routes->post('store', 'DosenController::store');
    public function store()
    {

        $rules = [ /* ... aturan validasi ... */ ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $dataToSave = [ /* ... data dari form ... */ ];
        if ($this->dosenModel->save($dataToSave)) {
            session()->setFlashdata('success', 'Data dosen berhasil ditambahkan.');
            return redirect()->to('/dosen'); // Sesuai dengan base path group 'dosen'
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data dosen.');
            return redirect()->back()->withInput();
        }
    }

    // Cocok dengan: $routes->get('edit/(:num)', 'DosenController::edit/$1');
    public function edit($id = null) // $id akan otomatis diisi dari (:num)
    {
        $dosen = $this->dosenModel->find($id);
        if (!$dosen) {
            throw PageNotFoundException::forPageNotFound('Data dosen tidak ditemukan.');
        }
        $data = [
            'judul_halaman' => 'Edit Data Dosen: ' . esc($dosen['nama_lengkap']),
            'dosen'         => $dosen,
            'validation'    => \Config\Services::validation()
        ];
        return view('dosen/edit', $data);
    }

    // Cocok dengan: $routes->post('update/(:num)', 'DosenController::update/$1');
    public function update($id = null) // $id akan otomatis diisi dari (:num)
    {
        // Logika untuk validasi dan pembaruan data dosen berdasarkan ID
        // ... (sudah dibuat sebelumnya, termasuk validasi dan redirect)
        $dosenLama = $this->dosenModel->find($id);
        if (!$dosenLama) {
            throw PageNotFoundException::forPageNotFound('Data dosen tidak ditemukan untuk diperbarui.');
        }
        $nidnRule = 'required|max_length[20]|numeric';
        if ($this->request->getPost('nidn') !== $dosenLama['nidn']) {
            $nidnRule .= '|is_unique[dosen.nidn,id,' . $id . ']';
        }
        $rules = [ 'nidn' => ['rules' => $nidnRule, /* ... */ ], /* ... aturan lain ... */ ];
        if (!$this->validate($rules)) {
            return redirect()->to('/dosen/edit/' . $id)->withInput()->with('validation', $this->validator);
        }
        $dataToUpdate = [ /* ... data dari form ... */ ];
        if ($this->dosenModel->update($id, $dataToUpdate)) {
            session()->setFlashdata('success', 'Data dosen berhasil diperbarui.');
            return redirect()->to('/dosen'); // Sesuai dengan base path group 'dosen'
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data dosen.');
            return redirect()->to('/dosen/edit/' . $id)->withInput();
        }
    }

    // Cocok dengan: $routes->delete('delete/(:num)', 'DosenController::delete/$1');
    // atau jika menggunakan form dengan method spoofing:
    // <form action="/dosen/delete/ID_DOSEN" method="post">
    //   <input type="hidden" name="_method" value="DELETE">
    //   ...
    // </form>
    public function delete($id = null) // $id akan otomatis diisi dari (:num)
    {
        // Logika untuk menghapus data dosen berdasarkan ID
        // ... (sudah dibuat sebelumnya, termasuk redirect)
        $dosen = $this->dosenModel->find($id);
        if (!$dosen) {
            session()->setFlashdata('error', 'Data dosen tidak ditemukan.');
            return redirect()->to('/dosen');
        }
        if ($this->dosenModel->delete($id)) {
            session()->setFlashdata('success', 'Data dosen berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data dosen.');
        }
        return redirect()->to('/dosen'); // Sesuai dengan base path group 'dosen'
    }
}