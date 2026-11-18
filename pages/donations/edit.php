<?php
// Mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');
include ROOTPATH . '/includes/header.php';
include ROOTPATH . '/config/config.php';

$id = $_GET['id_donasi'];
$query = "SELECT * FROM tabel_donasi WHERE id_donasi = '$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

?>
<center style="margin-top: 50px;">
    <h1>Edit Data Donasi</h1>
    <form action="/indomaret_RPL4/process/donations_process.php" method="post">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id_donasi" value="<?php echo $row['id_donasi']; ?>">
        <div class="input-group">
            <input type="text" name="nama_donasi" value="<?php echo $row['nama_donasi']; ?>" id="nama_donasi"
                class="custom-input" placeholder="Masukkan nama donasi..." required>
            <input type="number" name="harga_donasi" value="<?php echo $row['harga_donasi']; ?>" id="harga_donasi"
                class="custom-input" placeholder="Masukkan harga donasi..." required>
        </div>
        <button type="submit" class="btn btn-primary">Edit Donasi</button>
    </form>
</center>

<?php
include ROOTPATH . '/includes/footer.php';
?>