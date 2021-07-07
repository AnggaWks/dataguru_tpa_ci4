<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">DATA SANTRI TK/TPA AL-MUHAJIRIN Unit 449 </h1>
            <h3>TAHUN PEMBELAJARAN 2021</h3>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan keyword pencarian..." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
        </div>
        </form>
    </div>
    <div class="row">
        <div class="col">
            <a href="/santri/create" class="btn btn-primary mt-3">Tambah Data Santri</a>
            <br></br>
            <a href="/cetak.php" target="_blank">Cetak></a>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope=" col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama Santri</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nama Orang Tua</th>
                        <th scope="col">Infaq Wajib</th>
                        <th scope="col">Realisasi</th>
                        <th scope="col">Minus</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($santri as $s) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $s['foto']; ?>" alt="" class="foto"></td>
                            <td><?= $s['nama_santri']; ?></td>
                            <td><?= $s['alamat']; ?></td>
                            <td><?= $s['nama_orangtua']; ?></td>
                            <td><?= $s['infaq_wajib']; ?></td>
                            <td><?= $s['realisasi']; ?></td>
                            <td><?= $s['minus']; ?></td>
                            <td><?= $s['keterangan']; ?></td>
                            <td>
                                <a href="/santri/<?= $s['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('tbsantri', 'santri_pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>