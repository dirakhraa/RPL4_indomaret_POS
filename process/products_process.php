<?php

include '../config/config.php';

$nama_produk = $_POST["nama_produk"];
$harga    = $_POST["harga"];
$diskon     = $_POST["diskon"];

if($_POST["action"] == "add"){
    // menambahkan data produk ke table_produk di database indomaret_RPL4
    $hasil = mysqli_query($connection, "INSERT INTO tabel_produk VALUES (NULL, '$nama_produk', '$harga', '$diskon')");

    if(!$hasil){
        echo "
        <script>
        alert('Gagal menambahkan produk: " . mysqli_error($connection) . "');
        </script>";
    } else {
        echo "<script>
        alert('Produk berhasil ditambahkan.');
        window.location.href='../pages/products/list.php';
        </script>";
    }
}else if($_POST["action"] == "edit"){
    $id_produk = $_POST["id_produk"];
    // mengupdate data produk di table_produk di database indomaret_RPL4
    $hasil = mysqli_query($connection, "UPDATE tabel_produk SET nama_produk='$nama_produk', harga='$harga', diskon='$diskon' WHERE id_produk='$id_produk'");

    if(!$hasil){
        echo "
        <script>
        alert('Gagal mengupdate data produk: " . mysqli_error($connection) . "');
        </script>";
    } else {
        echo "<script>
        alert('Data produk berhasil diupdate.');
        window.location.href='../pages/products/list.php';
        </script>";
    }

}else if($_GET["action"] == "delete"){
    $id_produk = $_GET["id_produk"];
    // menghapus data produk di table_produk di database indomaret_RPL4
    $hasil = mysqli_query($connection, "DELETE FROM tabel_produk WHERE id_produk='$id_produk'");

    if(!$hasil){
        echo "
        <script>
        alert('Gagal menghapus data produk: " . mysqli_error($connection) . "');
        </script>";
    } else {
        echo "<script>
        alert('Data produk berhasil dihapus.');
        window.location.href='../pages/products/list.php';
        </script>";
    }
}