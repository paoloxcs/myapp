-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2019 a las 23:49:04
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `casdel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(100) CHARACTER SET latin1 NOT NULL,
  `url_image` varchar(30) CHARACTER SET latin1 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `url_image`, `status`) VALUES
(2, 'Trygonal', 'trygonal', '5c93f1e37459c.jpg', 1),
(5, 'ExpoConstructivo', 'expoconstructivo', '5c93d0109a2de.jpg', 1),
(8, 'Marca de prueba 1', 'marca-de-prueba-1', '5c93f5711418a.jpg', 1),
(9, 'mas prueba', 'mas-prueba', '5c940833052e5.jpg', 0),
(11, 'Hallite', 'hallite', '5c940aaac2dfa.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogs`
--

CREATE TABLE `catalogs` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `url_image` varchar(40) NOT NULL,
  `ruta` varchar(40) NOT NULL,
  `edicion` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `url_image` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Almacena toda las categorías y las sub_categorías';

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `url_image`, `status`) VALUES
(1, 'Sellos', 'sellos', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam vero voluptates, laudantium labore optio dolorum, blanditiis aliquid unde reprehenderit modi aut voluptatem molestiae quis eos recusandae. Aliquid possimus aspernatur atque.\r\n\r\nthis is other pharagraph', '5c7eab1f6cff6.jpg', 1),
(3, 'Pistones', 'pistones', 'tewst', '5c7eab83e25a7.jpg', 1),
(5, 'Bandas guia', 'bandas-guia', 'Test description to bandas guia', '5c7eac7664584.jpg', 1),
(7, 'Rod seals', 'rod-seals', 'descripcion de la categoria.', '5c9271afea61a.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(15) CHARACTER SET latin1 NOT NULL,
  `address` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Llave foránea - usuarios',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Almacena clientes de la empresa, pero tienen acceso a la web';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `details_profiles_parts`
--

CREATE TABLE `details_profiles_parts` (
  `id` int(11) NOT NULL,
  `value_field` varchar(20) NOT NULL,
  `dimension_profile_id` int(11) NOT NULL,
  `profile_part_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `details_profiles_parts`
--

INSERT INTO `details_profiles_parts` (`id`, `value_field`, `dimension_profile_id`, `profile_part_id`) VALUES
(1, '16', 3, 1),
(2, '26', 2, 1),
(3, '8', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimensions`
--

CREATE TABLE `dimensions` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sigla` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dimensions`
--

INSERT INTO `dimensions` (`id`, `name`, `sigla`) VALUES
(1, 'Diámetro exterior 1', 'ØD1'),
(2, 'Diámetro exterior 2', 'ØD2'),
(3, 'Altura alojamiento principal', 'L1'),
(4, 'Altura alojamiento adicional', 'L2'),
(5, 'Diametro interior 1', 'Ød1'),
(6, 'Diametro interior 2', 'Ød2'),
(7, 'Diámetro exterior 3', 'ØD3'),
(8, 'Diámetro interior 3', 'Ød3'),
(9, 'Sección', 'S'),
(10, 'Tolerancias', 'h'),
(11, 'Altura física del sello (segunda altura)', 'WL'),
(12, 'Altura física del sello', 'SL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimensions_profiles`
--

CREATE TABLE `dimensions_profiles` (
  `id` int(11) NOT NULL,
  `dimension_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dimensions_profiles`
--

INSERT INTO `dimensions_profiles` (`id`, `dimension_id`, `profile_id`) VALUES
(1, 5, 1),
(2, 1, 1),
(3, 3, 1),
(4, 2, 8),
(5, 3, 8),
(6, 4, 8),
(7, 3, 9),
(8, 4, 9),
(9, 5, 9),
(10, 2, 10),
(13, 2, 12),
(14, 5, 12),
(15, 11, 12),
(16, 12, 12),
(17, 1, 13),
(18, 2, 13),
(19, 5, 13),
(20, 11, 13),
(21, 12, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fluid_groups`
--

CREATE TABLE `fluid_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fluid_groups`
--

INSERT INTO `fluid_groups` (`id`, `name`) VALUES
(1, 'Fluidos con base de aceite mineral'),
(2, 'Fluidos con base de agua'),
(3, 'Otros tipos de fluidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fluid_group_items`
--

CREATE TABLE `fluid_group_items` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `fluid_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fluid_group_items`
--

INSERT INTO `fluid_group_items` (`id`, `name`, `fluid_group_id`) VALUES
(1, 'Any', 1),
(2, 'HFA (5/95)', 2),
(3, 'HFB (60/40 invert emultion)', 2),
(4, 'HFC (water glycol)', 2),
(5, 'Water', 2),
(6, 'Air/Nitrogeno', 3),
(7, 'HFD (Phosphate ester ARYL type)', 3),
(8, 'Synthetic esters (HEES,HFDU)', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fluid_keys`
--

CREATE TABLE `fluid_keys` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sigla` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fluid_keys`
--

INSERT INTO `fluid_keys` (`id`, `name`, `sigla`) VALUES
(1, 'Recomendable', 'R'),
(2, 'Posible', 'P'),
(3, 'No adecuado', 'NA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `markets`
--

CREATE TABLE `markets` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(100) CHARACTER SET latin1 NOT NULL,
  `url_image` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Almacena mercados y relaciona a productos';

--
-- Volcado de datos para la tabla `markets`
--

INSERT INTO `markets` (`id`, `name`, `slug`, `url_image`) VALUES
(2, 'Minería', 'mineria', '5c6da9557ce75.jpg'),
(3, 'Agricultura', 'agricultura', '5c6db60546417.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `markets_profiles`
--

CREATE TABLE `markets_profiles` (
  `id` int(11) NOT NULL,
  `market_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `markets_profiles`
--

INSERT INTO `markets_profiles` (`id`, `market_id`, `profile_id`) VALUES
(1, 2, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisions`
--

CREATE TABLE `permisions` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Permite almacenar permisos del sistema';

--
-- Volcado de datos para la tabla `permisions`
--

INSERT INTO `permisions` (`id`, `name`, `slug`) VALUES
(1, 'Módulo Administrador', 'manage_admin'),
(2, 'Módulo Marcas', 'manage_brands'),
(3, 'Módulo Categorías', 'manage_categorys'),
(4, 'Módulo Mercados', 'manage_markets'),
(5, 'Módulo Productos', 'manage_products'),
(6, 'Módulo Noticias', 'manage_posts');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 NOT NULL,
  `summary` text CHARACTER SET latin1,
  `body` longtext CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `post_type` char(1) NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `summary`, `body`, `user_id`, `status`, `post_type`, `created_at`, `updated_at`) VALUES
(2, 'Empleo formal en la minería creció 10.9%', 'empleo-formal-en-la-mineria-crecio-109', 'El ministro de Energía y Minas, Francisco Ísmodes, adelantó que los referidos comités buscan atender las preocupaciones ambientales y asegurar el cumplimiento de los compromisos del Estado y empresa privada en las zonas mineras.', '<p>De acuerdo con el tipo de empleador, los puestos de trabajo generados por las compa&ntilde;&iacute;as (empresas mineras) constituyeron el <strong>33.5%</strong> del total.</p>\r\n\r\n<p><br />\r\nLos puestos de trabajo generados por las contratistas (empresas mineras y empresas conexas) representaron el 66.5% restante.<br />\r\n<br />\r\nPor otro lado, el MEM aprob&oacute;, mediante Resoluci&oacute;n Ministerial N&ordm; 354-2018-MEM/DM, la creaci&oacute;n de los comit&eacute;s de gesti&oacute;n e informaci&oacute;n minero-energ&eacute;tica como un mecanismo de coordinaci&oacute;n y articulaci&oacute;n de alcance regional, en relaci&oacute;n con el desarrollo sostenible de las actividades mineras y energ&eacute;ticas.<br />\r\n<br />\r\nEl ministro de Energ&iacute;a y Minas, Francisco &Iacute;smodes, adelant&oacute; que los referidos comit&eacute;s buscan atender las preocupaciones ambientales y asegurar el cumplimiento de los compromisos del Estado y empresa privada en las zonas mineras.&nbsp;<br />\r\n<br />\r\n&ldquo;La conformaci&oacute;n de estos comit&eacute;s permitir&aacute; al Gobierno nacional tener una coordinaci&oacute;n m&aacute;s estrecha con los gobiernos regionales en la gesti&oacute;n de los nuevos proyectos mineros y energ&eacute;ticos. Facultar&aacute;, adem&aacute;s, a informar de manera proactiva a la poblaci&oacute;n sobre los alcances de las actividades que se desarrollan y velar por el cumplimiento de los compromisos y las buenas pr&aacute;cticas medioambientales&rdquo;, expres&oacute;.<br />\r\n<br />\r\n<strong>&nbsp;Fuente:</strong>&nbsp;El Peruano</p>', 1, 1, 'N', '2019-02-21 20:44:44', '2019-02-21 20:44:44'),
(3, 'Se promueven nuevas alternativas de energía para el sector industrial', 'se-promueven-nuevas-alternativas-de-energia-para-el-sector-industrial', 'Se promueven nuevas alternativas de energía para el sector industrial', '<p>En el 2013 se estableci&oacute; que el 5 % de la energ&iacute;a total del pa&iacute;s sea solar o e&oacute;lica; sin embargo, esta meta no logr&oacute; cumplirse. Es por ello que se viene haciendo un esfuerzo para conseguir que estas alternativas de generaci&oacute;n de energ&iacute;a no renovable o poco convencionales se implementen -de preferencia- en las regiones del norte del Per&uacute; como son &Aacute;ncash, La Libertad, Lambayeque, Piura y Tumbes.</p>\r\n\r\n<p>El especialista en soluciones de electrificaci&oacute;n,&nbsp;Yarco Calder&oacute;n, detalla las posibilidades de la implementaci&oacute;n de energ&iacute;a e&oacute;lica, especialmente en las zonas cercanas al litoral.</p>\r\n\r\n<p>&ldquo;En Lambayeque un proyecto e&oacute;lico ser&iacute;a muy interesante porque la velocidad del viento es de 5 a 6 por metros por segundo. Es interesante para un parque e&oacute;lico y poder interconectarlo a la red. El proyecto e&oacute;lico viene desde la regi&oacute;n La Libertad&rdquo;, refiri&oacute;.</p>\r\n\r\n<p>Asimismo indic&oacute; que en los departamentos de Piura y Tumbes&nbsp;Piura&nbsp;y&nbsp;Tumbes&nbsp;se tiene el potencial clim&aacute;tico para implementar como energ&iacute;a renovables las generadoras solares. Esto beneficiar&aacute; en el potencial del sector industrial y reforzar&aacute; su crecimiento y recuperaci&oacute;n tras un periodo de crisis.</p>\r\n\r\n<p>Yarco Calder&oacute;n&nbsp;sostuvo que la finalidad es minimizar la generaci&oacute;n de energ&iacute;a a trav&eacute;s de hidrocarburos; y promover los parques de energ&iacute;a e&oacute;lica similares al que se ubica en Talara (Piura) o centrales con planta solares.</p>\r\n\r\n<p>&ldquo;Hay varios proyecto del Estado, el&nbsp;parque e&oacute;lico&nbsp;que se tiene planeado en&nbsp;Lambayeque, eso est&aacute; como proyecto todav&iacute;a. El parque e&oacute;lico de Paij&aacute;n, en La Libertad y hay otros proyectos para crecer en generaci&oacute;n de energ&iacute;a&rdquo;, manifest&oacute;.</p>\r\n\r\n<p>El especialista tambi&eacute;n refiri&oacute; que estas nuevas alternativas permitir&aacute;n alimentar a las&nbsp;centrales hidroel&eacute;ctricas&nbsp;y reducir la brecha del servicio a las familias, teniendo como estad&iacute;sticas que&nbsp;3 a 4 millones de peruanos carecen de electricidad en sus hogares.</p>\r\n\r\n<p><strong>Fuente: La Rep&uacute;blica</strong></p>', 2, 1, 'N', '2019-02-21 21:20:56', '2019-02-21 21:20:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `url_image` varchar(45) CHARACTER SET latin1 NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `post_images`
--

INSERT INTO `post_images` (`id`, `url_image`, `is_main`, `post_id`) VALUES
(2, '5c6f0dbc4e3fe.jpg', 1, 2),
(3, '5c6f1638d316b.jpg', 1, 3),
(4, '5d48ae2dee3b60.jpg', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `summary` text NOT NULL,
  `body` text NOT NULL,
  `url_image` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `type`, `slug`, `summary`, `body`, `url_image`, `status`, `created_by`, `category_id`, `created_at`, `updated_at`) VALUES
(1, '15', '15', 'Esto es una prueba', 'Esto es una prueba para el perfil', '5c940aaac2dfa.jpg', 1, 1, 1, '2019-08-01 05:00:00', '2019-08-01 05:00:00'),
(2, '720', '720', 'test test', 'test completo', '5c7ed7f0a63f3.jpg', 1, 2, 1, '2019-08-01 05:00:00', '2019-08-01 05:00:00'),
(8, '23', '23-5d48ab84b08a9', 'tewst', '<p>dsfdsfds</p>', '5d48ab84b0310.png', 0, 1, 7, '2019-08-05 22:19:48', '2019-08-05 22:19:48'),
(9, '23', '23-5d83e0eaa874c', 'fxcvdxvdsgv', '<p>cxvxcvdxcvfdxcv</p>', '5d83e0eaa7e2e.jpg', 0, 1, 5, '2019-09-19 20:11:22', '2019-09-19 20:11:22'),
(10, '45', '45-5d8404997ddf1', 'ttrhtrh', '<p>trhthrh</p>', '5d8404997d4f0.jpg', 0, 1, 7, '2019-09-19 22:43:37', '2019-09-19 22:43:37'),
(12, '65', '65-5d84d936c4913', 'cbcbvcxb', '<p>sdgfdsfdsf</p>', '5d84d936c4096.jpg', 0, 1, 3, '2019-09-20 13:50:46', '2019-09-20 13:50:46'),
(13, '23', '23-5d84d963e7eb2', 'dgvdzxvdxvd', '<p>dsfdsfdsfds</p>', '5d84d963e77e3.jpg', 0, 1, 5, '2019-09-20 13:51:31', '2019-09-20 13:51:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles_parts`
--

CREATE TABLE `profiles_parts` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `part_nro` varchar(45) NOT NULL,
  `url_pdf` varchar(45) DEFAULT NULL,
  `unit_measurement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profiles_parts`
--

INSERT INTO `profiles_parts` (`id`, `profile_id`, `part_nro`, `url_pdf`, `unit_measurement_id`) VALUES
(1, 1, '0754300', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile_fluid_compatibilities`
--

CREATE TABLE `profile_fluid_compatibilities` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `type_application_id` int(11) NOT NULL,
  `fluid_group_item_id` int(11) NOT NULL,
  `fluid_key_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profile_fluid_compatibilities`
--

INSERT INTO `profile_fluid_compatibilities` (`id`, `profile_id`, `type_application_id`, `fluid_group_item_id`, `fluid_key_id`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 1),
(3, 1, 1, 2, 2),
(4, 1, 2, 2, 1),
(5, 1, 1, 3, 1),
(6, 1, 2, 3, 1),
(7, 1, 1, 4, 1),
(8, 1, 2, 4, 1),
(9, 1, 1, 5, 2),
(10, 1, 2, 5, 1),
(11, 1, 1, 6, 2),
(12, 1, 2, 6, 2),
(13, 1, 1, 7, 3),
(14, 1, 2, 7, 3),
(15, 1, 1, 8, 2),
(16, 1, 2, 8, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET latin1 NOT NULL,
  `section` varchar(45) CHARACTER SET latin1 NOT NULL COMMENT 'agrupa roles'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Permite almacenar roles de usuarios';

--
-- Volcado de datos para la tabla `rules`
--

INSERT INTO `rules` (`id`, `name`, `section`) VALUES
(1, 'Administrador', 'panel'),
(2, 'Invitado', 'web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rules_permisions`
--

CREATE TABLE `rules_permisions` (
  `id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  `permision_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Permite almacenar la relacion entre roles y permisos ';

--
-- Volcado de datos para la tabla `rules_permisions`
--

INSERT INTO `rules_permisions` (`id`, `rule_id`, `permision_id`) VALUES
(1, 1, 1),
(5, 1, 2),
(6, 1, 3),
(7, 1, 4),
(8, 1, 5),
(9, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `maps_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_applications`
--

CREATE TABLE `type_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `type_applications`
--

INSERT INTO `type_applications` (`id`, `name`) VALUES
(1, 'Aplicación Dinámica'),
(2, 'Aplicación Estática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unit_measurements`
--

CREATE TABLE `unit_measurements` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unit_measurements`
--

INSERT INTO `unit_measurements` (`id`, `name`, `enabled`, `profile_id`) VALUES
(1, 'INCH', 1, 1),
(2, 'METRIC', 0, 1),
(3, 'METRIC', 1, 10),
(6, 'METRIC', 1, 12),
(7, 'INCH', 0, 12),
(8, 'METRIC', 1, 13),
(9, 'INCH', 1, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombres del usuario',
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Apellidos del usuario',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rule_id` int(11) NOT NULL COMMENT 'Llave foránea - roles',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Permite almacenar todos los usuario del sistema';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `rule_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gabriel', 'Callaca', 'postmaster3@constructivo.com', '$2y$10$5MTxHXHHQLnhogwO9VQP0OlDQDYKXuKZ.KKg.ISQEqbSjJAP7oJ7i', 1, 'uoBOYmInHdG3XUOFODN3Mya7b8mIBJnhH7fBrAms0cKD02HGcRA0XOQG4GDJ', '2019-01-15 21:06:58', '2019-01-15 21:06:58'),
(2, 'Paolo', 'Carranza Servat', 'postmaster@constructivo.com', '$2y$10$V24HyIf2XH87aTqq2bt/YOgOA9f2jaqy9xoz4Z9MbAkoph2jhT.j2', 2, 'ZwnjWjKm4jVx7VvwM8X8IH5XyqvOAAkEtrzLUpwtsz7PR8y6kbOYNWCb6Kn2', '2019-02-21 21:16:28', '2019-02-21 21:16:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `embed` varchar(15) NOT NULL,
  `url_image` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `details_profiles_parts`
--
ALTER TABLE `details_profiles_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dimension_profile_id` (`dimension_profile_id`),
  ADD KEY `profile_part_id` (`profile_part_id`);

--
-- Indices de la tabla `dimensions`
--
ALTER TABLE `dimensions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dimensions_profiles`
--
ALTER TABLE `dimensions_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dimension_id` (`dimension_id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indices de la tabla `fluid_groups`
--
ALTER TABLE `fluid_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fluid_group_items`
--
ALTER TABLE `fluid_group_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fluid_group_id` (`fluid_group_id`);

--
-- Indices de la tabla `fluid_keys`
--
ALTER TABLE `fluid_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `markets_profiles`
--
ALTER TABLE `markets_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `market_id` (`market_id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permisions`
--
ALTER TABLE `permisions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indices de la tabla `profiles_parts`
--
ALTER TABLE `profiles_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `unit_measurement_id` (`unit_measurement_id`);

--
-- Indices de la tabla `profile_fluid_compatibilities`
--
ALTER TABLE `profile_fluid_compatibilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `fluid_key_id` (`fluid_key_id`),
  ADD KEY `fluid_group_item_id` (`fluid_group_item_id`),
  ADD KEY `type_application_id` (`type_application_id`);

--
-- Indices de la tabla `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rules_permisions`
--
ALTER TABLE `rules_permisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rule_id` (`rule_id`),
  ADD KEY `permision_id` (`permision_id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_applications`
--
ALTER TABLE `type_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unit_measurements`
--
ALTER TABLE `unit_measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `rule_id` (`rule_id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `details_profiles_parts`
--
ALTER TABLE `details_profiles_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `dimensions`
--
ALTER TABLE `dimensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `dimensions_profiles`
--
ALTER TABLE `dimensions_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `fluid_groups`
--
ALTER TABLE `fluid_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `fluid_group_items`
--
ALTER TABLE `fluid_group_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `fluid_keys`
--
ALTER TABLE `fluid_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `markets`
--
ALTER TABLE `markets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `markets_profiles`
--
ALTER TABLE `markets_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `permisions`
--
ALTER TABLE `permisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `profiles_parts`
--
ALTER TABLE `profiles_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `profile_fluid_compatibilities`
--
ALTER TABLE `profile_fluid_compatibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rules_permisions`
--
ALTER TABLE `rules_permisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `type_applications`
--
ALTER TABLE `type_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `unit_measurements`
--
ALTER TABLE `unit_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catalogs`
--
ALTER TABLE `catalogs`
  ADD CONSTRAINT `catalogs_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `details_profiles_parts`
--
ALTER TABLE `details_profiles_parts`
  ADD CONSTRAINT `details_profiles_parts_ibfk_1` FOREIGN KEY (`dimension_profile_id`) REFERENCES `dimensions_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `details_profiles_parts_ibfk_2` FOREIGN KEY (`profile_part_id`) REFERENCES `profiles_parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimensions_profiles`
--
ALTER TABLE `dimensions_profiles`
  ADD CONSTRAINT `dimensions_profiles_ibfk_1` FOREIGN KEY (`dimension_id`) REFERENCES `dimensions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dimensions_profiles_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fluid_group_items`
--
ALTER TABLE `fluid_group_items`
  ADD CONSTRAINT `fluid_group_items_ibfk_1` FOREIGN KEY (`fluid_group_id`) REFERENCES `fluid_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `markets_profiles`
--
ALTER TABLE `markets_profiles`
  ADD CONSTRAINT `markets_profiles_ibfk_1` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `markets_profiles_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profiles_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profiles_parts`
--
ALTER TABLE `profiles_parts`
  ADD CONSTRAINT `profiles_parts_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profiles_parts_ibfk_2` FOREIGN KEY (`unit_measurement_id`) REFERENCES `unit_measurements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profile_fluid_compatibilities`
--
ALTER TABLE `profile_fluid_compatibilities`
  ADD CONSTRAINT `profile_fluid_compatibilities_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_fluid_compatibilities_ibfk_4` FOREIGN KEY (`fluid_key_id`) REFERENCES `fluid_keys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_fluid_compatibilities_ibfk_5` FOREIGN KEY (`fluid_group_item_id`) REFERENCES `fluid_group_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_fluid_compatibilities_ibfk_6` FOREIGN KEY (`type_application_id`) REFERENCES `type_applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rules_permisions`
--
ALTER TABLE `rules_permisions`
  ADD CONSTRAINT `rules_permisions_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rules_permisions_ibfk_2` FOREIGN KEY (`permision_id`) REFERENCES `permisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `unit_measurements`
--
ALTER TABLE `unit_measurements`
  ADD CONSTRAINT `unit_measurements_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
