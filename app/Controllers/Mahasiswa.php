<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;
    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }
   public function index(){
    $currentPage = $this->request->getVar('page_mahasiswa') ? $this->request->getVar('page_mahasiswa') : 1;
    $keyword = $this->request->getVar('keyword');
    if($keyword){
        $mahasiswa = $this->mahasiswaModel->search($keyword);
    }else{
        $mahasiswa = $this->mahasiswaModel;
    }
    $data = [
        'key' => 'Daftar Mahasiswa',
        // 'mahasiswa' => $this->mahasiswaModel->findAll()
        'mahasiswa' => $mahasiswa->pagination(6, 'mahasiswa'),
        'pager'  => $this->mahasiswaModel->pager,
        'currentPage' => $currentPage
    ];
        return view('mahasiswa/index', $data);
    }

}