-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Apr 2019 pada 15.53
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_ead`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `author` varchar(128) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `img` varchar(128) NOT NULL,
  `date_created` date NOT NULL,
  `is_acc` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `judul`, `author`, `deskripsi`, `img`, `date_created`, `is_acc`) VALUES
(3, 'project tiga', 'Admin', 'project clbk\r\nCODING LAMA BERES KAGA', 'Screenshot_(1)15.png', '2019-04-04', 1),
(4, 'asdaosdjasopdj', 'Admin', 'askdjoasdkjsaokj', 'Screenshot_(1)14.png', '2019-04-04', 1),
(5, '', '', '', '', '0000-00-00', 1),
(7, '', '', '', '', '0000-00-00', 1),
(8, 'teasdsa', 'asdasd', 'dsasdasd', '', '2019-04-17', 1),
(9, 'adsadzzzzzz', '3543', 'asdasdsa', '', '2019-04-24', 1),
(10, '54232', 'zzzzzzzz', 'asdasdsad', '', '2019-04-25', 1),
(11, 'asdv ad ad', 'asdasd', '1231231zx', '', '2019-04-17', 1),
(12, 'Project pertama', 'a', 'Ini tes\r\npost project\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7', 'Screenshot_(1)4.png', '0000-00-00', 1),
(13, 'asdasdasd', 'a', 'zzzzzz', 'Screenshot_(1)6.png', '2019-04-04', 1),
(14, 'Project pertama', 'a', 'Ini tes\r\npost project\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7', 'Screenshot_(1)7.png', '2019-04-04', 1),
(15, 'project tiga', 'a', 'project clbk\r\nCODING LAMA BERES KAGA', 'Screenshot_(1)11.png', '2019-04-04', 1),
(16, 'project tiga', 'Admin', 'project clbk\r\nCODING LAMA BERES KAGA', 'Screenshot_(1)13.png', '2019-04-04', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'Pak Cuy', 'abcd1@gmail.com', 'default.jpg', '$2y$10$/PDH4QlukMlcdkafhVmx7O2bD13DfqxlULmF3ejloj8jYHd9pTaCu', 1, 1, 1553931717),
(3, 'Fakhri', 'wiranathaaaaz98@gmail.com', 'default.jpg', '$2y$10$/PDH4QlukMlcdkafhVmx7O2bD13DfqxlULmF3ejloj8jYHd9pTaCu', 2, 0, 1554351500),
(5, 'kepin', 'kepin12@gmail.com', 'default.jpg', '$2y$10$mfXP9noFEOTXSnhQVS.eYeMgKpWLczHGMYQzGGg0KEq9ewOetDMxy', 1, 1, 1554410198),
(6, 'budi', 'budia@gmail.com', 'default.jpg', '$2y$10$F5YsbZYB9dD/J.fjGMaUau9PsG5x4OqoVXddBRIh1k6mvOV95oU1m', 2, 0, 1554411311),
(7, 'kasdjask', 'admmin@gmail.com', 'default.jpg', '$2y$10$g9oe1yWsk2N/SSviXg4FkeuO0zcQpEw6BP/v3SaYJIyGHsrkjkFzW', 2, 0, 1554411662),
(8, 'asdajdsh agus', 'agus23@gmail.com', 'default.jpg', '$2y$10$SSaw6VI9/xfaC4N6POCMnufde3kIFxeIZvuSEExYJdtDTrWJhah3i', 2, 0, 1554411771),
(11, 'fakhrifi', 'fakhririfi@gmail.com', 'default.jpg', '$2y$10$IEKfPPICDTnMFaGf2yLoLuk/Req9FU5yiDPJTeAJ1JsoqsU7CFrUO', 2, 1, 1554445306),
(12, 'Michael Putera Wardana', 'michaelglaxy@gmail.com', 'default.jpg', '$2y$10$IEKfPPICDTnMFaGf2yLoLuk/Req9FU5yiDPJTeAJ1JsoqsU7CFrUO', 2, 1, 1554445422),
(13, 'Rizky azis', 'Rizkyazis34@gmail.com', 'default.jpg', '$2y$10$Hv3NqDlbQgQ.pVsUrQSFO.UPkyW.KJl.91lDd.//B8V9F2IdUSp/q', 1, 1, 1554450147);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_project`
--

CREATE TABLE `user_project` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `team` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_project`
--

INSERT INTO `user_project` (`id`, `user_id`, `project_id`, `team`) VALUES
(2, 12, 8, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(2, 'michaelglaxy@gmail.com', 'wsRwTmstwir7ghsY6TJG8w==', 1554445422),
(3, 'michaelglaxy@gmail.com', 'W98coyOlrHjCXFGZI6ojNw==', 1554447510);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_project`
--
ALTER TABLE `user_project`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_project`
--
ALTER TABLE `user_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
