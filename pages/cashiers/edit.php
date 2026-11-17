<?php
// Mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');
include ROOTPATH . '/includes/header.php';
include ROOTPATH . '/config/config.php';

$id = $_GET['id_kasir'];
$query = "SELECT * FROM tabel_kasir WHERE id_kasir = '$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

?>
<center style="margin-top: 50px;">
    <h1>Edit Data Kasir</h1>
    <form action="/indomaret_RPL4/process/cashiers_process.php" method="post">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id_kasir" value="<?php echo $row['id_kasir']; ?>">
        <div class="input-group">
            <input type="text" name="nama_kasir" value="<?php echo $row['nama_kasir']; ?>" id="username"
                class="custom-input" placeholder="Masukkan nama Kasir..." required>
            <input type="number" name="no_telp" value="<?php echo $row['no_telp']; ?>" id="no_telp" class="custom-input"
                placeholder="Masukkan nomor telepon Kasir..." required>
            <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>" id="alamat" class="custom-input"
                placeholder="Masukkan alamat Kasir..." required>
        </div>
        <button type="submit" class="btn btn-primary">Edit Kasir</button>
    </form>
</center>

<?php
include ROOTPATH . '/includes/footer.php';
?>