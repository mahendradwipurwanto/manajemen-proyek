/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - db_teammate
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `tb_assign` */

DROP TABLE IF EXISTS `tb_assign`;

CREATE TABLE `tb_assign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_assign` */

/*Table structure for table `tb_auth` */

DROP TABLE IF EXISTS `tb_auth`;

CREATE TABLE `tb_auth` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0 COMMENT '0: belum verifikasi, 1: aktif, 2: suspend',
  `role` int(5) NOT NULL DEFAULT 3 COMMENT '1: Admin, 2: Leader, 3: Staff',
  `otp` varchar(255) DEFAULT NULL,
  `expired_otp` varchar(255) DEFAULT NULL,
  `log_time` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `tb_auth` */

insert  into `tb_auth`(`user_id`,`email`,`password`,`status`,`role`,`otp`,`expired_otp`,`log_time`,`modified_at`,`created_at`,`is_deleted`) values 
(15,'admin@manpro.com','$2y$10$1hg1pDmFo9NYLXLuKxr86.qZpBwWcFo.gQgLLye5Hsk9VXmZqdW12',1,1,NULL,NULL,1660701928,0,1660450439,0),
(16,'mahendradwipurwanto@gmail.com','$2y$10$4d3WK8ty16b90vQiDBNgN.5ECkfeFukiCvATnup.Ladd6Pwy07jVS',1,3,NULL,NULL,1660701204,0,1660450439,0),
(19,'ngodingin.indonesia@gmail.com','$2y$10$hZpfAuPSJozux/6RyvUxJuHLsUBXctLZz9YseCnmOhkghTsnB4XSG',1,2,NULL,NULL,1660701846,0,1660478436,0),
(23,'181221006@mhs.stiki.ac.id','$2y$10$LTrgOT4mkPWGjTbka2kYLemtQOsXFZj0YnY.3DJV/tJ/KFO1KjLAy',1,2,NULL,NULL,0,0,1660480851,0),
(24,'developpertech@gmail.com','$2y$10$nxnRYWpwzDUFdxoYHzgqMOSnvf1O8HtZN/hZWFDvarwJ1X1/K.Bv6',1,3,NULL,NULL,0,0,1660481985,0);

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id`,`jabatan`,`keterangan`,`created_at`,`modified_at`,`is_deleted`) values 
(1,'Manager Umum','',1660477555,0,1),
(2,'Manager Umum','',1660477576,0,0),
(3,'Staff Umum','',1660477582,0,0),
(4,'Staff Operasional','',1660477588,0,0);

/*Table structure for table `tb_master_task` */

DROP TABLE IF EXISTS `tb_master_task`;

CREATE TABLE `tb_master_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `warna` varchar(20) NOT NULL DEFAULT '#ffffff',
  `urutan` int(11) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_master_task` */

/*Table structure for table `tb_project` */

DROP TABLE IF EXISTS `tb_project`;

CREATE TABLE `tb_project` (
  `id_project` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL DEFAULT '-',
  `user_id` int(11) NOT NULL,
  `judul` varchar(30) NOT NULL DEFAULT '-',
  `keterangan` text DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_project`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_project` */

/*Table structure for table `tb_proyek` */

DROP TABLE IF EXISTS `tb_proyek`;

CREATE TABLE `tb_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL DEFAULT '-',
  `judul` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `periode_mulai` int(11) NOT NULL DEFAULT 0,
  `periode_selesai` int(11) NOT NULL DEFAULT 0,
  `status` int(5) NOT NULL DEFAULT 1,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek` */

insert  into `tb_proyek`(`id`,`kode`,`judul`,`keterangan`,`periode_mulai`,`periode_selesai`,`status`,`is_archived`,`created_at`,`created_by`,`modified_at`,`modified_by`,`is_deleted`) values 
(2,'-','Test Proyek','Testtt',1660582800,1660928400,1,0,1660669058,19,0,0,0);

/*Table structure for table `tb_proyek_status` */

DROP TABLE IF EXISTS `tb_proyek_status`;

CREATE TABLE `tb_proyek_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `warna` varchar(20) NOT NULL DEFAULT '#ffffff',
  `urutan` int(11) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek_status` */

/*Table structure for table `tb_settings` */

DROP TABLE IF EXISTS `tb_settings`;

CREATE TABLE `tb_settings` (
  `key` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_settings` */

