<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'tbguru';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_guru', 'slug', 'tmplahir', 'tlahir', 'pterakhir', 'jabatan', 'kmengajar', 'foto'];

    public function getGuru($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
