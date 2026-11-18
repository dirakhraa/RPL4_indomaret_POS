<?php
// mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4/');

include ROOTPATH . '/includes/header.php';
?>

<center style="margin-top: 50px;">
    <h1>Tambah Data Donasi</h1>
    <form action="../../process/donations_process.php" method="post">
        <input type="hidden" name="action" value="add">
        <div class="input-group">
            <input type="text" name="nama_donasi" id="nama_donasi" class="custom-input"
                placeholder="Masukkan nama donasi..." required>

            <input type="number" name="harga_donasi" id="harga_donasi" class="custom-input"
                placeholder="Masukkan harga donasi..." required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah donasi</button>
    </form>
</center>

<?php
	include ROOTPATH . '/includes/footer.php';
?>