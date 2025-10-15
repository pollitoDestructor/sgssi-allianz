SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

USE database;

-- --------------------------------------------------------
-- Tabla de usuarios
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar usuarios de ejemplo
INSERT INTO usuarios (nombre, password) VALUES
('mikel', '$2y$10$examplehashedpassword1'),
('aitor', '$2y$10$examplehashedpassword2');

-- --------------------------------------------------------
-- Tabla de productos (tienda Labubus aunque puede ser de otra cosa tambien :))
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  precio DECIMAL(6,2),
  descripcion TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar productos de ejemplo
INSERT INTO productos (nombre, precio, descripcion) VALUES
('Camiseta Labubus Original', 19.99, 'Camiseta oficial con el logo de Labubus.'),
('Taza mágica de Labubus', 12.50, 'Cambia de color al verter líquido caliente.'),
('Pegatina holográfica Labubus', 3.00, 'Pegatina especial brillante con diseño exclusivo.');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
