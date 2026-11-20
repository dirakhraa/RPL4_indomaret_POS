<?php

define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');

include ROOTPATH . '/config/config.php';

// Mengambil kode transaksi dari URL
$kode_transaksi = $_GET['kode_transaksi'] ?? '';

if (empty($kode_transaksi)) {
    die("Kode transaksi tidak ditemukan!");
}

// Mengambil data transaksi utama
$stmt = mysqli_prepare(
    $connection,
    "SELECT * FROM table_transaksi WHERE kode_transaksi = ?"
);

mysqli_stmt_bind_param($stmt, "s", $kode_transaksi);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$transaksi = mysqli_fetch_assoc($result);

if (!$transaksi) {
    die("Data transaksi tidak ditemukan!");
}

// Mengambil detail produk dalam transaksi
$stmt_detail = mysqli_prepare(
    $connection,
    "SELECT d.*, p.nama_produk
     FROM tabel_detail_transaksi d
     LEFT JOIN tabel_produk p
     ON d.id_produk = p.id_produk
     WHERE d.kode_transaksi = ?"
);

// Mengambil data kasir berdasarkan kode transaksi
$stmt_kasir = mysqli_prepare($connection, "
    SELECT DISTINCT k.id_kasir, k.nama_kasir
    FROM tabel_detail_transaksi d
    JOIN tabel_kasir k ON d.id_kasir = k.id_kasir
    WHERE d.kode_transaksi = ?
    LIMIT 1
");

mysqli_stmt_bind_param($stmt_kasir, "s", $kode_transaksi);
mysqli_stmt_execute($stmt_kasir);

$result_kasir = mysqli_stmt_get_result($stmt_kasir);
$kasir = mysqli_fetch_assoc($result_kasir);

mysqli_stmt_bind_param($stmt_detail, "s", $kode_transaksi);
mysqli_stmt_execute($stmt_detail);

$result_detail = mysqli_stmt_get_result($stmt_detail);

include ROOTPATH . '/includes/header.php';

?>

<div class="nota-container">

    <div class="nota-header">
        <h1>INDOMARET</h1>
        <p>MINIMARKET INDOMARET</p>
        <p>Terima kasih telah berbelanja!</p>
        <hr>
        <h2>NOTA TRANSAKSI</h2>
    </div>

    <!-- Informasi transaksi -->
    <div class="nota-info">

        <div>
            <p><strong>Kode Transaksi:</strong></p>
            <p><?php echo htmlspecialchars($transaksi['kode_transaksi']); ?></p>
        </div>

        <div>
            <p><strong>Tanggal:</strong></p>
            <p><?php echo htmlspecialchars($transaksi['tanggal_transaksi']); ?></p>
        </div>

        <div>
            <p><strong>No Order:</strong></p>
            <p><?php echo htmlspecialchars($transaksi['no_order']); ?></p>
        </div>

        <div class="info-item">
            <strong>ID Kasir:</strong>
            <p><?= htmlspecialchars($kasir['id_kasir'] ?? '-'); ?></p>
        </div>

        <div class="info-item">
            <strong>Nama Kasir:</strong>
            <p><?= htmlspecialchars($kasir['nama_kasir'] ?? '-'); ?></p>
        </div>

    </div>

    <hr>

    <!-- Rincian produk -->
    <h3>Rincian Pembelian</h3>

    <div class="nota-table-container">

        <table class="nota-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>Harga Jual</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $no = 1;

                if (mysqli_num_rows($result_detail) > 0):

                    while ($detail = mysqli_fetch_assoc($result_detail)):
                ?>

                <tr>

                    <td><?php echo $no++; ?></td>

                    <td>
                        <?php
                        echo htmlspecialchars(
                            $detail['nama_produk'] ?? 'Produk tidak ditemukan'
                        );
                        ?>
                    </td>

                    <td>
                        Rp <?php echo number_format($detail['harga'], 0, ',', '.'); ?>
                    </td>

                    <td>
                        <?php echo $detail['kuantitas']; ?>
                    </td>

                    <td>
                        Rp <?php echo number_format($detail['diskon'], 0, ',', '.'); ?>
                    </td>

                    <td>
                        Rp <?php echo number_format($detail['harga_jual'], 0, ',', '.'); ?>
                    </td>

                </tr>

                <?php
                    endwhile;

                else:
                ?>

                <tr>
                    <td colspan="6">Tidak ada detail produk.</td>
                </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <hr>

    <!-- Pembayaran -->
    <div class="nota-pembayaran">

        <div>
            <span>Total Belanja</span>
            <strong>
                Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?>
            </strong>
        </div>

        <div>
            <span>Pembayaran QRIS</span>
            <strong>
                Rp <?php echo number_format($transaksi['QRIS'], 0, ',', '.'); ?>
            </strong>
        </div>

        <div>
            <span>Pembayaran Tunai</span>
            <strong>
                Rp <?php echo number_format($transaksi['tunai'], 0, ',', '.'); ?>
            </strong>
        </div>

        <div>
            <span>Kembalian</span>
            <strong>
                Rp <?php echo number_format($transaksi['kembalian'], 0, ',', '.'); ?>
            </strong>
        </div>

        <div>
            <span>ID Donasi</span>
            <strong>
                <?php echo htmlspecialchars($transaksi['id_donasi'] ?? '-'); ?>
            </strong>
        </div>

    </div>

    <div class="nota-footer">
        <p>================================</p>
        <h3>TERIMA KASIH</h3>
        <p>Selamat berbelanja kembali!</p>
        <p>Barang yang sudah dibeli tidak dapat ditukar.</p>
    </div>

    <div class="nota-buttons">
        <a href="list.php" class="btn-kembali">
            Kembali
        </a>
    </div>
</div>

<?php
include ROOTPATH . '/includes/footer.php';
?>