/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.27-0ubuntu0.16.04.1 : Database - db_atk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_atk` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_atk`;

/*Table structure for table `app_user` */

DROP TABLE IF EXISTS `app_user`;

CREATE TABLE `app_user` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(6) unsigned NOT NULL DEFAULT '0',
  `id_group` int(5) unsigned NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `superuser` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `access_delete` tinyint(1) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `last_ip` varchar(100) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_group` (`id_group`),
  CONSTRAINT `app_user_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `app_user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1134 DEFAULT CHARSET=utf8;

/*Table structure for table `app_user_group` */

DROP TABLE IF EXISTS `app_user_group`;

CREATE TABLE `app_user_group` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Table structure for table `atk_detail_distribusi` */

DROP TABLE IF EXISTS `atk_detail_distribusi`;

CREATE TABLE `atk_detail_distribusi` (
  `id_detail_distribusi` int(11) NOT NULL AUTO_INCREMENT,
  `id_header_distribusi` int(11) DEFAULT NULL,
  `kode_barang` varchar(15) DEFAULT NULL,
  `jumlah_distribusi` float(24,0) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detail_distribusi`),
  KEY `atk_detail_distribusi_ibfk_1` (`id_header_distribusi`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

/*Table structure for table `atk_detail_pembelian` */

DROP TABLE IF EXISTS `atk_detail_pembelian`;

CREATE TABLE `atk_detail_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_pembelian` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `satuan` varchar(7) DEFAULT NULL,
  `jumlah` decimal(19,4) DEFAULT NULL,
  `harga` decimal(19,4) DEFAULT '0.0000',
  `discount` decimal(19,4) DEFAULT '0.0000',
  `HNA` decimal(19,4) DEFAULT '0.0000',
  `HPP` decimal(19,4) DEFAULT '0.0000',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

/*Table structure for table `atk_header_distribusi` */

DROP TABLE IF EXISTS `atk_header_distribusi`;

CREATE TABLE `atk_header_distribusi` (
  `id_header_distribusi` int(11) NOT NULL AUTO_INCREMENT,
  `no_distribusi` varchar(15) DEFAULT NULL,
  `tgl_distribusi` datetime DEFAULT NULL,
  `lokasi_asal` varchar(10) NOT NULL,
  `lokasi_distribusi` varchar(10) NOT NULL,
  `no_referensi` varchar(15) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `tgl_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_header_distribusi`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Table structure for table `atk_header_pembelian` */

DROP TABLE IF EXISTS `atk_header_pembelian`;

CREATE TABLE `atk_header_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_pembelian` varchar(15) NOT NULL,
  `kode_lokasi` varchar(5) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT NULL,
  `kode_termin` varchar(6) DEFAULT NULL,
  `tanggal_jatuh_tempo` datetime DEFAULT NULL,
  `kode_supplier` varchar(10) DEFAULT NULL,
  `no_referensi` varchar(15) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `total_pembelian` decimal(19,4) DEFAULT '0.0000',
  `potongan_pembelian` decimal(19,4) DEFAULT '0.0000',
  `ppn` decimal(19,4) DEFAULT '0.0000',
  `biaya_pembelian` decimal(19,4) DEFAULT '0.0000',
  `pembelian_bersih` decimal(19,4) DEFAULT '0.0000',
  `saldo_pembelian` decimal(19,4) DEFAULT '0.0000',
  `user_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

/*Table structure for table `atk_rekap_stok` */

DROP TABLE IF EXISTS `atk_rekap_stok`;

CREATE TABLE `atk_rekap_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_rekap` date NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_masuk` int(11) NOT NULL,
  `stok_keluar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3996 DEFAULT CHARSET=utf8;

/*Table structure for table `file_barang_atk` */

DROP TABLE IF EXISTS `file_barang_atk`;

CREATE TABLE `file_barang_atk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(15) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `satuan` varchar(10) DEFAULT '-',
  `kode_kelompok` varchar(5) NOT NULL,
  `kode_supplier` varchar(10) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `harga_beli` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `stok` int(11) NOT NULL DEFAULT '0',
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=810 DEFAULT CHARSET=utf8;

/*Table structure for table `filesupplier` */

DROP TABLE IF EXISTS `filesupplier`;

CREATE TABLE `filesupplier` (
  `KodeSupplier` varchar(10) NOT NULL,
  `NamaSupplier` varchar(50) DEFAULT NULL,
  `AlamatSupplier` varchar(50) DEFAULT NULL,
  `KotaSupplier` varchar(50) DEFAULT NULL,
  `NoTelepon` varchar(25) DEFAULT NULL,
  `NoFaximili` varchar(25) DEFAULT NULL,
  `NPWP` varchar(25) DEFAULT NULL,
  `KontakPerson` varchar(50) DEFAULT NULL,
  `KodeTermin` varchar(6) DEFAULT '-',
  `SaldoHutang` decimal(19,4) DEFAULT '0.0000',
  `urut` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`KodeSupplier`),
  UNIQUE KEY `IX_FileSupplier` (`KodeSupplier`),
  KEY `urut` (`urut`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=latin1;

/*Table structure for table `satker` */

DROP TABLE IF EXISTS `satker`;

CREATE TABLE `satker` (
  `id_satker` int(4) NOT NULL AUTO_INCREMENT,
  `nama_satker` varchar(50) NOT NULL,
  `kode_satker` varchar(5) DEFAULT NULL,
  `monitoring` tinyint(1) NOT NULL DEFAULT '0',
  `last_trans` int(8) unsigned DEFAULT '0',
  `last_date_int` int(8) DEFAULT '0',
  PRIMARY KEY (`id_satker`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

/*Table structure for table `settingformulir` */

DROP TABLE IF EXISTS `settingformulir`;

CREATE TABLE `settingformulir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `KodeLokasi` varchar(5) DEFAULT NULL,
  `JenisTransaksi` tinyint(3) unsigned DEFAULT NULL COMMENT 'StokOpname 0, Distribusi 1, Pembelian 2, ReturPembelian 3, PembayaranHutangTunai 4, PembayaranHutangBank 5, Penjualan 6, ReturPenjualan 7, PenerimaanPiutangTunai 8, PenerimaanPiutangBank 9, PerubahanHargaJual 10, Verifikasi 11',
  `Inisial` varchar(5) DEFAULT NULL,
  `LebarNoTransaksi` tinyint(3) unsigned DEFAULT NULL,
  `PostingBilling` tinyint(3) unsigned DEFAULT NULL,
  `KodeUnitPelayanan` varchar(6) DEFAULT NULL,
  `KodeRuangPelayanan` varchar(6) DEFAULT NULL,
  `JasaFarmasiRI` tinyint(3) unsigned DEFAULT NULL,
  `JasaFarmasiRJ` tinyint(3) unsigned DEFAULT NULL,
  `JasaFarmasiIRD` tinyint(3) unsigned DEFAULT NULL,
  `JasaFarmasiTempo` tinyint(3) unsigned DEFAULT NULL,
  `JasaFarmasiUmum` tinyint(3) unsigned DEFAULT NULL,
  `NilaiJasaRI` decimal(19,4) DEFAULT NULL,
  `NIlaiJasaRJ` decimal(19,4) DEFAULT NULL,
  `NilaiJasaIRD` decimal(19,4) DEFAULT NULL,
  `NilaiJasaTempo` decimal(19,4) DEFAULT NULL,
  `NilaiJasaUmum` decimal(19,4) DEFAULT NULL,
  `NomerTerakhir` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IX_SettingFormulir` (`KodeLokasi`,`JenisTransaksi`),
  KEY `NomerTerakhir` (`NomerTerakhir`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=latin1;

/*Table structure for table `settinglokasistok` */

DROP TABLE IF EXISTS `settinglokasistok`;

CREATE TABLE `settinglokasistok` (
  `KodeLokasi` varchar(7) NOT NULL,
  `LokasiStok` varchar(50) DEFAULT NULL,
  `GudangUtama` tinyint(3) unsigned DEFAULT NULL,
  `Penjualan` tinyint(3) unsigned DEFAULT NULL,
  `Pembelian` tinyint(3) unsigned DEFAULT NULL,
  `StokPositif` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`KodeLokasi`),
  UNIQUE KEY `IX_SettingLokasiStok` (`KodeLokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tabelkelompok` */

DROP TABLE IF EXISTS `tabelkelompok`;

CREATE TABLE `tabelkelompok` (
  `KodeKelompok` varchar(5) NOT NULL,
  `KelompokBarang` varchar(50) DEFAULT NULL,
  `KodePenjualan` varchar(15) DEFAULT NULL,
  `KodeReturPenjualan` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`KodeKelompok`),
  UNIQUE KEY `IX_TabelKelompok` (`KodeKelompok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tabeltermin` */

DROP TABLE IF EXISTS `tabeltermin`;

CREATE TABLE `tabeltermin` (
  `KodeTermin` varchar(5) NOT NULL,
  `Termin` varchar(50) DEFAULT NULL,
  `JenisMasa` tinyint(3) unsigned DEFAULT NULL,
  `Masa` int(11) DEFAULT NULL,
  PRIMARY KEY (`KodeTermin`),
  UNIQUE KEY `IX_TabelTermin` (`KodeTermin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* Trigger structure for table `atk_detail_distribusi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `atk_update_mutasi` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `atk_update_mutasi` AFTER INSERT ON `atk_detail_distribusi` FOR EACH ROW BEGIN
		DECLARE stok_tersisa INT;
		DECLARE stok_baru INT;
		DECLARE cek_rekap INT;
		DECLARE stok_rekap_awal INT;
		DECLARE stok_rekap_baru INT;
		
		SELECT stok FROM `file_barang_atk` WHERE kode_barang = NEW.kode_barang INTO stok_tersisa;
		SET stok_baru = stok_tersisa - NEW.jumlah_distribusi;
		
		/*cek data rekap*/
		SELECT COUNT(*) FROM `atk_rekap_stok` WHERE kode_barang = NEW.kode_barang ORDER BY tgl_rekap DESC INTO cek_rekap;
		
		/*update stokatk file barang*/
		UPDATE `file_barang_atk` SET stok = stok_baru WHERE kode_barang = NEW.kode_barang;
		
		/*update rekap stok*/
		IF cek_rekap > 0 THEN
			SELECT stok_keluar FROM `atk_rekap_stok` WHERE kode_barang = NEW.kode_barang ORDER BY tgl_rekap DESC LIMIT 1 INTO stok_rekap_awal;
			
			SET stok_rekap_baru = stok_rekap_awal + NEW.jumlah_distribusi;
			
			UPDATE `atk_rekap_stok` SET stok_keluar = stok_rekap_baru WHERE kode_barang = NEW.kode_barang ORDER BY tgl_rekap DESC LIMIT 1;
		END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `atk_detail_distribusi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `atk_delete_mutasi` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `atk_delete_mutasi` AFTER DELETE ON `atk_detail_distribusi` FOR EACH ROW BEGIN
	DECLARE stok_tersisa INT;
	DECLARE stok_baru INT;
	DECLARE cek_rekap INT;
	DECLARE stok_rekap_awal INT;
	DECLARE stok_rekap_baru INT;
	
	SELECT stok FROM `file_barang_atk` WHERE kode_barang = OLD.kode_barang INTO stok_tersisa;
	SET stok_baru = stok_tersisa + OLD.jumlah_distribusi;
	
	/*cek data rekap*/
	SELECT COUNT(*) FROM `atk_rekap_stok` WHERE kode_barang = OLD.kode_barang ORDER BY tgl_rekap DESC INTO cek_rekap;
	
	UPDATE `file_barang_atk` SET stok = stok_baru WHERE kode_barang = OLD.kode_barang;
	
	/*update rekap stok*/
	IF cek_rekap > 0 THEN
		SELECT stok_keluar FROM `atk_rekap_stok` WHERE kode_barang = OLD.kode_barang ORDER BY tgl_rekap DESC LIMIT 1 INTO stok_rekap_awal;
		
		SET stok_rekap_baru = stok_rekap_awal - OLD.jumlah_distribusi;
		
		UPDATE `atk_rekap_stok` SET stok_keluar = stok_rekap_baru WHERE kode_barang = OLD.kode_barang ORDER BY tgl_rekap DESC LIMIT 1;
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `atk_detail_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `atk_update_header` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `atk_update_header` AFTER INSERT ON `atk_detail_pembelian` FOR EACH ROW BEGIN
		DECLARE stok_tersisa INT;
		DECLARE stok_baru INT;
		DECLARE cek_rekap INT;
		DECLARE stok_rekap_awal INT;
		DECLARE stok_rekap_baru INT;
		
		SELECT stok FROM `file_barang_atk` WHERE kode_barang = NEW.kode_barang INTO stok_tersisa;
		SET stok_baru = stok_tersisa + NEW.Jumlah;
		
		/*cek data rekap*/
		SELECT COUNT(*) FROM `atk_rekap_stok` WHERE kode_barang = NEW.kode_barang ORDER BY tgl_rekap DESC INTO cek_rekap;
		
		/*update rekap stok*/
		IF cek_rekap > 0 THEN
			SELECT stok_masuk FROM `atk_rekap_stok` WHERE kode_barang = NEW.kode_barang ORDER BY tgl_rekap DESC LIMIT 1 INTO stok_rekap_awal;
			
			SET stok_rekap_baru = stok_rekap_awal + NEW.Jumlah;
			
			UPDATE `atk_rekap_stok` SET stok_masuk = stok_rekap_baru WHERE kode_barang = NEW.kode_barang ORDER BY tgl_rekap DESC LIMIT 1;
		END IF;
		
		UPDATE `atk_header_pembelian` SET total_pembelian = (SELECT SUM((a.jumlah * a.harga)) FROM `atk_detail_pembelian` AS a WHERE a.no_pembelian = NEW.no_pembelian) WHERE no_pembelian = NEW.no_pembelian;
		
		UPDATE `file_barang_atk` SET stok = stok_baru WHERE kode_barang = NEW.kode_barang;
    END */$$


DELIMITER ;

/* Trigger structure for table `atk_detail_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `atk_delete_header` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `atk_delete_header` AFTER DELETE ON `atk_detail_pembelian` FOR EACH ROW BEGIN
	DECLARE stok_tersisa INT;
	DECLARE stok_baru INT;
	DECLARE cek_exist INT;
	DECLARE cek_rekap INT;
	DECLARE stok_rekap_awal INT;
	DECLARE stok_rekap_baru INT;
	
	SELECT stok FROM `file_barang_atk` WHERE kode_barang = OLD.kode_barang INTO stok_tersisa;
	SET stok_baru = stok_tersisa - OLD.Jumlah;
	
	SELECT COUNT(*) FROM `atk_header_pembelian` WHERE no_pembelian = OLD.no_pembelian INTO cek_exist;
	
	/*cek data rekap*/
	SELECT COUNT(*) FROM `atk_rekap_stok` WHERE kode_barang = OLD.kode_barang ORDER BY tgl_rekap DESC INTO cek_rekap;
	
	/*update rekap stok*/
	IF cek_rekap > 0 THEN
		SELECT stok_masuk FROM `atk_rekap_stok` WHERE kode_barang = OLD.kode_barang ORDER BY tgl_rekap DESC LIMIT 1 INTO stok_rekap_awal;
		
		SET stok_rekap_baru = stok_rekap_awal - OLD.Jumlah;
		
		UPDATE `atk_rekap_stok` SET stok_masuk = stok_rekap_baru WHERE kode_barang = OLD.kode_barang ORDER BY tgl_rekap DESC LIMIT 1;
	END IF;
	
	IF cek_exist > 0 THEN
		UPDATE `atk_header_pembelian` SET total_pembelian = (SELECT SUM((a.jumlah * a.harga)) FROM `atk_detail_pembelian` AS a WHERE a.no_pembelian = OLD.no_pembelian) WHERE no_pembelian = OLD.no_pembelian;
	END IF;
	
	UPDATE `file_barang_atk` SET stok = stok_baru WHERE kode_barang = OLD.kode_barang;
    END */$$


DELIMITER ;

/* Trigger structure for table `atk_header_distribusi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `atk_delete_header_mutasi` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `atk_delete_header_mutasi` AFTER DELETE ON `atk_header_distribusi` FOR EACH ROW BEGIN
	DELETE FROM atk_detail_distribusi WHERE atk_detail_distribusi.`id_header_distribusi` = OLD.id_header_distribusi;
    END */$$


DELIMITER ;

/* Trigger structure for table `atk_header_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_detail_pembelian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_detail_pembelian` AFTER DELETE ON `atk_header_pembelian` FOR EACH ROW BEGIN
		DELETE FROM atk_detail_pembelian WHERE atk_detail_pembelian.`no_pembelian` = old.no_pembelian;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
