<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title><?= esc($judul_halaman) ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            /* max-width: 800px; */ /* Bisa disesuaikan jika tabel lebih lebar */
            margin: 40px auto;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            text-align: left;
            vertical-align: middle; /* Agar tombol aksi sejajar jika ada perbedaan tinggi baris */
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f7f9fa;
        }

        tr:hover {
            background-color: #eef5fc;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }

        .actions a,
        .actions button {
            margin-right: 5px;
            margin-bottom: 5px; /* Untuk wrapping tombol di layar kecil */
            padding: 5px 10px; /* Sesuaikan padding tombol */
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
            display: inline-block; /* Agar margin-bottom efektif */
        }

        .actions .edit-btn {
            background-color: #f39c12;
            /* Oranye */
            color: white;
            border: none;
        }

        .actions .delete-btn {
            background-color: #e74c3c;
            /* Merah */
            color: white;
            border: none;
        }

        .actions .delete-btn:hover,
        .actions .edit-btn:hover {
            opacity: 0.8;
        }

        /* Paginasi akan di-style oleh Bootstrap jika menggunakan template yang benar */
        .pagination {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }
        .btn-add {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-add:hover {
            background-color: #27ae60;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?= esc($judul_halaman) ?></h1>

        <div style="margin-bottom: 15px; text-align: left;">
            <a href="<?= site_url('dosen/create') ?>" class="btn-add">+ Tambah Dosen</a>
        </div>

        <?php $session = session(); ?>

        <?php if ($session->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $session->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($session->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $session->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>


        <?php if (!empty($dosen_data) && is_array($dosen_data)): ?>
            <table>
                <thead>
                    <tr>
                        <th>NIDN</th>
                        <th>Nama Lengkap</th>
                        <th>Program Studi</th>
                        <th>Fakultas</th>
                        <th>Aksi</th>
                        <th>Mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Variabel $nomor dikirim dari controller DosenController::index
                        // $nomor = (($currentPage - 1) * $itemsPerPage) + 1;
                    ?>
                    <?php foreach ($dosen_data as $dsn): ?>
                        <tr>
                            <td><?= esc($dsn['nidn']) ?></td>
                            <td><?= esc($dsn['nama_lengkap']) ?></td>
                            <td><?= esc($dsn['program_studi']) ?></td>
                            <td><?= esc($dsn['fakultas']) ?></td>
                            <td class="actions">
                                <!-- Tombol Edit -->
                                <a href="<?= site_url('dosen/edit/' . $dsn['id']) ?>" class="edit-btn">Edit</a>

                                <!-- Tombol Hapus (dengan konfirmasi) -->
                                <form action="<?= site_url('dosen/delete/' . esc($dsn['id'], 'url')) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini?');">
                                    <?= csrf_field() ?> <!-- Proteksi CSRF -->
                                    <input type="hidden" name="_method" value="DELETE"> <!-- Method Spoofing untuk DELETE -->
                                    <button type="submit" class="delete-btn">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if ($pager): ?>
                <div class="pagination">

                    <?= $pager->links('dosen') ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="no-data">Tidak ada data dosen untuk ditampilkan.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>