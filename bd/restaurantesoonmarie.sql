-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 13, 2021 at 10:33 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantesoonmarie`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_busquedaEmpleado` ()  BEGIN
	SELECT * FROM v_empleados WHERE Empleado LIKE concat(nameEmpleado,'%') ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_deleteEmp` (`nVDNI` VARCHAR(8))  begin
DECLARE nPerson INT;
DECLARE nCuenta INT;
SET nPerson = f_getfkPersonEmple(nVDNI);
SET nCuenta = f_getidCuentaEmple(nVDNI);
DELETE FROM empleados WHERE DNI = nVDNI;
DELETE FROM personas WHERE idPerson = nPerson;
DELETE FROM cuentas WHERE idCuenta = nCuenta;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_deleteReserva` (`CodReserva` VARCHAR(10))  begin
DELETE FROM detallereservas WHERE fk_reserva = CodReserva;
SELECT numComensales into @numComensales FROM reservas WHERE codReserva = CodReserva;
SELECT fk_codCliente into @codCliente FROM reservas WHERE codReserva = CodReserva;
SELECT fk_idPerson into @idPersona FROM clientes WHERE codCliente = @codCliente;
SELECT fk_idTurnos into  @idTurnos FROM reservas WHERE codReserva = CodReserva;

UPDATE turnos SET capacidad = capacidad + @numComensales WHERE idTurnos = @idTurnos;
DELETE FROM clientes WHERE codCliente = @codCliente;
DELETE FROM personas WHERE idPerson = @idPersona;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevaCategoria` (`newCategoria` VARCHAR(50))  begin
INSERT INTO categorias VALUES (f_geneCodCat(newCategoria),newCategoria);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevaCuenta` (`newusuario` VARCHAR(10), `newpassword` VARCHAR(10), `newestado` INT, `newfk_codCategoria` VARCHAR(10))  begin
INSERT INTO cuentas(idCuenta,usuario,password,estado,fk_codCategoria) VALUES (f_setIdCuenta(),f_estandarDatoPerson(newusuario),newpassword,newestado,newfk_codCategoria);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevaEspecialidad` (`newEspecialidad` VARCHAR(50))  begin
INSERT INTO especialidades VALUES (f_geneCodEsp(),newEspecialidad);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevaReserva` (`nNumComensales` INT, `nfk_codCliente` VARCHAR(10), `nfk_DNI` VARCHAR(8), `nfk_idTurnos` INT)  begin
INSERT INTO reservas (codReserva,numComensales,fk_codCliente,fk_DNI,fk_idTurnos) VALUES (f_geneCodReserva(),nNumComensales,nfk_codCliente,nfk_DNI,nfk_idTurnos);
UPDATE turnos SET capacidad = capacidad - nNumComensales WHERE idTurnos = nfk_idTurnos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevoCliente` (`nApePat` VARCHAR(50), `nfk_person` INT)  begin
INSERT INTO clientes (codCliente,fk_idPerson) VALUES (f_geneCodClie(nApePat),nfk_person);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevoDetalleReserva` (`nfk_reserva` VARCHAR(10), `nfk_platos` VARCHAR(10), `nfecha_reservada` DATE)  begin
SELECT precio into @precioPlato FROM platos WHERE codPlato = nfk_platos;
SELECT numComensales into @numComensales FROM reservas WHERE codReserva = nfk_reserva;
INSERT INTO detallereservas (fk_reserva,fk_platos,precioPagar,fecha_llamada,fecha_reserva) VALUES (nfk_reserva,nfk_platos,f_calculoPago(@precioPlato,@numComensales),current_timestamp(),nfecha_reservada);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevoEmpleado` (`newDNI` VARCHAR(8), `newfk_person` INT, `newfk_idCuenta` INT)  begin
INSERT INTO empleados(DNI,fk_persona,fk_idCuenta) VALUES (newDNI,newfk_person,newfk_idCuenta);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevoPlato` (`nNombrePlato` VARCHAR(50), `nPrecio` FLOAT, `nfk_codEspecialidad` VARCHAR(10), `nfk_codTipo` INT)  begin
INSERT INTO platos (codPlato,nombrePlato,precio,fk_codEspecialidad,fk_codTipo) VALUES (f_geneCodPlato(nNombrePlato),nNombrePlato,nPrecio,nfk_codEspecialidad,nfk_codTipo);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevoRegisClie` (`newNombre` VARCHAR(50), `newapellidoPat` VARCHAR(50), `newapellidoMat` VARCHAR(50), `newNumTel` VARCHAR(11), `newDireccion` VARCHAR(50), `newfk_DNI` VARCHAR(8), `newComensales` INT, `newfk_idTurnos` INT, `nfecha_reservada` DATE, `newfk_plato` VARCHAR(10))  begin
INSERT INTO personas (idPerson,nombres,apellidoPat,apellidoMat,numTelefono,direccion) VALUES 
(f_setIdPerson(),f_estandarDatoPerson(newNombre),f_estandarDatoPerson(newapellidoPat),f_estandarDatoPerson(newApellidoMat),newNumTel,f_estandarDatoPerson(newDireccion));
CALL p_nuevoCliente(newapellidoPat,f_setIdPerson()-1);
SELECT codCliente into @codCliente FROM clientes WHERE codCliente = f_geneCodClie(newapellidoPat);
CALL p_nuevaReserva(newComensales,@codCliente,newfk_DNI,newfk_idTurnos);
SELECT codReserva into @ncodReserva FROM reservas WHERE codReserva = f_getCodReserva();
CALL p_nuevoDetalleReserva(@ncodReserva,newfk_plato,nfecha_reservada);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_nuevoRegisEmp` (`newDNI` VARCHAR(8), `newNombre` VARCHAR(50), `newapellidoPat` VARCHAR(50), `newapellidoMat` VARCHAR(50), `newNumTel` VARCHAR(11), `newDireccion` VARCHAR(50), `newpassword` VARCHAR(10), `newestado` INT, `newfk_codCategoria` VARCHAR(10))  begin
INSERT INTO personas (idPerson,nombres,apellidoPat,apellidoMat,numTelefono,direccion) VALUES 
(f_setIdPerson(),f_estandarDatoPerson(newNombre),f_estandarDatoPerson(newapellidoPat),f_estandarDatoPerson(newApellidoMat),newNumTel,f_estandarDatoPerson(newDireccion));
CALL p_nuevaCuenta(newNombre,newpassword,newestado,newfk_codCategoria);
CALL p_nuevoEmpleado(newDNI,f_setIdPerson()-1,f_setIdCuenta()-1);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_updateEmpleado` (`nNombre` VARCHAR(50), `nApellidoPat` VARCHAR(50), `nApellidoMat` VARCHAR(50), `nfk_Persona` INT, `nfk_idCuenta` INT)  begin
UPDATE personas SET nombres = nNombre,apellidoPat = nApellidoPat,apellidoMat = nApellidoMat WHERE idPerson = nfk_Persona;
UPDATE cuentas SET usuario = f_estandarDatoPerson(nNombre) WHERE idCuenta = nfk_idCuenta;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_updateReserva` (`nCodReserva` VARCHAR(10), `nNumComensales` INT, `nfk_idTurnos` INT, `nfk_platos` VARCHAR(10), `nfecha_reserva` DATE, `oldfk_idTurnos` INT, `oldNumComensales` INT)  begin

