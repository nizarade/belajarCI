<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--
        Di CodeIgniter 4, variabel yang dikirim dari controller
        otomatis diekstrak menjadi variabel individual di view.
        Gunakan esc() untuk output demi keamanan (mencegah XSS).
    -->
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
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            /* max-width: 800px; */
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            text-align: left;
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
        .actions a, .actions button {
            margin-right: 5px;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .actions .edit-btn {
            background-color: #f39c12; /* Oranye */
            color: white;
            border: none;
        }
        .actions .delete-btn {
            background-color: #e74c3c; /* Merah */
            color: white;
            border: none;
        }
        .actions .delete-btn:hover, .actions .edit-btn:hover {
            opacity: 0.8;
        }

         /* CSS untuk Paginasi (Contoh Sederhana) */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination li {
            display: inline-block;
            margin: 0 2px;
        }
        .pagination li a, .pagination li span {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #3498db;
            border-radius: 4px;
        }
        .pagination li.active span {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }
        .pagination li.disabled span {
            color: #ccc;
            border-color: #ddd;
        }
        .pagination li a:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= esc($judul_halaman) ?></h1>

        <!-- Tambahkan tombol untuk Tambah Data Baru -->
        <div style="margin-bottom: 15px;">
            <a href="<?= site_url('mahasiswa/create') ?>" style="background-color: #2ecc71; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">+ Tambah Mahasiswa</a>
        </div>

        <?php if (!empty($mahasiswa_data) && is_array($mahasiswa_data)): // Cek apakah ada data pengguna ?>
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Program Studi</th>
                        <th>Fakultas</th>
                        <th>Angkatan</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mahasiswa_data as $mhs): ?>
                        <tr>
                            <td><?= esc($mhs['nim']) ?></td>
                            <td><?= esc($mhs['nama_lengkap']) ?></td>
                            <td><?= esc($mhs['program_studi']) ?></td>
                            <td><?= esc($mhs['fakultas']) ?></td>
                            <td><?= esc($mhs['angkatan']) ?></td>
                            <td><?= esc($mhs['email']) ?></td>
                            <td class="actions">
                                <!-- Tombol Edit -->
                                <a href="<?= site_url('mahasiswa/edit/' . $mhs['id']) ?>" class="edit-btn">Edit</a>

                                <!-- Tombol Hapus (dengan konfirmasi) -->
                                <form action="<?= site_url('mahasiswa/delete/' . esc($mhs['id'], 'url')) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                                    <?= csrf_field() ?> <!-- Proteksi CSRF -->
                                    <input type="hidden" name="_method" value="DELETE"> <!-- Method Spoofing untuk DELETE -->
                                    <button type="submit" class="delete-btn">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

             <?php if ($pager): // Pastikan pager ada sebelum mencoba merendernya ?>
            <div class="pagination">
                <!--
                    Anda bisa menggunakan:
                    $pager->links() : untuk link paginasi default (misal: First Previous 1 2 3 Next Last)
                    $pager->simpleLinks() : untuk link paginasi sederhana (misal: Older Newer)
                    $pager->links('nama_grup_pager') : jika Anda menggunakan nama grup spesifik
                -->
                <?= $pager->links('mahasiswa') ?>
                <?php /* Atau jika Anda tidak menggunakan grup spesifik saat paginate
                       atau hanya ada satu pager di halaman:
                       <?= $pager->links() ?>
                       <?= $pager->simpleLinks() ?>
                */?>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="no-data">Tidak ada data mahasiswa untuk ditampilkan.</p>
        <?php endif; ?>
    </div>
</body>
</html>