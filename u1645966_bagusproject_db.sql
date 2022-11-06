-- Adminer 4.8.1 MySQL 10.6.9-MariaDB-cll-lve dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `log_proyek` (`id`, `proyek_id`, `user_id`, `message`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(94,	19,	15,	'Menambahkan Task baru kedalam proyek  <b>tes proyek 1</b>',	1665889786,	15,	0,	0,	0),
(95,	19,	34,	'Mengubah Task baru kedalam proyek  <b>tes proyek 1</b>',	1665890030,	34,	0,	0,	0),
(96,	19,	34,	'Menyelesaikan Task pada proyek  <b>tes proyek 1</b>',	1665890111,	34,	0,	0,	0),
(97,	19,	33,	'Memverifikasi Task pada proyek  <b>tes proyek 1</b>',	1665890199,	33,	0,	0,	0),
(98,	19,	15,	'Menambahkan komentar pada task <b>task 1</b>',	1665890250,	15,	0,	0,	0),
(99,	21,	15,	'Menambahkan Task baru kedalam proyek  <b>tes proyek 3</b>',	1666170395,	15,	0,	0,	0),
(100,	21,	15,	'Menambahkan Task baru kedalam proyek  <b>tes proyek 3</b>',	1666170442,	15,	0,	0,	0),
(101,	21,	33,	'Menambahkan komentar pada task <b>task 11</b>',	1666170586,	33,	0,	0,	0),
(102,	21,	33,	'Mengubah Task baru kedalam proyek  <b>tes proyek 3</b>',	1666170665,	33,	0,	0,	0),
(103,	21,	33,	'Menyelesaikan Task pada proyek  <b>tes proyek 3</b>',	1666170706,	33,	0,	0,	0),
(104,	21,	33,	'Mengubah Task baru kedalam proyek  <b>tes proyek 3</b>',	1666170725,	33,	0,	0,	0),
(105,	21,	34,	'Menambahkan komentar pada task <b>task 11</b>',	1666170852,	34,	0,	0,	0),
(106,	21,	34,	'Memverifikasi Task pada proyek  <b>tes proyek 3</b>',	1666170862,	34,	0,	0,	0),
(107,	21,	15,	'Menambahkan komentar pada task <b>task 22</b>',	1666170903,	15,	0,	0,	0),
(108,	21,	15,	'Menambahkan komentar pada task <b>task 11</b>',	1666258548,	15,	0,	0,	0),
(109,	21,	15,	'Mengubah informasi proyek  <b>tes proyek 3</b>',	1666511972,	15,	0,	0,	0),
(110,	19,	15,	'Mengubah informasi proyek  <b>tes proyek 1</b>',	1666511985,	15,	0,	0,	0),
(111,	20,	15,	'Mengubah informasi proyek  <b>tes proyek 2</b>',	1666511995,	15,	0,	0,	0),
(112,	21,	15,	'Mengubah informasi proyek  <b>tes proyek 3</b>',	1666512017,	15,	0,	0,	0),
(113,	21,	15,	'Menambahkan Task baru kedalam proyek  <b>tes proyek 3</b>',	1666602833,	15,	0,	0,	0),
(114,	21,	33,	'Mengubah Task baru kedalam proyek  <b>tes proyek 3</b>',	1666603283,	33,	0,	0,	0),
(115,	21,	33,	'Menyelesaikan Task pada proyek  <b>tes proyek 3</b>',	1666603819,	33,	0,	0,	0),
(116,	21,	15,	'Memverifikasi Task pada proyek  <b>tes proyek 3</b>',	1666603848,	15,	0,	0,	0),
(117,	21,	15,	'Menambahkan Task baru kedalam proyek  <b>tes proyek 3</b>',	1666603951,	15,	0,	0,	0),
(118,	22,	15,	'Menambahkan Task baru kedalam proyek  <b>proyek 123</b>',	1666604335,	15,	0,	0,	0),
(119,	23,	35,	'Menambahkan Task baru kedalam proyek  <b>Penguat</b>',	1667475675,	35,	0,	0,	0),
(120,	23,	35,	'Menambahkan Task baru kedalam proyek  <b>Penguat</b>',	1667475712,	35,	0,	0,	0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `m_status` (`id`, `status`, `warna`, `keterangan`, `urutan`, `is_default`, `is_mulai`, `is_selesai`, `is_closed`, `created_by`, `created_at`, `modified_by`, `modified_at`, `is_deleted`) VALUES
(1,	'To Do',	'secondary',	'Status awal task yang baru dibuat',	1,	1,	1,	0,	0,	0,	0,	0,	0,	0),
(2,	'In Progress',	'info',	'Status untuk task dalam proses pengerjaan',	2,	1,	0,	0,	0,	0,	0,	0,	0,	0),
(3,	'Done',	'success',	'Status untuk task yang telah selesai',	3,	1,	0,	1,	0,	0,	0,	0,	0,	0),
(4,	'Closed',	'success',	'Status untuk task yang telah selesai dan telah diverifikasi leader',	4,	1,	0,	0,	1,	0,	0,	0,	0,	0);

DROP TABLE IF EXISTS `tb_assign_leader`;
CREATE TABLE `tb_assign_leader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(5) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_assign_leader` (`id`, `proyek_id`, `user_id`, `status`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(6,	19,	33,	1,	1665853200,	15,	0,	0,	0),
(7,	20,	34,	1,	1665853200,	15,	0,	0,	0),
(8,	21,	34,	1,	1666112400,	15,	0,	0,	0),
(9,	22,	33,	1,	1666544400,	15,	0,	0,	0),
(10,	23,	35,	1,	1667408400,	15,	0,	0,	0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_assign_staff` (`id`, `proyek_id`, `user_id`, `status`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(39,	19,	34,	1,	1665853200,	15,	0,	0,	0),
(40,	20,	33,	1,	1665853200,	15,	0,	0,	0),
(41,	21,	33,	1,	1666112400,	15,	0,	0,	0),
(42,	22,	34,	1,	1666544400,	15,	0,	0,	0),
(43,	22,	35,	1,	1666544400,	15,	0,	0,	0),
(44,	23,	34,	1,	1667408400,	15,	0,	0,	0),
(45,	23,	33,	1,	1667408400,	15,	0,	0,	0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `tb_auth` (`user_id`, `email`, `password`, `status`, `role`, `otp`, `expired_otp`, `log_time`, `modified_at`, `created_at`, `is_deleted`) VALUES
(15,	'admin@bagusproject.com',	'$2y$10$1hg1pDmFo9NYLXLuKxr86.qZpBwWcFo.gQgLLye5Hsk9VXmZqdW12',	1,	0,	NULL,	NULL,	1667547636,	0,	1660450439,	0),
(33,	'hendrapolover@gmail.com',	'$2y$10$usAJYhmWt4sYLiGWBa8pgesj9aXvNUniw2ms4D3wCj8Dj.6j/btDa',	1,	3,	NULL,	NULL,	1666603792,	0,	1663644082,	0),
(34,	'mahendradwipurwanto@gmail.com',	'$2y$10$Ocvo4rbp6WHUA55XKU215OGT35AQmGjqA4DCEt5Zy6/zSdh0nj6KK',	1,	3,	NULL,	NULL,	1666512173,	0,	1663644140,	0),
(35,	'asset_esrga@unitedtractors.com',	'$2y$10$AKo4cqm3ZQhOt739EFEmLOAOaJUti7lNjo9gUeB505.hTfnvHGfVq',	1,	3,	NULL,	NULL,	1667475611,	0,	1666171905,	0);

DROP TABLE IF EXISTS `tb_jabatan`;
CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_jabatan` (`id`, `jabatan`, `keterangan`, `created_at`, `modified_at`, `is_deleted`) VALUES
(1,	'Manager',	'',	1660477555,	0,	1),
(2,	'Department Head',	'',	1663606800,	0,	0),
(3,	'Staff',	'',	1660477582,	0,	0),
(6,	'Officer',	'',	1667408400,	0,	0);

DROP TABLE IF EXISTS `tb_komentar_task`;
CREATE TABLE `tb_komentar_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `komentar` text NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_komentar_task` (`id`, `task_id`, `user_id`, `komentar`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(7,	17,	15,	'oke',	1665890250,	15,	0,	0,	0),
(8,	18,	33,	'siap',	1666170586,	33,	0,	0,	0),
(9,	18,	34,	'oke',	1666170852,	34,	0,	0,	0),
(10,	19,	15,	'tes',	1666170903,	15,	0,	0,	0),
(11,	18,	15,	'Sip',	1666258548,	15,	0,	0,	0);

DROP TABLE IF EXISTS `tb_proyek`;
CREATE TABLE `tb_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL DEFAULT '-',
  `file_pendukung` varchar(255) DEFAULT NULL,
  `judul` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `periode_mulai` int(11) NOT NULL DEFAULT 0,
  `periode_selesai` int(11) NOT NULL DEFAULT 0,
  `is_selesai` tinyint(1) NOT NULL DEFAULT 0,
  `semat` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(5) NOT NULL DEFAULT 1 COMMENT '1: aktif; 2: selesai/arsip',
  `upload_type` text DEFAULT NULL,
  `hide_log` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_proyek` (`id`, `kode`, `file_pendukung`, `judul`, `keterangan`, `periode_mulai`, `periode_selesai`, `is_selesai`, `semat`, `status`, `upload_type`, `hide_log`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(19,	'pyk01542',	NULL,	'tes proyek 1',	'<p>desc test proyek</p>\r\n',	1665939600,	1668963600,	0,	0,	1,	'{\"pdf\":\"application\\/pdf\"}',	0,	1665853200,	15,	1666458000,	15,	0),
(20,	'pyk01525',	NULL,	'tes proyek 2',	'<p>desc 2</p>\r\n',	1666544400,	1670173200,	0,	0,	1,	'{\"pdf\":\"application\\/pdf\"}',	0,	1665853200,	15,	1666458000,	15,	0),
(21,	'pyk01521',	NULL,	'tes proyek 3',	'<p>desc</p>\r\n',	1666544400,	1669568400,	0,	0,	1,	'{\"pdf\":\"application\\/pdf\",\"docx\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\"}',	0,	1666112400,	15,	1666458000,	15,	0),
(22,	'pyk01585',	NULL,	'proyek 123',	'<p>tt</p>\r\n',	1666544400,	1667149200,	0,	0,	1,	'{\"pdf\":\"application\\/pdf\"}',	0,	1666544400,	15,	0,	0,	0),
(23,	'pyk01524',	'berkas/proyek/1667466428.pdf',	'Penguat',	'<p>tes</p>\r\n',	1667408400,	1670518800,	0,	0,	1,	'{\"pdf\":\"application\\/pdf\"}',	0,	1667408400,	15,	0,	0,	0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_proyek_status` (`id`, `proyek_id`, `status`, `warna`, `keterangan`, `urutan`, `is_mulai`, `is_selesai`, `is_closed`, `is_default`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(56,	19,	'To Do',	'secondary',	'Status awal task yang baru dibuat',	1,	1,	0,	0,	1,	1665853200,	15,	0,	0,	0),
(57,	19,	'In Progress',	'info',	'Status untuk task dalam proses pengerjaan',	2,	0,	0,	0,	1,	1665853200,	15,	0,	0,	0),
(58,	19,	'Done',	'success',	'Status untuk task yang telah selesai',	3,	0,	1,	0,	1,	1665853200,	15,	0,	0,	0),
(59,	19,	'Closed',	'success',	'Status untuk task yang telah selesai dan telah diverifikasi leader',	4,	0,	0,	1,	1,	1665853200,	15,	0,	0,	0),
(60,	20,	'To Do',	'secondary',	'Status awal task yang baru dibuat',	1,	1,	0,	0,	1,	1665853200,	15,	0,	0,	0),
(61,	20,	'In Progress',	'info',	'Status untuk task dalam proses pengerjaan',	2,	0,	0,	0,	1,	1665853200,	15,	0,	0,	0),
(62,	20,	'Done',	'success',	'Status untuk task yang telah selesai',	3,	0,	1,	0,	1,	1665853200,	15,	0,	0,	0),
(63,	20,	'Closed',	'success',	'Status untuk task yang telah selesai dan telah diverifikasi leader',	4,	0,	0,	1,	1,	1665853200,	15,	0,	0,	0),
(64,	21,	'To Do',	'secondary',	'Status awal task yang baru dibuat',	1,	1,	0,	0,	1,	1666112400,	15,	0,	0,	0),
(65,	21,	'In Progress',	'info',	'Status untuk task dalam proses pengerjaan',	2,	0,	0,	0,	1,	1666112400,	15,	0,	0,	0),
(66,	21,	'Done',	'success',	'Status untuk task yang telah selesai',	3,	0,	1,	0,	1,	1666112400,	15,	0,	0,	0),
(67,	21,	'Closed',	'success',	'Status untuk task yang telah selesai dan telah diverifikasi leader',	4,	0,	0,	1,	1,	1666112400,	15,	0,	0,	0),
(68,	22,	'To Do',	'secondary',	'Status awal task yang baru dibuat',	1,	1,	0,	0,	1,	1666544400,	15,	0,	0,	0),
(69,	22,	'In Progress',	'info',	'Status untuk task dalam proses pengerjaan',	2,	0,	0,	0,	1,	1666544400,	15,	0,	0,	0),
(70,	22,	'Done',	'success',	'Status untuk task yang telah selesai',	3,	0,	1,	0,	1,	1666544400,	15,	0,	0,	0),
(71,	22,	'Closed',	'success',	'Status untuk task yang telah selesai dan telah diverifikasi leader',	4,	0,	0,	1,	1,	1666544400,	15,	0,	0,	0),
(72,	23,	'To Do',	'secondary',	'Status awal task yang baru dibuat',	1,	1,	0,	0,	1,	1667408400,	15,	0,	0,	0),
(73,	23,	'In Progress',	'info',	'Status untuk task dalam proses pengerjaan',	2,	0,	0,	0,	1,	1667408400,	15,	0,	0,	0),
(74,	23,	'Done',	'success',	'Status untuk task yang telah selesai',	3,	0,	1,	0,	1,	1667408400,	15,	0,	0,	0),
(75,	23,	'Closed',	'success',	'Status untuk task yang telah selesai dan telah diverifikasi leader',	4,	0,	0,	1,	1,	1667408400,	15,	0,	0,	0);

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
  `bukti` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_proyek_task` (`id`, `proyek_id`, `user_id`, `task`, `keterangan`, `bobot`, `is_selesai`, `is_closed`, `deadline`, `bukti`, `catatan`, `pernah_ditolak`, `catatan_ditolak`, `catatan_diterima`, `status_id`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(17,	19,	34,	'task 1',	'<p>desc task 1</p>\r\n',	'2',	0,	1,	1666458000,	NULL,	'<p>selese</p>\r\n',	0,	NULL,	'<p>oke</p>\r\n',	59,	1665853200,	15,	1665853200,	33,	0),
(18,	21,	33,	'task 11',	'<p>deskripsi task 11</p>\r\n',	'10',	0,	1,	1666717200,	NULL,	'<p>tess</p>\r\n',	0,	NULL,	'<p>oke</p>\r\n',	67,	1666112400,	15,	1666112400,	34,	0),
(19,	21,	33,	'task 22',	'<p>desc task 22</p>\r\n',	'20',	0,	0,	1666717200,	NULL,	NULL,	0,	NULL,	NULL,	65,	1666112400,	15,	1666112400,	33,	0),
(20,	21,	33,	'task 5',	'<p>ss</p>\r\n',	'10',	0,	1,	1667149200,	NULL,	'<p>ss</p>\r\n',	0,	NULL,	'',	67,	1666544400,	15,	1666544400,	15,	0),
(21,	21,	33,	'tk 1234',	'<p>tt</p>\r\n',	'10',	0,	0,	1667149200,	NULL,	NULL,	0,	NULL,	NULL,	64,	1666544400,	15,	0,	0,	0),
(22,	22,	35,	'task 1',	'<p>t</p>\r\n',	'2',	0,	0,	1667149200,	NULL,	NULL,	0,	NULL,	NULL,	68,	1666544400,	15,	0,	0,	0),
(23,	23,	34,	'Budget',	'<p>Coba ya&nbsp;</p>\r\n',	'50',	0,	0,	1668099600,	NULL,	NULL,	0,	NULL,	NULL,	72,	1667408400,	35,	0,	0,	0),
(24,	23,	33,	'Instalasi',	'<p>Atur</p>\r\n',	'50',	0,	0,	1668099600,	NULL,	NULL,	0,	NULL,	NULL,	72,	1667408400,	35,	0,	0,	0);

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

INSERT INTO `tb_settings` (`key`, `value`, `desc`, `created_at`, `modified_at`, `is_deleted`) VALUES
('bypass_otp',	'true',	NULL,	1653641032,	0,	0),
('kode',	'1234123412341234',	NULL,	0,	0,	0),
('leader_daftar',	'0',	NULL,	0,	0,	0),
('mailer_alias',	'noreply@bagusproject.com',	NULL,	1653641032,	0,	0),
('mailer_connection',	'ssl',	'',	1653641032,	0,	0),
('mailer_host',	'smtp.googlemail.com',	NULL,	1653641032,	0,	0),
('mailer_mode',	'0',	NULL,	1653641032,	0,	0),
('mailer_password',	'ctzpmwrozzycessd',	NULL,	1653641032,	0,	0),
('mailer_port',	'465',	NULL,	1653641032,	0,	0),
('mailer_smtp',	'1',	NULL,	0,	0,	0),
('mailer_username',	'ngodingin.indonesia@gmail.com',	NULL,	1653641032,	0,	0),
('master_password',	'12341234',	NULL,	1653641032,	0,	0),
('max_upload_size',	'5',	NULL,	0,	0,	0),
('sosmed_facebook',	'mahendradwipurwanto',	NULL,	0,	0,	0),
('sosmed_ig',	'mahendradwipurwanto',	NULL,	0,	0,	0),
('sosmed_twitter',	'mahendradwipurwanto',	NULL,	0,	0,	0),
('sosmed_yt',	'mahendradwipurwanto',	NULL,	0,	0,	0),
('upload_size',	'5',	NULL,	1653641032,	0,	0),
('upload_type',	'',	'{\"pdf\":true,\"jpg\":true,\"jpeg\":true,\"png\":true,\"docx\":true,\"pptx\":true,\"xlsx\":true}',	1653641032,	0,	0),
('web_alamat',	'Malang, Jawa Timur - Indonesia',	NULL,	0,	0,	0),
('web_desc',	'<p>This is Base Project Template</p>\r\n',	NULL,	1653641032,	0,	0),
('web_icon',	'assets/images/icon.png',	NULL,	1653641032,	0,	0),
('web_logo',	'assets/images/logo-2.png',	NULL,	1653641032,	0,	0),
('web_telepon',	'085157444518',	NULL,	0,	0,	0),
('web_title',	'Sistem Monitoring Kinerja Karyawan',	NULL,	1653641032,	0,	0);

DROP TABLE IF EXISTS `tb_task_bukti`;
CREATE TABLE `tb_task_bukti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL DEFAULT 0,
  `bukti` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_task_bukti` (`id`, `task_id`, `bukti`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(19,	20,	'berkas/proyek/21/20/bukti/FORMULIR_PENILAIAN_SEMINAR_TUGAS_AKHIR_(PENGEMBANGAN)_an._151111108_-_Joko_Samudro_-_Revisi_Anggota_Penguji_I.pdf',	1666603820,	33,	0,	0,	0);

DROP TABLE IF EXISTS `tb_token`;
CREATE TABLE `tb_token` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: inactive, 1: active',
  `date_created` int(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_token` (`id_token`, `user_id`, `key`, `type`, `status`, `date_created`) VALUES
(644,	34,	'd59af856b847ce38cb5f4e0c954dfa8ed9523eed9c3bbe8a27c294d8d0431723',	2,	0,	1666259542);

DROP TABLE IF EXISTS `tb_token_type`;
CREATE TABLE `tb_token_type` (
  `ID_TYPE` int(10) NOT NULL AUTO_INCREMENT,
  `TYPE` int(10) NOT NULL,
  `KETERANGAN` text DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_token_type` (`ID_TYPE`, `TYPE`, `KETERANGAN`) VALUES
(1,	1,	'Proses verifikasi email'),
(3,	2,	'Permintaan reset password');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_undangan` (`id`, `email`, `role`, `status`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`) VALUES
(8,	'asset_esrga@unitedtractors.com',	3,	1,	1666112400,	15,	0,	0,	0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `tb_user` (`user_id`, `nama`, `profil`, `no_telp`, `jk`, `jabatan_id`, `gaji`, `notifikasi`) VALUES
(15,	'Departemen Head',	'assets/images/profile.png',	'085785111746',	'L',	0,	NULL,	0),
(33,	'Suhendra',	'assets/images/profile.png',	NULL,	'L',	2,	NULL,	0),
(34,	'hendra',	'assets/images/profile.png',	NULL,	'L',	3,	NULL,	0),
(35,	'Ony',	'berkas/user/35/profile/1667471945.jpg',	'0',	'L',	3,	NULL,	0);

-- 2022-11-06 08:53:53
