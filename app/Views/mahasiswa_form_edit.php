<!DOCTYPE html>
<html>

<head>
    <title><?= esc($judul_halaman ?? 'Edit Data Mahasiswa') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            /* Tambah margin bawah untuk jarak */
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

        /* Styling untuk menampilkan error individual di bawah field (opsional) */
        .is-invalid {
            border-color: #dc3545;
            /* Warna border merah untuk error */
        }

        .invalid-feedback {
            display: block;
            /* Agar pesan error dari CI4 (jika digunakan) terlihat */
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container mt-5 custom-form-container">
        <h2 class="form-title"><?= esc($judul_halaman ?? 'Edit Data Mahasiswa') ?></h2>

        <?php
        // Ambil errors dari session flashdata jika ada
        // Di CI4, jika Anda menggunakan redirect()->with('errors', $validator->getErrors()),
        // maka $errors akan otomatis tersedia di view jika tidak null.
        // Jika Anda menggunakan service validation langsung di view, maka $validation->getErrors()
        $validationErrors = session()->getFlashdata('errors');
        if (empty($validationErrors) && isset($validation) && $validation->getErrors()) {
            $validationErrors = $validation->getErrors(); // Untuk kasus validasi langsung di view
        }
        ?>

        <?php if (!empty($validationErrors)) : ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Oops! Terjadi Kesalahan Validasi!</h4>
                <p>Mohon periksa kembali input Anda. Detail kesalahan:</p>
                <hr>

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