<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TriggerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}

// -- trigger untuk pengadaan
// DELIMITER //

// CREATE TRIGGER after_detail_penerimaan_update_pengadaan
// AFTER INSERT ON detail_penerimaan
// FOR EACH ROW
// BEGIN
//     DECLARE total_barang INT;
//     DECLARE total_diterima INT;

//     -- Hitung total barang dalam pengadaan
//     SELECT SUM(jumlah) INTO total_barang
//     FROM detail_pengadaan
//     WHERE id_pengadaan = (SELECT id_pengadaan FROM penerimaan WHERE id_penerimaan = NEW.id_penerimaan);

//     -- Hitung total barang yang telah diterima
//     SELECT SUM(jumlah_terima) INTO total_diterima
//     FROM detail_penerimaan
//     WHERE id_penerimaan IN (SELECT id_penerimaan FROM penerimaan WHERE id_pengadaan = (SELECT id_pengadaan FROM penerimaan WHERE id_penerimaan = NEW.id_penerimaan));

//     --  ini Jika semua barang telah diterima, lalu mengubah status pengadaan menjadi selesai
//     IF total_barang = total_diterima THEN
//         UPDATE pengadaan
//         SET status = 'S'
//         WHERE id_pengadaan = (SELECT id_pengadaan FROM penerimaan WHERE id_penerimaan = NEW.id_penerimaan);
//     END IF;
// END;
// //

// DELIMITER ;


// DELIMITER //
// CREATE TRIGGER after_detail_penerimaan_insert
// AFTER INSERT ON detail_penerimaan
// FOR EACH ROW
// BEGIN
//     DECLARE current_stock INT;

//     -- Ambil stok terakhir dari kartu_stok
//     SELECT stock INTO current_stock
//     FROM kartu_stok
//     WHERE id_barang = NEW.barang_id_barang
//     ORDER BY created_at DESC
//     LIMIT 1;

//     -- Jika tidak ada stok sebelumnya, anggap 0
//     IF current_stock IS NULL THEN
//         SET current_stock = 0;
//     END IF;

//     -- Tambahkan stok ke kartu_stok
//     INSERT INTO kartu_stok (id_barang, jenis_transaksi, masuk, keluar, stock, created_at, id_transaksi)
//     VALUES (NEW.barang_id_barang, 'M', NEW.jumlah_terima, 0, current_stock + NEW.jumlah_terima, NOW(), NEW.id_penerimaan);
// END;


// DELIMITER ;





// DROP TRIGGER IF EXISTS `update_kartu_stok_after_insert`;


// CREATE TRIGGER `update_kartu_stok_after_insert` AFTER INSERT ON `detail_penjualan`
// FOR EACH ROW
// BEGIN
//     DECLARE current_stock INT;

//     -- Cek apakah ada stok yang tersedia pada barang
//     SELECT `stock` INTO current_stock
//     FROM `kartu_stok`
//     WHERE `id_barang` = NEW.`id_barang`
//     ORDER BY `created_at` ASC
//     LIMIT 1;

//     IF current_stock IS NOT NULL THEN
//         -- Update kartu_stok dengan mengurangi stok
//         UPDATE `kartu_stok`
//         SET `stock` = `stock` - NEW.`jumlah`
//         WHERE `id_barang` = NEW.`id_barang`
//         ORDER BY `created_at` ASC
//         LIMIT 1;
//     ELSE
//         -- Berikan peringatan jika stok barang tidak ditemukan
//         SIGNAL SQLSTATE '45000'
//         SET MESSAGE_TEXT = 'Stok barang tidak tersedia di kartu stok';
//     END IF;
// END //

// -- 2
// CREATE TRIGGER `update_kartu_stok_after_insert` AFTER INSERT ON `detail_penjualan`
// FOR EACH ROW
// BEGIN
//     DECLARE current_stock INT;

//     -- Cek apakah ada stok yang tersedia pada barang
//     SELECT `stock` INTO current_stock
//     FROM `kartu_stok`
//     WHERE `id_barang` = NEW.`id_barang`
//     ORDER BY `created_at` ASC
//     LIMIT 1;

//     IF current_stock IS NOT NULL THEN
//         -- Update kartu_stok dengan mengurangi stok dan mencatat jumlah keluar
//         UPDATE `kartu_stok`
//         SET `stock` = `stock` - NEW.`jumlah`,
//             `keluar` = `keluar` + NEW.`jumlah`
//         WHERE `id_barang` = NEW.`id_barang`
//         ORDER BY `created_at` ASC
//         LIMIT 1;
//     ELSE
//         -- Berikan peringatan jika stok barang tidak ditemukan
//         SIGNAL SQLSTATE '45000'
//         SET MESSAGE_TEXT = 'Stok barang tidak tersedia di kartu stok';
//     END IF;
// END //





// --  second trigger
// DELIMITER //

// CREATE TRIGGER `update_kartu_stok_after_insert` AFTER INSERT ON `detail_penjualan`
// FOR EACH ROW
// BEGIN
//     DECLARE stokBarang INT;

//     -- Cek apakah ada stok yang tersedia pada barang
//     SELECT `stock` INTO stokBarang
//     FROM `kartu_stok`
//     WHERE `id_barang` = NEW.`id_barang`
//     ORDER BY `created_at` ASC
//     LIMIT 1;

//     IF stokBarang IS NOT NULL THEN
//         -- Update kartu_stok dengan mengurangi stok
//         UPDATE `kartu_stok`
//         SET `stock` = `stock` - NEW.`jumlah`
//         WHERE `id_barang` = NEW.`id_barang`
//         ORDER BY `created_at` ASC
//         LIMIT 1;
//     END IF;
// END //

// DELIMITER ;


