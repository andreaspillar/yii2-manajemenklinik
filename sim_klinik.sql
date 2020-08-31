-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2020 at 02:03 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_pasien`
--

CREATE TABLE `tbl_data_pasien` (
  `kode_pasien` varchar(128) NOT NULL,
  `nama_pasien` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_data_pasien`
--

INSERT INTO `tbl_data_pasien` (`kode_pasien`, `nama_pasien`, `alamat`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`) VALUES
('AH-1', 'Budi Sumardi', 'Bandung', '0', 'Bandung', '1998-08-27'),
('AH-2', 'Toto Gelap', 'Tangerang', '0', 'Purwakarta', '1998-08-27'),
('AH-3', 'Naruto', 'Jambi', '0', 'Aceh', '1997-08-13'),
('AH-4', 'Hinata', 'Papua', '1', 'Manado', '1998-04-09'),
('AH-5', 'Mona', 'Salatiga', '1', 'Pekalongan', '2005-11-19'),
('AH-6', 'Eko', 'Gresik', '0', 'Kediri', '1980-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kunjungan_dokter`
--

CREATE TABLE `tbl_kunjungan_dokter` (
  `no_kunjungan` varchar(128) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `kode_pasien` varchar(128) NOT NULL,
  `nomor_induk_karyawan` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_kunjungan_dokter`
--

INSERT INTO `tbl_kunjungan_dokter` (`no_kunjungan`, `tanggal_kunjungan`, `kode_pasien`, `nomor_induk_karyawan`, `status`) VALUES
('K-1', '2020-09-01', 'AH-6', 1, 1),
('K-2', '2020-09-01', 'AH-5', 6, 1),
('K-3', '2020-09-02', 'AH-3', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lap_pemeriksaan`
--

CREATE TABLE `tbl_lap_pemeriksaan` (
  `kode_laporan` varchar(128) NOT NULL,
  `no_kunjungan` varchar(128) NOT NULL,
  `diagnosa` text NOT NULL,
  `tindakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_lap_pemeriksaan`
--

INSERT INTO `tbl_lap_pemeriksaan` (`kode_laporan`, `no_kunjungan`, `diagnosa`, `tindakan`) VALUES
('C-1', 'K-1', 'Radang Tenggorokan', 'Istirahat yang cukup'),
('C-2', 'K-2', 'Demam', 'Tidur yang cukup, tidak boleh makan es krim'),
('C-3', 'K-3', 'Pegal Linu, Kram', 'Tidur yang benar, jangan kebanyakan lari ');

--
-- Triggers `tbl_lap_pemeriksaan`
--
DELIMITER $$
CREATE TRIGGER `kunjungan_updt` AFTER INSERT ON `tbl_lap_pemeriksaan` FOR EACH ROW BEGIN	
     UPDATE tbl_kunjungan_dokter SET status = 1
     WHERE no_kunjungan = NEW.no_kunjungan;    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kunjungan_updt_lap_updt` AFTER UPDATE ON `tbl_lap_pemeriksaan` FOR EACH ROW BEGIN	
     UPDATE tbl_kunjungan_dokter SET status = 1
     WHERE no_kunjungan = NEW.no_kunjungan;    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_barang`
--

CREATE TABLE `tbl_master_barang` (
  `id_barang` bigint(100) NOT NULL,
  `nama_barang` varchar(64) NOT NULL,
  `produsen` varchar(64) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `satuan` varchar(8) NOT NULL,
  `stok_barang` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_master_barang`
--

INSERT INTO `tbl_master_barang` (`id_barang`, `nama_barang`, `produsen`, `harga`, `satuan`, `stok_barang`) VALUES
(1, 'Obat Paracetamol - Puyeng Bintang 3', 'PT Bintang Tiga', '2500.00', 'strip', 7),
(2, 'Obat Maag - Kimaagh', 'PT Komikimax', '1500.00', 'tablet', 10),
(3, 'Vitamin C - Citamin C#', 'PT Takedown', '1200.00', 'tablet', 10),
(4, 'Obat Paracetamol - Tempe', 'PT Taychan Pharmaceunah', '5000.00', 'botol', 14),
(5, 'Obat Flu - HyperFlu', 'PT Handsome Farming', '2500.00', 'strip', 8),
(6, 'Obat Diare - Diempet', 'PT Songo Global Health', '3000.00', 'strip', 10),
(7, 'Salep Kulit - Kalapan-U', 'PT Kalap Farming', '3400.00', 'tube', 8),
(8, 'Obat Nyeri - Nur-one-asyik', 'PT Tompo Atlantik', '1500.00', 'strip', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resep_dokter`
--

CREATE TABLE `tbl_resep_dokter` (
  `kode_resep` varchar(128) NOT NULL,
  `kode_laporan` varchar(128) NOT NULL,
  `id_barang` bigint(100) NOT NULL,
  `jumlah_barang` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_resep_dokter`
--

INSERT INTO `tbl_resep_dokter` (`kode_resep`, `kode_laporan`, `id_barang`, `jumlah_barang`) VALUES
('R-1', 'C-2', 4, 1),
('R-2', 'C-1', 1, 2),
('R-3', 'C-1', 5, 1),
('R-4', 'C-3', 8, 2);

--
-- Triggers `tbl_resep_dokter`
--
DELIMITER $$
CREATE TRIGGER `barang_updt` AFTER INSERT ON `tbl_resep_dokter` FOR EACH ROW BEGIN
	DECLARE stock BIGINT(20);
    SELECT stok_barang into stock
    FROM tbl_master_barang
    WHERE id_barang = NEW.id_barang;
    
    UPDATE tbl_master_barang
    SET stok_barang = (stock - NEW.jumlah_barang)
    WHERE id_barang = NEW.id_barang;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `brg_updt_after_updt` AFTER UPDATE ON `tbl_resep_dokter` FOR EACH ROW BEGIN
	DECLARE stock BIGINT(20);
    SELECT stok_barang into stock
    FROM tbl_master_barang
    WHERE id_barang = NEW.id_barang;
    
    UPDATE tbl_master_barang
    SET stok_barang = (stock - NEW.jumlah_barang)
    WHERE id_barang = NEW.id_barang;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `brg_updt_before_updt` BEFORE UPDATE ON `tbl_resep_dokter` FOR EACH ROW BEGIN
	DECLARE stock BIGINT(20);
    SELECT stok_barang into stock
    FROM tbl_master_barang
    WHERE id_barang = OLD.id_barang;
    
    UPDATE tbl_master_barang
    SET stok_barang = (stock + OLD.jumlah_barang)
    WHERE id_barang = OLD.id_barang;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `brg_updt_del` BEFORE DELETE ON `tbl_resep_dokter` FOR EACH ROW BEGIN
	DECLARE stock BIGINT(20);
    SELECT stok_barang into stock
    FROM tbl_master_barang
    WHERE id_barang = OLD.id_barang;
    
    UPDATE tbl_master_barang
    SET stok_barang = (stock + OLD.jumlah_barang)
    WHERE id_barang = OLD.id_barang;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_dok`
--

CREATE TABLE `tbl_staff_dok` (
  `nomor_induk_karyawan` bigint(20) NOT NULL,
  `nama_tenaga_medis` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `id_user` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_staff_dok`
--

INSERT INTO `tbl_staff_dok` (`nomor_induk_karyawan`, `nama_tenaga_medis`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `alamat`, `id_user`) VALUES
(1, 'dr Budi', '0', '1997-05-04', 'Jakarta', 'Bandung', 3),
(4, 'Dr Tito Sp.B', '0', '1997-07-06', 'Medan', 'Jakarta', 5),
(5, 'Dr Anna Sp.OG', '1', '1984-07-06', 'Denpasar', 'Gresik', 6),
(6, 'dr Tian', '0', '1978-01-23', 'Pekanbaru', 'Flores', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_access`
--

CREATE TABLE `tbl_user_access` (
  `id_user` int(100) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `user_access` int(2) NOT NULL COMMENT '1. Admin\r\n2. Keuangan\r\n3. Dokter\r\n4. Apoteker\r\n5, Pendaftaran\r\n6. HR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_access`
--

INSERT INTO `tbl_user_access` (`id_user`, `username`, `password`, `user_access`) VALUES
(1, 'admin', '123456', 1),
(2, 'pendaftaran', '123456', 5),
(3, 'drbudi', 'drbudi', 3),
(4, 'apoteker', '123456', 4),
(5, 'drtito', '1234567890', 3),
(6, 'dranna', '123456', 3),
(7, 'drtian', 'tiancok', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_data_pasien`
--
ALTER TABLE `tbl_data_pasien`
  ADD PRIMARY KEY (`kode_pasien`);

--
-- Indexes for table `tbl_kunjungan_dokter`
--
ALTER TABLE `tbl_kunjungan_dokter`
  ADD PRIMARY KEY (`no_kunjungan`),
  ADD KEY `FK_PASIEN` (`kode_pasien`),
  ADD KEY `FK_DOKTER` (`nomor_induk_karyawan`);

--
-- Indexes for table `tbl_lap_pemeriksaan`
--
ALTER TABLE `tbl_lap_pemeriksaan`
  ADD PRIMARY KEY (`kode_laporan`),
  ADD KEY `FK_KUNJUNGAN` (`no_kunjungan`);

--
-- Indexes for table `tbl_master_barang`
--
ALTER TABLE `tbl_master_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_resep_dokter`
--
ALTER TABLE `tbl_resep_dokter`
  ADD PRIMARY KEY (`kode_resep`),
  ADD KEY `FK_LAPORAN` (`kode_laporan`),
  ADD KEY `FK_BARANG` (`id_barang`);

--
-- Indexes for table `tbl_staff_dok`
--
ALTER TABLE `tbl_staff_dok`
  ADD PRIMARY KEY (`nomor_induk_karyawan`),
  ADD KEY `FK_USERNAME` (`id_user`);

--
-- Indexes for table `tbl_user_access`
--
ALTER TABLE `tbl_user_access`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_master_barang`
--
ALTER TABLE `tbl_master_barang`
  MODIFY `id_barang` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_staff_dok`
--
ALTER TABLE `tbl_staff_dok`
  MODIFY `nomor_induk_karyawan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user_access`
--
ALTER TABLE `tbl_user_access`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_kunjungan_dokter`
--
ALTER TABLE `tbl_kunjungan_dokter`
  ADD CONSTRAINT `FK_DOKTER` FOREIGN KEY (`nomor_induk_karyawan`) REFERENCES `tbl_staff_dok` (`nomor_induk_karyawan`),
  ADD CONSTRAINT `FK_PASIEN` FOREIGN KEY (`kode_pasien`) REFERENCES `tbl_data_pasien` (`kode_pasien`);

--
-- Constraints for table `tbl_lap_pemeriksaan`
--
ALTER TABLE `tbl_lap_pemeriksaan`
  ADD CONSTRAINT `FK_KUNJUNGAN` FOREIGN KEY (`no_kunjungan`) REFERENCES `tbl_kunjungan_dokter` (`no_kunjungan`);

--
-- Constraints for table `tbl_resep_dokter`
--
ALTER TABLE `tbl_resep_dokter`
  ADD CONSTRAINT `FK_BARANG` FOREIGN KEY (`id_barang`) REFERENCES `tbl_master_barang` (`id_barang`),
  ADD CONSTRAINT `FK_LAPORAN` FOREIGN KEY (`kode_laporan`) REFERENCES `tbl_lap_pemeriksaan` (`kode_laporan`);

--
-- Constraints for table `tbl_staff_dok`
--
ALTER TABLE `tbl_staff_dok`
  ADD CONSTRAINT `FK_USERNAME` FOREIGN KEY (`id_user`) REFERENCES `tbl_user_access` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
