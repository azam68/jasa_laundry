-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 07:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jasa_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `KodeBarang` varchar(5) NOT NULL,
  `NmBarang` varchar(50) NOT NULL,
  `Stok` int(11) NOT NULL,
  `HargaSatuan` int(11) NOT NULL,
  `TglUpdateStok` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`KodeBarang`, `NmBarang`, `Stok`, `HargaSatuan`, `TglUpdateStok`) VALUES
('item1', 'Sabun', 21, 4000, '2016-09-14'),
('item2', 'Parfum', 14, 7000, '2016-10-21'),
('item3', 'Pulpen', 8, 3000, '2024-06-23'),
('item4', 'Plastik Laundry', 18, 4000, '2024-06-23'),
('item5', 'Nota Bon', 7, 5000, '2024-06-23'),
('item6', 'Sikat Baju', 3, 10000, '2024-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laundry`
--

CREATE TABLE `jenis_laundry` (
  `IDJenisLaundry` varchar(5) NOT NULL,
  `NmJenisLaundry` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenis_laundry`
--

INSERT INTO `jenis_laundry` (`IDJenisLaundry`, `NmJenisLaundry`) VALUES
('c', 'Cuci'),
('ck', 'Cuci Kering'),
('cks', 'Cuci Kering Setrika');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `NIK` varchar(20) NOT NULL,
  `NmKaryawan` varchar(50) NOT NULL,
  `AlmtKaryawan` varchar(50) NOT NULL,
  `TelpKaryawan` varchar(13) NOT NULL,
  `GenderKaryawan` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`NIK`, `NmKaryawan`, `AlmtKaryawan`, `TelpKaryawan`, `GenderKaryawan`) VALUES
('9383829292', 'Siswo Aji', 'Malang', '0818837392920', 'L'),
('admin', 'Abdullah Azam', 'Klaten', '087759659653', 'L'),
('kyw02', 'Izzulia Rahma', 'Jl.Kenangan', '085444333155', 'P'),
('kyw03', 'Rina Agustina', 'Jl.Polehan Gg.4 No.30', '085444993201', 'P'),
('mmg111', 'Misael Farhan', 'Jl.Gempol Bisa Malang Bisa Sidoarjo', '0888575757575', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `KodeKonsumen` varchar(5) NOT NULL,
  `NmKonsumen` varchar(50) NOT NULL,
  `AlmtKonsumen` varchar(50) NOT NULL,
  `TelpKonsumen` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`KodeKonsumen`, `NmKonsumen`, `AlmtKonsumen`, `TelpKonsumen`) VALUES
('kmz87', 'mau tahu aja', 'jl pelan-pelan banyak anak kecil yoooowh', '083876543219'),
('ksm03', 'Kucing Arab', 'Jl.Ciliwung 94', '081555998955'),
('mmb22', 'Robertus', 'Jl.Kenangan', '191919199191'),
('mmb3', 'Kelinci ', 'rumah', '09938488484'),
('mmb4', 'Muhammad Kurniawan', 'Jl.turun dituntun', '303030303030');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `TypeUser` varchar(10) NOT NULL,
  `NIK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `TypeUser`, `NIK`) VALUES
('admin', 'admin', 'admin', 'admin'),
('misael2', 'sael123', 'operator', 'mmg111'),
('rahma', 'rahma123', 'user', 'kyw02'),
('rina', 'rina123', 'operator', 'kyw03');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian_barang`
--

CREATE TABLE `pemakaian_barang` (
  `KodePengeluaran` varchar(5) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `KodeBarang` varchar(5) NOT NULL,
  `NIK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pemakaian_barang`
--

INSERT INTO `pemakaian_barang` (`KodePengeluaran`, `Jumlah`, `KodeBarang`, `NIK`) VALUES
('kode1', 5, 'item1', 'admin'),
('kode2', 4, 'item2', 'kyw03'),
('kode3', 7, 'item2', 'kyw03');

--
-- Triggers `pemakaian_barang`
--
DELIMITER $$
CREATE TRIGGER `pakaibarang` AFTER INSERT ON `pemakaian_barang` FOR EACH ROW BEGIN
    UPDATE barang
    SET stok = stok - NEW.Jumlah
    WHERE KodeBarang = NEW.KodeBarang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pakaibarang2` AFTER UPDATE ON `pemakaian_barang` FOR EACH ROW BEGIN
    DECLARE jumlah_diff INT;
    SET jumlah_diff = NEW.Jumlah - OLD.Jumlah;

    UPDATE barang
    SET stok = stok - jumlah_diff
    WHERE KodeBarang = NEW.KodeBarang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pakaibarang3` AFTER DELETE ON `pemakaian_barang` FOR EACH ROW BEGIN
    UPDATE barang
    SET Stok = Stok + OLD.Jumlah
    WHERE KodeBarang = OLD.KodeBarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `NoPembelian` varchar(5) NOT NULL,
  `TglPembelian` date NOT NULL,
  `TotalBiaya` int(11) NOT NULL,
  `IDSupplier` varchar(5) NOT NULL,
  `NIK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`NoPembelian`, `TglPembelian`, `TotalBiaya`, `IDSupplier`, `NIK`) VALUES
