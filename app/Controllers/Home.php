<?php

namespace App\Controllers;
use App\Models\ModelKriteria;
use App\Models\ModelAlternatif;
use App\Models\ModelHasil;

class Home extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelKriteria = new ModelKriteria;
        $this->ModelKriteria = new ModelKriteria;
        $this->ModelHasil = new ModelHasil;
       
    }


    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'page' => 'v_dashboard',
            'krt' => $this->ModelKriteria->AllData(),
            'hst' => $this->ModelHasil->getAlternatif(),
        ];
        return view('v_template_admin' , $data);
    }

}
