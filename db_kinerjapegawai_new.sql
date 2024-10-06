/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nm_lengkap` varchar(100) DEFAULT NULL,
  `jeniskelamin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `foto_admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `file` mediumblob DEFAULT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  `tipe_file` varchar(10) DEFAULT NULL,
  `ukuran_file` varchar(50) DEFAULT NULL,
  `id_admin` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `FK_foto_admin_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


CREATE TABLE `posisi` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nm_pegawai` varchar(100) DEFAULT NULL,
  `jeniskelamin` varchar(1) DEFAULT NULL,
  `id_posisi` int(11) DEFAULT NULL,
  `ttl` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`),
  UNIQUE KEY `username` (`username`),
  KEY `id_posisi` (`id_posisi`),
  CONSTRAINT `FK_pegawai_posisi` FOREIGN KEY (`id_posisi`) REFERENCES `posisi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

CREATE TABLE `foto_pegawai` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `file` mediumblob NOT NULL DEFAULT '0',
  `nama_file` varchar(100) NOT NULL DEFAULT '0',
  `tipe_file` varchar(50) NOT NULL DEFAULT '0',
  `ukuran_file` varchar(100) NOT NULL DEFAULT '0',
  `id_pegawai` int(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_pegawai` (`id_pegawai`),
  CONSTRAINT `FK_foto_pegawai_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

CREATE TABLE `kriteria` (
  `id_kriteria` int(20) NOT NULL AUTO_INCREMENT,
  `nm_kriteria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

CREATE TABLE `nilai` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(20) DEFAULT NULL,
  `id_kriteria` int(20) DEFAULT NULL,
  `nilai` int(20) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_nilai_kriteria` (`id_kriteria`),
  KEY `FK_nilai_pegawai` (`id_pegawai`),
  CONSTRAINT `FK_nilai_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nilai_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`id`, `username`, `password`, `email`, `nm_lengkap`, `jeniskelamin`) VALUES
(1, 'admin', 'admin123', 'admin@company.com', 'Noda Youjirou', 'Laki-laki');

INSERT INTO `posisi` (`id`, `nama`) VALUES
(1, 'Software Development');
INSERT INTO `posisi` (`id`, `nama`) VALUES
(2, 'Website Development');
INSERT INTO `posisi` (`id`, `nama`) VALUES
(3, 'System Analyst');
INSERT INTO `posisi` (`id`, `nama`) VALUES
(4, 'Network Security'),
(5, 'IT Support'),
(6, 'None');


INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `email`, `nm_pegawai`, `jeniskelamin`, `id_posisi`, `ttl`, `alamat`) VALUES
(1, 'pegawai1', 'test1234', 'user@company.com', 'AAA', 'L', 2, 'Jakarta, 18 Agustus 1998', 'Jakarta Pusat');
INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `email`, `nm_pegawai`, `jeniskelamin`, `id_posisi`, `ttl`, `alamat`) VALUES
(2, 'pegawai2', 'test123', 'user@test.com', 'Pegawai 2', 'L', 2, 'Jakarta, 18 Agustus 1998', 'Jakarta');
INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `email`, `nm_pegawai`, `jeniskelamin`, `id_posisi`, `ttl`, `alamat`) VALUES
(10, 'hafid123', '123123', 'abcde', 'Abdul Hafidz', 'L', 1, 'Lamongan, 08 July 2019', 'Lamongan');


INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`) VALUES
(1, 'Kesetiaan');
INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`) VALUES
(2, 'Kejujuran');
INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`) VALUES
(3, 'Kepemimpinan');
INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`) VALUES
(4, 'Kerjasama');

INSERT INTO `nilai` (`id`, `id_pegawai`, `id_kriteria`, `nilai`, `waktu`) VALUES
(41, 1, 1, 3, '2020-05-17 03:45:36');
INSERT INTO `nilai` (`id`, `id_pegawai`, `id_kriteria`, `nilai`, `waktu`) VALUES
(42, 1, 2, 3, '2020-05-17 03:45:36');
INSERT INTO `nilai` (`id`, `id_pegawai`, `id_kriteria`, `nilai`, `waktu`) VALUES
(43, 1, 3, 6, '2020-05-17 03:45:36');
INSERT INTO `nilai` (`id`, `id_pegawai`, `id_kriteria`, `nilai`, `waktu`) VALUES
(44, 1, 4, 8, '2020-05-17 03:45:36'),
(45, 1, 1, 86, '2020-05-17 03:46:07'),
(46, 1, 2, 72, '2020-05-17 03:46:07'),
(47, 1, 3, 78, '2020-05-17 03:46:07'),
(48, 1, 4, 8, '2020-05-17 03:46:07'),
(49, 1, 1, 86, '2020-05-17 03:46:38'),
(50, 1, 2, 72, '2020-05-17 03:46:38'),
(51, 1, 3, 78, '2020-05-17 03:46:38'),
(52, 1, 4, 85, '2020-05-17 03:46:38'),
(53, 2, 1, 72, '2020-05-17 03:47:03'),
(54, 2, 2, 66, '2020-05-17 03:47:03'),
(55, 2, 3, 77, '2020-05-17 03:47:03'),
(56, 2, 4, 75, '2020-05-17 03:47:03'),
(57, 10, 1, 96, '2020-05-17 04:38:00'),
(58, 10, 2, 86, '2020-05-17 04:38:00'),
(59, 10, 3, 78, '2020-05-17 04:38:00'),
(60, 10, 4, 81, '2020-05-17 04:38:00'),
(61, 10, 1, 100, '2020-05-17 07:45:08'),
(62, 10, 2, 100, '2020-05-17 07:45:08'),
(63, 10, 3, 100, '2020-05-17 07:45:08'),
(64, 10, 4, 100, '2020-05-17 07:45:08');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;