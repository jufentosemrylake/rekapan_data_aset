-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Feb 2021 pada 15.37
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Struktur dari tabel `report`
--

CREATE TABLE `report` (
  `id` varchar(200) NOT NULL,
  `id_user` int(5) NOT NULL,
  `nama_cbg` varchar(200) NOT NULL,
  `nama_kankas` varchar(200) NOT NULL,
  `nama_laporan` varchar(200) NOT NULL,
  `periode` varchar(200) NOT NULL,
  `ttlSSTbulan` int(11) NOT NULL,
  `ttlNILAIjmlh` int(11) NOT NULL,
  `ttlSISAnilaiPnyustan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `report`
--

INSERT INTO `report` (`id`, `id_user`, `nama_cbg`, `nama_kankas`, `nama_laporan`, `periode`, `ttlSSTbulan`, `ttlNILAIjmlh`, `ttlSISAnilaiPnyustan`) VALUES
('123456', 3, 'Kupang Kota', 'Naikoten', 'Contoh', '01/01/2021 - 01/12/2021', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `level` enum('admin','operator') NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `lokasi_cbg` varchar(200) NOT NULL,
  `lokasi_kas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `level`, `username`, `password`, `nama`, `lokasi_cbg`, `lokasi_kas`) VALUES
(1, 'admin', 'semry', '$2y$10$b8m4sFltB0wqmOPfOyJt..lBDt8CFM07yWAFESkyZFItxnqQEXCXS', '', '', ''),
(3, 'operator', 'umi', '$2y$10$bcyigMsohbvujx6LpR9Bt.9A4r.SEC6qW.Bg1Tplrzxjgi.W.ACOK', 'Umi', '001', 'Naikoten');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `amortisasi`
--
ALTER TABLE `amortisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`kode_aset`),
  ADD KEY `id_lprn` (`id_lprn`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`kode_cabang`);

--
-- Indeks untuk tabel `kantor_kas`
--
ALTER TABLE `kantor_kas`
  ADD PRIMARY KEY (`id_kas`),
  ADD KEY `kode_cabang` (`kode_cabang`);

--
-- Indeks untuk tabel `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `amortisasi`
--
ALTER TABLE `amortisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `aset_ibfk_1` FOREIGN KEY (`id_lprn`) REFERENCES `report` (`id`);

--
-- Ketidakleluasaan untuk tabel `kantor_kas`
--
ALTER TABLE `kantor_kas`
  ADD CONSTRAINT `kantor_kas_ibfk_1` FOREIGN KEY (`kode_cabang`) REFERENCES `cabang` (`kode_cabang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
