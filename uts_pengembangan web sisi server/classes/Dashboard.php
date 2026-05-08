<?php

class Dashboard {

    private $conn;

    public function __construct($database) {
        $this->conn = $database;
    }

  
    public function totalProduk() {

        $query = "SELECT COUNT(*) as total
                  FROM produk";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        echo "Total Produk : "
             . $data['total'];
    }

    
    public function totalTransaksi() {
        $query = "SELECT COUNT(*) as total
                  FROM transaksi";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        echo "Total Transaksi : "
             . $data['total'];
    }
}