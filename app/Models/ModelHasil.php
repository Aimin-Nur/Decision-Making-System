<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHasil extends Model
{
    protected $table = 'saw_hasil'; 

    protected $primaryKey = 'id'; 
    protected $allowedFields = ['tanggal_penghitungan', 'alternatif_terpilih'];

    

    public function getAlternatif()
    {
        return $this->findAll();
    }

    public function getAlternatifById($id)
    {
        return $this->find($id);
    }

    public function insertAlternatifHasil($data)
    {
        return $this->insert($data);
    }

    public function updateAlternatif($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAlternatif($id)
    {
        return $this->delete($id);
    }

    
}
