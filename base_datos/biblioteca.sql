-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-02-2021 a las 19:15:51
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCat` varchar(2) NOT NULL,
  `descripcion` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCat`, `descripcion`) VALUES
('1', 'Poesia'),
('2', 'Aventura'),
('3', 'Científico'),
('4', 'Novela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `ID` int(10) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `categoria` varchar(2) DEFAULT NULL,
  `editorial` varchar(50) NOT NULL,
  `resumen` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`ID`, `ISBN`, `titulo`, `autor`, `categoria`, `editorial`, `resumen`) VALUES
(1, '9781401324803', 'Calor helado', 'Richard Castle', '2', 'EDICIONES B', 'El impresionante thriller ambientado en el Ártico canadiense que seducirá a los lectores...'),
(2, '9780739308684', 'Juego de tronos', 'George Raymond Martin', '1', 'Bantam Spectra HarperCollins', 'En el legendario mundo de los Siete Reinos, donde el verano puede durar décadas...'),
(3, '9781531888442', 'El origen de las especies', 'Charles Darwin', '3', 'John Murray', 'fundamento de la teoría de la biología evolutiva.'),
(4, '9781531888442', 'Un océano para llegar a ti', 'Sandra Barneda', '4', 'Editorial Planeta', 'Un océano para llegar a ti, de Sandra Barneda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(10) NOT NULL,
  `usu` varchar(20) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `usu`, `pass`, `tipo`, `dni`) VALUES
(1, 'Henry', 'dcb5ba594861cac6abb54924e978a105', 'admin', '53902285z'),
(2, 'usuario', '3f1308149ab8219e32bf9d91028c4eb4', 'lector', '53902281x');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCat`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_art_fam` (`categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `fk_art_fam` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
