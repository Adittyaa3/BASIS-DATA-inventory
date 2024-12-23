<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    }
}
// for create database

// CREATE TABLE satuan (
//     id_satuan INT PRIMARY KEY AUTO_INCREMENT,
//     nama_satuan VARCHAR(45),
//     status TINYINT
// );
// ALTER TABLE satuan MODIFY status TINYINT(1) NOT NULL DEFAULT 1;

// CREATE TABLE vendor (
//     id_vendor INT PRIMARY KEY AUTO_INCREMENT,
//     nama_vendor VARCHAR(100),
//     badan_hukum CHAR(1),
//     status TINYINT(1) NOT NULL
// );
// ALTER TABLE vendor MODIFY status TINYINT(1) NOT NULL DEFAULT 1;

// CREATE TABLE role (
//     id_role INT PRIMARY KEY AUTO_INCREMENT,
//     nama_role VARCHAR(100)
// );

// CREATE TABLE user (
//     id_user INT PRIMARY KEY AUTO_INCREMENT,
//     username VARCHAR(45),
//     password VARCHAR(100),
//     id_role INT,
//     CONSTRAINT fk_user_role FOREIGN KEY (id_role) REFERENCES role(id_role) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE barang (
//     id_barang INT PRIMARY KEY AUTO_INCREMENT,
//     jenis CHAR(1),
//     nama VARCHAR(45),
//     status TINYINT,
//     id_satuan INT,
//     harga INT,
//     CONSTRAINT fk_barang_satuan FOREIGN KEY (id_satuan) REFERENCES satuan(id_satuan) ON DELETE CASCADE ON UPDATE CASCADE
// );

// ALTER TABLE barang MODIFY status TINYINT(1) NOT NULL DEFAULT 1;

// CREATE TABLE kartu_stok (
//     id_kartu_stok BIGINT PRIMARY KEY AUTO_INCREMENT,
//     jenis_transaksi CHAR(1),
//     masuk INT,
//     keluar INT,
//     stock INT,
//     created_at TIMESTAMP,
//     id_transaksi INT,
//     id_barang INT,
//     CONSTRAINT fk_kartu_stok_barang FOREIGN KEY (id_barang) REFERENCES barang(id_barang) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE pengadaan (
//     id_pengadaan BIGINT PRIMARY KEY AUTO_INCREMENT,
//     timestamp TIMESTAMP,
//     user_id_user INT,
//     vendor_id_vendor INT,
//     subtotal_nilai INT,
//     ppn INT,
//     total_nilai INT,
//     CONSTRAINT fk_pengadaan_user FOREIGN KEY (user_id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_pengadaan_vendor FOREIGN KEY (vendor_id_vendor) REFERENCES vendor(id_vendor) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE penerimaan (
//     id_penerimaan BIGINT PRIMARY KEY AUTO_INCREMENT,
//     created_at TIMESTAMP,
//     status CHAR(1),
//     id_user INT,
//     id_pengadaan BIGINT,
//     CONSTRAINT fk_penerimaan_user FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_penerimaan_pengadaan FOREIGN KEY (id_pengadaan) REFERENCES pengadaan(id_pengadaan) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE detail_pengadaan (
//     id_detail_pengadaan BIGINT PRIMARY KEY AUTO_INCREMENT,
//     harga_satuan INT,
//     jumlah INT,
//     sub_total INT,
//     id_pengadaan BIGINT,
//     id_barang INT,
//     CONSTRAINT fk_detail_pengadaan_pengadaan FOREIGN KEY (id_pengadaan) REFERENCES pengadaan(id_pengadaan) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_detail_pengadaan_barang FOREIGN KEY (id_barang) REFERENCES barang(id_barang) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE detail_penerimaan (
//     id_detail_penerimaan BIGINT PRIMARY KEY AUTO_INCREMENT,
//     id_penerimaan BIGINT,
//     barang_id_barang INT,
//     jumlah_terima INT,
//     harga_satuan_terima INT,
//     sub_total_terima INT,
//     CONSTRAINT fk_detail_penerimaan_penerimaan FOREIGN KEY (id_penerimaan) REFERENCES penerimaan(id_penerimaan) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_detail_penerimaan_barang FOREIGN KEY (barang_id_barang) REFERENCES barang(id_barang) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE penjualan (
//     id_penjualan INT PRIMARY KEY AUTO_INCREMENT,
//     created_at TIMESTAMP,
//     subtotal_nilai INT,
//     ppn INT,
//     total_nilai INT,
//     id_user INT,
//     id_margin_penjualan INT,
//     CONSTRAINT fk_penjualan_user FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_penjualan_margin_penjualan FOREIGN KEY (id_margin_penjualan) REFERENCES margin_penjualan(id_margin_penjualan) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE detail_penjualan (
//     id_detail_penjualan BIGINT PRIMARY KEY AUTO_INCREMENT,
//     harga_satuan INT,
//     jumlah INT,
//     subtotal INT,
//     penjualan_id_penjualan INT,
//     id_barang INT,
//     CONSTRAINT fk_detail_penjualan_penjualan FOREIGN KEY (penjualan_id_penjualan) REFERENCES penjualan(id_penjualan) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_detail_penjualan_barang FOREIGN KEY (id_barang) REFERENCES barang(id_barang) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE retur (
//     id_retur BIGINT PRIMARY KEY AUTO_INCREMENT,
//     created_at TIMESTAMP,
//     id_penerimaan BIGINT,
//     id_barang INT,
//     CONSTRAINT fk_retur_penerimaan FOREIGN KEY (id_penerimaan) REFERENCES penerimaan(id_penerimaan) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_retur_barang FOREIGN KEY (id_barang) REFERENCES barang(id_barang) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE detail_retur (
//     id_detail_retur INT PRIMARY KEY AUTO_INCREMENT,
//     jumlah INT,
//     alasan VARCHAR(200),
//     id_barang INT,
//     id_detail_penerimaan BIGINT,
//     CONSTRAINT fk_detail_retur_barang FOREIGN KEY (id_barang) REFERENCES barang(id_barang) ON DELETE CASCADE ON UPDATE CASCADE,
//     CONSTRAINT fk_detail_retur_detail_penerimaan FOREIGN KEY (id_detail_penerimaan) REFERENCES detail_penerimaan(id_detail_penerimaan) ON DELETE CASCADE ON UPDATE CASCADE
// );

