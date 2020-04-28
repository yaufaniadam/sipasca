-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 05:05 PM
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
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `id_dosen` int(2) NOT NULL,
  `date` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `komentar_reviewer` text NOT NULL,
  `id_prodi` int(3) NOT NULL,
  `id_pengupload` int(3) NOT NULL,
  `kategori_buku` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `lokasi`, `tgl_pelaksanaan`, `id_dosen`, `date`, `deskripsi`, `file`, `komentar_reviewer`, `id_prodi`, `id_pengupload`, `kategori_buku`) VALUES
(3, 'haki', 'adadad', '2020-02-26', 74, '2020-02-26', 'ada', './uploads/haki/kartu.pdf', '', 2, 76, 1);

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
(3, 'admin', 'Admin Pasca', 'Laki-laki', 'admin@pascasarjana.umy.ac.id', '085625634563', '$2y$10$zjKWT2UkpOeMWJPTIytucOk14DmEZ6rs5vgrI9pK46B0fLa6AIoji', 1, 0, 1, 1, '', '', '', '2017-09-29 10:09:44', '2020-03-25 00:00:00', 0, './uploads/fotoProfil/Biografi-Jendral-Soedirman-Singkat-Sejarah-Perjuangan-Anak-Bangsa9.jpg'),
(72, 'fitriarofiati', 'Fitri Arofiati, S.Kep., Ns., M', '', 'fitriarofiati@umy.ac.id', '0813', '$2y$10$G245Ti2.f4UgnxBVvdtJjeRsiPrPitthj84lwPUwFvsnWB.koWkm.', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-21 00:00:00', 2, './uploads/fotoProfil/bufitri.png'),
(69, 'erna', 'Erna Rochmawati, S.Kp., MNSc.,', '', 'erna.rochmawati@umy.ac.id', '081354519149', '$2y$10$JDW7hH70KmaU6otwzTHL5u0.O64zy0Quv3NehhRxY4guZx11I9.M2', 1, 0, 1, 3, '', '', '', '2020-01-15 00:00:00', '2020-03-04 00:00:00', 0, './uploads/fotoProfil/buerna.png'),
(73, 'nurchayati', 'Nur Chayati, S.Kep., Ns., M.Ke', '', 'nurchayati@umy.ac.id', '0812', '$2y$10$LWJSL3JB3fvQKbzgTsWcsejnPr8Qow5LuarlAbpnThZvS8zQq7ttO', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-16 00:00:00', 2, ''),
(74, 'titihhuriah', 'Dr. Titih Huriah, S.Kep., Ns.,', '', 'titihhuriah@umy.ac.id', '081', '$2y$10$9eb6lQ6dEGusfbSBjxVxauKDJN/9dntSrk2YXqw4hyWzSr6QeUfu6', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-01-16 00:00:00', 2, ''),
(75, 'imanpermana', 'dr. Iman Permana, M.Kes., Ph.D', '', 'imanpermana@umy.ac.id', '081', '$2y$10$fPjkvvXI9r5hL3NhsIvyD.j.bQxLtYSVj4NxfR44YdgkyLCrjiBdq', 1, 1, 1, 4, '', '', '', '2020-01-16 00:00:00', '2020-03-04 00:00:00', 2, './uploads/fotoProfil/Biografi-Jendral-Soedirman-Singkat-Sejarah-Perjuangan-Anak-Bangsa8.jpg'),
(76, 'mkep', 'TU MKep', '', 'mkep@umy.ac.id', '081', '$2y$10$w/gZ8T4b6vfilIIaduPap.oEL1voX3uv5SmycpTZwXrSgaxCze0QC', 1, 1, 1, 2, '', '', '', '2020-01-16 00:00:00', '2020-03-08 00:00:00', 2, './uploads/fotoProfil/logo-umy-macem22.png'),
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
  `id_haki` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumentasi_kegiatan`
--

INSERT INTO `dokumentasi_kegiatan` (`id_dokumentasi`, `nama`, `photo`, `id_penelitian`, `id_publikasi`, `id_pengabdian`, `id_haki`, `id_buku`) VALUES
(1, 'gambar warna warni', './uploads/kegiatan/gambar_6.png', 14, 0, 0, 0, 0),
(2, '', './uploads/kegiatan/gambar_5.png', 14, 0, 0, 0, 0),
(3, 'sdfsdf', './uploads/kegiatan/62fbdfe3-e04d-45e4-8a82-e0458c5e8be1.jpg', 32, 0, 0, 0, 0),
(4, 'asdasd', './uploads/kegiatan/adedd2d3-d320-475e-8830-860039b48e0f.jpg', 33, 0, 0, 0, 0),
(6, '', './uploads/kegiatan/pengabdian/mailer3.png', 0, 0, 1, 0, 0),
(7, '', './uploads/kegiatan/haki/Nature-Full-HD-Wallpaper-national-geographic-7822344-1920-1080.jpg', 0, 0, 0, 2, 0),
(8, '', './uploads/kegiatan/publikasi/jadi.png', 0, 13, 0, 0, 0),
(9, '', './uploads/kegiatan/haki/Nature-Full-HD-Wallpaper-national-geographic-7822344-1920-1080.jpg', 0, 0, 0, 0, 2),
(11, 'Dokumentasi 1', './uploads/kegiatan/penelitian/bantul2.jpg', 1, 0, 0, 0, 0),
(12, 'Test', './uploads/kegiatan/penelitian/kontingen_pimnas.jpg', 1, 0, 0, 0, 0),
(13, 'Foto Dokumentasi Kegiatan', './uploads/kegiatan/penelitian/dapen.jpg', 1, 0, 0, 0, 0),
(14, 'test', './uploads/kegiatan/publikasi/bantul2.jpg', 0, 1, 0, 0, 0),
(15, '', './uploads/kegiatan/publikasi/gambar_3.png', 0, 2, 0, 0, 0),
(16, '', './uploads/kegiatan/pengabdian/Screenshot_1.png', 0, 0, 2, 0, 0);

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
  `id_pengupload` int(3) NOT NULL,
  `id_kategori_haki` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `haki`
--

INSERT INTO `haki` (`id_haki`, `judul_haki`, `lokasi`, `tgl_pelaksanaan`, `id_dosen`, `date`, `deskripsi`, `file`, `komentar_reviewer`, `id_prodi`, `id_pengupload`, `id_kategori_haki`) VALUES
(3, 'haki', 'adadad', '2020-02-26', 74, '2020-02-26', 'ada', './uploads/haki/kartu.pdf', '', 2, 76, 0),
(4, 'haki 2 4', '', '0000-00-00', 72, '2020-04-24', 'menulis haki', './uploads/haki/Contoh_2_word.docx', '', 2, 76, 2),
(6, 'Haki 3', '', '0000-00-00', 72, '2020-04-24', 'haki tiga', './uploads/haki/kartu.pdf', '', 2, 76, 1);

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
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori_buku` int(2) NOT NULL,
  `kategori_buku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori_buku`, `kategori_buku`) VALUES
(1, 'buku Ajar'),
(2, 'Buku Referensi'),
(3, 'Monogram');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_haki`
--

CREATE TABLE `kategori_haki` (
  `id_kategori_haki` int(11) NOT NULL,
  `kategori_haki` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_haki`
--

INSERT INTO `kategori_haki` (`id_kategori_haki`, `kategori_haki`) VALUES
(1, 'Hak Cipta'),
(2, 'Paten');

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
  `file_akhir` varchar(255) NOT NULL,
  `file_sk` varchar(255) NOT NULL,
  `id_checklist_penilaian` varchar(50) NOT NULL,
  `id_prodi` int(3) NOT NULL,
  `id_pengupload` int(3) NOT NULL,
  `sumber_dana` varchar(3) NOT NULL,
  `dana_internal` varchar(20) NOT NULL,
  `dana_eksternal` varchar(20) NOT NULL,
  `lembaga_eksternal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `judul_penelitian`, `lokasi`, `tgl_pelaksanaan`, `id_dosen`, `status`, `date`, `deskripsi`, `file`, `file_akhir`, `file_sk`, `id_checklist_penilaian`, `id_prodi`, `id_pengupload`, `sumber_dana`, `dana_internal`, `dana_eksternal`, `lembaga_eksternal`) VALUES
(1, 'Judul Penelitian di sini', 'Yogyakarta', '2020-04-01', 72, 2, '2020-04-04', 'judul penelitian', './uploads/penelitian/Revisi_di_Layout_2.docx', './uploads/penelitian/Revisi_di_Layout_2.docx', './uploads/penelitian/kartu.pdf', '1,2', 2, 76, '', '', '', ''),
(2, 'test', 'test', '2020-06-01', 72, 0, '2020-04-13', 'test', './uploads/penelitian/lap_arus_kas.xlsx', '', '', '0', 2, 76, '', '40000000', '', ''),
(3, 'sdfsdfsdfsdf', 'dsfsdf', '2020-04-13', 72, 0, '2020-04-13', 'sdfsdf', './uploads/penelitian/bpkhonline.sql', '', '', '0', 2, 76, '', '', 'sdfsd', 'sssss'),
(4, 'ssss', 'aaaa', '2020-04-13', 74, 0, '2020-04-13', 'sdfsdfdsf', './uploads/penelitian/alokasi_investasi_bpkh.xlsx', '', '', '0', 2, 76, '', '4545454', '454545', '54545'),
(5, 'ssss', 'aaaa', '2020-04-13', 74, 0, '2020-04-13', 'sdfsdfdsf', './uploads/penelitian/alokasi_investasi_bpkh1.xlsx', '', '', '0', 2, 76, 'on,', '4545454', '454545', '54545'),
(6, 'ssss', 'aaaa', '2020-04-13', 74, 0, '2020-04-13', 'sdfsdfdsf', './uploads/penelitian/alokasi_investasi_bpkh2.xlsx', '', '', '0', 2, 76, '1,2', '4545454', '454545', '54545'),
(8, 'covid', 'adadad', '2022-04-20', 72, 0, '2020-04-22', 'ada', './uploads/penelitian/59-189-1-PB.pdf', '', '', '0', 2, 76, '1', '20000', '', ''),
(9, 'Covid 2', 'embuh', '2020-04-24', 72, 2, '2020-04-24', 'adakkkk', './uploads/penelitian/1973-4285-1-PB1.pdf', '', '', '0', 2, 76, '', '', '', '');

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
  `file_sk` varchar(255) NOT NULL,
  `file_akhir` varchar(255) NOT NULL,
  `id_checklist_penilaian` varchar(50) NOT NULL,
  `id_prodi` int(3) NOT NULL,
  `id_pengupload` int(3) NOT NULL,
  `sumber_dana` varchar(3) NOT NULL,
  `dana_internal` varchar(20) NOT NULL,
  `dana_eksternal` varchar(20) NOT NULL,
  `lembaga_eksternal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengabdian`
--

INSERT INTO `pengabdian` (`id_pengabdian`, `judul_pengabdian`, `lokasi`, `tgl_pelaksanaan`, `id_dosen`, `status`, `date`, `deskripsi`, `file`, `file_sk`, `file_akhir`, `id_checklist_penilaian`, `id_prodi`, `id_pengupload`, `sumber_dana`, `dana_internal`, `dana_eksternal`, `lembaga_eksternal`) VALUES
(2, 'ada', 'adadad', '2020-02-26', 72, 2, '2020-02-26', 'adas', './uploads/pengabdian/Screenshot_2.png', './uploads/pengabdian/Contoh_2_word.docx', './uploads/pengabdian/24117-75676579720-2-PB.pdf', '0', 2, 76, '', '', '', ''),
(3, 'ada jakarta', 'Jakarta 1', '2024-04-20', 72, 0, '2020-04-24', 'coba', './uploads/pengabdian/24117-75676579720-2-PB.pdf', '', '', '0', 2, 76, '1,2', '1000', '2000', 'ada');

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
(1, 'test', '2020-04-01', 72, 2, 1, 2, '', '2020-04-04', 'deskripsi', './uploads/publikasi/Revisi_di_Layout_2.docx', '', 'http://scopus.com', '', 1, '04/04/2020', 2, 76),
(2, 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2004-04-20', 73, 2, 2, 7, '', '2020-04-04', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', './uploads/publikasi/Revisi_di_Layout_21.docx', '', 'http://google.com', '', 1, '', 2, 76);

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
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

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
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori_buku`);

--
-- Indexes for table `kategori_haki`
--
ALTER TABLE `kategori_haki`
  ADD PRIMARY KEY (`id_kategori_haki`);

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
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_dokumentasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `haki`
--
ALTER TABLE `haki`
  MODIFY `id_haki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_publikasi`
--
ALTER TABLE `jenis_publikasi`
  MODIFY `id_jenis_publikasi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori_buku` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_haki`
--
ALTER TABLE `kategori_haki`
  MODIFY `id_kategori_haki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id_penelitian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengabdian`
--
ALTER TABLE `pengabdian`
  MODIFY `id_pengabdian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `publikasi`
--
ALTER TABLE `publikasi`
  MODIFY `id_publikasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_jenis_publikasi`
--
ALTER TABLE `sub_jenis_publikasi`
  MODIFY `id_sub_jenis_publikasi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
