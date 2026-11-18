<?php
// Mendefinisikan ROOTPATH sebagai path ke direktori root proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');
include ROOTPATH . '/includes/header.php';
?>
<center><a href="/indomaret_RPL4/pages/donations/add.php" class="btn btn-primary"
        style="margin-bottom: 20px; margin-top: 20px;">Tambah
        Donasi</a></center>
<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Donasi</th>
                <th>Harga Donasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../config/config.php';
            $query = "SELECT * FROM tabel_donasi";
            $result = mysqli_query($connection, $query);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_donasi']); ?></td>
                <td><?php echo htmlspecialchars($row['harga_donasi']); ?></td>
                <td>
                    <a href='edit.php?id_donasi=<?php echo $row['id_donasi']; ?>' class='btn btn-warning'>Edit</a>
                    <a href='/indomaret_RPL4/process/donations_process.php?action=delete&id_donasi=<?php echo $row['id_donasi']; ?>'
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