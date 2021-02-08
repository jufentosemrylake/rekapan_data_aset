-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09 Jul 2020 pada 04.10
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekapan_data_aset`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `amortisasi`
--

CREATE TABLE `amortisasi` (
  `id` int(11) NOT NULL,
  `kelompok` varchar(100) NOT NULL,
  `masa` varchar(100) NOT NULL,
  `tarif` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `amortisasi`
--

INSERT INTO `amortisasi` (`id`, `kelompok`, `masa`, `tarif`) VALUES
(1, 'I', '4', '25'),
(2, 'II', '8', '12,5'),
(3, 'III', '16', '6,25'),
(5, 'IV', '20', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `kode_aset` varchar(200) NOT NULL,
  `id_lprn` varchar(200) NOT NULL,
  `nama_aset` varchar(200) NOT NULL,
  `cabang` varchar(200) NOT NULL,
  `kantor_kas` varchar(200) NOT NULL,
  `kategori` varchar(200) NOT NULL,
  `jenis` varchar(200) NOT NULL,
  `type_pajak` varchar(200) NOT NULL,
  `tgl_beli` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `nilai_jumlah` int(11) NOT NULL,
  `umur_eko` int(11) NOT NULL,
  `tgl_hbs_sst` varchar(200) NOT NULL,
  `nilai_residu` int(11) NOT NULL,
  `tarif_penyusutan` varchar(11) NOT NULL,
  `jmlh_bln_thn_prtma` int(11) NOT NULL,
  `ttl_BLN_sst` int(11) NOT NULL,
  `jmlh_bln_sst` int(11) NOT NULL,
  `sisa_bln_sst` int(11) NOT NULL,
  `pnystn_perBulan` int(11) NOT NULL,
  `row_kosong` int(11) NOT NULL,
  `pnystan_tahun` int(11) NOT NULL,
  `ssa_nlai_pnystan` int(11) NOT NULL,
  `nilai_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`kode_aset`, `id_lprn`, `nama_aset`, `cabang`, `kantor_kas`, `kategori`, `jenis`, `type_pajak`, `tgl_beli`, `jumlah`, `harga_beli`, `nilai_jumlah`, `umur_eko`, `tgl_hbs_sst`, `nilai_residu`, `tarif_penyusutan`, `jmlh_bln_thn_prtma`, `ttl_BLN_sst`, `jmlh_bln_sst`, `sisa_bln_sst`, `pnystn_perBulan`, `row_kosong`, `pnystan_tahun`, `ssa_nlai_pnystan`, `nilai_buku`) VALUES
