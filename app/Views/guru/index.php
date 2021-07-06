<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/guru/create" class="btn btn-primary mt-3">Tambah Data Guru</a>
            <h1 class="mt-2">DATA GURU TK/TPA AL-MUHAJIRIN Unit 449 </h1>
            <h3>TAHUN PEMBELAJARAN 2021</h3>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Tempat Lahir</th>
                        <th scope="col">Tanggal lahir</th>
                        <th scope="col">Pendidikan Terakhir</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Kelas Mengajar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($guru as $g) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $g['foto']; ?>" alt="" class="foto"></td>
                            <td><?= $g['nama_guru']; ?></td>
                            <td><?= $g['tmplahir']; ?></td>
                            <td><?= date('d F Y', strtotime($g['tlahir'])); ?></td>
                            <td><?= $g['pterakhir']; ?></td>
                            <td><?= $g['jabatan']; ?></td>
                            <td><?= $g['kmengajar']; ?></td>
                            <td>
                                <a href="/guru/<?= $g['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>