<?php
// Mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');
include ROOTPATH . '/includes/header.php';
include ROOTPATH . '/config/config.php';

$id = $_GET['id_produk'];
$query = "SELECT * FROM tabel_produk WHERE id_produk = '$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

?>
<center style="margin-top: 50px;">
    <h1>Edit Data Produk</h1>
    <form action="/indomaret_RPL4/process/products_process.php" method="post">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
        <div class="input-group">
            <input type="text" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" id="nama_produk"
                class="custom-input" placeholder="Masukkan nama produk..." required>
            <input type="number" name="harga" value="<?php echo $row['harga']; ?>" id="harga" class="custom-input"
                placeholder="Masukkan harga produk..." required>
            <input type="number" name="diskon" value="<?php echo $row['diskon']; ?>" id="alamat" class="custom-input"
                placeholder="Masukkan diskon produk..." required>
        </div>
        <button type="submit" class="btn btn-primary">Edit produk</button>
    </form>
</center>

<?php
include ROOTPATH . '/includes/footer.php';
?>