('INV-KSS.ELU-I.01.001.012020.0001', '112345', 'Komputer PC Rakitan', 'Kupang Kota', 'Oesapa', 'ELU', 'INVENTARIS', 'I', '01/01/2020', 1, 9000000, 9000000, 4, '01/01/2024', 200000, '25', 9, 48, 5, 43, 183333, 183333, 2200000, 8250001, 8450001),
('INV-KSS.ELU-I.01.001.012020.0002', '112345', 'Komputer PC Rakitan', 'Kupang Kota', 'Oesapa', 'ELU', 'INVENTARIS', 'I', '01/02/2020', 1, 5000000, 5000000, 4, '01/02/2024', 200000, '25', 9, 48, 4, 44, 100000, 100000, 1200000, 4600000, 4800000),
('INV-KSS.ELU-I.01.001.012020.0003', '123456', 'meja kasir', 'Kupang Kota', 'Maulafa', 'ELU', 'INVENTARIS', 'I', '01/01/2016', 7, 2000000, 14000000, 4, '01/01/2020', 500000, '25', 7, 48, 54, -6, 281250, 281250, 375000, 0, 500000),
('INV-KSS.ELU-I.01.001.012020.0004', '123456', 'Printer EPSON', 'Kupang Kota', 'Oesapa', 'ELU', 'INVENTARIS', 'I', '01/03/2016', 1, 1000000, 1000000, 4, '01/03/2020', 100000, '25', 7, 48, 52, -4, 18750, 18750, 225000, 0, 100000),
('INV-KSS.ELU-I.01.001.012020.0005', '123456', 'Mouse Logitech', 'Kupang Kota', 'Maulafa', 'ELU', 'INVENTARIS', 'I', '07/04/2016', 10, 20000, 200000, 4, '07/04/2020', 2000, '25', 7, 48, 50, -2, 4125, 4125, 4500, 0, 2000),
('INV-KSS.ELU-I.01.001.012020.0006', '112345', 'Printer EPSON', 'Kupang Kota', 'Oesapa', 'ELU', 'INVENTARIS', 'I', '30/04/2016', 1, 2000000, 2000000, 4, '30/04/2020', 200000, '25', 9, 48, 50, -2, 37500, 37500, 450000, 0, 200000),
('INV-KSS.ELU-I.01.001.012020.0007', '112345', 'Meja Kaca', 'Kupang Kota', 'Maulafa', 'ELU', 'INVENTARIS', 'I', '01/05/2016', 2, 2000000, 4000000, 4, '01/05/2020', 200000, '25', 9, 48, 50, -2, 79167, 79167, 450000, 79151, 200000),
('INV-KSS.ELU-I.01.001.012020.0008', '112345', 'Motor', 'Kupang Kota', 'Oesapa', 'ELU', 'INVENTARIS', 'IV', '01/05/2000', 12, 9000000, 108000000, 20, '01/05/2020', 500000, '5', 9, 240, 242, -2, 447917, 447917, 425000, 447837, 500000),
('INV-KSS.ELU-I.01.001.012020.0010', '112345', 'Buku Tabungan Anggota', 'Kupang Kota', 'Maulafa', 'ELU', 'INVENTARIS', 'III', '01/05/2004', 500, 50000, 13000000, 16, '01/05/2020', 500000, '6,25', 9, 192, 194, -2, 65104, 65104, 31250, 65136, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `kode_cabang` varchar(5) NOT NULL,
  `nama_cabang` varchar(200) DEFAULT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`kode_cabang`, `nama_cabang`, `alamat`) VALUES
