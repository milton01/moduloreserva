-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2014 at 11:16 PM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `decameron`
--
CREATE DATABASE IF NOT EXISTS `decameron` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `decameron`;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_activo`
--

CREATE TABLE IF NOT EXISTS `decameron_activo` (
`id_activo` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_app_config`
--

CREATE TABLE IF NOT EXISTS `decameron_app_config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_app_config`
--

INSERT INTO `decameron_app_config` (`key`, `value`) VALUES
('address', 'Salinitas Sonsonate'),
('company', 'Decameron'),
('currency_side', '0'),
('currency_symbol', ''),
('custom10_name', ''),
('custom1_name', ''),
('custom2_name', ''),
('custom3_name', ''),
('custom4_name', ''),
('custom5_name', ''),
('custom6_name', ''),
('custom7_name', ''),
('custom8_name', ''),
('custom9_name', ''),
('default_tax_1_name', 'IVA'),
('default_tax_1_rate', '13'),
('default_tax_2_name', ''),
('default_tax_2_rate', ''),
('default_tax_rate', '8'),
('email', 'mariochepe@hotmail.com'),
('fax', ''),
('language', 'es'),
('phone', '22093000'),
('print_after_sale', '0'),
('return_policy', 'Decameron'),
('timezone', 'America/Belize'),
('website', '');

-- --------------------------------------------------------

--
-- Table structure for table `decameron_costo_por_fecha`
--

