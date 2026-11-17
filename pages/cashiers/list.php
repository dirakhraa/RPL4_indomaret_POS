<?php
// Mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');
include ROOTPATH . '/includes/header.php';
?>
<center><a href="/indomaret_RPL4/pages/cashiers/add.php" class="btn btn-primary"
        style="margin-bottom: 20px; margin-top: 20px;">Tambah
        Kasir</a></center>
<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kasir</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../config/config.php';
            $query = "SELECT * FROM tabel_kasir";
            $result = mysqli_query($connection, $query);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_kasir']); ?></td>
                <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                <td>
                    <a href='edit.php?id_kasir=<?php echo $row['id_kasir']; ?>' class='btn btn-warning'>Edit</a>
                    <a href='/indomaret_RPL4/process/cashiers_process.php?action=delete&id_kasir=<?php echo $row['id_kasir']; ?>'
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