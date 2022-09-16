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

/*Table structure for table `log_proyek` */

DROP TABLE IF EXISTS `log_proyek`;

CREATE TABLE `log_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

/*Data for the table `log_proyek` */

/*Table structure for table `m_status` */

DROP TABLE IF EXISTS `m_status`;

CREATE TABLE `m_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `urutan` int(11) DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_mulai` tinyint(1) NOT NULL DEFAULT 0,
  `is_selesai` tinyint(1) NOT NULL DEFAULT 0,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_status` */

insert  into `m_status`(`id`,`status`,`warna`,`keterangan`,`urutan`,`is_default`,`is_mulai`,`is_selesai`,`is_closed`,`created_by`,`created_at`,`modified_by`,`modified_at`,`is_deleted`) values 
(1,'To Do','secondary','Status awal task yang baru dibuat',1,1,1,0,0,0,0,0,0,0),
(2,'In Progress','info','Status untuk task dalam proses pengerjaan',2,1,0,0,0,0,0,0,0,0),
(3,'Done','success','Status untuk task yang telah selesai',3,1,0,1,0,0,0,0,0,0),
(4,'Closed','success','Status untuk task yang telah selesai dan telah diverifikasi leader',4,1,0,0,1,0,0,0,0,0);

/*Table structure for table `tb_assign_staff` */

DROP TABLE IF EXISTS `tb_assign_staff`;

CREATE TABLE `tb_assign_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1: aktif, 2: dikeluarkan',
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_assign_staff` */

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `tb_auth` */

insert  into `tb_auth`(`user_id`,`email`,`password`,`status`,`role`,`otp`,`expired_otp`,`log_time`,`modified_at`,`created_at`,`is_deleted`) values 
(15,'admin@bagusproject.com','$2y$10$1hg1pDmFo9NYLXLuKxr86.qZpBwWcFo.gQgLLye5Hsk9VXmZqdW12',1,0,NULL,NULL,1663273391,0,1660450439,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id`,`jabatan`,`keterangan`,`created_at`,`modified_at`,`is_deleted`) values 
(1,'Manager','',1660477555,0,1),
(2,'GA','',1660477576,0,0),
(3,'Staff','',1660477582,0,0),
(5,'Manager','',1663257757,0,0);

/*Table structure for table `tb_proyek` */

DROP TABLE IF EXISTS `tb_proyek`;

CREATE TABLE `tb_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL DEFAULT '-',
  `judul` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `periode_mulai` int(11) NOT NULL DEFAULT 0,
  `periode_selesai` int(11) NOT NULL DEFAULT 0,
  `is_selesai` tinyint(1) NOT NULL DEFAULT 0,
  `semat` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(5) NOT NULL DEFAULT 1 COMMENT '1: aktif; 2: selesai/arsip',
  `hide_log` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek` */

/*Table structure for table `tb_proyek_status` */

DROP TABLE IF EXISTS `tb_proyek_status`;

CREATE TABLE `tb_proyek_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `warna` varchar(20) NOT NULL DEFAULT 'primary',
  `keterangan` text DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 1,
  `is_mulai` tinyint(1) NOT NULL DEFAULT 0,
  `is_selesai` tinyint(1) NOT NULL DEFAULT 0,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek_status` */

/*Table structure for table `tb_proyek_task` */

DROP TABLE IF EXISTS `tb_proyek_task`;

CREATE TABLE `tb_proyek_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `bobot` varchar(11) NOT NULL DEFAULT '0',
  `is_selesai` tinyint(1) NOT NULL DEFAULT 0,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `deadline` int(11) NOT NULL DEFAULT 0,
  `bukti` varchar(255) NOT NULL DEFAULT '0',
  `catatan` text DEFAULT NULL,
  `pernah_ditolak` tinyint(1) NOT NULL DEFAULT 0,
  `catatan_ditolak` text DEFAULT NULL,
  `catatan_diterima` text DEFAULT NULL,
  `status_id` int(5) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek_task` */

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
('leader_daftar','0',NULL,0,0,0),
('mailer_alias','Sistem Monitoring Kinerja',NULL,1653641032,0,0),
('mailer_host','smtp.gmail.com',NULL,1653641032,0,0),
('mailer_mode','0',NULL,1653641032,0,0),
('mailer_password','shoqdxfxueqtckrd',NULL,1653641032,0,0),
('mailer_port','587',NULL,1653641032,0,0),
('mailer_smtp','1',NULL,0,0,0),
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
) ENGINE=InnoDB AUTO_INCREMENT=644 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_token` */

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_undangan` */

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
(15,'ADMIN','assets/images/profile.png','085785111746','L',0,NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
