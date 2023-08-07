<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAlternatif extends Model
{
    protected $table = 'saw_alternatif'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['nama_alternatif'];


    public function AddAlternatif($data)
    {
        $this->insert($data);
    }


    public function AllData()
    {
        return $this->orderBy('id', 'DESC')->get()->getResultArray();
    }

    public function editAlternatif($data)
    {
        $this->set('nama_alternatif', $data['nama_alternatif'])->where('id', $data['id'])->update(); 
    }


    public function hapusAlternatif($data)
    {
        $this->delete($data);
    }

    

}
