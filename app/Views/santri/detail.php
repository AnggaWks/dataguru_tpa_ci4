<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Santri</h2>
            <div class="card mb-3" style="max-width: 640px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $santri['foto']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $santri['nama_santri']; ?></h5>
                            <p class="card-text"><b> Alamat : </b> <?= $santri['alamat']; ?> </p>
                            <p class="card-text"><b> Tanggal Lahir : </b> <?= date('d F Y', strtotime($santri['tlahir'])); ?> </p>
                            </p>
                            <p class="card-text"><b> Nama Orang Tua : </b> <?= $santri['nama_orangtua']; ?> </p>
                            <p class="card-text"><small class="text-muted"><b> No.Tlp/Hp : </b> <?= $santri['notelp']; ?></small></p>

                            <a href="/santri/edit/<?= $santri['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/santri/<?= $santri['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                            </form>


                            <br><br>
                            <a href="/santri">Kembali ke Data Sabtri</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>