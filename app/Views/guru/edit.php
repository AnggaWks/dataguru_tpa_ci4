<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Guru</h2>

            <form action="/guru/update/<?= $guru['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $guru['slug']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $guru['foto']; ?>">
        </div>
        <div class="row mb-3">
            <label for="nama_guru" class="col-sm-2 col-form-label">Nama Guru</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama_guru')) ? 'is-invalid' : ''; ?>" id="nama_guru" name="nama_guru" autofocus value="<?= (old('nama_guru')) ? old('nama_guru') : $guru['nama_guru'] ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_guru'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="tmplahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('tmplahir')) ? 'is-invalid' : ''; ?>" id="tmplahir" name="tmplahir" value="<?= (old('tmplahir')) ? old('tmplahir') : $guru['tmplahir'] ?>">
                <?= $validation->getError('tmplahir'); ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="tlahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tlahir" name="tlahir" value="<?= (old('tlahir')) ? old('tlahir') : $guru['tlahir'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="pterakhir" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pterakhir" name="pterakhir" value="<?= (old('pterakhir')) ? old('pterakhir') : $guru['pterakhir'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= (old('jabatan')) ? old('jabatan') : $guru['jabatan'] ?>>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="kmengajar" class="col-sm-2 col-form-label">Kelas Mengajar</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kmengajar" name="kmengajar" value="<?= (old('kmengajar')) ? old('kmengajar') : $guru['kmengajar'] ?>">
            </div>
        </div>
        <div class="col-sm-2">
            <img src="/img/<?= $guru['foto']; ?>.jpg" class="img-thumbnail img-preview">
        </div>
        <div class="col-sm-8">
            <div class="custom-file"></div>
            <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" autofocus value="<?= old('foto'); ?>" id="foto" name="foto" onchange="previewImg()">
            <div class="invalid-feedback">
                <?= $validation->getError('foto'); ?>
            </div>
            <label class="custom-file-label" for="foto"><?= $guru['foto']; ?></label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-10 offset-sm-2">
    </div>
</div>
<button type="submit" class="btn btn-primary">Ubah Data</button>
</form>
</div>
</div>
</div>
<?= $this->endSection(); ?>