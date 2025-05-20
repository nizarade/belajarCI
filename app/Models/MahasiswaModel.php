<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nim',
        'foto',
        'foto_ktp',
        'nama_lengkap',
        'alamat',
        'program_studi',
        'fakultas',
        'angkatan',
        'email',
        'id_dosen'
    ];

    public function getDosenPengampu ( $mahasiswaId){
        $dataMahasiswa = $this->find($mahasiswaId);
        if($dataMahasiswa && isset($dataMahasiswa['id_dosen'])){
            $dosenModel = new DosenModel();
            return $dosenModel->find($dataMahasiswa['id_dosen']);
        }
    }

    public function search($keyword = null){
        if (empty($keyword) ) {
            return $this;
        }
        return $this->groupStart()->like('nama_lengkap', $keyword)->orLike('nim', $keyword)->orLike('email', $keyword)->orLike('angkatan', $keyword)->orLike('program_studi', $keyword)->orLike('fakultas', $keyword)->groupEnd();
    }

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