('beli1', '2024-06-05', 8000, 'sup02', 'kyw03'),
('beli2', '2016-08-06', 105000, 'sup02', 'kyw03'),
('beli3', '2024-06-22', 20000, 'sup02', 'kyw02'),
('beli4', '2024-06-23', 12000, 'sup03', 'kyw03'),
('beli5', '2024-06-24', 9000, 'sup03', 'kyw03');

-- --------------------------------------------------------

--
-- Table structure for table `rincian_pembelian`
--

CREATE TABLE `rincian_pembelian` (
  `NoRincian` varchar(50) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `NoPembelian` varchar(5) NOT NULL,
  `KodeBarang` varchar(5) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rincian_pembelian`
--

INSERT INTO `rincian_pembelian` (`NoRincian`, `Jumlah`, `NoPembelian`, `KodeBarang`, `Total`) VALUES
('rincian01', 10, 'beli2', 'item2', 70000),
('rincian02', 5, 'beli2', 'item2', 35000),
('rincian03', 2, 'beli1', 'item1', 8000),
('rincian04', 5, 'beli3', 'item1', 20000),
('rincian05', 3, 'beli4', 'item4', 12000),
('rincian06', 3, 'beli5', 'item3', 9000);

--
-- Triggers `rincian_pembelian`
--
DELIMITER $$
CREATE TRIGGER `tambahbarang` AFTER UPDATE ON `rincian_pembelian` FOR EACH ROW BEGIN
    DECLARE jumlah_diff INT;
    SET jumlah_diff = NEW.Jumlah - OLD.Jumlah;

    UPDATE barang
    SET stok = stok + jumlah_diff
    WHERE KodeBarang = NEW.KodeBarang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahbarang2` AFTER INSERT ON `rincian_pembelian` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + NEW.Jumlah
WHERE KodeBarang = NEW.KodeBarang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahbarang3` AFTER DELETE ON `rincian_pembelian` FOR EACH ROW BEGIN
    UPDATE barang
    SET stok = stok - OLD.Jumlah
    WHERE KodeBarang = OLD.KodeBarang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `total` BEFORE INSERT ON `rincian_pembelian` FOR EACH ROW BEGIN
    DECLARE harga INT(11);
    SELECT HargaSatuan INTO harga
    FROM barang
    WHERE KodeBarang = NEW.KodeBarang;
    SET NEW.Total = NEW.Jumlah * harga;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `total2` BEFORE UPDATE ON `rincian_pembelian` FOR EACH ROW BEGIN
    DECLARE harga DECIMAL(10, 2);
    SELECT HargaSatuan INTO harga
    FROM barang
    WHERE KodeBarang = NEW.KodeBarang;
    SET NEW.Total = NEW.Jumlah * harga;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `total3` AFTER INSERT ON `rincian_pembelian` FOR EACH ROW BEGIN
    UPDATE pembelian p
    SET p.TotalBiaya = (
        SELECT SUM(rp.TOTAL)
        FROM rincian_pembelian rp
        WHERE rp.NOPEMBELIAN = NEW.NOPEMBELIAN
    )
    WHERE p.NOPEMBELIAN = NEW.NOPEMBELIAN;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `total4` AFTER UPDATE ON `rincian_pembelian` FOR EACH ROW BEGIN
    UPDATE pembelian p
    SET p.TotalBiaya = (
        SELECT SUM(rp.TOTAL)
        FROM rincian_pembelian rp
        WHERE rp.NOPEMBELIAN = NEW.NOPEMBELIAN
    )
    WHERE p.NOPEMBELIAN = NEW.NOPEMBELIAN;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `total5` AFTER DELETE ON `rincian_pembelian` FOR EACH ROW BEGIN
    UPDATE pembelian p
    SET p.TotalBiaya = (
        SELECT IFNULL(SUM(rp.TOTAL), 0)
        FROM rincian_pembelian rp
        WHERE rp.NOPEMBELIAN = OLD.NOPEMBELIAN
    )
    WHERE p.NOPEMBELIAN = OLD.NOPEMBELIAN;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rincian_transaksi`
--

CREATE TABLE `rincian_transaksi` (
  `IDRincian` varchar(11) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `NoTransaksi` varchar(5) NOT NULL,
  `IDJenisPakaian` varchar(10) NOT NULL,
  `TotalHarga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rincian_transaksi`
--

INSERT INTO `rincian_transaksi` (`IDRincian`, `Jumlah`, `NoTransaksi`, `IDJenisPakaian`, `TotalHarga`) VALUES
('rincian_10', 2, 't0006', 'cks_bcovb', 46000),
('rincian_t1', 8, 't0002', 'c_sajadah', 96000),
('rincian_t2', 4, 't0004', 'c_sajadah', 48000),
('rincian_t3', 2, 't0004', 'c_sajadah', 24000),
('rincian_t4', 4, 't0001', 'c_slayer', 40000),
('rincian_t5', 5, 't0003', 'ck_sajadah', 75000),
('rincian_t6', 7, 't0003', 'c_sajadah', 84000),
('rincian_t7', 4, 't0005', 'cks_kiloan', 36000),
('rincian_t8', 2, 't0005', 'cks_slmuts', 18000),
('rincian_t9', 1, 't0005', 'cks_bcovb', 23000);

--
-- Triggers `rincian_transaksi`
--
DELIMITER $$
CREATE TRIGGER `totalharga` BEFORE INSERT ON `rincian_transaksi` FOR EACH ROW BEGIN
    DECLARE v_tarif INT(11);

    SELECT Tarif INTO v_tarif
    FROM tarif
    WHERE IDJenisPakaian = NEW.IDJenisPakaian;

    SET NEW.TotalHarga = NEW.Jumlah * v_tarif;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `totalharga2` BEFORE UPDATE ON `rincian_transaksi` FOR EACH ROW BEGIN
    DECLARE v_tarif INT(11);

    SELECT Tarif INTO v_tarif
    FROM tarif
    WHERE IDJenisPakaian = NEW.IDJenisPakaian;

    SET NEW.TotalHarga = NEW.Jumlah * v_tarif;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `totaltransaksi` AFTER INSERT ON `rincian_transaksi` FOR EACH ROW BEGIN
    DECLARE total INT(11);
    SELECT SUM(totalharga) INTO total
    FROM rincian_transaksi
    WHERE notransaksi = NEW.notransaksi;
    UPDATE transaksi
    SET totaltransaksi = total
    WHERE notransaksi = NEW.notransaksi;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `totaltransaksi2` AFTER UPDATE ON `rincian_transaksi` FOR EACH ROW BEGIN
    DECLARE total DECIMAL(10, 2);
    SELECT SUM(totalharga) INTO total
    FROM rincian_transaksi
    WHERE notransaksi = NEW.notransaksi;
    UPDATE transaksi
    SET totaltransaksi = total
    WHERE notransaksi = NEW.notransaksi;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `totaltransaksi3` AFTER DELETE ON `rincian_transaksi` FOR EACH ROW BEGIN
    DECLARE total DECIMAL(10, 2);
    SELECT SUM(totalharga) INTO total
    FROM rincian_transaksi
    WHERE notransaksi = OLD.notransaksi;
    UPDATE transaksi
    SET totaltransaksi = IFNULL(total, 0)
    WHERE notransaksi = OLD.notransaksi;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `IDSupplier` varchar(5) NOT NULL,
  `NmSupplier` varchar(50) NOT NULL,
  `AlmtSupplier` varchar(50) NOT NULL,
  `TelpSupplier` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`IDSupplier`, `NmSupplier`, `AlmtSupplier`, `TelpSupplier`) VALUES
('sup01', 'Express', 'Jl.Bend.Sutarmi No.9E', '0341558029'),
('sup02', 'Laundryplasa', 'Jl. Sulfat Agung, Indah II no 31A', '0341495805'),
('sup03', 'Irul 48', 'Jl.Letjend Soetoyo IV No.34', '03417562123');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `IDJenisPakaian` varchar(10) NOT NULL,
  `NmPakaian` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL,
  `IDJenisLaundry` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`IDJenisPakaian`, `NmPakaian`, `tarif`, `IDJenisLaundry`) VALUES
