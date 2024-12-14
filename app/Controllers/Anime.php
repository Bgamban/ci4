<?php

namespace App\Controllers;

use App\Models\AnimeModel;

class Anime extends BaseController
{
    protected $animeModel;
    public function __construct()
    {
        $this->animeModel = new AnimeModel();
    }
   public function index(){
    //    $anime = $this->animeModel->findAll();
    $data = [
        'key' => 'Daftar Anime',
        'anime' => $this->animeModel->getAnime()
    ];

    // $animeModel = new \App\Models\AnimeModel();
    
    // // Cara Anime db tanpa model
    // $db = \Config\Database::connect();
    // $anime = $db->query("SELECT * FROM anime");
    // foreach($anime->getResultArray() as $row){
        //     d($row);
        // }
        return view('anime/index', $data);
    }
    public function detail($slug)
    {
        $data = [
            'key' => 'Detail Anime',
            'anime' => $this->animeModel->getAnime($slug)
        ];
        // jika anime tidak ada di tabel
        if(empty($data['anime']))
        {
            throw new \Codeigniter\Exceptions\PageNotFoundException('Judul Anime' . $slug . 'Tidak Ditemukan');
        }
        return view('anime/detail', $data);
    }
    public function create()
    {
        // session();
        $data = [
            'key' => 'Form Tambah Data Anime',
            'validation' => \Config\Services::validation()
        ];
        return view('anime/create', $data);
    }
    public function save()
    {
        // validasi input
        if(!$this->validate([
            // 'judul' => 'required|is_unique[anime.judul]',
            'judul' => [
                'rules'=> 'required|is_unique[anime.judul]',
                'errors'=> [
                    'required' => '{field} anime harus diiisi.',
                    'is_unique' => '{field} anime sudah terdaftar'
                ]
                ],
                'sampul' => [
                    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]', //jangan beri spasi diawal:uploaded[sampul]|
                    'errors' =>[
                        // 'uploaded' => 'Pilih gambar sampul terlebih dahulu',
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
        ])){
            // $validation = \Config\Services::validation();
            // return redirect()->to('/anime/create')->withInput()->with('validation', $validation);
            return redirect()->to('/anime/create')->withInput();
            // $data['validation'] = $validation;
            // return view('/anime/create', $data);
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        //apakah tidak ada gambar yang diupload
        if($fileSampul->getError() == 4){
            $namaSampul = 'missing-image.png';
        }else{
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img'); //move ini akan langsung ke folder public lalu masukkan ke folder img
        }
        
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/anime');
    }
    public function delete($id){
        // cari gambar berdasarkan id
        $anime = $this->animeModel->find($id);
        //cek jika file gambar default.png
        if($anime['sampul'] != 'missing-image.png' ){
            //hapus gambar
            unlink('img/' . $anime['sampul']); //agar gambar yang terhapus tidak ada di folder img
        }
        //kalo bukan missing-image.png hanya hapus datanya saja didalam tabel
        $this->animeModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/anime');
    }
    public function edit($slug)
    {
        $data = [
            'key' => 'Form Ubah Data Anime',
            'validation' => \Config\Services::validation(),
            'anime'=> $this->animeModel->getAnime($slug)
        ];
        return view('anime/edit', $data);
    }
    public function update($id)
    {
        // cek judul
        $animeLama = $this->animeModel->getAnime($this->request->getVar('slug'));
        if($animeLama['judul'] == $this->request->getVar('judul')){
            $rule_judul = 'required';
        }else{
            $rule_judul = 'required|is_unique[anime.judul]';
        }
        if(!$this->validate([
            'judul' => [
                'rules'=> $rule_judul,
                'errors'=> [
                    'required' => '{field} anime harus diiisi.',
                    'is_unique' => '{field} anime sudah terdaftar'
                ]
                ],
                'sampul' => [
                    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]', //jangan beri spasi diawal:uploaded[sampul]|
                    'errors' =>[
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
        ])){
            // $validation = \Config\Services::validation();
            return redirect()->to('/anime/edit' . $this->request->getVar('slug'))->withInput();//->with('validation', $validation);
        $fileSampul = $this->request->getFile('sampul');
        //cek gambar, apakah tetap gambar lama
        if($fileSampul->getError() == 4){
            $namaSampul = $this->request->getVar('sampulLama');
        }else{
            //generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            //hapus file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/anime');
    }
   }
}