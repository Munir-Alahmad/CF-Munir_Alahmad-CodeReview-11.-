-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 06:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_muniralahmad_petadoption`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `age` int(3) NOT NULL,
  `sexuality` enum('male','female') NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `hobbies` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `picture`, `description`, `type`, `age`, `sexuality`, `location`, `hobbies`) VALUES
(10, 'Troy3', '61f171210f6d1.jpg', 'Lorem ipsum dolor sit amet consectetur.', 'cat', 4, 'male', 'landstrasse 253/26, 1280 Wien', 'dfghjgfhhf nd'),
(11, 'Togo', '61f174786ac74.jpg', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore rerum commodi et voluptatibus molestias animi sunt assumenda provident adipisci. Voluptas eum quia cum deserunt esse sed amet aperia', 'Dog', 6, 'male', 'landstrasse 285/95, 1260 Wien', 'dfghj'),
(15, 'Nyx', '61f1ccb90b31e.jpg', 'Lorem ipsum dolor sit amet consectetur.', 'Dog', 3, 'male', 'landstrasse 285/95, 1260 Wien', 'dfghj'),
(17, 'dog', '61f28d8894520.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'Dog', 10, 'male', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(18, 'catti', '61f28dc05f3d5.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'cat', 4, 'female', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(20, 'Lowa', '61f2ee9b26b4b.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'cat', 3, 'female', 'landstrasse 285/95, 1260 Wien', 'dfghjgfhhf nd'),
(21, 'Bella', '61f2f233a2fee.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'cat', 9, 'female', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(22, 'Royce', '61f2f265331e3.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'Dog', 11, 'male', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(23, 'Daisy', '61f2fe5e4032e.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'cat', 11, 'female', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(24, 'Lolie', NULL, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut, aliquid. Inventore alias sint, fugit a, enim cumque quas consequatur recusandae, voluptate exercitationem laborum at totam? Corporis volu', 'cat', 9, 'male', 'praterstrasse,299/125, wien', 'ccvsvbe'),
(25, 'test', '61f456f32198a.jpeg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'Rabbit', 9, 'male', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(27, 'Parroti', '61f593dfac6c3.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'parrot', 2, 'female', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(28, 'Rodi', '61f5a1059f3e6.jpeg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'Rabbit', 3, 'male', 'landstrasse 253/26, 1250 Wien', 'dfghj'),
(29, 'kati', '61f5b8b92703a.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'cat', 5, 'female', 'landstrasse 253/26, 1250 Wien', 'dfghj');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `userpic` varchar(255) DEFAULT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `userpic`, `status`) VALUES
(4, 'rami', 'anas', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1989-06-05', 'rami@mail.com', '61f69d2286060.png', 'adm'),
(5, 'majedd', 'hamdow', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1998-12-26', 'majed@mail.com', '61f5a35d78edb.png', 'user'),
(6, 'munir', 'ahmad', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1995-12-25', 'munir@mail.com', '61f3235d7f508.png', 'chef'),
(10, 'maher', 'musa', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1995-06-09', 'maher@mail.com', '61f5b0ff29114.png', 'user'),
(11, 'ghiath', 'serri', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1990-11-11', 'serri@mail.com', 'avatar.png', 'chef'),
(12, 'tarek', 'ahmad', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1995-06-05', 'tarek@mail.com', 'avatar.png', 'user'),
(13, 'Petra', 'zulus', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1995-08-05', 'petra@mail.com', '61f5b059792ad.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
