-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2017 a las 07:12:59
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `oswa_inv`
--

-- NOTA: 
      -- Sistema para el control y seguimiento de las Unidades Ópticas de Red para la empresa thundernet.

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL, 
  `username` varchar(50) NOT NULL UNIQUE,  
  `password` varchar(255) NOT NULL, 
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`name`, `username`, `password`) VALUES
('Admin Users', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL UNIQUE,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO categories (name)
VALUES ('ONU');

-- ------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--
CREATE TABLE `products` (
  
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'Unidades Ópticas de Red',
  `categorie_id` INT NOT NULL,
  `quantity` INT DEFAULT 1,
  `serial` varchar(12) NOT NULL,
  `mac` varchar(12) NOT NULL,
  `created_at` TIMESTAMP DEFAULT now(),
  `client_name` varchar(50) NOT NULL,

  FOREIGN KEY (categorie_id) REFERENCES categories(id),
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO products (categorie_id, serial, mac, client_name) VALUES
( 1, "OEMT3C42C2CF", "CETT3C62C2DF", "TEST");

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
