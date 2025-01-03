<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimeModel extends Model
{
    protected $table = 'anime2';
    protected $useTimeStamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'keterangan', 'sampul'];

    public function getAnime($slug = false)
    {
        if($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}