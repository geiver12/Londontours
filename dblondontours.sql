-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2019 a las 18:18:09
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dblondontours`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `message` varchar(200) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `name`, `email`, `date`, `message`) VALUES
(3, 'dsfdsaf', 'sosdani2000@hotmail.com', '2019-03-02', '123123'),
(4, 'sosdani', 'sosdani2000@hotmail.com', '2019-03-02', '213213'),
(5, 'sadsa', 'admin@gmail.com', '2019-03-02', '123213'),
(6, 'sdfda', 'sosdani2000@hotmail.com', '2019-03-02', '123123'),
(7, 'asdfdsa', 'sosdani2000@hotmail.com', '2019-03-02', '123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour`
--

CREATE TABLE `tour` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf16_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `duration` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `itinerary` varchar(1000) COLLATE utf16_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `tour`
--

INSERT INTO `tour` (`id`, `name`, `description`, `date`, `duration`, `price`, `itinerary`, `image`) VALUES
(2, 'love', '12312321', '2222-02-04', '2 weeks', 12212, '123123', ''),
(5, 'a city of love merry cristhmas', 'a lot city', '2018-05-22', '233', 20002, '1\n2\n2\n\n2\n2\n', 'undefined'),
(7, 'a city of love merry cristhmas wath up', 'a lot city', '2018-05-22', '233', 20002, '1\n2\n2\n\n2\n2\n', 'undefined'),
(8, 'a city of love merry cristhmas wath up', 'a lot city', '2018-05-22', '233', 20002, '1\n2\n2\n\n2\n2\n', 'undefined'),
(9, 'a city of love merry cristhmas wath up', 'a lot city', '2018-05-22', '233', 20002, '1\n2\n2\n\n2\n2\n', 'undefined'),
(10, 'a city of love merry cristhmas wath up', 'a lot city', '2018-05-22', '233', 20002, '1\n2\n2\n\n2\n2\n', 'undefined'),
(11, 'a city of love merry cristhmas wath up', 'a lot city', '2018-05-22', '233', 20002, '1\n2\n2\n\n2\n2\n', ''),
(12, 'geiver botello', '12312321', '2222-02-22', '121312', 12, '12321', 'C:fakepathg-header.jpg'),
(13, 'sasdas', '12321', '0123-03-12', '12312', 12, '123123', 'C:fakepathg-header.jpg'),
(14, 'geiver botello', '123', '0121-03-12', '123', 123, '12312', 'C:fakepathhpt.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour_user`
--

CREATE TABLE `tour_user` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `tickets` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_tour` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `tour_user`
--

INSERT INTO `tour_user` (`id`, `date`, `tickets`, `fk_user`, `fk_tour`, `state`) VALUES
(1, '2019-03-03', 1, 2, 5, 1),
(2, '2019-03-03', 1, 2, 5, 1),
(3, '2019-03-03', 1, 2, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf16_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf16_unicode_ci NOT NULL,
  `postcode` int(10) NOT NULL,
  `phone` int(20) NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `address`, `postcode`, `phone`, `type`) VALUES
(1, 'sosdani jajaj', 'sosdani2000@hotmail.com', '$2y$10$DsnnpXx6ywr3uav6PE0LG.H6isn1jTq5mTMDdwO3C9.cmSOLZ9gB.', '12312312', 12312321, 123123, 1),
(2, 'geiver botello', 'test@gmail.com', '$2y$10$6dv.y5uk/t1/GGUk7Ea.A.VXmnhy7MG9Nlc75fUuS/QdWLXnUQSw2', 'Ureña\r\nBarrio el caney', 5048, 2147483647, 2),
(4, 'geiver botello', 'test2@gmail.com', '$2y$10$RRxjkbSseargm8.64ubVmO30RDKa1v6rQeKVkCFBKcrk/Zro1pr0W', 'UreñaBarrio el caney', 504812312, 2147483647, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tour_user`
--
ALTER TABLE `tour_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tour_user` (`fk_tour`) USING BTREE,
  ADD KEY `fk_user` (`fk_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tour_user`
--
ALTER TABLE `tour_user`
  ADD CONSTRAINT `tour_user_ibfk_1` FOREIGN KEY (`fk_tour`) REFERENCES `tour` (`id`),
  ADD CONSTRAINT `tour_user_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
