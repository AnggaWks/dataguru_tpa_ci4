<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Guru</h2>
            <div class="card mb-3" style="max-width: 640px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $guru['foto']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $guru['nama_guru']; ?></h5>
                            <p class="card-text"><b> Tempat Lahir : </b> <?= $guru['tmplahir']; ?> </p>
                            <p class="card-text"><b> Tanggal lahir : </b> <?= date('d F Y', strtotime($guru['tlahir'])); ?> </p>
                            <p class="card-text"><b> Jabatan : </b> <?= $guru['jabatan']; ?> </p>
                            <p class="card-text"><small class="text-muted"><b> Alamat : </b> <?= $guru['alamat']; ?></small></p>
                            <p class="card-text"><small class="text-muted"><b> No.Tlp/Hp : </b> <?= $guru['notelp']; ?></small></p>

                            <a href="/guru/edit/<?= $guru['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/guru/<?= $guru['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                            </form>


                            <br><br>
                            <a href="/guru">Kembali ke Data Guru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>