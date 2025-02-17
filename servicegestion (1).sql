-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 17 fév. 2025 à 15:58
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `servicegestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `alluquestions`
--

CREATE TABLE `alluquestions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_question` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=Hotital General MTN, 2=ECD, 3=CHR, 4=ESPC, 5=Hotipal General',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `alluquestions`
--

INSERT INTO `alluquestions` (`id`, `name_question`, `type`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(42, 'Effectif d\'agents disponibles dans la structure par catégorie et profil? (Medecins/Chirurgiens/IDE/SF/AS)', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(43, 'Avez-vous été formé à la prise en charge des MTN?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(44, 'Combien de médecins ont été formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(45, 'Combien de chirurgiens ont été formés pour les MTN?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(46, 'Existe-t-il des chirurgiens certifiés dans la prise en charge des hydrocèles?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(47, 'Existe-t-il des agents formés à la prise en charge des trichiasis trachomateux (TT)?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(48, 'Existe-t-il des chirurgiens formés à la greffe de peau et à la chirurgie réparatrice?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(49, 'Existe-t-il des agents formés à la gestion des plaies et des cicatrices ?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(50, 'Existe-t-il des kinésistherapeutes formés ?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(51, 'Combien d\'ophtamologues ont été formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(52, 'Combien de kinésistes ont été formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(53, 'Existe-t-il des orthoprothésistes formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(54, 'Existe-t-il des biologistes formés pour les MTN?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(55, 'Existe-t-il des infirmiers spécialistes formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(56, 'Existe-t-il des CSE formés pour les MTN?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(57, 'Existe-t-il des SF/magnéticiens formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(58, 'Existe-t-il des IDE formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(59, 'Existe-t-il des aides soignants/auxilliaires formés pour les MTN dans votre établissement?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(60, 'Existe-t-il des techniciens biologistes formés pour les MTN?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(61, 'Décrivez votre rôle dans la lutte contre les MTN?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(62, 'Présentation generale de la cour, bien entretenue? Etat général de la peinture des locaux satisfaisant?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(63, 'Existe-t-il une salle d\'accueil pour les patients?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(64, 'Existe-t-il des espaces aménagés pour les accompagnants des malades?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(65, 'Existe-t-il une salle de consultation satisfaisant certaines commodités (hygième, intimité, confidentialité, éclairage etc..)?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(66, 'Existe-t-il une salle d\'hospitalisation pour les MTN (hygième, intimité, éclairage etc..)?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(67, 'Existe-t-il une salle de garde (hygième, intimité, éclairage etc..)?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(68, 'Existe-t-il une salle de soins adaptée aux MTN (hygième, intimité, éclairage etc..)?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(69, 'Existe-t-il un bloc opératoire avec plateau technique adapté aux soins MTN?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(70, 'Existe-t-il une salle de Kinésithérapie / orthoprothésiste?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(71, 'Existe-t-il un laboratoire?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(72, 'Existe-t-il un service d\'imagerie médicale?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(73, 'Existe-t-il une Pharmacie?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(74, 'Existe-t-il un accès aménagé adapté pour personnes handicapées?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(75, 'Existe-t-il un point d\'eau potable accessible aux personnels pour la prise en charge des cas?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(76, 'Existe-t-il un point d\'eau potable accessible aux patients?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(77, 'Existe-t-il un point d\'eau potable accessible aux accompagnants?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(78, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Hommes?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(79, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Femmes?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(80, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Hommes?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(81, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Femmes?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(82, 'Si oui, ces toilettes/latrines sont-elles compartimentées au genre?', 3, 1, '2025-02-11 16:27:59', '2025-02-11 16:27:59', NULL),
(83, 'Effectif d\'agents disponibles dans la structure par catégorie et profil? (Medecins/Chirurgiens/IDE/SF/AS)', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(84, 'Avez-vous été formé à la prise en charge des MTN?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(85, 'Avez-vous reçu une formation dans le cadre de la lutte anti vectorielle contre les MTN ?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(86, 'Si oui quelles étaient les MTN ciblées ?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(87, 'A quand remonte la dernière formation ?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(88, 'Combien de médecins ont été formés pour les MTN dans votre établissement?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(89, 'Existe-t-il des agents formés à la gestion des plaies et des cicatrices ?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(90, 'Existe-t-il des biologistes formés pour les MTN?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(91, 'Existe-t-il des SF/magnéticiens formés pour les MTN dans votre établissement?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(92, 'Existe-t-il des IDE formés pour les MTN dans votre établissement?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(93, 'Existe-t-il des ASC formés pour les MTN pour votre aire de santé?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(94, 'Existe-t-il des aides soignants/auxilliaires formés pour les MTN dans votre établissement?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(95, 'Existe-t-il des techniciens biologistes formés pour les MTN?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(96, 'Décrivez votre rôle dans la lutte contre les MTN?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(97, 'Présentation generale de la cour, bien entretenue? Etat général de la peinture des locaux satisfaisant?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(98, 'Existe-t-il une salle d\'accueil pour les patients?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(99, 'Existe-t-il des espaces aménagés pour les accompagnants des malades?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(100, 'Existe-t-il une salle de consultation satisfaisant certaines commodités (hygième, intimité, confidentialité, éclairage etc..)?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(101, 'Existe-t-il une salle de garde (hygième, intimité, éclairage etc..)?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(102, 'Existe-t-il une salle de soins adaptée aux MTN (hygième, intimité, éclairage etc..)?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(103, 'Existe-t-il un laboratoire?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(104, 'Existe-t-il une Pharmacie?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(105, 'Existe-t-il un accès aménagé adapté pour personnes handicapées?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(106, 'Existe-t-il un point d\'eau potable accessible aux personnels pour la prise en charge des cas?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(107, 'Existe-t-il un point d\'eau potable accessible aux patients?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(108, 'Existe-t-il un point d\'eau potable accessible aux accompagnants?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(109, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Hommes?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(110, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Femmes?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(111, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Hommes?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(112, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Femmes?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(113, 'Si oui, ces toilettes/latrines sont-elles compartimentées au genre?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(114, 'Existe-t-il des équipements pour le lavage des mains? (les patients, personnel et accompagnants)', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(115, 'Existe-t-il des équipements pour la gestion des déchets? (sachets adaptés, poubelles adaptées, boites de sécurité)', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(116, 'Existe-t-il de l\'électricité dans la structure?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(117, 'Existe-t-il une alternative en cas de coupure de l\'électricité (groupe électrogène/panneau solaire/batterie)?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(118, 'Existe-t-il un kit informatique fonctionnel? (tablette, ordinateur, imprimante, vidéoprojecteur)', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(119, 'Existe-t-il un matériel roulant pour les activités MTN en stratégie avancée?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(120, 'Existe-t-il une dotation en carburant pour mener les activités MTN en stratégie avancée?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(121, 'Existe-t-il une dotation pour l\'entretien/réparation du matériel roulant?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(122, 'Existe-t-il du matériel de mobilité accessible pour personnes handicapées? (fauteuil roulant et brancard)', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(123, 'Existe-t-il un équipement pour la gestion des déchets biomédicaux? Si oui, précisez: (1) fosse à brûlage?; (2) Incinérateur?', 4, 1, '2025-02-11 16:42:19', '2025-02-11 16:42:19', NULL),
(124, 'Effectif d\'agents disponibles dans la structure par catégorie et profil? (Medecins/Chirurgiens/IDE/SF/AS)', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(125, 'Avez-vous été formé à la prise en charge des MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(126, 'Avez-vous reçu une formation dans le cadre de la lutte anti vectorielle contre les MTN ?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(127, 'Si oui quelles étaient les MTN ciblées ?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(128, 'A quand remonte la dernière formation ?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(129, 'Combien de médecins ont été formés pour les MTN dans votre établissement?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(130, 'Combien de chirurgiens ont été formés pour les MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(131, 'Existe-t-il des chirurgiens certifiés dans la prise en charge des hydrocèles?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(132, 'Existe-t-il des agents formés à la prise en charge des trichiasis trachomateux (TT)?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(133, 'Existe-t-il des chirurgiens formés à la greffe de peau et à la chirurgie réparatrice?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(134, 'Existe-t-il des agents formés à la gestion des plaies et des cicatrices ?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(135, 'Existe-t-il des kinésistherapeutes formés ?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(136, 'Existe-t-il des orthoprothésistes formés pour les MTN dans votre établissement?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(137, 'Existe-t-il des biologistes formés pour les MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(138, 'Existe-t-il des infirmiers spécialistes formés pour les MTN dans votre établissement?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(139, 'Existe-t-il des CSE formés pour les MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(140, 'Existe-t-il des SF/magnéticiens formés pour les MTN dans votre établissement?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(141, 'Existe-t-il des IDE formés pour les MTN dans votre établissement?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(142, 'Existe-t-il des ASC formés pour les MTN pour votre aire de santé?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(143, 'Existe-t-il des aides soignants/auxilliaires formés pour les MTN dans votre établissement?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(144, 'Existe-t-il des techniciens biologistes formés pour les MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(145, 'Existe-t-il un point focal MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(146, 'Le point focal MTN est-il formé à la lutte contre les MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(147, 'Quelles sont les MTN pour lesquelles le point focal a été formé?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(148, 'Depuis combien d\'année le point focal a-t-il été formé à la lutte contre les MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(149, 'Par qui le point focal a-t-il été formé?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(150, 'Décrivez votre rôle dans la lutte contre les MTN?', 2, 1, '2025-02-11 17:00:19', '2025-02-11 17:00:19', NULL),
(151, 'Existe-t-il un accès aménagé adapté pour personnes handicapées?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(152, 'Existe-t-il un point d\'eau potable accessible aux personnels pour la prise en charge des cas?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(153, 'Existe-t-il un point d\'eau potable accessible aux patients?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(154, 'Existe-t-il un point d\'eau potable accessible aux accompagnants?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(155, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Hommes?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(156, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Femmes?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(157, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Hommes?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(158, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Femmes?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(159, 'Si oui, ces toilettes/latrines sont-elles compartimentées au genre?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(160, 'Existe-t-il des équipements pour le lavage des mains? (les patients, personnel et accompagnants)', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(161, 'Existe-t-il des équipements pour la gestion des déchets? (sachets adaptés, poubelles adaptées, boîtes de sécurité)', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(162, 'Existe-t-il de l\'électricité dans la structure?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(163, 'Existe-t-il une alternative en cas de coupure de l\'électricité (groupe électrogène/panneau solaire/batterie)?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(164, 'Existe-t-il un kit informatique fonctionnel? (tablette, ordinateur, imprimante, vidéoprojecteur)', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(165, 'Existe-t-il un matériel roulant pour les activités MTN en stratégie avancée?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(166, 'Existe-t-il une dotation en carburant pour mener les activités MTN en stratégie avancée?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(167, 'Existe-t-il une dotation pour l\'entretien/réparation du matériel roulant?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(168, 'Existe-t-il du matériel de mobilité accessible pour personnes handicapées? (fauteuil roulant et brancard)', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(169, 'Existe-t-il un équipement pour la gestion des déchets biomédicaux? Si oui, précisez: (1) fosse à brulage?; (2) Incinérateur?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(170, 'Existe-t-il un point focal communication et sensibilisation?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(171, 'Si oui, est-il formé sur toutes les MTN?', 5, 1, '2025-02-11 17:03:17', '2025-02-11 17:03:17', NULL),
(172, 'Effectif d\'agents disponibles dans la structure par catégorie et profil? (Medecins/Chirurgiens/IDE/SF/AS)', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(173, 'Avez-vous été formé à la prise en charge des MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(174, 'Si oui quelles étaient les MTN ciblées ?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(175, 'A quand remonte la dernière formation ?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(176, 'Combien de médecins ont été formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(177, 'Combien de chirurgiens ont été formés pour les MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(178, 'Existe-t-il des chirurgiens certifiés dans la prise en charge des hydrocèles?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(179, 'Existe-t-il des agents formés à la prise en charge des trichiasis trachomateux (TT)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(180, 'Existe-t-il des chirurgiens formés à la greffe de peau et à la chirurgie réparatrice?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(181, 'Existe-t-il des agents formés à la gestion des plaies et des cicatrices ?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(182, 'Existe-t-il des kinésithérapeutes formés ?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(183, 'Combien d\'ophtalmologues ont été formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(184, 'Combien de kinésistes ont été formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(185, 'Existe-t-il des orthoprothésistes formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(186, 'Existe-t-il des biologistes formés pour les MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(187, 'Existe-t-il des infirmiers spécialistes formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(188, 'Existe-t-il des CSE formés pour les MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(189, 'Existe-t-il des SF/magnéticiens formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(190, 'Existe-t-il des IDE formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(191, 'Existe-t-il des aides soignants/auxilliaires formés pour les MTN dans votre établissement?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(192, 'Existe-t-il des techniciens biologistes formés pour les MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(193, 'Par qui le point focal a-t-il été formé?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(194, 'Décrivez votre rôle dans la lutte contre les MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(195, 'Présentation générale de la cour, bien entretenue? Etat général de la peinture des locaux satisfaisant?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(196, 'Existe-t-il une salle d\'accueil pour les patients?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(197, 'Existe-t-il des espaces aménagés pour les accompagnants des malades?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(198, 'Existe-t-il une salle de consultation satisfaisant certaines commodités (hygiène, intimité, confidentialité, éclairage etc..)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(199, 'Existe-t-il une salle d\'hospitalisation pour les MTN (hygiène, intimité, éclairage etc..)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(200, 'Existe-t-il une salle de garde (hygiène, intimité, éclairage etc..)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(201, 'Existe-t-il une salle de soins adaptée aux MTN (hygiène, intimité, éclairage etc..)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(202, 'Existe-t-il un bloc opératoire avec plateau technique adapté aux soins MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(203, 'Existe-t-il une salle de Kinésithérapie / orthoprothésiste?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(204, 'Existe-t-il un laboratoire?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(205, 'Existe-t-il un service d\'imagerie médicale?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(206, 'Existe-t-il une Pharmacie?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(207, 'Existe-t-il un accès aménagé adapté pour personnes handicapées?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(208, 'Existe-t-il un point d\'eau potable accessible aux personnels pour la prise en charge des cas?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(209, 'Existe-t-il un point d\'eau potable accessible aux patients?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(210, 'Existe-t-il un point d\'eau potable accessible aux accompagnants?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(211, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Hommes?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(212, 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients Femmes?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(213, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Hommes?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(214, 'Existe-t-il des toilettes/latrines fonctionnelles pour le personnel Femmes?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(215, 'Si oui, ces toilettes/latrines sont-elles compartimentées au genre?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(216, 'Existe-t-il des équipements pour le lavage des mains? (les patients, personnel et accompagnants)', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(217, 'Existe-t-il des équipements pour la gestion des déchets? (sachets adaptés, poubelles adaptées, boîtes de sécurité)', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(218, 'Existe-t-il de l\'électricité dans la structure?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(219, 'Existe-t-il une alternative en cas de coupure de l\'électricité (groupe électrogène/panneau solaire/batterie)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(220, 'Existe-t-il un kit informatique fonctionnel? (tablette, ordinateur, imprimante, vidéoprojecteur)', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(221, 'Existe-t-il un matériel roulant pour les activités MTN en stratégie avancée?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(222, 'Existe-t-il une dotation en carburant pour mener les activités MTN en stratégie avancée?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(223, 'Existe-t-il une dotation pour l\'entretien/réparation du matériel roulant?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(224, 'Existe-t-il du matériel de mobilité accessible pour personnes handicapées? (fauteuil roulant et brancard)', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(225, 'Existe-t-il un équipement pour la gestion des déchets biomédicaux? Si oui, précisez: (1) fosse à brulage?; (2) Incinérateur?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(226, 'Existe-t-il un point focal communication et sensibilisation?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(227, 'Si oui, est-il formé sur toutes les MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(228, 'Disposez-vous de matériels de communication pour la conduite des activités de sensibilisation MTN (mégaphone, hoofer, etc.)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(229, 'Disposez-vous de supports de sensibilisation pour la conduite des activités MTN (affiches, dépliants, boîtes à image, PAD, kakemonos, etc.)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(230, 'Existe-t-il un plan d\'action de communication/sensibilisation qui intègre les activités MTN?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(231, 'Existe-t-il une collaboration formelle avec les organes de presse locale (convention avec les radios de proximité, presse écrite, réseaux sociaux)?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL),
(232, 'Si oui, existe-t-il un financement pour soutenir cette collaboration?', 1, 1, '2025-02-11 17:25:41', '2025-02-11 17:25:41', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

CREATE TABLE `contenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_contenu` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=Hotital General MTN, 2=ECD, 3=CHR, 4=ESPC, 5=Hotipal General',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contenus`
--

