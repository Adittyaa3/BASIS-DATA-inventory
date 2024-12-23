<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}
// -- Active: 1715655411524@@127.0.0.1@3306@projek_uas_basdat
// -- ini untuk daftar penerimaan
// CREATE OR REPLACE VIEW view_penerimaan_barang AS
// SELECT
//     p.id_pengadaan,
//     p.id_penerimaan,
//     dp.barang_id_barang AS id_barang,
//     b.nama AS nama_barang,
//     dp.jumlah_terima AS jumlah_terima_sekarang,
//     COALESCE((
//         SELECT SUM(dp2.jumlah_terima)
//         FROM detail_penerimaan dp2
//         WHERE dp2.barang_id_barang = dp.barang_id_barang
//           AND dp2.id_penerimaan IN (
//               SELECT id_penerimaan
//               FROM penerimaan
//               WHERE penerimaan.id_pengadaan = p.id_pengadaan
//           )
//     ), 0) AS jumlah_diterima_total,
//     dpg.jumlah AS jumlah_dipesan,
//     (dpg.jumlah - COALESCE((
//         SELECT SUM(dp2.jumlah_terima)
//         FROM detail_penerimaan dp2
//         WHERE dp2.barang_id_barang = dp.barang_id_barang
//           AND dp2.id_penerimaan IN (
//               SELECT id_penerimaan
//               FROM penerimaan
//               WHERE penerimaan.id_pengadaan = p.id_pengadaan
//           )
//     ), 0)) AS jumlah_sisa,
//     CASE
//         WHEN (dpg.jumlah = COALESCE((
//             SELECT SUM(dp2.jumlah_terima)
//             FROM detail_penerimaan dp2
//             WHERE dp2.barang_id_barang = dp.barang_id_barang
//               AND dp2.id_penerimaan IN (
//                   SELECT id_penerimaan
//                   FROM penerimaan
//                   WHERE penerimaan.id_pengadaan = p.id_pengadaan
//               )
//         ), 0)) THEN 'Semua Barang Diterima'
//         ELSE 'Sebagian Barang Diterima'
//     END AS status_penerimaan,
//     p.created_at AS tanggal_penerimaan,
//     u.username AS user_penerima
// FROM
//     penerimaan p
// JOIN
//     detail_penerimaan dp ON p.id_penerimaan = dp.id_penerimaan
// JOIN
//     barang b ON dp.barang_id_barang = b.id_barang
// JOIN
//     detail_pengadaan dpg ON dpg.id_barang = dp.barang_id_barang AND dpg.id_pengadaan = p.id_pengadaan
// LEFT JOIN
//     user u ON p.id_user = u.id_user;


// -- -- data retur
// -- CREATE OR REPLACE VIEW view_retur_barang AS
// -- SELECT
// --     r.id_retur,
// --     r.created_at AS tanggal_retur,
// --     dr.alasan AS alasan_retur,
// --     r.id_penerimaan,
// --     b.id_barang,
// --     b.nama AS nama_barang,
// --     dr.jumlah AS jumlah_retur,
// --     u.username AS user_retur
// -- FROM
// --     retur r
// -- JOIN
// --     detail_retur dr ON r.id_retur = dr.id_retur
// -- JOIN
// --     barang b ON dr.id_barang = b.id_barang
// -- JOIN
// --     user u ON r.id_user = u.id_user;


