<?php

namespace App\Controllers;

use App\Models\GuruModel;

class Guru extends BaseController
{
    protected $guruModel;
    public function __construct()
    {
        $this->guruModel = new GuruModel();
    }
    public function index()
    {
        // $guru = $this->guruModel->findAll();
        $data = [
            'title' => 'Data Guru TPA',
            'guru' => $this->guruModel->getGuru()
        ];

        // guruModel = new \App\Models\GuruModel();
        // $guruModel = new GuruModel();



        return view('guru/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Guru',
            'guru' => $this->guruModel->getGuru($slug)
        ];

        //jika guru tidak ada di tabel
        if (empty($data['guru'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Guru' . $slug . 'tidak ditemukan.');
        }
        return view('guru/detail', $data);
    }
    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Data Guru',
            'validation' => \Config\Services::validation()
        ];
        return view('guru/create', $data);
    }
    public function save()
    {
        // validasi input 
        if (!$this->validate([
            'nama_guru' => [
                'rules' => 'required|is_unique[tbguru.nama_guru]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/guru/create')->withInput()->with('validation', $validation);
            return redirect()->to('/guru/create')->withInput();
        }

        //ambil gambar
        $fileFoto = $this->request->getFile('foto');
        // apakah tidak ada foto yg diupload
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.jpg';
        } else {

            // generate nama foto random
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan file ke folder img
            $fileFoto->move('img', $namaFoto);
        }


        $slug = url_title($this->request->getVar('nama_guru'), '-', true);
        $this->guruModel->save([
            'nama_guru' => $this->request->getVar('nama_guru'),
            'slug' => $slug,
            'tmplahir' => $this->request->getVar('tmplahir'),
            'tlahir' => $this->request->getVar('tlahir'),
            'pterakhir' => $this->request->getVar('pterakhir'),
            'jabatan' => $this->request->getVar('jabatan'),
            'kmengajar' => $this->request->getVar('kmengajar'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/guru');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $guru = $this->guruModel->find($id);

        // cek jika file gambar defalt.jpg
        if ($guru['foto'] != 'default.jpg') {

            // hapus gambar
            unlink('img/' . $guru['foto']);
        }
        $this->guruModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/guru');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Guru',
            'validation' => \Config\Services::validation(),
            'guru' => $this->guruModel->getGuru($slug)
        ];
        return view('guru/edit', $data);
    }
    public function update($id)
    {
        // cek nama
        $nama_gurulama = $this->guruModel->getGuru($this->request->getVar('slug'));
        if ($nama_gurulama['nama_guru'] == $this->request->getVar('nama_guru')) {
            $rule_nama_guru = 'required';
        } else {
            $rule_nama_guru = 'required|is_unique[tbguru.nama_guru]';
        }

        if (!$this->validate([
            'nama_guru' => [
                'rules' => $rule_nama_guru,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();

            return redirect()->to('/guru/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        // cek gambar, apakah tetap gambar lama
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            // generate nama file random  
            $namaFoto = $fileFoto->getRandomName();
            // pindakan gambar
            $fileFoto->move('img', $namaFoto);
            // hapus file yang lama
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $slug = url_title($this->request->getVar('nama_guru'), '-', true);
        $this->guruModel->save([
            'id' => $id,
            'nama_guru' => $this->request->getVar('nama_guru'),
            'slug' => $slug,
            'tmplahir' => $this->request->getVar('tmplahir'),
            'tlahir' => $this->request->getVar('tlahir'),
            'pterakhir' => $this->request->getVar('pterakhir'),
            'jabatan' => $this->request->getVar('jabatan'),
            'kmengajar' => $this->request->getVar('kmengajar'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/guru');
    }
}
