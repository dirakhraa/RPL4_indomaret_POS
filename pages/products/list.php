<?php
// Mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');
include ROOTPATH . '/includes/header.php';
?>
<center><a href="/indomaret_RPL4/pages/products/add.php" class="btn btn-primary"
        style="margin-bottom: 20px; margin-top: 20px;">Tambah
        Produk</a></center>
<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../config/config.php';
            $query = "SELECT * FROM tabel_produk";
            $result = mysqli_query($connection, $query);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                <td><?php echo htmlspecialchars($row['harga']); ?></td>
                <td><?php echo htmlspecialchars($row['diskon']); ?></td>
                <td>
                    <a href='edit.php?id_produk=<?php echo $row['id_produk']; ?>' class='btn btn-warning'>Edit</a>
                    <a href='/indomaret_RPL4/process/products_process.php?action=delete&id_produk=<?php echo $row['id_produk']; ?>'
                        class='btn btn-danger'
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include ROOTPATH . '/includes/footer.php';
?>