// -- retur
// CREATE OR REPLACE VIEW view_retur_barang AS
// SELECT
//     r.id_retur,
//     r.id_penerimaan,
//     dp.barang_id_barang AS id_barang,
//     b.nama AS nama_barang,
//     dr.jumlah AS jumlah_retur_sekarang,
//     COALESCE((
//         SELECT SUM(dr2.jumlah)
//         FROM detail_retur dr2
//         WHERE dr2.id_detail_penerimaan = dr.id_detail_penerimaan
//           AND dr2.id_retur IN (
//               SELECT id_retur
//               FROM retur
//               WHERE retur.id_penerimaan = r.id_penerimaan
//           )
//     ), 0) AS jumlah_diretur_total,
//     dp.jumlah_terima AS jumlah_diterima,
//     (dp.jumlah_terima - COALESCE((
//         SELECT SUM(dr2.jumlah)
//         FROM detail_retur dr2
//         WHERE dr2.id_detail_penerimaan = dr.id_detail_penerimaan
//           AND dr2.id_retur IN (
//               SELECT id_retur
//               FROM retur
//               WHERE retur.id_penerimaan = r.id_penerimaan
//           )
//     ), 0)) AS jumlah_sisa,
//     CASE
//         WHEN (dp.jumlah_terima = COALESCE((
//             SELECT SUM(dr2.jumlah)
//             FROM detail_retur dr2
//             WHERE dr2.id_detail_penerimaan = dr.id_detail_penerimaan
//               AND dr2.id_retur IN (
//                   SELECT id_retur
//                   FROM retur
//                   WHERE retur.id_penerimaan = r.id_penerimaan
//               )
//         ), 0)) THEN 'Semua Barang Diretur'
//         ELSE 'Sebagian Barang Diretur'
//     END AS status_retur,
//     r.created_at AS tanggal_retur,
//     u.username AS user_retur
// FROM
//     retur r
// JOIN
//     detail_retur dr ON r.id_retur = dr.id_retur
// JOIN
//     detail_penerimaan dp ON dr.id_detail_penerimaan = dp.id_detail_penerimaan
// JOIN
//     barang b ON dp.barang_id_barang = b.id_barang
// LEFT JOIN
//     user u ON r.id_user = u.id_user;



// -- untuk kartu stok
// CREATE OR REPLACE VIEW kartu_stok_view AS
// SELECT
//     k.id_kartu_stok,
//     k.jenis_transaksi,
//     k.masuk,
//     k.keluar,
//     k.stock,
//     k.created_at AS "masuk pada tanggal",
//     k.id_transaksi,
//     k.id_barang,
//     b.nama AS nama_barang,
//     v.nama_vendor AS nama_vendor
// FROM
//     kartu_stok k
// JOIN
//     barang b ON k.id_barang = b.id_barang
// LEFT JOIN
//     pengadaan p ON k.id_transaksi = p.id_pengadaan
// JOIN
//     vendor v ON p.vendor_id_vendor = v.id_vendor
// ORDER BY
//     k.id_barang;


// CREATE VIEW view_masuk_keluar_stok AS
// SELECT
//     b.id_barang,
//     b.nama,
//     IFNULL(SUM(k.masuk), 0) AS total_masuk,
//     IFNULL(SUM(k.keluar), 0) AS total_keluar,
//     (IFNULL(SUM(k.masuk), 0) - IFNULL(SUM(k.keluar), 0)) AS total_stok
// FROM
//     barang b
// LEFT JOIN
//     kartu_stok k ON b.id_barang = k.id_barang
// GROUP BY
//     b.id_barang, b.nama;

// CREATE  or REPLACE VIEW view_penjualan_barang AS
// SELECT
//     p.id_penjualan,
//     p.created_at AS tanggal_penjualan,
//     b.nama AS barang,
//     p.total_nilai AS total_harga_penjualan,
//     mp.persen AS margin_persen
// FROM penjualan p
// LEFT JOIN detail_penjualan dp ON p.id_penjualan = dp.penjualan_id_penjualan
// LEFT JOIN barang b ON dp.id_barang = b.id_barang
// LEFT JOIN margin_penjualan mp ON p.id_margin_penjualan = mp.id_margin_penjualan;



// --  view role
// CREATE or REPLACE VIEW view_role AS
// SELECT
//     id_role,
//     nama_role
// FROM role;

