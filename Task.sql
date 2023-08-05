-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 05, 2023 at 06:30 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskDatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`id`, `title`, `description`, `status`) VALUES
(1, 'Crear el repositorio de GITHUB', 'Crear el repositorio de GitHub para alojar el front y el back de la prueba.', 'done'),
(2, 'Crear el front en NextJS', 'Crear el proyecto del front con el framework Next de JS.\r\nCrear todos los componentes necesarios.', 'done'),
(3, 'Descargar MAMP', 'Descargar MAMP para levantar el servidor de apache y la base de datos MySQL.', 'done'),
(4, 'Levantar base de datos MySQL', 'Levantar y crear la base de datos MySQL desde el servidor apache y administrarla desde phpMyAdmin.\r\n', 'done'),
(5, 'Crear la conexión a la base de datos', 'Crear en PHP la conexión a la base de datos mediante el fichero database.php', 'done'),
(6, 'Crear los controladores para el CRUD', 'Crear los controladores para los métodos GET, POST, UPDATE y DELETE y conectarlos con la base de datos.', 'done'),
(7, 'Crear las conexiones con la API', 'Realizar en el front las conexiones con la API. 3', 'done'),
(8, 'Aplicar estilos', 'Aplicar estilos CSS en el front y crear una interfaz amigable.', 'done'),
(9, 'Ajustar el CSS', 'Retocar colores y probar el CRUD ', 'done'),
(46, 'Implementar registro y autenticación de usuarios', 'Crear un sistema de registro y autenticación de usuarios para que cada usuario pueda tener su lista de tareas personalizada.', 'pending'),
(47, 'Agregar un input de búsqueda', 'Añadir un input de búsqueda de tareas que filtre en las dos listas.', 'done');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
