<?php
// Mendefinisikan ROOTPATH
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');

include ROOTPATH . '/includes/header.php';
include ROOTPATH . '/config/config.php';
?>

<center>
    <a href="/indomaret_RPL4/pages/transactions/add.php" class="btn btn-primary"
        style="margin-bottom: 20px; margin-top: 20px;">
        Tambah Transaksi
    </a>
</center>

<div class="table-container transaction-container">

    <table class="styled-table">

        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>No Order</th>
                <th>Total</th>
                <th>QRIS</th>
                <th>Tunai</th>
                <th>Kembalian</th>
                <th>ID Donasi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            <?php

            $query = "SELECT * FROM table_transaksi ORDER BY tanggal_transaksi ASC";
            $result = mysqli_query($connection, $query);

            $no = 1;

            while ($row = mysqli_fetch_assoc($result)) {

            ?>

            <tr>

                <td><?php echo $no++; ?></td>

                <td>
                    <?php echo htmlspecialchars($row['kode_transaksi']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['tanggal_transaksi']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['no_order']); ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['total'], 0, ',', '.'); ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['QRIS'], 0, ',', '.'); ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['tunai'], 0, ',', '.'); ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['kembalian'], 0, ',', '.'); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['id_donasi']); ?>
                </td>

                <td>
                    <a href="transactions_details.php?kode_transaksi=<?php echo urlencode($row['kode_transaksi']); ?>"
                        class="btn btn-primary">
                        Detail
                    </a>
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