CREATE TABLE IF NOT EXISTS `decameron_costo_por_fecha` (
`id_rango_fechas` int(11) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `costo_base` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_costo_por_fecha`
--

INSERT INTO `decameron_costo_por_fecha` (`id_rango_fechas`, `fecha_desde`, `fecha_hasta`, `costo_base`) VALUES
(1, '2014-11-30', '2014-12-04', '100.00'),
(2, '2014-12-05', '2014-12-06', '125.00');

-- --------------------------------------------------------

--
-- Table structure for table `decameron_costo_por_num_personas`
--

CREATE TABLE IF NOT EXISTS `decameron_costo_por_num_personas` (
  `key` varchar(50) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `id_tipo_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_costo_por_num_personas`
--

INSERT INTO `decameron_costo_por_num_personas` (`key`, `value`, `id_tipo_habitacion`) VALUES
('1 Adulto', '1.00', 1),
('1 Adulto', '1.05', 2),
('1 Adulto 1 niño', '2.25', 1),
('1 Adulto 1 niño', '2.30', 2),
('1 Adulto 2 niños', '2.50', 1),
('1 Adulto 2 niños', '2.55', 2),
('1 Adulto 3 niños', '3.25', 1),
('1 Adulto 3 niños', '3.35', 2),
('1 Adulto 4 niños', '3.50', 1),
('1 Adulto 4 niños', '3.60', 2),
('2 Adultos', '1.50', 1),
('2 Adultos', '1.60', 2),
('2 Adultos 1 niño', '2.25', 1),
('2 Adultos 1 niño', '2.35', 2),
('2 Adultos 2 niños', '2.50', 1),
('2 Adultos 2 niños', '2.60', 2),
('2 Adultos 3 niños', '3.00', 1),
('2 Adultos 3 niños', '3.10', 2),
('3 Adultos', '2.10', 1),
('3 Adultos', '2.25', 2),
('3 Adultos 1 niño', '2.75', 1),
('3 Adultos 1 niño', '2.90', 2),
('3 Adultos 2 niños', '3.25', 1),
('3 Adultos 2 niños', '3.40', 2),
('4 Adultos', '2.65', 1),
('4 Adultos', '2.85', 2),
('4 Adultos 1 niño', '3.75', 1),
('4 Adultos 1 niño', '3.90', 2);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_customers`
--

CREATE TABLE IF NOT EXISTS `decameron_customers` (
  `person_id` int(10) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `taxable` int(1) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_edificio`
--

CREATE TABLE IF NOT EXISTS `decameron_edificio` (
`id_edificio` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_edificio`
--

INSERT INTO `decameron_edificio` (`id_edificio`, `nombre`, `descripcion`) VALUES
(1, 'Edificio #1', NULL),
(2, 'Edificio #2', NULL),
(3, 'Edificio #3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_employees`
--

CREATE TABLE IF NOT EXISTS `decameron_employees` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_employees`
--

INSERT INTO `decameron_employees` (`username`, `password`, `person_id`, `deleted`) VALUES
('emarmol', '25d55ad283aa400af464c76d713c07ad', 2, 0),
('kpalacios', '25d55ad283aa400af464c76d713c07ad', 5, 0),
('mecheverria', '25d55ad283aa400af464c76d713c07ad', 1, 0),
('mhernandez', '25d55ad283aa400af464c76d713c07ad', 4, 0),
('stanley', '25d55ad283aa400af464c76d713c07ad', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_franquicia`
--

CREATE TABLE IF NOT EXISTS `decameron_franquicia` (
`id_franquicia` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_franquicia`
--

INSERT INTO `decameron_franquicia` (`id_franquicia`, `nombre`) VALUES
(1, 'Visa'),
(2, 'Master Card'),
(3, 'American Express'),
(4, 'Diners Club');

-- --------------------------------------------------------

--
-- Table structure for table `decameron_giftcards`
--

CREATE TABLE IF NOT EXISTS `decameron_giftcards` (
`giftcard_id` int(11) NOT NULL,
  `giftcard_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `value` decimal(15,2) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_habitacion`
--

CREATE TABLE IF NOT EXISTS `decameron_habitacion` (
`id_habitacion` int(11) NOT NULL,
  `numero_piso` int(11) NOT NULL,
  `numero_habitacion` int(11) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_edificio` int(11) NOT NULL,
  `id_habitacion_capacidad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_habitacion`
--

INSERT INTO `decameron_habitacion` (`id_habitacion`, `numero_piso`, `numero_habitacion`, `descripcion`, `estado`, `id_edificio`, `id_habitacion_capacidad`) VALUES
(1, 1, 1, 'Habitación destinada para hasta 5 personas', 1, 1, 3),
(2, 2, 2, 'Habitación destinada para hasta 4 personas', 1, 1, 2),
(3, 3, 3, 'Habitación destinada para hasta 2 personas', 1, 1, 1),
(4, 1, 4, 'Habitación destinada para hasta 5 personas', 1, 2, 3),
(5, 2, 5, 'Habitación destinada para hasta 4 personas', 1, 2, 2),
(6, 3, 6, 'Habitación destinada para hasta 2 personas', 1, 2, 1),
(7, 1, 7, 'Habitación destinada para hasta 5 personas', 1, 3, 3),
(8, 2, 8, 'Habitación destinada para hasta 4 personas', 1, 3, 2),
(9, 3, 9, 'Habitación destinada para hasta 2 personas', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_habitacion_activo`
--

CREATE TABLE IF NOT EXISTS `decameron_habitacion_activo` (
  `fecha_hora` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `id_activo` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_habitacion_capacidad`
--

CREATE TABLE IF NOT EXISTS `decameron_habitacion_capacidad` (
`id_habitacion_capacidad` int(11) NOT NULL,
  `num_personas` int(11) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_habitacion_capacidad`
--

INSERT INTO `decameron_habitacion_capacidad` (`id_habitacion_capacidad`, `num_personas`, `descripcion`) VALUES
(1, 2, 'Habitación que puede ser ocupada ya sea por solo un Adulto, por 2 Adultos ó por 1 Adulto y 1 niño'),
(2, 4, 'Habitación que puede ser ocupada ya sea por 3 Adultos, 4 Adultos ó ya sea por 1 Adulto y 3 niños, 2 Adultos y 2 niños, 1 Adulto y 3 niños'),
(3, 5, 'Habitación que puede ser ocupada ya sea por 4 Adultos y 1 niño, 3 Adultos y 2 niños, 2 Adultos y 3 niños ó 1 Adulto y 4 niños');

-- --------------------------------------------------------

--
-- Table structure for table `decameron_habitacion_reservacion`
--

CREATE TABLE IF NOT EXISTS `decameron_habitacion_reservacion` (
  `fecha` date NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `id_reservacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_inventory`
--

CREATE TABLE IF NOT EXISTS `decameron_inventory` (
`trans_id` int(11) NOT NULL,
  `trans_items` int(11) NOT NULL DEFAULT '0',
  `trans_user` int(11) NOT NULL DEFAULT '0',
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_comment` text NOT NULL,
  `trans_location` int(11) NOT NULL,
  `trans_inventory` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_items`
--

CREATE TABLE IF NOT EXISTS `decameron_items` (
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item_number` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `quantity` decimal(15,2) NOT NULL DEFAULT '0.00',
  `reorder_level` decimal(15,2) NOT NULL DEFAULT '0.00',
`item_id` int(10) NOT NULL,
  `allow_alt_description` tinyint(1) NOT NULL,
  `is_serialized` tinyint(1) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `custom1` varchar(25) NOT NULL,
  `custom2` varchar(25) NOT NULL,
  `custom3` varchar(25) NOT NULL,
  `custom4` varchar(25) NOT NULL,
  `custom5` varchar(25) NOT NULL,
  `custom6` varchar(25) NOT NULL,
  `custom7` varchar(25) NOT NULL,
  `custom8` varchar(25) NOT NULL,
  `custom9` varchar(25) NOT NULL,
  `custom10` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_items_taxes`
--

CREATE TABLE IF NOT EXISTS `decameron_items_taxes` (
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_item_kits`
--

CREATE TABLE IF NOT EXISTS `decameron_item_kits` (
`item_kit_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_item_kit_items`
--

CREATE TABLE IF NOT EXISTS `decameron_item_kit_items` (
  `item_kit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_item_quantities`
--

CREATE TABLE IF NOT EXISTS `decameron_item_quantities` (
  `item_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_modules`
--

CREATE TABLE IF NOT EXISTS `decameron_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_modules`
--

INSERT INTO `decameron_modules` (`name_lang_key`, `desc_lang_key`, `sort`, `module_id`) VALUES
('module_config', 'module_config_desc', 100, 'config'),
('module_customers', 'module_customers_desc', 10, 'customers'),
('module_employees', 'module_employees_desc', 80, 'employees'),
('module_giftcards', 'module_giftcards_desc', 90, 'giftcards'),
('module_items', 'module_items_desc', 20, 'items'),
('module_item_kits', 'module_item_kits_desc', 30, 'item_kits'),
('module_receivings', 'module_receivings_desc', 60, 'receivings'),
('module_reports', 'module_reports_desc', 50, 'reports'),
('module_sales', 'module_sales_desc', 70, 'sales'),
('module_suppliers', 'module_suppliers_desc', 40, 'suppliers');

-- --------------------------------------------------------

--
-- Table structure for table `decameron_numero_personas`
--

CREATE TABLE IF NOT EXISTS `decameron_numero_personas` (
`id_numero_personas` int(11) NOT NULL,
  `num_adultos` int(11) NOT NULL,
  `num_ninos` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_numero_personas`
--

INSERT INTO `decameron_numero_personas` (`id_numero_personas`, `num_adultos`, `num_ninos`) VALUES
(1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_pasajero`
--

CREATE TABLE IF NOT EXISTS `decameron_pasajero` (
`id_pasajero` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `numero_documento` varchar(25) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` char(1) NOT NULL,
  `person_id` int(11) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_people`
--

CREATE TABLE IF NOT EXISTS `decameron_people` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(500) NOT NULL,
  `address_2` varchar(500) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `numero_documento` varchar(20) DEFAULT NULL,
`person_id` int(10) NOT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_people`
--

INSERT INTO `decameron_people` (`first_name`, `last_name`, `phone_number`, `email`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `comments`, `numero_documento`, `person_id`, `id_tipo_documento`) VALUES
('Mario', 'Echeverria', '75757575', 'mariochepe@hotmail.com', 'Colonia muy Lejos', '', '', '', '', '', '', '03799312-9', 1, 1),
('Erick', 'Marmol', '', '', '', '', '', '', '', '', '', NULL, 2, NULL),
('Stanley', 'Arévalo', '', '', '', '', '', '', '', '', '', NULL, 3, NULL),
('Milton', 'Hernámdez', '', '', '', '', '', '', '', '', '', NULL, 4, NULL),
('Karina', 'Palacios', '', '', '', '', '', '', '', '', '', NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_permissions`
--

CREATE TABLE IF NOT EXISTS `decameron_permissions` (
  `module_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_permissions`
--

INSERT INTO `decameron_permissions` (`module_id`, `person_id`) VALUES
('config', 1),
('customers', 1),
('employees', 1),
('items', 1),
('item_kits', 1),
('receivings', 1),
('reports', 1),
('sales', 1),
('suppliers', 1),
('config', 2),
('customers', 2),
('employees', 2),
('items', 2),
('item_kits', 2),
('receivings', 2),
('reports', 2),
('sales', 2),
('suppliers', 2),
('config', 3),
('customers', 3),
('employees', 3),
('giftcards', 3),
('items', 3),
('item_kits', 3),
('receivings', 3),
('reports', 3),
('sales', 3),
('suppliers', 3),
('customers', 4),
('employees', 4),
('items', 4),
('item_kits', 4),
('receivings', 4),
('reports', 4),
('sales', 4),
('suppliers', 4),
('customers', 5),
('employees', 5),
('items', 5),
('item_kits', 5),
('receivings', 5),
('reports', 5),
('sales', 5),
('suppliers', 5);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_producto_reservacion`
--

CREATE TABLE IF NOT EXISTS `decameron_producto_reservacion` (
  `estado` int(11) NOT NULL DEFAULT '1',
  `descripcion` varchar(500) DEFAULT NULL,
  `id_reservacion` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_receivings`
--

CREATE TABLE IF NOT EXISTS `decameron_receivings` (
  `receiving_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supplier_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
`receiving_id` int(10) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_receivings_items`
--

CREATE TABLE IF NOT EXISTS `decameron_receivings_items` (
  `receiving_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL,
  `quantity_purchased` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` decimal(15,2) NOT NULL,
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_reservacion`
--

CREATE TABLE IF NOT EXISTS `decameron_reservacion` (
`id_reservacion` int(11) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_tipo_habitacion` int(11) NOT NULL,
  `id_tarjeta_credito` int(11) NOT NULL,
  `id_numero_personas` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_reservacion`
--

INSERT INTO `decameron_reservacion` (`id_reservacion`, `fecha_desde`, `fecha_hasta`, `estado`, `id_tipo_habitacion`, `id_tarjeta_credito`, `id_numero_personas`) VALUES
(1, '2014-12-01', '2014-12-05', 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_reservacion_detalle`
--

CREATE TABLE IF NOT EXISTS `decameron_reservacion_detalle` (
  `fecha` date NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `id_reservacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales`
--

CREATE TABLE IF NOT EXISTS `decameron_sales` (
  `sale_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
`sale_id` int(10) NOT NULL,
  `payment_type` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales_items`
--

CREATE TABLE IF NOT EXISTS `decameron_sales_items` (
  `sale_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `quantity_purchased` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` decimal(15,2) NOT NULL,
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales_items_taxes`
--

CREATE TABLE IF NOT EXISTS `decameron_sales_items_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales_payments`
--

CREATE TABLE IF NOT EXISTS `decameron_sales_payments` (
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales_suspended`
--

CREATE TABLE IF NOT EXISTS `decameron_sales_suspended` (
  `sale_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
`sale_id` int(10) NOT NULL,
  `payment_type` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales_suspended_items`
--

CREATE TABLE IF NOT EXISTS `decameron_sales_suspended_items` (
  `sale_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `quantity_purchased` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` decimal(15,2) NOT NULL,
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales_suspended_items_taxes`
--

CREATE TABLE IF NOT EXISTS `decameron_sales_suspended_items_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sales_suspended_payments`
--

CREATE TABLE IF NOT EXISTS `decameron_sales_suspended_payments` (
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_sessions`
--

CREATE TABLE IF NOT EXISTS `decameron_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_sessions`
--

INSERT INTO `decameron_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('3fc00b5b2362f1453088fa1a239e2024', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417393117, ''),
('6c1beed0525e9d1ba27a5dac10212dfa', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416405284, ''),
('d9ff38cf5d06ddd2d0a5039ac7e782a6', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417384560, ''),
('e595d27d50d83731aa90ffef34969fa1', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416177990, 'a:6:{s:9:"user_data";s:0:"";s:9:"person_id";s:1:"1";s:4:"cart";a:0:{}s:9:"sale_mode";s:4:"sale";s:8:"customer";i:-1;s:8:"payments";a:0:{}}');

-- --------------------------------------------------------

--
-- Table structure for table `decameron_stock_locations`
--

CREATE TABLE IF NOT EXISTS `decameron_stock_locations` (
`location_id` int(11) NOT NULL,
  `location_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decameron_stock_locations`
--

INSERT INTO `decameron_stock_locations` (`location_id`, `location_name`, `deleted`) VALUES
(8, 'stock', 0);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_suppliers`
--

CREATE TABLE IF NOT EXISTS `decameron_suppliers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decameron_tarjeta_credito`
--

CREATE TABLE IF NOT EXISTS `decameron_tarjeta_credito` (
`id_tarjeta_credito` int(11) NOT NULL,
  `numero_tarjeta` varbinary(36) NOT NULL,
  `mes_expiracion` char(2) NOT NULL,
  `anio_expiracion` char(4) NOT NULL,
  `codigo_seguridad` varbinary(6) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `person_id` int(11) NOT NULL,
  `id_franquicia` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_tarjeta_credito`
--

INSERT INTO `decameron_tarjeta_credito` (`id_tarjeta_credito`, `numero_tarjeta`, `mes_expiracion`, `anio_expiracion`, `codigo_seguridad`, `nombre`, `fecha_nacimiento`, `person_id`, `id_franquicia`) VALUES
(1, 0x373839343435363131323330, '03', '2019', 0x313233, 'Mario', '1987-09-16', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `decameron_tipo_documento`
--

CREATE TABLE IF NOT EXISTS `decameron_tipo_documento` (
`id_tipo_documento` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_tipo_documento`
--

INSERT INTO `decameron_tipo_documento` (`id_tipo_documento`, `nombre`) VALUES
(1, 'DUI'),
(2, 'ISSS'),
(3, 'LICENCIA DE MANEJO'),
(4, 'NIT'),
(5, 'PASAPORTE');

-- --------------------------------------------------------

--
-- Table structure for table `decameron_tipo_habitacion`
--

CREATE TABLE IF NOT EXISTS `decameron_tipo_habitacion` (
`id_tipo_habitacion` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decameron_tipo_habitacion`
--

INSERT INTO `decameron_tipo_habitacion` (`id_tipo_habitacion`, `nombre`, `descripcion`) VALUES
(1, 'Estándar', NULL),
(2, 'Superior', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `decameron_activo`
--
ALTER TABLE `decameron_activo`
 ADD PRIMARY KEY (`id_activo`);

--
-- Indexes for table `decameron_app_config`
--
ALTER TABLE `decameron_app_config`
 ADD PRIMARY KEY (`key`);

--
-- Indexes for table `decameron_costo_por_fecha`
--
ALTER TABLE `decameron_costo_por_fecha`
 ADD PRIMARY KEY (`id_rango_fechas`);

--
-- Indexes for table `decameron_costo_por_num_personas`
--
ALTER TABLE `decameron_costo_por_num_personas`
 ADD PRIMARY KEY (`key`,`id_tipo_habitacion`), ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`);

--
-- Indexes for table `decameron_customers`
--
ALTER TABLE `decameron_customers`
 ADD UNIQUE KEY `account_number` (`account_number`), ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `decameron_edificio`
--
ALTER TABLE `decameron_edificio`
 ADD PRIMARY KEY (`id_edificio`);

--
-- Indexes for table `decameron_employees`
--
ALTER TABLE `decameron_employees`
 ADD UNIQUE KEY `username` (`username`), ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `decameron_franquicia`
--
ALTER TABLE `decameron_franquicia`
 ADD PRIMARY KEY (`id_franquicia`);

--
-- Indexes for table `decameron_giftcards`
--
ALTER TABLE `decameron_giftcards`
 ADD PRIMARY KEY (`giftcard_id`), ADD UNIQUE KEY `giftcard_number` (`giftcard_number`);

--
-- Indexes for table `decameron_habitacion`
--
ALTER TABLE `decameron_habitacion`
 ADD PRIMARY KEY (`id_habitacion`), ADD KEY `id_edificio` (`id_edificio`), ADD KEY `id_habitacion_capacidad` (`id_habitacion_capacidad`);

--
-- Indexes for table `decameron_habitacion_activo`
--
ALTER TABLE `decameron_habitacion_activo`
 ADD PRIMARY KEY (`fecha_hora`,`id_activo`,`id_habitacion`), ADD KEY `id_activo` (`id_activo`), ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indexes for table `decameron_habitacion_capacidad`
--
ALTER TABLE `decameron_habitacion_capacidad`
 ADD PRIMARY KEY (`id_habitacion_capacidad`);

--
-- Indexes for table `decameron_habitacion_reservacion`
--
ALTER TABLE `decameron_habitacion_reservacion`
 ADD PRIMARY KEY (`fecha`,`id_habitacion`,`id_reservacion`);

--
-- Indexes for table `decameron_inventory`
--
ALTER TABLE `decameron_inventory`
 ADD PRIMARY KEY (`trans_id`), ADD KEY `trans_items` (`trans_items`), ADD KEY `trans_user` (`trans_user`), ADD KEY `trans_location` (`trans_location`);

--
-- Indexes for table `decameron_items`
--
ALTER TABLE `decameron_items`
 ADD PRIMARY KEY (`item_id`), ADD UNIQUE KEY `item_number` (`item_number`), ADD KEY `decameron_items_ibfk_1` (`supplier_id`);

--
-- Indexes for table `decameron_items_taxes`
--
ALTER TABLE `decameron_items_taxes`
 ADD PRIMARY KEY (`item_id`,`name`,`percent`);

--
-- Indexes for table `decameron_item_kits`
--
ALTER TABLE `decameron_item_kits`
 ADD PRIMARY KEY (`item_kit_id`);

--
-- Indexes for table `decameron_item_kit_items`
--
ALTER TABLE `decameron_item_kit_items`
 ADD PRIMARY KEY (`item_kit_id`,`item_id`,`quantity`), ADD KEY `decameron_item_kit_items_ibfk_2` (`item_id`);

--
-- Indexes for table `decameron_item_quantities`
--
ALTER TABLE `decameron_item_quantities`
 ADD PRIMARY KEY (`item_id`,`location_id`), ADD KEY `item_id` (`item_id`), ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `decameron_modules`
--
ALTER TABLE `decameron_modules`
 ADD PRIMARY KEY (`module_id`), ADD UNIQUE KEY `desc_lang_key` (`desc_lang_key`), ADD UNIQUE KEY `name_lang_key` (`name_lang_key`);

--
-- Indexes for table `decameron_numero_personas`
--
ALTER TABLE `decameron_numero_personas`
 ADD PRIMARY KEY (`id_numero_personas`);

--
-- Indexes for table `decameron_pasajero`
--
ALTER TABLE `decameron_pasajero`
 ADD PRIMARY KEY (`id_pasajero`), ADD KEY `person_id` (`person_id`), ADD KEY `id_tipo_documento` (`id_tipo_documento`);

--
-- Indexes for table `decameron_people`
--
ALTER TABLE `decameron_people`
 ADD PRIMARY KEY (`person_id`), ADD KEY `id_tipo_documento` (`id_tipo_documento`);

--
-- Indexes for table `decameron_permissions`
--
ALTER TABLE `decameron_permissions`
 ADD PRIMARY KEY (`module_id`,`person_id`), ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `decameron_producto_reservacion`
--
ALTER TABLE `decameron_producto_reservacion`
 ADD PRIMARY KEY (`id_reservacion`,`item_id`), ADD KEY `id_reservacion` (`id_reservacion`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `decameron_receivings`
--
ALTER TABLE `decameron_receivings`
 ADD PRIMARY KEY (`receiving_id`), ADD KEY `supplier_id` (`supplier_id`), ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `decameron_receivings_items`
--
ALTER TABLE `decameron_receivings_items`
 ADD PRIMARY KEY (`receiving_id`,`item_id`,`line`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `decameron_reservacion`
--
ALTER TABLE `decameron_reservacion`
 ADD PRIMARY KEY (`id_reservacion`), ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`), ADD KEY `id_tarjeta_credito` (`id_tarjeta_credito`), ADD KEY `id_numero_personas` (`id_numero_personas`);

--
-- Indexes for table `decameron_reservacion_detalle`
--
ALTER TABLE `decameron_reservacion_detalle`
 ADD KEY `id_reservacion` (`id_reservacion`);

--
-- Indexes for table `decameron_sales`
--
ALTER TABLE `decameron_sales`
 ADD PRIMARY KEY (`sale_id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `decameron_sales_items`
--
ALTER TABLE `decameron_sales_items`
 ADD PRIMARY KEY (`sale_id`,`item_id`,`line`), ADD KEY `sale_id` (`sale_id`), ADD KEY `item_id` (`item_id`), ADD KEY `item_location` (`item_location`);

--
-- Indexes for table `decameron_sales_items_taxes`
--
ALTER TABLE `decameron_sales_items_taxes`
 ADD PRIMARY KEY (`sale_id`,`item_id`,`line`,`name`,`percent`), ADD KEY `sale_id` (`sale_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `decameron_sales_payments`
--
ALTER TABLE `decameron_sales_payments`
 ADD PRIMARY KEY (`sale_id`,`payment_type`), ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `decameron_sales_suspended`
--
ALTER TABLE `decameron_sales_suspended`
 ADD PRIMARY KEY (`sale_id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `decameron_sales_suspended_items`
--
ALTER TABLE `decameron_sales_suspended_items`
 ADD PRIMARY KEY (`sale_id`,`item_id`,`line`), ADD KEY `sale_id` (`sale_id`), ADD KEY `item_id` (`item_id`), ADD KEY `decameron_sales_suspended_items_ibfk_3` (`item_location`);

--
-- Indexes for table `decameron_sales_suspended_items_taxes`
--
ALTER TABLE `decameron_sales_suspended_items_taxes`
 ADD PRIMARY KEY (`sale_id`,`item_id`,`line`,`name`,`percent`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `decameron_sales_suspended_payments`
--
ALTER TABLE `decameron_sales_suspended_payments`
 ADD PRIMARY KEY (`sale_id`,`payment_type`);

--
-- Indexes for table `decameron_sessions`
--
ALTER TABLE `decameron_sessions`
 ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `decameron_stock_locations`
--
ALTER TABLE `decameron_stock_locations`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `decameron_suppliers`
--
ALTER TABLE `decameron_suppliers`
 ADD UNIQUE KEY `account_number` (`account_number`), ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `decameron_tarjeta_credito`
--
ALTER TABLE `decameron_tarjeta_credito`
 ADD PRIMARY KEY (`id_tarjeta_credito`), ADD KEY `person_id` (`person_id`), ADD KEY `id_franquicia` (`id_franquicia`);

--
-- Indexes for table `decameron_tipo_documento`
--
ALTER TABLE `decameron_tipo_documento`
 ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indexes for table `decameron_tipo_habitacion`
--
ALTER TABLE `decameron_tipo_habitacion`
 ADD PRIMARY KEY (`id_tipo_habitacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `decameron_activo`
--
ALTER TABLE `decameron_activo`
MODIFY `id_activo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_costo_por_fecha`
--
ALTER TABLE `decameron_costo_por_fecha`
MODIFY `id_rango_fechas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `decameron_edificio`
--
ALTER TABLE `decameron_edificio`
MODIFY `id_edificio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `decameron_franquicia`
--
ALTER TABLE `decameron_franquicia`
MODIFY `id_franquicia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `decameron_giftcards`
--
ALTER TABLE `decameron_giftcards`
MODIFY `giftcard_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_habitacion`
--
ALTER TABLE `decameron_habitacion`
MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `decameron_habitacion_capacidad`
--
ALTER TABLE `decameron_habitacion_capacidad`
MODIFY `id_habitacion_capacidad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `decameron_inventory`
--
ALTER TABLE `decameron_inventory`
MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_items`
--
ALTER TABLE `decameron_items`
MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_item_kits`
--
ALTER TABLE `decameron_item_kits`
MODIFY `item_kit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_numero_personas`
--
ALTER TABLE `decameron_numero_personas`
MODIFY `id_numero_personas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `decameron_pasajero`
--
ALTER TABLE `decameron_pasajero`
MODIFY `id_pasajero` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_people`
--
ALTER TABLE `decameron_people`
MODIFY `person_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `decameron_receivings`
--
ALTER TABLE `decameron_receivings`
MODIFY `receiving_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_reservacion`
--
ALTER TABLE `decameron_reservacion`
MODIFY `id_reservacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `decameron_sales`
--
ALTER TABLE `decameron_sales`
MODIFY `sale_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_sales_suspended`
--
ALTER TABLE `decameron_sales_suspended`
MODIFY `sale_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decameron_stock_locations`
--
ALTER TABLE `decameron_stock_locations`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `decameron_tarjeta_credito`
--
ALTER TABLE `decameron_tarjeta_credito`
MODIFY `id_tarjeta_credito` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `decameron_tipo_documento`
--
ALTER TABLE `decameron_tipo_documento`
MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `decameron_tipo_habitacion`
--
ALTER TABLE `decameron_tipo_habitacion`
MODIFY `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `decameron_costo_por_num_personas`
--
ALTER TABLE `decameron_costo_por_num_personas`
ADD CONSTRAINT `decameron_costo_por_num_personas_ibfk_1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `decameron_tipo_habitacion` (`id_tipo_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_customers`
--
ALTER TABLE `decameron_customers`
ADD CONSTRAINT `decameron_customers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `decameron_people` (`person_id`);

--
-- Constraints for table `decameron_employees`
--
ALTER TABLE `decameron_employees`
ADD CONSTRAINT `decameron_employees_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `decameron_people` (`person_id`);

--
-- Constraints for table `decameron_habitacion`
--
ALTER TABLE `decameron_habitacion`
ADD CONSTRAINT `decameron_habitacion_ibfk_1` FOREIGN KEY (`id_edificio`) REFERENCES `decameron_edificio` (`id_edificio`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `decameron_habitacion_ibfk_2` FOREIGN KEY (`id_habitacion_capacidad`) REFERENCES `decameron_habitacion_capacidad` (`id_habitacion_capacidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_habitacion_activo`
--
ALTER TABLE `decameron_habitacion_activo`
ADD CONSTRAINT `decameron_habitacion_activo_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `decameron_activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `decameron_habitacion_activo_ibfk_2` FOREIGN KEY (`id_habitacion`) REFERENCES `decameron_habitacion` (`id_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_inventory`
--
ALTER TABLE `decameron_inventory`
ADD CONSTRAINT `decameron_inventory_ibfk_1` FOREIGN KEY (`trans_items`) REFERENCES `decameron_items` (`item_id`),
ADD CONSTRAINT `decameron_inventory_ibfk_2` FOREIGN KEY (`trans_user`) REFERENCES `decameron_employees` (`person_id`);

--
-- Constraints for table `decameron_items`
--
ALTER TABLE `decameron_items`
ADD CONSTRAINT `decameron_items_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `decameron_suppliers` (`person_id`);

--
-- Constraints for table `decameron_items_taxes`
--
ALTER TABLE `decameron_items_taxes`
ADD CONSTRAINT `decameron_items_taxes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `decameron_item_kit_items`
--
ALTER TABLE `decameron_item_kit_items`
ADD CONSTRAINT `decameron_item_kit_items_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `decameron_item_kits` (`item_kit_id`) ON DELETE CASCADE,
ADD CONSTRAINT `decameron_item_kit_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `decameron_item_quantities`
--
ALTER TABLE `decameron_item_quantities`
ADD CONSTRAINT `decameron_item_quantities_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`),
ADD CONSTRAINT `decameron_item_quantities_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `decameron_stock_locations` (`location_id`);

--
-- Constraints for table `decameron_pasajero`
--
ALTER TABLE `decameron_pasajero`
ADD CONSTRAINT `decameron_pasajero_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `decameron_people` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `decameron_pasajero_ibfk_2` FOREIGN KEY (`id_tipo_documento`) REFERENCES `decameron_tipo_documento` (`id_tipo_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_people`
--
ALTER TABLE `decameron_people`
ADD CONSTRAINT `decameron_people_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `decameron_tipo_documento` (`id_tipo_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_permissions`
--
ALTER TABLE `decameron_permissions`
ADD CONSTRAINT `decameron_permissions_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `decameron_employees` (`person_id`),
ADD CONSTRAINT `decameron_permissions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `decameron_modules` (`module_id`);

--
-- Constraints for table `decameron_producto_reservacion`
--
ALTER TABLE `decameron_producto_reservacion`
ADD CONSTRAINT `decameron_producto_reservacion_ibfk_1` FOREIGN KEY (`id_reservacion`) REFERENCES `decameron_reservacion` (`id_reservacion`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `decameron_producto_reservacion_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_receivings`
--
ALTER TABLE `decameron_receivings`
ADD CONSTRAINT `decameron_receivings_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `decameron_employees` (`person_id`),
ADD CONSTRAINT `decameron_receivings_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `decameron_suppliers` (`person_id`);

--
-- Constraints for table `decameron_receivings_items`
--
ALTER TABLE `decameron_receivings_items`
ADD CONSTRAINT `decameron_receivings_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`),
ADD CONSTRAINT `decameron_receivings_items_ibfk_2` FOREIGN KEY (`receiving_id`) REFERENCES `decameron_receivings` (`receiving_id`);

--
-- Constraints for table `decameron_reservacion`
--
ALTER TABLE `decameron_reservacion`
ADD CONSTRAINT `decameron_reservacion_ibfk_1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `decameron_tipo_habitacion` (`id_tipo_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `decameron_reservacion_ibfk_2` FOREIGN KEY (`id_tarjeta_credito`) REFERENCES `decameron_tarjeta_credito` (`id_tarjeta_credito`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `decameron_reservacion_ibfk_3` FOREIGN KEY (`id_numero_personas`) REFERENCES `decameron_numero_personas` (`id_numero_personas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_reservacion_detalle`
--
ALTER TABLE `decameron_reservacion_detalle`
ADD CONSTRAINT `decameron_reservacion_detalle_ibfk_1` FOREIGN KEY (`id_reservacion`) REFERENCES `decameron_reservacion` (`id_reservacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decameron_sales`
--
ALTER TABLE `decameron_sales`
ADD CONSTRAINT `decameron_sales_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `decameron_employees` (`person_id`),
ADD CONSTRAINT `decameron_sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `decameron_customers` (`person_id`);

--
-- Constraints for table `decameron_sales_items`
--
ALTER TABLE `decameron_sales_items`
ADD CONSTRAINT `decameron_sales_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`),
ADD CONSTRAINT `decameron_sales_items_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `decameron_sales` (`sale_id`),
ADD CONSTRAINT `decameron_sales_items_ibfk_3` FOREIGN KEY (`item_location`) REFERENCES `decameron_stock_locations` (`location_id`);

--
-- Constraints for table `decameron_sales_items_taxes`
--
ALTER TABLE `decameron_sales_items_taxes`
ADD CONSTRAINT `decameron_sales_items_taxes_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `decameron_sales_items` (`sale_id`),
ADD CONSTRAINT `decameron_sales_items_taxes_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`);

--
-- Constraints for table `decameron_sales_payments`
--
ALTER TABLE `decameron_sales_payments`
ADD CONSTRAINT `decameron_sales_payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `decameron_sales` (`sale_id`);

--
-- Constraints for table `decameron_sales_suspended`
--
ALTER TABLE `decameron_sales_suspended`
ADD CONSTRAINT `decameron_sales_suspended_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `decameron_employees` (`person_id`),
ADD CONSTRAINT `decameron_sales_suspended_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `decameron_customers` (`person_id`);

--
-- Constraints for table `decameron_sales_suspended_items`
--
ALTER TABLE `decameron_sales_suspended_items`
ADD CONSTRAINT `decameron_sales_suspended_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`),
ADD CONSTRAINT `decameron_sales_suspended_items_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `decameron_sales_suspended` (`sale_id`),
ADD CONSTRAINT `decameron_sales_suspended_items_ibfk_3` FOREIGN KEY (`item_location`) REFERENCES `decameron_stock_locations` (`location_id`);

--
-- Constraints for table `decameron_sales_suspended_items_taxes`
--
ALTER TABLE `decameron_sales_suspended_items_taxes`
ADD CONSTRAINT `decameron_sales_suspended_items_taxes_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `decameron_sales_suspended_items` (`sale_id`),
ADD CONSTRAINT `decameron_sales_suspended_items_taxes_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `decameron_items` (`item_id`);

--
-- Constraints for table `decameron_sales_suspended_payments`
--
ALTER TABLE `decameron_sales_suspended_payments`
ADD CONSTRAINT `decameron_sales_suspended_payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `decameron_sales_suspended` (`sale_id`);

--
-- Constraints for table `decameron_suppliers`
--
ALTER TABLE `decameron_suppliers`
ADD CONSTRAINT `decameron_suppliers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `decameron_people` (`person_id`);

--
-- Constraints for table `decameron_tarjeta_credito`
--
ALTER TABLE `decameron_tarjeta_credito`
ADD CONSTRAINT `decameron_tarjeta_credito_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `decameron_people` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `decameron_tarjeta_credito_ibfk_2` FOREIGN KEY (`id_franquicia`) REFERENCES `decameron_franquicia` (`id_franquicia`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