INSERT INTO `contenus` (`id`, `name_contenu`, `type`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nombre d’agent par catégorie', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(2, 'Ancienneté', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(3, 'Rôle attribué (prestation)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(4, 'Besoins en formation', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(5, 'Environnement/ Signalisation / Espaces pour les visiteurs/clients', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(6, 'Salle de consultation', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(7, 'Salle d’hospitalisation', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(8, 'Salle de garde', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(9, 'Salle de soins/pansement', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(10, 'Bloc opératoire', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(11, 'Salle de Kinésithérapie / orthoprothésiste', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(12, 'Laboratoire', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(13, 'Imagerie médicale', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(14, 'Pharmacie', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(15, 'Accès aménagé pour personnes handicapées', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(16, 'Wash (Source d’eau potable, Toilettes, douche, hygiène, etc.)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(17, 'Electricité et alternatives', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(18, 'Equipements de bureau', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(19, 'Materiels roulants (moto, véhicule)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(20, 'Materiels de mobilité pour personnes handicapées', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(21, 'Incinérateur/fosse à brulage', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(22, 'Procédure accueil et référence', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(23, 'Modules de formation des agents de santé', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(24, 'Existence d’un point focal communication formé sur les thématiques MTN', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(25, 'Matériels et outils de sensibilisation (feuille de route de sensibilisation, support de sensibilisation, etc.)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(26, 'Espace aménagé pour la sensibilisation', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(27, 'Disponibilité d’un programme de sensibilisation (convention avec les média), etc.', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(28, 'Active / Passive, stratégie avancée, routine, campagne intégrée, communautaire', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(29, 'Campagne (masse)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(30, 'Routine (traitement des sujets-contact, autres)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(31, 'Directives et normes (diagnostic, traitement, suivi, conseils)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(32, 'Directives et normes de prévention des incapacités', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(33, 'Directives et normes de réparation des séquelles', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(34, 'Directives et normes du plateau technique pour la PEC de chaque état morbide', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(35, 'Directives et normes de système de référence et contre référence', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(36, 'Existence d’un partenariat actif (multisectorialité)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(37, 'Agents formés (traitement des marres, pose des pièges, utilisation des MILDA, etc.)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(38, 'Stratégies déployées', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(39, 'logistique et chaîne d’approvisionnement', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(40, 'Agents formés', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(41, 'Tri des déchets', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(42, 'Incinerateur', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(43, 'Fosse à ordure', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(44, 'Matériels de collecte', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(45, 'Diagnostic', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(46, 'Laboratoire de référence', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(47, 'Circuit de transmission des échantillons et des résultats', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(48, 'Intrants pour la collecte des échantillons, tests', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(49, 'Imagerie', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(50, 'Disponibilité des Procédures opératoires standards (POS)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(51, 'Ecoute, suivi, conseil', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(52, 'Agents formés', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(53, 'Confidentialité', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(54, 'Référence si besoin', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(55, 'Projet (PTF)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(56, 'Accès aménagé', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(57, 'Mise en place d’un système de recueil des plaintes', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(58, 'Sensibilisation communautaire pour la levée des barrières culturelles', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(59, 'Formation et mise à niveau', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(60, 'Outils mis à disposition', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(61, 'Réunion de suivi', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(62, 'Planning de supervision', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(63, 'Rapport de supervision', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(64, 'Système d’alerte établi à partir de l’analyse des données collectées', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(65, 'Existence d’une collaboration formelle intersectorielle pour la lutte contre les MTN', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(66, 'Investigation des rumeurs de cas', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(67, 'Disponibilité des Tests de Diagnostic Rapide (TDR) (pian, THA,)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(68, 'Disponibilité et utilisation des outils de collecte de données', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(69, 'Transmission des rapports au district et au programmes (Promptitude, Complétude)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(70, 'Archivage des fiches', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(71, 'Disponibilité des données du site supervisé/district sanitaire dans DHIS 2', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(72, 'Analyse et utilisation des données sur site de production des données', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(73, 'Retro information', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(74, 'Satisfaction des critères d’un bon site de stage (conditions de stage)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(75, 'Existence d’encadreurs dans les sites de stage', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(76, 'Nombre d’encadreurs formés', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(77, 'Nombre de stagiaires encadrés', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(78, 'Niveau d’études des stagiaires (auxiliaires, IDE, SF, TSS, spécialistes MTN)', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(79, 'Qualité de l\'encadrement des stagiaires', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL),
(80, 'Rapports de stage', 1, 1, '2025-02-11 18:08:10', '2025-02-11 18:08:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE `domaines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_domaine` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=Hotital General MTN, 2=ECD, 3=CHR, 4=ESPC, 5=Hotipal General',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id`, `name_domaine`, `type`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ressources humaines formées à la lutte contre les MTN', 1, 1, '2025-02-11 18:02:40', '2025-02-11 18:02:40', NULL),
(2, 'Infrastructures (mobiliers, immobiliers, plateaux techniques, matériels informatiques, roulants, logistique)', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(3, 'Documents de normes et de procédures', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(4, 'Communication pour le changement de comportement / IEC', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(5, 'Détection des cas de morbidité', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(6, 'Distribution de médicaments', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(7, 'Prise en charge des morbidités', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(8, 'Lutte anti vectorielle', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(9, 'Gestion des médicaments', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(10, 'Gestion des déchets', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(11, 'Confirmation des cas', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(12, 'Soutien psychologique', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(13, 'Réinsertion socio-économique', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(14, 'Lutte contre la stigmatisation et promotion de l’inclusion', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(15, 'Supervision des Agents de santé communautaire', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(16, 'Surveillance', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(17, 'Rapportage', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL),
(18, 'Encadrement de stagiaires', 1, 1, '2025-02-11 18:02:41', '2025-02-11 18:02:41', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

CREATE TABLE `etablissements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direction_regionale` varchar(255) NOT NULL,
  `district_sanitaire` varchar(255) NOT NULL,
  `etablissement_sanitaire` varchar(255) NOT NULL,
  `categorie_etablissement` varchar(255) NOT NULL,
  `code_etablissement` varchar(255) NOT NULL,
  `periode` varchar(255) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `direction_regionale`, `district_sanitaire`, `etablissement_sanitaire`, `categorie_etablissement`, `code_etablissement`, `periode`, `date_debut`, `date_fin`, `responsable`, `telephone`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Abidjan-Lagunes', 'qwerty', 'qwerty', 'clinique', 'code code', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-14 15:22:37', '2025-02-14 15:22:37', NULL),
(2, 'Abidjan-Lagunes', 'qwerty', 'qwerty', 'hopital', 'code code  code', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-14 15:33:21', '2025-02-14 15:33:21', NULL),
(3, 'Abidjan-Lagunes', 'qwerty', 'qwerty', 'centre_sante', 'code code codo deo', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-14 15:34:49', '2025-02-14 15:34:49', NULL),
(4, 'Abidjan-Lagunes', 'qwerty', 'qwerty', 'centre_sante', 'CoD6733', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-14 15:46:22', '2025-02-14 15:46:22', NULL),
(5, 'bvcvbhj', 'qwerty', 'ssss', 'centre_sante', 'dgte', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-16 20:26:59', '2025-02-16 20:26:59', NULL),
(6, 'Abidjan-Lagunes', 'qwerty', 'qwerty', 'Centre de santé', 'code code codo deo. v', 'hvh', '2025-11-30', '2025-11-30', 'stanislas beyra', '0141450517', 'beyrastanislas@gmail.com', '2025-02-16 20:28:56', '2025-02-16 20:28:56', NULL),
(7, 'Abidjan-Lagunes', 'qwerty', 'dgtee', 'Clinique', 'mjhvcvbnm', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-16 20:29:36', '2025-02-16 20:29:36', NULL),
(8, 'Abidjan-Lagunes', 'qwerty', 'ssss', 'Centre de santé', 'xcvbnjkl;', 'hvh', '2025-11-30', '2025-11-30', 'stanislas beyra', '0141450517', 'beyrastanislas@gmail.com', '2025-02-16 20:30:09', '2025-02-16 20:30:09', NULL),
(9, 'Abidjan-Lagunes', 'qwerty', 'qwerty', 'Centre de santé', 'code code codo deo 765345', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-16 21:04:51', '2025-02-16 21:04:51', NULL),
(10, 'Abidjan-Lagunes', 'qwerty', 'qwerty', 'Hôpital', 'code code 9876543', 'hvh', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-16 21:11:00', '2025-02-16 21:11:00', NULL),
(11, 'Abidjan-Lagunes gfdfgh', 'qwerty', 'qwerty', 'Centre de santé', 'code code 7654', 'hvh bb', '2025-11-30', '2025-11-30', 'beyra stanislas', '0141450517', 'angelabeub78@gmail.com', '2025-02-16 21:16:26', '2025-02-16 21:16:26', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `methodes`
--

CREATE TABLE `methodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `methode_name` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `methodes`
--

INSERT INTO `methodes` (`id`, `methode_name`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'entretien / revue documentaire', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(2, 'Entretien', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(3, 'Entretien, revue documentaire', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(4, 'entretien et observation', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(5, 'entretien et vérification', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(6, 'Entretien/Vérification', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(7, 'Entretien/Observation', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(8, 'Entretien/Verification', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(9, 'Revue documentaire', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58'),
(10, 'Observation', 1, NULL, '2025-02-11 18:12:58', '2025-02-11 18:12:58');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_02_11_143621_all_table_migration', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note_name` varchar(255) NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `note_name`, `value`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pas satisfaisant', 0.00, 1, NULL, '2025-02-11 18:14:37', '2025-02-11 18:14:37'),
(2, 'Besoin d\'amélioration', 1.00, 1, NULL, '2025-02-11 18:14:37', '2025-02-11 18:14:37'),
(3, 'Satisfaisant', 2.00, 1, NULL, '2025-02-11 18:14:37', '2025-02-11 18:14:37');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `problemes`
--

CREATE TABLE `problemes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `probleme` text NOT NULL,
  `causes` text NOT NULL,
  `actions` text NOT NULL,
  `sources` text NOT NULL,
  `acteurs` varchar(255) NOT NULL,
  `ressources` varchar(255) NOT NULL,
  `delai` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `problemes`
--

INSERT INTO `problemes` (`id`, `probleme`, `causes`, `actions`, `sources`, `acteurs`, `ressources`, `delai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'mnb n', 'mnbn', 'hjkj', 'kjhj', 'mnb', 'jhnbhj', '2025-02-12 22:56:00', '2025-02-16 22:56:25', '2025-02-16 22:56:25', NULL),
(2, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(3, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(4, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(5, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(6, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(7, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(8, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(9, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(10, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(11, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(12, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(13, 'qwerty', 'qwert', 'qwertyht', 'qwert', 'qwert', 'qwert', '2025-03-02 12:00:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(14, 'aasdfd', 'dvf', 'sdvf', 'sdsfdg', 'sadf', 'sdf', '2025-02-14 22:56:00', '2025-02-16 23:05:52', '2025-02-16 23:05:52', NULL),
(15, 'ty', 'xc', 'xg', 'xx', 'df', 'ff', '2025-02-16 23:57:00', '2025-02-16 23:57:17', '2025-02-16 23:57:17', NULL),
(16, 'ty', 'xc', 'xg', 'xx', 'df', 'ff', '2025-02-16 23:57:00', '2025-02-16 23:57:17', '2025-02-16 23:57:17', NULL),
(17, 'tug', 'hhh', 'ghh', 'ggg', 'fg', 'cc', '2023-08-13 23:56:00', '2025-02-17 00:33:43', '2025-02-17 00:33:43', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `supervisers`
--

CREATE TABLE `supervisers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `fonction` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `supervisers`
--

INSERT INTO `supervisers` (`id`, `firstname`, `lastname`, `fonction`, `phone`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'John', 'Doe', 'Developer', '1234567890', 'john.doe@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(2, 'Jane', 'Smith', 'Designer', '2345678901', 'jane.smith@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(3, 'Alice', 'Johnson', 'Manager', '3456789012', 'alice.johnson@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(4, 'Bob', 'Brown', 'Developer', '4567890123', 'bob.brown@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(5, 'Charlie', 'Davis', 'Developer', '5678901234', 'charlie.davis@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(6, 'Eve', 'Miller', 'Designer', '6789012345', 'eve.miller@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(7, 'Grace', 'Wilson', 'Manager', '7890123456', 'grace.wilson@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(8, 'Hank', 'Moore', 'Developer', '8901234567', 'hank.moore@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(9, 'Ivy', 'Taylor', 'Manager', '9012345678', 'ivy.taylor@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(10, 'Jack', 'Anderson', 'Developer', '0123456789', 'jack.anderson@example.com', '2025-02-17 11:42:29', '2025-02-17 11:42:29', NULL),
(11, 'beyra stanislas', NULL, 'infirmiere', '0141450517', 'angelabeub78@gmail.com', '2025-02-17 13:46:45', '2025-02-17 13:46:45', NULL),
(12, 'beyra stanislas', NULL, 'Developer', '0758682807', 'llsenteurplus@gmail.com', '2025-02-17 13:56:15', '2025-02-17 13:56:15', NULL),
(13, 'beyra stanislas', NULL, 'Developers', '0758682807', 'llsenteurplus@gmail.com', '2025-02-17 14:09:16', '2025-02-17 14:09:16', NULL),
(14, 'beyra stanislas dgdhyeb', NULL, '123456', '0141450510', 'angelabeub478@gmail.com', '2025-02-17 14:28:54', '2025-02-17 14:28:54', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `superviseurs`
--

CREATE TABLE `superviseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `fonction` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `superviseurs`
--

INSERT INTO `superviseurs` (`id`, `firstname`, `lastname`, `fonction`, `phone`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'John', 'Doe', 'Manager', '1234567890', 'john.doe@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(2, 'Jane', 'Smith', 'Developer', '0987654321', 'jane.smith@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(3, 'Alice', 'Johnson', 'Designer', '1231231234', 'alice.johnson@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(4, 'Bob', 'Brown', 'QA Tester', '2342342345', 'bob.brown@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(5, 'Charlie', 'Davis', 'Product Owner', '3453453456', 'charlie.davis@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(6, 'Eve', 'Miller', 'HR Manager', '4564564567', 'eve.miller@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(7, 'David', 'Wilson', 'System Architect', '5675675678', 'david.wilson@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(8, 'Grace', 'Moore', 'Support', '6786786789', 'grace.moore@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(9, 'Henry', 'Taylor', 'Marketing', '7897897890', 'henry.taylor@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(10, 'Isabelle Johnson', 'Anderson', 'Sales', '8908908901', 'isabelle.anderson@example.com', '2025-02-17 14:32:14', '2025-02-17 14:32:14', NULL),
(11, 'beyra stanislas', NULL, 'infirmiere', '0141450517', 'angelabeub78@gmail.com', '2025-02-17 14:35:14', '2025-02-17 14:35:14', NULL),
(12, 'Isabelle', NULL, 'Sales', '8908908901', 'isabelle.a3nderson@example.com', '2025-02-17 14:36:19', '2025-02-17 14:36:19', NULL),
(13, 'Isabelle', NULL, 'Sales', '8908908901', 'isabelle.3anderson@example.com', '2025-02-17 14:37:12', '2025-02-17 14:37:12', NULL),
(14, 'beyra stanislas 99', NULL, 'docteur', '0141450588', 'angelabeub783@gmail.com', '2025-02-17 14:58:18', '2025-02-17 14:58:18', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `supervisions`
--

CREATE TABLE `supervisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domaine` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `methode` varchar(255) NOT NULL,
  `reponse` text NOT NULL,
  `note` decimal(8,2) NOT NULL,
  `commentaire` text NOT NULL,
  `etablissements` longtext NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `type` int(18) DEFAULT 0 COMMENT '1=>Element d''environnement; 2=>Element de compétance',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `supervisions`
--

INSERT INTO `supervisions` (`id`, `domaine`, `contenu`, `question`, `methode`, `reponse`, `note`, `commentaire`, `etablissements`, `active`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Informatique', 'Audit des systèmes', 'Quels logiciels sont utilisés ?', 'Entretien', 'Logiciels standards identifiés', 15.75, 'Examen des licences en cours', 'Université de Paris', 1, 0, NULL, '2025-02-13 22:09:12', '2025-02-13 22:09:12'),
(2, '18', '79', '231', '1', 'qwerty', 3.00, 'mnbv', 'Hotital General MTN', 1, 0, NULL, '2025-02-13 23:58:41', '2025-02-13 23:58:41'),
(3, '17', '80', '149', '2', 'tete33', 2.00, '566', 'ECD', 1, 0, NULL, '2025-02-14 00:05:06', '2025-02-14 00:05:06'),
(4, '17', '79', '171', '1', 'kjhgh', 2.00, 'kjhj', 'Hotipal General', 1, 0, NULL, '2025-02-14 00:12:27', '2025-02-14 00:12:27'),
(5, '17', '79', '116', '1', 'mbbn', 2.00, 'kjhghj', 'ESPC', 1, 0, NULL, '2025-02-14 00:20:53', '2025-02-14 00:20:53'),
(6, '17', '80', '73', '10', 'qwerty', 1.00, 'kjhgcfg', 'CHR', 1, 0, NULL, '2025-02-14 00:22:21', '2025-02-14 00:22:21'),
(7, '16', '73', '145', '6', 'BeyraTeste', 2.00, 'Nouveau de hors line', 'ECD', 1, 0, NULL, '2025-02-14 00:26:01', '2025-02-14 00:26:01'),
(8, '17', '73', '103', '6', 'oui oui', 1.00, 'nonon', 'ESPC', 1, 0, NULL, '2025-02-14 00:30:39', '2025-02-14 00:30:39'),
(9, '17', '79', '169', '2', 'kjhghj', 3.00, ',jh', 'Hotipal General', 1, 0, NULL, '2025-02-14 00:34:07', '2025-02-14 00:34:07'),
(10, '14', '77', '148', '3', 'obv', 2.00, 'obv testing', 'ECD', 1, 0, NULL, '2025-02-14 00:36:27', '2025-02-14 00:36:27'),
(11, '16', '78', '80', '3', 'jhghj', 2.00, 'mjhghj', 'CHR', 1, 0, NULL, '2025-02-14 00:41:48', '2025-02-14 00:41:48'),
(12, '16', '78', '230', '3', 'qwerty oui oui oui', 3.00, 'oui oui oui', 'Hotital General MTN', 1, 0, NULL, '2025-02-14 14:48:46', '2025-02-14 14:48:46'),
(13, '16', '78', '229', '3', '.lkjhgfghjkl', 1.00, 'liuytrdfghjk', 'Hotital General MTN', 1, 0, NULL, '2025-02-14 14:50:01', '2025-02-14 14:50:01'),
(14, '15', '76', '144', '4', ',kjhgfghjk', 2.00, ',kjhbnjk', 'ECD', 1, 0, NULL, '2025-02-14 14:50:01', '2025-02-14 14:50:01'),
(15, '13', '77', '80', '4', 'mnhbgvcvbnm', 2.00, 'mjhgfghjk', 'CHR', 1, 0, NULL, '2025-02-14 14:50:01', '2025-02-14 14:50:01'),
(16, '17', '79', '228', '2', 'qwerty', 2.00, 'hghu', 'Hotital General MTN', 1, 0, NULL, '2025-02-14 15:53:28', '2025-02-14 15:53:28'),
(17, '16', '79', '232', '3', 'mnbvbnm', 2.00, 'mnbn', 'Hotital General MTN', 1, 0, NULL, '2025-02-15 23:13:47', '2025-02-15 23:13:47'),
(18, '17', '78', '149', '3', 'nbvcx', 2.00, 'mnbv', 'ECD', 1, NULL, NULL, '2025-02-15 23:25:04', '2025-02-15 23:25:04'),
(19, '14', '78', '146', '4', 'qwerty', 2.00, 'jhgffgh', 'ECD', 1, 1, NULL, '2025-02-15 23:29:12', '2025-02-15 23:29:12'),
(20, '15', '77', '145', '1', 'nbvc', 2.00, 'mnbv', 'ECD', 1, 2, NULL, '2025-02-15 23:32:34', '2025-02-15 23:32:34'),
(21, '16', '78', '230', '3', 'qwerty', 2.00, 'mjhgfdfg', 'Hotital General MTN', 1, 2, NULL, '2025-02-16 19:34:39', '2025-02-16 19:34:39'),
(22, '13', '74', '230', '3', 'mjhgfgh', 1.00, 'jhghj', 'Hotital General MTN', 1, 2, NULL, '2025-02-16 19:34:39', '2025-02-16 19:34:39'),
(23, '10', '72', '227', '5', 'qwerty', 2.00, 'mncv', 'Hotital General MTN', 1, 2, NULL, '2025-02-16 19:34:39', '2025-02-16 19:34:39'),
(24, '18', '78', '228', '2', 'qwerty oui oui oui', 2.00, 'jhgfgh', 'Hotital General MTN', 1, 2, NULL, '2025-02-16 19:53:32', '2025-02-16 19:53:32'),
(25, '17', '73', '227', '2', 'qwerty oui oui oui', 2.00, 'jhgfgh', 'Hotital General MTN', 1, 1, NULL, '2025-02-16 19:54:08', '2025-02-16 19:54:08'),
(26, '17', '77', '148', '2', 'mnbv', 2.00, ',.kjhbv', 'ECD', 1, 2, NULL, '2025-02-16 20:21:20', '2025-02-16 20:21:20'),
(27, '16', '78', '80', '3', 'qwerty oui oui oui', 1.00, 'mnbvbn', 'CHR', 1, 2, NULL, '2025-02-16 20:21:42', '2025-02-16 20:21:42'),
(28, '14', '78', '145', '3', 'nbvvbn', 2.00, 'nbvbn', 'ECD', 1, 2, NULL, '2025-02-16 20:22:11', '2025-02-16 20:22:11'),
(29, '16', '78', '147', '3', 'qwerty oui oui oui', 1.00, 'nbvbn', 'ECD', 1, 2, NULL, '2025-02-16 20:22:46', '2025-02-16 20:22:46'),
(30, '15', '76', '148', '3', 'qwerty oui oui oui', 3.00, 'nbvcvb', 'ECD', 1, 1, NULL, '2025-02-16 20:25:41', '2025-02-16 20:25:41'),
(31, '17', '79', '231', '2', 'gdg', 1.00, 'mnnm', 'Hotital General MTN', 1, 1, NULL, '2025-02-17 14:21:05', '2025-02-17 14:21:05');

-- --------------------------------------------------------

--
-- Structure de la table `syntheses`
--

CREATE TABLE `syntheses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domaine` varchar(255) NOT NULL,
  `points_disponibles` int(11) NOT NULL DEFAULT 4,
  `points_obtenus` decimal(5,2) NOT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'État de l''utilisateur, 1 pour actif, 0 pour inactif',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alluquestions`
--
ALTER TABLE `alluquestions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etablissements`
--
ALTER TABLE `etablissements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_etablissement` (`code_etablissement`),
  ADD KEY `etablissements_deleted_at_index` (`deleted_at`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `methodes`
--
ALTER TABLE `methodes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `problemes`
--
ALTER TABLE `problemes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problemes_deleted_at_index` (`deleted_at`);

--
-- Index pour la table `supervisers`
--
ALTER TABLE `supervisers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `superviseurs_deleted_at_index` (`deleted_at`);

--
-- Index pour la table `superviseurs`
--
ALTER TABLE `superviseurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `superviseurs_deleted_at_index` (`deleted_at`);

--
-- Index pour la table `supervisions`
--
ALTER TABLE `supervisions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `syntheses`
--
ALTER TABLE `syntheses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alluquestions`
--
ALTER TABLE `alluquestions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT pour la table `contenus`
--
ALTER TABLE `contenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `etablissements`
--
ALTER TABLE `etablissements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `methodes`
--
ALTER TABLE `methodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `problemes`
--
ALTER TABLE `problemes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `supervisers`
--
ALTER TABLE `supervisers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `superviseurs`
--
ALTER TABLE `superviseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `supervisions`
--
ALTER TABLE `supervisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `syntheses`
--
ALTER TABLE `syntheses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