// -- view user
// CREATE or REPLACE VIEW view_user AS
// SELECT
//     id_user,
//     username,
//     r.nama_role
// FROM user u
// JOIN role r ON u.id_role = r.id_role;

// -- viewr retur
// CREATE or replace VIEW view_vendor as
// SELECT
//     id_vendor,
//     nama_vendor,
//     badan_hukum,
//     status
// FROM vendor
// WHERE status ='1';

// -- view barang
// CREATE OR REPLACE VIEW view_barang AS
// SELECT
//     id_barang,
//     jenis,
//     nama,
//     s.nama_satuan,
//     harga
// FROM barang b
// JOIN satuan s ON b.id_satuan = s.id_satuan
// ORDER BY id_barang;

// -- view satuan
// CREATE OR REPLACE VIEW view_satuan AS
// SELECT
//     id_satuan,
//     nama_satuan,
//     status
// FROM satuan
// WHERE status = 1;


// -- margin penjualan
// CREATE OR REPLACE VIEW view_margin_penjualan AS
// SELECT
//     id_margin_penjualan,
//     persen,
//     status,
//     created_at,
//     u.id_user,
//     updated_at
// FROM margin_penjualan mp
// LEFT JOIN user u ON mp.id_user = u.id_user
// WHERE status = 1;

// -- detail pengadaan
// CREATE OR REPLACE VIEW view_detail_pengadaan AS
// SELECT
//     dp.id_detail_pengadaan,
//     dp.harga_satuan,
//     dp.jumlah,
//     dp.sub_total,
//     dp.id_pengadaan,
//     dp.id_barang,
//     b.nama AS nama_barang
// FROM detail_pengadaan dp
// JOIN barang b ON dp.id_barang = b.id_barang;


// -- detail penerimaan
// CREATE OR REPLACE VIEW view_detail_penerimaan AS
// SELECT
//     dp.id_detail_penerimaan,
//     b.id_barang,
//     b.nama AS nama_barang,
//     dp.jumlah_terima,
//     dp.harga_satuan_terima,
//     dp.sub_total_terima,
//     dp.id_penerimaan
// FROM detail_penerimaan dp
// JOIN barang b ON dp.barang_id_barang = b.id_barang;

// -- detail retur
// CREATE OR REPLACE VIEW view_detail_retur AS
// SELECT
//     dr.id_detail_retur,
//     dr.jumlah,
//     dr.alasan,
//     dr.id_detail_penerimaan,
//     dr.id_retur,
//     dp.barang_id_barang,
//     b.nama AS nama_barang
// FROM detail_retur dr
// JOIN detail_penerimaan dp ON dr.id_detail_penerimaan = dp.id_detail_penerimaan
// JOIN barang b ON dp.barang_id_barang = b.id_barang;

// -- hitung total keuntungan
// CREATE OR REPLACE VIEW view_total_keuntungan AS
// SELECT barang


// -- detail penjualan margin keuntungan
// CREATE OR REPLACE VIEW view_summary_penjualan AS
// SELECT
//     COUNT(p.id_penjualan) AS total_penjualan,
//     SUM(p.total_nilai) AS total_pendapatan,
//     SUM(p.subtotal_nilai * m.persen) AS total_profit
// FROM penjualan p
// JOIN margin_penjualan m ON p.id_margin_penjualan = m.id_margin_penjualan;

// -- total pengadaan barang
// CREATE OR REPLACE VIEW view_total_pengadaan_barang AS
// SELECT
//     COUNT(id_pengadaan) as total_pengadaan
// FROM pengadaan;

// -- total retur
// CREATE OR REPLACE VIEW view_total_retur AS
// SELECT
//     COUNT(id_retur) as total_retur
// FROM retur;

// -- total penerimaan
// CREATE or REPLACE VIEW view_total_penerimaan AS
// SELECT
//     COUNT(id_penerimaan) as total_penerimaan
// FROM penerimaan;




