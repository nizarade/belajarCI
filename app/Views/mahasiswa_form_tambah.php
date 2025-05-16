<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Data Mahasiswa</h2>
    <form action="/mahasiswa/store" method="POST">
        <!-- Tambahkan CSRF token jika diperlukan (misalnya di Laravel: @csrf) -->
        <?php csrf_field(); ?>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?= old('nim', $mahasiswa['nim'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama_lengkap" value="<?= old('nama_lengkap', $mahasiswa['nama_lengkap'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="program_studi" class="form-label">Program Studi</label>
            <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?= old('program_studi', $mahasiswa['program_studi'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="fakultas" class="form-label">Fakultas</label>
            <input type="text" class="form-control" id="fakultas" name="fakultas" value="<?= old('fakultas', $mahasiswa['fakultas'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="number" class="form-control" id="angkatan" name="angkatan" value="<?= old('angkatan', $mahasiswa['angkatan'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $mahasiswa['email'] ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>
</body>
</html>
