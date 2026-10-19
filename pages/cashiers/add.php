<?php
// mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4/');

include ROOTPATH . '/includes/header.php';
?>

<center style="margin-top: 50px;">
    <h1>Tambah Data Kasir</h1>
    <form action="../../process/cashiers_process.php" method="post">
        <div class="input-group">
            <input type="text" name="nama_kasir" id="username" class="custom-input" placeholder="Masukkan nama Kasir..."
                required>

            <input type="text" name="no_telp" id="no_telp" class="custom-input"
                placeholder="Masukkan nomor telepon Kasir..." required>

            <input type="text" name="alamat" id="alamat" class="custom-input" placeholder="Masukkan alamat Kasir..."
                required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Kasir</button>
    </form>
</center>