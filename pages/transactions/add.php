<?php
// Mendefinisikan ROOTPATH
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4/');

include ROOTPATH . '/includes/header.php';
?>

<center style="margin-top: 50px;">

    <h1>Tambah Transaksi</h1>

    <form action="../../process/transactions_process.php" method="post">

        <input type="hidden" name="action" value="add">

        <div class="input-group">

            <input type="text" name="kode_transaksi" class="custom-input" placeholder="Masukkan kode transaksi..."
                required>

            <input type="datetime-local" name="tanggal_transaksi" class="custom-input" required>

            <input type="text" name="no_order" class="custom-input" placeholder="Masukkan nomor order..." required>

            <input type="number" name="total" class="custom-input" placeholder="Masukkan total transaksi..." step="0.01"
                required>

            <input type="number" name="QRIS" class="custom-input" placeholder="Masukkan pembayaran QRIS..." step="0.01"
                required>

            <input type="number" name="tunai" class="custom-input" placeholder="Masukkan pembayaran tunai..." required>

            <input type="number" name="kembalian" class="custom-input" placeholder="Masukkan jumlah kembalian..."
                required>

            <input type="number" name="id_donasi" class="custom-input" placeholder="Masukkan ID donasi..." required>

        </div>

        <button type="submit" class="btn btn-primary">
            Tambah Transaksi
        </button>

    </form>

</center>

<?php
include ROOTPATH . '/includes/footer.php';
?>