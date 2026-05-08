<?php

require_once "config/Database.php";

require_once "classes/Product.php";
require_once "classes/Transaction.php";
require_once "classes/Dashboard.php";


$db = new Database();
$conn = $db->connect();
$product = new Product($conn);
$transaction = new Transaction($conn);
$dashboard = new Dashboard($conn);



if(isset($_POST['tambah'])) {

    $nama  = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $stok  = $_POST['stok'];
    $harga = $_POST['harga'];
    $product->tambahProduk(
        $nama,
        $jenis,
        $stok,
        $harga
    );
}


if(isset($_POST['transaksi'])) {

    $produkId = $_POST['produk_id'];

    $jumlah = $_POST['jumlah'];

    $transaction->transaksiKeluar(
        $produkId,
        $jumlah
    );
}

?>

<h2>INPUT PRODUK</h2>

<form method="POST">

    Nama Produk :
    <input type="text" name="nama">

    <br><br>

    Jenis Produk :

    <select name="jenis">

        <option value="Laptop">
            Laptop
        </option>

        <option value="Smartphone">
            Smartphone
        </option>

    </select>

    <br><br>

    Stok :
    <input type="number" name="stok">

    <br><br>

    Harga :
    <input type="number" name="harga">

    <br><br>

    <button type="submit" name="tambah">
        Tambah Produk
    </button>

</form>

<hr>

<h2>TRANSAKSI</h2>

<form method="POST">

    ID Produk :
    <input type="number" name="produk_id">

    <br><br>

    Jumlah Beli :
    <input type="number" name="jumlah">

    <br><br>

    <button type="submit" name="transaksi">
        Proses Transaksi
    </button>

</form>

<hr>

<h2>DATA PRODUK</h2>

<?php

$product->tampilProduk();

?>

<hr>

<h2>REKAP TRANSAKSI</h2>

<?php

$dashboard->totalProduk();

echo "<br>";

$dashboard->totalTransaksi();

?>