UPDATE reservas SET numComensales = nNumComensales WHERE codReserva = nCodReserva;
UPDATE reservas SET fk_idTurnos = nfk_idTurnos WHERE codReserva = nCodReserva;
UPDATE turnos SET capacidad = capacidad - nNumComensales WHERE idTurnos = nfk_idTurnos;
UPDATE turnos SET capacidad  = capacidad + oldNumComensales WHERE idTurnos = oldfk_idTurnos;
UPDATE detallereservas SET fecha_reserva = nfecha_reserva, fecha_llamada = current_timestamp() WHERE fk_reserva = nCodReserva;
SELECT precio into @precioPlato FROM platos WHERE codPlato = nfk_platos;
UPDATE detallereservas SET fk_platos = nfk_platos, precioPagar = f_calculoPago(@precioPlato,nNumComensales) WHERE fk_reserva = nCodReserva;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `f_calculoPago` (`nPrecioPlato` FLOAT, `nNumComensales` INT) RETURNS FLOAT BEGIN 
    return nPrecioPlato*nNumComensales;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_estandarDatoPerson` (`newNombre` VARCHAR(50)) RETURNS VARCHAR(50) CHARSET utf8mb4 BEGIN 
	#para el nombre de la persona
	SET @primerLetra = upper(left(newNombre,1));
    SET @restNombre = lower(substr(newNombre,2));
    SET @nomUsuario = concat(@primerLetra,@restNombre); #primera letra mayuscula y el resto minuscula
    return @nomUsuario;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_geneCodCat` (`newCategoria` VARCHAR(50)) RETURNS VARCHAR(50) CHARSET utf8mb4 BEGIN 
	SET @restante = upper(left(newCategoria,3));
    SET @codGenerado = concat('CEM','-',@restante);
    return @codGenerado;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_geneCodClie` (`newApePat` VARCHAR(50)) RETURNS VARCHAR(10) CHARSET utf8mb4 BEGIN 
	SET @restante = upper(left(newApePat,6));
    SET @codGenerado = concat('CLI','-',@restante);
    return @codGenerado;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_geneCodEsp` () RETURNS VARCHAR(50) CHARSET utf8mb4 BEGIN 
	SELECT count(*)+1 into @cantidad FROM especialidades;
    SET @codGenerado = concat('ESP','-',@cantidad);
    return @codGenerado;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_geneCodPlato` (`newNombre` VARCHAR(50)) RETURNS VARCHAR(10) CHARSET utf8mb4 BEGIN 
	SET @restante = reverse(upper(right(newNombre,4)));
    SET @codGenerado = concat('PLATO','-',@restante);
    return @codGenerado;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_geneCodReserva` () RETURNS VARCHAR(10) CHARSET utf8mb4 BEGIN 
	DECLARE sumador INT;
    DECLARE totalCeros INT;
	SELECT count(*) into @cantidadReservas FROM reservas;
    SET sumador = @cantidadReservas+1;
    SELECT char_length(sumador) into @restantes;
    SET totalCeros = 6-@restantes;
    SELECT repeat('0',totalCeros) into @repeatCeros;
    SET @codGenerado = concat('RES','-',@repeatCeros,sumador);
    return @codGenerado;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_getCodReserva` () RETURNS VARCHAR(10) CHARSET utf8mb4 BEGIN 
	DECLARE sumador INT;
    DECLARE totalCeros INT;
	SELECT count(*) into @cantidadReservas FROM reservas;
    SET sumador = @cantidadReservas;
    SELECT char_length(sumador) into @restantes;
    SET totalCeros = 6-@restantes;
    SELECT repeat('0',totalCeros) into @repeatCeros;
    SET @codGenerado = concat('RES','-',@repeatCeros,sumador);
    return @codGenerado;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_getDniEmpleado` (`nidCuenta` INT) RETURNS VARCHAR(8) CHARSET utf8mb4 BEGIN 
	DECLARE regDNIEMple VARCHAR(8);
	SELECT DNI into @regDNI FROM empleados WHERE fk_idCuenta = nidCuenta;
    SET regDNIEmple = @regDNI;
    return regDNIEmple;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_getfkPersonEmple` (`nDni` VARCHAR(8)) RETURNS INT(11) BEGIN 
	SELECT fk_persona into @nfkPerson FROM empleados WHERE DNI = nDNI;
    return @nfkPerson;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_getidCuentaEmple` (`nDNI` VARCHAR(8)) RETURNS INT(11) BEGIN 
	SELECT fk_idCuenta into @nidCuenta FROM empleados WHERE DNI = nDNI;
    return @nidCuenta;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_setIdCuenta` () RETURNS INT(11) BEGIN 
    SELECT count(*) into @cantidadCuentas FROM cuentas;
    return @cantidadCuentas+1;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_setIdPerson` () RETURNS INT(11) BEGIN 
    SELECT count(*) into @cantidadPerson FROM personas;
    return @cantidadPerson+1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `codCategoria` varchar(10) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`codCategoria`, `categoria`) VALUES