('001', 'Kupang Kota', 'Jln. Perintis Kemerdekaan'),
('002', 'Adonara', 'Jln. Trans Waiwerang-Sagu, Desa Waiburak, Kecamatan Flotim'),
('003', 'Kefa', 'Jln. Ahmad Yani, RT 06 RW 01\r\nKelurahan Kefa Selatan\r\nKecamatan Kota Kefamenanu\r\nKabupaten TTU'),
('004', 'Oesao', 'Jln. Timor Raya Km 29 Oesao'),
('005', 'Kantor Pusat', 'Jln. Sumba No. 3C, Kel. Fatubesi, Kec. Kota Lama Kab. Kota Kupang'),
('006', 'Sumba Barat Daya', 'Jln. Radamata, Desa Radamata Kec. Tambolaka Waitabula'),
('007', 'Malaka', 'Jln. Maromak Oan Desa Laran Wehali-Malaka Dpn Kantor Samsat'),
('008', 'Lembata', 'Jln. Trans Lembata, Lamahora Kec. Nunbatuka Lewoleba Timur'),
('009', 'Atambua', 'Jln. Timor Raya Km 2 Kel. Lidak Kec. Atambua Selatan'),
('010', 'Larantuka', 'Jln. San Juan No. 121 Kel. Sarotari Tengah Kec. Larantuka Kab. Flotim'),
('011', 'Soe', 'Jln. Diponegoro'),
('012', 'Rote Ndao', 'Jln. Baa Busa Langga Rt.05 Rw.03 Kel. Mokdale Kec. Lobalain'),
('013', 'Waingapu', 'Jln. Gajah Mada No. 12 Rt. 08 Rw. 06 Kel. Hambala Kec. Kota Waingapu'),
('014', 'Sabu', 'Jln. Trans Seba Bolou Samping Pasar Nataga'),
('015', 'Denpasar', 'Jln. Hayam Wuruk, No. 119/139 Kel. Sumerta Kelod Kec. Denpasar'),
('016', 'Ende', 'Jln. Sultan Hasanudin Wolowona Ende Timur'),
('017', 'Manggarai', 'Jln. Ruteng-Borong RT 004/ RW 002 Kel. Laci Cerep Kec. Lanke Rembong'),
('018', 'Manggarai Timur', 'Waereca RT 003 RW 001 Kel. Rana Loba Kec. Borong'),
('019', 'Manggarai Barat', 'Jln. Pius Papu, Serenaru Samping Anora Cell RT 013 RW 003 Kel.  Wae Kelambu Kec. Komodo, Labuan Bajo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kantor_kas`
--

CREATE TABLE `kantor_kas` (
  `id_kas` varchar(7) NOT NULL,
  `kode_cabang` varchar(5) DEFAULT NULL,
  `nama_kantorKas` varchar(200) DEFAULT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kantor_kas`
--

INSERT INTO `kantor_kas` (`id_kas`, `kode_cabang`, `nama_kantorKas`, `alamat`) VALUES
('001.001', '001', 'Oesapa', 'Jln. Timor Raya KM.8, Kel. Oesapa, Kec. Kelapa Lima, Kota Kupang'),
('001.002', '001', 'Alak', 'Jln. Yos Sudarso, Alak, Kota Kupang'),
('001.003', '001', 'Naikoten', 'Jln. Kenari , Kel. Naikoten 1, Kec. Kota Raja, Kota Kupang'),
('001.004', '001', 'Baun', 'Jln. H. R. Koroh, Amarasi timur, Kupang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` varchar(200) NOT NULL,
  `id_kanKas` varchar(5) DEFAULT NULL,
  `nama_kankas` varchar(200) NOT NULL,
  `nama_laporan` varchar(200) NOT NULL,
  `periode` varchar(200) NOT NULL,
  `ttlSSTbulan` int(11) DEFAULT NULL,
  `ttlNILAIjmlh` int(11) DEFAULT NULL,
  `ttlSISAnilaiPnyustan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `id_kanKas`, `nama_kankas`, `nama_laporan`, `periode`, `ttlSSTbulan`, `ttlNILAIjmlh`, `ttlSISAnilaiPnyustan`) VALUES
('112345', NULL, 'Maulafa', 'Laporan Amortisasi Periode Januari - Desember 2020', '01/03/2020 - 01/12/2020', 913021, 141000000, 13442125),
('123456', NULL, 'Naikoten', 'Laporan Penyusutan Aset Tahun 2019', '01/05/2020 - 01/12/2020', 304125, 15200000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `level` enum('admin','operator') NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `level`, `username`, `password`) VALUES
(1, 'admin', 'semry', '$2y$10$b8m4sFltB0wqmOPfOyJt..lBDt8CFM07yWAFESkyZFItxnqQEXCXS'),
(2, 'operator', 'esty', '$2y$10$a0ns27DUngjGHJnqVm6BQOoYjORpJCkBji09tyEha2ks3/Lex5cYu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amortisasi`
--
ALTER TABLE `amortisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`kode_aset`),
  ADD KEY `id_lprn` (`id_lprn`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`kode_cabang`);

--
-- Indexes for table `kantor_kas`
--
ALTER TABLE `kantor_kas`
  ADD PRIMARY KEY (`id_kas`),
  ADD KEY `kode_cabang` (`kode_cabang`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kas` (`id_kanKas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amortisasi`
--
ALTER TABLE `amortisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `aset_ibfk_1` FOREIGN KEY (`id_lprn`) REFERENCES `laporan` (`id`);

--
-- Ketidakleluasaan untuk tabel `kantor_kas`
--
ALTER TABLE `kantor_kas`
  ADD CONSTRAINT `kantor_kas_ibfk_1` FOREIGN KEY (`kode_cabang`) REFERENCES `cabang` (`kode_cabang`);

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_kanKas`) REFERENCES `kantor_kas` (`id_kas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
