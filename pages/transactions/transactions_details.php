<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');

include ROOTPATH . '/includes/header.php';
include ROOTPATH . '/config/config.php';

// Mengambil kode transaksi dari URL
$kode_transaksi = $_GET['kode_transaksi'] ?? '';

if ($kode_transaksi == '') {
    die("Kode transaksi tidak ditemukan!");
}

// Mengambil detail transaksi
$stmt = mysqli_prepare($connection,
    "SELECT * FROM tabel_detail_transaksi
     WHERE kode_transaksi = ?"
);

mysqli_stmt_bind_param($stmt, "s", $kode_transaksi);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<center style="margin-top: 50px;">
    <h1>Detail Transaksi</h1>

    <h3>
        Kode Transaksi:
        <?php echo htmlspecialchars($kode_transaksi); ?>
    </h3>
</center>

<div class="table-container transaction-container">

    <table class="styled-table">

        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>ID Kasir</th>
                <th>ID Produk</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Diskon</th>
                <th>Harga Jual</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $no = 1;

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?php echo $no++; ?></td>

                <td>
                    <?php echo htmlspecialchars($row['kode_transaksi']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['id_kasir']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['id_produk']); ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['kuantitas']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['diskon']); ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?>
                </td>
            </tr>

            <?php
                }

            } else {
            ?>

            <tr>
                <td colspan="8">
                    Detail transaksi belum tersedia.
                </td>
            </tr>

            <?php
            }
            ?>

        </tbody>

    </table>

</div>

<center>
    <a href="list.php" class="btn btn-primary">
        Kembali
    </a>
</center>

<?php
include ROOTPATH . '/includes/footer.php';
?>