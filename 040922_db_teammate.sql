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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `log_proyek` */

insert  into `log_proyek`(`id`,`proyek_id`,`user_id`,`message`,`created_at`,`created_by`,`modified_at`,`modified_by`,`is_deleted`) values 
(2,9,19,'Mengeluarkan staff dari proyek  <b>Test staff from start</b>',1661159868,19,0,0,0),
(3,9,19,'Menambahkan staff kedalam proyek  <b>Test staff from start</b>',1661159868,19,0,0,0),
(4,9,19,'Menambahkan Task baru kedalam proyek  <b>Test staff from start</b>',1661159868,19,0,0,0),
(5,9,19,'Menambahkan Task baru kedalam proyek  <b>Test staff from start</b>',1661918375,19,0,0,0),
(6,9,19,'Menambahkan Task baru kedalam proyek  <b>Test staff from start</b>',1661961208,19,0,0,0),
(7,9,19,'Menambahkan Task baru kedalam proyek  <b>Test staff from start</b>',1661961752,19,0,0,0),
(8,9,19,'Menambahkan Task baru kedalam proyek  <b>Test staff from start</b>',1662005240,19,0,0,0),
(9,9,19,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662006692,19,0,0,0),
(10,9,19,'Menghapus Task baru kedalam proyek  <b>Test staff from start</b>',1662006717,19,0,0,0),
(11,9,16,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662007227,16,0,0,0),
(12,9,16,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662008502,16,0,0,0),
(13,9,16,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662017029,16,0,0,0),
(14,9,15,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662097081,15,0,0,0),
(15,9,15,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662302867,15,0,0,0),
(16,9,19,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662305463,19,0,0,0),
(17,9,19,'Mengubah Task baru kedalam proyek  <b>Test staff from start</b>',1662305576,19,0,0,0);

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
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_status` */

insert  into `m_status`(`id`,`status`,`warna`,`keterangan`,`urutan`,`is_default`,`is_mulai`,`is_selesai`,`created_by`,`created_at`,`modified_by`,`modified_at`,`is_deleted`) values 
(1,'To Do','secondary','Status awal task yang baru dibuat',1,1,1,0,0,0,0,0,0),
(2,'In Progress','info','Status untuk task dalam proses pengerjaan',2,1,0,0,0,0,0,0,0),
(3,'Done','success','Status untuk task yang telah selesai',3,1,0,1,0,0,0,0,0);

/*Table structure for table `tb_assign_staff` */

DROP TABLE IF EXISTS `tb_assign_staff`;

CREATE TABLE `tb_assign_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_assign_staff` */

insert  into `tb_assign_staff`(`id`,`proyek_id`,`user_id`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`,`is_deleted`) values 
(13,9,16,1,1661856223,19,0,0,0),
(14,9,24,1,1661856223,19,0,0,0),
(18,9,25,2,1662096903,15,0,0,0),
(19,9,25,2,1662097043,15,0,0,0),
(20,9,25,1,1662097064,15,0,0,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `tb_auth` */

insert  into `tb_auth`(`user_id`,`email`,`password`,`status`,`role`,`otp`,`expired_otp`,`log_time`,`modified_at`,`created_at`,`is_deleted`) values 
(15,'admin@manpro.com','$2y$10$1hg1pDmFo9NYLXLuKxr86.qZpBwWcFo.gQgLLye5Hsk9VXmZqdW12',1,0,NULL,NULL,1662306581,0,1660450439,0),
(16,'mahendradwipurwanto@gmail.com','$2y$10$4d3WK8ty16b90vQiDBNgN.5ECkfeFukiCvATnup.Ladd6Pwy07jVS',1,3,NULL,NULL,1662306389,0,1660450439,0),
(19,'ngodingin.indonesia@gmail.com','$2y$10$hZpfAuPSJozux/6RyvUxJuHLsUBXctLZz9YseCnmOhkghTsnB4XSG',1,2,NULL,NULL,1662303918,0,1660478436,0),
(23,'181221006@mhs.stiki.ac.id','$2y$10$LTrgOT4mkPWGjTbka2kYLemtQOsXFZj0YnY.3DJV/tJ/KFO1KjLAy',1,2,NULL,NULL,0,0,1660480851,0),
(25,'developpertech@gmail.com','$2y$10$c17XCNXY1s20K/WROyYfeOReWOa1HjWVjfXDznSfaDgpI6xa6V/FW',1,3,NULL,NULL,0,0,1662096815,0);

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

/*Table structure for table `tb_proyek` */

DROP TABLE IF EXISTS `tb_proyek`;

CREATE TABLE `tb_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL DEFAULT '-',
  `judul` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `periode_mulai` int(11) NOT NULL DEFAULT 0,
  `periode_selesai` int(11) NOT NULL DEFAULT 0,
  `status` int(5) NOT NULL DEFAULT 1 COMMENT '1: aktif; 2: selesai/arsip',
  `hide_log` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek` */

insert  into `tb_proyek`(`id`,`kode`,`judul`,`keterangan`,`periode_mulai`,`periode_selesai`,`status`,`hide_log`,`created_at`,`created_by`,`modified_at`,`modified_by`,`is_deleted`) values 
(9,'pyk00','Test staff from start','',1661792400,1664470800,1,0,1661848327,19,0,0,0);

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
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek_status` */

insert  into `tb_proyek_status`(`id`,`proyek_id`,`status`,`warna`,`keterangan`,`urutan`,`is_mulai`,`is_selesai`,`is_default`,`created_at`,`created_by`,`modified_at`,`modified_by`,`is_deleted`) values 
(13,9,'To Do','secondary','Status awal task yang baru dibuat',1,1,0,1,1661848327,19,0,0,0),
(14,9,'In Progress','info','Status untuk task dalam proses pengerjaan',2,0,0,1,1661848327,19,0,0,0),
(15,9,'Done','success','Status untuk task yang telah selesai',4,0,1,1,1661848327,19,1662302700,15,0),
(16,9,'Testing','primary','Testing',2,0,0,0,1662302220,15,0,0,1),
(17,9,'Testing','primary','\r\n						',3,0,0,0,1662302683,15,0,0,1),
(18,9,'Testing','primary','\r\n						',3,0,0,0,1662302700,15,0,0,0);

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
  `bukti` varchar(255) NOT NULL DEFAULT '0',
  `status_id` int(5) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_proyek_task` */

insert  into `tb_proyek_task`(`id`,`proyek_id`,`user_id`,`task`,`keterangan`,`bobot`,`is_selesai`,`bukti`,`status_id`,`created_at`,`created_by`,`modified_at`,`modified_by`,`is_deleted`) values 
(1,9,24,'Membuat makanan','buatkan makanan yang enak untuk 10 orang malan ini','0',0,'0',15,1662017029,16,0,0,0),
(2,9,16,'makanan test','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud ','0',0,'0',13,1661875603,19,1662302867,15,0),
(3,9,24,'Membuat','feafa','0',0,'0',13,1661918375,19,0,0,0),
(4,9,25,'Membuat rgfs','','50',0,'0',13,1661961208,19,1662305576,19,0),
(5,9,16,'awdad','','0',0,'0',14,1662097081,15,0,0,0),
(6,9,24,'Youtubekan','','0',0,'0',15,1662008502,16,0,0,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=641 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_token` */

insert  into `tb_token`(`id_token`,`user_id`,`key`,`type`,`status`,`date_created`) values 
(636,15,'61bd5d477dcba8efaa1c8b3bc8055a27aede317e9590303e1fddce2bd6c9f201624cd65d779d6a2e042f7bf9ed9fe7f16995e7da086a4b38bdbaa6dc98687966dGDQq/NMRF3rTWGVTJ+MDWnXGTiH9vxnhxukQqCiT5k=',1,1,1660450439),
(639,16,'d64c10bffae48bb01b8957c639830db48cb20d9984d6d9058003c93a50e9be8d',2,0,1661159859),
(640,25,'0cbf7530ee5a68d83b1229c4aec7d36126387d903a87db3a8a15794575d45ea7eeb2d23f5acf3c91eecc29a99af66ca198431ffa11bebc5ea5d35fb938112793PCiE7P1AMNmhaYaD8ZdDaUVDCArDjC1VAbr3BkcQax0=',1,1,1662096815);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

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
(15,'ADMIN','assets/images/profile.png','085785111746','L',0,NULL,0),
(16,'Mahendra Dwi Purwanto','assets/images/profile.png','085785111746','L',1,NULL,1),
(19,'Mahendra Dwi Purwanto','berkas/user/19/profile/1660484535.jpg','085785111746','P',3,NULL,1),
(23,'Test Account','assets/images/profile.png','085785111746','L',2,NULL,0),
(25,'Ravic','assets/images/profile.png','085785111746','L',0,NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