('CEM-AYU', 'ayudante de cocina'),
('CEM-EMP', 'encargada del comedor'),
('CEM-GER', 'gerente'),
('CEM-JEF', 'jefe de cocina'),
('CEM-MES', 'Mesero');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `codCliente` varchar(10) NOT NULL,
  `fk_idPerson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`codCliente`, `fk_idPerson`) VALUES
('CLI-AGUEDO', 1),
('CLI-CASTRO', 5),
('CLI-QUIROZ', 7),
('CLI-MARTÍN', 8),
('CLI-GARCÍA', 9),
('CLI-CHAUCA', 10),
('CLI-GARAY', 11),
('CLI-ROSAS', 12),
('CLI-SOLIS', 13),
('CLI-TEST', 15);

-- --------------------------------------------------------

--
-- Table structure for table `cuentas`
--

CREATE TABLE `cuentas` (
  `idCuenta` int(11) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `fk_codCategoria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuentas`
--

INSERT INTO `cuentas` (`idCuenta`, `usuario`, `password`, `estado`, `fk_codCategoria`) VALUES
(1, 'Valeria', '$2a$07$asxx54ahjppf45sd87a5auFCbkGBzVfLIGWPS1U09AfZL0nsFQowi', 1, 'CEM-GER'),
(2, 'Maria', '$2a$07$asxx54ahjppf45sd87a5aupmn4Y3C5FO71gucunm9qpeeVdffDgke', 0, 'CEM-EMP'),
(3, 'Gastón', '$2a$07$asxx54ahjppf45sd87a5au80vs35huqESSmwQj0f73KOOCWESZv0S', 1, 'CEM-JEF'),
(4, 'Diego', '$2a$07$asx', 0, 'CEM-AYU');

-- --------------------------------------------------------

--
-- Table structure for table `detallereservas`
--

CREATE TABLE `detallereservas` (
  `idDetalles` int(11) NOT NULL,
  `fk_reserva` varchar(10) NOT NULL,
  `fk_platos` varchar(10) NOT NULL,
  `precioPagar` float NOT NULL,
  `fecha_llamada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_reserva` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detallereservas`
--

INSERT INTO `detallereservas` (`idDetalles`, `fk_reserva`, `fk_platos`, `precioPagar`, `fecha_llamada`, `fecha_reserva`) VALUES
(2, 'RES-000001', 'PLATO-LLAT', 22.5, '2021-10-14 17:51:36', '2021-10-14'),
(6, 'RES-000002', 'PLATO-LLAT', 37.5, '2021-10-14 05:28:07', '2021-10-18'),
(7, 'RES-000003', 'PLATO-OLLO', 18.6, '2021-10-13 04:23:33', '2021-10-15'),
(8, 'RES-000004', 'PLATO-EHCI', 27, '2021-10-13 04:23:39', '2021-10-18'),
(9, 'RES-000005', 'PLATO-EHCI', 36, '2021-10-13 04:23:47', '2021-10-17'),
(17, 'RES-000006', 'PLATO-OLLO', 18.6, '2021-10-14 05:17:15', '2021-10-15'),
(20, 'RES-000007', 'PLATO-LLAT', 15, '2021-10-14 21:15:40', '2021-10-16'),
(21, 'RES-000008', 'PLATO-OLLO', 18.6, '2021-10-14 22:02:40', '2021-11-10'),
(22, 'RES-000009', 'PLATO-EHCI', 18, '2021-10-14 22:04:28', '2021-12-18'),
(25, 'RES-000010', 'PLATO-LLAT', 37.5, '2021-10-15 22:01:18', '2021-10-17');

