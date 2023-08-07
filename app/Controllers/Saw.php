<?php

namespace App\Controllers;
use App\Models\ModelAlternatif;
use App\Models\ModelKriteria;
use App\Models\ModelHasil;

class Saw extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelAlternatif = new ModelAlternatif;
        $this->ModelKriteria = new ModelKriteria;
        $this->ModelHasil = new ModelHasil;
    }


    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'table' => 'Data Alternatif Keputusan',
            'page' => 'v_alternatif',
            'alt' => $this->ModelAlternatif->AllData(),
            'krt' => $this->ModelKriteria->AllData(),
            
        ];
        
        return view('v_template_admin' , $data);
    }

    public function TambahAlternatif()
    {
        $data = [
            'nama_alternatif' => $this->request->getPost('alternatif')
        ];

            $this->ModelAlternatif->AddAlternatif($data);
            session()->setFlashdata('sukses', 'Alternatif Berhasil Disimpan');
            return redirect()->to(base_url('Saw'));  
    }

    public function TambahKriteria()
    {
        $data = [
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'penjelasan_kriteria' => $this->request->getPost('penjelasan_kriteria'),
            'bobot_kriteria' => $this->request->getPost('bobot_kriteria'),
            'kategori_bobot' => $this->request->getPost('kategori_kriteria'),
            
        ];

            $this->ModelKriteria->AddKriteria($data);
            session()->setFlashdata('pesan', 'Kriteria Berhasil Disimpan');
            return redirect()->to(base_url('Saw'));  
    }


    public function EditKriteria($id)
    {
        $data = [
            'id' => $id,
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'penjelasan_kriteria' => $this->request->getPost('penjelasan_kriteria'),
            'bobot_kriteria' => $this->request->getPost('bobot_kriteria'),
            'kategori_bobot' => $this->request->getPost('kategori_kriteria'),
        ];

            $this->ModelKriteria->EditKriteria($data);
            session()->setFlashdata('pesan', 'Kriteria Berhasil Disimpan');
            return redirect()->to(base_url('Saw'));  
    }


    public function Hitung()
    {
        $data = [
            'judul' => 'Dashboard',
            'table' => 'Decision Making System SAW',
            'page' => 'v_hitung',
            'alt' => $this->ModelAlternatif->AllData(),
            'krt' => $this->ModelKriteria->AllData(),
        ];
        
        return view('v_template_admin' , $data);
    }


    public function simpan_hasil()
    {
        
        $brandTerpilih = $this->request->getPost('brand_terpilih');
        var_dump($brandTerpilih);
        
        $tanggalPemilihan = date('Y-m-d');
        var_dump($tanggalPemilihan);
        
        $data = [
            'alternatif_terpilih' => $brandTerpilih,
            'tanggal_penghitungan' => $tanggalPemilihan,
        ];

        // Instansiasi model alternatif
        $model = new ModelHasil();

        
        if ($model->insertAlternatifHasil($data)) {
            
            $response = [
                'status' => 'success',
                'message' => 'Data alternatif berhasil disimpan.',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data alternatif.',
            ];
        }

        return $this->response->setJSON($response);

    }


    public function editAlternatif($id)
    {
        $data = [
            'id' => $id,
            'nama_alternatif' => $this->request->getPost('test'),
        ];

        $this->ModelAlternatif->editAlternatif($data);
        session()->setFlashdata('sukses', 'Nama Alternatif Berhasil Diubah');
        return redirect()->to(base_url('Saw'));
    }



    public function hapusAlternatif($id)
    {
        $data = [
            'id' => $id,
        ];

        $this->ModelAlternatif->hapusAlternatif($data);
        session()->setFlashdata('sukses', 'Alternatif Berhasil Dihapus');
        return redirect()->to(base_url('Saw'));
    }



    public function hapusKriteria($id)
    {
        $data = [
            'id' => $id,
        ];

        $this->ModelKriteria->hapusKriteria($data);
        session()->setFlashdata('pesan', 'Alternatif Berhasil Dihapus');
        return redirect()->to(base_url('Saw'));
    }



}