// CREATE TABLE margin_penjualan (
//     id_margin_penjualan INT PRIMARY KEY AUTO_INCREMENT,
//     created_at TIMESTAMP,
//     persen DOUBLE,
//     status TINYINT,
//     id_user INT,
//     update_at TIMESTAMP,
//     CONSTRAINT fk_margin_penjualan_user FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
// );
// ALTER TABLE margin_penjualan CHANGE COLUMN update_at updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

// ALTER TABLE pengadaan
// ADD status CHAR(1);

// ALTER TABLE detail_retur
// DROP FOREIGN KEY fk_detail_retur_barang;


// ALTER TABLE detail_retur
// ADD CONSTRAINT fk_detail_retur_id_retur FOREIGN KEY (id_retur) REFERENCES retur(id_retur) ON DELETE CASCADE ON UPDATE CASCADE;

// ALTER TABLE detail_retur
// ADD id_retur BIGINT;

// ALTER TABLE detail_retur
// ADD CONSTRAINT fk_detail_retur_id_retur FOREIGN KEY (id_retur) REFERENCES retur(id_retur) ON DELETE CASCADE ON UPDATE CASCADE;

// ALTER TABLE detail_retur
// DROP COLUMN id_barang;

// -- ini adalah dml
// -- dml role
// INSERT INTO role (nama_role)
// VALUES
// ('admin'),
// ('affiliator'),
// ('Customer Service');

// SELECT username as id_rolenamaa
// FROM user;


// UPDATE role
// SET nama_role = 'Support'
// WHERE nama_role = 'Customer Service';

// SELECT id_role,nama_role
// from role
// WHERE id_role ='1';
// -- dml satuan
// INSERT INTO satuan (nama_satuan, status)
// VALUES
// ('Kilogram', 1),
// ('Liter', 1),
// ('Piece', 1),
// ('Box', 0);

// UPDATE satuan
// set status ='1'
// where status ='0'

// -- dml user
// INSERT INTO user (username, password, id_role)
// VALUES
// ('adit', '12345', 1), -- Sesuaikan password dengan hash yang benar
// ('artha', '12345', 2),
// ('wedha', '12345', 3);

// UPDATE `user`
// set username = 'george'
// WHERE username ='wedha2';

// -- dml vendor
// INSERT INTO vendor (nama_vendor, badan_hukum, status)
// VALUES
// ('jatim', 'Y', '1'),
// ('surya', 'N', '0'),
// ('sinar mas', 'Y', '0'),
// ('Dali', 'N', '1');

// UPDATE vendor
// set status ='0'
// where nama_vendor ='Dali';

// -- dml barang
// INSERT INTO barang (jenis, nama, status, id_satuan, harga)
// VALUES
// ('A', 'sampo', 1, 1, 5000),
// ('B', 'sabun', 1, 2, 1500),
// ('C', 'minyak goreng', 1, 3, 15000),
// ('E', 'sikat', 1, 4, 20000);

// UPDATE barang
// SET nama = 'sikat gigi'
// WHERE nama = 'sikat'


// UPDATE vendor
// SET status = '1'
// WHERE status = '0';


// DESCRIBE retur;
// ALTER TABLE retur ADD COLUMN id_user INT AFTER id_barang;
// ALTER TABLE retur
// ADD CONSTRAINT fk_retur_user FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE;
