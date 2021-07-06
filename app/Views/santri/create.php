<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Data Santri</h2>

            <form action="/santri/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama_santri" class="col-sm-2 col-form-label">Nama Santri</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_santri')) ? 'is-invalid' : ''; ?>" id="nama_santri" name="nama_santri" autofocus value="<?= old('nama_santri'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_santri'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_orangtua" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" value="<?= old('nama_orangtua'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="infaq_wajib" class="col-sm-2 col-form-label">Infaq Wajib</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="infaq_wajib" name="infaq_wajib" value="<?= old('infaq_wajib'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="realisasi" class="col-sm-2 col-form-label">Realisasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="realisasi" name="realisasi" value="<?= old('realisasi'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="minus" class="col-sm-2 col-form-label">Minus</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="minus" name="minus" value="<?= old('minus'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= old('keterangan'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file"></div>
                        <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" autofocus value="<?= old('foto'); ?>" id="foto" name="foto" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                        <label class="custom-file-label" for="foto">Pilih gambar...</label>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>