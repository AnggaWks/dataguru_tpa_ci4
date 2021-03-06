<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    protected $table = 'tbsantri';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_santri', 'slug', 'alamat', 'nama_orangtua', 'infaq_wajib', 'realisasi', 'minus', 'keterangan', 'foto'];

    public function search($keyword)
    {
        //         $builder=$this->table('tbsantri');
        //         $builder=like->('nama_santri',$keyword);
        //  return $builder;

        return $this->table('tbsantri')->like('nama_santri', $keyword);
    }
}
//     public function getSantri($slug = false)
//     {
//         if ($slug == false) {
//             return $this->findAll();
//         }

//         return $this->where(['slug' => $slug])->first();
//     }
// }