--
-- Triggers `detallereservas`
--
DELIMITER $$
CREATE TRIGGER `deleteReserva` AFTER DELETE ON `detallereservas` FOR EACH ROW INSERT INTO t_detallereservas (fk_reserva,fk_plato_old,fk_pago_old,fecha_llamada_old,fecha_reserva_old,Usuario,Accion) values 
						(OLD.fk_reserva,OLD.fk_platos,OLD.precioPagar,OLD.fecha_llamada,OLD.fecha_reserva,system_user(),'DELETE')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertarReserva` AFTER INSERT ON `detallereservas` FOR EACH ROW INSERT INTO t_detallereservas (fk_reserva,fk_plato_new,fk_pago_new,fecha_llamada_new,fecha_reserva_new,Usuario,Accion) values 
						(NEW.fk_reserva,NEW.fk_platos,NEW.precioPagar,NEW.fecha_llamada,NEW.fecha_reserva,system_user(),'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_updatereservas` AFTER UPDATE ON `detallereservas` FOR EACH ROW INSERT INTO t_detallereservas (fk_reserva,fk_plato_new,fk_plato_old,fk_pago_new,fk_pago_old,fecha_llamada_new,fecha_llamada_old,fecha_reserva_new,fecha_reserva_old,Usuario,Accion) values 
						(OLD.fk_reserva,NEW.fk_platos,OLD.fk_platos,NEW.precioPagar,OLD.precioPagar,NEW.fecha_llamada,OLD.fecha_llamada,NEW.fecha_reserva,OLD.fecha_reserva,system_user(),'UPDATE')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `DNI` varchar(8) NOT NULL,
  `fk_persona` int(11) NOT NULL,
  `fk_idCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`DNI`, `fk_persona`, `fk_idCuenta`) VALUES
('75182627', 2, 1),
('75891423', 14, 4),
('78945612', 6, 3),
('85967412', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `especialidades`
--

CREATE TABLE `especialidades` (
  `codEspecialidad` varchar(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `especialidades`
--

INSERT INTO `especialidades` (`codEspecialidad`, `descripcion`) VALUES
('ESP-1', 'cocina regional'),
('ESP-2', 'cocina internacional'),
('ESP-3', 'cocina nacional'),
('ESP-4', 'cocina americana');

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `idPerson` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidoPat` varchar(50) NOT NULL,
  `apellidoMat` varchar(50) NOT NULL,
  `numTelefono` varchar(11) NOT NULL,
  `direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`idPerson`, `nombres`, `apellidoPat`, `apellidoMat`, `numTelefono`, `direccion`) VALUES
(1, 'Gerson', 'Aguedo', 'Yanac', '951236874', 'Sierra Hermosa #464'),
(2, 'Valeria', 'Vendizú', 'Castillo', '963852102', 'Jr. San Maritn'),
(3, 'Gaston', 'Ramirez', 'Montesco', '963852741', 'Belén'),
(4, 'Maria', 'Aranda', 'Barreto', '963852741', 'Av. luzuriaga #232'),
(5, 'Mary', 'Sanchez', 'Silva', '963852741', 'Jr. caraz'),
(6, 'Gastón', 'Acurio', 'Lopéz', '963852741', 'Av. centenario #432'),
(7, 'Jimena', 'Quiroz', 'Vega', '963852741', 'Milagro #221'),
(8, 'Roberto', 'Martínez', 'Sosa', '963852741', 'Jr. 13 de diciembre #432'),
(9, 'Francisca', 'García', 'Rojas', '963852741', 'Av. centenario #434'),
(10, 'Dannia', 'Chauca', 'Dominguez', '963852741', 'Av. wilcahuain'),
(11, 'Sofía', 'Garay', 'Montés', '951023683', 'Jr. alpamayo'),
(12, 'Miguel', 'Rosas', 'Camones', '987023147', 'Av. luzuriaga'),
(13, 'Jennifer', 'Solis', 'Tabara', '951623874', 'Av. montevideo #212'),
(14, 'Diego', 'Jiménez', 'Sosa', '987456123', 'Jr. alpamayo'),
(15, 'Marco', 'prueba', 'Test', '987456321', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `platos`
--

CREATE TABLE `platos` (
  `codPlato` varchar(10) NOT NULL,
  `nombrePlato` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `fk_codEspecialidad` varchar(10) NOT NULL,
  `fk_codTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `platos`
--

