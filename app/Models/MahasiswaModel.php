<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $useTimeStamps = true;
    protected $allowedFields = ['nama', 'alamat'];

    public function search($keyword)
    {
        // $builder = $this->table('mahasiswa');
        // $builder->like('nama', $keyword);
        // return $builder;

        // atau
        return $this->table('mahasiswa')->like('nama', $keyword)->orLike('alamat', $keyword);
    }
}