<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}
// CREATE FUNCTION calculate_total_masuk(id_barang INT)
// RETURNS INT
// DETERMINISTIC
// BEGIN
//     DECLARE total_masuk INT;
//     SELECT IFNULL(SUM(masuk), 0) INTO total_masuk
//     FROM kartu_stok
//     WHERE id_barang = id_barang;
//     RETURN total_masuk;
// END;

// CREATE FUNCTION calculate_total_keluar(id_barang INT)
// RETURNS INT
// DETERMINISTIC
// BEGIN
//     DECLARE total_keluar INT;
//     SELECT IFNULL(SUM(keluar), 0) INTO total_keluar
//     FROM kartu_stok
//     WHERE id_barang = id_barang;
//     RETURN total_keluar;
// END;
// DELIMITER ;


// DELIMITER $$
// CREATE FUNCTION get_margin_persen(p_id_margin_penjualan INT)
// RETURNS DOUBLE
// DETERMINISTIC
// BEGIN
//     DECLARE persen_margin DOUBLE;
//     SELECT persen INTO persen_margin
//     FROM margin_penjualan
//     WHERE id_margin_penjualan = p_id_margin_penjualan;
//     RETURN persen_margin;
// END$$


// DELIMITER $$
// CREATE OR REPLACE FUNCTION get_total_penjualan(p_id_penjualan INT)
// RETURNS DECIMAL(10, 2)
// DETERMINISTIC
// BEGIN
//     DECLARE total_penjualan DECIMAL(10, 2);

//     SELECT SUM(subtotal) INTO total_penjualan
//     FROM detail_penjualan
//     WHERE penjualan_id_penjualan = p_id_penjualan;

//     RETURN total_penjualan;
// END$$
// DELIMITER ;

// SELECT (get_total_penjualan(1));















// -- Path: function.sql

// DELIMITER $$

// CREATE FUNCTION hitung_margin(penjualan_id INT)
// RETURNS DECIMAL(10,2)
// DETERMINISTIC
// BEGIN
//     DECLARE total_harga_jual DECIMAL(10,2) DEFAULT 0;
//     DECLARE total_hpp DECIMAL(10,2) DEFAULT 0;
//     DECLARE margin DECIMAL(10,2) DEFAULT 0;

//     -- Menghitung total harga jual dan total harga pokok penjualan (HPP)
//     SELECT SUM(dp.harga_satuan * dp.jumlah) INTO total_harga_jual
//     FROM detail_penjualan dp
//     WHERE dp.penjualan_id_penjualan = penjualan_id;

//     SELECT SUM(b.harga * dp.jumlah) INTO total_hpp
//     FROM detail_penjualan dp
//     JOIN barang b ON dp.id_barang = b.id_barang
//     WHERE dp.penjualan_id_penjualan = penjualan_id;

//     -- Menghitung margin (jika harga jual tidak 0)
//     IF total_harga_jual > 0 THEN
//         SET margin = ((total_harga_jual - total_hpp) / total_harga_jual) * 100;
//     ELSE
//         SET margin = 0;
//     END IF;

//     RETURN margin;
// END $$
