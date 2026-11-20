<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret_RPL4');

include ROOTPATH . '/config/config.php';
include ROOTPATH . '/includes/header.php';

// Mengambil daftar produk dari database
$query_produk = mysqli_query($connection, "SELECT * FROM tabel_produk");
?>

<div class="transaction-container">

    <form action="../../process/transactions_process.php" method="post" class="transaction-form">

        <h1>Tambah Transaksi</h1>

        <input type="hidden" name="action" value="add">

        <!-- INFORMASI TRANSAKSI -->
        <h3>Informasi Transaksi</h3>

        <div class="input-group">

            <div class="form-field">
                <label>Kode Transaksi</label>
                <input type="text" name="kode_transaksi" class="custom-input"
                    value="TIKL-<?= date('His') . rand(10, 99); ?>" readonly required>
            </div>

            <div class="form-field">
                <label>ID Kasir</label>
                <input type="number" name="id_kasir" class="custom-input" placeholder="Masukkan ID kasir" required>
            </div>

            <div class="form-field">
                <label>Tanggal Transaksi</label>
                <input type="datetime-local" name="tanggal_transaksi" class="custom-input" required>
            </div>

            <div class="form-field">
                <label>Nomor Order</label>
                <input type="text" name="no_order" class="custom-input" placeholder="Masukkan nomor order" required>
            </div>

        </div>

        <!-- PRODUK YANG DIBELI -->
        <h3>Produk yang Dibeli</h3>

        <div id="daftar-produk">

            <div class="baris-produk">

                <div class="form-field">
                    <label>Nama Produk</label>

                    <select name="id_produk[]" class="custom-input" onchange="hitungTotal()" required>

                        <option value="">Pilih Produk</option>

                        <?php
                        mysqli_data_seek($query_produk, 0);

                        while ($produk = mysqli_fetch_assoc($query_produk)) {
                        ?>

                        <option value="<?= $produk['id_produk']; ?>" data-harga="<?= $produk['harga']; ?>"
                            data-diskon="<?= $produk['diskon']; ?>">

                            <?= htmlspecialchars($produk['nama_produk']); ?>

                        </option>

                        <?php } ?>

                    </select>
                </div>

                <div class="form-field">
                    <label>Kuantitas</label>

                    <input type="number" name="kuantitas[]" class="custom-input" placeholder="Masukkan jumlah produk"
                        min="1" value="1" oninput="hitungTotal()" required>
                </div>

                <button type="button" class="btn-hapus-produk" onclick="hapusProduk(this)">
                    Hapus
                </button>

            </div>

        </div>

        <button type="button" class="btn-tambah-produk" onclick="tambahProduk()">
            + Tambah Produk
        </button>

        <!-- PEMBAYARAN -->
        <h3>Informasi Pembayaran</h3>

        <div class="form-field">
            <label for="total">Total Belanja (Rp)</label>

            <input type="number" id="total" name="total" class="custom-input" placeholder="Total belanja" readonly
                required>
        </div>

        <div class="form-field">
            <label for="QRIS">Pembayaran QRIS (Rp)</label>

            <input type="number" id="QRIS" name="QRIS" class="custom-input" placeholder="Masukkan pembayaran QRIS"
                min="0" step="0.01" value="0" oninput="hitungKembalian()" required>
        </div>

        <div class="form-field">
            <label for="tunai">Pembayaran Tunai (Rp)</label>

            <input type="number" id="tunai" name="tunai" class="custom-input" placeholder="Masukkan pembayaran tunai"
                min="0" value="0" oninput="hitungKembalian()" required>
        </div>

        <div class="form-field">
            <label for="kembalian">Kembalian (Rp)</label>

            <input type="number" id="kembalian" name="kembalian" class="custom-input" placeholder="Kembalian" value="0"
                readonly>
        </div>

        <div class="form-field">
            <label for="id_donasi">ID Donasi</label>

            <input type="number" id="id_donasi" name="id_donasi" class="custom-input" placeholder="Masukkan ID donasi"
                required>
        </div>

        <!-- TOMBOL SIMPAN -->
        <button type="submit" class="btn btn-primary btn-simpan">
            Tambah Transaksi
        </button>

    </form>

</div>

<script>
// MENAMBAHKAN PRODUK
function tambahProduk() {

    let daftar = document.getElementById("daftar-produk");

    let baris = daftar.querySelector(".baris-produk").cloneNode(true);

    baris.querySelector("select").value = "";
    baris.querySelector("input").value = 1;

    daftar.appendChild(baris);

    hitungTotal();
}


// MENGHAPUS PRODUK
function hapusProduk(tombol) {

    let daftar = document.getElementById("daftar-produk");

    if (daftar.querySelectorAll(".baris-produk").length > 1) {

        tombol.closest(".baris-produk").remove();

        hitungTotal();

    } else {

        alert("Minimal harus ada satu produk.");

    }
}


// MENGHITUNG TOTAL BELANJA
function hitungTotal() {

    let total = 0;

    document.querySelectorAll(".baris-produk").forEach(function(baris) {

        let pilihan = baris.querySelector("select");

        let jumlah = parseInt(baris.querySelector("input").value) || 0;

        if (pilihan.selectedIndex > 0) {

            let option = pilihan.options[pilihan.selectedIndex];

            let harga = parseInt(option.dataset.harga) || 0;

            let diskon = parseInt(option.dataset.diskon) || 0;

            total += (harga - diskon) * jumlah;

        }

    });

    document.getElementById("total").value = total;

    hitungKembalian();
}


// MENGHITUNG KEMBALIAN
function hitungKembalian() {

    let total = parseFloat(document.getElementById("total").value) || 0;

    let qris = parseFloat(document.getElementById("QRIS").value) || 0;

    let tunai = parseFloat(document.getElementById("tunai").value) || 0;

    let kembalian = (qris + tunai) - total;

    document.getElementById("kembalian").value =
        Math.max(0, kembalian);

}
</script>

<?php include ROOTPATH . '/includes/footer.php'; ?>