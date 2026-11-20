<?php

include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "add") {

    $kode_transaksi    = trim($_POST["kode_transaksi"]);
    $tanggal_transaksi = str_replace("T", " ", $_POST["tanggal_transaksi"]);
    $no_order          = trim($_POST["no_order"]);
    $id_kasir          = (int) $_POST["id_kasir"];
    $QRIS              = (float) $_POST["QRIS"];
    $tunai             = (float) $_POST["tunai"];
    $id_donasi         = (int) $_POST["id_donasi"];

    $daftar_id_produk = $_POST["id_produk"];
    $daftar_kuantitas = $_POST["kuantitas"];

    if (
        empty($daftar_id_produk) ||
        count($daftar_id_produk) != count($daftar_kuantitas)
    ) {
        die("Data produk tidak valid.");
    }

    mysqli_begin_transaction($connection);

    try {

        $total = 0;
        $detail_produk = [];

        // Mengambil harga dan diskon dari database
        foreach ($daftar_id_produk as $index => $id_produk) {

            $id_produk = (int) $id_produk;
            $kuantitas = (int) $daftar_kuantitas[$index];

            if ($id_produk <= 0 || $kuantitas <= 0) {
                throw new Exception("Produk atau kuantitas tidak valid.");
            }

            $query = mysqli_query(
                $connection,
                "SELECT harga, diskon
                 FROM tabel_produk
                 WHERE id_produk = $id_produk"
            );

            $produk = mysqli_fetch_assoc($query);

            if (!$produk) {
                throw new Exception("Produk tidak ditemukan.");
            }

            $harga = (int) $produk["harga"];
            $diskon = (int) $produk["diskon"];

            // Harga jual setelah diskon dikali kuantitas
            $harga_jual = ($harga - $diskon) * $kuantitas;

            if ($harga_jual < 0) {
                throw new Exception("Harga jual tidak valid.");
            }

            $total += $harga_jual;

            $detail_produk[] = [
                "id_produk" => $id_produk,
                "harga" => $harga,
                "kuantitas" => $kuantitas,
                "diskon" => $diskon,
                "harga_jual" => $harga_jual
            ];
        }

        // Menghitung kembalian
        $kembalian = max(0, ($QRIS + $tunai) - $total);

        // Menyimpan transaksi utama
        $stmt = mysqli_prepare(
            $connection,
            "INSERT INTO table_transaksi
            (kode_transaksi, tanggal_transaksi, no_order,
             total, QRIS, tunai, kembalian, id_donasi)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sssddddi",
            $kode_transaksi,
            $tanggal_transaksi,
            $no_order,
            $total,
            $QRIS,
            $tunai,
            $kembalian,
            $id_donasi
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception(mysqli_stmt_error($stmt));
        }

        // Menyimpan setiap produk ke tabel detail transaksi
        $stmt_detail = mysqli_prepare(
            $connection,
            "INSERT INTO tabel_detail_transaksi
            (kode_transaksi, id_kasir, id_produk, harga,
             kuantitas, diskon, harga_jual)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        foreach ($detail_produk as $detail) {

            $id_produk = $detail["id_produk"];
            $harga = $detail["harga"];
            $kuantitas = $detail["kuantitas"];
            $diskon = $detail["diskon"];
            $harga_jual = $detail["harga_jual"];

            mysqli_stmt_bind_param(
                $stmt_detail,
                "siiiiii",
                $kode_transaksi,
                $id_kasir,
                $id_produk,
                $harga,
                $kuantitas,
                $diskon,
                $harga_jual
            );

            if (!mysqli_stmt_execute($stmt_detail)) {
                throw new Exception(mysqli_stmt_error($stmt_detail));
            }
        }

        mysqli_commit($connection);

        echo "
        <script>
            alert('Transaksi berhasil ditambahkan!');
            window.location.href='../pages/transactions/list.php';
        </script>";

    } catch (Exception $e) {

        mysqli_rollback($connection);

        echo "
        <script>
            alert('Gagal menambahkan transaksi: " .
            addslashes($e->getMessage()) . "');
            window.history.back();
        </script>";
    }
}
?>