-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 09:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `penerbit` varchar(200) NOT NULL,
  `pengarang` varchar(200) NOT NULL,
  `isbn` varchar(250) NOT NULL,
  `thn_buku` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `berkas_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penerbit`, `pengarang`, `isbn`, `thn_buku`, `id_kategori`, `foto`, `berkas_file`) VALUES
(21, '3 Sumber Najis', 'Rumah Fiqih Publishing\r\nJalan Karet Pedurenan no. 53 Kuningan \r\nSetiabudi Jakarta Selatan 12940', 'Isnan Ansory, Lc. M.Ag', '334--333', '2020', 63, '1670343084930.JPG', '3_Sumber_Najis.pdf'),
(22, 'Terjemah Matan Abi Syuja’: Sembelihan, Lomba, Sumpah &amp; Nadzar ', 'Rumah Fiqih Publishing\r\nJalan Karet Pedurenan no. 53 Kuningan \r\nSetiabudi Jakarta Selatan 12940\r\n', 'Galih Maulana, Lc', '-', '2018', 63, '1668230104816.png', '9_Sembelihan,_Lomba,_Sumpah_Nadzar.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Kepala Perpustakaan'),
(5, 'Kepala Madrasah'),
(7, 'Layanan Pemustaka'),
(8, 'Layanan TI'),
(9, 'Layanan Teknis');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(150) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`) VALUES
(60, '000', 'Generalities (karya Umum)'),
(62, '100', 'Philosopy and Psychologi (Filsafat dan Psikologi)'),
(63, '200', 'Religion (Agama)'),
(64, '300', 'Social Science (Ilmu-ilmu Sosial)'),
(65, '400', 'Language (Bahasa)'),
(66, '500', 'Natural Science and Mathemathics (Ilmu-ilmu Alam dan Matematika)'),
(67, '600', 'Technology and Applied Science (Teknologi dan Ilmu-ilmu Terapan)'),
(68, '700', 'The Art , Fine and Sport (Kesenian, Hiburan dan Olahraga)'),
(69, '800', 'Literature and Rhetoric (Kesusastraan)'),
(70, '900', 'Geography and History (Geografi dan Sejarah)');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(200) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `nip`, `tmpt_lahir`, `tgl_lahir`, `no_telp`, `id_jabatan`, `alamat`, `foto`) VALUES
(1, 'KHOIRIYATUN, S.Pd, M.Sc', '1977771', 'bantul', '2020-12-05', '0900000', 5, 'qwwwwwwwwwwwwww', '1672712754377.png'),
(7, 'LINA MUTIASIH, M.Pd.', '23233222', 'bantul', '2023-01-10', '0900000', 1, 'BAntull', '1672712817270.png'),
(8, 'ANI MUFATONAH, A.Md', '32111', 'JOGJA', '2023-01-16', '123', 9, 'BANTUL', '1672713043701.png'),
(9, 'SUPARMANTA', '2333', 'bantul', '2023-01-16', '12123122', 7, 'sleman', '1672713085486.png'),
(10, 'Dra. AYU HOLIDAH', '2323322211', 'JAKARTA', '2023-01-22', '0188', 7, 'jakarta', '1672713144176.png'),
(11, 'SRI PURWANINGSIH, S.Pd', '122211', 'jateng', '2023-01-09', '0888', 8, 'jateng', '1672713204275.png');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `no_anggota` varchar(200) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `tmpt_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` varchar(150) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `no_anggota`, `nama`, `nis`, `jk`, `tmpt_lahir`, `tgl_lahir`, `no_telp`, `alamat`, `foto`) VALUES
(25, '20220001', 'Siswa 1', '100101', 'Laki-laki', 'qwwewe', '12 December, 2001', '09889989', 'qwwqqww', '1667194080904.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_pengguna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level_pengguna`) VALUES
(50, 'Vicky Fidiantoro', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(51, 'Agung Nu', 'petugas1', 'b53fe7751b37e40ff34d012c7774d65f', 'Petugas'),
(52, 'Yogi', 'petugas2', '827ccb0eea8a706c4c34a16891f84e7b', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_FK` (`id_kategori`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_FK` (`id_jabatan`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_FK` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_FK` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
