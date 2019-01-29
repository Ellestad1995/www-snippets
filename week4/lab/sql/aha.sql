-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: 29. Jan, 2019 10:34 AM
-- Tjener-versjon: 10.3.12-MariaDB-1:10.3.12+maria~bionic
-- PHP Version: 7.2.13
DROP SCHEMA
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_registry`
--
IF NOT EXISTS contact_registry;
  CREATE DATABASE contact_registry COLLATE = utf8_danish_ci;
USE contact_registry;
-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL UNIQUE,
  `password` varchar(200) NOT NULL,
  `tlf` varchar(200) NOT NULL,
  `nickname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `user`
--

INSERT INTO `user` (`name`, `email`, `password`, `tlf`, `nickname`) VALUES
('Freddie Mercury', 'Farrokh_bulsara@queen.com', '$2y$10$M.VsjlFkqHWkmrewZFFBgOBPOqUVXCUe2IMj9pzZfhgvYGZQ.ShOm', '99887744', 'freddie');