-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2025 a las 04:08:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `prioridad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `titulo`, `descripcion`, `prioridad`) VALUES
(1, 'Mantenimiento internet', 'Cliente sin servicio, problema de IP, 3 dias sin servicio', 4),
(2, 'Mantenimiento camaras', 'No funcionan 2/10 camaras, posible humedad', 2),
(6, 'Revisión de red interna', 'Cliente reporta desconexiones intermitentes en diferentes puntos de la oficina. Posible daño en switch o cableado.', 3),
(7, 'Mantenimiento aire acondicionado', 'Unidad del área de servidores presenta ruido anormal y caída en rendimiento.', 4),
(8, 'Actualización de cámaras', 'Reemplazar 4 cámaras analógicas por cámaras IP. Incluye configuración de NVR.', 2),
(9, 'Reparación de router principal', 'Router presenta reinicios inesperados. Se sospecha sobrecalentamiento o falla de firmware.', 5),
(10, 'Instalación de puntos eléctricos', 'Área administrativa requiere 3 nuevos puntos eléctricos con toma a tierra.', 2),
(11, 'Revisión de enlace inalámbrico', 'Enlace punto a punto pierde señal en las tardes. Posible interferencia o mala alineación.', 3),
(12, 'Mantenimiento de UPS', 'UPS de 1500VA presenta alarma constante. Verificar estado de baterías.', 4),
(13, 'Limpieza de equipos de red', 'Switches y routers del rack presentan acumulación de polvo. Hay riesgo de sobrecalentamiento.', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
