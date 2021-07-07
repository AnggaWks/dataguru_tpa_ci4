<?php

namespace App\Controllers;

use App\Models\SantriModel;

class Santri extends BaseController
{
    protected $santriModel;
    public function __construct()
    {
        $this->santriModel = new SantriModel();
    }
    public function index()
    {
        // $santri = $this->santriModel->findAll();
        $currentPage = $this->request->getVar('page_tbsantri') ? $this->request->getVar('page_tbsantri') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $santri = $this->santriModel->search($keyword);
        } else {
            $santri = $this->santriModel;
        }
        $data = [
            'title' => 'Data Santri TPA',
            // 'santri' => $this->santriModel->findAll()
            'santri' => $santri->paginate(10, 'tbsantri'),
            'pager' => $this->santriModel->pager,
            'currentPage' => $currentPage
        ];

        // santriModel = new \App\Models\SantriModel();
        // $santriModel = new SantriModel();



        return view('santri/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Santri',
            'santri' => $this->santriModel->getSantri($slug)
        ];

        //jika guru tidak ada di tabel
        if (empty($data['santri'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Santri' . $slug . 'tidak ditemukan.');
        }
        return view('santri/detail', $data);
    }
    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Data Santri',
            'validation' => \Config\Services::validation()
        ];
        return view('santri/create', $data);
    }
    public function save()
    {
        // validasi input 
        if (!$this->validate([
            'nama_santri' => [
                'rules' => 'required|is_unique[tbsantri.nama_santri]',
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
            // return redirect()->to('/santri/create')->withInput()->with('validation', $validation);
            return redirect()->to('/santri/create')->withInput();
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


        $slug = url_title($this->request->getVar('nama_santri'), '-', true);
        $this->santriModel->save([
            'nama_santri' => $this->request->getVar('nama_santri'),
            'slug' => $slug,
            'alamat' => $this->request->getVar('alamat'),
            'nama_orangtua' => $this->request->getVar('nama_orangtua'),
            'infaq_wajib' => $this->request->getVar('infaq_wajib'),
            'realisasi' => $this->request->getVar('realisasi'),
            'minus' => $this->request->getVar('minus'),
            'keterangan' => $this->request->getVar('keterangan'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/santri');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $satri = $this->satriModel->find($id);

        // cek jika file gambar defalt.jpg
        if ($satri['foto'] != 'default.jpg') {

            // hapus gambar
            unlink('img/' . $satri['foto']);
        }
        $this->guruModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/santri');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Santri',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santriModel->getSantri($slug)
        ];
        return view('santri/edit', $data);
    }
    public function update($id)
    {
        // cek nama
        $nama_santrilama = $this->santriModel->getSantri($this->request->getVar('slug'));
        if ($nama_santrilama['nama_santri'] == $this->request->getVar('nama_santri')) {
            $rule_nama_santri = 'required';
        } else {
            $rule_nama_santri = 'required|is_unique[tbsantri.nama_santri]';
        }

        if (!$this->validate([
            'nama_santri' => [
                'rules' => $rule_nama_santri,
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

            return redirect()->to('/santri/edit/' . $this->request->getVar('slug'))->withInput();
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

        $slug = url_title($this->request->getVar('nama_santri'), '-', true);
        $this->santriModel->save([
            'nama_santri' => $this->request->getVar('nama_santri'),
            'slug' => $slug,
            'alamat' => $this->request->getVar('alamat'),
            'nama_orangtua' => $this->request->getVar('nama_orangtua'),
            'infaq_wajib' => $this->request->getVar('infaq_wajib'),
            'realisasi' => $this->request->getVar('realisasi'),
            'minus' => $this->request->getVar('minus'),
            'keterangan' => $this->request->getVar('keterangan'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/santri');
    }
}
