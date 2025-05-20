<!DOCTYPE html>
<html>

<head>
    <title><?= esc($judul_halaman ?? 'Edit Data Mahasiswa') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            /* Latar belakang Bootstrap standar */
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        /* Minimal custom CSS */
        .image-preview-wrapper {
            border: 1px dashed #ced4da;
            padding: 1rem;
            border-radius: 0.375rem;
            /* Bootstrap's default border-radius */
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
            /* Sedikit lebih gelap dari body */
            margin-top: 0.5rem;
            text-align: center;
            /* Untuk placeholder */
        }

        .image-preview-wrapper.has-image {
            border-style: solid;
            padding: 0.25rem;
            background-color: #fff;
        }

        .image-preview {
            max-width: 100%;
            /* Agar responsif di dalam wrapper */
            max-height: 150px;
            object-fit: contain;
            display: none;
            /* Defaultnya tersembunyi */
            border-radius: 0.25rem;
        }

        .image-preview-placeholder {
            color: #6c757d;
            font-style: italic;
        }

        .form-label .text-danger {
            /* Untuk bintang merah */
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 800px;">
        <div class="bg-white p-4 p-md-5 rounded shadow-sm mt-5 ">
            <h2 class="text-center mb-4 pb-2 border-bottom">
                <?= esc($judul_halaman ?? 'Edit Data Mahasiswa') ?>
            </h2>

            <?php
            $validationErrors = session()->getFlashdata('errors');
            if (empty($validationErrors) && isset($validation) && $validation->getErrors()) {
                $validationErrors = $validation->getErrors(); 
            }
            ?>

            <?php if (!empty($validationErrors)) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Terjadi Kesalahan!</h4>
                    <p class="mb-0">Mohon periksa kembali input Anda.</p>   

                </div>
            <?php endif; ?>

            <form action="/mahasiswa/update/<?= isset($mahasiswa['id']) ? esc($mahasiswa['id'], 'attr') : '' ?>" method="POST">
                <?= csrf_field() ?> <!-- Jangan lupa CSRF field untuk keamanan -->


                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text"
                        class="form-control <?= (!empty($validationErrors['nim'])) ? 'is-invalid' : '' ?>"
                        id="nim" name="nim"
                        value="<?= old('nim', isset($mahasiswa['nim']) ? esc($mahasiswa['nim'], 'attr') : '') ?>">
                    <?php if (!empty($validationErrors['nim'])) : ?>
                        <div class="invalid-feedback">
                            <?= esc($validationErrors['nim']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text"
                        class="form-control <?= (!empty($validationErrors['nama_lengkap'])) ? 'is-invalid' : '' ?>"
                        id="nama_lengkap" name="nama_lengkap"
                        value="<?= old('nama_lengkap', isset($mahasiswa['nama_lengkap']) ? esc($mahasiswa['nama_lengkap'], 'attr') : '') ?>">
                    <?php if (!empty($validationErrors['nama_lengkap'])) : ?>
                        <div class="invalid-feedback">
                            <?= esc($validationErrors['nama_lengkap']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="program_studi" class="form-label">Program Studi</label>
                    <input type="text"
                        class="form-control <?= (!empty($validationErrors['program_studi'])) ? 'is-invalid' : '' ?>"
                        id="program_studi" name="program_studi"
                        value="<?= old('program_studi', isset($mahasiswa['program_studi']) ? esc($mahasiswa['program_studi'], 'attr') : '') ?>">
                    <?php if (!empty($validationErrors['program_studi'])) : ?>
                        <div class="invalid-feedback">
                            <?= esc($validationErrors['program_studi']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="fakultas" class="form-label">Fakultas</label>
                    <input type="text"
                        class="form-control <?= (!empty($validationErrors['fakultas'])) ? 'is-invalid' : '' ?>"
                        id="fakultas" name="fakultas"
                        value="<?= old('fakultas', isset($mahasiswa['fakultas']) ? esc($mahasiswa['fakultas'], 'attr') : '') ?>">
                    <?php if (!empty($validationErrors['fakultas'])) : ?>
                        <div class="invalid-feedback">
                            <?= esc($validationErrors['fakultas']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input type="number"
                        class="form-control <?= (!empty($validationErrors['angkatan'])) ? 'is-invalid' : '' ?>"
                        id="angkatan" name="angkatan"
                        value="<?= old('angkatan', isset($mahasiswa['angkatan']) ? esc($mahasiswa['angkatan'], 'attr') : '') ?>">
                    <?php if (!empty($validationErrors['angkatan'])) : ?>
                        <div class="invalid-feedback">
                            <?= esc($validationErrors['angkatan']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                        class="form-control <?= (!empty($validationErrors['email'])) ? 'is-invalid' : '' ?>"
                        id="email" name="email" value="<?= old('email', isset($mahasiswa['email']) ? esc($mahasiswa['email']) : '') ?>">
                </div>

                <!-- Tambahkan kelas custom-submit-btn pada tombol -->
                <button type="submit" class="btn btn-primary custom-submit-btn">Simpan Perubahan</button>
            </form>
        </div>


</body>

</html>