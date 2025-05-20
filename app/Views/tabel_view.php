<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title><?= esc($judul_halaman) ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(143, 168, 225);
            color: #333;
            padding-top: 20px;
        }

        .container-custom {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin: 20px auto;
        }

        h1.page-title {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            border-bottom: 3px solid #3498db;
            padding-bottom: 15px;
        }

        .table {
            margin-top: 25px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        .table thead th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom-width: 0;
            border-top: none !important;
            vertical-align: middle;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border: 1px solid #e0e0e0;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .no-data-message {
            padding: 25px;
            color: #6c757d;
            font-style: italic;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-top: 20px;
        }

        .actions .btn {
            margin-right: 5px;
            padding: 6px 12px;
            font-size: 0.875em;
        }

        .actions form {
            display: inline-block;
        }

        img.foto-mhs,
        img.foto-ktp-mhs {
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        img.foto-mhs:hover,
        img.foto-ktp-mhs:hover {
            transform: scale(1.05);
        }

        img.foto-mhs {
            width: 60px;
            height: 90px;
        }

        img.foto-ktp-mhs {
            width: 90px;
            height: 60px;
        }

        /* Penyesuaian untuk paginasi Bootstrap (umumnya sudah dicakup oleh Bootstrap CSS) */
        .pagination {
            margin-top: 30px;
            justify-content: center;
            /* Pusatkan paginasi */
        }

        /* Style ini akan diterapkan jika template pager menghasilkan class yang benar */
        .pagination .page-item.active .page-link {
            background-color: #3498db;
            border-color: #3498db;
            color: white;
        }

        .pagination .page-link {
            color: #3498db;
        }

        .pagination .page-link:hover {
            color: #2980b9;
            background-color: #e9ecef;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }

        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .btn-add-mahasiswa {
            background-color: #2ecc71;
            border-color: #2ecc71;
            font-weight: 500;
        }

        .btn-add-mahasiswa:hover {
            background-color: #28b662;
            border-color: #28b662;
        }

        .alert {
            border-radius: 8px;
        }

        .search-form {
            margin-bottom: 20px;
        }

        .search-form .form-control {
            border-radius: 0.375rem 0 0 0.375rem;
            /* Sesuaikan jika tombol di kanan */
        }

        .search-form .btn {
            border-radius: 0 0.375rem 0.375rem 0;
            /* Sesuaikan jika input di kiri */
        }
    </style>
</head>

<body>
    <div class="container container-custom">
        <h1 class="page-title"><?= esc($judul_halaman) ?></h1>

        <div class="row">
            <div class="col-md-6 d-flex justify-content-md-start align-items-start">
                <a href="<?= site_url('mahasiswa/create') ?>" class="btn btn-add-mahasiswa text-white">
                    <i class="fas fa-plus me-1"></i> Tambah Mahasiswa
                </a>
            </div>
            <div class="col-md-6">
                <!-- Form Pencarian -->
                <form action="<?= site_url('mahasiswa') ?>" method="get" class="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari nama mahasiswa..." name="keyword" value="<?= esc($keyword ?? '') ?>">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                    </div>
                </form>
            </div>
            
        </div>

        <?php $session = session(); ?>

        <?php if ($session->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= esc($session->getFlashdata('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($session->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-times-circle me-2"></i>
                <?= esc($session->getFlashdata('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>


        <?php if (!empty($mahasiswa_data) && is_array($mahasiswa_data)): ?>
            <div class="table-responsive-custom">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>NIM</th>
                            <th>Foto</th>
                            <th>Foto KTP</th>
                            <th>Nama Lengkap</th>
                            <th>Program Studi</th>
                            <th>Fakultas</th>
                            <th>Angkatan</th>
                            <th>Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa_data as $mhs): ?>
                            <tr>
                                <td><?= esc($mhs['nim']) ?></td>
                                <td><img class="foto-mhs" src="/img/mahasiswa/<?= esc($mhs['foto']) ?>" alt="Foto <?= esc($mhs['nama_lengkap']) ?>"></td>
                                <td><img class="foto-ktp-mhs" src="/img/mahasiswa/<?= esc($mhs['foto_ktp']) ?>" alt="KTP <?= esc($mhs['nama_lengkap']) ?>"></td>
                                <td><?= esc($mhs['nama_lengkap']) ?></td>
                                <td><?= esc($mhs['program_studi']) ?></td>
                                <td><?= esc($mhs['fakultas']) ?></td>
                                <td><?= esc($mhs['angkatan']) ?></td>
                                <td><?= esc($mhs['email']) ?></td>
                                <td class="actions text-center">
                                    <div class="d-inline-flex gap-1">

                                        <a href="<?= site_url('mahasiswa/edit/' . $mhs['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?= site_url('mahasiswa/delete/' . esc($mhs['id'], 'url')) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini: <?= esc($mhs['nama_lengkap']) ?>?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($pager): ?>
                <nav aria-label="Page navigation">
                    <?php
                    // Menggunakan template default 'default_full' atau template lain yang Anda konfigurasikan sebagai default
                    // untuk grup 'mahasiswa' di app/Config/Pager.php
                    // Jika tidak ada konfigurasi grup, ia akan menggunakan $defaultView dari Pager.php
                    // yang biasanya adalah 'default_full'.
                    // Template ini harus menghasilkan class Bootstrap seperti .pagination, .page-item, .page-link
                    echo $pager->links('mahasiswa');

                    // Alternatif: secara eksplisit memanggil template default_full
                    // echo $pager->links('mahasiswa', 'default_full');
                    ?>
                </nav>
            <?php endif; ?>

        <?php else: ?>
            <div class="alert alert-info no-data-message text-center" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <?php if (isset($keyword) && !empty($keyword)): ?>
                    Tidak ada data mahasiswa yang cocok dengan kata kunci "<?= esc($keyword) ?>".
                <?php else: ?>
                    Tidak ada data mahasiswa untuk ditampilkan.
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>