INSERT INTO `platos` (`codPlato`, `nombrePlato`, `precio`, `fk_codEspecialidad`, `fk_codTipo`) VALUES
('PLATO-ACIP', 'Picante de cuy', 6, 'ESP-1', 2),
('PLATO-EHCI', 'Ceviche', 9, 'ESP-2', 2),
('PLATO-LLAT', 'Tallarines rojos', 7.5, 'ESP-2', 1),
('PLATO-OLLO', 'Arroz chaufa', 6.2, 'ESP-2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `codReserva` varchar(10) NOT NULL,
  `numComensales` int(11) NOT NULL,
  `fk_codCliente` varchar(10) NOT NULL,
  `fk_DNI` varchar(8) NOT NULL,
  `fk_idTurnos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`codReserva`, `numComensales`, `fk_codCliente`, `fk_DNI`, `fk_idTurnos`) VALUES
('RES-000001', 3, 'CLI-AGUEDO', '85967412', 1),
('RES-000002', 5, 'CLI-CASTRO', '85967412', 2),
('RES-000003', 3, 'CLI-QUIROZ', '85967412', 3),
('RES-000004', 3, 'CLI-MARTÍN', '75182627', 2),
('RES-000005', 4, 'CLI-GARCÍA', '75182627', 3),
('RES-000006', 3, 'CLI-CHAUCA', '75182627', 4),
('RES-000007', 2, 'CLI-GARAY', '75182627', 1),
('RES-000008', 3, 'CLI-ROSAS', '75182627', 4),
('RES-000009', 2, 'CLI-SOLIS', '75182627', 1),
('RES-000010', 5, 'CLI-TEST', '75182627', 2);

--
-- Triggers `reservas`
--
DELIMITER $$
CREATE TRIGGER `t_deleteReser` AFTER DELETE ON `reservas` FOR EACH ROW INSERT INTO t_reservas (fk_reserva,numCOmensales_old,fk_cod_cli,fk_DNI,fk_idTurno_old,Usuario,Accion) values 
						(OLD.codReserva,OLD.numComensales,OLD.fk_codCliente,OLD.fk_DNI,OLD.fk_idTurnos,system_user(),'DELETE')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_insertarReserva` AFTER INSERT ON `reservas` FOR EACH ROW INSERT INTO t_reservas (fk_reserva,numComensales_new,fk_cod_cli,fk_DNI,fk_idTurno_new,Usuario,Accion) values 
						(NEW.codReserva,NEW.numComensales,NEW.fk_codCliente,NEW.fk_DNI,NEW.fk_idTurnos,system_user(),'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_updateReser` AFTER UPDATE ON `reservas` FOR EACH ROW INSERT INTO t_reservas (fk_reserva,numComensales_new,numCOmensales_old,fk_cod_cli,fk_DNI,fk_idTurno_new,fk_idTurno_old,Usuario,Accion) values 
						(OLD.codReserva,NEW.numComensales,OLD.numComensales,OLD.fk_codCliente,OLD.fk_DNI,NEW.fk_idTurnos,OLD.fk_idTurnos,system_user(),'UPDATE')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tipos`
--

CREATE TABLE `tipos` (
  `codTipo` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipos`
--

INSERT INTO `tipos` (`codTipo`, `descripcion`) VALUES
(1, 'Pastas'),
(2, 'Típico'),
(3, 'Sopas'),
(7, 'Jugos'),
(8, 'especial');

-- --------------------------------------------------------

--
-- Table structure for table `turnos`
--

CREATE TABLE `turnos` (
  `idTurnos` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `inicio` time NOT NULL,
  `fin` time NOT NULL,
  `capacidad` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `turnos`
--

INSERT INTO `turnos` (`idTurnos`, `descripcion`, `inicio`, `fin`, `capacidad`) VALUES
(1, 'comidas', '13:00:00', '14:00:00', 23),
(2, 'comidas', '14:00:00', '15:00:00', 17),
(3, 'cenas', '19:00:00', '20:00:00', 23),
(4, 'cenas', '20:00:00', '21:00:00', 24);

-- --------------------------------------------------------

--
-- Table structure for table `t_detallereservas`
--

CREATE TABLE `t_detallereservas` (
  `idT_DetalleRes` int(11) NOT NULL,
  `fk_reserva` varchar(10) DEFAULT NULL,
  `fk_plato_new` varchar(10) DEFAULT NULL,
  `fk_plato_old` varchar(10) DEFAULT NULL,
  `fk_pago_new` float DEFAULT NULL,
  `fk_pago_old` float DEFAULT NULL,
  `fecha_llamada_new` datetime DEFAULT NULL,
  `fecha_llamada_old` datetime DEFAULT NULL,
  `fecha_reserva_new` date DEFAULT NULL,
  `fecha_reserva_old` date DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL,
  `Accion` varchar(50) DEFAULT NULL,
  `Fecha_accion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_detallereservas`
--

INSERT INTO `t_detallereservas` (`idT_DetalleRes`, `fk_reserva`, `fk_plato_new`, `fk_plato_old`, `fk_pago_new`, `fk_pago_old`, `fecha_llamada_new`, `fecha_llamada_old`, `fecha_reserva_new`, `fecha_reserva_old`, `Usuario`, `Accion`, `Fecha_accion`) VALUES
(1, 'RES-000008', 'PLATO-OLLO', NULL, 12.4, NULL, '2021-10-14 13:00:41', NULL, '2021-10-15', NULL, 'root@localhost', 'INSERT', '2021-10-14 13:00:41'),
(2, 'RES-000008', 'PLATO-OLLO', 'PLATO-OLLO', 12.4, 12.4, '2021-10-14 13:01:49', '2021-10-14 13:00:41', '2021-10-15', '2021-10-15', 'root@localhost', 'UPDATE', '2021-10-14 13:01:49'),
(3, 'RES-000008', 'PLATO-LLAT', 'PLATO-OLLO', 15, 12.4, '2021-10-14 13:01:49', '2021-10-14 13:01:49', '2021-10-15', '2021-10-15', 'root@localhost', 'UPDATE', '2021-10-14 13:01:49'),
(4, 'RES-000008', NULL, 'PLATO-LLAT', NULL, 15, NULL, '2021-10-14 13:01:49', NULL, '2021-10-15', 'root@localhost', 'DELETE', '2021-10-14 13:05:46'),
(5, 'RES-000007', 'PLATO-EHCI', 'PLATO-EHCI', 18, 18, '2021-10-14 13:25:29', '2021-10-14 12:43:26', '2021-10-14', '2021-10-14', 'root@localhost', 'UPDATE', '2021-10-14 13:25:29'),
(6, 'RES-000007', 'PLATO-ACIP', 'PLATO-EHCI', 12, 18, '2021-10-14 13:25:29', '2021-10-14 13:25:29', '2021-10-14', '2021-10-14', 'root@localhost', 'UPDATE', '2021-10-14 13:25:29'),
(7, 'RES-000007', NULL, 'PLATO-ACIP', NULL, 12, NULL, '2021-10-14 13:25:29', NULL, '2021-10-14', 'root@localhost', 'DELETE', '2021-10-14 13:26:01'),
(8, 'RES-000007', 'PLATO-LLAT', NULL, 15, NULL, '2021-10-14 16:15:40', NULL, '2021-10-16', NULL, 'root@localhost', 'INSERT', '2021-10-14 16:15:40'),
(9, 'RES-000008', 'PLATO-OLLO', NULL, 18.6, NULL, '2021-10-14 17:02:40', NULL, '2021-11-10', NULL, 'root@localhost', 'INSERT', '2021-10-14 17:02:40'),
(10, 'RES-000009', 'PLATO-EHCI', NULL, 18, NULL, '2021-10-14 17:04:28', NULL, '2021-12-18', NULL, 'root@localhost', 'INSERT', '2021-10-14 17:04:28'),
(11, 'RES-000010', 'PLATO-EHCI', NULL, 18, NULL, '2021-10-14 17:29:08', NULL, '2021-12-12', NULL, 'root@localhost', 'INSERT', '2021-10-14 17:29:08'),
(12, 'RES-000010', NULL, 'PLATO-EHCI', NULL, 18, NULL, '2021-10-14 17:29:08', NULL, '2021-12-12', 'root@localhost', 'DELETE', '2021-10-15 12:15:20'),
(13, 'RES-000010', 'PLATO-OLLO', NULL, 12.4, NULL, '2021-10-15 16:11:13', NULL, '2021-10-20', NULL, 'root@localhost', 'INSERT', '2021-10-15 16:11:13'),
(14, 'RES-000010', NULL, 'PLATO-OLLO', NULL, 12.4, NULL, '2021-10-15 16:11:13', NULL, '2021-10-20', 'root@localhost', 'DELETE', '2021-10-15 16:12:02'),
(15, 'RES-000010', 'PLATO-EHCI', NULL, 27, NULL, '2021-10-15 16:58:33', NULL, '2021-10-16', NULL, 'root@localhost', 'INSERT', '2021-10-15 16:58:33'),
(16, 'RES-000010', 'PLATO-EHCI', 'PLATO-EHCI', 27, 27, '2021-10-15 17:00:08', '2021-10-15 16:58:33', '2021-10-17', '2021-10-16', 'root@localhost', 'UPDATE', '2021-10-15 17:00:08'),
(17, 'RES-000010', 'PLATO-LLAT', 'PLATO-EHCI', 22.5, 27, '2021-10-15 17:00:08', '2021-10-15 17:00:08', '2021-10-17', '2021-10-17', 'root@localhost', 'UPDATE', '2021-10-15 17:00:08'),
(18, 'RES-000010', 'PLATO-LLAT', 'PLATO-LLAT', 22.5, 22.5, '2021-10-15 17:01:18', '2021-10-15 17:00:08', '2021-10-17', '2021-10-17', 'root@localhost', 'UPDATE', '2021-10-15 17:01:18'),
(19, 'RES-000010', 'PLATO-LLAT', 'PLATO-LLAT', 37.5, 22.5, '2021-10-15 17:01:18', '2021-10-15 17:01:18', '2021-10-17', '2021-10-17', 'root@localhost', 'UPDATE', '2021-10-15 17:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `t_reservas`
--

CREATE TABLE `t_reservas` (
  `fk_reserva` varchar(10) DEFAULT NULL,
  `numComensales_new` int(11) DEFAULT NULL,
  `numCOmensales_old` int(11) DEFAULT NULL,
  `fk_cod_cli` varchar(10) DEFAULT NULL,
  `fk_DNI` varchar(10) DEFAULT NULL,
  `fk_idTurno_new` int(11) DEFAULT NULL,
  `fk_idTurno_old` int(11) DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL,
  `Accion` varchar(50) DEFAULT NULL,
  `Fecha_accion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_reservas`
--

INSERT INTO `t_reservas` (`fk_reserva`, `numComensales_new`, `numCOmensales_old`, `fk_cod_cli`, `fk_DNI`, `fk_idTurno_new`, `fk_idTurno_old`, `Usuario`, `Accion`, `Fecha_accion`) VALUES
('RES-000007', 2, 2, 'CLI-MOLINA', '75182627', 1, 1, 'root@localhost', 'UPDATE', '2021-10-14 13:25:29'),
('RES-000007', 2, 2, 'CLI-MOLINA', '75182627', 1, 1, 'root@localhost', 'UPDATE', '2021-10-14 13:25:29'),
('RES-000007', NULL, 2, 'CLI-MOLINA', '75182627', NULL, 1, 'root@localhost', 'DELETE', '2021-10-14 13:26:02'),
('RES-000007', 2, NULL, 'CLI-GARAY', '75182627', 1, NULL, 'root@localhost', 'INSERT', '2021-10-14 16:15:40'),
('RES-000008', 3, NULL, 'CLI-ROSAS', '75182627', 4, NULL, 'root@localhost', 'INSERT', '2021-10-14 17:02:40'),
('RES-000009', 2, NULL, 'CLI-SOLIS', '75182627', 1, NULL, 'root@localhost', 'INSERT', '2021-10-14 17:04:28'),
('RES-000010', 2, NULL, 'CLI-CAMONE', '85967412', 2, NULL, 'root@localhost', 'INSERT', '2021-10-14 17:29:08'),
('RES-000010', NULL, 2, 'CLI-CAMONE', '85967412', NULL, 2, 'root@localhost', 'DELETE', '2021-10-15 12:15:20'),
('RES-000010', 2, NULL, 'CLI-MINAYA', '75182627', 4, NULL, 'root@localhost', 'INSERT', '2021-10-15 16:11:12'),
('RES-000010', NULL, 2, 'CLI-MINAYA', '75182627', NULL, 4, 'root@localhost', 'DELETE', '2021-10-15 16:12:02'),
('RES-000010', 3, NULL, 'CLI-TEST', '75182627', 1, NULL, 'root@localhost', 'INSERT', '2021-10-15 16:58:33'),
('RES-000010', 3, 3, 'CLI-TEST', '75182627', 1, 1, 'root@localhost', 'UPDATE', '2021-10-15 17:00:08'),
('RES-000010', 3, 3, 'CLI-TEST', '75182627', 2, 1, 'root@localhost', 'UPDATE', '2021-10-15 17:00:08'),
('RES-000010', 5, 3, 'CLI-TEST', '75182627', 2, 2, 'root@localhost', 'UPDATE', '2021-10-15 17:01:18'),
('RES-000010', 5, 5, 'CLI-TEST', '75182627', 2, 2, 'root@localhost', 'UPDATE', '2021-10-15 17:01:18');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_clientes`
-- (See below for the actual view)
--
CREATE TABLE `v_clientes` (
`codCliente` varchar(10)
,`Cliente` varchar(152)
,`numTelefono` varchar(11)
,`direccion` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detallereservas`
-- (See below for the actual view)
--
CREATE TABLE `v_detallereservas` (
`idDetalles` int(11)
,`codReserva` varchar(10)
,`Cliente` varchar(152)
,`numComensales` int(11)
,`nombrePlato` varchar(50)
,`precioPagar` float
,`fecha_llamada` timestamp
,`fecha_reserva` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_empleados`
-- (See below for the actual view)
--
CREATE TABLE `v_empleados` (
`DNI` varchar(8)
,`Empleado` varchar(152)
,`usuario` varchar(10)
,`numTelefono` varchar(11)
,`direccion` varchar(50)
,`categoria` varchar(50)
,`estado` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_empusers`
-- (See below for the actual view)
--
CREATE TABLE `v_empusers` (
`DNI` varchar(8)
,`idCuenta` int(11)
,`usuario` varchar(10)
,`password` text
,`estado` int(11)
,`fk_codCategoria` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_platos`
-- (See below for the actual view)
--
CREATE TABLE `v_platos` (
`codPlato` varchar(10)
,`nombrePlato` varchar(50)
,`precio` float
,`especialidad` varchar(50)
,`tipo` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_reservageneral`
-- (See below for the actual view)
--
CREATE TABLE `v_reservageneral` (
`codReserva` varchar(10)
,`Cliente` varchar(152)
,`telCliente` varchar(11)
,`dirCliente` varchar(50)
,`nombrePlato` varchar(50)
,`precioUnidad` float
,`numComensales` int(11)
,`precioPagar` float
,`fecha_llamada` timestamp
,`fecha_reserva` date
,`descripcion` varchar(50)
,`Horario` varchar(23)
,`Empleado` varchar(152)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_reservas`
-- (See below for the actual view)
--
CREATE TABLE `v_reservas` (
`codReserva` varchar(10)
,`Cliente` varchar(152)
,`TelefonoCliente` varchar(11)
,`DireccionCliente` varchar(50)
,`Empleado` varchar(152)
,`descripcion` varchar(50)
,`Horario` varchar(23)
);

-- --------------------------------------------------------

--
-- Structure for view `v_clientes`
--
DROP TABLE IF EXISTS `v_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_clientes`  AS SELECT `c`.`codCliente` AS `codCliente`, concat_ws(' ',`p`.`nombres`,`p`.`apellidoPat`,`p`.`apellidoMat`) AS `Cliente`, `p`.`numTelefono` AS `numTelefono`, `p`.`direccion` AS `direccion` FROM (`clientes` `c` join `personas` `p` on(`c`.`fk_idPerson` = `p`.`idPerson`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_detallereservas`
--
DROP TABLE IF EXISTS `v_detallereservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detallereservas`  AS SELECT `d`.`idDetalles` AS `idDetalles`, `r`.`codReserva` AS `codReserva`, concat_ws(' ',`s`.`nombres`,`s`.`apellidoPat`,`s`.`apellidoMat`) AS `Cliente`, `r`.`numComensales` AS `numComensales`, `p`.`nombrePlato` AS `nombrePlato`, `d`.`precioPagar` AS `precioPagar`, `d`.`fecha_llamada` AS `fecha_llamada`, `d`.`fecha_reserva` AS `fecha_reserva` FROM ((((`detallereservas` `d` join `reservas` `r` on(`d`.`fk_reserva` = `r`.`codReserva`)) join `clientes` `c` on(`r`.`fk_codCliente` = `c`.`codCliente`)) join `personas` `s` on(`c`.`fk_idPerson` = `s`.`idPerson`)) join `platos` `p` on(`d`.`fk_platos` = `p`.`codPlato`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_empleados`
--
DROP TABLE IF EXISTS `v_empleados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_empleados`  AS SELECT `e`.`DNI` AS `DNI`, concat_ws(' ',`p`.`nombres`,`p`.`apellidoPat`,`p`.`apellidoMat`) AS `Empleado`, `c`.`usuario` AS `usuario`, `p`.`numTelefono` AS `numTelefono`, `p`.`direccion` AS `direccion`, `g`.`categoria` AS `categoria`, `c`.`estado` AS `estado` FROM (((`empleados` `e` join `personas` `p` on(`e`.`fk_persona` = `p`.`idPerson`)) join `cuentas` `c` on(`e`.`fk_idCuenta` = `c`.`idCuenta`)) join `categorias` `g` on(`c`.`fk_codCategoria` = `g`.`codCategoria`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_empusers`
--
DROP TABLE IF EXISTS `v_empusers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_empusers`  AS SELECT `e`.`DNI` AS `DNI`, `c`.`idCuenta` AS `idCuenta`, `c`.`usuario` AS `usuario`, `c`.`password` AS `password`, `c`.`estado` AS `estado`, `c`.`fk_codCategoria` AS `fk_codCategoria` FROM (`empleados` `e` join `cuentas` `c` on(`e`.`fk_idCuenta` = `c`.`idCuenta`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_platos`
--
DROP TABLE IF EXISTS `v_platos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_platos`  AS SELECT `p`.`codPlato` AS `codPlato`, `p`.`nombrePlato` AS `nombrePlato`, `p`.`precio` AS `precio`, `e`.`descripcion` AS `especialidad`, `t`.`descripcion` AS `tipo` FROM ((`platos` `p` join `especialidades` `e` on(`e`.`codEspecialidad` = `p`.`fk_codEspecialidad`)) join `tipos` `t` on(`t`.`codTipo` = `p`.`fk_codTipo`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_reservageneral`
--
DROP TABLE IF EXISTS `v_reservageneral`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reservageneral`  AS SELECT `r`.`codReserva` AS `codReserva`, concat_ws(' ',`p`.`nombres`,`p`.`apellidoPat`,`p`.`apellidoMat`) AS `Cliente`, `p`.`numTelefono` AS `telCliente`, `p`.`direccion` AS `dirCliente`, `a`.`nombrePlato` AS `nombrePlato`, `a`.`precio` AS `precioUnidad`, `r`.`numComensales` AS `numComensales`, `d`.`precioPagar` AS `precioPagar`, `d`.`fecha_llamada` AS `fecha_llamada`, `d`.`fecha_reserva` AS `fecha_reserva`, `t`.`descripcion` AS `descripcion`, concat_ws(' - ',`t`.`inicio`,`t`.`fin`) AS `Horario`, concat_ws(' ',`s`.`nombres`,`s`.`apellidoPat`,`s`.`apellidoMat`) AS `Empleado` FROM (((((((`reservas` `r` join `detallereservas` `d` on(`r`.`codReserva` = `d`.`fk_reserva`)) join `platos` `a` on(`a`.`codPlato` = `d`.`fk_platos`)) join `clientes` `c` on(`c`.`codCliente` = `r`.`fk_codCliente`)) join `empleados` `e` on(`e`.`DNI` = `r`.`fk_DNI`)) join `personas` `p` on(`p`.`idPerson` = `c`.`fk_idPerson`)) join `personas` `s` on(`s`.`idPerson` = `e`.`fk_persona`)) join `turnos` `t` on(`t`.`idTurnos` = `r`.`fk_idTurnos`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_reservas`
--
DROP TABLE IF EXISTS `v_reservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reservas`  AS SELECT `r`.`codReserva` AS `codReserva`, concat_ws(' ',`p`.`nombres`,`p`.`apellidoPat`,`p`.`apellidoMat`) AS `Cliente`, `p`.`numTelefono` AS `TelefonoCliente`, `p`.`direccion` AS `DireccionCliente`, concat_ws(' ',`s`.`nombres`,`s`.`apellidoPat`,`s`.`apellidoMat`) AS `Empleado`, `t`.`descripcion` AS `descripcion`, concat_ws(' - ',`t`.`inicio`,`t`.`fin`) AS `Horario` FROM (((((`reservas` `r` join `clientes` `c` on(`r`.`fk_codCliente` = `c`.`codCliente`)) join `empleados` `e` on(`r`.`fk_DNI` = `e`.`DNI`)) join `personas` `p` on(`c`.`fk_idPerson` = `p`.`idPerson`)) join `personas` `s` on(`e`.`fk_persona` = `s`.`idPerson`)) join `turnos` `t` on(`r`.`fk_idTurnos` = `t`.`idTurnos`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codCategoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codCliente`),
  ADD KEY `fk_clientes_personas_idx` (`fk_idPerson`);

--
-- Indexes for table `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`idCuenta`),
  ADD KEY `fk_cuentas_categoria` (`fk_codCategoria`);

--
-- Indexes for table `detallereservas`
--
ALTER TABLE `detallereservas`
  ADD PRIMARY KEY (`idDetalles`),
  ADD KEY `fk_res` (`fk_reserva`),
  ADD KEY `fk_plat` (`fk_platos`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `fk_empleado_persona` (`fk_persona`),
  ADD KEY `fk_empleado_cuenta` (`fk_idCuenta`);

--
-- Indexes for table `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`codEspecialidad`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPerson`);

--
-- Indexes for table `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`codPlato`),
  ADD KEY `fk_platos_especialidades1_idx` (`fk_codEspecialidad`),
  ADD KEY `fk_platos_tipos1_idx` (`fk_codTipo`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`codReserva`),
  ADD KEY `fk_reservas_empleados1_idx` (`fk_DNI`),
  ADD KEY `fk_reservas_clientes1_idx` (`fk_codCliente`),
  ADD KEY `fk_reservas_turnos1_idx` (`fk_idTurnos`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`codTipo`);

--
-- Indexes for table `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`idTurnos`);

--
-- Indexes for table `t_detallereservas`
--
ALTER TABLE `t_detallereservas`
  ADD PRIMARY KEY (`idT_DetalleRes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detallereservas`
--
ALTER TABLE `detallereservas`
  MODIFY `idDetalles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `codTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_detallereservas`
--
ALTER TABLE `t_detallereservas`
  MODIFY `idT_DetalleRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_personas` FOREIGN KEY (`fk_idPerson`) REFERENCES `personas` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `fk_cuentas_categoria` FOREIGN KEY (`fk_codCategoria`) REFERENCES `categorias` (`codCategoria`);

--
-- Constraints for table `detallereservas`
--
ALTER TABLE `detallereservas`
  ADD CONSTRAINT `fk_plat` FOREIGN KEY (`fk_platos`) REFERENCES `platos` (`codPlato`),
  ADD CONSTRAINT `fk_res` FOREIGN KEY (`fk_reserva`) REFERENCES `reservas` (`codReserva`);

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleado_cuenta` FOREIGN KEY (`fk_idCuenta`) REFERENCES `cuentas` (`idCuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_persona` FOREIGN KEY (`fk_persona`) REFERENCES `personas` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `fk_platos_especialidades1` FOREIGN KEY (`fk_codEspecialidad`) REFERENCES `especialidades` (`codEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_platos_tipos1` FOREIGN KEY (`fk_codTipo`) REFERENCES `tipos` (`codTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_clientes1` FOREIGN KEY (`fk_codCliente`) REFERENCES `clientes` (`codCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservas_empleados1` FOREIGN KEY (`fk_DNI`) REFERENCES `empleados` (`DNI`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservas_turnos1` FOREIGN KEY (`fk_idTurnos`) REFERENCES `turnos` (`idTurnos`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
