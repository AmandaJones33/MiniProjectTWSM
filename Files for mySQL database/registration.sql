-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 30. 04 2021 kl. 11:48:15
-- Serverversion: 10.4.17-MariaDB
-- PHP-version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `csgo` tinyint(1) NOT NULL,
  `lol` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `admin`, `csgo`, `lol`) VALUES
(1, 'admin', 'admin@admin.dk', '21232f297a57a5a743894a0e4a801fc3', 'Michelle', 'Thykjær', '20967556', 1, 0, 0),
(21, 'JohnDoe', 'test@test.dk', '5f4dcc3b5aa765d61d8327deb882cf99', 'John', 'Doe', '12345678', 0, 1, 1),
(22, 'JaneDoe', 'test@test.dk', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jane', 'Doe', '12345678', 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `workhours`
--

CREATE TABLE `workhours` (
  `user` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `workhours`
--

INSERT INTO `workhours` (`user`, `school`, `date`, `start`, `end`) VALUES
('JohnDoe', 'Gl Lindholm ', '2021-04-19', '10:00:00', '12:30:00'),
('JohnDoe', 'Gl Lindholm ', '2021-04-20', '08:00:00', '12:30:00'),
('JohnDoe', 'Gl Lindholm ', '2021-04-21', '12:30:00', '15:30:00'),
('JohnDoe', 'Filstedvejen Skole', '2021-04-22', '12:30:00', '15:30:00'),
('JaneDoe', 'Aalborg Universitet', '2021-04-12', '11:00:00', '15:00:00'),
('JaneDoe', 'Aalborg Universitet', '2021-04-14', '08:30:00', '16:15:00'),
('admin', 'Filstedvejen Skole', '2021-04-12', '10:30:00', '12:30:00'),
('admin', 'Filstedvejen Skole', '2021-04-15', '08:30:00', '12:30:00'),
('admin', 'Filstedvejen Skole', '2021-04-20', '08:30:00', '16:15:00');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `workplaces`
--

CREATE TABLE `workplaces` (
  `school_name` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `csgo` tinyint(1) NOT NULL,
  `lol` tinyint(1) NOT NULL,
  `salary` float NOT NULL,
  `street_number` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `workplaces`
--

INSERT INTO `workplaces` (`school_name`, `street_name`, `postal_code`, `city`, `csgo`, `lol`, `salary`, `street_number`, `id`) VALUES
('Cool School', 'Your way', 9000, 'Aalborg', 0, 0, 220, 37, 1),
('Gl Lindholm ', 'Lindholmsvej', 9400, 'Nørresundby', 1, 0, 300, 27, 8),
('Filstedvejen Skole', 'Filstedvejen', 9000, 'Aalborg', 0, 1, 300, 12, 9),
('Aalborg Universitet', 'Studystreet', 9210, 'Aalborg Ø', 1, 1, 220, 37, 10);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `password` (`password`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `phone_number` (`phone_number`),
  ADD KEY `admin` (`admin`);

--
-- Indeks for tabel `workplaces`
--
ALTER TABLE `workplaces`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tilføj AUTO_INCREMENT i tabel `workplaces`
--
ALTER TABLE `workplaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
