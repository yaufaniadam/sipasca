-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 04:19 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipasca`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist_penilaian`
--

CREATE TABLE `checklist_penilaian` (
  `id_checklist_penilaian` int(11) NOT NULL,
  `checklist_penilaian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_penilaian`
--

INSERT INTO `checklist_penilaian` (`id_checklist_penilaian`, `checklist_penilaian`) VALUES
(1, 'Proposal'),
(2, 'SK. Penelitian');

-- --------------------------------------------------------

--
-- Table structure for table `ci_users`
--

CREATE TABLE `ci_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_verify` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id_prodi` int(4) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`id`, `username`, `firstname`, `jenis_kelamin`, `email`, `mobile_no`, `password`, `role`, `is_active`, `is_verify`, `is_admin`, `token`, `password_reset_code`, `last_ip`, `created_at`, `updated_at`, `id_prodi`, `photo`) VALUES
(3, 'admin', 'Admin Pasca', 'Laki-laki', 'admin@pascasarjana.umy.ac.id', '085625634563', '$2y$10$U4BGwUyXzmMWfnGx/7QjbeUEsaHbod05Krapy9x//vRP7L3ae/bsi', 1, 0, 1, 1, '', '', '', '2017-09-29 10:09:44', '2020-01-16 00:00:00', 0, ''),
(72, 'fitriarofiati', 'Fitri Arofiati, S.Kep., Ns., M', '', 'fitriarofiati@umy.ac.id', '0813', '$2y$10$G245Ti2.f4UgnxBVvdtJjeRsiPrPitthj84lwPUwFvsnWB.koWkm.', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-21 00:00:00', 2, './uploads/fotoProfil/bufitri.png'),
(69, 'erna', 'Erna Rochmawati, S.Kp., MNSc.,', '', 'erna.rochmawati@umy.ac.id', '081354519149', '', 1, 0, 1, 3, '', '', '', '2020-01-15 00:00:00', '2020-01-16 00:00:00', 0, './uploads/fotoProfil/buerna.png'),
(73, 'nurchayati', 'Nur Chayati, S.Kep., Ns., M.Ke', '', 'nurchayati@umy.ac.id', '0812', '$2y$10$LWJSL3JB3fvQKbzgTsWcsejnPr8Qow5LuarlAbpnThZvS8zQq7ttO', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-16 00:00:00', 2, ''),
(74, 'titihhuriah', 'Dr. Titih Huriah, S.Kep., Ns.,', '', 'titihhuriah@umy.ac.id', '081', '$2y$10$9eb6lQ6dEGusfbSBjxVxauKDJN/9dntSrk2YXqw4hyWzSr6QeUfu6', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-16 00:00:00', 2, ''),
(75, 'imanpermana', 'dr. Iman Permana, M.Kes., Ph.D', '', 'imanpermana@umy.ac.id', '081', '$2y$10$fPjkvvXI9r5hL3NhsIvyD.j.bQxLtYSVj4NxfR44YdgkyLCrjiBdq', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-21 00:00:00', 2, './uploads/fotoProfil/'),
(76, 'mkep', 'TU Prodi M Kep', '', 'mkep@umy.ac.id', '081', '$2y$10$pNtcRhgJlDtoopj6aSx3zudra2.ij2fVPk9/MDMcdheh5EE9.3Zna', 1, 1, 1, 2, '', '', '', '2020-01-16 00:00:00', '2020-01-21 00:00:00', 2, './uploads/fotoProfil/'),
(77, 'rizalyaya', 'Rizal Yaya, SE., Akt., M.Sc., Ph.D', '', 'rizalyaya@umy.ac.id', '081', '$2y$10$3K6g532YB7O/VGJTvi2eOezWwET0Qi8Ba0zTbBNWncEI0NUiY5ahO', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-16 00:00:00', 1, './uploads/fotoProfil/pak-rizal-300x400-150x150.png');

-- --------------------------------------------------------

--
-- Table structure for table `ci_user_groups`
--

CREATE TABLE `ci_user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi_kegiatan`
--

CREATE TABLE `dokumentasi_kegiatan` (
  `id_dokumentasi` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_penelitian` int(11) NOT NULL,
  `id_publikasi` int(11) NOT NULL,
  `id_pengabdian` int(11) NOT NULL,
  `id_haki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumentasi_kegiatan`
--

INSERT INTO `dokumentasi_kegiatan` (`id_dokumentasi`, `nama`, `photo`, `id_penelitian`, `id_publikasi`, `id_pengabdian`, `id_haki`) VALUES
(1, 'gambar warna warni', './uploads/kegiatan/gambar_6.png', 14, 0, 0, 0),
(2, '', './uploads/kegiatan/gambar_5.png', 14, 0, 0, 0),
(3, 'sdfsdf', './uploads/kegiatan/62fbdfe3-e04d-45e4-8a82-e0458c5e8be1.jpg', 32, 0, 0, 0),
(4, 'asdasd', './uploads/kegiatan/adedd2d3-d320-475e-8830-860039b48e0f.jpg', 33, 0, 0, 0),
(5, '', './uploads/kegiatan/publikasi/ktp1.jpg', 0, 1, 0, 0),
(6, '', './uploads/kegiatan/pengabdian/mailer3.png', 0, 0, 1, 0),
(7, '', './uploads/kegiatan/haki/Nature-Full-HD-Wallpaper-national-geographic-7822344-1920-1080.jpg', 0, 0, 0, 2),
(8, '', './uploads/kegiatan/publikasi/jadi.png', 0, 13, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `haki`
--

CREATE TABLE `haki` (
  `id_haki` int(11) NOT NULL,
  `judul_haki` varchar(200) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `id_dosen` int(2) NOT NULL,
  `date` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `komentar_reviewer` text NOT NULL,
  `id_prodi` int(3) NOT NULL,
  `id_pengupload` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `haki`
--

INSERT INTO `haki` (`id_haki`, `judul_haki`, `lokasi`, `tgl_pelaksanaan`, `id_dosen`, `date`, `deskripsi`, `file`, `komentar_reviewer`, `id_prodi`, `id_pengupload`) VALUES
(3, 'haki', 'adadad', '2020-02-26', 74, '2020-02-26', 'ada', './uploads/haki/kartu.pdf', '', 2, 76);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_publikasi`
--

CREATE TABLE `jenis_publikasi` (
  `id_jenis_publikasi` int(2) NOT NULL,
  `jenis_publikasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_publikasi`
--

INSERT INTO `jenis_publikasi` (`id_jenis_publikasi`, `jenis_publikasi`) VALUES
(1, 'Jurnal Nasional'),
(2, 'Jurnal Scopus'),
(3, 'Jurnal Non Scopus');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id_penelitian` int(10) NOT NULL,
  `judul_penelitian` varchar(200) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `id_dosen` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `date` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_revisi` varchar(255) NOT NULL,
  `file_akhir` varchar(255) NOT NULL,
  `id_checklist_penilaian` varchar(50) NOT NULL,
  `komentar_reviewer` text NOT NULL,
  `hasil_penilaian` int(2) NOT NULL,
  `id_prodi` int(3) NOT NULL,
  `id_pengupload` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `judul_penelitian`, `lokasi`, `tgl_pelaksanaan`, `id_dosen`, `status`, `date`, `deskripsi`, `file`, `file_revisi`, `file_akhir`, `id_checklist_penilaian`, `komentar_reviewer`, `hasil_penilaian`, `id_prodi`, `id_pengupload`) VALUES
(34, 'Hubungan Antara Dukungan Keluarga dengan Pengelolaan Diri (Self Care) pada Pasien Diabetes Mellitus Tipe 2 di RSUD MM. Dunda Limboto Kab. Gorontalo', 'RSUD MM Dunda Limboto Gorontalo', '0000-00-00', 72, 2, '2020-01-16', 'Hubungan Antara Dukungan Keluarga dengan Pengelolaan Diri (Self Care) pada Pasien Diabetes Mellitus Tipe 2 di RSUD MM. Dunda Limboto Kab. Gorontalo Hubungan Antara Dukungan Keluarga dengan Pengelolaan Diri (Self Care) pada Pasien Diabetes Mellitus Tipe 2 di RSUD MM. Dunda Limboto Kab. Gorontalo', './uploads/penelitian/HUBUNGAN_ANTARA_DUKUNGAN_KELUARGA_DENGAN_PENGELOLAAN_DIRI.docx', '', '', '1', '', 1, 2, 3),
(35, 'Pengalaman Kesiapsiagaan Perawatan dalam Penatalaksanaan Aspek Psikologis Akibat Gempa Bumi di Rumah Sakit Jiwa Mutiara Sukma Provinsi Nusa Tenggara Barat', 'Rumah Sakit Jiwa Mutiara Sukma NTB', '0000-00-00', 73, 0, '2020-01-16', 'Pengalaman Kesiapsiagaan Perawatan dalam Penatalaksanaan Aspek Psikologis Akibat Gempa Bumi di Rumah Sakit Jiwa Mutiara Sukma Provinsi Nusa Tenggara Barat Pengalaman Kesiapsiagaan Perawatan dalam Penatalaksanaan Aspek Psikologis Akibat Gempa Bumi di Rumah Sakit Jiwa Mutiara Sukma Provinsi Nusa Tenggara Barat', './uploads/penelitian/Bibliography.docx', '', '', '0', '', 0, 2, 76),
(36, 'Analisis Perbandingan Kemampuan Kognitif Pada Materi Dokumentasi Keperawatan Berbasis E-Learning dan Konvensional di Program Studi Keperawatan Untan Pontianak', 'Untan Pontianak', '0000-00-00', 74, 2, '2020-01-16', 'Analisis Perbandingan Kemampuan Kognitif Pada Materi Dokumentasi Keperawatan Berbasis E-Learning dan Konvensional di Program Studi Keperawatan Untan Pontianak Analisis Perbandingan Kemampuan Kognitif Pada Materi Dokumentasi Keperawatan Berbasis E-Learning dan Konvensional di Program Studi Keperawatan Untan Pontianak', './uploads/penelitian/Analisis_Perbandingan_Kemampuan_Kognitif_Pada_Materi_Dokumentasi_Keperawatan_Berbasis_E.docx', './uploads/penelitian/Analisis_Perbandingan_Kemampuan_Kognitif_Pada_Materi_Dokumentasi_Keperawatan_Berbasis_E.docx', '', '1,2', 'ada', 2, 2, 76),
(37, 'Judul Penelitian Deskripsi Singkat', 'Gua Selarong', '2020-05-02', 72, 0, '2020-01-19', 'test', './uploads/penelitian/01_peminjaman_tempat_FASI_2019_rev2.docx', '', '', '0', '', 0, 2, 3),
(38, 'contoh judul 1', 'dfdf', '2020-01-24', 72, 0, '2020-01-23', 'sdfs', './uploads/penelitian/1087-2618-1-SM.pdf', '', '', '0', '', 0, 2, 76),
(39, 'contoh judul', 'ada', '2020-02-11', 72, 0, '2020-02-11', 'cek', './uploads/penelitian/7.pdf', '', '', '0', '', 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian`
--

CREATE TABLE `pengabdian` (
  `id_pengabdian` int(11) NOT NULL,
  `judul_pengabdian` varchar(200) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `id_dosen` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `date` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_revisi` varchar(255) NOT NULL,
  `file_akhir` varchar(255) NOT NULL,
  `id_checklist_penilaian` varchar(50) NOT NULL,
  `komentar_reviewer` text NOT NULL,
  `hasil_penilaian` int(2) NOT NULL,
  `id_prodi` int(3) NOT NULL,
  `id_pengupload` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengabdian`
--

INSERT INTO `pengabdian` (`id_pengabdian`, `judul_pengabdian`, `lokasi`, `tgl_pelaksanaan`, `id_dosen`, `status`, `date`, `deskripsi`, `file`, `file_revisi`, `file_akhir`, `id_checklist_penilaian`, `komentar_reviewer`, `hasil_penilaian`, `id_prodi`, `id_pengupload`) VALUES
(2, 'ada', 'adadad', '2020-02-26', 72, 0, '2020-02-26', 'adas', './uploads/pengabdian/Screenshot_2.png', '', '', '0', '', 0, 2, 76);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `prodi`) VALUES
(1, 'Magister Manajemen'),
(2, 'Magister Keperawatan');

-- --------------------------------------------------------

--
-- Table structure for table `publikasi`
--

CREATE TABLE `publikasi` (
  `id_publikasi` int(10) NOT NULL,
  `judul_publikasi` varchar(200) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `id_dosen` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `id_jenis_publikasi` int(11) NOT NULL,
  `id_sub_jenis_publikasi` int(3) NOT NULL,
  `sub_jenis_publikasi_text` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_revisi` varchar(255) NOT NULL,
  `link_publikasi` text NOT NULL,
  `komentar_reviewer` text NOT NULL,
  `hasil_penilaian` int(2) NOT NULL,
  `tgl_hasil_penilaian` varchar(20) NOT NULL,
  `id_prodi` int(3) NOT NULL,
  `id_pengupload` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publikasi`
--

INSERT INTO `publikasi` (`id_publikasi`, `judul_publikasi`, `tgl_pelaksanaan`, `id_dosen`, `status`, `id_jenis_publikasi`, `id_sub_jenis_publikasi`, `sub_jenis_publikasi_text`, `date`, `deskripsi`, `file`, `file_revisi`, `link_publikasi`, `komentar_reviewer`, `hasil_penilaian`, `tgl_hasil_penilaian`, `id_prodi`, `id_pengupload`) VALUES
(13, 'publikasi 1', '2020-02-08', 73, 2, 1, 4, '', '2020-02-26', 'ada', './uploads/publikasi/kartu10.pdf', '', 'http://google.com', '', 1, '02/26/2020', 2, 76);

-- --------------------------------------------------------

--
-- Table structure for table `sub_jenis_publikasi`
--

CREATE TABLE `sub_jenis_publikasi` (
  `id_sub_jenis_publikasi` int(3) NOT NULL,
  `sub_jenis_publikasi` varchar(30) NOT NULL,
  `id_jenis_publikasi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_jenis_publikasi`
--

INSERT INTO `sub_jenis_publikasi` (`id_sub_jenis_publikasi`, `sub_jenis_publikasi`, `id_jenis_publikasi`) VALUES
(1, 'Sinta 1', 1),
(2, 'Sinta 2', 1),
(3, 'Sinta 3', 1),
(4, 'Sinta 4', 1),
(5, 'Sinta 5', 1),
(6, 'Sinta 6', 1),
(7, 'Q1', 2),
(8, 'Q2', 2),
(9, 'Q3', 2),
(10, 'Q4', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist_penilaian`
--
ALTER TABLE `checklist_penilaian`
  ADD PRIMARY KEY (`id_checklist_penilaian`);

--
-- Indexes for table `ci_users`
--
ALTER TABLE `ci_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_user_groups`
--
ALTER TABLE `ci_user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumentasi_kegiatan`
--
ALTER TABLE `dokumentasi_kegiatan`
  ADD PRIMARY KEY (`id_dokumentasi`);

--
-- Indexes for table `haki`
--
ALTER TABLE `haki`
  ADD PRIMARY KEY (`id_haki`);

--
-- Indexes for table `jenis_publikasi`
--
ALTER TABLE `jenis_publikasi`
  ADD PRIMARY KEY (`id_jenis_publikasi`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id_penelitian`);

--
-- Indexes for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD PRIMARY KEY (`id_pengabdian`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `publikasi`
--
ALTER TABLE `publikasi`
  ADD PRIMARY KEY (`id_publikasi`);

--
-- Indexes for table `sub_jenis_publikasi`
--
ALTER TABLE `sub_jenis_publikasi`
  ADD PRIMARY KEY (`id_sub_jenis_publikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist_penilaian`
--
ALTER TABLE `checklist_penilaian`
  MODIFY `id_checklist_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_users`
--
ALTER TABLE `ci_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `ci_user_groups`
--
ALTER TABLE `ci_user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dokumentasi_kegiatan`
--
ALTER TABLE `dokumentasi_kegiatan`
  MODIFY `id_dokumentasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `haki`
--
ALTER TABLE `haki`
  MODIFY `id_haki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_publikasi`
--
ALTER TABLE `jenis_publikasi`
  MODIFY `id_jenis_publikasi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id_penelitian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pengabdian`
--
ALTER TABLE `pengabdian`
  MODIFY `id_pengabdian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `publikasi`
--
ALTER TABLE `publikasi`
  MODIFY `id_publikasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sub_jenis_publikasi`
--
ALTER TABLE `sub_jenis_publikasi`
  MODIFY `id_sub_jenis_publikasi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
