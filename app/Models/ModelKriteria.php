<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKriteria extends Model
{
    protected $table = 'saw_kriteria'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['nama_kriteria', 'penjelasan_kriteria', 'bobot_kriteria', 'kategori_bobot'];


    public function AddKriteria($data)
    {
        $this->insert($data);
    }


    public function AllData()
    {
        return $this->orderBy('id', 'DESC')->get()->getResultArray();
    }

    public function EditKriteria($data)
    {
        $this->set([
            'nama_kriteria' => $data['nama_kriteria'],
            'penjelasan_kriteria' => $data['penjelasan_kriteria'],
            'bobot_kriteria' => $data['bobot_kriteria'],
            'kategori_bobot' => $data['kategori_bobot'],
        ])->where('id', $data['id'])->update();
    }


    public function hapusKriteria($data)
    {
        $this->delete($data);
    }
    
}
