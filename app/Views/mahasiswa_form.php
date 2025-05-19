<!DOCTYPE html>
<html lang="id">

<head>
    <title><?= esc($judul_halaman ?? 'Form Data Mahasiswa') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* Latar belakang Bootstrap standar */
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        /* Minimal custom CSS */
        .image-preview-wrapper {
            border: 1px dashed #ced4da;
            padding: 1rem;
            border-radius: 0.375rem; /* Bootstrap's default border-radius */
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef; /* Sedikit lebih gelap dari body */
            margin-top: 0.5rem;
            text-align: center; /* Untuk placeholder */
        }
        .image-preview-wrapper.has-image {
            border-style: solid;
            padding: 0.25rem;
            background-color: #fff;
        }
        .image-preview {
            max-width: 100%; /* Agar responsif di dalam wrapper */
            max-height: 150px;
            object-fit: contain;
            display: none; /* Defaultnya tersembunyi */
            border-radius: 0.25rem;
        }
        .image-preview-placeholder {
            color: #6c757d;
            font-style: italic;
        }
        .form-label .text-danger { /* Untuk bintang merah */
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 800px;"> <!-- Container Bootstrap standar -->
        <div class="bg-white p-4 p-md-5 rounded shadow-sm"> <!-- Card-like effect dengan utilitas -->
            <h2 class="text-center mb-4 pb-2 border-bottom">
                <?= esc($judul_halaman ?? 'Tambah Data Mahasiswa') ?>
            </h2>

            <?php
            $validationErrors = session()->getFlashdata('errors');
            if (empty($validationErrors) && isset($validation) && $validation->getErrors()) {
                $validationErrors = $validation->getErrors();
            }
            ?>

            <?php if (!empty($validationErrors) && is_array($validationErrors)) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Terjadi Kesalahan!</h4>
                    <p class="mb-0">Mohon periksa kembali input Anda.</p>
                </div>
            <?php endif; ?>

            <form action="<?= $form_action ?? site_url('mahasiswa/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (isset($is_edit_mode) && $is_edit_mode): ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= esc($mahasiswa['id'] ?? '') ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                        <input type="text"
                            class="form-control <?= (!empty($validationErrors['nim'])) ? 'is-invalid' : '' ?>"
                            id="nim" name="nim" value="<?= esc(old('nim', $mahasiswa['nim'] ?? '')) ?>"
                            placeholder="Nomor Induk Mahasiswa">
                    </div>
                    <?php if (!empty($validationErrors['nim'])) : ?>
                        <div class="invalid-feedback d-block">
                            <?= esc($validationErrors['nim']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="foto" class="form-label">Foto Profil <?= (isset($is_edit_mode) && $is_edit_mode && !empty($mahasiswa['foto'])) ? '' : '<span class="text-danger">*</span>' ?></label>
                        <input type="file"
                            class="form-control <?= (!empty($validationErrors['foto'])) ? 'is-invalid' : '' ?>"
                            id="foto" name="foto" onchange="previewImage(event, 'foto-preview', 'foto-preview-wrapper')">
                        <div class="image-preview-wrapper" id="foto-preview-wrapper">
                            <img id="foto-preview" src="<?= (isset($mahasiswa['foto']) && !empty($mahasiswa['foto'])) ? base_url('img/mahasiswa/' . $mahasiswa['foto']) : '#' ?>"
                                 alt="Preview Foto" class="image-preview">
                            <span class="image-preview-placeholder">Preview Foto Akan Tampil Disini</span>
                        </div>
                        <?php if (!empty($validationErrors['foto'])) : ?>
                            <div class="invalid-feedback d-block">
                                <?= esc($validationErrors['foto']) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($is_edit_mode) && $is_edit_mode && !empty($mahasiswa['foto'])): ?>
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label for="foto_ktp" class="form-label">Foto KTP <?= (isset($is_edit_mode) && $is_edit_mode && !empty($mahasiswa['foto_ktp'])) ? '' : '<span class="text-danger">*</span>' ?></label>
                        <input type="file"
                            class="form-control <?= (!empty($validationErrors['foto_ktp'])) ? 'is-invalid' : '' ?>"
                            id="foto_ktp" name="foto_ktp" onchange="previewImage(event, 'foto-ktp-preview', 'foto-ktp-preview-wrapper')">
                        <div class="image-preview-wrapper" id="foto-ktp-preview-wrapper">
                            <img id="foto-ktp-preview" src="<?= (isset($mahasiswa['foto_ktp']) && !empty($mahasiswa['foto_ktp'])) ? base_url('img/mahasiswa/' . $mahasiswa['foto_ktp']) : '#' ?>"
                                 alt="Preview KTP" class="image-preview">
                            <span class="image-preview-placeholder">Preview KTP Akan Tampil Disini</span>
                        </div>
                        <?php if (!empty($validationErrors['foto_ktp'])) : ?>
                            <div class="invalid-feedback d-block">
                                <?= esc($validationErrors['foto_ktp']) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($is_edit_mode) && $is_edit_mode && !empty($mahasiswa['foto_ktp'])): ?>
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah KTP.</small>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text"
                            class="form-control <?= (!empty($validationErrors['nama_lengkap'])) ? 'is-invalid' : '' ?>"
                            id="nama_lengkap" name="nama_lengkap" value="<?= esc(old('nama_lengkap', $mahasiswa['nama_lengkap'] ?? '')) ?>"
                            placeholder="Nama Lengkap Sesuai Identitas">
                    </div>
                    <?php if (!empty($validationErrors['nama_lengkap'])) : ?>
                        <div class="invalid-feedback d-block">
                            <?= esc($validationErrors['nama_lengkap']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="program_studi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control <?= (!empty($validationErrors['program_studi'])) ? 'is-invalid' : '' ?>"
                            id="program_studi" name="program_studi" value="<?= esc(old('program_studi', $mahasiswa['program_studi'] ?? '')) ?>"
                            placeholder="Contoh: Teknik Informatika">
                        <?php if (!empty($validationErrors['program_studi'])) : ?>
                            <div class="invalid-feedback d-block">
                                <?= esc($validationErrors['program_studi']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label for="fakultas" class="form-label">Fakultas <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control <?= (!empty($validationErrors['fakultas'])) ? 'is-invalid' : '' ?>"
                            id="fakultas" name="fakultas" value="<?= esc(old('fakultas', $mahasiswa['fakultas'] ?? '')) ?>"
                            placeholder="Contoh: Fakultas Ilmu Komputer">
                        <?php if (!empty($validationErrors['fakultas'])) : ?>
                            <div class="invalid-feedback d-block">
                                <?= esc($validationErrors['fakultas']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="angkatan" class="form-label">Angkatan <span class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control <?= (!empty($validationErrors['angkatan'])) ? 'is-invalid' : '' ?>"
                        id="angkatan" name="angkatan" value="<?= esc(old('angkatan', $mahasiswa['angkatan'] ?? '')) ?>"
                        placeholder="Tahun Angkatan, contoh: 2020" min="1900" max="<?= date('Y') + 5 ?>">
                    <?php if (!empty($validationErrors['angkatan'])) : ?>
                        <div class="invalid-feedback d-block">
                            <?= esc($validationErrors['angkatan']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email"
                            class="form-control <?= (!empty($validationErrors['email'])) ? 'is-invalid' : '' ?>"
                            id="email" name="email" value="<?= esc(old('email', $mahasiswa['email'] ?? '')) ?>"
                            placeholder="alamat.email@contoh.com">
                    </div>
                    <?php if (!empty($validationErrors['email'])) : ?>
                        <div class="invalid-feedback d-block">
                            <?= esc($validationErrors['email']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= site_url('/mahasiswa') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-<?= (isset($is_edit_mode) && $is_edit_mode) ? 'arrow-clockwise' : 'save' ?>"></i>
                        <?= (isset($is_edit_mode) && $is_edit_mode) ? 'Update Data' : 'Simpan Data' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function initPreview(imgElement, placeholderElement, wrapperElement) {
            if (imgElement.src && imgElement.src !== '#' && imgElement.src !== window.location.href + '#') {
                imgElement.style.display = 'block';
                if (placeholderElement) placeholderElement.style.display = 'none';
                if (wrapperElement) wrapperElement.classList.add('has-image');
            } else {
                imgElement.style.display = 'none';
                if (placeholderElement) placeholderElement.style.display = 'block';
                if (wrapperElement) wrapperElement.classList.remove('has-image');
            }
        }

        function previewImage(event, previewId, wrapperId) {
            const reader = new FileReader();
            const outputImg = document.getElementById(previewId);
            const wrapper = document.getElementById(wrapperId);
            const placeholder = wrapper ? wrapper.querySelector('.image-preview-placeholder') : null;

            reader.onload = function() {
                outputImg.src = reader.result;
                initPreview(outputImg, placeholder, wrapper);
            };

            if (event.target.files && event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                // Jika file dibatalkan, kembalikan ke src awal (jika ada di mode edit)
                // Ini bagian yang agak tricky jika ingin mempertahankan gambar lama saat batal pilih
                // Untuk kesederhanaan, kita bisa set ke # atau biarkan src lama jika ada dari PHP
                const oldImageSrc = outputImg.dataset.oldSrc || '#';
                outputImg.src = oldImageSrc;
                initPreview(outputImg, placeholder, wrapper);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fotoPreview = document.getElementById('foto-preview');
            const fotoWrapper = document.getElementById('foto-preview-wrapper');
            const fotoPlaceholder = fotoWrapper ? fotoWrapper.querySelector('.image-preview-placeholder') : null;
            if(fotoPreview) fotoPreview.dataset.oldSrc = fotoPreview.src; // Simpan src awal
            initPreview(fotoPreview, fotoPlaceholder, fotoWrapper);

            const fotoKtpPreview = document.getElementById('foto-ktp-preview');
            const fotoKtpWrapper = document.getElementById('foto-ktp-preview-wrapper');
            const fotoKtpPlaceholder = fotoKtpWrapper ? fotoKtpWrapper.querySelector('.image-preview-placeholder') : null;
            if(fotoKtpPreview) fotoKtpPreview.dataset.oldSrc = fotoKtpPreview.src; // Simpan src awal
            initPreview(fotoKtpPreview, fotoKtpPlaceholder, fotoKtpWrapper);
        });
    </script>
</body>
</html>