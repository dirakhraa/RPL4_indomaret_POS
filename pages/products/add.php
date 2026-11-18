<?php
// mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4/');

include ROOTPATH . '/includes/header.php';
?>

<center style="margin-top: 50px;">
    <h1>Tambah Produk</h1>
    <form action="../../process/products_process.php" method="post">
        <input type="hidden" name="action" value="add">
        <div class="input-group">
            <input type="text" name="nama_produk" id="nama_produk" class="custom-input"
                placeholder="Masukkan nama produk..." required>

            <input type="text" name="harga" id="harga" class="custom-input" placeholder="Masukkan harga produk..."
                required>

            <input type="text" name="diskon" id="diskon" class="custom-input" placeholder="Masukkan diskon produk..."
                required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</center>

<?php
	include ROOTPATH . '/includes/footer.php';
?>