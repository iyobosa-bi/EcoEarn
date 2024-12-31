-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 05:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wma`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_username` varchar(45) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_username`, `admin_password`, `last_login`) VALUES
(1, 'theadmin@ecoearn.com', 'theadmin', '$2y$10$.a636J0BH3owBmCTB3qT9OIWqwy29Bc2RZJNRXNywhHb1pWXHpwRW', '2024-11-30 13:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agent_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `active_status` enum('active','restricted','','') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agent_id`, `first_name`, `email_address`, `phone`, `password`, `last_name`, `created_date`, `active_status`) VALUES
(1, 'Collector Plastics', 'collectorp@g.co', '23456789', 'cp1234', '', '2024-12-28 08:11:30', 'active'),
(4, 'XYZ Ltd', 'xyz@gmail.com', '0904567897', '$2y$10$hBdQVLZ8A.DkZPf7Vu1or.fwga6Ujx.Eo/XxxiFQXpZ708Og67VO2', '', '2024-12-28 08:11:31', 'active'),
(5, 'ABC ltd ABC Ltd', 'abcltd@gmail.com', '09029293842', '$2y$10$32xhene3lA4ttXX/gUgO0u4lCcQIiBurUEoluFulF.b6W/Gr.3jnu', '', '2024-12-29 11:05:16', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `collected_waste`
--

CREATE TABLE `collected_waste` (
  `collected_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `collection_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('no','yes','','') NOT NULL DEFAULT 'no',
  `agent_id` int(11) NOT NULL COMMENT '\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collected_waste`
--

INSERT INTO `collected_waste` (`collected_id`, `report_id`, `collection_date`, `status`, `agent_id`) VALUES
(1, 13, '2024-12-28 08:25:00', 'yes', 4),
(2, 4, '2024-12-29 07:19:00', 'yes', 4),
(3, 2, '2024-12-31 09:18:00', 'yes', 4),
(4, 17, '2024-12-31 08:51:00', 'yes', 4),
(5, 18, NULL, 'no', 4),
(7, 3, NULL, 'no', 4),
(8, 49, '2024-12-29 01:52:00', 'yes', 4),
(9, 47, NULL, 'no', 4),
(10, 50, '2024-12-29 12:31:00', 'yes', 5),
(11, 48, NULL, 'no', 5),
(12, 51, NULL, 'no', 4);

-- --------------------------------------------------------

--
-- Table structure for table `lga`
--

CREATE TABLE `lga` (
  `lga_id` int(11) NOT NULL,
  `lga_name` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lga`
--

INSERT INTO `lga` (`lga_id`, `lga_name`, `state_id`) VALUES
(1, 'Aba North', 1),
(2, 'Aba South', 1),
(3, 'Arochukwu', 1),
(4, 'Bende', 1),
(5, 'Ikwuano', 1),
(6, 'Isiala-Ngwa North', 1),
(7, 'Isiala-Ngwa South', 1),
(8, 'Isikwuato', 1),
(9, 'Nneochi', 1),
(10, 'Obi-Ngwa', 1),
(11, 'Ohafia', 1),
(12, 'Osisioma', 1),
(13, 'Ugwunagbo', 1),
(14, 'Ukwa East', 1),
(15, 'Ukwa West', 1),
(16, 'Umuahia North', 1),
(17, 'Umuahia South', 1),
(18, 'Demsa', 2),
(19, 'Fufore', 2),
(20, 'Genye', 2),
(21, 'Girei', 2),
(22, 'Gombi', 2),
(23, 'guyuk', 2),
(24, 'Hong', 2),
(25, 'Jada', 2),
(26, 'Jimeta', 2),
(27, 'Lamurde', 2),
(28, 'Madagali', 2),
(29, 'Maiha', 2),
(30, 'Mayo Belwa', 2),
(31, 'Michika', 2),
(32, 'Mubi North', 2),
(33, 'Mubi South', 2),
(34, 'Numan', 2),
(35, 'Shelleng', 2),
(36, 'Song', 2),
(37, 'Toungo', 2),
(38, 'Yola', 2),
(39, 'Abak', 3),
(40, 'Eastern-Obolo', 3),
(41, 'Eket', 3),
(42, 'Ekpe-Atani', 3),
(43, 'Essien-Udim', 3),
(44, 'Esit Ekit', 3),
(45, 'Etim-Ekpo', 3),
(46, 'Etinam', 3),
(47, 'Ibeno', 3),
(48, 'Ibesikp-Asitan', 3),
(49, 'Ibiono-Ibom', 3),
(50, 'Ika', 3),
(51, 'Ikono', 3),
(52, 'Ikot-Abasi', 3),
(53, 'Ikot-Ekpene', 3),
(54, 'Ini', 3),
(55, 'Itu', 3),
(56, 'Mbo', 3),
(57, 'Mkpae-Enin', 3),
(58, 'Nsit-Ibom', 3),
(59, 'Nsit-Ubium', 3),
(60, 'Obot-Akara', 3),
(61, 'Okobo', 3),
(62, 'Onna', 3),
(63, 'Oron', 3),
(64, 'Oro-Anam', 3),
(65, 'Udung-Uko', 3),
(66, 'Ukanefun', 3),
(67, 'Uru Offong Oruko', 3),
(68, 'Uruan', 3),
(69, 'Uquo Ibene', 3),
(70, 'Uyo', 3),
(71, 'Aguata', 4),
(72, 'Anambra', 4),
(73, 'Anambra West', 4),
(74, 'Anocha', 4),
(75, 'Awka- North', 4),
(76, 'Awka-South', 4),
(77, 'Ayamelum', 4),
(78, 'Dunukofia', 4),
(79, 'Ekwusigo', 4),
(80, 'Idemili-North', 4),
(81, 'Idemili-South', 4),
(82, 'Ihiala', 4),
(83, 'Njikoka', 4),
(84, 'Nnewi-North', 4),
(85, 'Nnewi-South', 4),
(86, 'Ogbaru', 4),
(87, 'Onisha North', 4),
(88, 'Onitsha South', 4),
(89, 'Orumba North', 4),
(90, 'Orumba South', 4),
(91, 'Oyi', 4),
(92, 'Alkaleri', 5),
(93, 'Bauchi', 5),
(94, 'Bogoro', 5),
(95, 'Damban', 5),
(96, 'Darazo', 5),
(97, 'Dass', 5),
(98, 'Gamawa', 5),
(99, 'Ganjuwa', 5),
(100, 'Giade', 5),
(101, 'Itas/Gadau', 5),
(102, 'Jama\'are', 5),
(103, 'Katagum', 5),
(104, 'Kirfi', 5),
(105, 'Misau', 5),
(106, 'Ningi', 5),
(107, 'Shira', 5),
(108, 'Tafawa-Balewa', 5),
(109, 'Toro', 5),
(110, 'Warji', 5),
(111, 'Zaki', 5),
(112, 'Brass', 6),
(113, 'Ekerernor', 6),
(114, 'Kolokuma/Opokuma', 6),
(115, 'Nembe', 6),
(116, 'Ogbia', 6),
(117, 'Sagbama', 6),
(118, 'Southern-Ijaw', 6),
(119, 'Yenegoa', 6),
(120, 'Kembe', 6),
(121, 'Ado', 7),
(122, 'Agatu', 7),
(123, 'Apa', 7),
(124, 'Buruku', 7),
(125, 'Gboko', 7),
(126, 'Guma', 7),
(127, 'Gwer-East', 7),
(128, 'Gwer-West', 7),
(129, 'Katsina-Ala', 7),
(130, 'Konshisha', 7),
(131, 'Kwande', 7),
(132, 'Logo', 7),
(133, 'Makurdi', 7),
(134, 'Obi', 7),
(135, 'Ogbadibo', 7),
(136, 'Ohimini', 7),
(137, 'Oju', 7),
(138, 'Okpokwu', 7),
(139, 'Otukpo', 7),
(140, 'Tarkar', 7),
(141, 'Vandeikya', 7),
(142, 'Ukum', 7),
(143, 'Ushongo', 7),
(144, 'Abadan', 8),
(145, 'Askira-Uba', 8),
(146, 'Bama', 8),
(147, 'Bayo', 8),
(148, 'Biu', 8),
(149, 'Chibok', 8),
(150, 'Damboa', 8),
(151, 'Dikwa', 8),
(152, 'Gubio', 8),
(153, 'Guzamala', 8),
(154, 'Gwoza', 8),
(155, 'Hawul', 8),
(156, 'Jere', 8),
(157, 'Kaga', 8),
(158, 'Kala/Balge', 8),
(159, 'Kukawa', 8),
(160, 'Konduga', 8),
(161, 'Kwaya-Kusar', 8),
(162, 'Mafa', 8),
(163, 'Magumeri', 8),
(164, 'Maiduguri', 8),
(165, 'Marte', 8),
(166, 'Mobbar', 8),
(167, 'Monguno', 8),
(168, 'Ngala', 8),
(169, 'Nganzai', 8),
(170, 'Shani', 8),
(171, 'Abi', 9),
(172, 'Akamkpa', 9),
(173, 'Akpabuyo', 9),
(174, 'Bakassi', 9),
(175, 'Bekwara', 9),
(176, 'Biasi', 9),
(177, 'Boki', 9),
(178, 'Calabar-Municipal', 9),
(179, 'Calabar-South', 9),
(180, 'Etunk', 9),
(181, 'Ikom', 9),
(182, 'Obantiku', 9),
(183, 'Ogoja', 9),
(184, 'Ugep North', 9),
(185, 'Yakurr', 9),
(186, 'Yala', 9),
(187, 'Aniocha North', 10),
(188, 'Aniocha South', 10),
(189, 'Bomadi', 10),
(190, 'Burutu', 10),
(191, 'Ethiope East', 10),
(192, 'Ethiope West', 10),
(193, 'Ika North East', 10),
(194, 'Ika South', 10),
(195, 'Isoko North', 10),
(196, 'Isoko South', 10),
(197, 'Ndokwa East', 10),
(198, 'Ndokwa West', 10),
(199, 'Okpe', 10),
(200, 'Oshimili North', 10),
(201, 'Oshimili South', 10),
(202, 'Patani', 10),
(203, 'Sapele', 10),
(204, 'Udu', 10),
(205, 'Ughilli North', 10),
(206, 'Ughilli South', 10),
(207, 'Ukwuani', 10),
(208, 'Uvwie', 10),
(209, 'Warri Central', 10),
(210, 'Warri North', 10),
(211, 'Warri South', 10),
(212, 'Abakaliki', 11),
(213, 'Ofikpo North', 11),
(214, 'Ofikpo South', 11),
(215, 'Ebonyi', 11),
(216, 'Ezza North', 11),
(217, 'Ezza South', 11),
(218, 'ikwo', 11),
(219, 'Ishielu', 11),
(220, 'Ivo', 11),
(221, 'Izzi', 11),
(222, 'Ohaukwu', 11),
(223, 'Ohaozara', 11),
(224, 'Onicha', 11),
(225, 'Akoko Edo', 12),
(226, 'Egor', 12),
(227, 'Esan Central', 12),
(228, 'Esan North East', 12),
(229, 'Esan South East', 12),
(230, 'Esan West', 12),
(231, 'Etsako-Central', 12),
(232, 'Etsako-West', 12),
(233, 'Igueben', 12),
(234, 'Ikpoba-Okha', 12),
(235, 'Oredo', 12),
(236, 'Orhionmwon', 12),
(237, 'Ovia North East', 12),
(238, 'Ovia South West', 12),
(239, 'owan east', 12),
(240, 'Owan West', 12),
(241, 'Umunniwonde', 12),
(242, 'Ado Ekiti', 13),
(243, 'Aiyedire', 13),
(244, 'Efon', 13),
(245, 'Ekiti-East', 13),
(246, 'Ekiti-South West', 13),
(247, 'Ekiti West', 13),
(248, 'Emure', 13),
(249, 'Ido Osi', 13),
(250, 'Ijero', 13),
(251, 'Ikere', 13),
(252, 'Ikole', 13),
(253, 'Ilejemeta', 13),
(254, 'Irepodun/Ifelodun', 13),
(255, 'Ise Orun', 13),
(256, 'Moba', 13),
(257, 'Oye', 13),
(258, 'Aninri', 14),
(259, 'Awgu', 14),
(260, 'Enugu East', 14),
(261, 'Enugu North', 14),
(262, 'Enugu South', 14),
(263, 'Ezeagu', 14),
(264, 'Igbo Etiti', 14),
(265, 'Igbo Eze North', 14),
(266, 'Igbo Eze South', 14),
(267, 'Isi Uzo', 14),
(268, 'Nkanu East', 14),
(269, 'Nkanu West', 14),
(270, 'Nsukka', 14),
(271, 'Oji-River', 14),
(272, 'Udenu', 14),
(273, 'Udi', 14),
(274, 'Uzo Uwani', 14),
(275, 'Akko', 15),
(276, 'Balanga', 15),
(277, 'Billiri', 15),
(278, 'Dukku', 15),
(279, 'Funakaye', 15),
(280, 'Gombe', 15),
(281, 'Kaltungo', 15),
(282, 'Kwami', 15),
(283, 'Nafada/Bajoga', 15),
(284, 'Shomgom', 15),
(285, 'Yamltu/Deba', 15),
(286, 'Ahiazu-Mbaise', 16),
(287, 'Ehime-Mbano', 16),
(288, 'Ezinihtte', 16),
(289, 'Ideato North', 16),
(290, 'Ideato South', 16),
(291, 'Ihitte/Uboma', 16),
(292, 'Ikeduru', 16),
(293, 'Isiala-Mbano', 16),
(294, 'Isu', 16),
(295, 'Mbaitoli', 16),
(296, 'Ngor-Okpala', 16),
(297, 'Njaba', 16),
(298, 'Nkwerre', 16),
(299, 'Nwangele', 16),
(300, 'obowo', 16),
(301, 'Oguta', 16),
(302, 'Ohaji-Eggema', 16),
(303, 'Okigwe', 16),
(304, 'Onuimo', 16),
(305, 'Orlu', 16),
(306, 'Orsu', 16),
(307, 'Oru East', 16),
(308, 'Oru West', 16),
(309, 'Owerri Municipal', 16),
(310, 'Owerri North', 16),
(311, 'Owerri West', 16),
(312, 'Auyu', 17),
(313, 'Babura', 17),
(314, 'Birnin Kudu', 17),
(315, 'Birniwa', 17),
(316, 'Bosuwa', 17),
(317, 'Buji', 17),
(318, 'Dutse', 17),
(319, 'Gagarawa', 17),
(320, 'Garki', 17),
(321, 'Gumel', 17),
(322, 'Guri', 17),
(323, 'Gwaram', 17),
(324, 'Gwiwa', 17),
(325, 'Hadejia', 17),
(326, 'Jahun', 17),
(327, 'Kafin Hausa', 17),
(328, 'Kaugama', 17),
(329, 'Kazaure', 17),
(330, 'Kirikasanuma', 17),
(331, 'Kiyawa', 17),
(332, 'Maigatari', 17),
(333, 'Malam Maduri', 17),
(334, 'Miga', 17),
(335, 'Ringim', 17),
(336, 'Roni', 17),
(337, 'Sule Tankarkar', 17),
(338, 'Taura', 17),
(339, 'Yankwashi', 17),
(340, 'Birnin-Gwari', 18),
(341, 'Chikun', 18),
(342, 'Giwa', 18),
(343, 'Gwagwada', 18),
(344, 'Igabi', 18),
(345, 'Ikara', 18),
(346, 'Jaba', 18),
(347, 'Jema\'a', 18),
(348, 'Kachia', 18),
(349, 'Kaduna North', 18),
(350, 'Kagarko', 18),
(351, 'Kajuru', 18),
(352, 'Kaura', 18),
(353, 'Kauru', 18),
(354, 'Koka/Kawo', 18),
(355, 'Kubah', 18),
(356, 'Kudan', 18),
(357, 'Lere', 18),
(358, 'Makarfi', 18),
(359, 'Sabon Gari', 18),
(360, 'Sanga', 18),
(361, 'Sabo', 18),
(362, 'Tudun-Wada/Makera', 18),
(363, 'Zango-Kataf', 18),
(364, 'Zaria', 18),
(365, 'Ajingi', 19),
(366, ' Albasu', 19),
(367, 'Bagwai', 19),
(368, 'Bebeji', 19),
(369, 'Bichi', 19),
(370, 'Bunkure', 19),
(371, 'Dala', 19),
(372, 'Dambatta', 19),
(373, 'Dawakin Kudu', 19),
(374, 'Dawakin Tofa', 19),
(375, 'Doguwa', 19),
(376, 'Fagge', 19),
(377, 'Gabasawa', 19),
(378, 'Garko', 19),
(379, 'Garun-Mallam', 19),
(380, 'Gaya', 19),
(381, 'Gezawa', 19),
(382, 'Gwale', 19),
(383, 'Gwarzo', 19),
(384, 'Kabo', 19),
(385, 'Kano Municipal', 19),
(386, 'Karaye', 19),
(387, 'Kibiya', 19),
(388, 'Kiru', 19),
(389, 'Kumbotso', 19),
(390, 'Kunchi', 19),
(391, 'Kura', 19),
(392, 'Madobi', 19),
(393, 'Makoda', 19),
(394, 'Minjibir', 19),
(395, 'Nasarawa', 19),
(396, 'Rano', 19),
(397, 'Rimin Gado', 19),
(398, 'Rogo', 19),
(399, 'Shanono', 19),
(400, 'Sumaila', 19),
(401, 'Takai', 19),
(402, 'Tarauni', 19),
(403, 'Tofa', 19),
(404, 'Tsanyawa', 19),
(405, 'Tudun Wada', 19),
(406, 'Ngogo', 19),
(407, 'Warawa', 19),
(408, 'Wudil', 19),
(409, 'Bakori', 20),
(410, 'Batagarawa', 20),
(411, 'Batsari', 20),
(412, 'Baure', 20),
(413, 'Bindawa', 20),
(414, 'Charanchi', 20),
(415, 'Danja', 20),
(416, 'Danjume', 20),
(417, 'Dan-Musa', 20),
(418, 'Daura', 20),
(419, 'Dutsi', 20),
(420, 'Dutsinma', 20),
(421, 'Faskari', 20),
(422, 'Funtua', 20),
(423, 'Ingara', 20),
(424, 'Jibia', 20),
(425, 'Kafur', 20),
(426, 'Kaita', 20),
(427, 'Kankara', 20),
(428, 'Kankia', 20),
(429, 'Katsina', 20),
(430, 'Kurfi', 20),
(431, 'Kusada', 20),
(432, 'Mai Adua', 20),
(433, 'Malumfashi', 20),
(434, 'Mani', 20),
(435, 'Mashi', 20),
(436, 'Matazu', 20),
(437, 'Musawa', 20),
(438, 'Rimi', 20),
(439, 'Sabuwa', 20),
(440, 'Safana', 20),
(441, 'Sandamu', 20),
(442, 'Zango', 20),
(443, 'Aleira', 21),
(444, 'Arewa', 21),
(445, 'Argungu', 21),
(446, 'Augie', 21),
(447, 'Bagudo', 21),
(448, 'Birnin-Kebbi', 21),
(449, 'Bumza', 21),
(450, 'Dandi', 21),
(451, 'Danko', 21),
(452, 'Fakai', 21),
(453, 'Gwandu', 21),
(454, 'Jega', 21),
(455, 'Kalgo', 21),
(456, 'Koko-Besse', 21),
(457, 'Maiyama', 21),
(458, 'Ngaski', 21),
(459, 'Sakaba', 21),
(460, 'Shanga', 21),
(461, 'Suru', 21),
(462, 'Wasagu', 21),
(463, 'Yauri', 21),
(464, 'Zuru', 21),
(465, 'Adavi', 22),
(466, 'Ajaokuta', 22),
(467, 'Ankpa', 22),
(468, 'Bassa', 22),
(469, 'Dekina', 22),
(470, 'Ibaji', 22),
(471, 'Idah', 22),
(472, 'Igalamela', 22),
(473, 'Ijumu', 22),
(474, 'Kabba/Bunu', 22),
(475, 'Kogi', 22),
(476, 'Lokoja', 22),
(477, 'Mopa-Muro-Mopi', 22),
(478, 'Ofu', 22),
(479, 'Ogori/Magongo', 22),
(480, 'Okehi', 22),
(481, 'Okene', 22),
(482, 'Olamaboro', 22),
(483, 'Omala', 22),
(484, 'Oyi', 22),
(485, 'Yagba-East', 22),
(486, 'Yagba-West', 22),
(487, 'Asa', 23),
(488, 'Baruten', 23),
(489, 'Edu', 23),
(490, 'Ekiti', 23),
(491, 'Ifelodun', 23),
(492, 'Ilorin East', 23),
(493, 'Ilorin South', 23),
(494, 'Ilorin West', 23),
(495, 'Irepodun', 23),
(496, 'Isin', 23),
(497, 'Kaiama', 23),
(498, 'Moro', 23),
(499, 'Offa', 23),
(500, 'Oke-Ero', 23),
(501, 'Oyun', 23),
(502, 'Pategi', 23),
(503, 'Agege', 24),
(504, 'Ajeromi-Ifelodun', 24),
(505, 'Alimosho', 24),
(506, 'Amuwo-Odofin', 24),
(507, 'Apapa', 24),
(508, 'Bagagry', 24),
(509, 'Epe', 24),
(510, 'Eti-Osa', 24),
(511, 'Ibeju-Lekki', 24),
(512, 'Ifako-Ijaiye', 24),
(513, 'Ikeja', 24),
(514, 'Ikorodu', 24),
(515, 'Kosofe', 24),
(516, 'Lagos-Island', 24),
(517, 'Lagos-Mainland', 24),
(518, 'Mushin', 24),
(519, 'Ojo', 24),
(520, 'Oshodi-Isolo', 24),
(521, 'Shomolu', 24),
(522, 'Suru-Lere', 24),
(523, 'Akwanga', 25),
(524, 'Awe', 25),
(525, 'Doma', 25),
(526, 'Karu', 25),
(527, 'Keana', 25),
(528, 'Keffi', 25),
(529, 'Kokona', 25),
(530, 'Lafia', 25),
(531, 'Nassarawa', 25),
(532, 'Nassarawa Eggor', 25),
(533, 'Obi', 25),
(534, 'Toto', 25),
(535, 'Wamba', 25),
(536, 'Agaie', 26),
(537, 'Agwara', 26),
(538, 'Bida', 26),
(539, 'Borgu', 26),
(540, 'Bosso', 26),
(541, 'Chanchaga', 26),
(542, 'Edati', 26),
(543, 'Gbako', 26),
(544, 'Gurara', 26),
(545, 'Katcha', 26),
(546, 'Kontagora', 26),
(547, 'Lapai', 26),
(548, 'Lavum', 26),
(549, 'Magama', 26),
(550, 'Mariga', 26),
(551, 'Mashegu', 26),
(552, 'Mokwa', 26),
(553, 'Muya', 26),
(554, 'Paikoro', 26),
(555, 'Rafi', 26),
(556, 'Rajau', 26),
(557, 'Shiroro', 26),
(558, 'Suleja', 26),
(559, 'Tafa', 26),
(560, 'Wushishi', 26),
(561, 'Abeokuta -North', 27),
(562, 'Abeokuta -South', 27),
(563, 'Ado-Odu/Ota', 27),
(564, 'Yewa-North', 27),
(565, 'Yewa-South', 27),
(566, 'Ewekoro', 27),
(567, 'Ifo', 27),
(568, 'Ijebu East', 27),
(569, 'Ijebu North', 27),
(570, 'Ijebu North-East', 27),
(571, 'Ijebu-Ode', 27),
(572, 'Ikenne', 27),
(573, 'Imeko-Afon', 27),
(574, 'Ipokia', 27),
(575, 'Obafemi -Owode', 27),
(576, 'Odeda', 27),
(577, 'Odogbolu', 27),
(578, 'Ogun-Water Side', 27),
(579, 'Remo-North', 27),
(580, 'Shagamu', 27),
(581, 'Akoko-North-East', 28),
(582, 'Akoko-North-West', 28),
(583, 'Akoko-South-West', 28),
(584, 'Akoko-South-East', 28),
(585, 'Akure- South', 28),
(586, 'Akure-North', 28),
(587, 'Ese-Odo', 28),
(588, 'Idanre', 28),
(589, 'Ifedore', 28),
(590, 'Ilaje', 28),
(591, 'Ile-Oluji-Okeigbo', 28),
(592, 'Irele', 28),
(593, 'Odigbo', 28),
(594, 'Okitipupa', 28),
(595, 'Ondo-West', 28),
(596, 'Ondo East', 28),
(597, 'Ose', 28),
(598, 'Owo', 28),
(599, 'Atakumosa', 29),
(600, 'Atakumosa East', 29),
(601, 'Ayeda-Ade', 29),
(602, 'Ayedire', 29),
(603, 'Boluwaduro', 29),
(604, 'Boripe', 29),
(605, 'Ede', 29),
(606, 'Ede North', 29),
(607, 'Egbedore', 29),
(608, 'Ejigbo', 29),
(609, 'Ife', 29),
(610, 'Ife East', 29),
(611, 'Ife North', 29),
(612, 'Ife South', 29),
(613, 'Ifedayo', 29),
(614, 'Ifelodun', 29),
(615, 'Ila', 29),
(616, 'Ilesha', 29),
(617, 'Ilesha-West', 29),
(618, 'Irepodun', 29),
(619, 'Irewole', 29),
(620, 'Isokun', 29),
(621, 'Iwo', 29),
(622, 'Obokun', 29),
(623, 'Odo-Otin', 29),
(624, 'Ola Oluwa', 29),
(625, 'Olorunda', 29),
(626, 'Ori-Ade', 29),
(627, 'Orolu', 29),
(628, 'Osogbo', 29),
(629, 'Afijio', 30),
(630, 'Akinyele', 30),
(631, 'Atiba', 30),
(632, 'Atisbo', 30),
(633, 'Egbeda', 30),
(634, 'Ibadan-Central', 30),
(635, 'Ibadan-North-East', 30),
(636, 'Ibadan-North-West', 30),
(637, 'Ibadan-South-East', 30),
(638, 'Ibadan-South West', 30),
(639, 'Ibarapa-Central', 30),
(640, 'Ibarapa-East', 30),
(641, 'Ibarapa-North', 30),
(642, 'Ido', 30),
(643, 'Ifedayo', 30),
(644, 'Ifeloju', 30),
(645, 'Irepo', 30),
(646, 'Iseyin', 30),
(647, 'Itesiwaju', 30),
(648, 'Iwajowa', 30),
(649, 'Kajola', 30),
(650, 'Lagelu', 30),
(651, 'Odo-Oluwa', 30),
(652, 'Ogbomoso-North', 30),
(653, 'Ogbomosho-South', 30),
(654, 'Olorunsogo', 30),
(655, 'Oluyole', 30),
(656, 'Ona-Ara', 30),
(657, 'Orelope', 30),
(658, 'Ori-Ire', 30),
(659, 'Oyo East', 30),
(660, 'Oyo West', 30),
(661, 'saki east', 30),
(662, 'Saki West', 30),
(663, 'Surulere', 30),
(664, 'Barkin Ladi', 31),
(665, 'Bassa', 31),
(666, 'Bokkos', 31),
(667, 'Jos-East', 31),
(668, 'Jos-South', 31),
(669, 'Jos-North', 31),
(670, 'Kanam', 31),
(671, 'Kanke', 31),
(672, 'Langtang North', 31),
(673, 'Langtang South', 31),
(674, 'Mangu', 31),
(675, 'Mikang', 31),
(676, 'Pankshin', 31),
(677, 'Quan\'pan', 31),
(678, 'Riyom', 31),
(679, 'Shendam', 31),
(680, 'Wase', 31),
(681, 'Abua/Odual', 32),
(682, 'Ahoada East', 32),
(683, 'Ahoada West', 32),
(684, 'Akukutoru', 32),
(685, 'Andoni', 32),
(686, 'Asari-Toro', 32),
(687, 'Bonny', 32),
(688, 'Degema', 32),
(689, 'Eleme', 32),
(690, 'Emuoha', 32),
(691, 'Etche', 32),
(692, 'Gokana', 32),
(693, 'Ikwerre', 32),
(694, 'Khana', 32),
(695, 'Obio/Akpor', 32),
(696, 'Ogba/Egbama/Ndoni', 32),
(697, 'Ogu/Bolo', 32),
(698, 'Okrika', 32),
(699, 'Omuma', 32),
(700, 'Opobo/Nkoro', 32),
(701, 'Oyigbo', 32),
(702, 'Port-Harcourt', 32),
(703, 'Tai', 32),
(704, 'Binji', 33),
(705, 'Bodinga', 33),
(706, 'Dange-Shuni', 33),
(707, 'Gada', 33),
(708, 'Goronyo', 33),
(709, 'Gudu', 33),
(710, 'Gwadabawa', 33),
(711, 'Illela', 33),
(712, 'Isa', 33),
(713, 'Kebbe', 33),
(714, 'Kware', 33),
(715, 'Raba', 33),
(716, 'Sabon-Birni', 33),
(717, 'Shagari', 33),
(718, 'Silame', 33),
(719, 'Sokoto North', 33),
(720, 'Sokoto South', 33),
(721, 'Tambuwal', 33),
(722, 'Tanzaga', 33),
(723, 'Tureta', 33),
(724, 'Wamakko', 33),
(725, 'Wurno', 33),
(726, 'Yabo', 33),
(727, 'Ardo Kola', 34),
(728, 'Bali', 34),
(729, 'Donga', 34),
(730, 'Gashaka', 34),
(731, 'Gassol', 34),
(732, 'Ibi', 34),
(733, 'Jalingo', 34),
(734, 'Karim-Lamido', 34),
(735, 'Kurmi', 34),
(736, 'Lau', 34),
(737, 'Sardauna', 34),
(738, 'Takuni', 34),
(739, 'Ussa', 34),
(740, 'Wukari', 34),
(741, 'Yarro', 34),
(742, 'Zing', 34),
(743, 'Bade', 35),
(744, 'Bursali', 35),
(745, 'Damaturu', 35),
(746, 'Fuka', 35),
(747, 'Fune', 35),
(748, 'Geidam', 35),
(749, 'Gogaram', 35),
(750, 'Gujba', 35),
(751, 'Gulani', 35),
(752, 'Jakusko', 35),
(753, 'Karasuwa', 35),
(754, 'Machina', 35),
(755, 'Nangere', 35),
(756, 'Nguru', 35),
(757, 'Potiskum', 35),
(758, 'Tarmua', 35),
(759, 'Yunisari', 35),
(760, 'Yusufari', 35),
(761, 'Anka', 36),
(762, 'Bakure', 36),
(763, 'Bukkuyum', 36),
(764, 'Bungudo', 36),
(765, 'Gumi', 36),
(766, 'Gusau', 36),
(767, 'Isa', 36),
(768, 'Kaura-Namoda', 36),
(769, 'Kiyawa', 36),
(770, 'Maradun', 36),
(771, 'Marau', 36),
(772, 'Shinkafa', 36),
(773, 'Talata-Mafara', 36),
(774, 'Tsafe', 36),
(775, 'Zurmi', 36),
(776, 'Obudu', 9),
(777, 'Abaji', 37),
(778, 'Bwari', 37),
(779, 'Gwagwalada', 37),
(780, 'Kuje', 37),
(781, 'Kwali', 37),
(782, 'Municipal', 37),
(783, 'Etsako-East', 12),
(784, 'Ahiazu-Mbaise', 16),
(785, 'Foreign', 38),
(786, 'Kaduna South', 18),
(787, 'Aboh-Mbaise', 16),
(788, 'Odukpani', 9);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `ref_no` varchar(45) NOT NULL,
  `pay_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pay_user_id` int(11) NOT NULL,
  `pay_amount` float NOT NULL,
  `pay_status` enum('pending','failed','success','') NOT NULL DEFAULT 'pending',
  `pay_report_id` int(11) NOT NULL,
  `pay_agent_id` int(11) NOT NULL,
  `user_paid` enum('yes','no','','') NOT NULL DEFAULT 'no',
  `user_paid_amount` float NOT NULL,
  `userpaid_refno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `ref_no`, `pay_date`, `pay_user_id`, `pay_amount`, `pay_status`, `pay_report_id`, `pay_agent_id`, `user_paid`, `user_paid_amount`, `userpaid_refno`) VALUES
(8, '17345691741771222006', '2024-12-25 05:47:45', 18, 7476, 'pending', 4, 1, 'no', 0, '0'),
(9, '1734663271325950078', '2024-12-25 05:47:40', 18, 2225, 'pending', 4, 1, 'no', 0, '0'),
(12, '17346887551629997980', '2024-12-20 09:59:15', 15, 125000, 'pending', 8, 1, 'no', 0, '0'),
(13, '1734688785439910381', '2024-12-20 09:59:45', 15, 125000, 'pending', 8, 1, 'no', 0, '0'),
(14, '1735052278417095378', '2024-12-24 14:58:35', 15, 5000, 'success', 13, 4, 'no', 0, '0'),
(15, '17350668491853485036', '2024-12-25 06:58:19', 18, 2225, 'success', 4, 4, 'yes', 2091.5, '1735109896658598096'),
(16, '1735070163831274095', '2024-12-24 19:56:03', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(17, '17350713411323750676', '2024-12-24 20:15:41', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(18, '1735071345658361084', '2024-12-24 20:15:45', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(19, '1735071349486478897', '2024-12-24 20:15:49', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(20, '1735071355506894386', '2024-12-24 20:15:55', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(21, '1735071404851212877', '2024-12-24 20:16:44', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(22, '1735071409693214565', '2024-12-24 20:16:49', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(23, '17350714451891031943', '2024-12-24 20:17:25', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(24, '1735071450130861171', '2024-12-24 20:17:30', 17, 5000, 'pending', 3, 4, 'no', 0, '0'),
(25, '17351106941018572983', '2024-12-25 07:15:37', 17, 15000, 'success', 2, 4, 'yes', 14100, '1735110932226988566'),
(26, '1735110876687417854', '2024-12-25 07:16:06', 18, 225000, 'success', 17, 4, 'yes', 211500, '1735110963299090274'),
(27, '1735111331615632228', '2024-12-25 07:22:27', 18, 25200, 'success', 18, 4, 'no', 0, ''),
(28, '1735124447945282945', '2024-12-25 11:00:47', 18, 37500, 'pending', 16, 4, 'no', 0, ''),
(29, '17351244511241628994', '2024-12-25 11:00:51', 18, 37500, 'pending', 16, 4, 'no', 0, ''),
(31, '1735367704272323332', '2024-12-28 06:35:18', 17, 5000, 'success', 3, 4, 'no', 0, ''),
(32, '17354335091281571270', '2024-12-29 02:15:41', 16, 60000, 'success', 49, 4, 'yes', 56400, '1735438535176677506'),
(37, '17354689361818239834', '2024-12-29 10:42:16', 16, 250, 'pending', 47, 4, 'no', 0, ''),
(38, '1735468965549683329', '2024-12-29 10:44:04', 16, 250, 'success', 47, 4, 'yes', 235, '1735469040580711376'),
(39, '1735470421767004620', '2024-12-29 11:13:13', 16, 54000, 'success', 50, 5, 'yes', 50760, '17354707891865480919'),
(40, '17354711402072300829', '2024-12-29 11:19:00', 16, 200000, 'pending', 48, 5, 'no', 0, ''),
(41, '1735471201735468131', '2024-12-29 11:20:01', 16, 200000, 'pending', 48, 4, 'no', 0, ''),
(42, '17354718551849417725', '2024-12-29 11:31:11', 16, 200000, 'success', 48, 5, 'no', 0, ''),
(43, '1735475226428952005', '2024-12-29 12:27:06', 16, 50000, 'pending', 20, 5, 'no', 0, ''),
(44, '1735488869788580083', '2024-12-29 16:18:48', 23, 51840, 'success', 51, 4, 'yes', 48729.6, '17354891211947345060');

-- --------------------------------------------------------

--
-- Table structure for table `reports_message`
--

CREATE TABLE `reports_message` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `reason` enum('Fake Report','Incorrect Information','Wrong Weight','Others') NOT NULL DEFAULT 'Others',
  `message` text NOT NULL,
  `agent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mreport_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reports_message`
--

INSERT INTO `reports_message` (`id`, `report_id`, `reason`, `message`, `agent_id`, `user_id`, `mreport_date`) VALUES
(4, 6, 'Fake Report', 'This report is not accurate. The user is scam', 1, 15, '2024-12-29 13:01:06'),
(6, 6, 'Wrong Weight', 'The weight is 1500kg not 15000kg', 1, 15, '2024-12-29 13:01:06'),
(7, 6, 'Wrong Weight', 'The weight is 15kg not 7000kg', 1, 15, '2024-12-29 13:01:06'),
(9, 20, 'Fake Report', 'The report seems fake and inaccurate. I suggest this user to be banned from the platform.', 5, 16, '2024-12-29 13:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `reports_waste`
--

CREATE TABLE `reports_waste` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `pickup_address` text NOT NULL,
  `waste_type` varchar(255) NOT NULL,
  `waste_image` text NOT NULL,
  `waste_amount` float NOT NULL,
  `reports_status` varchar(255) NOT NULL DEFAULT 'pending',
  `report_state_id` int(11) NOT NULL,
  `report_lga_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `points_earned` int(11) NOT NULL,
  `pointsperkg_earned` int(11) NOT NULL,
  `report_ref` varchar(255) NOT NULL,
  `approved_time` timestamp NULL DEFAULT NULL,
  `verified_status` enum('verified','unverified','','') NOT NULL DEFAULT 'unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reports_waste`
--

INSERT INTO `reports_waste` (`report_id`, `user_id`, `report_date`, `pickup_address`, `waste_type`, `waste_image`, `waste_amount`, `reports_status`, `report_state_id`, `report_lga_id`, `cat_id`, `points_earned`, `pointsperkg_earned`, `report_ref`, `approved_time`, `verified_status`) VALUES
(1, 15, '2024-12-23 15:15:12', 'asbdissbdbbobooeqb', 'Plastics', '1_67583ee658253.jpg', 45, 'pending', 24, 519, 1, 0, 0, 'Plastics17338365181242240747', '0000-00-00 00:00:00', 'unverified'),
(2, 17, '2024-12-25 07:12:47', 'Laspotech', 'Scrap metals', '5_67587224754b3.jpg', 100, 'approved', 24, 514, 5, 0, 0, 'Scrap metals1733849636596529389', '0000-00-00 00:00:00', 'verified'),
(3, 17, '2024-12-28 06:35:18', 'Laspotech', 'Plastics', '1_6758726331539.jpg', 200, 'approved', 24, 514, 1, 0, 0, 'Plastics173384969958898179', '0000-00-00 00:00:00', 'verified'),
(4, 18, '2024-12-24 19:01:29', 'Ojo', 'Plastics', '1_675875293c6aa.jpg', 89, 'approved', 24, 519, 1, 0, 0, 'Plastics17338504091261797003', '0000-00-00 00:00:00', 'verified'),
(5, 18, '2024-12-24 14:46:04', 'Laspotech', 'Glass', '3_67587556c5712.jpg', 45, 'pending', 16, 303, 3, 0, 0, 'Glass17338504541037554003', '0000-00-00 00:00:00', 'unverified'),
(6, 15, '2024-12-17 12:33:04', 'buvuvuyv3w3', 'Plastics', '1_675d4ceda498c.jpg', 10, 'pending', 24, 519, 1, 0, 0, 'Plastics17341677891140603152', '0000-00-00 00:00:00', 'unverified'),
(7, 15, '2024-12-17 12:20:34', 'lasu', 'Plastics', '1_675d86a404875.jpg', 200, 'pending', 24, 519, 1, 0, 0, 'Plastics17341825642083709725', '0000-00-00 00:00:00', 'unverified'),
(8, 15, '2024-12-20 20:25:39', 'nonk', 'Plastics', '1_675ef000032c3.png', 5000, 'pending', 22, 480, 1, 0, 0, 'Plastics17342750721103353602', '0000-00-00 00:00:00', 'unverified'),
(9, 15, '2024-12-17 12:22:44', 'testing location', 'Glass', '3_675f3807cfe66.jpg', 500, 'pending', 24, 518, 3, 0, 0, 'Glass17342935111657394775', '0000-00-00 00:00:00', 'unverified'),
(12, 18, '2024-12-20 20:27:14', 'Mushin', 'Biowaste', '2_6765d322ae8d8.png', 100, 'pending', 24, 521, 2, 0, 0, 'Biowaste1734726434111791725', NULL, 'unverified'),
(13, 15, '2024-12-24 14:58:35', 'Ojo', 'Plastics', '1_6767c93d4605e.png', 200, 'approved', 24, 519, 1, 5, 1000, 'Plastics17348549731689905077', '0000-00-00 00:00:00', 'verified'),
(17, 18, '2024-12-25 07:15:01', 'Mainland beside Ojinkan street', 'Scrap metals', '5_676baf2687e58.png', 1500, 'approved', 24, 517, 5, 5, 7500, 'Scrap metals17351104381051113057', '0000-00-00 00:00:00', 'verified'),
(18, 18, '2024-12-25 07:22:27', 'Shomulu beside Ojinkan street', 'Glass', '3_676bb231e2dd6.png', 210, 'approved', 24, 521, 3, 6, 1260, 'Glass1735111217918560649', '0000-00-00 00:00:00', 'verified'),
(19, 16, '2024-12-28 07:53:31', 'Surelere Peace Park', 'Biowaste', '2_676fae7b65f7f.png', 500, 'pending', 24, 522, 2, 0, 0, 'Biowaste17353724111606198481', NULL, 'unverified'),
(20, 16, '2024-12-28 08:41:12', 'Surelere Peace Park', 'Plastics', '1_676fb9a83abaa.png', 2000, 'approved', 24, 522, 1, 0, 0, 'Plastics1735375272216123345', '0000-00-00 00:00:00', 'unverified'),
(21, 16, '2024-12-28 08:45:58', 'Surelere Peace Park', 'Plastics', '1_676fbac670d57.png', 2000, 'approved', 24, 519, 1, 0, 0, 'Plastics1735375558158925769', '0000-00-00 00:00:00', 'unverified'),
(26, 16, '2024-12-28 11:52:55', 'Mushin', 'Plastics', '1_676fe6972bbac.png', 30, 'pending', 24, 521, 1, 0, 0, 'Plastics17353867751819318474', NULL, 'unverified'),
(27, 16, '2024-12-28 11:56:10', 'Mushin', 'Plastics', '1_676fe75a865fa.png', 30, 'pending', 24, 521, 1, 0, 0, 'Plastics1735386970924662343', NULL, 'unverified'),
(28, 16, '2024-12-28 20:17:56', 'Mushin', 'Plastics', '1_67705cf46a487.png', 30, 'pending', 24, 518, 1, 0, 0, 'Plastics17354170761476276472', NULL, 'unverified'),
(29, 16, '2024-12-28 20:23:46', 'Mushin', 'Plastics', '1_67705e52345e0.png', 30, 'pending', 24, 518, 1, 0, 0, 'Plastics1735417426863660712', NULL, 'unverified'),
(30, 16, '2024-12-28 21:19:53', 'Shomulu beside Ojinkan street', 'Biowaste', '2_67706b7950f8f.png', 30, 'pending', 16, 303, 2, 0, 0, 'Biowaste17354207932010790974', NULL, 'unverified'),
(37, 16, '2024-12-28 21:26:49', 'jjhh', 'Biowaste', '2_67706d191cf5e.png', 2000, 'pending', 15, 284, 2, 0, 0, 'Biowaste1735421209676710145', NULL, 'unverified'),
(38, 16, '2024-12-28 22:02:40', 'Os', 'Plastics', '1_6770758085e02.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics17354233602008024477', NULL, 'unverified'),
(39, 16, '2024-12-28 22:02:44', 'Oshodi street', 'Plastics', '1_677075842b902.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics17354233641331780409', NULL, 'unverified'),
(40, 16, '2024-12-28 22:02:46', 'Oshodi street', 'Plastics', '1_6770758647378.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics1735423366944073018', NULL, 'unverified'),
(41, 16, '2024-12-28 22:03:11', 'Oshodi street', 'Plastics', '1_6770759f1b70e.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics1735423391846395477', NULL, 'unverified'),
(42, 16, '2024-12-28 22:03:11', 'Oshodi street', 'Plastics', '1_6770759fd2204.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics17354233911325773519', NULL, 'unverified'),
(43, 16, '2024-12-28 22:03:12', 'Oshodi street', 'Plastics', '1_677075a01642d.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics1735423392697180816', NULL, 'unverified'),
(44, 16, '2024-12-28 22:03:14', 'Oshodi street', 'Plastics', '1_677075a22cd1d.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics1735423394262881971', NULL, 'unverified'),
(45, 16, '2024-12-28 22:03:14', 'Oshodi street', 'Plastics', '1_677075a266398.png', 2000, 'pending', 24, 520, 1, 0, 0, 'Plastics17354233941769248487', NULL, 'unverified'),
(46, 16, '2024-12-28 22:23:41', 'kachia', 'Plastics', '1_67707a6d56aee.png', 10, 'pending', 21, 458, 1, 0, 0, 'Plastics1735424621393600103', NULL, 'unverified'),
(47, 16, '2024-12-28 22:31:58', 'island  landmark', 'Plastics', '1_67707c5e5c67a.png', 10, 'approved', 24, 516, 1, 5, 50, 'Plastics17354251181774742227', '0000-00-00 00:00:00', 'verified'),
(48, 16, '2024-12-29 00:11:28', 'Orlu', 'Biowaste', '2_677093b091e60.png', 2000, 'approved', 16, 305, 2, 5, 10000, 'Biowaste17354310881330456035', '0000-00-00 00:00:00', 'verified'),
(49, 16, '2024-12-29 00:36:11', 'Lagosislad', 'Glass', '3_6770997bc3a50.png', 500, 'approved', 17, 328, 3, 6, 3000, 'Glass17354325711227588565', '0000-00-00 00:00:00', 'verified'),
(50, 16, '2024-12-29 11:03:08', 'Oshodii Oke Roundabout', 'E-waste', '4_67712c6c0d090.jpg', 450, 'approved', 24, 520, 4, 6, 2700, 'E-waste17354701881153197215', '0000-00-00 00:00:00', 'verified'),
(51, 23, '2024-12-29 16:11:12', 'Behind Kosofe Market', 'Glass', '3_677174a0c40d0.jpg', 432, 'approved', 24, 515, 3, 6, 2592, 'Glass1735488672349972060', '0000-00-00 00:00:00', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Akwa Ibom'),
(4, 'Anambra'),
(5, 'Bauchi'),
(6, 'Bayelsa'),
(7, 'Benue'),
(8, 'Borno'),
(9, 'Cross River'),
(10, 'Delta'),
(11, 'Ebonyi'),
(12, 'Edo'),
(13, 'Ekiti'),
(14, 'Enugu'),
(15, 'Gombe'),
(16, 'Imo'),
(17, 'Jigawa'),
(18, 'Kaduna'),
(19, 'Kano'),
(20, 'Katsina'),
(21, 'Kebbi'),
(22, 'Kogi'),
(23, 'Kwara'),
(24, 'Lagos'),
(25, 'Nassarawa'),
(26, 'Niger'),
(27, 'Ogun'),
(28, 'Ondo'),
(29, 'Osun'),
(30, 'Oyo'),
(31, 'Plateau'),
(32, 'Rivers'),
(33, 'Sokoto'),
(34, 'Taraba'),
(35, 'Yobe'),
(36, 'Zamfara'),
(37, 'Abuje (FCT)'),
(38, 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `state_id` int(11) NOT NULL,
  `lga_id` int(11) DEFAULT NULL,
  `account_no` int(12) DEFAULT NULL,
  `account_no2` bigint(20) NOT NULL,
  `Bank_Name` varchar(255) NOT NULL,
  `nearest_pickup` varchar(5000) NOT NULL,
  `active_status` enum('active','restricted','','') NOT NULL,
  `Bank_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `created_date`, `phone_number`, `address`, `state_id`, `lga_id`, `account_no`, `account_no2`, `Bank_Name`, `nearest_pickup`, `active_status`, `Bank_code`) VALUES
(13, 'Bless craig', 'blessing@g.com', 'bless1234', '2024-12-25 11:02:21', '08179661363', '', 4, NULL, NULL, 0, '', '', 'restricted', ''),
(15, 'Omosare Omogbagi', 'omosare@gmail.com', 'omosare224', '2024-12-25 11:02:33', '09028219549', '', 24, 0, 2147483647, 0, 'ALAT by WEMA', 'Laspotech and environ', 'active', '055'),
(16, 'Ik Leston', 'ikl@gmail.com', 'ik1234', '2024-12-25 11:02:30', '12345678', '', 1, 1, 2147483647, 8179661363, 'PalmPay', 'landmark', 'active', '999991'),
(17, 'Akeem Olaleye', 'akeem@gmail.com', 'akeem1234', '2024-12-25 11:02:31', '09028219549', '', 24, 511, 1558782080, 1558782080, 'Access Bank', 'Anywhere', 'active', '044'),
(18, 'Toluwase Lola', 'toluwase@yahoo.com', 'tolu1234', '2024-12-25 07:18:07', '23456788', '', 30, 642, 1558782080, 1558782080, 'First Bank of Nigeria', 'Laspotech and environ', 'restricted', '011'),
(19, 'Adewale Oseni', 'adewale@gmail.com', 'adewale1234', '2024-12-20 03:52:57', '08179661363', '', 24, 520, NULL, 0, '', '', 'active', ''),
(20, 'Owolabi Isiaka', 'owolabisiaka@gmail.com', '$2y$10$JI6VYS2EhZV0mhIGECb/VePG4Eg0KLh4PFmeuDXEj8YMPgCONMEAS', '2024-12-21 10:23:15', '09023456355', '', 24, 519, NULL, 0, '', '', 'active', ''),
(22, 'Michael Tuchel', 'tuchel@gmail.com', '$2y$10$KIGf8C5TtLhD91PElSrSIupchm29xuIHiiJaA8NnXLLtGsFH1n9hW', '2024-12-22 18:42:02', '12345678', '', 24, 509, NULL, 0, '', '', 'active', ''),
(23, 'kafayat ololade', 'kafa@gmail.com', '$2y$10$d1ej9ZnE1UAbwC3/N5aEOOxhFxmQYQFAk2akf7pUr8FDow90VE3Vm', '2024-12-29 16:08:33', '08012345678', '', 24, 515, NULL, 3098980027, 'First Bank of Nigeria', 'Kosofe Behind main mall', 'active', '011');

-- --------------------------------------------------------

--
-- Table structure for table `waste_application`
--

CREATE TABLE `waste_application` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `appl_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  `appl_note` text NOT NULL,
  `report_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waste_cat`
--

CREATE TABLE `waste_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `points_per_kg` int(11) NOT NULL,
  `price_per_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `waste_cat`
--

INSERT INTO `waste_cat` (`cat_id`, `cat_name`, `points_per_kg`, `price_per_point`) VALUES
(1, 'Plastics', 5, 5),
(2, 'Biowaste', 5, 20),
(3, 'Glass', 6, 20),
(4, 'E-waste', 6, 20),
(5, 'Scrap metals', 5, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agent_id`),
  ADD UNIQUE KEY `email_address_UNIQUE` (`email_address`);

--
-- Indexes for table `collected_waste`
--
ALTER TABLE `collected_waste`
  ADD PRIMARY KEY (`collected_id`),
  ADD KEY `FK3_idx` (`report_id`),
  ADD KEY `FK11_idx` (`agent_id`);

--
-- Indexes for table `lga`
--
ALTER TABLE `lga`
  ADD PRIMARY KEY (`lga_id`),
  ADD KEY `FK24_idx` (`state_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `FK59_idx` (`pay_user_id`);

--
-- Indexes for table `reports_message`
--
ALTER TABLE `reports_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports_waste`
--
ALTER TABLE `reports_waste`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `FK57_idx` (`report_state_id`),
  ADD KEY `fk_cat_id` (`cat_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `waste_application`
--
ALTER TABLE `waste_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK55_idx` (`report_id`),
  ADD KEY `FK60_idx` (`agent_id`);

--
-- Indexes for table `waste_cat`
--
ALTER TABLE `waste_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collected_waste`
--
ALTER TABLE `collected_waste`
  MODIFY `collected_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lga`
--
ALTER TABLE `lga`
  MODIFY `lga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=789;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reports_message`
--
ALTER TABLE `reports_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reports_waste`
--
ALTER TABLE `reports_waste`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `waste_application`
--
ALTER TABLE `waste_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waste_cat`
--
ALTER TABLE `waste_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collected_waste`
--
ALTER TABLE `collected_waste`
  ADD CONSTRAINT `FK11` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`agent_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK3` FOREIGN KEY (`report_id`) REFERENCES `reports_waste` (`report_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lga`
--
ALTER TABLE `lga`
  ADD CONSTRAINT `FK24` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK59` FOREIGN KEY (`pay_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reports_waste`
--
ALTER TABLE `reports_waste`
  ADD CONSTRAINT `FK57` FOREIGN KEY (`report_state_id`) REFERENCES `state` (`state_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `waste_application`
--
ALTER TABLE `waste_application`
  ADD CONSTRAINT `FK55` FOREIGN KEY (`report_id`) REFERENCES `reports_waste` (`report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK60` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`agent_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