('cks_bcovb', 'Bed Cover Besar', 23000, 'cks'),
('cks_kiloan', 'Kiloan', 9000, 'cks'),
('cks_slmutb', 'Selimut Besar', 11000, 'cks'),
('cks_slmutk', 'Selimut Kecil', 7000, 'cks'),
('cks_slmuts', 'Selimut Sedang', 9000, 'cks'),
('ck_kiloan', 'Kiloan', 7000, 'ck'),
('ck_sajadah', 'Sajadah', 15000, 'ck'),
('ck_slayer', 'Slayer', 12000, 'ck'),
('c_kiloan', 'Kiloan', 5000, 'c'),
('c_sajadah', 'Sajadah', 12000, 'c'),
('c_slayer', 'Slayer', 10000, 'ck');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `NoTransaksi` varchar(5) NOT NULL,
  `TglTransaksi` date NOT NULL,
  `TglAmbil` date NOT NULL,
  `TotalTransaksi` int(11) NOT NULL,
  `KodeKonsumen` varchar(5) NOT NULL,
  `NIK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`NoTransaksi`, `TglTransaksi`, `TglAmbil`, `TotalTransaksi`, `KodeKonsumen`, `NIK`) VALUES
('t0001', '2024-06-20', '2024-06-23', 40000, 'ksm03', 'kyw02'),
('t0002', '2016-08-06', '2016-08-25', 96000, 'mmb3', 'kyw02'),
('t0003', '2024-06-23', '2024-06-25', 159000, 'mmb3', 'mmg111'),
('t0004', '2024-06-22', '2024-06-24', 72000, 'ksm03', 'kyw03'),
('t0005', '2024-06-24', '2024-06-26', 77000, 'mmb22', '9383829292'),
('t0006', '2024-06-24', '2024-06-26', 46000, 'mmb22', 'kyw02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`KodeBarang`);

--
-- Indexes for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  ADD PRIMARY KEY (`IDJenisLaundry`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`NIK`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`KodeKonsumen`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `NIK` (`NIK`);

--
-- Indexes for table `pemakaian_barang`
--
ALTER TABLE `pemakaian_barang`
  ADD PRIMARY KEY (`KodePengeluaran`),
  ADD KEY `pemakaian_barang_ibfk_1` (`KodeBarang`),
  ADD KEY `pemakaian_barang_ibfk_2` (`NIK`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`NoPembelian`),
  ADD KEY `NIK` (`NIK`),
  ADD KEY `IDSupplier` (`IDSupplier`);

--
-- Indexes for table `rincian_pembelian`
--
ALTER TABLE `rincian_pembelian`
  ADD PRIMARY KEY (`NoRincian`),
  ADD KEY `NoPembelian` (`NoPembelian`),
  ADD KEY `KodeBarang` (`KodeBarang`);

--
-- Indexes for table `rincian_transaksi`
--
ALTER TABLE `rincian_transaksi`
  ADD PRIMARY KEY (`IDRincian`),
  ADD KEY `NoTransaksi` (`NoTransaksi`),
  ADD KEY `IDJenisPakaian` (`IDJenisPakaian`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`IDSupplier`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`IDJenisPakaian`),
  ADD KEY `IDJenisLaundry` (`IDJenisLaundry`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`NoTransaksi`),
  ADD KEY `KodeKonsumen` (`KodeKonsumen`),
  ADD KEY `NIK` (`NIK`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemakaian_barang`
