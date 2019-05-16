-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-05-2019 a las 15:39:56
-- Versión del servidor: 5.7.25-0ubuntu0.18.04.2
-- Versión de PHP: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fender`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `avatar` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `texto` text NOT NULL,
  `fecha` date NOT NULL,
  `evento` int(3) NOT NULL,
  `ip` varchar(16) NOT NULL DEFAULT '192.168.1.35'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `autor`, `avatar`, `email`, `texto`, `fecha`, `evento`, `ip`) VALUES
(1, 'Bertín Osborne', 'autor1.jpg', 'venanciomalat@gmail.com', 'Me ha encantado este concierto, lo viví en primera fila.', '2019-04-17', 6, '192.168.1.35'),
(3, 'Cañita Brava', 'autor2.jpg', 'joshe@gmail.com', 'oh my god perfect ocncert', '2019-04-17', 6, '192.168.1.35'),
(4, 'Alejandro Manuel Hernández Recio', 'autor3.jpg', 'alex.hdz94@gmail.com', 'asfasf', '2019-05-02', 6, '::1'),
(5, 'Maikel', 'autor3.jpg', 'maikel@toloquepuedas.com', 'que bonito el concierto mamamia', '2019-05-02', 6, '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicados_sitio`
--

CREATE TABLE `comunicados_sitio` (
  `id` int(4) NOT NULL,
  `titulo` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `texto` text CHARACTER SET utf16 COLLATE utf16_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comunicados_sitio`
--

INSERT INTO `comunicados_sitio` (`id`, `titulo`, `texto`) VALUES
(1, 'Consentimiento del uso de sus datos', 'Sus datos personales serán incluidos en un fichero titularidad del propietario de la web, debidamente inscrito en la Agencia Española de Protección de Datos, conforme a lo previsto en la política de privacidad (establecer link a la política de privacidad) de la web www.salafender. com., con la finalidad de venta de entradas (establecer la finalidad del tratamiento de los datos).Puede ejercitar sus derechos de acceso, rectificación, cancelación y oposición en la dirección de correo electrónico info@salafender.com o en la siguiente dirección postal C/ GINGER ENDI, numero 9.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(3) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(80) NOT NULL,
  `organizador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `descripcion`, `fecha`, `imagen`, `organizador`) VALUES
(1, 'Evento 1', 'k ebento loco por mis muertos', '2019-03-18', 'img/evento1.jpg', 'DJ Pastis'),
(2, 'Evento 2', 'k ebento loco por mis muertos en berda flipas', '2019-04-24', 'img/evento2.jpg', 'DJ Pastis'),
(3, 'Evento 3', 'k ebento loco por mis muertos en berda flipas', '2019-04-10', 'img/evento2.jpg', 'DJ Pastis'),
(4, 'Evento 4', 'k ebento loco por mis muertos en berda flipas', '2019-04-24', 'img/evento2.jpg', 'DJ Pastis'),
(5, 'Evento 5', 'k ebento loco por mis muertos en berda flipas', '2019-04-25', 'img/evento2.jpg', 'DJ Pastis'),
(6, 'Enter Shikari', 'January 2013 – just after releasing their third album ‘A Flash Flood Of Colour’ – Enter Shikari hit Muziek-O-Droom while touring as support for Cancer Bats. Although already being pretty well known for several years with hits like ‘Mothership’ and ‘Juggernaut’ it was the first time I’d seen them perform and I must admit I was immediately sold. Six years later Enter Shikari landed in Ancienne Belgique again with support from As It Is, another pleasant surprise.\r\n\r\n', '2019-04-17', 'img/entershikari.jpg', 'Sala Fender');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras_prohibidas`
--

CREATE TABLE `palabras_prohibidas` (
  `id` int(3) NOT NULL,
  `palabra` varchar(40) NOT NULL,
  `activa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `nombre`) VALUES
(1, 'pop'),
(2, 'rock'),
(5, 'electronica'),
(7, 'retrowave'),
(8, 'synthwave');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene_tag`
--

CREATE TABLE `tiene_tag` (
  `id` int(3) NOT NULL,
  `evento` int(3) NOT NULL,
  `tag` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiene_tag`
--

INSERT INTO `tiene_tag` (`id`, `evento`, `tag`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 4, 1),
(5, 2, 7),
(6, 2, 8),
(7, 1, 8),
(8, 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento` (`evento`) USING BTREE;

--
-- Indices de la tabla `comunicados_sitio`
--
ALTER TABLE `comunicados_sitio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `palabras_prohibidas`
--
ALTER TABLE `palabras_prohibidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiene_tag`
--
ALTER TABLE `tiene_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento` (`evento`),
  ADD KEY `tag` (`tag`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `comunicados_sitio`
--
ALTER TABLE `comunicados_sitio`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `palabras_prohibidas`
--
ALTER TABLE `palabras_prohibidas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tiene_tag`
--
ALTER TABLE `tiene_tag`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiene_tag`
--
ALTER TABLE `tiene_tag`
  ADD CONSTRAINT `tiene_tag_ibfk_1` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiene_tag_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
