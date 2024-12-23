<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SPTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}


// -- INI UNTUK PENERIMAAN BARANG
// // DELIMITER $$

// // CREATE PROCEDURE sp_store_penerimaan(
// //     IN p_id_pengadaan BIGINT,
// //     IN p_id_barang INT,
// //     IN p_jumlah_terima INT,
// //     IN p_id_user INT
// // )
// // BEGIN
// //     DECLARE jumlah_pesanan INT;
// //     DECLARE jumlah_diterima INT;
// //     DECLARE sisa_barang INT;

// //     -- Ambil jumlah barang yang dipesan dari detail_pengadaan
// //     SELECT jumlah INTO jumlah_pesanan
// //     FROM detail_pengadaan
// //     WHERE id_pengadaan = p_id_pengadaan AND id_barang = p_id_barang;

// //     -- Hitung jumlah barang yang sudah diterima sebelumnya
// //     SELECT COALESCE(SUM(dp.jumlah_terima), 0) INTO jumlah_diterima
// //     FROM detail_penerimaan dp
// //     JOIN penerimaan p ON dp.id_penerimaan = p.id_penerimaan
// //     WHERE p.id_pengadaan = p_id_pengadaan AND dp.barang_id_barang = p_id_barang;

// //     -- Hitung sisa barang yang dapat diterima
// //     SET sisa_barang = jumlah_pesanan - jumlah_diterima;

// //     -- Validasi jika jumlah yang diterima melebihi sisa barang
// //     IF p_jumlah_terima > sisa_barang THEN
// //         SIGNAL SQLSTATE '45000'
// //         SET MESSAGE_TEXT = 'Jumlah diterima melebihi jumlah barang yang dipesan.';
// //     END IF;

// //     -- Validasi jika jumlah yang diterima kurang dari 1
// //     IF p_jumlah_terima < 1 THEN
// //         SIGNAL SQLSTATE '45000'
// //         SET MESSAGE_TEXT = 'Jumlah yang diterima harus lebih dari 0.';
// //     END IF;

// //     -- Tambahkan data ke tabel penerimaan jika validasi lolos
// //     INSERT INTO penerimaan (created_at, id_pengadaan, status, id_user)
// //     VALUES (NOW(), p_id_pengadaan, 'A', p_id_user);

// //     -- Ambil ID penerimaan yang baru saja ditambahkan
// //     SET @id_penerimaan = LAST_INSERT_ID();

// //     -- Tambahkan data ke detail_penerimaan
// //     INSERT INTO detail_penerimaan (id_penerimaan, barang_id_barang, jumlah_terima, harga_satuan_terima, sub_total_terima)
// //     SELECT
// //         @id_penerimaan,
// //         p_id_barang,
// //         p_jumlah_terima,
// //         harga,
// //         harga * p_jumlah_terima
// //     FROM barang
// //     WHERE id_barang = p_id_barang;

// // END$$

// // DELIMITER ;


// // --  uni SP untuk retur
// // DELIMITER $$

// // CREATE PROCEDURE StoreRetur(
// //     IN p_id_penerimaan BIGINT,
// //     IN p_id_barang INT,
// //     IN p_jumlah_retur INT,
// //     IN p_alasan VARCHAR(200),
// //     IN p_id_user INT
// // )
// // BEGIN
// //     DECLARE v_id_retur BIGINT;

// //     -- Validasi jumlah retur
// //     DECLARE v_total_terima INT;
// //     DECLARE v_total_retur INT;

// //     SELECT SUM(dp.jumlah_terima) INTO v_total_terima
// //     FROM detail_penerimaan dp
// //     WHERE dp.id_penerimaan = p_id_penerimaan AND dp.barang_id_barang = p_id_barang;

// //     SELECT COALESCE(SUM(dr.jumlah), 0) INTO v_total_retur
// //     FROM detail_retur dr
// //     JOIN retur r ON dr.id_retur = r.id_retur
// //     WHERE r.id_penerimaan = p_id_penerimaan AND r.id_barang = p_id_barang;

// //     IF v_total_terima < (v_total_retur + p_jumlah_retur) THEN
// //         SIGNAL SQLSTATE '45000'
// //         SET MESSAGE_TEXT = 'Jumlah retur melebihi jumlah barang yang diterima.';
// //     END IF;

// //     -- Insert into tabel retur
// //     INSERT INTO retur (created_at, id_penerimaan, id_barang, id_user)
// //     VALUES (NOW(), p_id_penerimaan, p_id_barang, p_id_user);

// //     -- Ambil id_retur yang baru saja di-insert
// //     SET v_id_retur = LAST_INSERT_ID();

// //     -- Insert detail retur
// //     INSERT INTO detail_retur (jumlah, alasan, id_detail_penerimaan, id_retur)
// //     VALUES (p_jumlah_retur, p_alasan,
// //         (SELECT dp.id_detail_penerimaan
// //          FROM detail_penerimaan dp
// //          WHERE dp.id_penerimaan = p_id_penerimaan AND dp.barang_id_barang = p_id_barang),
// //         v_id_retur);

// //     -- Update kartu stok: Kurangi stok
// //     INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, id_transaksi, id_barang)
// //     VALUES ('R', 0, p_jumlah_retur,
// //         (SELECT ks.stock FROM kartu_stok ks WHERE ks.id_barang = p_id_barang ORDER BY ks.created_at DESC LIMIT 1) - p_jumlah_retur,
// //         NOW(), v_id_retur, p_id_barang);
// // END$$

// // DELIMITER ;



// // -- ini untuk penjualan
// // DELIMITER $$

// // CREATE PROCEDURE insert_penjualan(
// //     IN p_subtotal_nilai INT,
// //     IN p_ppn INT,
// //     IN p_total_nilai INT,
// //     IN p_id_user INT,
// //     IN p_id_margin_penjualan INT,
// //     IN p_detail_penjualan JSON -- JSON array containing details
// // )
// // BEGIN
// //     DECLARE last_penjualan_id INT;
// //     DECLARE i INT DEFAULT 0;
// //     DECLARE n INT;
// //     DECLARE detail_harga_satuan INT;
// //     DECLARE detail_jumlah INT;
// //     DECLARE detail_subtotal INT;
// //     DECLARE detail_id_barang INT;

// //     -- Insert into penjualan
// //     INSERT INTO penjualan (
// //         created_at, subtotal_nilai, ppn, total_nilai, id_user, id_margin_penjualan
// //     ) VALUES (
// //         NOW(), p_subtotal_nilai, p_ppn, p_total_nilai, p_id_user, p_id_margin_penjualan
// //     );

// //     -- Get the last inserted id for penjualan
// //     SET last_penjualan_id = LAST_INSERT_ID();


// //     SET n = JSON_LENGTH(p_detail_penjualan);

// //     WHILE i < n DO
// //         SET detail_harga_satuan = JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].harga_satuan')));
// //         SET detail_jumlah = JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].jumlah')));
// //         SET detail_subtotal = JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].subtotal')));
// //         SET detail_id_barang = JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].id_barang')));

// //         INSERT INTO detail_penjualan (
// //             harga_satuan, jumlah, subtotal, penjualan_id_penjualan, id_barang
// //         ) VALUES (
// //             detail_harga_satuan, detail_jumlah, detail_subtotal, last_penjualan_id, detail_id_barang
// //         );

// //         SET i = i + 1;
// //     END WHILE;
// // END $$

// // DELIMITER ;