--
ALTER TABLE `pemakaian_barang`
  ADD CONSTRAINT `pemakaian_barang_ibfk_1` FOREIGN KEY (`KodeBarang`) REFERENCES `barang` (`KodeBarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pemakaian_barang_ibfk_2` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`IDSupplier`) REFERENCES `supplier` (`IDSupplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rincian_pembelian`
--
ALTER TABLE `rincian_pembelian`
  ADD CONSTRAINT `rincian_pembelian_ibfk_1` FOREIGN KEY (`NoPembelian`) REFERENCES `pembelian` (`NoPembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rincian_pembelian_ibfk_2` FOREIGN KEY (`KodeBarang`) REFERENCES `barang` (`KodeBarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rincian_transaksi`
--
ALTER TABLE `rincian_transaksi`
  ADD CONSTRAINT `rincian_transaksi_ibfk_1` FOREIGN KEY (`NoTransaksi`) REFERENCES `transaksi` (`NoTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rincian_transaksi_ibfk_2` FOREIGN KEY (`IDJenisPakaian`) REFERENCES `tarif` (`IDJenisPakaian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`IDJenisLaundry`) REFERENCES `jenis_laundry` (`IDJenisLaundry`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`KodeKonsumen`) REFERENCES `konsumen` (`KodeKonsumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
