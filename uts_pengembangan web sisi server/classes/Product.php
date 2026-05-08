<?php

class Product {

    private $conn;

    public function __construct($database) {
        $this->conn = $database;
    }

    public function tambahProduk(
        $nama,
        $jenis,
        $stok,
        $harga
    ) {

        
        if($stok < 0) {
            echo "Stok tidak boleh negatif <br>";
            return;
        }

        
        if(
            $jenis != "Laptop" &&
            $jenis != "Smartphone"
        ) {

            echo "Jenis produk tidak valid <br>";
            return;
        }

        $query = "INSERT INTO produk
                  (nama, jenis, stok, harga)
                  VALUES
                  ('$nama', '$jenis', '$stok', '$harga')";

        if($this->conn->query($query)) {
            echo "Produk berhasil ditambahkan <br><br>";
        } else {
            echo "Gagal tambah produk";
        }
    }

    
    public function tampilProduk() {

        $query = "SELECT * FROM produk";
        $result = $this->conn->query($query);

        while($row = $result->fetch_assoc()) {

            echo "ID : " . $row['id'] . "<br>";
            echo "Nama : " . $row['nama'] . "<br>";
            echo "Jenis : " . $row['jenis'] . "<br>";
            echo "Stok : " . $row['stok'] . "<br>";
            echo "Harga : " . $row['harga'] . "<br>";

            
            if($row['stok'] < 5) {
                echo "<b>PERINGATAN : STOK MENIPIS</b><br>";
            }
            echo "<hr>";
        }
    }
}