insert  into `tb_settings`(`key`,`value`,`desc`,`created_at`,`modified_at`,`is_deleted`) values 
('bypass_otp','true',NULL,1653641032,0,0),
('kode','1234123412341234',NULL,0,0,0),
('mailer_alias','Sistem Monitoring Kinerja Karyawan',NULL,1653641032,0,0),
('mailer_host','smtp.gmail.com',NULL,1653641032,0,0),
('mailer_mode','0',NULL,1653641032,0,0),
('mailer_password','hazyzcmjpgjfjitd',NULL,1653641032,0,0),
('mailer_port','587',NULL,1653641032,0,0),
('mailer_username','ngodingin.indonesia@gmail.com',NULL,1653641032,0,0),
('max_upload_size','5',NULL,0,0,0),
('sosmed_facebook','mahendradwipurwanto',NULL,0,0,0),
('sosmed_ig','mahendradwipurwanto',NULL,0,0,0),
('sosmed_twitter','mahendradwipurwanto',NULL,0,0,0),
('sosmed_yt','mahendradwipurwanto',NULL,0,0,0),
('web_alamat','Malang, Jawa Timur - Indonesia',NULL,0,0,0),
('web_desc','<p>This is Base Project Template</p>\r\n',NULL,1653641032,0,0),
('web_icon','assets/images/icon.png',NULL,1653641032,0,0),
('web_logo','assets/images/logo.png',NULL,1653641032,0,0),
('web_telepon','085157444518',NULL,0,0,0),
('web_title','Sistem Monitoring Kinerja Karyawan',NULL,1653641032,0,0);

/*Table structure for table `tb_task` */

DROP TABLE IF EXISTS `tb_task`;

CREATE TABLE `tb_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `judul` varchar(50) NOT NULL DEFAULT '-',
  `keterangan` text DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 0 COMMENT '0: todo, 1: inprogress, 2: review, 3: done',
  `created_at` int(11) unsigned NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_task` */

/*Table structure for table `tb_token` */

DROP TABLE IF EXISTS `tb_token`;

CREATE TABLE `tb_token` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: inactive, 1: active',
  `date_created` int(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_token`)
) ENGINE=InnoDB AUTO_INCREMENT=639 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_token` */

insert  into `tb_token`(`id_token`,`user_id`,`key`,`type`,`status`,`date_created`) values 
(636,15,'61bd5d477dcba8efaa1c8b3bc8055a27aede317e9590303e1fddce2bd6c9f201624cd65d779d6a2e042f7bf9ed9fe7f16995e7da086a4b38bdbaa6dc98687966dGDQq/NMRF3rTWGVTJ+MDWnXGTiH9vxnhxukQqCiT5k=',1,1,1660450439);

/*Table structure for table `tb_token_type` */

DROP TABLE IF EXISTS `tb_token_type`;

CREATE TABLE `tb_token_type` (
  `ID_TYPE` int(10) NOT NULL AUTO_INCREMENT,
  `TYPE` int(10) NOT NULL,
  `KETERANGAN` text DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_token_type` */

insert  into `tb_token_type`(`ID_TYPE`,`TYPE`,`KETERANGAN`) values 
(1,1,'Proses verifikasi email'),
(3,2,'Permintaan reset password');

/*Table structure for table `tb_undangan` */

DROP TABLE IF EXISTS `tb_undangan`;

CREATE TABLE `tb_undangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `role` int(5) NOT NULL DEFAULT 2,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_undangan` */

insert  into `tb_undangan`(`id`,`email`,`role`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`,`is_deleted`) values 
(1,'181221006@mhs.stiki.ac.id',2,2,1660479920,15,1660480636,15,0),
(2,'percahku@gmail.com',3,1,1660482006,15,0,0,0);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `profil` varchar(255) DEFAULT 'assets/images/profile.png',
  `no_telp` varchar(20) DEFAULT NULL,
  `jk` char(1) DEFAULT 'L',
  `jabatan_id` int(11) NOT NULL DEFAULT 0,
  `gaji` varchar(50) DEFAULT NULL,
  `notifikasi` tinyint(1) NOT NULL DEFAULT 0,
  KEY `user_id` (`user_id`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_auth` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_user` */

insert  into `tb_user`(`user_id`,`nama`,`profil`,`no_telp`,`jk`,`jabatan_id`,`gaji`,`notifikasi`) values 
(15,'ADMIN','assets/images/profile.png','085785111746','L',0,NULL,0),
(16,'Mahendra Dwi Purwanto','assets/images/profile.png','085785111746','L',0,NULL,1),
(19,'Mahendra Dwi Purwanto','berkas/user/19/profile/1660484535.jpg','085785111746','P',3,NULL,1),
(23,'Test Account','assets/images/profile.png','085785111746','L',0,NULL,0),
(24,'Test','assets/images/profile.png',NULL,'L',4,NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
