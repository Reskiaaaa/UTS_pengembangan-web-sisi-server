<?php

class Transaction {

    private $conn;

    public function __construct($database) {

        $this->conn = $database;
    }

    
    public function transaksiKeluar(
        $produkId,
        $jumlah
    ) {

        
        $cek = $this->conn->query(
            "SELECT * FROM produk
             WHERE id = '$produkId'"
        );

        $data = $cek->fetch_assoc();

        if(!$data) {

            echo "Produk tidak ditemukan <br>";
            return;
        }

        $stokSekarang = $data['stok'];

        
        if($jumlah > $stokSekarang) {

            echo "Stok tidak mencukupi <br>";
            return;
        }

        $stokBaru = $stokSekarang - $jumlah;

        
        $update = "UPDATE produk
                   SET stok = '$stokBaru'
                   WHERE id = '$produkId'";

        $this->conn->query($update);

        
        $insert = "INSERT INTO transaksi
                   (produk_id, jumlah, keterangan)
                   VALUES
                   ('$produkId', '$jumlah', 'Barang keluar')";

        $this->conn->query($insert);

        echo "Transaksi berhasil <br>";

        
        if($stokBaru < 5) {

            echo "<b>PERINGATAN : STOK MENIPIS</b><br>";
        }
    }
}