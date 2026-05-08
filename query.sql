
CREATE DATABASE IF NOT EXISTS inventaris_toko
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE inventaris_toko;


CREATE TABLE IF NOT EXISTS produk (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nama        VARCHAR(150)                    NOT NULL,
    jenis       ENUM('Laptop', 'Smartphone')    NOT NULL,
    stok        INT            DEFAULT 0        NOT NULL,
    harga       DECIMAL(15, 2) DEFAULT 0.00     NOT NULL,
    created_at  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    produk_id   INT          NOT NULL,
    jumlah      INT          NOT NULL,
    keterangan  VARCHAR(255) DEFAULT NULL,
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_transaksi_produk
        FOREIGN KEY (produk_id) REFERENCES produk(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


INSERT INTO produk (nama, jenis, stok, harga) VALUES
    ('Laptop ASUS VivoBook 15',  'Laptop',      10, 8500000),
    ('Laptop Lenovo IdeaPad 3',  'Laptop',       4, 7200000);