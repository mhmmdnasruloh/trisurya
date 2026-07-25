-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2026 at 07:23 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashflow`
--

CREATE TABLE `cashflow` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` text COLLATE utf8mb4_general_ci NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `kategori` text COLLATE utf8mb4_general_ci,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `sumber_dana` text COLLATE utf8mb4_general_ci,
  `invoice_id` int DEFAULT NULL,
  `status` text COLLATE utf8mb4_general_ci,
  `created_by` text COLLATE utf8mb4_general_ci,
  `jatuh_tempo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashflow`
--

INSERT INTO `cashflow` (`id`, `tanggal`, `jenis`, `nominal`, `kategori`, `keterangan`, `sumber_dana`, `invoice_id`, `status`, `created_by`, `jatuh_tempo`) VALUES
(1, '2025-05-13', 'pemasukan', 49062000.00, 'PO Lunas', 'Invoice: I-TSU-2025-001', 'BNI', 1, NULL, NULL, NULL),
(2, '2025-03-17', 'pemasukan', 11211000.00, 'PO Lunas Pindahan', 'PO Ohtomi 17 Maret ', 'BNI', NULL, NULL, '2', NULL),
(3, '2025-05-13', 'pengeluaran', 1500000.00, 'Belanja PO', 'Bayar Plat Pak Sahdi', 'SeaBank', NULL, NULL, '2', NULL),
(4, '2025-01-03', 'pengeluaran', 2900.00, 'Admin Bank', 'Potongan biaya tf dari Mayora\n', 'BNI', NULL, NULL, '2', NULL),
(5, '2025-01-03', 'pengeluaran', 234765.00, 'Operasional', 'Wifi Desember 2024', 'SeaBank', NULL, NULL, '2', NULL),
(6, '2025-01-03', 'pengeluaran', 511000.00, 'Operasional', 'Galon, Listrik, Bensin ke Lab KAN', 'SeaBank', NULL, NULL, '2', NULL),
(7, '2025-01-06', 'pengeluaran', 37500.00, 'Operasional', 'BPJS Pak Trias', 'SeaBank', NULL, NULL, '2', NULL),
(8, '2025-01-06', 'pengeluaran', 1273392.00, 'Operasional', 'Hostinger', 'SeaBank', NULL, NULL, '2', NULL),
(9, '2025-01-09', 'pengeluaran', 139000.00, 'Belanja PO', 'Kirim barang ke Mulia Inti Pangan\n', 'SeaBank', NULL, NULL, '2', NULL),
(10, '2025-01-09', 'pengeluaran', 318001.00, 'Operasional', 'Konsumsi', 'SeaBank', NULL, NULL, '2', NULL),
(11, '2025-01-09', 'pengeluaran', 950000.00, 'Belanja PO', 'Bayar KAN MIP + Bitzer\n', 'BNI', NULL, NULL, '2', NULL),
(12, '2025-01-09', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Admin', 'BNI', NULL, NULL, '2', NULL),
(13, '2025-01-09', 'pengeluaran', 2010910.00, 'Belanja Modal Stok', 'Bayar Plat Sojikyo ke Huinindo\n', 'BNI', NULL, NULL, '2', NULL),
(14, '2025-01-09', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Admin Plat', 'BNI', NULL, NULL, '2', NULL),
(15, '2025-01-10', 'pengeluaran', 113000.00, 'Belanja Umum', 'HVS, Tip-x, parkir KPP+Citramedia\n', 'SeaBank', NULL, NULL, '2', NULL),
(16, '2025-01-10', 'pengeluaran', 425000.00, 'Operasional', 'Bensin Kaneka Foods+Bitzer, parkir KPP, meterai 10+lem korea\n', 'SeaBank', NULL, NULL, '2', NULL),
(17, '2025-01-13', 'pengeluaran', 125000.00, 'Operasional', 'Operasional Motor', 'SeaBank', NULL, NULL, '2', NULL),
(18, '2025-01-13', 'pengeluaran', 1000000.00, 'Gaji', 'Bonus Magang', 'SeaBank', NULL, NULL, '1', NULL),
(19, '2025-01-15', 'pengeluaran', 2460000.00, 'Komisi', 'Komisi Mayora, Artha TEknik, Interindo\n', 'SeaBank', NULL, NULL, '2', NULL),
(20, '2025-01-16', 'pengeluaran', 30000.00, 'Operasional', 'Kartu ByU 3', 'SeaBank', NULL, NULL, '2', NULL),
(21, '2025-01-16', 'pengeluaran', 500148.00, 'Operasional', 'Tol ke Bitzer, kirim barang Backup, galon, perpanjang domain Trisurya, bor tangan 1+ESP32 2\n', 'SeaBank', NULL, NULL, '2', NULL),
(22, '2025-01-17', 'pengeluaran', 1979000.00, 'Belanja PO', 'Printer TSC 224 Pro\n', 'SeaBank', NULL, NULL, '2', NULL),
(23, '2025-01-17', 'pengeluaran', 2633000.00, 'Operasional', 'Servis Mobil', 'SeaBank', NULL, NULL, '2', NULL),
(24, '2025-01-20', 'pengeluaran', 127610.00, 'Belanja Umum', 'Label Barcode + alat teknik (mata bor, batok charger, lem korea, lem tembak, kunci kepala bor, mata bor, bor tangan, kabel jumper)\n', 'SeaBank', NULL, NULL, '2', NULL),
(25, '2025-01-21', 'pengeluaran', 1002000.00, 'Operasional', 'Listrik', 'SeaBank', NULL, NULL, '2', NULL),
(26, '2025-01-21', 'pengeluaran', 54400.00, 'Belanja Umum', 'Mata Bor Pagoda\n', 'SeaBank', NULL, NULL, '2', NULL),
(27, '2025-01-23', 'pengeluaran', 881500.00, 'Operasional', 'Bensin Metrologi, Bensin Lautan Air+Metrologi, tol Lautan Air, KAN Abadi Lestari, WD\n', 'SeaBank', NULL, NULL, '2', NULL),
(28, '2025-01-23', 'pengeluaran', 173100.00, 'Belanja PO', 'Ribbon printer\n', 'SeaBank', NULL, NULL, '2', NULL),
(29, '2025-01-30', 'pengeluaran', 114680.00, 'Belanja Umum', 'ESP32, Sensor jarak, push button\n', 'SeaBank', NULL, NULL, '2', NULL),
(30, '2025-01-30', 'pengeluaran', 800000.00, 'Belanja PO', 'Bayar KAN Indoglas\n', 'BNI', NULL, NULL, '2', NULL),
(31, '2025-01-30', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Admin', 'BNI', NULL, NULL, '2', NULL),
(32, '2025-01-30', 'pengeluaran', 15000000.00, 'Pindah Buku', 'Pindah Buku ke SeaBank', 'BNI', NULL, NULL, '2', NULL),
(33, '2025-01-30', 'pemasukan', 15000000.00, 'Pindah Buku', 'Pindah Buku dari BNI', 'SeaBank', NULL, NULL, '2', NULL),
(34, '2025-01-30', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Pindah Buku', 'BNI', NULL, NULL, '2', NULL),
(35, '2025-01-30', 'pengeluaran', 347000.00, 'Operasional', 'Rembers bensin+tol indoglas,mustika citra,KAN\n', 'SeaBank', NULL, NULL, '2', NULL),
(36, '2025-01-31', 'pengeluaran', 11000000.00, 'Gaji', 'Operasiona Gaji Januari\n', 'SeaBank', NULL, NULL, '2', NULL),
(37, '2025-01-31', 'pemasukan', 32433.00, 'Bunga Bank', 'Bunga bank Januari\n', 'BNI', NULL, NULL, '2', NULL),
(38, '2025-01-31', 'pengeluaran', 26487.00, 'Admin Bank', 'Admin Bank Januari', 'BNI', NULL, NULL, '2', NULL),
(39, '2025-02-03', 'pengeluaran', 1000.00, 'Admin Bank', 'Biaya Tf Adyawinsa ke TSU', 'SeaBank', NULL, NULL, '2', NULL),
(40, '2025-05-14', 'pemasukan', 5205900.00, 'PO Lunas', 'Invoice: I-TSU-2025-002', 'BNI', 2, NULL, NULL, NULL),
(41, '2025-05-14', 'pemasukan', 8000000.00, 'PO Lunas', 'Invoice: I-TSU-2025-003', 'BNI', 3, NULL, NULL, NULL),
(42, '2025-04-24', 'pengeluaran', 180000.00, 'Belanja PO', 'Order Baterai Ed Scale', 'SeaBank', NULL, NULL, '2', '2025-05-24'),
(43, '2025-05-14', 'pemasukan', 4162500.00, 'PO Lunas', 'Invoice: I-TSU-2025-004', 'BNI', 4, NULL, NULL, NULL),
(44, '2025-05-14', 'pemasukan', 8880000.00, 'PO Lunas', 'Invoice: I-TSU-2025-005', 'BNI', 5, NULL, NULL, NULL),
(45, '2025-05-15', 'pemasukan', 8547000.00, 'PO Lunas', 'Invoice: I-TSU-2025-006', 'BNI', 6, NULL, NULL, NULL),
(46, '2025-02-04', 'pengeluaran', 108128.00, 'Belanja Umum', 'Elektro part stepup kabel konektor\n', 'SeaBank', NULL, NULL, '2', NULL),
(47, '2025-02-05', 'pengeluaran', 234765.00, 'Operasional', 'Wifi Januari 25\n', 'SeaBank', NULL, NULL, '2', NULL),
(48, '2025-02-05', 'pengeluaran', 37500.00, 'Operasional', 'BPJS Kesehatan Pak Trias\n', 'SeaBank', NULL, NULL, '2', NULL),
(49, '2025-02-06', 'pengeluaran', 332500.00, 'Operasional', 'Label kertas,tol dan bensin ke PT.Mahakam, Bensin ke MDI\n', 'SeaBank', NULL, NULL, '2', NULL),
(50, '2025-02-07', 'pengeluaran', 360977.00, 'Belanja Umum', 'Sepatu safety, helm safety, plug connector, push button, micro sd\n', 'SeaBank', NULL, NULL, '2', NULL),
(51, '2025-02-07', 'pengeluaran', 2090625.00, 'Komisi', 'Komisi Adyawinsa, Otsuka, ALI\n', 'SeaBank', NULL, NULL, '2', NULL),
(52, '2025-02-07', 'pengeluaran', 407000.00, 'Operasional', 'Kirim dokumen Indoglas, galon, bensin ke Fosroc+Banshu+stasiun, tol ke Banshu\n', 'SeaBank', NULL, NULL, '2', NULL),
(53, '2025-02-10', 'pengeluaran', 112500.00, 'Operasional', 'Transport ke Stasiun Bekasi\n', 'SeaBank', NULL, NULL, '2', NULL),
(54, '2025-02-12', 'pengeluaran', 433000.00, 'Operasional', 'Transport dari Stasiun Cikarang + konsumsi\n', 'SeaBank', NULL, NULL, '2', NULL),
(55, '2025-02-13', 'pengeluaran', 2900.00, 'Admin Bank', 'Admin bank pelunasan Dover\n', 'BNI', NULL, NULL, '2', NULL),
(56, '2025-02-13', 'pengeluaran', 125000.00, 'Operasional', 'Baterai Motor', 'SeaBank', NULL, NULL, '2', NULL),
(57, '2025-02-13', 'pengeluaran', 267000.00, 'Operasional', 'Galon, tol ke Kasai+Mitra Digital, bensin ke Kasai+Lab KAN\n', 'SeaBank', NULL, NULL, '2', NULL),
(58, '2025-02-14', 'pengeluaran', 498610.00, 'Belanja Umum', 'Printer Bluetooth, Card Reader\n', 'SeaBank', NULL, NULL, '2', NULL),
(59, '2025-02-17', 'pengeluaran', 20000000.00, 'Pindah Buku', 'Pindah Buku Ke Seabank', 'BNI', NULL, NULL, '2', NULL),
(60, '2025-02-17', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Transfer', 'BNI', NULL, NULL, '2', NULL),
(61, '2025-02-17', 'pemasukan', 20000000.00, 'Pindah Buku', 'Pindah Buku dari BNI', 'SeaBank', NULL, NULL, '2', NULL),
(62, '2025-02-17', 'pengeluaran', 5000000.00, 'Belanja PO', 'DP Pembuatan Plat u/ PO DOverchem\n', 'SeaBank', NULL, NULL, '2', NULL),
(63, '2025-02-18', 'pengeluaran', 250000.00, 'Belanja PO', 'Pembayaran inv 096 KAN u/ Karyapratama\n', 'SeaBank', NULL, NULL, '2', NULL),
(64, '2025-02-18', 'pengeluaran', 1674666.00, 'Perpajakan', 'PPh Badan tahun 2024\n', 'BNI', NULL, NULL, '2', NULL),
(65, '2025-02-18', 'pengeluaran', 409000.00, 'Operasional', 'Bensin ke Global Mandiri, BMT, MDI, Kasai Teck, tol ke MDI, Pak Sahdi\n', 'SeaBank', NULL, NULL, '2', NULL),
(66, '2025-02-19', 'pengeluaran', 22726765.00, 'Belanja Modal Stok', 'Pembayaran barang Ko Deni\n', 'BNI', NULL, NULL, '2', NULL),
(67, '2025-02-19', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Transfer', 'BNI', NULL, NULL, '2', NULL),
(68, '2025-02-20', 'pengeluaran', 4856000.00, 'Belanja Modal Stok', 'Bayar barang Ko Deni\n', 'BNI', NULL, NULL, '2', NULL),
(69, '2025-02-20', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya transfer\n', 'BNI', NULL, NULL, '2', NULL),
(70, '2025-02-20', 'pengeluaran', 5064441.00, 'Perpajakan', 'PPN Masa Januari\n', 'BNI', NULL, NULL, '2', NULL),
(71, '2025-02-20', 'pengeluaran', 133810.00, 'Belanja Umum', 'Wrover ESP\n', 'SeaBank', NULL, NULL, '2', NULL),
(72, '2025-02-21', 'pengeluaran', 1002750.00, 'Operasional', 'Listrik\n', 'SeaBank', NULL, NULL, '2', NULL),
(73, '2025-02-27', 'pengeluaran', 1162000.00, 'Operasional', 'Bensin ke Pak Sahdi, Dover, tol ke Dover, kirim dokumen ke Dover, konsumsi, galon\n', 'SeaBank', NULL, NULL, '2', NULL),
(74, '2025-02-28', 'pengeluaran', 3500000.00, 'Belanja PO', 'Pelunasan buat plat u/ PO Dover\n', 'SeaBank', NULL, NULL, '2', NULL),
(75, '2025-02-28', 'pengeluaran', 27960.00, 'Admin Bank', 'Biaya bulanan bank Februari\n', 'BNI', NULL, NULL, '2', NULL),
(76, '2025-02-28', 'pemasukan', 39797.00, 'Bunga Bank', 'Pendapatan bunga bank\n', 'BNI', NULL, NULL, '2', NULL),
(77, '2025-02-28', 'pengeluaran', 12100000.00, 'Gaji', 'Operasional Gaji Februari+lembur\n', 'SeaBank', NULL, NULL, '2', NULL),
(78, '2025-03-05', 'pengeluaran', 56600.00, 'Belanja Umum', 'Kontainer Mini\n', 'SeaBank', NULL, NULL, '2', NULL),
(79, '2025-03-05', 'pengeluaran', 1000000.00, 'Belanja PO', 'Kalibrasi PO Dover\n', 'SeaBank', NULL, NULL, '2', NULL),
(80, '2025-03-05', 'pengeluaran', 624000.00, 'Operasional', 'BPJS TK\n', 'BNI', NULL, NULL, '2', NULL),
(81, '2025-03-05', 'pengeluaran', 20000000.00, 'Pindah Buku', 'Pindah buku ke Seabank', 'BNI', NULL, NULL, '2', NULL),
(82, '2025-03-05', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Tf', 'SeaBank', NULL, NULL, '2', NULL),
(83, '2025-03-05', 'pemasukan', 20000000.00, 'Pindah Buku', 'Pindah Buku dari BNI', 'SeaBank', NULL, NULL, '2', NULL),
(84, '2025-03-07', 'pengeluaran', 1627600.00, 'Komisi', 'Komisi MIP, Bitzer, MDI\n', 'SeaBank', NULL, NULL, '2', NULL),
(85, '2025-03-07', 'pengeluaran', 234765.00, 'Operasional', 'Wifi\n', 'SeaBank', NULL, NULL, '2', NULL),
(86, '2025-03-10', 'pengeluaran', 250000.00, 'Operasional', 'Bensin ke Gandum Mas\n', 'BNI', NULL, NULL, '2', NULL),
(87, '2025-03-10', 'pengeluaran', 220404.00, 'Belanja Umum', 'Wrover, S3, SD Card\n', 'SeaBank', NULL, NULL, '2', NULL),
(88, '2025-03-12', 'pengeluaran', 162500.00, 'Operasional', 'Baterai motor + BPJS Kes Pak Trias\n', 'SeaBank', NULL, NULL, '2', NULL),
(89, '2025-03-13', 'pengeluaran', 3277000.00, 'Belanja PO', 'Bayar Invc SSA02250109 ED Scale\n', 'SeaBank', NULL, NULL, '2', NULL),
(90, '2025-03-13', 'pengeluaran', 4850000.00, 'Belanja Modal Stok', 'Belanja barang dari alibaba\n', 'SeaBank', NULL, NULL, '2', NULL),
(91, '2025-03-13', 'pengeluaran', 1500.00, 'Admin Bank', 'Biaya transfer\n', 'SeaBank', NULL, NULL, '2', NULL),
(92, '2025-03-13', 'pengeluaran', 10000000.00, 'Pindah Buku', 'Pindah buku ke Seabank', 'BNI', NULL, NULL, '2', NULL),
(93, '2025-03-13', 'pengeluaran', 2500.00, 'Admin Bank', 'Tf pindah buku\n', 'SeaBank', NULL, NULL, '2', NULL),
(94, '2025-03-13', 'pemasukan', 10000000.00, 'Pindah Buku', 'Pindah Buku dr BNI', 'SeaBank', NULL, NULL, '2', NULL),
(95, '2025-03-13', 'pengeluaran', 551000.00, 'Operasional', 'Tol ke Gandum Mas, Sealant, Bensin + tol ke PT Mitsui Kinzoku, kirim sertifikat KAN PT Dover\n', 'SeaBank', NULL, NULL, '2', NULL),
(96, '2025-03-14', 'pengeluaran', 82878.00, 'Belanja Umum', 'slder kertas, struk kertas, label\n', 'SeaBank', NULL, NULL, '2', NULL),
(97, '2025-03-14', 'pengeluaran', 250000.00, 'Gaji', 'Bonus PKL\n', 'SeaBank', NULL, NULL, '1', NULL),
(98, '2025-03-17', 'pengeluaran', 175350.00, 'Belanja Umum', 'SD Adapter, ESP32-Wrover, Data LOgger RTC, Micro SD\n', 'SeaBank', NULL, NULL, '2', NULL),
(99, '2025-03-19', 'pengeluaran', 311500.00, 'Belanja Umum', 'ESP Touch screen\n', 'SeaBank', NULL, NULL, '2', NULL),
(100, '2025-03-19', 'pengeluaran', 567000.00, 'Belanja Modal Stok', 'Ongkir import MK Series dll inv 931E 0303\n', 'SeaBank', NULL, NULL, '2', NULL),
(101, '2025-03-20', 'pengeluaran', 2708332.00, 'Gaji', 'THR\n', 'SeaBank', NULL, NULL, '1', NULL),
(102, '2025-03-20', 'pengeluaran', 1059800.00, 'Operasional', 'Parsel, bensin + tok ke Forsta Kalmedic, bensin ke Kyodo Yushi + Bauer, bensin + tol ambil barang\n', 'SeaBank', NULL, NULL, '2', NULL),
(103, '2025-03-24', 'pengeluaran', 11798820.00, 'Perpajakan', 'PPN Masa Februari\n', 'BNI', NULL, NULL, '2', NULL),
(104, '2025-03-25', 'pengeluaran', 47300.00, 'Belanja Umum', 'Kabel soket\n', 'SeaBank', NULL, NULL, '2', NULL),
(105, '2025-03-27', 'pengeluaran', 12000000.00, 'Gaji', 'Operasional Gaji Maret\n', 'SeaBank', NULL, NULL, '2', NULL),
(106, '2025-03-31', 'pemasukan', 25410.00, 'Bunga Bank', 'Pendapatan bunga bank\n', 'BNI', NULL, NULL, '2', NULL),
(107, '2025-03-31', 'pengeluaran', 25082.00, 'Admin Bank', 'biaya admin\n', 'BNI', NULL, NULL, '2', NULL),
(108, '2025-04-08', 'pengeluaran', 234765.00, 'Operasional', 'Wifi\n', 'SeaBank', NULL, NULL, '2', NULL),
(109, '2025-04-08', 'pengeluaran', 100990.00, 'Belanja Umum', 'Sticker timbul, label sticker thermal\n', 'SeaBank', NULL, NULL, '2', NULL),
(110, '2025-04-08', 'pengeluaran', 1101366.00, 'Belanja Modal Stok', 'Pajak Impor\n', 'BNI', NULL, NULL, '2', NULL),
(111, '2025-04-08', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya transfer\n', 'BNI', NULL, NULL, '2', NULL),
(112, '2025-04-08', 'pengeluaran', 37500.00, 'Operasional', 'BPJS Kes Pak Trias\n', 'SeaBank', NULL, NULL, '2', NULL),
(113, '2025-04-09', 'pengeluaran', 5000000.00, 'Belanja PO', 'DP Pembuatan Plat u/ PO Gandum Mas\n', 'SeaBank', NULL, NULL, '2', NULL),
(114, '2025-04-09', 'pengeluaran', 4965000.00, 'Komisi', 'Komisi Dover, MDI 4, Indoglas, Karyapratama\n', 'SeaBank', NULL, NULL, '2', NULL),
(115, '2025-04-09', 'pengeluaran', 30000000.00, 'Pindah Buku', 'Pindah buku ke SeaBank\n', 'BNI', NULL, NULL, '2', NULL),
(116, '2025-04-09', 'pemasukan', 30000000.00, 'Pindah Buku', 'Pindah Buku dari BNI', 'SeaBank', NULL, NULL, '2', NULL),
(117, '2025-04-09', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya TF', 'BNI', NULL, NULL, '2', NULL),
(118, '2025-04-10', 'pengeluaran', 3668500.00, 'Belanja Modal Stok', 'Import Barang 4\n', 'SeaBank', NULL, NULL, '2', NULL),
(119, '2025-04-10', 'pengeluaran', 485882.00, 'Operasional', 'Robot Adaptor,office 2019 pro &2021 pro, Baterai motor polytron, tol,tips & ongkir lalamove,kirim adaptor ke dover\n', 'SeaBank', NULL, NULL, '2', NULL),
(120, '2025-04-11', 'pengeluaran', 7455564.00, 'Belanja Modal Stok', 'Biaya Import Barang\n', 'BNI', NULL, NULL, '2', NULL),
(121, '2025-04-11', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Transfer\n', 'BNI', NULL, NULL, '2', NULL),
(122, '2025-04-15', 'pengeluaran', 2762500.00, 'Belanja Modal Stok', 'Bayar Import Barang PA\n', 'SeaBank', NULL, NULL, '2', NULL),
(123, '2025-04-16', 'pengeluaran', 200000.00, 'Operasional', 'bensin ke Kyodo Yushi\n', 'SeaBank', NULL, NULL, '2', NULL),
(124, '2025-04-17', 'pengeluaran', 471880.00, 'Belanja Modal Stok', 'Printer 3, Adaptor 2,Steker\n', 'SeaBank', NULL, NULL, '2', NULL),
(125, '2025-04-17', 'pengeluaran', 38100.00, 'Belanja Umum', 'Mata Bor\n', 'SeaBank', NULL, NULL, '2', NULL),
(126, '2025-04-17', 'pengeluaran', 196500.00, 'Belanja Umum', 'Materai 10,terminal,tinta,map,penghapus,spidol,stabilo,label\n', 'SeaBank', NULL, NULL, '2', NULL),
(127, '2025-04-17', 'pengeluaran', 495000.00, 'Operasional', 'Bensin &toll ke Nipro,cuci ac, air galon,Bensin & Makan ke Pak Sahdi,Kabel Ties\n', 'SeaBank', NULL, NULL, '2', NULL),
(128, '2025-04-17', 'pengeluaran', 623999.00, 'Operasional', 'BPJS Karyawan\n', 'BNI', NULL, NULL, '2', NULL),
(129, '2025-04-17', 'pengeluaran', 163106.00, 'Perpajakan', 'PPN bulan Maret\n', 'BNI', NULL, NULL, '2', NULL),
(130, '2025-04-17', 'pengeluaran', 683710.00, 'Belanja Modal Stok', 'Biaya Import INDICATOR STAINLESS USE WEIGH\n', 'BNI', NULL, NULL, '2', NULL),
(131, '2025-04-22', 'pengeluaran', 714790.00, 'Belanja Modal Stok', 'Biaya Import SAMPLE MATERIAL ALUMINUM BASE \n\nAND STURDY ABSSHELL PURPOSE \nUSE FOR WEIGHING AND\"\n', 'BNI', NULL, NULL, '2', NULL),
(132, '2025-04-23', 'pengeluaran', 500000.00, 'Operasional', 'Sewa mobil ke Gandum mas\n', 'SeaBank', NULL, NULL, '2', NULL),
(133, '2025-04-23', 'pengeluaran', 200000.00, 'Operasional', 'Bensin ke MDI\n', 'BNI', NULL, NULL, '2', NULL),
(134, '2025-04-23', 'pengeluaran', 6000000.00, 'Belanja PO', 'Pelunasan plat stailess tanjakan Gandum Mas\n', 'SeaBank', NULL, NULL, '2', NULL),
(135, '2025-04-23', 'pengeluaran', 250000.00, 'Belanja PO', 'Bayar KAN Ohtomi\n', 'SeaBank', NULL, NULL, '2', NULL),
(136, '2025-04-24', 'pengeluaran', 225600.00, 'Operasional', 'Tol +Makan Ke Gandum Mas, Kirim Sertifikat Ke Gandum Mas\n', 'SeaBank', NULL, NULL, '2', NULL),
(137, '2025-04-24', 'pengeluaran', 1000000.00, 'Belanja PO', 'Bayar Kalibrasi Gandum Mas\n', 'SeaBank', NULL, NULL, '2', NULL),
(138, '2025-04-28', 'pengeluaran', 20000000.00, 'Pindah Buku', 'Pindah Buku', 'BNI', NULL, NULL, '2', NULL),
(139, '2025-04-28', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya TF', 'BNI', NULL, NULL, '2', NULL),
(140, '2025-04-28', 'pemasukan', 20000000.00, 'Pindah Buku', 'Pindah Buku', 'SeaBank', NULL, NULL, '2', NULL),
(141, '2025-04-29', 'pengeluaran', 300000.00, 'Operasional', 'Bensin Ke Rohto\n', 'BNI', NULL, NULL, '2', NULL),
(142, '2025-04-30', 'pengeluaran', 4950000.00, 'Perijinan', 'Bayar Metrologi BP7W\n', 'BNI', NULL, NULL, '2', NULL),
(143, '2025-04-30', 'pengeluaran', 203000.00, 'Operasional', 'Makan Perpisahan Maya\n', 'SeaBank', NULL, NULL, '2', NULL),
(144, '2025-04-30', 'pemasukan', 45484.00, 'Bunga Bank', 'Bunga Bank April\n', 'BNI', NULL, NULL, '2', NULL),
(145, '2025-04-30', 'pengeluaran', 29097.00, 'Admin Bank', 'Biaya Admin April', 'BNI', NULL, NULL, '2', NULL),
(146, '2025-04-30', 'pengeluaran', 13433333.00, 'Gaji', 'Operasional Gaji\n', 'SeaBank', NULL, NULL, '2', NULL),
(147, '2025-04-30', 'pengeluaran', 58911.00, 'Operasional', 'Beli rak dan tisu\n', 'SeaBank', NULL, NULL, '2', NULL),
(148, '2025-05-02', 'pengeluaran', 457000.00, 'Operasional', 'Jnt Cargo Abadi lestari, Makan Ke Rohto,Tol Rohto, Fc, Galon, Makan Perpisahan Maya\n', 'SeaBank', NULL, NULL, '2', NULL),
(149, '2025-05-05', 'pengeluaran', 234765.00, 'Operasional', 'Bayar Wifi\n', 'SeaBank', NULL, NULL, '2', NULL),
(150, '2025-05-05', 'pengeluaran', 37500.00, 'Operasional', 'BPJS Kesehatan Pak Trias\n', 'SeaBank', NULL, NULL, '2', NULL),
(151, '2025-05-06', 'pengeluaran', 150000.00, 'Operasional', 'Bensin Ke Ohtomi\n', 'BNI', NULL, NULL, '2', NULL),
(152, '2025-05-07', 'pengeluaran', 3265000.00, 'Belanja Modal Stok', 'Bayar ED scale Inv SSA/04/25/0598\n', 'BNI', NULL, NULL, '2', NULL),
(153, '2025-05-07', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Admin', 'BNI', NULL, NULL, '2', NULL),
(154, '2025-05-11', 'pengeluaran', 200000.00, 'Operasional', 'Bensin ke Pak Firman dan Pak Sahdi', 'SeaBank', NULL, NULL, '2', NULL),
(155, '2025-03-03', 'pemasukan', 6993000.00, 'PO Lunas Pindahan', 'MDI BP7w 30kd', 'BNI', NULL, NULL, '2', NULL),
(156, '2025-05-13', 'pengeluaran', 2190100.00, 'Belanja PO', 'Bayar ke Hunindo Sojikyo no 105020/HMN-JKT/2025', 'BNI', NULL, NULL, '2', NULL),
(157, '2025-05-13', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Admin', 'BNI', NULL, NULL, '2', NULL),
(158, '2025-05-14', 'pengeluaran', 125000.00, 'Operasional', 'Baterai Motor', 'SeaBank', NULL, NULL, '2', NULL),
(159, '2025-05-14', 'pengeluaran', 70000.00, 'Belanja Umum', 'Bayar Box x4 10 pcs', 'SeaBank', NULL, NULL, '2', NULL),
(160, '2025-05-15', 'pengeluaran', 95340.00, 'Belanja Umum', 'SD Card 2 Hook 5', 'SeaBank', NULL, NULL, '2', NULL),
(161, '2025-05-15', 'pengeluaran', 110000.00, 'Operasional', 'Bikin Plat, Tol ke pak Firman, Bensin dimas ke Metrologi,Baterai CR1220', 'SeaBank', NULL, NULL, '2', NULL),
(162, '2025-05-17', 'pemasukan', 8000000.00, 'PO Lunas', 'Invoice: I-TSU-2025-007', 'BNI', 7, NULL, NULL, NULL),
(163, '2025-05-20', 'pengeluaran', 4950000.00, 'Perijinan', 'Ijin Tipe PW', 'BNI', NULL, NULL, '2', NULL),
(164, '2025-05-20', 'pengeluaran', 468000.00, 'Operasional', 'BPJS TK', 'BNI', NULL, NULL, '1', NULL),
(165, '2025-05-19', 'pengeluaran', 300000.00, 'Operasional', 'Untuk ongkos dimas ke metrologi hri selasa', 'SeaBank', NULL, NULL, '1', NULL),
(166, '2025-05-16', 'pengeluaran', 79200.00, 'Belanja Umum', 'Belanja modul2 tc,sd card dll', 'SeaBank', NULL, NULL, '1', NULL),
(167, '2025-05-21', 'pengeluaran', 2902500.00, 'Komisi', 'Komisi Trias PO gandum mas,ohtomi,rohto', 'SeaBank', NULL, NULL, '1', NULL),
(168, '2025-05-23', 'pemasukan', 2442000.00, 'PO Lunas', 'Invoice: I-TSU-2025-008', 'BNI', 8, NULL, NULL, NULL),
(169, '2025-05-22', 'pengeluaran', 200000.00, 'Operasional', 'bensin ke tambun dan pak firman', 'BNI', NULL, NULL, '1', NULL),
(170, '2025-05-22', 'pengeluaran', 431000.00, 'Belanja PO', 'adaptor po hirose', 'SeaBank', NULL, NULL, '1', NULL),
(171, '2025-05-18', 'pengeluaran', 200000.00, 'Operasional', 'Bensin ke Kawanishi tgl 19', 'BNI', NULL, NULL, '1', NULL),
(172, '2025-05-23', 'pengeluaran', 373700.00, 'Belanja Umum', 'tol k tmbun,akomodasi,baud,cat,breket,handtap(rembers trias)', 'SeaBank', NULL, NULL, '1', NULL),
(174, '2025-05-23', 'pengeluaran', 62983.00, 'Belanja Umum', 'Caliper dan alat2', 'SeaBank', NULL, NULL, '1', NULL),
(175, '2025-05-26', 'pengeluaran', 25000000.00, 'Pindah Buku', 'Pindah buku ke Seabank', 'BNI', NULL, NULL, '2', NULL),
(176, '2025-05-26', 'pemasukan', 25000000.00, 'Pindah Buku', 'Pindah Buku dari BNI', 'SeaBank', NULL, NULL, '2', NULL),
(177, '2025-05-26', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya Tf', 'BNI', NULL, NULL, '2', NULL),
(178, '2025-05-26', 'pengeluaran', 5586954.00, 'Perpajakan', 'PPN April 2025', 'BNI', NULL, NULL, '1', NULL),
(179, '2025-06-10', 'pemasukan', 77022900.00, 'PO Lunas', 'Invoice: I-TSU-2025-009', 'BNI', 13, NULL, NULL, NULL),
(180, '2025-02-28', 'pemasukan', 3885000.00, 'PO Lunas Pindahan', 'PO Mitra Digital PC30001\n', 'BNI', NULL, NULL, '2', NULL),
(181, '2025-02-27', 'pemasukan', 3768450.00, 'PO Lunas Pindahan', 'PO MItra Digital Indicator BP7W\n', 'BNI', NULL, NULL, '2', NULL),
(182, '2025-02-13', 'pemasukan', 51948000.00, 'PO Lunas Pindahan', 'PO Dover Chem floorscale\n', 'BNI', NULL, NULL, '2', NULL),
(183, '2025-02-11', 'pemasukan', 18344970.00, 'PO Lunas Pindahan', 'PO Karyapratama Dunia AW224 lunas 25/03\n', 'BNI', NULL, NULL, '2', NULL),
(184, '2025-02-07', 'pemasukan', 8313900.00, 'PO Lunas Pindahan', 'PO Mitra Digital PW350001 lunas 10/03\n', 'BNI', NULL, NULL, '2', NULL),
(185, '2025-01-20', 'pemasukan', 16983000.00, 'PO Lunas Pindahan', 'PO Indoglas BP7W 100K/10g @2unit Lunas 21/03\n', 'BNI', NULL, NULL, '2', NULL),
(186, '2025-01-17', 'pemasukan', 32800500.00, 'PO Lunas Pindahan', 'PO Realfood/Abadi Lestari Indonesia lunas 30/01\n', 'BNI', NULL, NULL, '2', NULL),
(187, '2025-01-15', 'pemasukan', 7381500.00, 'PO Lunas Pindahan', 'PO Mitra Digital TConnect+Printer Bluetooth lunas 14/02\n', 'BNI', NULL, NULL, '2', NULL),
(188, '2025-01-01', 'pemasukan', 28860001.00, 'PO Lunas Pindahan', 'Pemindahan PO Mayora tgl 31/10lunas 3/1/24\n', 'BNI', NULL, NULL, '2', NULL),
(189, '2025-01-01', 'pemasukan', 8491500.00, 'PO Lunas Pindahan', 'Pemindahan PO Bitzer 31/12 lunas 11/2\n', 'BNI', NULL, NULL, '2', NULL),
(190, '2025-01-01', 'pemasukan', 20259720.00, 'PO Lunas Pindahan', 'Pemindahan PO Mulia Inti Pangan 30/12 lunas 15/02\n', 'BNI', NULL, NULL, '2', NULL),
(191, '2025-01-01', 'pemasukan', 14700000.00, 'PO Lunas Pindahan', 'Pemindahan PO Interindo 12/11 lunas 15/1\n', 'SeaBank', NULL, NULL, '2', NULL),
(192, '2025-01-01', 'pemasukan', 8116875.00, 'PO Lunas Pindahan', 'Pemindahan PO Otsuka 25/11 lunas 20/1\n', 'BNI', NULL, NULL, '2', NULL),
(193, '2025-01-01', 'pemasukan', 5494500.00, 'PO Lunas Pindahan', 'Pemindahan PO Adyawinsa tgl 5/11 lunas 03/02\n', 'BNI', NULL, NULL, '2', NULL),
(194, '2025-01-01', 'pemasukan', 17616740.00, 'Modal Kas', 'Modal Kas dari 2024', 'BNI', NULL, NULL, '2', NULL),
(195, '2025-01-20', 'pengeluaran', 213719.00, 'Belanja Umum', 'EEsp, Rasberry,Modul RFID', 'SeaBank', NULL, NULL, '2', NULL),
(196, '2025-05-14', 'pengeluaran', 76500.00, 'Perpajakan', 'PPH 23 Rohto', 'BNI', NULL, NULL, '2', NULL),
(197, '2025-05-07', 'pengeluaran', 2248.00, 'Penyesuaian', '2 PO MDI Penyesuaian harga', 'BNI', NULL, NULL, '2', NULL),
(198, '2025-01-01', 'pemasukan', 5536908.60, 'Modal Kas', 'Modal Kas dari 2024', 'SeaBank', NULL, NULL, '2', NULL),
(199, '2025-05-27', 'pengeluaran', 32500.00, 'Belanja Umum', 'Stiker', 'SeaBank', NULL, NULL, '2', NULL),
(200, '2025-05-27', 'pemasukan', 59619.40, 'Bunga Bank', 'Bunga Bank SeaBank', 'SeaBank', NULL, NULL, '2', NULL),
(201, '2025-05-28', 'pengeluaran', 250000.00, 'Operasional', 'Bensin ke Sukabumi', 'BNI', NULL, NULL, '2', NULL),
(202, '2025-05-30', 'pengeluaran', 3150000.00, 'Operasional', 'Sewa Mobil', 'SeaBank', NULL, NULL, '1', NULL),
(203, '2025-05-30', 'pengeluaran', 13000000.00, 'Gaji', 'Operasional Gaji Mei', 'SeaBank', NULL, NULL, '1', NULL),
(204, '2025-06-02', 'pengeluaran', 7416207.00, 'Belanja Modal Stok', 'Belanja Import MK & JP', 'SeaBank', NULL, NULL, '2', NULL),
(205, '2025-06-02', 'pengeluaran', 1187500.00, 'Belanja PO', 'Pembayaran GMI 5 Sertif KAN', 'BNI', NULL, NULL, '2', NULL),
(206, '2025-06-02', 'pengeluaran', 2500.00, 'Admin Bank', 'Biaya TF ke GMI', 'BNI', NULL, NULL, '2', NULL),
(207, '2025-06-03', 'pengeluaran', 200000.00, 'Operasional', 'Bensin Pak Trias', 'BNI', NULL, NULL, '2', NULL),
(208, '2025-06-05', 'pengeluaran', 234765.00, 'Operasional', 'Wifi', 'SeaBank', NULL, NULL, '2', NULL),
(209, '2025-05-31', 'pengeluaran', 9491.00, 'Perpajakan', 'Potongan PPH BNI', 'BNI', NULL, NULL, '2', NULL),
(210, '2025-05-31', 'pengeluaran', 10000.00, 'Admin Bank', 'Biaya Adm BNI', 'BNI', NULL, NULL, '2', NULL),
(211, '2025-05-31', 'pengeluaran', 10000.00, 'Admin Bank', 'Biaya Adm Kartu BNI', 'BNI', NULL, NULL, '2', NULL),
(212, '2025-05-31', 'pemasukan', 47452.00, 'Bunga Bank', 'Jasa Giro/bunga BNI', 'BNI', NULL, NULL, '2', NULL),
(213, '2025-06-05', 'pengeluaran', 271000.00, 'Operasional', 'Isi ulang Galon,Tol &makan ke sukabumi,paket ke TFJ', 'SeaBank', NULL, NULL, '2', NULL),
(214, '2025-06-09', 'pengeluaran', 225008.00, 'Operasional', 'Perpanjang Domain', 'SeaBank', NULL, NULL, '2', NULL),
(215, '2025-06-06', 'pengeluaran', 37500.00, 'Operasional', 'BPJS Pak Trias', 'SeaBank', NULL, NULL, '2', NULL),
(221, '2025-06-13', 'pengeluaran', 125000.00, 'Operasional', 'Sewa motor', 'SeaBank', NULL, NULL, '1', NULL),
(227, '2025-06-14', 'pengeluaran', 200000.00, 'Operasional', 'Bensin', 'BNI', NULL, NULL, '1', NULL),
(228, '2025-06-14', 'pengeluaran', 36494.00, 'Belanja Umum', 'Soket tipeC(5),Soket rs232(5),mini360(1),multiplayer(10)', 'SeaBank', NULL, NULL, '2', NULL),
(229, '2025-06-14', 'pengeluaran', 87569.00, 'Belanja Umum', 'new paet esp32 camera cam', 'SeaBank', NULL, NULL, '2', NULL),
(230, '2025-06-16', 'pengeluaran', 2715900.00, 'Perpajakan', 'PPN Mei', 'BNI', NULL, NULL, '2', NULL),
(231, '2025-06-16', 'pengeluaran', 234500.00, 'Komisi', 'Komisi PO 017/INV/V/2025 untuk Priscilia', 'SeaBank', NULL, NULL, '1', NULL),
(232, '2025-06-16', 'pengeluaran', 400000.00, 'Komisi', 'Komisi PO 014/INV/IV/2025 untuk Priscilia D.K', 'SeaBank', NULL, NULL, '1', NULL),
(233, '2025-06-16', 'pengeluaran', 400000.00, 'Komisi', 'Komisi PO 017/INV/V/2025 non ppn untuk Priscilia D.K', 'SeaBank', NULL, NULL, '1', NULL),
(234, '2025-06-16', 'pengeluaran', 742420.00, 'Belanja PO', 'beli kertas label po gandum mas', 'SeaBank', NULL, NULL, '2', NULL),
(235, '2025-06-17', 'pengeluaran', 468000.00, 'Operasional', 'BPJS Ketenagakerjaan', 'BNI', NULL, NULL, '2', NULL),
(236, '2025-06-17', 'pemasukan', 1887000.00, 'PO Lunas', 'Invoice: I-TSU-2025-010', 'BNI', 24, NULL, NULL, NULL),
(237, '2025-06-18', 'pengeluaran', 247634.00, 'Belanja Umum', 'Alat2 listrik ruko baru', 'SeaBank', NULL, NULL, '2', NULL),
(238, '2025-06-17', 'pengeluaran', 577000.00, 'Belanja Umum', 'Paket pintu+kusen+kunci lengkap', 'SeaBank', NULL, NULL, '2', NULL),
(239, '2025-06-19', 'pengeluaran', 300000.00, 'Belanja Umum', 'Beli Materai', 'SeaBank', NULL, NULL, '2', NULL),
(240, '2025-06-19', 'pengeluaran', 127563.00, 'Operasional', 'New Module D1,Relay SV3chanel,Galon,JNT GandumMas', 'SeaBank', NULL, NULL, '2', NULL),
(241, '2025-06-21', 'pengeluaran', 200000.00, 'Operasional', 'Bensin Pa Trias', 'BNI', NULL, NULL, '1', NULL),
(242, '2025-06-23', 'pemasukan', 250000000.00, 'KUR', 'Pinjaman KUR BNI', 'BNI', NULL, NULL, '1', NULL),
(243, '2025-06-23', 'pengeluaran', 50000000.00, 'KUR', 'DP Ruko', 'BNI', NULL, NULL, '1', NULL),
(244, '2025-06-23', 'pengeluaran', 500000.00, 'KUR', 'Biaya Administrasi', 'BNI', NULL, NULL, '1', NULL),
(245, '2025-06-23', 'pengeluaran', 625000.00, 'KUR', 'Biaya Provisi', 'BNI', NULL, NULL, '1', NULL),
(246, '2025-06-23', 'pengeluaran', 547503.00, 'KUR', 'Asuransi KUR', 'BNI', NULL, NULL, '1', NULL),
(247, '2025-06-23', 'pengeluaran', 3000000.00, 'KUR', 'Biaya Akad Kur', 'BNI', NULL, NULL, '1', NULL),
(248, '2025-06-24', 'pengeluaran', 2073000.00, 'Belanja Umum', 'Material untuk renov ruko kantor', 'BNI', NULL, NULL, '1', NULL),
(249, '2025-06-23', 'pengeluaran', 2500.00, 'Admin Bank', 'biaya trf uko', 'BNI', NULL, NULL, '1', NULL),
(250, '2025-06-23', 'pengeluaran', 768970.00, 'Belanja Umum', 'CCTV kantor ruko 3 unit', 'SeaBank', NULL, NULL, '2', NULL),
(251, '2025-06-25', 'pengeluaran', 5000000.00, 'KUR', 'DP Notaris', 'BNI', NULL, NULL, '2', NULL),
(252, '2025-06-25', 'pengeluaran', 2500.00, 'Admin Bank', 'Adm DP Notaris', 'BNI', NULL, NULL, '2', NULL),
(253, '2025-06-26', 'pengeluaran', 30000000.00, 'Pindah Buku', 'Pindah Ke SeaBank', 'BNI', NULL, NULL, '2', NULL),
(254, '2025-06-26', 'pemasukan', 30000000.00, 'Pindah Buku', 'Pindah Buku dari BNI', 'SeaBank', NULL, NULL, '2', NULL),
(255, '2025-06-26', 'pengeluaran', 2500.00, 'Admin Bank', 'Adm Pindah Buku', 'BNI', NULL, NULL, '2', NULL),
(256, '2025-06-28', 'pengeluaran', 200000.00, 'Operasional', 'Bensin Pak Trias', 'BNI', NULL, NULL, '1', NULL),
(257, '2025-06-27', 'pengeluaran', 105394.00, 'Belanja Umum', 'Telepon kantor dan kabel', 'SeaBank', NULL, NULL, '1', NULL),
(258, '2025-06-27', 'pengeluaran', 22000.00, 'Belanja Umum', 'baud Ruping', 'SeaBank', NULL, NULL, '1', NULL),
(259, '2025-06-27', 'pengeluaran', 293500.00, 'Belanja Umum', 'Meja 2 unit putih', 'SeaBank', NULL, NULL, '1', NULL),
(260, '2025-06-28', 'pengeluaran', 183912.00, 'Belanja Umum', 'alat kebersihan', 'SeaBank', NULL, NULL, '1', NULL),
(261, '2025-06-28', 'pengeluaran', 420000.00, 'Belanja Umum', 'Servis Ac panasonic', 'SeaBank', NULL, NULL, '1', NULL),
(262, '2025-06-29', 'pengeluaran', 2276000.00, 'Operasional', 'Kasbon Natan tiket pesawat,potong komisi', 'SeaBank', NULL, NULL, '1', NULL),
(263, '2025-06-29', 'pengeluaran', 365500.00, 'Belanja Umum', 'kasur karyawan tiggal', 'SeaBank', NULL, NULL, '1', NULL),
(264, '2025-06-30', 'pengeluaran', 151000.00, 'Operasional', 'Bayar lalamove pindahan', 'SeaBank', NULL, NULL, '1', NULL),
(265, '2025-06-30', 'pengeluaran', 234765.00, 'Operasional', 'Internet Juni', 'SeaBank', NULL, NULL, '1', NULL),
(266, '2025-06-30', 'pengeluaran', 13000000.00, 'Gaji', 'operasional Gaji Juni', 'SeaBank', NULL, NULL, '1', NULL),
(267, '2025-07-01', 'pengeluaran', 190980.00, 'Belanja Umum', 'Meja Lipat', 'SeaBank', NULL, NULL, '1', NULL),
(268, '2025-06-29', 'pengeluaran', 300000.00, 'Operasional', 'Konsumsi', 'BNI', NULL, NULL, '1', NULL),
(269, '2025-06-26', 'pengeluaran', 878700.00, 'Operasional', 'Bayar Tukang', 'SeaBank', NULL, NULL, '2', NULL),
(270, '2025-06-28', 'pengeluaran', 3200000.00, 'Belanja Umum', 'AC Aqua 1/2 PK', 'SeaBank', NULL, NULL, '2', NULL),
(271, '2025-06-30', 'pemasukan', 99157.00, 'Bunga Bank', 'Jasa Giro/Bunga', 'BNI', NULL, NULL, '2', NULL),
(272, '2025-06-30', 'pengeluaran', 19832.00, 'Perpajakan', 'PPH BNI', 'BNI', NULL, NULL, '2', NULL),
(273, '2025-06-30', 'pengeluaran', 10000.00, 'Admin Bank', 'By Administrasi', 'BNI', NULL, NULL, '2', NULL),
(274, '2025-06-30', 'pengeluaran', 10000.00, 'Admin Bank', 'Biaya ADM Kartu', 'BNI', NULL, NULL, '2', NULL),
(275, '2025-07-01', 'pengeluaran', 1901651.00, 'Belanja Modal Stok', ' UPS', 'BNI', NULL, NULL, '2', NULL),
(276, '2025-06-29', 'pengeluaran', 7500.00, 'Admin Bank', 'Biaya ATM Link', 'BNI', NULL, NULL, '2', NULL),
(277, '2025-07-01', 'pengeluaran', 500000.00, 'Belanja Umum', 'kursi merah 4', 'SeaBank', NULL, NULL, '1', NULL),
(278, '2025-07-02', 'pengeluaran', 95350.00, 'Belanja Umum', 'kable Telpon Typ C siku L', 'SeaBank', NULL, NULL, '2', NULL),
(279, '2025-07-02', 'pengeluaran', 213000.00, 'Operasional', 'Reimbuse Dewi Beli beras 5L,kopi4R,nasi bebek3B,solasi2,baterai jam 3', 'SeaBank', NULL, NULL, '2', NULL),
(280, '2025-07-04', 'pengeluaran', 4222900.00, 'Belanja PO', 'Sojikyo SSWP-E60 2 Unit', 'BNI', NULL, NULL, '1', '2025-07-07'),
(281, '2025-07-07', 'pengeluaran', 180593.00, 'Belanja Umum', 'Meja Kerja GOTO', 'SeaBank', NULL, NULL, '2', NULL),
(282, '2025-07-08', 'pengeluaran', 31050.00, 'Belanja Umum', 'adaptor+kabel data', 'SeaBank', NULL, NULL, '2', NULL),
(283, '2025-07-08', 'pengeluaran', 219000.00, 'Belanja Umum', 'Panci Listrik', 'SeaBank', NULL, NULL, '2', NULL),
(284, '2025-07-09', 'pengeluaran', 197372.00, 'Belanja Umum', 'Lemari kantor,jam,no ruko', 'SeaBank', NULL, NULL, '2', NULL),
(285, '2025-07-09', 'pengeluaran', 146200.00, 'Belanja Umum', 'Part Teknik', 'SeaBank', NULL, NULL, '2', NULL),
(286, '2025-07-09', 'pengeluaran', 79540.00, 'Belanja Umum', 'Part Teknik dimas', 'SeaBank', NULL, NULL, '2', NULL),
(287, '2025-07-09', 'pengeluaran', 110000.00, 'Komisi', 'Komisi PO 56107 untuk Priscilia', 'SeaBank', NULL, NULL, '1', NULL),
(288, '2025-07-09', 'pengeluaran', 385000.00, 'Komisi', 'Komisi PO 33467 untuk Priscilia D.K', 'SeaBank', NULL, NULL, '1', NULL),
(289, '2025-07-09', 'pengeluaran', 360411.00, 'Komisi', 'Komisi PO By PL untuk Priscilia D.K', 'SeaBank', NULL, NULL, '1', NULL),
(290, '2025-07-08', 'pengeluaran', 250000.00, 'Operasional', 'bensin ke bandara', 'BNI', NULL, NULL, '1', NULL),
(291, '2025-07-07', 'pengeluaran', 200000.00, 'Operasional', 'Tol pP bandara', 'SeaBank', NULL, NULL, '1', NULL),
(292, '2025-07-03', 'pengeluaran', 264600.00, 'Operasional', 'Reimbuse Pak Trias', 'SeaBank', NULL, NULL, '2', NULL),
(293, '2025-07-02', 'pengeluaran', 45654.00, 'Belanja Umum', 'Tempat Sampah', 'SeaBank', NULL, NULL, '2', NULL),
(294, '2025-07-10', 'pengeluaran', 2900.00, 'Admin Bank', 'Admin Tirta Fresindo Jaya', 'BNI', NULL, NULL, '2', NULL),
(295, '2025-07-10', 'pemasukan', 27927600.00, 'PO Piutang', 'Invoice: I-TSU-2025-011', NULL, 25, NULL, NULL, NULL),
(300, '2025-07-10', 'pengeluaran', 156000.00, 'Operasional', 'Reimbuse Pak Trias', 'SeaBank', NULL, NULL, '2', NULL),
(301, '2025-07-10', 'pengeluaran', 196897.00, 'Operasional', 'Reimbuse Dewi', 'SeaBank', NULL, NULL, '2', NULL),
(304, '2025-07-10', 'pengeluaran', 125000.00, 'Operasional', 'Baterai Motor', 'SeaBank', NULL, NULL, '2', NULL),
(305, '2025-07-11', 'pengeluaran', 3469500.00, 'Komisi', 'Komisi PO 7501224963 untuk Priscilia D.K', 'SeaBank', NULL, NULL, '1', NULL),
(306, '2025-07-10', 'pengeluaran', 37500.00, 'Operasional', 'bpjs trias', 'SeaBank', NULL, NULL, '1', NULL),
(307, '2025-07-11', 'pengeluaran', 2500.00, 'Admin Bank', 'Tf ke GMI', 'BNI', NULL, NULL, '2', NULL),
(308, '2025-07-11', 'pengeluaran', 600000.00, 'Operasional', 'Sertif KAN MIP', 'BNI', NULL, NULL, '2', NULL),
(309, '2025-07-11', 'pengeluaran', 624000.00, 'Operasional', 'BPJS TK ', 'BNI', NULL, NULL, '2', NULL),
(310, '2025-07-11', 'pengeluaran', 6927105.00, 'Perpajakan', 'PPN Juni 2025', 'BNI', NULL, NULL, '2', NULL),
(311, '2025-07-16', 'pengeluaran', 2900.00, 'Admin Bank', 'Potongan Tf Gandum Mas', 'BNI', NULL, NULL, '2', NULL),
(312, '2025-07-16', 'pengeluaran', 200000.00, 'Operasional', 'Bensin Pak Trias', 'BNI', NULL, NULL, '2', NULL),
(313, '2025-07-17', 'pengeluaran', 19400.00, 'Belanja Umum', 'Gembok Kantor', 'SeaBank', NULL, NULL, '2', NULL),
(314, '2025-07-18', 'pengeluaran', 200000.00, 'Operasional', 'Toll Bandung', 'SeaBank', NULL, NULL, '1', NULL),
(315, '2025-07-18', 'pengeluaran', 172000.00, 'Operasional', 'Konsumsi rest area bandung', 'SeaBank', NULL, NULL, '1', NULL),
(316, '2025-07-18', 'pengeluaran', 200000.00, 'Operasional', 'Bensin bandung 1', 'SeaBank', NULL, NULL, '1', NULL),
(317, '2025-07-20', 'pengeluaran', 186000.00, 'Operasional', 'konsumsi meterologi', 'SeaBank', NULL, NULL, '1', NULL),
(318, '2025-07-21', 'pengeluaran', 150000.00, 'Operasional', 'toll bandung2', 'SeaBank', NULL, NULL, '1', NULL),
(319, '2025-07-19', 'pengeluaran', 250000.00, 'Operasional', 'bensin bandung 2', 'BNI', NULL, NULL, '1', NULL),
(320, '2025-07-22', 'pengeluaran', 225500.00, 'Operasional', 'konsumsi bndung 2', 'BNI', NULL, NULL, '1', NULL),
(321, '2025-07-17', 'pengeluaran', 182116.00, 'Operasional', 'Reimbuse Pak Trias- Meja Kayu', 'SeaBank', NULL, NULL, '2', NULL),
(322, '2025-07-17', 'pengeluaran', 157799.00, 'Operasional', 'Reimbuse Dewi-Trash bag,Telur,Beras,Jne', 'SeaBank', NULL, NULL, '2', NULL),
(323, '2025-07-12', 'pengeluaran', 182116.00, 'Belanja Umum', 'meja ,galon,piring dll', 'SeaBank', NULL, NULL, '1', NULL),
(324, '2025-07-23', 'pengeluaran', 200000.00, 'Operasional', 'Toll Gandum Mas', 'SeaBank', NULL, NULL, '2', NULL),
(325, '2025-07-23', 'pengeluaran', 200000.00, 'Operasional', 'Bensin Ke Gandum mas', 'BNI', NULL, NULL, '2', NULL),
(326, '2025-07-23', 'pengeluaran', 115000.00, 'Operasional', 'konsumsi Gandum mas', 'SeaBank', NULL, NULL, '2', NULL),
(327, '2025-07-24', 'pengeluaran', 30000000.00, 'Pindah Buku', 'Pindah Ke Seabank', 'BNI', NULL, NULL, '2', NULL),
(328, '2025-07-24', 'pengeluaran', 2500.00, 'Admin Bank', 'Admin pindah Buku', 'BNI', NULL, NULL, '2', NULL),
(329, '2025-07-24', 'pemasukan', 30000000.00, 'Pindah Buku', 'Dari BNI', 'SeaBank', NULL, NULL, '2', NULL),
(330, '2025-07-27', 'pengeluaran', 250000.00, 'Operasional', 'bensin ke bandung senin', 'BNI', NULL, NULL, '1', NULL),
(331, '2025-07-28', 'pengeluaran', 200000.00, 'Operasional', 'Toll bandung metrologi', 'SeaBank', NULL, NULL, '1', NULL),
(332, '2025-07-28', 'pengeluaran', 200000.00, 'Operasional', 'Konsumsi bandung', 'BNI', NULL, NULL, '1', NULL),
(333, '2025-07-25', 'pengeluaran', 47115.00, 'Belanja Umum', 'Name tag Holder', 'SeaBank', NULL, NULL, '2', NULL),
(334, '2025-07-25', 'pengeluaran', 35700.00, 'Belanja Umum', 'ID Card', 'Tunai', NULL, NULL, '2', NULL),
(335, '2025-07-28', 'pengeluaran', 2536000.00, 'Hutang', '4 unit Zemic dan 4 unit Mounting 2 ton', 'BNI', NULL, NULL, '2', '2025-08-29'),
(336, '2025-07-25', 'pengeluaran', 4833201.00, 'KUR', 'KUR Bulan Juli 2025', 'BNI', NULL, NULL, '2', NULL),
(337, '2025-07-25', 'pengeluaran', 500000.00, 'Operasional', 'bayar daftar merek', 'BNI', NULL, NULL, '2', NULL),
(338, '2025-07-24', 'pengeluaran', 660000.00, 'Operasional', 'Reimbuse Dewi Gocar,Makan,tisu,Kartu Byu,duplikat Kunci', 'SeaBank', NULL, NULL, '2', NULL),
(339, '2025-07-29', 'pengeluaran', 13594973.00, 'Belanja Modal Stok', 'Belanja MK', 'BNI', NULL, NULL, '2', NULL),
(340, '2026-05-09', 'Income', 29000000.00, 'Penjualan Produk', 'Pembayaran INV-2026-0001 dari PT CGS INDONESIA', 'Auto - Invoice Lunas', NULL, NULL, NULL, NULL),
(341, '2026-05-09', 'Income', 20.00, 'Penjualan Produk', 'Pembayaran INV-2026-0002 dari PT Citra Galvalindo', 'Auto - Invoice Lunas', NULL, NULL, NULL, NULL),
(344, '2026-05-10', 'Income', 50000.00, 'DP Invoice', 'DP INV-2026-0005 dari Allo Fresh', 'DP', NULL, NULL, NULL, NULL),
(345, '2026-05-10', 'Expense', 5000.00, 'Operasional', 'permen', 'cash', NULL, NULL, NULL, NULL),
(346, '2026-05-12', 'Income', 17000000.00, 'DP Invoice', 'DP INV-2026-0006 dari PT BUMI PASIR MANDIRI', 'DP', NULL, NULL, NULL, NULL),
(347, '2026-05-12', 'Income', 17000000.00, 'DP Invoice', 'DP INV-2026-0007 dari PT BUMI PASIR MANDIRI', 'DP', NULL, NULL, NULL, NULL),
(348, '2026-05-12', 'Income', 20500000.00, 'DP Invoice', 'DP INV-2026-0008 dari PT ARTHA TEKNIK', 'DP', NULL, NULL, NULL, NULL),
(349, '2026-05-17', 'Income', 23353750.00, 'DP Invoice', 'DP INV-2026-0009 dari CV Bhinneka niaga Jaya', 'DP', NULL, NULL, NULL, NULL),
(350, '2026-05-17', 'Income', 4500000.00, 'DP Invoice', 'DP INV-2026-0010 dari PT AISIN INDONESIA OTOMOTIF', 'DP', NULL, NULL, NULL, NULL),
(351, '2026-05-17', 'Expense', 4500000.00, 'Utang Customer (DP)', 'Sisa pembayaran INV-2026-0010 dari PT AISIN INDONESIA OTOMOTIF', 'DP', NULL, NULL, NULL, NULL),
(352, '2026-05-17', 'Income', 9000000.00, 'Penjualan Produk', 'Invoice INV-2026-0011 dari PT AISIN INDONESIA OTOMOTIF', 'Invoice', NULL, NULL, NULL, NULL),
(355, '2026-05-17', 'Income', 9000000.00, 'Penjualan Produk', 'Invoice INV-2026-0012 dari PT BUMI PASIR MANDIRI', 'Invoice', NULL, NULL, NULL, NULL),
(356, '2026-05-21', 'Income', 10700000.00, 'DP Invoice', 'DP INV-2026-0013 dari PT ALTORISHIMA PUTRA SEJAHTERA', 'DP', NULL, NULL, NULL, NULL),
(357, '2026-05-21', 'Expense', 10700000.00, 'Utang Customer (DP)', 'Sisa pembayaran INV-2026-0013 dari PT ALTORISHIMA PUTRA SEJAHTERA', 'DP', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cashflow_categories`
--

CREATE TABLE `cashflow_categories` (
  `id` int NOT NULL,
  `jenis` text COLLATE utf8mb4_general_ci NOT NULL,
  `nama` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashflow_categories`
--

INSERT INTO `cashflow_categories` (`id`, `jenis`, `nama`) VALUES
(1, 'pemasukan', 'PO Lunas'),
(3, 'pemasukan', 'PO Lunas Pindahan'),
(4, 'pengeluaran', 'Belanja PO'),
(5, 'pengeluaran', 'Admin Bank'),
(6, 'pengeluaran', 'Operasional'),
(7, 'pengeluaran', 'Belanja Modal Stok'),
(8, 'pengeluaran', 'Belanja Umum'),
(9, 'pengeluaran', 'Komisi'),
(10, 'pengeluaran', 'Pindah Buku'),
(11, 'pemasukan', 'Pindah Buku'),
(12, 'pengeluaran', 'Gaji'),
(13, 'pemasukan', 'Bunga Bank'),
(14, 'pengeluaran', 'Perpajakan'),
(15, 'pemasukan', 'Modal Kas'),
(16, 'pengeluaran', 'Penyesuaian'),
(17, 'pengeluaran', 'Perijinan'),
(18, 'pengeluaran', 'KUR'),
(19, 'pemasukan', 'KUR');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `phone` text COLLATE utf8mb4_general_ci,
  `email` text COLLATE utf8mb4_general_ci,
  `pic_name` text COLLATE utf8mb4_general_ci,
  `pic_phone` text COLLATE utf8mb4_general_ci,
  `pic_email` text COLLATE utf8mb4_general_ci,
  `created_by` int DEFAULT NULL,
  `npwp` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `phone`, `email`, `pic_name`, `pic_phone`, `pic_email`, `created_by`, `npwp`) VALUES
(1, 'PT GANDUM MAS KENCANA', 'Jl. Galeong No.km.3, RT.002/RW.008, Margasari, Kec. Karawaci, Kota Tangerang, Banten 15113', NULL, NULL, 'Ibu Eriza/Ibu Mirna/Bpk Giman', '+62 811-1209-063/ +62896 6652 3181', 'eriza.septiani@gandummas.co.id/ mirna.rachmawati@gandummas.co.id', 3, '0013971106415000'),
(2, 'Bapak David', '-', NULL, NULL, '-', '0895410260445', '-', 3, NULL),
(3, 'PT MITRA DIGITAL INSTRUMENTASI', 'Ruko D Green Square,Jl.Zamrud Sel.No.10\nBlok E25,Cimuning,Bekasi-Jawa Barat', NULL, NULL, 'Bpk.Firman', '-', '-', 3, '0438502080413000'),
(4, 'PT Rohto Laboratories', 'Jl. Raya Cimamere No.203, Padalarang 40552 Bandung Barat,Indonesia.', NULL, NULL, 'Ibu Fransisca', '-', '-', 3, '0010714525052000'),
(7, 'PT SARI MELATI KENCANA', 'Pasirranji, Kec. Cikarang Pusat, Kabupaten Bekasi, Jawa Barat 17530', NULL, NULL, 'Bpk.Sandra', '082129514199', 'sandra.gunawan@Pizzahut.co.id', 3, '04002500136365037'),
(8, 'Allo Fresh', 'Jalan Raya 12', NULL, NULL, 'Ibu Ajirni', '-', '-', 2, NULL),
(9, 'PT ANGGAROWATI KENCANA', 'Ruko Cempaka Mas Blok J No.16\nJakarta Pusat', NULL, NULL, 'Bpk.David', '0895 4102 60445', '-', 1, NULL),
(11, 'PT HIROSE ELECTRIC INDONESIA', 'EJIP Industrial park Plot3b-1\nSukaresmi,Cikarang Selatan\nKab.Bekasi-Jawa Barat', NULL, NULL, 'Bp Arif Rahman', '', '', 3, ''),
(12, 'PT TIRTA FRESINDO JAYA', 'JL.DAAN MOGOT KM 18.Kalideres,Kalideres\nKota Adm.Jakarta Barat,DKI JAKARTA,11840', NULL, NULL, 'Ibu Joya', '0878 2138 3788', 'joya.angelica@mayora.co.id', 3, '0017371030038000'),
(13, 'PT MURNI JAYA KIAN ABADI', '-', NULL, NULL, 'Bpk.Achmad', '-', 'murnijayakianabadi@gmail.com', 3, NULL),
(14, 'PT KANEMATSU KGK INDONESIA', '-', NULL, NULL, 'Bpk.Arif', '08118181295', '-', 3, NULL),
(15, 'PT SURYA FAJA PRATAMA', '-', NULL, NULL, 'Ibu Ella', '081315507334', '-', 3, NULL),
(16, 'PT ORSON INDONESIA', '-', NULL, NULL, 'Ibu Lisa', '+62 857-7937-1546', '-', 3, NULL),
(17, 'PT FOSROC INDONESIA', 'Delta Silicon Industrial Park, Lippo, Jl. Akasia II Blok A8 No.1, Sukaresmi, Cikarang Sel', NULL, NULL, 'Bpk.Guntur', '-', '-', 3, ''),
(18, 'PT CGS INDONESIA', '-', NULL, NULL, 'Ibu Mila', '087883951540', 'purchase@cgsindonesia.co.id', 3, NULL),
(19, 'PT TERAS NIAGA INDONESIA', '', NULL, NULL, 'Bp Ardiansyah', '08111359900', '', 3, NULL),
(20, 'Eatwel Culinary', '', NULL, NULL, 'Pak Yudha', '', '', 2, NULL),
(21, 'PT DWARA NUR ABADI', '', NULL, NULL, 'Bp Oki Delani', '081389643637', '', 3, NULL),
(22, 'RBFOOD MANUFAKTUR INDONESIA', '', NULL, NULL, 'Bu Sri Handayani', '', 'srihandayani@rbfindonesia.co.id', 2, NULL),
(23, 'PT MULIA BOGA RAYA', '-', NULL, NULL, 'Bpk.Arif', '085691388300', '-', 3, NULL),
(25, 'PT TRI BAKTI', '', NULL, NULL, 'Anggi Ardiansyah', '081295150751', '', 3, NULL),
(26, 'PT. KH Roberts Indonesia', '', NULL, NULL, 'Ardiansyah', '0895423193322', '', 4, NULL),
(27, 'PT ARTHA TEKNIK', '-', NULL, NULL, 'Bpk.Eko', '08123012582', '-', 1, NULL),
(28, 'PT SOLUSI COMMERCIAL ALKESINDO', 'Jl.Radio Dalam Raya No.8\nGandaria Utara,Jakarta Selatan', NULL, NULL, 'INDRAYANA KURNIAWAN', '081382626526', '', 4, ''),
(29, 'PT DIMAS SEJAHTERA SELAMANYA', '', NULL, NULL, 'PAK DIMAS', '', '', 2, NULL),
(30, 'PT BUMI PASIR MANDIRI', '', NULL, NULL, 'pebriani Sidabutar', '082169477547', '', 3, NULL),
(31, 'PT WAHANA CITRA NABATI', '', NULL, NULL, 'Ibu Femmy', '081807068991', '', 3, NULL),
(32, 'PT ROMINDO PRIMAVETCOM', '-', NULL, NULL, 'Bpk.Yusuf', '081316603901', '-', 3, NULL),
(33, 'PT AISIN INDONESIA OTOMOTIF', '', NULL, NULL, 'Ibu Hamida Utami', '081321422274', '', 3, NULL),
(34, 'PT ASIA PANGAN SEJAHTERA', '-', NULL, NULL, 'Bpk.anang', '082221877708', '-', 3, NULL),
(35, 'PT Indoglass', '-', NULL, NULL, 'Bpk.andi', '081808855590', '-', 3, NULL),
(36, 'PT MEPROFARM', '-', NULL, NULL, 'Ibu Sela Eveline/ Pak Willy', '085646850184', '-', 3, ''),
(37, 'PT KANEKA FOOD', '-', NULL, NULL, 'Bpk.Hardiriy', '08111180948', '-', 3, NULL),
(38, 'PT Y-TEC AUTOPARTS INDONESIA', '-', NULL, NULL, 'Bpk.Sigit', '085717228335', '-', 3, NULL),
(39, 'Pak Dedi', '', NULL, NULL, 'Pak Dedi', '+62 812-9773-3079', '', 2, NULL),
(40, 'Pak Hendra', '', NULL, NULL, 'Pak Hendra', '085319126258', '', 2, NULL),
(41, 'PT MITRA MULTI TEKNOMEDIKA', '', NULL, NULL, 'Christopher Calvin', '081517066200', '', 2, NULL),
(42, 'PT MENARA TERUS MAKMUR', 'Jl Jababeka XI Kawasan Industri Jababeka No.12,Blok H3, 17530', NULL, NULL, 'Pak Rahmat', '081387037364', '', 2, NULL),
(43, 'PT TIARA ANUGERAH LESTARI', 'Jl. Cengkeh 2 No.23K Sako, Palembang, Sumatera Selatan', NULL, NULL, 'Pak Pirman Azazi', '081273036866', '', 3, NULL),
(44, 'PT KARYA DUA PRATAMA', 'KOMP DEPAG No.9 BLOK. E, RT.001/RW.007, Kec. Cipocok Jaya, Kota Serang, Banten 42121', NULL, NULL, 'Pak M.Fajar Fadillah', '0811081779779', 'admin@kdpratama.com', 3, ''),
(45, 'PT MULIA INTI PANGAN', 'Kawasan Industri Candi Blok D Kav.2 \nKel. Ngaliyan, Kec. Ngaliyan, \nKota Semarang, Prov Jawa Tengah 50181', NULL, NULL, 'Ibu Kautsar', '0852255833346', '', 3, '92.559.749.4.017.000'),
(46, 'PT HINOMOTO INDONESIA', '', NULL, NULL, 'Ibu Desi', '085691716198', '', 2, NULL),
(47, 'PT INTRA ARIES SENTOSA', '-', NULL, NULL, 'Ms.Fildia', '081363319198', '-', 3, NULL),
(48, 'STT PU', 'Sekolah Tinggi Teknologi Pekerjaan Umum', NULL, NULL, 'Pak M.Armin', '085883402527', '', 2, NULL),
(49, 'PT HORIZON', '', NULL, NULL, 'Frenky', '+62 813-1600-6126', '', 2, NULL),
(50, 'PT INASETRA', '', NULL, NULL, 'Bp Ahmad', '085210146422', '', 3, NULL),
(51, 'PT INDO TIRTA ABADI', '', NULL, NULL, 'Bu Ida', '085651175057', '', 3, NULL),
(52, 'PT Sinar jaya', NULL, NULL, NULL, 'Bpk.Christofel', '081119034347', '', 3, NULL),
(53, 'PT ALTORISHIMA PUTRA SEJAHTERA', '-', NULL, NULL, 'Ibu Meri', '085288983638', 'roulisihombing6@gmail.com', 1, NULL),
(54, 'PT CONBLOC INTERNUSA', '', NULL, NULL, 'Bp Saputra', '081314666165', 'saputra@conbloc.com', 3, ''),
(55, 'PT SEMEN GROBOGAN', '', NULL, NULL, 'Bapak Roni', '', '', 3, NULL),
(56, 'PT GLOBAL INTAN TEKNINDO', '', NULL, NULL, 'Bp Ihsan Arfah', '+62 882-2564-6272', '', 3, NULL),
(57, 'PT Maesindo', '', NULL, NULL, 'Bp Dani', '62 813-8604-1825', '', 3, NULL),
(58, 'PT NIKKI SUPER TOBACO', '', NULL, NULL, 'Bp Deddy', '085725200390', '', 3, ''),
(59, 'PT ELSEWEDY ELECTRIC INDONESIA', '', NULL, NULL, 'Bp Mei Anang', '085647026926', '', 3, NULL),
(60, 'PT WONOKOYO GROUP', '', NULL, NULL, 'Bp. Rudi', '081332972001', '', 3, NULL),
(61, 'PT Lumbung Pangan', '-', NULL, NULL, 'Ibu Heni', '-', '-', 1, NULL),
(62, 'PT MITRA MAS PERKASA', '-', NULL, NULL, 'Ibu Nia', '081324247570', '-', 1, NULL),
(63, 'Toko Citra Timbangan', '', NULL, NULL, 'Bpk Jamal', '+62 812-9061-87', '', 3, NULL),
(64, 'PT KALTIM JAYA BARA', 'Berau, Kalimantan Timur', NULL, NULL, 'Ibu Maramaretha', '085959598538', 'maramaretha.aurorel@admire-corporation.com', 2, NULL),
(65, 'PT SUNWAY TREK MASINDO', '', NULL, NULL, 'Bpk. Rio', '+62 812-2584-0852', '', 3, NULL),
(66, 'PT Tirta Fresindo Jaya Plant Pandeglang', '', NULL, NULL, 'Bpk. Andi Atnatias', '081280756940', '', 3, NULL),
(67, 'PT BERKAT MITRA USAHA ABADI', '', NULL, NULL, 'Bpk. Hendri', '081288890155', '', 3, NULL),
(68, 'PT Citra Galvalindo', '-', NULL, NULL, 'Bpk.Suyitno', '+62 812-1323-5906', '-', 1, NULL),
(69, 'CV Bhinneka niaga Jaya', 'asjdasjdsa', NULL, NULL, 'Ibu anya', '081281249798', '', 3, NULL),
(70, 'PT GUNA LAYAN KUASA', '-', NULL, NULL, 'Ibu Lisa', '081514025252', '-', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_notes`
--

CREATE TABLE `delivery_notes` (
  `id` int NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `invoice_id` int NOT NULL,
  `date` date NOT NULL,
  `pic_name` text COLLATE utf8mb4_general_ci,
  `pic_phone` text COLLATE utf8mb4_general_ci,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `po_number` text COLLATE utf8mb4_general_ci,
  `notes` text COLLATE utf8mb4_general_ci,
  `serial_numbers` text COLLATE utf8mb4_general_ci,
  `has_stock_deducted` int DEFAULT '0',
  `shipping_address` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_notes`
--

INSERT INTO `delivery_notes` (`id`, `number`, `invoice_id`, `date`, `pic_name`, `pic_phone`, `status`, `po_number`, `notes`, `serial_numbers`, `has_stock_deducted`, `shipping_address`) VALUES
(1, 'DO-TSU-202505-1', 1, '2025-05-13', 'Bpk.Herman', '098', 'Terkirim', 'PO25002627-2', 'Include Dokumen penagian\n', 'PZ\n', 1, NULL),
(3, 'DO-TSU-202505-2', 6, '2025-05-15', 'Bapak Sandra', '082129514199', 'Terkirim', '33467', 'Include Dokumen Penagihan( Faktur Pajak, DO, Invoice, PO)\n', 'A230425014, A230425011\n', 1, NULL),
(4, 'DO-TSU-202505-3', 7, '2025-05-19', 'Bpk.Firman', '-', 'Terkirim', 'By PL', '\n', 'PZ02004\n', 1, 'Ruko D Green Square,Jl.Zamrud Sel.No.10\nBlok E25,Cimuning,Bekasi-Jawa Barat'),
(5, 'DO-TSU-202505-4', 8, '2025-05-23', 'Bpk.Arif', '08111148191', 'Terkirim', '56107', 'Tipe TB289', '2424HB', 1, 'EJIP Industrial park Plot3b-1\nSukaresmi,Cikarang Selatan\nKab.Bekasi-Jawa Barat'),
(6, 'DO-TSU-202505-5', 13, '2025-05-28', 'Ibu Sarita (QC Dept)', '', 'Terkirim', '7501224963', 'Include Sertifikat KAN', 'PZ022001\nPZ02005,PZ02006,PZ02007,PZ02008', 1, 'JL Raya Sukabumi, Desa Muara Caringin-Bogor'),
(7, 'DO-TSU-202506-6', 24, '2025-06-17', 'Mirna', '089666523181', 'Terkirim', ' PO No. PO25004259-2', '\n', '\n', 1, 'Jl. Galeong No.km.3, RT.002/RW.008, Margasari, Kec. Karawaci, Kota Tangerang, Banten 15113'),
(8, 'DO-TSU-202507-7', 25, '2025-07-10', 'Pak Triyono ', '', 'Terkirim', '250.700.004', '\n', 'PZ01046,PZ01047\n', 1, 'Komplek Gudang Diamond \nCipta Niaga Kav. 21C, Jl. Arteri Yos \nSudarso, Semarang'),
(9, 'tnjpj4f', 32, '2026-05-05', 'knfpwoe', 'rmf[3r', 'Delivered', 'kf3pmr3r', NULL, 'mfprf', 0, 'lwe;rfml\'er'),
(10, 'asdasd', 33, '2026-05-08', 'ASDASD', '9128391283', 'Delivered', '201931', NULL, '1293812983', 1, 'mkSKCIAJSNCisc'),
(11, 'SJ-2026-0001', 38, '2026-05-10', 'ALUR', '8768574874885', 'Delivered', NULL, NULL, NULL, 0, 'JL.DANmagot'),
(12, 'SJ-2026-0002', 42, '2026-05-17', 'asdasd', '123123', 'In Transit', NULL, NULL, NULL, 0, NULL),
(13, 'SJ-2026-0003', 45, '2026-05-17', NULL, NULL, 'Delivered', NULL, NULL, NULL, 0, NULL),
(14, 'SJ-2026-0004', 46, '2026-05-21', 'udin', '13123', 'Delivered', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `quotation_id` int NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Belum Bayar',
  `payment_terms` text COLLATE utf8mb4_general_ci,
  `po_number` text COLLATE utf8mb4_general_ci,
  `notes` text COLLATE utf8mb4_general_ci,
  `revision` int DEFAULT '0',
  `total` decimal(15,2) DEFAULT '0.00',
  `dp_percentage` int DEFAULT NULL,
  `non_vat` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `number`, `quotation_id`, `date`, `due_date`, `status`, `payment_terms`, `po_number`, `notes`, `revision`, `total`, `dp_percentage`, `non_vat`) VALUES
(1, 'I-TSU-2025-001', 1, '2025-05-13', '2025-05-06', 'Lunas 21/05/2025', '30 days', 'PO25002627-2', NULL, 0, 49062000.00, NULL, 0),
(2, 'I-TSU-2025-002', 6, '2025-05-14', '2025-06-12', 'Lunas 12/06/2025', '30 days', '017/INV/V/2025', NULL, 0, 5205900.00, NULL, 0),
(3, 'I-TSU-2025-003', 24, '2025-05-14', '2025-06-07', 'Lunas 05/06/2025', '30 days', '017/INV/V/2025 non ppn', NULL, 0, 8000000.00, NULL, 1),
(4, 'I-TSU-2025-004', 4, '2025-05-14', '2025-05-14', 'Lunas', '30 days', '015/INV/IV/2025', NULL, 0, 4162500.00, NULL, 0),
(5, 'I-TSU-2025-005', 3, '2025-05-14', '2025-05-23', 'Lunas 22/05/2025', '30 days', '014/INV/IV/2025', NULL, 0, 8880000.00, NULL, 0),
(6, 'I-TSU-2025-006', 23, '2025-05-15', '2025-06-14', 'Lunas 19/06/2025', '30 days', '33467', NULL, 0, 8547000.00, NULL, 0),
(7, 'I-TSU-2025-007', 28, '2025-05-17', '2025-06-17', 'Lunas 17/06/2025', '30 days', 'By PL', NULL, 0, 8000000.00, NULL, 1),
(8, 'I-TSU-2025-008', 27, '2025-05-23', '2025-06-23', 'Lunas 01/07/2025', '30 days', '56107', NULL, 0, 2442000.00, NULL, 0),
(13, 'I-TSU-2025-009', 34, '2025-06-10', '2025-07-10', 'Lunas 10/07/2025', '30 days', '7501224963', NULL, 0, 77022900.00, NULL, 0),
(24, 'I-TSU-2025-010', 70, '2025-06-17', '2025-07-17', 'Lunas 17/07/2025', '30 days', ' PO No. PO25004259-2', '', 0, 1887000.00, NULL, 0),
(25, 'I-TSU-2025-011', 131, '2025-07-10', '2025-08-10', 'Belum Bayar', '30 days', '250.700.004', NULL, 0, 27927600.00, NULL, 0),
(32, 'ojdwjod', 172, '2026-05-05', '2026-05-31', 'Lunas', NULL, NULL, NULL, 0, NULL, NULL, 0),
(33, 'QRUASRA', 173, '2026-05-08', '2026-05-09', 'Lunas', NULL, NULL, NULL, 0, NULL, NULL, 1),
(34, 'INV-2026-0001', 174, '2026-05-15', '2026-05-10', 'Dibatalkan', NULL, NULL, NULL, 0, NULL, NULL, 0),
(35, 'INV-2026-0002', 175, '2026-05-09', '2026-05-10', 'Lunas', NULL, NULL, NULL, 0, 20.00, NULL, 0),
(36, 'INV-2026-0003', 177, '2026-05-09', '2026-05-09', 'Dibatalkan', NULL, NULL, NULL, 0, 200000.00, NULL, 1),
(37, 'INV-2026-0004', 178, '2026-05-10', '2026-05-10', 'Dibatalkan', NULL, NULL, NULL, 0, 300000.00, NULL, 1),
(38, 'INV-2026-0005', 179, '2026-05-10', '2026-05-10', 'DP', NULL, NULL, NULL, 0, 50000.00, NULL, 0),
(39, 'INV-2026-0006', 180, '2026-05-12', '2026-05-12', 'DP', NULL, NULL, NULL, 0, NULL, NULL, 1),
(40, 'INV-2026-0007', 180, '2026-05-12', '2026-05-12', 'DP', NULL, NULL, NULL, 0, NULL, NULL, 0),
(41, 'INV-2026-0008', 181, '2026-05-12', '2026-05-12', 'DP', NULL, NULL, NULL, 0, 20500000.00, NULL, 0),
(42, 'INV-2026-0009', 182, '2026-05-17', '2026-05-17', 'DP', NULL, NULL, NULL, 0, 23353750.00, 50, 0),
(43, 'INV-2026-0010', 183, '2026-05-17', '2026-05-17', 'DP', NULL, NULL, NULL, 0, 4500000.00, 50, 1),
(44, 'INV-2026-0011', 183, '2026-05-17', '2026-05-17', 'Lunas', NULL, NULL, NULL, 0, 9000000.00, NULL, 0),
(45, 'INV-2026-0012', 184, '2026-05-17', '2026-05-17', 'Lunas', NULL, NULL, NULL, 0, 9000000.00, 50, 0),
(46, 'INV-2026-0013', 185, '2026-05-21', '2026-05-21', 'DP', NULL, NULL, NULL, 0, 10700000.00, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_17_083432_add_dp_percentage_to_invoices_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `price`, `stock`, `description`) VALUES
(1, 'PK1200', 'PK1200', 7205000.00, 0, 'PRECISION BALANCE\nkap :1000g, d: 0.1 g, pan size : 170 x 170mm\nBrand : PRECIZIO(Germany)\n\n'),
(2, 'PK2200', 'PK2200', 7810000.00, 0, 'PRECISION BALANCE\nKap : 2000g, d: 0.01g, pan size: 170 x 170 mm\nBrand : PRECIZIO(Germany)\n'),
(3, 'PK3200', 'PK3200', 9075000.00, 0, 'PRECISION BALANCE\nKap: 3000g, d: 0.01g, pan size: 170 x 170mm\nBrand: PRECIZIO(Germany)\n'),
(4, 'PK4200', 'PK4200', 12430000.00, 0, 'PRECISION BALANCE\nKap: 4000g, d:0.01g, pan size: 170 x 170mm\nBrand: PRECIZIO(Germany)\n'),
(5, 'PK5200', 'PK5200', 14850000.00, 0, 'PRECISION BALANCE\nKap: 5000g, d: 0.01g, pan size: 170 x 170mm\nBrand: PRECIZIO(Germany)\n'),
(6, 'PK6200', 'PK6200', 17050000.00, 0, 'PRECISION BALANCE\nKap: 6000g, d: 0.01g, pan size: 170 x 170mm\nBrand: PRECIZIO(Germany)\n'),
(7, 'PH1201', 'PH1201', 6500000.00, 0, 'PRECISION BALANCE\nCap 1200g d:0.01g, pan size:195 x195mm\nBrand: PRECIZIO(Germany)\n\n'),
(8, 'PH2201', 'PH2201', 6750000.00, 0, 'PRECISION BALANCE\nKap:2200g, d: 0.01g, pan size: 195 x195mm\nBrand: PRECIZIO(Germany)\n'),
(9, 'PH3201', 'PH3201', 7000000.00, 0, 'PRECISION BALANCE\nKap:1000g, d:0.01g, Pan size: 195 x195mm\nBrand: PRECIZIO(Germany)\n\n'),
(10, 'PH4201', 'PH4201', 9500000.00, 0, 'PRECISION BALANCE\nKap:4200g, d:0.1g,  pan size: 195 x 195mm\nBrand PRECIZIO(Germany)\n\n'),
(11, 'PH5201', 'PH5201', 9700000.00, 0, 'PRECISION BALANCE\nKap:5200g, d:0.1g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(12, 'PH6201', 'PH6201', 9800000.00, 0, 'PRECISION BALANCE\nKap:6200g,d: 0.1g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(13, 'PH8201\n', 'PH8201\n', 10200000.00, 0, 'PRECISION BALANCE\nKap:8200g d:0.1g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(14, 'PH10001\n', 'PH10001\n', 10500000.00, 0, 'PRECISION BALANCE\nCap10000g d:0.1g, pan size:195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n\n'),
(15, 'PH1202\n', 'PH1202\n', 8500000.00, 0, 'PRECISION BALANCE\nKap:1200g, d:0.01g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(16, 'PH2202\n', 'PH2202\n', 9500000.00, 0, 'PRECISION BALANCE\nKap:2200g, d:0.01g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(17, 'PH3202\n', 'PH3202\n', 11400000.00, -5, 'PRECISION BALANCE\nKap:3200g, d:0.01g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(18, 'PH4202\n', 'PH4202\n', 11800000.00, 0, 'PRECISION BALANCE\nKap:4200g, d: 0.01g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(19, 'PH5202\n', 'PH5202\n', 1320000.00, 0, 'PRECISION BALANCE\nKap:5200g, d: 0.01g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(20, 'PH6202\n', 'PH6202\n', 13500000.00, 0, 'PRECISION BALANCE\nKap:6200g, d: 0.01g, pan size: 195 x 195mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(21, 'PH8202\n', 'PH8202\n', 17500000.00, 0, 'PRECISION BALANCE\nKap:8200g, d: 0.01g,pan size: 195 x 195mm\n Brand: PRECIZIO(Germany)\n\n\n'),
(22, 'PH220\n', 'PH220\n', 9700000.00, 0, 'PRECISION BALANCE\nKap:220g, d: 0.01g, pan size 135mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(23, 'PH320\n', 'PH320\n', 10000000.00, 0, 'PRECISION BALANCE\nKap:320g, d: 0.01g, pan size 135mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(24, 'PH520\n', 'PH520\n', 10500000.00, 0, 'PRECISION BALANCE\nKap:520g, d: 0.001g, pan size 135mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(25, 'PR620\n', 'PR620\n', 5500000.00, 0, 'PRECISION BALANCE\nKap:620g, d: 0.01g, pan size: 180 x 155mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(26, 'PR1200\n', 'PR1200\n', 7500000.00, 0, 'PRECISION BALANCE\nKap:1200g, d: 0.01g, 1200g x 0.01g\nBrand: PRECIZIO(Germany)\n\n\n'),
(27, 'PR2200\n', 'PR2200\n', 7500000.00, 0, 'PRECISION BALANCE\nKap:2200g, d: 0.01g, pan size: 180 x 155mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(28, 'PR3200\n', 'PR3200\n', 8100000.00, 0, 'PRECISION BALANCE\nKap:3200g, d: 0.01g, pan size: 180 x 155mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(29, 'PR3002\n', 'PR3002\n', 8100000.00, 0, 'PRECISION BALANCE\nKap:3kg, d: 0.01g, pan size: 180 x 155mm\nBrand: PRECIZIO(Germany)\n\n\n'),
(30, 'FLOORSCALE BP7W', 'BP7W', 46707500.00, 1, 'SINGLE FRAME + TCONNECT PRINTER\r\nKap 2 Ton d:0.5kg, Plat: 1,2 x 1,3 with ram,include Roda\r\nInclude KAN, Brand: PRECIZIO'),
(31, 'BP7W', 'BP7W 30KD', 9000000.00, 1, 'PLATFORM SCALE\nKap 30kg d:1g,Pan size:30x40cm\nInclude KAN,Brand: Precizio\n\n\n'),
(32, 'Custom 1', 'PW4001', 7500000.00, 0, 'WEIGHING SCALE Include KAN\nCap 4Kg d:0.1g(0.0001kg)\nPan size:275x230mm Brand:Precizio\n'),
(33, 'AW224E\n', 'AW224E\n', 26500000.00, 0, 'ANALITICAL BALANCE\nCap 220g d:0.0001g,pan size: 80mm\nBrand: PRECIZIO\n\n'),
(34, 'BP7W KD 2', 'BP7W 30KD', 11000000.00, 0, 'PLATFORM SCALE\nCap 30kg d:2g, pan size 30x40cm\nBrand: PRECIZIO\n\n\n\n'),
(36, 'BP7W 300K', 'BP7W 300K', 8250000.00, 0, 'PLATFORM SCALE\nCap 300kg d:10g, pan size:40x50cm\nBrand: PRECIZIO\n\n\n'),
(37, 'BP7W 150K\n', 'BP7W 150K\n', 7000000.00, 0, 'PLATFORM SCALE\nCap 150kg d:10g, pan size:40x50cm\nBrand: PRECIZIO\n'),
(38, 'BP7W 100K\n', 'BP7W 100K\n', 5830000.00, 0, 'PLATFORM SCALE\nCap 100kg d:5g, Pan size:30x40cm\nBrand: PRECIZIO\n\n'),
(39, 'BP7W 60K \n', 'BP7W 60K ', 5830000.00, 0, 'PLATFORM SCALE\nCap 60kg d:5g, Pan size:30x40cm\nBrand: PRECIZIO\n'),
(40, 'BP7W 30K', 'BP7W 30K', 5830000.00, 0, 'PLATFORM SCALE\nCap 30kg d:5g,Pan size 30x40cm\nBrand: PRECIZIO\n\n'),
(41, 'BP7W 150KD\n', 'BP7W 150KD\n', 11000000.00, 0, 'PLATFORM SCALE\nCap 150kg d:2g, Pansize 40x50cm \nBrand: PRECIZIO\n\n'),
(42, 'BP7W 100KD\n', 'BP7W 100KD\n', 9000000.00, 0, 'PLATFORM SCALE\nCap 100kg d:1g, Pansize 30x40cm\nBrand: PRECIZIO\n\n'),
(43, 'BP7W 60KD 1\n', 'BP7W 60KD1\n', 11000000.00, 0, 'PLATFORM SCALE\nCap 60kg d:1g, Pan size 30x40cm\nBrand: PRECIZIO\n'),
(44, 'BP7W 60KD \n2', 'BP7W 60KD2\n', 9000000.00, 0, 'PLATFORM SCALE\nCap 60kg d:2g, Pansize 30x40cm\nBrand: PRECIZIO\n\n'),
(45, 'BP7C 300K\n', 'BP7C 300K\n', 8750000.00, 0, 'COUNTING SCALE\nCap 300kg d:10g, Pan size 40x50cm\nBrand: PRECIZIO\n\n'),
(46, 'BP7C 150K\n', 'BP7C 150K\n', 7500000.00, 0, 'COUNTING SCALE\nCap 150kg d:10g, Pan size 40x50cm\nBrand: PRECIZIO\n\n'),
(47, 'BP7C 100K\n', 'BP7C 100K\n', 6330000.00, 0, 'COUNTING SCALE\nCap 100kg d:5g, Pan size 30x40cm\nBrand: PRECIZIO\n\n'),
(48, 'BP7C 60K \n', 'BP7C 60K\n', 6330000.00, 0, 'COUNTING SCALE\nCap 60kg d:5g, Pan size 30x40cm\nBrand: PRECIZIO\n\n'),
(49, 'BP7C 30K\n', 'BP7C 30K\n', 6330000.00, 0, 'COUNTING SCALE\nCap 30kg d:5g, Pan size 30x40cm\nBrand: PRECIZIO\n\n'),
(50, 'BP7C 150KD\n', 'BP7C 150KD\n', 11500000.00, 0, 'COUNTING SCALE\nCap 150kg d:2g, Pan size 40x50cm\nBrand: PRECIZIO\n\n'),
(51, 'BP7C 100KD\n', 'BP7C 100KD\n', 9500000.00, 0, 'COUNTING SCALE\nCap 100kg d:1g, Pansize 30x40cm\nBrand: PRECIZIO\n\n'),
(52, 'BP7C 60KD\n', 'BP7C 60KD\n', 9500000.00, 0, 'COUNTING SCALE\nCap 60kg d:1g, Pansize 30x40cm\nBrand: PRECIZIO\n\n'),
(53, 'BP7C 30KD\n', 'BP7C 30KD\n', 9500000.00, 0, 'COUNTING SCALE\nCap 30kg d:1g, Pansize 30x40cm\nBrand: PRECIZIO\n\n'),
(54, 'BP7W-1T\n\n', 'BP7W-1T\n\n', 19500000.00, 0, 'FLOOR SCALE SINGLE FRAME\nCap 1000kg d:0.5kg,platform size:120x120cm\n Brand: PRECIZIO\n\n\n\n'),
(55, 'BP7W-2T\n\n', 'BP7W-2T\n\n', 20500000.00, 0, 'FLOOR SCALE SINGLE FRAME\nCap 2000kg d:0.5kg,platform size:120x120cm\nBrand: PRECIZIO\n\n\n\n'),
(56, 'BP7W-3T\n\n', 'BP7W-3T\n\n', 23500000.00, 0, 'FLOOR SCALE SINGLE FRAME\nCap 3000kg d:1kg,platform size:150x150cm\nBrand: PRECIZIO\n\n\n\n'),
(57, 'PW3025\n', 'PW3025\n', 8500000.00, 0, 'WEIGHING SCALE\nCap 3kg d:0.05g,pan size:275x230mm\n Brand: Precizio\n'),
(58, 'PW3001\n', 'PW3001\n', 5500000.00, 0, 'WEIGHING SCALE\nCap 3kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n'),
(59, 'PW6001\n', 'PW6001\n', 6490000.00, 0, 'WEIGHING SCALE\nCap 6kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n'),
(60, 'PW10001\n', 'PW10001\n', 8250000.00, 0, 'WEIGHING SCALE\nCap 10kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n'),
(61, 'PW15001\n', 'PW15001\n', 9570000.00, 0, 'WEIGHING SCALE\nCap 15kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n'),
(62, 'PW30001\n', 'PW30001\n', 10120000.00, 0, 'WEIGHING SCALE\nCap 30kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n'),
(63, 'PW35001\n', 'PW35001\n', 10700000.00, 0, 'WEIGHING SCALE\nCap 35kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n'),
(64, 'PW6002\n', 'PW6002\n', 5280000.00, 0, 'WEIGHING SCALE\nCap 6kg d:0.2g, pan size:275x230mm\nBrand: Precizio\n'),
(65, 'PW15002\n', 'PW15002\n', 5280000.00, 0, 'WEIGHING SCALE\nCap 15kg d:0.2g, pan size:275x230mm\nBrand: Precizio\n'),
(66, 'PW30002\n', 'PW30002\n', 5280000.00, 0, 'WEIGHING SCALE\nCap 30kg d:0.2g, pan size:275x230mm\nBrand: Precizio\n'),
(67, 'PW30005\n', 'PW30005\n', 4950000.00, 0, 'WEIGHING SCALE\nCap 30kg d:0.5g, pan size:275x230mm\nBrand: Precizio\n'),
(68, 'PW15005\n', 'PW15005\n', 4950000.00, 0, 'WEIGHING SCALE\nCap 15kg d:0.5g, pan size:275x230mm\nBrand: Precizio\n'),
(69, 'PW30000\n', 'PW30000\n', 4950000.00, 0, 'WEIGHING SCALE\nCap:30kg d:1g, pan size:275x230mm\nBrand: Precizio\n'),
(70, 'PW40000\n', 'PW40000\n', 4950000.00, 0, 'WEIGHING SCALE\n40kg x 1g, pan size:275x230mm\nBrand: Precizio\n'),
(71, 'PC3025\n', 'PC3025\n', 5830000.00, 0, 'COUNTING SCALE\nCap 3kg d:0.05g, pan size:275x230mm\nBrand: Precizio\n\n'),
(72, 'PC3001\n', 'PC3001\n', 5390000.00, 0, 'COUNTING SCALE\nCap 3kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n\n'),
(73, 'PC6001\n', 'PC6001\n', 6930000.00, 0, 'COUNTING SCALE\nCap 6kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(74, 'PC10001\n', 'PC10001\n', 8250000.00, 0, 'COUNTING SCALE\nCap 10kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(75, 'PC15001\n', 'PC15001\n', 9570000.00, 0, 'COUNTING SCALE\nCap 15kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(76, 'PC30001\n', 'PC30001\n', 10780000.00, 0, 'COUNTING SCALE\nCap 30kg d:0.1g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(77, 'PC35001\n', 'PC35001\n', 11330000.00, 0, 'COUNTING SCALE\nCap 35kg d:0.1g, pan size:275x230mm\n Brand: Precizio\n\n\n'),
(78, 'PC6002\n', 'PC6002\n', 5280000.00, 0, 'COUNTING SCALE\nCap 6kg d:0.2g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(79, 'PC15002\n', 'PC15002\n', 5280000.00, 0, 'COUNTING SCALE\nCap 15kg d:0.2g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(80, 'PC30002\n', 'PC30002\n\n', 5280000.00, 0, 'COUNTING SCALE\nCap 30kg d:0.2g, pan size:275x230mm\nBrand: Precizio\n\n'),
(81, 'PC30005\n', 'PC30005\n', 4950000.00, 0, 'COUNTING SCALE\nCap 30kg d:0.5g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(82, 'PC15005\n', 'PC15005\n', 4950000.00, 0, 'COUNTING SCALE\nCap 30kg d:0.5g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(84, 'PC30000\n', 'PC30000\n', 4950000.00, 0, 'COUNTING SCALE\nCap 30kg d:1g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(85, 'PC40000\n', 'PC40000\n', 4950000.00, 0, 'COUNTING SCALE\nCap 40kg d:1g, pan size:275x230mm\nBrand: Precizio\n\n\n'),
(86, 'MA50P\n\n\n\n\n\n', 'MA50P\n\n\n\n\n\n', 25000000.00, 0, 'MOISTURE ANALYZER\nCap 50g d:0.001g, pan size: 100mm\nBrand: Precizio\n'),
(87, 'PA203', 'PA203', 12800000.00, 0, '\n'),
(88, 'SOjikyo', 'CSWP6', 3850000.00, 0, 'Waterproof Scale(SJK 6)\nCap 6k d:0.2g, Include TERA Sertifikat\nBrand: Sojikyo\n\n\n'),
(89, 'Servis', 'Servis ', 3750000.00, 0, 'Penggantian batere dan Power\n'),
(90, 'Plat ss', 'Custom Plat', 6700000.00, 0, 'Cap 300kg 35x35cm ss\n'),
(91, 'Sojikyo 100KG', 'Sojikyo100k', 4000000.00, 0, 'Benscale, Include Tera Sertifikat \nCap 100kg d:10g , Plat Size 30x40cm\n Brand: Sojikyo\n\n'),
(92, 'PSM51\n\n', 'PSM51\n\n', 115500000.00, 0, 'SEMI MICRO BALANCE\nCap 51g d:0.01mg, pan size: 90mm\nBrand: Precizio\n\n\n\n'),
(93, 'PSM105\n\n', 'PSM105\n\n', 120000000.00, 0, 'SEMI MICRO BALANCE\nCap 100g d:0.01mg, pan size: 90mm\nBrand: Precizio\n\n\n pan size: 90mm\n\n'),
(94, 'PSM1055\n\n', 'PSM1055\n\n', 47000000.00, 0, 'SEMI MICRO BALANCE\nCap 100g x 51g d:0.1mg x 0.01mg, pan size: 90mm\nBrand: Precizio\n\n\n\n'),
(95, 'PA203E\n\n', 'PA203E\n\n', 12800000.00, 0, 'PRECISION BALANCE\nCap 220g d:0.001g, pan size 80mm\nBrand: Precizio\n\n\n\n'),
(96, 'PA303E\n\n', 'PA303E\n\n', 13000000.00, 0, 'PRECISION BALANCE\n320g x 0.001g, pan size 80mm\nBrand: Precizio\n\n\n\n'),
(97, 'PA503E\n\n', 'PA503E\n\n', 13500000.00, 0, 'PRECISION BALANCE\nCap 520g d:0.001g, pan size 80mm\nBrand: Precizio\n\n\n\n'),
(98, 'AP-124i\n\n', 'AP-124i\n\n', 26500000.00, 0, 'ELECTROMAGNETIC\nCap 120g d:0.0001g, pan size 80mm\nBrand: Precizio\n\n\n\n'),
(99, 'AP-224i\n\n', 'AP-224i\n\n', 27300000.00, 0, 'ELECTROMAGNETIC\nCap 220g d:0.0001g, pan size 80mm\nBrand: Precizio\n\n\n\n'),
(100, 'AP-324i\n\n', 'AP-324i\n\n', 29000000.00, 0, 'ELECTROMAGNETIC\nCap 320g d:0.0001g,pan size 80mm\n Brand: Precizio\n\n\n\n'),
(101, 'PSA623\n', 'PSA623\n', 18000000.00, 0, 'ANALYTICAL BALANCE\nCap 620g d:1mg, pan size: 90mm \nBrand: Precizio\n\n'),
(102, 'PSA1003\n', 'PSA1003\n', 37500000.00, 0, 'ANALYTICAL BALANCE\nCap 1000g d:1mg, pan size: 90mm \nBrand: Precizio\n\n\n'),
(103, 'PSA2003\n', 'PSA2003\n', 57000000.00, 0, 'ANALYTICAL BALANCE\nCap 2000g d:1mg, pan size: 90mm \nBrand: Precizio\n\n\n'),
(104, 'PSA120\n', 'PSA120\n', 26500000.00, 0, 'ANALYTICAL BALANCE\nCap 120g d:0.1mg, pan size: 90mm \nBrand: Precizio\n\n\n'),
(105, 'PSA220\n', 'PSA220\n', 29700000.00, 0, 'ANALYTICAL BALANCE\nCap 220g d:0.1mg, pan size: 90mm \nBrand: Precizio\n\n\n'),
(106, 'PSA320\n', 'PSA320\n', 47040000.00, 0, 'ANALYTICAL BALANCE\nCap 320g d:0.1mg,pan size: 90mm \n Brand: Precizio\n\n\n'),
(107, 'PSA420\n', 'PSA420\n', 63840000.00, 0, 'ANALYTICAL BALANCE\nCap 420g d:0.1mg, pan size: 90mm \nBrand: Precizio\n\n\n'),
(108, 'PSA520\n', 'PSA520\n', 95200000.00, 0, 'ANALYTICAL BALANCE\nCap 520g d:0.1mg, pan size: 90mm \nBrand: Precizio\n\n\n'),
(109, 'JP2204\n\n', 'JP2204\n\n', 28500000.00, 0, 'ANALYTICAL BALANCE\nCap 220g d:0.0001g, \npan size: 90mm \nBrand: Precizio\n'),
(110, 'JP2204A\n\n', 'JP2204A\n\n', 34700000.00, 0, 'ANALYTICAL BALANCE\nCap 220g d:0,0001g, pan size: 90mm \nBrand: Precizio\n\n\n\n'),
(111, 'MK 203\n', 'MK 203\n', 13500000.00, 0, 'PRECISION BALANCE\nCap 220g d:0.001g, pan size: 90mm \nBrand: Precizio\n\n'),
(112, 'MK 303\n', 'MK 303\n', 13900000.00, 0, 'PRECISION BALANCE\nCap 320g d:0,001g, pan size: 90mm  \nBrand: Precizio\n\n'),
(113, 'MK 503\n', 'MK 503\n', 14350000.00, 0, 'PRECISION BALANCE\nCap 520g d:0,001g, pan size: 90mm \nBrand: Precizio\n\n'),
(114, 'MK 1201', 'MK 1201', 10500000.00, 0, 'PRECISION BALANCE\nCap 1200g d:0,1g, pan size: 170x170mm  \nBrand: Precizio\n\n'),
(115, 'MK 1202\n', 'MK 1202\n', 10500000.00, 0, 'PRECISION BALANCE\nCap 1200g d:0,01g, pan size:170x170mm \nBrand: Precizio\n\n'),
(116, 'MK 2201', 'MK 2201', 11000000.00, 0, 'PRECISION BALANCE\nCap 2200g d:0,1g, pan size: 170x170mm\nBrand: Precizio\n\n'),
(117, 'MK 2202\n', 'MK 2202\n', 11000000.00, 0, 'PRECISION BALANCE\nCap 2200g d:0,01g, pan size: 170x170mm\nBrand: Precizio\n\n'),
(118, 'MK3201', 'MK3201\n', 11200000.00, 0, 'PRECISION BALANCE\nCap 3200g d:0,1g, pan size: 170x170mm\nBrand: Precizio\n\n'),
(119, 'MK3202\n', 'MK3202\n', 10400000.00, 0, 'PRECISION BALANCE\nCap 3200g d:0,01g, pan size: 170x170mm\nBrand: Precizio\n\n\n\n'),
(120, 'MK 4201\n', 'MK 4201\n', 12500000.00, 0, 'PRECISION BALANCE\nCap 4200g d:0,1g, pan size: 170x170mm  \nBrand: Precizio\n\n'),
(121, 'MK 4202\n', 'MK 4202\n', 12500000.00, 0, 'PRECISION BALANCE\nCap 4200g d:0,01g, pan size: 170x170mm  \nBrand: Precizio\n\n'),
(122, 'MK 5201\n', 'MK 5201', 13700000.00, 0, 'PRECISION BALANCE\nCap 5200g d:0,1g, pan size: 170x170mm \nBrand: Precizio\n\n'),
(123, 'MK 5202\n', 'MK 5202\n', 13700000.00, 0, 'PRECISION BALANCE\nCap 5200g d:0,01g, pan size: 170x170mm\nBrand: Precizio\n\n'),
(124, 'B1S-60K\n', 'B1S-60K\n', 8500000.00, 0, 'PLATFORM SCALE\nCap 60kg d:10g,standar plat 30x40cm\nBrand: Precizio\n\n\n'),
(125, 'B1S-100K\n', 'B1S-100K\n', 8700000.00, 0, 'PLATFORM SCALE\nCap 100kg d:10g, standar plat 30x40cm\nBrand: Precizio\n\n\n'),
(126, 'B1S-150K\n', 'B1S-150K\n', 9500000.00, 0, 'PLATFORM SCALE\nCap 150 kg d:10g, standar plat 40x50cm\nBrand: Precizio\n\n\n'),
(127, 'B1S-300K\n', 'B1S-300K\n', 9700000.00, 0, 'PLATFORM SCALE\nCap 300 kg d:20g, standar plat 40x50cm\nBrand: Precizio\n\n\n'),
(128, 'B1S-60K SS', 'B1S-60K SS', 15000000.00, 0, 'PLATFORM SCALE\nCap 60kg d:10g,full ss plat 30x40cm\nBrand: Precizio\n\n\n'),
(129, 'B1S-100K \nSS', 'B1S-100K SS\n', 15500000.00, 0, 'PLATFORM SCALE\nCap 100 kg d:10g, full ss plat 30x40cm\nBrand: Precizio\n\n\n'),
(130, 'B1S-150K \nSS', 'B1S-150K SS\n', 17000000.00, 0, 'PLATFORM SCALE\nCap 150 kg d:10g,full ss plat 40x50cm\nBrand: Precizio\n\n\n'),
(131, 'B1S-300K SS', 'B1S-300K \nSS', 17500000.00, 0, 'PLATFORM SCALE\nCap 300 kg d:20g, full ss plat 40x50cm\nBrand: Precizio\n\n\n'),
(132, 'P7-300K\n', 'P7-300K\n', 8250000.00, 0, 'INDICATOR\nCap 300kg d:10g \nBrand: Precizio\n\n\n'),
(133, 'P7-150K\n', 'P7-150K\n', 7000000.00, 0, 'INDICATOR\nCap 150kg d:10g\nBrand: Precizio\n\n'),
(134, 'P7-100K\n', 'P7-100K\n', 5830000.00, 0, 'INDICATOR\nCap 100kg d:5g\nBrand: Precizio\n\n'),
(135, 'P7-60K\n', 'P7-60K\n', 5830000.00, 0, 'INDICATOR\nCap 60kg d:5g\nBrand: Precizio\n\n'),
(136, 'T2 INDICATOR\n', 'T2 INDICATOR\n', 7850000.00, 0, 'Indicator\nBrand: Precizio\n'),
(137, 'AND 1200', 'AND 1200', 2200000.00, 0, 'Adaptor Timbangan'),
(138, 'CEB10L', 'CEB 10L', 48840000.00, 0, 'High Precision Balance\nCap 10kg d=0.01gr\n'),
(139, 'CEB30L', 'CEB 30 L', 98750000.00, 0, 'High Precision Scale\nCap 30kg d=0.01gr\n'),
(140, 'CEB15L+', 'CEB 15L+', 175000000.00, 0, 'HIGH PRECISION\nCap 15kg d=0.005g\n'),
(141, 'BE5002', 'BE5002', 27700000.00, 0, 'Precision Balance\nCap 5kg d=0.01gr\nElectromagnetic sencors,brand precizio\n'),
(142, 'MAP53', 'MAP53', 21400000.00, 0, 'MOISTURE ANALYZER\ncap 50g d=0.001g\nHeating temperature 60-160\'C\nBrand Precizio\n'),
(143, 'MAP103', 'MAP103', 29000000.00, 0, 'MOISTURE ANALYZER\nCap 100g d:0.001g, pan size: 100mm\nBrand: Precizio\n'),
(144, 'kustomb1s', 'B1S ', 38000000.00, 0, 'WATERPROOF PLATFORM SCALE\nCap 100kg d=20g,Pan 50x60cm full ss\nInclude Printer TSC224 Pro\nInclude Modul wireless\n'),
(145, 'Kustom B1s 2', 'B1S,', 58000000.00, 0, 'WATERPROOF PLATFORM SCALE\nCap 100kg d=20g,plat 50x60cm fullss\nInclude modul wifi,Include printer wireles portable TSC Alpha 30R(-20\')\n\n'),
(146, 'JT80T', 'Truck Scale', 1362420400.00, 0, 'D.3,1 x13,5 m Cap 80 Ton     \nDetail Spesifikasi Terlampir\nDetail Pekerjaan terlampir\nDetail Datasheet Terlampir\nGaransi Struktur 2 Tahun  \n\n\n\n\n\n\n\n'),
(147, 'BP7W 1.5T', 'BP7W 1.5T', 20000000.00, 0, 'FLOORSCALE SINGLE FRAME\nCap 1.5 Ton d=0.5kg\nPlat 1,2m x1,2m Mild steel\nBrand Precizio\n'),
(148, 'Crand Scale 3 Ton', 'Crane Scale 3T', 17350000.00, 0, 'Tipe Caston  THZ 3 Ton, Merk CAS\nInclude TERA, Spec Terlampir\n\n\n\n'),
(149, 'Sertifikat KAN', 'KAN 30kg', 600000.00, 0, 'seritifikat KAN\nuntuk timbangan kapasitas dibawah 30kg\n\n\n\n'),
(151, 'Sertifikat KAN 2', 'KAN 300kg', 1500000.00, 0, 'Sertifikat KAN\nUntuk timbangan kapasitas diatas 30 kg\n\n\n'),
(152, 'Akomodasi', 'On Site', 3000000.00, 0, 'Biaya Akomodasi /On Site\n'),
(153, 'Shimadzu', '4202X', 41000000.00, 0, 'Kap 4200g , d:0.01g\nMerk SHIMADZU, Indent 2-4 Month\n'),
(154, 'CUSTOM BP7W', 'BP7W-2T 1,5m', 22500000.00, 0, 'FLOOR SCALE SINGLE FRAME\nCap 2000kg d:0.5kg,platform size:150x150cm\nBrand: PRECIZIO\n'),
(155, 'T CONNECT', 'T-CONNECT', 5500000.00, 0, 'Thermal Printer T-CONNECT\n'),
(156, 'BP7W-2TSS', 'BP7W-2Tss', 45800000.00, 0, 'SINGLE FRAME Full stainless steel, Food Grade,\nKap 2 Ton d:0.5kg, Plat: 1,5 x 1,5m\n, Brand: PRECIZIO\n'),
(157, 'AND FG150KAL', 'FG150KAL', 17500000.00, 0, 'PLATFORM SCALE\nCap 150kg d:20g, pan size:40x50cm\nBrand: AND\n'),
(158, 'AND GF32001M', 'GF32001M', 85000000.00, 0, 'WEIGHING SCALE\nCap 30kg d:1g,Cap 6kg d:0,1g dual range\nBrand: AND\n'),
(159, 'AND GF6100', 'GF6100', 42300000.00, 0, 'PRECISION BALANCE\nKap: 6000g, d: 0.01g,\nBrand: AND\n'),
(160, 'AND GR200', 'GR200', 54900000.00, 0, 'ANALYTICAL BALANCE\nCap 220g d:0,1mg, \nBrand: AND\n'),
(161, 'label stiker', 'Stiker thermal', 8500.00, 0, NULL),
(162, 'Animal Scale BP7W-2T', 'BP7W-2T A', 23000000.00, 0, 'ANIMAL SCALE BP7W-2 TON\nCap 2000Kg d:500g, Pan size: 100x200cm\nBrand: PRECIZIO\n'),
(163, 'MK Cells Digital', 'PAKET MK CELLS', 244000000.00, 0, 'Diskripsi produk dilampirkan\n\n\n'),
(164, 'SSWP', 'SSWP-30K', 6000000.00, 0, 'WATERPROFF SCALE\nKap 30kg d:5g\nBrand SOJIKYO\n'),
(165, 'Indikator NT501 A', 'NT501 A', 16500000.00, 0, 'Weighing Indicator NT501 A\nMerek CAS\n'),
(166, 'BP7W 500kg platform scale', 'BP7W-500K SS', 18500000.00, 0, 'Platform Scale,Single load cell\n Cap 500kg, d:0,2kg pan size:80x80cm full Stainless stell, Mild still rangka with stainless pan, Brand: PRECIZIO\n\n\n\n'),
(167, 'BP7W 500k Floor scale', 'BP7W 500K FSss', 26500000.00, 0, 'FLOOR SCALE SINGLE FRAME, 4 Load Cell, Cap 500kg,  d:0,5kg,Pan size : 80x80 cm, Full Stainles stell, junction box 4 line,Brand :PRECIZIO\n\n\n'),
(168, 'SJK 500K SS', 'SJK-500K SS', 17500000.00, 0, 'PLATFORM SCALE, Single load cell,\nCap 500kg, d:0,2kg, pan size: 80x80cm, Full Stainles Stell, Brand: SOJIKYO\n'),
(169, 'BP7W10K', 'BP7W', 7000000.00, 0, 'PLATFORM SCALE\nCap 10kg d:10g, pan size:40x50cm\nBrand: PRECIZIO\n'),
(170, 'T-CONNECT', 'T-CONNECT V3', 10000000.00, 0, 'T CONNECT Data Loger\n\n\n'),
(171, 'Printer', 'Printer Label', 8000000.00, 0, 'Printr Label Ribbon\n\n'),
(172, 'T CONNECT PRINTER +Modul Print', 'T CONNECT P', 12000000.00, 0, 'T CONNECT PRINTER + Modul Print\nUntuk Timbangan BSA224S/BSA6202S,\n Customable Printout\n\n\n'),
(173, 'EPSON TMU pinter', 'EPSON TMU P', 14000000.00, 0, 'EPSON TMU PRINTER + Modul Print\nUntuk Timbangan BSA224S/BSA6202S,\n Customable Printout\n'),
(174, 'Jembatan Timbang 20 ton', 'JT 20T', 255000000.00, 0, 'Jembatan Timbang 20Ton, Plat Size 4,5 x 2,4 m \nInclude Biaya pasang dan Sertifikat TERA, \nBelum termasuk Pondasi\n'),
(175, 'benscale gsc sgw 150k', 'SGW 150K', 11350000.00, 0, 'BENCH SCALE, Tipe GSC SGW 3015 PPS\nCap 150kg d:20g, plat size: 40 x 50cm\nBrand GSC\n'),
(176, 'Anak Timbang 25kg  kelas m2', 'AT 25K', 1500000.00, 0, 'Anak Timbang 25 Kg Kelas M2\n'),
(177, 'BP7W-1T danT Connect', 'BP7W 1T+TC', 76000000.00, 0, 'FLOOR SCALE SINGLE FRAME  \nCap 1000kg d:0.5kg,\nplat size:120x100cm,\nBrand Precizio\nWindows HMI 10 inch Touch Screen \nProcessor i5 Gen 11 W 10,\nT connect Software +Printer Label\n'),
(178, 'PALLET CHANGING SCALE', 'PC SCALE', 272700000.00, 0, 'PALLET CHANGING SCALE \nDiskripsi Terlampir\n\n\n'),
(179, 'Belt Scale System', 'BELT SCALE', 247000000.00, 0, 'BELT SCALE SYSTEM, Deskripsi Terlampir\n'),
(180, 'BP7W 30KG SS', 'BP7W 30 Kg', 11000000.00, 0, 'Platform Scale\nCap 30kg d=5gr\nPan size 30x40 full stainless steel\nRS232 Interface\nBrand Precizio\n\n'),
(181, 'Sojikyo 30kg', 'SOJIKYO 30kg', 7600000.00, 0, 'Waterproof Scale\nCap 30kg d=5gr\nPan 30x40cm full stainless\nBrand SOJIKYO\n'),
(182, 'BP7W 30KD SS', 'BP7W 30', 15725000.00, 0, 'PLATFORM SCALE\r\nCap 30kg d=1gr\r\nPlat 30x40 Full stainless Steel\r\nRS232 Port to Computer\r\nBrand Precizio\r\nInclude KAN Certificate\r\nInclude Pengiriman Semarang Via Ekspedisi'),
(183, 'TRUCK SCALE', 'JT 60T', 935000000.00, 0, 'A. INDIKATOR & PERANGKAT TRUCK SCALE\n- Indikator Precizio T2(1 unit)\n-Loadcell Zemic HM9B @30T(6 pcs)\n-Junction Box 6 Hall Full SS(1 Unit)\n-Stabilizer Matsunaga\n-PC dan Computer Lenovo i5 RAM 8,SSD 512(1 Unit)\n-Printer Epson TMU 220 (1 Unit)\n-Software Jembatan Timbang T CONNECT-JT\n- Sertifikat Tera Metrologi\nB.UNIT PLATFORM TRUCK SCALE D.3,4x12 M CAP 60T\n-Main Beam-WF 600x200x11x17mm x 6970mm @4btg\n-Cross Deck MOdule-H.BEAM 200x200x8x12mmx3415mm @28btg\n-Support Deck Module-WF 200x100x5,5x8mm x 582mm @64btg\n-Support Deck Module-WF 200x100x5,5x8mm x 532mm @12btg\n-Floor Deck Module-Plate T.12mm 1500x3000 @9 Lembar\n-Floor Deck Module-Plate T.12mm 1500x3240 @1 Lembar\n-Stifener Main beam-Plate T.20mm x566x94 @8pcs\n-Stifener Main Beam-Plate T.12mm x566x94 @24Pcs\n-Joint Beam-Plate T.12mm X200X600 @4pcs\n-End Plate Beam-Plate T.12mm 200x600 @4 pcs\n-End Plate Deck Module-Plate T.12mm x200x200 @56pcs\n-Base Plate Lad Cell-Plate T.12mm x200x200 @12pcs\n-Connection-Bolt 7/8 Inch Join Deck Module To Main beam @144 Set\n-Connection Base Plate load cell-Bolt 5/8 Inchi @48 Set\n-Welding AWS-71 @1 lot\n-Finish Paint- KANSAI 150 Micron @1 lot\nDesign Terlampir (Tonage Struktur Weighbridge 13863 kg)\nC. INSTALASI GROUNDING\n-Proses pembumian/bor tanah max 8 meter\n-Cable BC 50 1@10 meter\n-Eating Rood/as Grounding @1meter\n-Kabel Tembaga NYA 50 @15meter\n-Bak kontrol+busbar+isolator\n-Instalation\n-Resistensi  Max 5 Ohm\n\n\n\n'),
(185, 'BP7W 10K Custom', 'BP7W 10K+PRINTER+HMI', 64430000.00, 0, 'PLATFORM SCALE BP7W\nCap 10kg d:5g,Pan size 30x40cm\nBrand: PRECIZIO (Include KAN sertifikat)\nPRINTER LABEL RIBBON\nHMI WINDOWS 10 Inchi i5 Gen 11 Ram 8GB DBR4 128GB SSI \nT CONNECT SOFTWARE STANDART\n*Note: Pembuatan Software HMI +- 30 Hari kerja\n\n\n\n\n\n'),
(186, 'Crane Scale 1T', 'Crane Scale 1T', 8700000.00, 0, 'Type/Ukuran IE-1700 \nCap 1 Ton\nBrand CAS\n'),
(187, 'MK Cells', 'MK-E85', 115000000.00, 0, 'WIreless Crane Scale, Cap 30 Ton, d: 10Kg\nBrand: MKCells, Spesifikasi Terlampir\n'),
(188, 'BP7W 50K SS', 'BP7W 50K SS', 9500000.00, 0, 'PLATFORM SCALE Full Stainless Steel\nCap 50kg d:10g, pan size:30x40cm\nBrand: PRECIZIO(Germany)\n+ Bluetooth Printer\n\n'),
(189, 'BP7W 150K SS', 'BP7W 150K SS', 10000000.00, 0, 'PLATFORM SCALE Cap 150kg d:10g\npan size:40x50cm Full Stainless Steel 304 \nBrand: PRECIZIO(Germany)\nRS232 Port serial to PC/Printer\n'),
(190, 'BP7W 300K SS', 'BP7W 300K SS', 11000000.00, 0, 'PLATFORM SCALE Full Stainless Steel\nCap 300kg d:20g, pan size:40x50cm\nBrand: PRECIZIO(Germany)\n+ Bluetooth Printer\n\n'),
(191, 'TC P DT', 'Printer+T-Connect', 12000000.00, 0, 'Printer Dotmatrik+ T-Connect Modul\nPrinter Dotmatrix\nRS232+usb Port\nTconnect Modul Statistic\nCustomable Print out\n'),
(192, 'BP7W 60K SS', 'BP7W 60K SS', 9500000.00, 0, 'PLATFORM SCALE Cap 60kg d:5g\nPan size:30x40cm Full Stainless Steel 304 \nBrand: PRECIZIO (Germany)\nRS232 Port serial to pc/printer\n'),
(193, 'LC- BMLS25T', 'LC-BMLS25T', 7500000.00, 0, 'Loadcell Jembatan Timbang(WB-01)\nKap 25Ton, Type BM-LS Brand: KUBOTA\n(Belum Termasuk biaya pemasangan)\n'),
(194, 'Animal Scale 1Ton', 'BP7W-1 atau 2 T A', 23000000.00, 0, 'ANIMAL SCALE BP7W-1 atau 2 TON\nCap 1000Kg/2000Kg d:500g, Pan size: 100x200cm\nBrand: PRECIZIO\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_id` int NOT NULL,
  `sales_id` int NOT NULL,
  `date` date NOT NULL,
  `approved_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Open',
  `revision` int DEFAULT '0',
  `payment_term` text COLLATE utf8mb4_general_ci,
  `total` decimal(15,2) DEFAULT '0.00',
  `commission_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum Bayar',
  `commission_amount` decimal(15,2) DEFAULT NULL,
  `commission_paid_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `number`, `customer_id`, `sales_id`, `date`, `approved_date`, `status`, `revision`, `payment_term`, `total`, `commission_status`, `commission_amount`, `commission_paid_date`) VALUES
(1, 'Q-TSU-202505-1', 1, 2, '2025-05-13', NULL, 'Approved', 0, '30 days', 44200000.00, 'Hangus', 0.00, NULL),
(2, 'Q-TSU-202505-2', 2, 3, '2025-05-13', NULL, 'revised', 0, 'CBD', 7500000.00, 'Belum Bayar', NULL, NULL),
(3, 'Q-TSU-202505-3', 3, 1, '2025-05-14', NULL, 'Approved', 0, '014/INV/IV/2025', 8000000.00, 'Dibayar 16-Jun-2025', 400000.00, '2025-06-16'),
(4, 'Q-TSU-202505-4', 4, 3, '2025-05-14', NULL, 'Approved', 0, '015/INV/IV/2025', 3750000.00, 'Hangus', 0.00, NULL),
(5, 'Q-TSU-202505-5', 3, 3, '2025-05-14', NULL, 'revised', 0, '017/INV/V/2025', 8000520.00, 'Belum Bayar', NULL, NULL),
(6, 'Q-TSU-202505-6', 3, 3, '2025-05-14', NULL, 'Approved', 0, '018/INV/V/2025', 4690000.00, 'Dibayar 16-Jun-2025', 234500.00, '2025-06-16'),
(23, 'Q-TSU-202505-7', 7, 1, '2025-05-14', NULL, 'Approved', 0, '30', 7700000.00, 'Dibayar 09-Jul-2025', 385000.00, '2025-07-09'),
(24, 'Q-TSU-202505-5-R1', 3, 1, '2025-05-14', NULL, 'Fully Invoiced', 0, '017/INV/V/2025 Non ppn', 8000000.00, 'Dibayar 16-Jun-2025', 400000.00, '2025-06-16'),
(25, 'Q-TSU-202505-8', 8, 2, '2025-05-15', NULL, 'Open', 0, '30 days', 8000000.00, 'Belum Bayar', NULL, NULL),
(26, 'Q-TSU-202505-2-R1', 9, 1, '2025-05-15', NULL, 'Open', 0, '14 Days', 12000000.00, 'Belum Bayar', NULL, NULL),
(27, 'Q-TSU-202505-9', 11, 3, '2025-05-15', NULL, 'Approved', 0, '30 days', 2200000.00, 'Dibayar 09-Jul-2025', 110000.00, '2025-07-09'),
(28, 'Q-TSU-202505-10', 3, 1, '2025-05-17', NULL, 'Approved', 0, '30 Days', 8000000.00, 'Dibayar 09-Jul-2025', 360411.00, '2025-07-09'),
(29, 'Q-TSU-202505-11', 12, 3, '2025-05-19', NULL, 'Revised', 0, '30 Days', 0.00, 'Belum Bayar', NULL, NULL),
(30, 'Q-TSU-202505-12', 13, 3, '2025-05-21', NULL, 'Closed', 0, 'CBD', 71800000.00, 'Belum Bayar', NULL, NULL),
(31, 'Q-TSU-202505-13', 14, 3, '2025-05-21', NULL, 'revised', 0, 'CBD', 96000000.00, 'Belum Bayar', NULL, NULL),
(32, 'Q-TSU-202505-13-R1', 14, 3, '2025-05-21', NULL, 'Open', 0, 'CBD', 96000000.00, 'Belum Bayar', NULL, NULL),
(33, 'Q-TSU-202505-14', 15, 3, '2025-05-23', NULL, 'Closed', 0, 'CBD', 273950000.00, 'Belum Bayar', NULL, NULL),
(34, 'Q-TSU-202505-11-R1', 12, 1, '2025-05-26', NULL, 'Approved', 0, '30 Days', 69390000.00, 'Belum Bayar', 1734750.00, NULL),
(35, 'Q-TSU-202505-15', 16, 3, '2025-05-27', NULL, 'Revised', 0, 'CBD', 19095000.00, 'Belum Bayar', NULL, NULL),
(36, 'Q-TSU-202505-16', 17, 3, '2025-05-30', NULL, 'Revised', 0, 'Dp 50 %,Reeady to delivery 45%,Retensi 3bulan 5%', 989554560.00, 'Belum Bayar', NULL, NULL),
(37, 'Q-TSU-202505-17', 18, 3, '2025-05-30', NULL, 'Open', 0, 'CBD', 46500000.00, 'Belum Bayar', NULL, NULL),
(38, 'Q-TSU-202505-16-R1', 17, 3, '2025-06-02', NULL, 'Revised', 0, 'Dp 50 %,FAT Accepted 30%,SAT Accept 15%,Retensi 3 Bulan 5%', 1052336320.00, 'Belum Bayar', NULL, NULL),
(39, 'Q-TSU-202505-16-R2', 17, 3, '2025-06-04', NULL, 'Open', 0, 'Dp 50 %,FAT Accepted 30%,SAT Accept 15%,Retensi 3 Bulan 5%', 1089936320.00, 'Belum Bayar', NULL, NULL),
(40, 'Q-TSU-202505-15-R1', 16, 3, '2025-06-04', NULL, 'Open', 0, 'CBD', 11590000.00, 'Belum Bayar', NULL, NULL),
(41, 'Q-TSU-202506-18', 19, 3, '2025-06-05', NULL, 'Closed', 0, 'CBD', 17350000.00, 'Belum Bayar', NULL, NULL),
(60, 'Q-TSU-202506-019-R1', 20, 2, '2025-06-09', NULL, 'Revised', 0, 'CBD', 6300000.00, 'Belum Bayar', NULL, NULL),
(61, 'Q-TSU-202506-019-R2', 20, 2, '2025-06-09', NULL, 'Open', 0, 'CBD', 20700000.00, 'Belum Bayar', NULL, NULL),
(62, 'Q-TSU-202506-020', 21, 3, '2025-06-09', NULL, 'Revised', 0, 'CBD', 13100000.00, 'Belum Bayar', NULL, NULL),
(63, 'Q-TSU-202506-020-R1', 21, 3, '2025-06-09', NULL, 'Open', 0, 'CBD', 41600000.00, 'Belum Bayar', NULL, NULL),
(64, 'Q-TSU-202506-021', 22, 2, '2025-06-10', NULL, 'Revised', 0, 'CBD', 25500000.00, 'Belum Bayar', NULL, NULL),
(65, 'Q-TSU-202506-022', 23, 3, '2025-06-10', NULL, 'Open', 0, 'CBD', 7000000.00, 'Belum Bayar', NULL, NULL),
(68, 'Q-TSU-202506-021-R1', 22, 2, '2025-06-11', NULL, 'Open', 0, 'CBD', 82800000.00, 'Belum Bayar', NULL, NULL),
(69, 'Q-TSU-202506-023', 25, 3, '2025-06-11', NULL, 'Revised', 0, 'CBD', 268970000.00, 'Belum Bayar', NULL, NULL),
(70, 'Q-TSU-202506-024', 1, 3, '2025-06-11', NULL, 'Fully Invoiced', 0, 'CBD', 1700000.00, 'Belum Bayar', 85000.00, NULL),
(71, 'Q-TSU-202506-023-R1', 25, 3, '2025-06-11', NULL, 'Closed', 0, 'CBD', 162400000.00, 'Belum Bayar', NULL, NULL),
(72, 'Q-TSU-202506-025', 26, 4, '2025-06-11', NULL, 'Revised', 0, 'CBD', 57600000.00, 'Belum Bayar', NULL, NULL),
(73, 'Q-TSU-202506-025-R1', 26, 4, '2025-06-11', NULL, 'Open', 0, 'CBD', 96300000.00, 'Belum Bayar', NULL, NULL),
(96, 'Q-TSU-202506-026', 28, 4, '2025-06-12', NULL, 'Closed', 0, 'CBD', 26000000.00, 'Belum Bayar', NULL, NULL),
(97, 'Q-TSU-202506-027', 26, 4, '2025-06-12', NULL, 'Open', 0, 'CBD', 22700000.00, 'Belum Bayar', NULL, NULL),
(98, 'Q-TSU-202506-025-R2', 26, 4, '2025-06-12', NULL, 'Open', 0, 'CBD', 22700000.00, 'Belum Bayar', NULL, NULL),
(100, 'Q-TSU-202506-028', 30, 3, '2025-06-13', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(101, 'Q-TSU-202506-029', 31, 3, '2025-06-13', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(102, 'Q-TSU-202506-030', 32, 3, '2025-06-13', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(103, 'Q-TSU-202506-030-R1', 32, 3, '2025-06-13', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(104, 'Q-TSU-202506-031', 33, 3, '2025-06-16', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(105, 'Q-TSU-202506-032', 39, 2, '2025-06-17', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(106, 'Q-TSU-202506-032-R1', 39, 2, '2025-06-17', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(107, 'Q-TSU-202506-033', 40, 2, '2025-06-17', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(108, 'Q-TSU-202506-034', 41, 2, '2025-06-18', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(109, 'Q-TSU-202506-035', 42, 2, '2025-06-18', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(110, 'Q-TSU-202506-035-R1', 42, 2, '2025-06-18', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(111, 'Q-TSU-202506-036', 36, 3, '2025-06-19', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(112, 'Q-TSU-202506-036-R1', 36, 3, '2025-06-19', NULL, 'Closed', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(113, 'Q-TSU-202506-037', 43, 3, '2025-06-19', NULL, 'Open', 0, 'DP 50% Siap Kirim 40% Setelah instalasi 10%', 0.00, 'Belum Bayar', NULL, NULL),
(114, 'Q-TSU-202506-038', 44, 3, '2025-06-19', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(115, 'Q-TSU-202506-039', 1, 3, '2025-06-20', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(117, 'Q-TSU-202506-040', 45, 1, '2025-06-20', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(118, 'Q-TSU-202506-039-R1', 1, 3, '2025-06-20', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(119, 'Q-TSU-202506-035-R2', 42, 2, '2025-06-23', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(120, 'Q-TSU-202506-041', 42, 2, '2025-06-23', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(121, 'Q-TSU-202506-042', 42, 2, '2025-06-23', NULL, 'Revised', 0, 'DP 50%', 0.00, 'Belum Bayar', NULL, NULL),
(122, 'Q-TSU-202506-042-R1', 42, 2, '2025-06-23', NULL, 'Open', 0, 'DP 50%READY DELIVERY 40% AFTER BAST 10%', 0.00, 'Belum Bayar', NULL, NULL),
(123, 'Q-TSU-202506-043', 3, 3, '2025-06-23', NULL, 'Open', 0, 'DP50%READY DELIVERY40%AFTER BAST 10%', 0.00, 'Belum Bayar', NULL, NULL),
(124, 'Q-TSU-202506-044', 46, 2, '2025-06-23', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(125, 'Q-TSU-202506-045', 45, 1, '2025-06-24', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(126, 'Q-TSU-202506-046', 47, 3, '2025-06-24', NULL, 'Closed', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(127, 'Q-TSU-202506-045-R1', 45, 1, '2025-06-24', NULL, 'Closed', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(128, 'Q-TSU-202506-047', 48, 2, '2025-06-26', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(130, 'Q-TSU-202506-048', 45, 1, '2025-06-30', NULL, 'Revised', 0, '30Days', 0.00, 'Belum Bayar', NULL, NULL),
(131, 'Q-TSU-202506-048-R1', 45, 1, '2025-06-30', NULL, 'Approved', 0, '30Days', 25160000.00, 'Belum Bayar', 1258000.00, NULL),
(132, 'Q-TSU-202507-049', 49, 2, '2025-07-02', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(133, 'Q-TSU-202507-050', 50, 3, '2025-07-02', NULL, 'Closed', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(138, 'Q-TSU-202507-051', 51, 3, '2025-07-03', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(139, 'Q-TSU-202507-052', 52, 3, '2025-07-04', NULL, 'Revised', 0, 'Dp 50%, 40% siap kirim,10% setelah instalasi', 0.00, 'Belum Bayar', NULL, NULL),
(140, 'Q-TSU-202507-052-R1', 52, 3, '2025-07-04', NULL, 'Open', 0, 'Dp 50%, 40% siap kirim,10% setelah instalasi', 0.00, 'Belum Bayar', NULL, NULL),
(141, 'Q-TSU-202507-053', 53, 1, '2025-07-07', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(142, 'Q-TSU-202507-054', 54, 3, '2025-07-07', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(143, 'Q-TSU-202507-051-R1', 51, 3, '2025-07-08', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(144, 'Q-TSU-202507-055', 55, 3, '2025-07-09', NULL, 'Closed', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(145, 'Q-TSU-202507-056', 56, 3, '2025-07-10', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(146, 'Q-TSU-202506-035-R3', 42, 2, '2025-07-10', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(147, 'Q-TSU-202506-035-R4', 42, 2, '2025-07-10', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(148, 'Q-TSU-202507-057', 57, 3, '2025-07-10', NULL, 'Open', 0, 'CBD', 8700000.00, 'Belum Bayar', NULL, NULL),
(149, 'Q-TSU-202507-058', 58, 3, '2025-07-11', NULL, 'Closed', 0, 'CBD', 5550000.00, 'Belum Bayar', NULL, NULL),
(151, 'Q-TSU-202507-059', 27, 2, '2025-07-11', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(152, 'Q-TSU-202507-060', 59, 3, '2025-07-14', NULL, 'Open', 0, '14 Days', 0.00, 'Belum Bayar', NULL, NULL),
(153, 'Q-TSU-202507-061', 60, 3, '2025-07-16', NULL, 'Revised', 0, '14 Days', 0.00, 'Belum Bayar', NULL, NULL),
(154, 'Q-TSU-202507-061-R1', 60, 3, '2025-07-16', NULL, 'Revised', 0, '14 Days', 0.00, 'Belum Bayar', NULL, NULL),
(155, 'Q-TSU-202507-061-R2', 60, 3, '2025-07-16', NULL, 'Open', 0, '14 Days', 0.00, 'Belum Bayar', NULL, NULL),
(156, 'Q-TSU-202507-062', 61, 1, '2025-07-18', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(157, 'Q-TSU-202507-063', 62, 1, '2025-07-19', NULL, 'Open', 0, 'CBD', 22410000.00, 'Belum Bayar', NULL, NULL),
(158, 'Q-TSU-202507-064', 63, 3, '2025-07-21', NULL, 'Closed', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(159, 'Q-TSU-202507-065', 63, 3, '2025-07-21', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(160, 'Q-TSU-202507-066', 1, 3, '2025-07-21', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(161, 'Q-TSU-202507-067', 64, 2, '2025-07-22', NULL, 'Revised', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(162, 'Q-TSU-202507-067-R1', 64, 2, '2025-07-22', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(163, 'Q-TSU-202507-068', 65, 3, '2025-07-22', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(165, 'Q-TSU-202507-069', 66, 3, '2025-07-22', NULL, 'Revised', 0, '30 Days', 0.00, 'Belum Bayar', NULL, NULL),
(166, 'Q-TSU-202507-070', 67, 3, '2025-07-22', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(167, 'Q-TSU-202507-069-R1', 66, 3, '2025-07-23', NULL, 'Approved', 0, '30 Days', 55000000.00, 'Belum Bayar', NULL, NULL),
(168, 'Q-TSU-202507-071', 68, 1, '2025-07-26', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(169, 'Q-TSU-202507-072', 69, 3, '2025-07-28', NULL, 'Open', 0, 'CBD', 0.00, 'Belum Bayar', NULL, NULL),
(170, 'Q-TSU-202507-073', 70, 1, '2025-07-28', NULL, 'Open', 0, 'CBD', 273300000.00, 'Belum Bayar', NULL, NULL),
(171, 'Q-TSU-202506-039-R2', 1, 1, '2025-07-28', NULL, 'Approved', 0, '14Days', 64207500.00, 'Belum Bayar', 2335375.00, NULL),
(172, 'jf2pkod', 18, 1, '2026-05-05', '2026-05-30', 'Approved', 0, '30', 9700000.00, 'Belum Bayar', NULL, NULL),
(173, 'Qtsu', 18, 1, '2026-05-08', NULL, 'Approved', 0, '30', 8550000.00, 'Belum Bayar', NULL, NULL),
(174, 'QUO-2026-0001', 18, 1, '2026-05-15', NULL, 'Approved', 0, '20', 29000000.00, 'Belum Bayar', NULL, NULL),
(175, 'QUO-2026-0002', 68, 1, '2026-05-09', '2026-05-09', 'Approved', 0, '30', 29000000.00, 'Belum Bayar', NULL, NULL),
(176, 'QUO-2026-0003', 18, 1, '2026-05-09', '2026-05-09', 'Approved', 0, '30', 17000000.00, 'Belum Bayar', NULL, NULL),
(177, 'QUO-2026-0004', 30, 1, '2026-05-09', '2026-05-09', 'Approved', 0, '30', 17000000.00, 'Belum Bayar', NULL, NULL),
(178, 'QUO-2026-0005', 33, 1, '2026-05-10', '2026-05-10', 'Approved', 0, '30', 9700000.00, 'Belum Bayar', NULL, NULL),
(179, 'QUO-2026-0006', 8, 1, '2026-05-10', '2026-05-10', 'Approved', 0, '30', 46707500.00, 'Belum Bayar', NULL, NULL),
(180, 'QUO-2026-0007', 30, 1, '2026-05-12', '2026-05-12', 'Approved', 0, '30', 17000000.00, 'Belum Bayar', NULL, NULL),
(181, 'QUO-2026-0008', 27, 1, '2026-05-12', '2026-05-12', 'Approved', 0, '30', 41000000.00, 'Belum Bayar', NULL, NULL),
(182, 'QUO-2026-0009', 69, 7, '2026-05-17', '2026-05-17', 'Approved', 0, '30', 46707500.00, 'Belum Bayar', NULL, NULL),
(183, 'QUO-2026-0010', 33, 5, '2026-05-17', '2026-05-17', 'Approved', 0, NULL, 9000000.00, 'Belum Bayar', NULL, NULL),
(184, 'QUO-2026-0011', 30, 6, '2026-05-06', '2026-05-17', 'Approved', 0, '30', 9000000.00, 'Belum Bayar', NULL, NULL),
(185, 'QUO-2026-0012', 53, 3, '2026-05-21', '2026-05-21', 'Approved', 0, '30', 21400000.00, 'Belum Bayar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `id` int NOT NULL,
  `quotation_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) DEFAULT '0.00',
  `kan_price` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_items`
--

INSERT INTO `quotation_items` (`id`, `quotation_id`, `product_id`, `quantity`, `price`, `discount`, `kan_price`) VALUES
(1, 1, 30, 1, 44200000.00, 0.00, 0),
(2, 2, 32, 1, 7500000.00, 0.00, 0),
(3, 3, 87, 1, 12800000.00, 37.50, 0),
(4, 4, 89, 1, 3750000.00, 0.00, 0),
(5, 5, 17, 1, 11400000.00, 29.82, 0),
(6, 6, 90, 1, 6700000.00, 30.00, 0),
(7, 23, 88, 2, 3850000.00, 0.00, 0),
(8, 24, 17, 1, 8000000.00, 0.00, 0),
(9, 25, 91, 2, 4000000.00, 0.00, 0),
(10, 26, 32, 2, 7500000.00, 20.00, 0),
(11, 27, 137, 1, 2200000.00, 0.00, 0),
(12, 28, 17, 1, 8000000.00, 0.00, 0),
(15, 30, 142, 2, 21400000.00, 0.00, 0),
(16, 30, 143, 1, 29000000.00, 0.00, 0),
(17, 31, 144, 1, 38000000.00, 0.00, 0),
(18, 31, 144, 1, 58000000.00, 0.00, 0),
(19, 32, 144, 1, 38000000.00, 0.00, 0),
(20, 32, 145, 1, 58000000.00, 0.00, 0),
(21, 33, 92, 1, 116100000.00, 0.00, 600000),
(22, 33, 103, 1, 57600000.00, 0.00, 600000),
(23, 33, 139, 1, 100250000.00, 0.00, 1500000),
(24, 34, 109, 1, 29100000.00, 10.00, 600000),
(25, 34, 17, 4, 12000000.00, 10.00, 600000),
(26, 35, 117, 1, 11600000.00, 5.00, 600000),
(27, 35, 37, 1, 8500000.00, 5.00, 1500000),
(28, 36, 146, 1, 1236943200.00, 20.00, 0),
(29, 37, 147, 1, 23000000.00, 0.00, 3000000),
(30, 37, 55, 1, 23500000.00, 0.00, 3000000),
(31, 38, 146, 1, 1315420400.00, 20.00, 0),
(32, 39, 146, 1, 1362420400.00, 20.00, 0),
(33, 40, 117, 1, 12200000.00, 5.00, 1200000),
(34, 41, 148, 1, 17350000.00, 0.00, 0),
(59, 60, 151, 1, 1500000.00, 0.00, 0),
(60, 60, 149, 3, 600000.00, 0.00, 0),
(61, 60, 152, 1, 3000000.00, 0.00, 0),
(62, 61, 151, 1, 1500000.00, 0.00, 0),
(63, 61, 149, 27, 600000.00, 0.00, 0),
(64, 61, 152, 1, 3000000.00, 0.00, 0),
(65, 62, 121, 1, 13100000.00, 0.00, 600000),
(66, 63, 153, 1, 41600000.00, 0.00, 600000),
(67, 64, 154, 1, 25500000.00, 0.00, 3000000),
(68, 65, 58, 1, 7000000.00, 0.00, 1500000),
(71, 68, 154, 1, 28500000.00, 0.00, 6000000),
(72, 68, 155, 1, 5500000.00, 0.00, 0),
(73, 68, 156, 1, 48800000.00, 0.00, 3000000),
(74, 69, 157, 1, 19000000.00, 0.00, 1500000),
(75, 69, 158, 1, 85600000.00, 0.00, 600000),
(76, 69, 159, 1, 42900000.00, 0.00, 600000),
(77, 69, 160, 1, 55500000.00, 0.00, 600000),
(78, 69, 37, 1, 8500000.00, 0.00, 1500000),
(79, 69, 62, 1, 10720000.00, 0.00, 600000),
(80, 69, 6, 1, 17650000.00, 0.00, 600000),
(81, 69, 109, 1, 29100000.00, 0.00, 600000),
(82, 70, 161, 200, 8500.00, 0.00, 0),
(83, 71, 157, 1, 19000000.00, 20.00, 1500000),
(84, 71, 158, 1, 85600000.00, 20.00, 600000),
(85, 71, 159, 1, 42900000.00, 20.00, 600000),
(86, 71, 160, 1, 55500000.00, 20.00, 600000),
(87, 72, 103, 1, 57600000.00, 0.00, 600000),
(88, 73, 103, 1, 58200000.00, 0.00, 1200000),
(89, 73, 102, 1, 38100000.00, 0.00, 600000),
(140, 96, 162, 1, 26000000.00, 0.00, 3000000),
(141, 97, 115, 1, 11100000.00, 0.00, 600000),
(142, 97, 117, 1, 11600000.00, 0.00, 600000),
(143, 98, 117, 1, 11600000.00, 0.00, 600000),
(144, 98, 115, 1, 11100000.00, 0.00, 600000),
(146, 100, 163, 1, 244000000.00, 0.00, 0),
(147, 101, 164, 1, 6600000.00, 0.00, 600000),
(148, 101, 69, 1, 5550000.00, 0.00, 600000),
(149, 102, 48, 1, 7830000.00, 0.00, 1500000),
(150, 103, 39, 1, 7330000.00, 0.00, 1500000),
(151, 104, 165, 1, 16500000.00, 0.00, 0),
(152, 105, 117, 1, 11600000.00, 0.00, 600000),
(153, 106, 111, 1, 14100000.00, 0.00, 600000),
(154, 107, 168, 1, 17500000.00, 0.00, 0),
(155, 107, 166, 1, 21500000.00, 0.00, 3000000),
(156, 107, 167, 1, 29500000.00, 0.00, 3000000),
(157, 108, 109, 1, 29100000.00, 20.00, 600000),
(158, 109, 169, 1, 7600000.00, 0.00, 600000),
(159, 109, 155, 1, 7500000.00, 0.00, 0),
(160, 109, 171, 1, 5500000.00, 0.00, 0),
(161, 110, 169, 1, 8200000.00, 0.00, 1200000),
(162, 110, 171, 1, 5500000.00, 0.00, 0),
(163, 110, 170, 1, 7500000.00, 0.00, 0),
(164, 111, 172, 2, 12000000.00, 0.00, 0),
(165, 112, 173, 2, 14000000.00, 0.00, 0),
(166, 113, 174, 1, 255000000.00, 0.00, 0),
(167, 114, 61, 1, 10170000.00, 0.00, 600000),
(168, 114, 57, 1, 9100000.00, 0.00, 600000),
(169, 115, 30, 1, 44200000.00, 0.00, 0),
(172, 117, 176, 2, 3000000.00, 0.00, 1500000),
(173, 117, 175, 1, 12850000.00, 0.00, 1500000),
(174, 118, 30, 1, 46700000.00, 0.00, 0),
(175, 119, 169, 1, 9400000.00, 0.00, 2400000),
(176, 119, 171, 1, 8000000.00, 0.00, 0),
(177, 119, 170, 1, 10000000.00, 0.00, 0),
(178, 120, 177, 1, 79000000.00, 0.00, 3000000),
(179, 121, 178, 1, 272700000.00, 0.00, 0),
(180, 122, 178, 1, 272700000.00, 0.00, 0),
(181, 123, 179, 1, 247000000.00, 0.00, 0),
(182, 124, 37, 1, 8500000.00, 0.00, 1500000),
(183, 124, 41, 1, 12500000.00, 0.00, 1500000),
(184, 125, 180, 1, 11600000.00, 0.00, 600000),
(185, 126, 109, 1, 29100000.00, 0.00, 600000),
(186, 126, 113, 1, 14950000.00, 0.00, 600000),
(187, 127, 180, 1, 12200000.00, 0.00, 1200000),
(188, 127, 181, 1, 8200000.00, 0.00, 600000),
(189, 128, 109, 1, 29100000.00, 0.00, 600000),
(191, 130, 182, 2, 15725000.00, 10.00, 0),
(192, 131, 182, 2, 15725000.00, 20.00, 0),
(193, 132, 86, 1, 26500000.00, 0.00, 1500000),
(194, 133, 37, 1, 8500000.00, 0.00, 1500000),
(203, 138, 39, 1, 7330000.00, 0.00, 1500000),
(204, 138, 43, 1, 12500000.00, 0.00, 1500000),
(205, 139, 183, 1, 0.00, 0.00, 0),
(206, 140, 183, 1, 935000000.00, 15.00, 0),
(207, 141, 40, 1, 6430000.00, 0.00, 600000),
(208, 141, 31, 1, 9600000.00, 0.00, 600000),
(209, 142, 138, 1, 49440000.00, 0.00, 600000),
(210, 143, 60, 1, 8850000.00, 0.00, 600000),
(211, 143, 61, 1, 10170000.00, 0.00, 600000),
(212, 143, 65, 1, 5880000.00, 0.00, 600000),
(213, 143, 68, 1, 5550000.00, 0.00, 600000),
(214, 143, 69, 1, 5550000.00, 0.00, 600000),
(215, 143, 62, 1, 10720000.00, 0.00, 600000),
(216, 143, 66, 1, 5880000.00, 0.00, 600000),
(217, 143, 67, 1, 5550000.00, 0.00, 600000),
(218, 143, 58, 1, 6100000.00, 0.00, 600000),
(219, 143, 57, 1, 9100000.00, 0.00, 600000),
(220, 143, 63, 1, 11300000.00, 0.00, 600000),
(221, 143, 70, 1, 5550000.00, 0.00, 600000),
(222, 143, 32, 1, 8100000.00, 0.00, 600000),
(223, 143, 59, 1, 7090000.00, 0.00, 600000),
(224, 143, 64, 1, 5880000.00, 0.00, 600000),
(225, 144, 109, 1, 29100000.00, 0.00, 600000),
(226, 145, 109, 1, 29100000.00, 0.00, 600000),
(227, 146, 185, 1, 64430000.00, 0.00, 0),
(228, 147, 185, 1, 64430000.00, 10.00, 0),
(229, 148, 186, 1, 8700000.00, 0.00, 0),
(230, 149, 68, 1, 5550000.00, 0.00, 600000),
(232, 151, 60, 1, 8850000.00, 0.00, 600000),
(233, 152, 187, 1, 115000000.00, 20.00, 0),
(234, 153, 188, 5, 11000000.00, 10.00, 1500000),
(235, 153, 189, 1, 11500000.00, 10.00, 1500000),
(236, 153, 190, 2, 12500000.00, 10.00, 1500000),
(237, 154, 190, 2, 14000000.00, 10.00, 3000000),
(238, 154, 189, 1, 11500000.00, 10.00, 1500000),
(239, 154, 188, 4, 11000000.00, 10.00, 1500000),
(240, 155, 188, 4, 11000000.00, 15.00, 1500000),
(241, 155, 189, 1, 11500000.00, 15.00, 1500000),
(242, 155, 190, 2, 12500000.00, 15.00, 1500000),
(243, 156, 191, 1, 12000000.00, 0.00, 0),
(244, 157, 60, 1, 8850000.00, 10.00, 600000),
(245, 157, 61, 1, 10170000.00, 10.00, 600000),
(246, 157, 65, 1, 5880000.00, 10.00, 600000),
(247, 158, 60, 1, 8850000.00, 0.00, 600000),
(248, 158, 61, 1, 10170000.00, 0.00, 600000),
(249, 159, 60, 1, 8850000.00, 0.00, 600000),
(250, 159, 61, 1, 10170000.00, 0.00, 600000),
(251, 160, 189, 1, 11500000.00, 0.00, 1500000),
(252, 160, 192, 1, 11000000.00, 0.00, 1500000),
(253, 161, 193, 1, 7500000.00, 0.00, 0),
(254, 162, 193, 2, 7500000.00, 0.00, 0),
(255, 163, 193, 2, 7500000.00, 0.00, 0),
(257, 165, 119, 5, 11800000.00, 0.00, 600000),
(258, 166, 60, 1, 8850000.00, 0.00, 600000),
(259, 166, 61, 1, 10170000.00, 0.00, 600000),
(260, 167, 119, 5, 11000000.00, 0.00, 600000),
(261, 168, 38, 1, 7330000.00, 0.00, 1500000),
(262, 168, 39, 1, 7330000.00, 0.00, 1500000),
(263, 168, 44, 1, 10500000.00, 0.00, 1500000),
(264, 168, 42, 1, 10500000.00, 0.00, 1500000),
(265, 169, 194, 1, 26000000.00, 0.00, 3000000),
(270, 172, 127, 1, 9700000.00, 0.00, 0),
(271, 171, 30, 1, 46707500.00, 0.00, 0),
(272, 171, 131, 1, 17500000.00, 0.00, 0),
(273, 170, 15, 11, 9100000.00, 0.00, 0),
(274, 170, 58, 11, 6100000.00, 0.00, 0),
(275, 170, 26, 11, 8100000.00, 0.00, 0),
(276, 170, 130, 1, 17000000.00, 0.00, 0),
(278, 173, 192, 1, 9500000.00, 10.00, 0),
(279, 174, 143, 1, 29000000.00, 0.00, 0),
(281, 175, 100, 1, 29000000.00, 0.00, 0),
(282, 176, 130, 1, 17000000.00, 0.00, 0),
(283, 177, 130, 1, 17000000.00, 0.00, 0),
(284, 178, 127, 1, 9700000.00, 0.00, 0),
(285, 179, 30, 1, 46707500.00, 0.00, 0),
(286, 180, 130, 1, 17000000.00, 0.00, 0),
(288, 181, 153, 1, 41000000.00, 0.00, 0),
(290, 182, 30, 1, 46707500.00, 0.00, 0),
(291, 183, 31, 1, 9000000.00, 0.00, 0),
(292, 184, 31, 1, 9000000.00, 0.00, 0),
(293, 185, 142, 1, 21400000.00, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `role` text COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` text COLLATE utf8mb4_general_ci,
  `phone` text COLLATE utf8mb4_general_ci,
  `email` text COLLATE utf8mb4_general_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `fullname`, `phone`, `email`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$AQsVAWmyNYPJXhCVdMT0T.OmLv.7gE2E56tPT.V8GbvKjiQB9ul0O', 'Admin', 'Administrator', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL),
(2, 'admin_lama', 'password123', 'Admin', 'Admin Lama', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'natan', '$2y$12$J5jiwpN7.F6YnFZl/1eKLuJEPa.7oZBskwnOWSoQ14avw2iFx2TGS', 'Sales', 'Natan', NULL, 'natan@sales.com', NULL, NULL, NULL, NULL),
(4, 'yehu', '$2y$12$YTl3w6l96qW/Fq0sfnoU.O9ML5E6JWrTC3dfuD0E5sJFBNPCT6j7.', 'Sales', 'Yehu', NULL, 'yehu@sales.com', NULL, NULL, NULL, NULL),
(5, 'trias', '$2y$12$o1iSh.gxv.UzsueFOAHzN.35NcPXe0vT22KPOr5D8wGW5Ih7/ffNG', 'Sales', 'Trias', NULL, 'trias@sales.com', NULL, NULL, NULL, NULL),
(6, 'sarah', '$2y$12$rQv7VLFeW.2aq8du2BOK5.vgRYXbPBhvjXWEyAU8bgCVVEOfVOhiW', 'Sales', 'Sarah', NULL, 'sarah@sales.com', NULL, NULL, NULL, NULL),
(7, 'jena', '$2y$12$ODlwILpDRTMj4JHXCkK1yOb7H698Kqhz4M2VlW3r7LddZVzW8zJ0m', 'Sales', 'Jena', NULL, 'jena@sales.com', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashflow`
--
ALTER TABLE `cashflow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashflow_categories`
--
ALTER TABLE `cashflow_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `delivery_notes`
--
ALTER TABLE `delivery_notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `quotation_id` (`quotation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `quotations_ibfk_1` (`customer_id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_id` (`quotation_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashflow`
--
ALTER TABLE `cashflow`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `cashflow_categories`
--
ALTER TABLE `cashflow_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `delivery_notes`
--
ALTER TABLE `delivery_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `delivery_notes`
--
ALTER TABLE `delivery_notes`
  ADD CONSTRAINT `delivery_notes_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`);

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `quotations_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD CONSTRAINT `quotation_items_ibfk_1` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`),
  ADD CONSTRAINT `quotation_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
