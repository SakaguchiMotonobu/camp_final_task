-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 
-- サーバのバージョン： 10.4.8-MariaDB
-- PHP のバージョン: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `stork_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `temperature_table`
--

CREATE TABLE `temperature_table` (
  `id` int(12) NOT NULL,
  `date` date NOT NULL,
  `temperature` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `temperature_table`
--

INSERT INTO `temperature_table` (`id`, `date`, `temperature`) VALUES
(2, '2020-05-04', 37.1),
(3, '2020-05-05', 36.9),
(4, '2020-05-06', 36.9),
(5, '2020-05-07', 36.8),
(6, '2020-05-08', 36.9),
(7, '2020-05-09', 36.9),
(8, '2020-05-10', 36.8),
(11, '2020-05-11', 36.9),
(12, '2020-05-12', 36.9),
(13, '2020-05-13', 36.8),
(14, '2020-05-15', 36.4),
(15, '2020-05-16', 36.5),
(16, '2020-05-17', 36.5),
(17, '2020-05-18', 36.4),
(20, '2020-05-19', 36.4),
(21, '2020-05-14', 36.7),
(22, '2020-05-20', 36.5),
(23, '2020-05-21', 36.4),
(24, '2020-05-22', 36.5),
(25, '2020-05-23', 36.4),
(26, '2020-05-24', 36.5),
(28, '2020-05-25', 36.5),
(29, '2020-05-26', 36.5),
(30, '2020-05-27', 36.2),
(31, '2020-05-28', 36.7),
(32, '2020-05-29', 36.9),
(33, '2020-05-30', 36.9),
(34, '2020-05-31', 36.9),
(35, '2020-06-01', 37.1),
(36, '2020-06-02', 36.9),
(37, '2020-06-03', 36.9),
(38, '2020-06-04', 36.9),
(39, '2020-06-05', 36.8),
(40, '2020-06-06', 36.9);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `temperature_table`
--
ALTER TABLE `temperature_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `temperature_table`
--
ALTER TABLE `temperature_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
