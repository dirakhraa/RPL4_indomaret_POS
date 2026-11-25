<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');

include ROOTPATH . '/config/config.php';
include ROOTPATH . '/includes/header.php';

// Menghitung jumlah data
$query_kasir = mysqli_query($connection, "SELECT COUNT(*) AS jumlah FROM tabel_kasir");
$query_produk = mysqli_query($connection, "SELECT COUNT(*) AS jumlah FROM tabel_produk");
$query_donasi = mysqli_query($connection, "SELECT COUNT(*) AS jumlah FROM tabel_donasi");
$query_transaksi = mysqli_query($connection, "SELECT COUNT(*) AS jumlah FROM table_transaksi");

// Mengambil hasil perhitungan
$total_kasir = mysqli_fetch_assoc($query_kasir)['jumlah'];
$total_produk = mysqli_fetch_assoc($query_produk)['jumlah'];
$total_donasi = mysqli_fetch_assoc($query_donasi)['jumlah'];
$total_transaksi = mysqli_fetch_assoc($query_transaksi)['jumlah'];

// Menghitung total pendapatan
$query_pendapatan = mysqli_query($connection, "
    SELECT SUM(total) AS pendapatan
    FROM table_transaksi
");

$data_pendapatan = mysqli_fetch_assoc($query_pendapatan);
$total_pendapatan = $data_pendapatan['pendapatan'] ?? 0;

// Mengambil 5 transaksi terbaru
$query_terbaru = mysqli_query($connection, "
    SELECT kode_transaksi, tanggal_transaksi, no_order, total
    FROM table_transaksi
    ORDER BY tanggal_transaksi DESC
");
?>

<div class="dashboard-container">

    <h1>Dashboard</h1>
    <p class="dashboard-subtitle">Ringkasan Data Indomaret</p>

    <!-- Kartu Ringkasan -->
    <div class="dashboard-cards">

        <div class="dashboard-card">
            <div class="card-icon blue">
                <i class="fa-solid fa-users"></i>
            </div>
            <h3>Total Kasir</h3>
            <p><?= $total_kasir; ?></p>
            <span>Kasir Terdaftar</span>
        </div>

        <div class="dashboard-card">
            <div class="card-icon green">
                <i class="fa-solid fa-box"></i>
            </div>
            <h3>Total Produk</h3>
            <p><?= $total_produk; ?></p>
            <span>Produk Tersedia</span>
        </div>

        <div class="dashboard-card">
            <div class="card-icon orange">
                <i class="fa-solid fa-hand-holding-heart"></i>
            </div>
            <h3>Total Donasi</h3>
            <p><?= $total_donasi; ?></p>
            <span>Program Donasi</span>
        </div>

        <div class="dashboard-card">
            <div class="card-icon purple">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <h3>Total Transaksi</h3>
            <p><?= $total_transaksi; ?></p>
            <span>Transaksi Tercatat</span>
        </div>

    </div>

    <!-- Total Pendapatan -->
    <div class="income-card">
        <div class="income-icon">
            <i class="fa-solid fa-wallet"></i>
        </div>

        <div>
            <h3>Total Pendapatan</h3>
            <p>Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></p>
        </div>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="recent-transactions">

        <div class="recent-heading">
            <div>
                <h2>Transaksi Terbaru</h2>
                <p>Menampilkan semua transaksi terakhir</p>
            </div>

            <a href="/indomaret_RPL4/pages/transactions/list.php" class="view-all-btn">
                Lihat Semua
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="recent-table-wrapper">
            <table class="recent-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>No Order</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($query_terbaru && mysqli_num_rows($query_terbaru) > 0) { ?>

                    <?php $no = 1; ?>

                    <?php while ($row = mysqli_fetch_assoc($query_terbaru)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>

                        <td class="transaction-code">
                            <?= htmlspecialchars($row['kode_transaksi']); ?>
                        </td>

                        <td>
                            <?= date('d-m-Y H:i', strtotime($row['tanggal_transaksi'])); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['no_order']); ?>
                        </td>

                        <td class="transaction-price">
                            Rp <?= number_format($row['total'], 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php } else { ?>

                    <tr>
                        <td colspan="5" class="empty-transaction">
                            Belum ada transaksi.
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<?php include ROOTPATH . '/includes/footer.php'; ?>