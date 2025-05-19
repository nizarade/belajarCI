<!DOCTYPE html>
<html>

<head>
    <title><?= esc($judul_halaman ?? 'Edit Data Mahasiswa') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan ini untuk Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .container.custom-form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin: 40px auto;
            max-width: 700px;
        }

        h2.form-title {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
        }

        .form-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25), inset 0 1px 3px rgba(0, 0, 0, 0.05);
            outline: none;
        }

        .btn-primary.custom-submit-btn {
            background-color: #3498db;
            border-color: #3498db;
            padding: 10px 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 5px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary.custom-submit-btn:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        /* Style untuk Tombol Kembali */
        .btn-secondary.custom-back-btn {
            background-color: #6c757d;
            /* Warna abu-abu standar Bootstrap */
            border-color: #6c757d;
            padding: 10px 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 5px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            color: #fff;
            /* Pastikan teksnya putih agar kontras */
        }

        .btn-secondary.custom-back-btn:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .custom-back-btn i,
        .custom-submit-btn i {
            /* Jika Anda ingin menambahkan ikon pada submit juga */
            margin-right: 5px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 20px;
        }


        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .alert-danger .alert-heading {
            color: inherit;
        }

        .alert-danger hr {
            border-top-color: #f1b0b7;
        }

        .alert-danger ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .alert-danger li {
            margin-bottom: 5px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .image-preview-container {
            margin-top: 10px;
            text-align: left; /* atau center jika Anda mau */
        }

        .image-preview {
            max-width: 150px; /* Atur lebar maksimal preview */
            max-height: 100px; /* Atur tinggi maksimal preview */
            border: 1px solid #ddd;
            border-radius: 5px;
            object-fit: cover; /* Agar gambar tidak terdistorsi */
            display: none; /* Sembunyikan secara default */
        }
    </style>
</head>

<body>
    <div class="container mt-5 custom-form-container">
        <h2 class="form-title"><?= esc($judul_halaman ?? 'Tambah Data Mahasiswa') ?></h2>

        <?php
        $validationErrors = session()->getFlashdata('errors');
        if (empty($validationErrors) && isset($validation) && $validation->getErrors()) {
            $validationErrors = $validation->getErrors();
        }
        ?>

        <?php if (!empty($validationErrors)) : ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Oops! Terjadi Kesalahan Validasi!</h4>
                <p>Mohon periksa kembali input Anda. Detail kesalahan:</p>
                <hr>
                <!-- Anda bisa menampilkan list error di sini jika mau -->
                <!-- <ul>
                    <?php //foreach ($validationErrors as $error) : 
                    ?>
                        <li><? //= esc($error) 
                            ?></li>
                    <?php //endforeach; 
                    ?>
                </ul> -->
            </div>
        <?php endif; ?>

        <form action="/mahasiswa/store" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text"
                    class="form-control <?= (!empty($validationErrors['nim'])) ? 'is-invalid' : '' ?>"
                    id="nim" name="nim" >
                <?php if (!empty($validationErrors['nim'])) : ?>
                    <div class="invalid-feedback">
                        <?= esc($validationErrors['nim']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file"
                    class="form-control <?= (!empty($validationErrors['foto'])) ? 'is-invalid' : '' ?>"
                    id="foto" name="foto" onchange="previewImage(event, 'foto-preview')">
                <div class="image-preview-container">
                    <img id="foto-preview" src="#" alt="Preview Foto Profil" class="image-preview">
                </div>
                <?php if (!empty($validationErrors['foto'])) : ?>
                    <div class="invalid-feedback">
                        <?= esc($validationErrors['foto']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="foto_ktp" class="form-label">Foto KTP</label>
                <input type="file"
                    class="form-control <?= (!empty($validationErrors['foto_ktp'])) ? 'is-invalid' : '' ?>"
                    id="foto_ktp" name="foto_ktp" onchange="previewImage(event, 'foto-ktp-preview')">
                <div class="image-preview-container">
                    <img id="foto-ktp-preview" src="#" alt="Preview Foto KTP" class="image-preview">
                </div>
                <?php if (!empty($validationErrors['foto_ktp'])) : ?>
                    <div class="invalid-feedback">
                        <?= esc($validationErrors['foto_ktp']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text"
                    class="form-control <?= (!empty($validationErrors['nama_lengkap'])) ? 'is-invalid' : '' ?>"
                    id="nama_lengkap" name="nama_lengkap" value="<?= esc(old('nama_lengkap')) ?>">
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
                    id="program_studi" name="program_studi" value="<?= esc(old('program_studi')) ?>">
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
                    id="fakultas" name="fakultas" value="<?= esc(old('fakultas')) ?>">
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
                    id="angkatan" name="angkatan" value="<?= esc(old('angkatan')) ?>">
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
                    id="email" name="email" value="<?= esc(old('email')) ?>">
                <?php if (!empty($validationErrors['email'])) : ?> <!-- Menambahkan validasi error untuk email -->
                    <div class="invalid-feedback">
                        <?= esc($validationErrors['email']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Wadah untuk tombol-tombol aksi -->
            <div class="form-actions">
                <a href="<?= site_url('/mahasiswa') ?>" class="btn btn-secondary custom-back-btn">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary custom-submit-btn">
                    <i class="bi bi-save"></i> Tambahkan Data
                </button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            const output = document.getElementById(previewId);

            reader.onload = function() {
                output.src = reader.result;
                output.style.display = 'block'; // Tampilkan elemen img
            };

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                output.src = '#'; // Kosongkan src jika tidak ada file dipilih
                output.style.display = 'none'; // Sembunyikan elemen img
            }
        }
    </script>
</body>

</html>