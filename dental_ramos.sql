-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 
-- Tiempo de generación: 19-06-2026 a las 00:28:53
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
-- Base de datos: `dental_ramos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `no_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_empleado` int(15) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` varchar(11) NOT NULL,
  `motivo_cita` varchar(100) NOT NULL,
  `confirmada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `pnom_empleado` varchar(30) NOT NULL,
  `snom_empleado` varchar(30) NOT NULL,
  `apellidopa_empleado` varchar(30) NOT NULL,
  `apellidoma_empleado` varchar(30) NOT NULL,
  `fecha_nacimiento_emp` date NOT NULL,
  `edad_empleado` int(20) NOT NULL,
  `ocupacion_empleado` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono_empleado` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
  `no_expediente` int(11) NOT NULL,
  `no_historial` int(15) DEFAULT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `no_factura` int(11) NOT NULL,
  `pnom_paciente` varchar(30) NOT NULL,
  `snom_paciente` varchar(30) NOT NULL,
  `apellidopa_paciente` varchar(30) NOT NULL,
  `apellidoma_paciente` varchar(30) NOT NULL,
  `rfc_paciente` varchar(50) NOT NULL,
  `descripcion_servicio` varchar(100) NOT NULL,
  `precio_trat` decimal(10,2) NOT NULL,
  `rfc_consultorio` varchar(50) NOT NULL,
  `nombre_consultorio` varchar(50) NOT NULL,
  `metodo_de_pago` varchar(30) NOT NULL,
  `id_ticket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clinico`
--

CREATE TABLE `historial_clinico` (
  `no_historial` int(11) NOT NULL,
  `no_expediente` int(11) NOT NULL,
  `enferm_hist` varchar(100) DEFAULT NULL,
  `tejidos_oclusion_hist` varchar(100) DEFAULT NULL,
  `otras_condiciones` varchar(100) DEFAULT NULL,
  `habitos_hist` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `pnom_paciente` varchar(30) NOT NULL,
  `snom_paciente` varchar(30) NOT NULL,
  `apellidopa_paciente` varchar(30) NOT NULL,
  `apellidoma_paciente` varchar(30) NOT NULL,
  `fecha_nacimiento_p` date NOT NULL,
  `edad_paciente` int(11) NOT NULL,
  `correo_paciente` varchar(30) NOT NULL,
  `tel_paciente` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `no_seguimiento` int(11) NOT NULL,
  `no_expediente` int(11) NOT NULL,
  `nombre_segui` varchar(50) NOT NULL,
  `fechainicio_segui` date NOT NULL,
  `fechafin_segui` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `no_tratamiento` int(15) NOT NULL,
  `fecha_cita` date NOT NULL,
  `precio_trat` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `no_tratamiento` int(11) NOT NULL,
  `no_seguimiento` int(15) NOT NULL,
  `observaciones_trat` text NOT NULL,
  `medicamento_trat` text NOT NULL,
  `tratamiento_trat` text NOT NULL,
  `evaluar_proxima` text NOT NULL,
  `precio_trat` decimal(10,2) NOT NULL,
  `pagado` tinyint(1) NOT NULL,
  `metodo_pago` varchar(30) DEFAULT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` varchar(100) NOT NULL,
  `no_cita` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`no_cita`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `pacienteid` (`id_paciente`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`no_expediente`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `no_historial` (`no_historial`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`no_factura`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indices de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD PRIMARY KEY (`no_historial`),
  ADD KEY `numero_expediente` (`no_expediente`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`no_seguimiento`),
  ADD KEY `no_expediente` (`no_expediente`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `no_tratamiento` (`no_tratamiento`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`no_tratamiento`),
  ADD KEY `no_seguimiento` (`no_seguimiento`),
  ADD KEY `no_cita` (`no_cita`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `no_cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `expediente`
--
ALTER TABLE `expediente`
  MODIFY `no_expediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `no_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  MODIFY `no_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `no_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `no_tratamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `id_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pacienteid` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD CONSTRAINT `id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `no_historial` FOREIGN KEY (`no_historial`) REFERENCES `historial_clinico` (`no_historial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `id_ticket` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD CONSTRAINT `numero_expediente` FOREIGN KEY (`no_expediente`) REFERENCES `expediente` (`no_expediente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD CONSTRAINT `no_expediente` FOREIGN KEY (`no_expediente`) REFERENCES `expediente` (`no_expediente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `no_tratamiento` FOREIGN KEY (`no_tratamiento`) REFERENCES `tratamiento` (`no_tratamiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD CONSTRAINT `no_cita` FOREIGN KEY (`no_cita`) REFERENCES `cita` (`no_cita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `no_seguimiento` FOREIGN KEY (`no_seguimiento`) REFERENCES `seguimiento` (`no_seguimiento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;