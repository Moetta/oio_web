-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 nov. 2017 à 15:25
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `owlinone`
--

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `ID_LOGIN` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`ID_LOGIN`, `login`, `password`) VALUES
(1, 'owlblackbde', '*F2E84D3EB14990103E2'),
(2, 'actucliq', '*F2E84D3EB14990103E2');

-- --------------------------------------------------------

--
-- Structure de la table `tab_appart`
--

DROP TABLE IF EXISTS `tab_appart`;
CREATE TABLE IF NOT EXISTS `tab_appart` (
  `ID_APPART` int(5) NOT NULL AUTO_INCREMENT,
  `NOM_PROP` varchar(50) DEFAULT NULL,
  `ADRESSE_APPART` varchar(100) DEFAULT NULL,
  `VILLE_APPART` varchar(50) DEFAULT NULL,
  `DESCRIP_APPART` varchar(20) DEFAULT NULL,
  `DETAIL_APPART` text,
  `TELEPHONE_PROP` varchar(10) DEFAULT NULL,
  `PRIX_APPART` int(4) DEFAULT NULL,
  `DISPO_APPART` varchar(30) DEFAULT NULL,
  `CP_APPART` varchar(5) DEFAULT NULL,
  `LONGITUDE_APPART` float DEFAULT NULL,
  `LATITUDE_APPART` float DEFAULT NULL,
  `ADRESSE_MAIL` varchar(40) DEFAULT NULL,
  `COM_SIGNALER` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_APPART`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_appart`
--

INSERT INTO `tab_appart` (`ID_APPART`, `NOM_PROP`, `ADRESSE_APPART`, `VILLE_APPART`, `DESCRIP_APPART`, `DETAIL_APPART`, `TELEPHONE_PROP`, `PRIX_APPART`, `DISPO_APPART`, `CP_APPART`, `LONGITUDE_APPART`, `LATITUDE_APPART`, `ADRESSE_MAIL`, `COM_SIGNALER`) VALUES
(168, 'M. ÉÀ', '30 rue Paul verlaine ', 'ANGERS', 'Studio 400 m²', 'éà', '0606060606', 800, 'Signaler', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', 'numéro faux'),
(169, 'M. COPPIN', '30 rue Paul verlaine', 'ANGERS', 'F2 58 m²', 'piscine, garage disponible', '0606060606', 580, 'Vendu', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(170, 'M. COPPIN', '17 rue franklin', 'ANGERS', 'Studio 40 m²', 'top', '0606060606', 400, 'Signaler', '49100', -0.54359, 47.4677, 'camille.gayraud.damboise@gmail.com', 'wrong number'),
(171, 'M. DOUDOU', '30 rue Paul verlaine', 'ANGERS', 'T6 1500 m²', 'very cool bro', '0606060606', 600, 'Vendu', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(173, 'M. DUPOND', '17 rue franklin ', 'ANGERS', 'T3 70 m²', 'piscine, garage pour 10€/mois, belle vue', '0645784915', 680, 'Signaler', '49100', -0.54359, 47.4677, 'dupond@orange.fr', 'mauvais numero'),
(174, 'M. BERNARD', '16 rue barra', 'ANGERS', 'T2 65 m²', 'charges comprises, internet aussi', '0689754312', 670, 'Signaler', '49100', -0.564076, 47.4824, 'bernard@gmail.com', 'mauvais numéro '),
(175, 'M. GAUBERT', '11 rue de la marmitiere', 'SAINT BARTHÉLÉMY D\'ANJOU ', 'T2 bis 55 m²', 'petit jardin. possibilité de faire un potager. 1 place de parking.', '0689451243', 450, 'Vendu', '49124', -0.493082, 47.4723, 'gaubert@sfr.fr', 'RAS'),
(176, 'M. FENEUIL', '3 rue de la paperie', 'TRÉLAZÉ', 'T1 bis 30 m²', 'endroit calme, parfait pour un étudiant studieux. ', '0613467945', 400, 'Vendu', '49800', -0.511389, 47.4584, 'feneuil@gmail.com', 'RAS'),
(177, 'M. RIGAL', '126 rue chèvre', 'ANGERS', 'T2 48 m²', 'belle résidence rénové l\'année dernière. envoyez un mail pour des précisions. ', '0748152653', 450, 'Signaler', '49100', -0.540338, 47.4581, 'alexandre.rigal@aliceadsl.fr', 'mauvais numero'),
(178, 'M. FERNANDEZ', '4 rue auguste gautier', 'ANGERS', 'T3 47 m²', 'chauffage électrique, belle vue.', '0645734916', 500, 'Vendu', '49100', -0.560457, 47.4646, 'auberto.fernandez@gmail.com', 'RAS'),
(179, 'M. DANIEL', '38 rue des ponts de ce', 'ANGERS', 'F1 34 m²', 'ras', '0679451234', 570, 'Vendu', '49100', -0.542365, 47.4565, 'daniel.fourettier@gmail.com', 'RAS'),
(180, 'M. MARCEL', '30 rue Paul verlaine', 'ANGERS', 'T2 58 m²', 'bon etat ', '0678451223', 500, 'Disponible', '49100', -0.522122, 47.4614, 'marcel@gmail.com', 'RAS'),
(181, 'M. GG', '30 rue Paul verlaine', 'ANGERS', 'Studio 50 m²', 'top', '0689562356', 400, 'Vendu', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(182, 'M. TOTO', '3', 'ANGERS', 'Studio 50 m²', 'top', '0606060606', 400, 'Vendu', '49100', -0.561193, 47.479, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(183, 'M. TOTO', '3', 'ANGERS', 'Studio 50 m²', 'top', '0606060606', 400, 'Vendu', '49100', -0.561193, 47.479, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(184, 'M. TOTO', '3', 'ANGERS', 'Studio 50 m²', 'top', '0606060606', 400, 'Vendu', '49100', -0.561193, 47.479, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(185, 'M. COCO', 'ato', 'ANGERS', 'Studio 40 m²', 'e', '0606060606', 500, 'Vendu', '49100', -0.534317, 47.4483, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(186, 'M. TOTO', '30 rue Paul verlaine', 'ANGERS', 'Studio 40 m²', 'top', '0606060606', 500, 'Signaler', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', 'mauvais numero '),
(187, 'M. NICOLAS', '30 rue Paul verlaine', 'ANGERS', 'T2 50 m²', 'top !', '0606060606', 500, 'Vendu', '49100', 0, 0, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(188, 'M. TEST', '30 rue Paul verlaine', 'ANGERS ', 'T2 bis 40 m²', 'top!', '0606060606', 490, 'Disponible', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(189, 'M. CHRUS', '30 rue Paul verlaine ', 'ANGERS', 'Studio 40 m²', 'top', '0606060606', 400, 'Disponible', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', NULL),
(190, 'M. COPPIN', '4 rue vivaldi', 'ALBI', 'F2 45 m²', 'rien  dire', '0689561346', 400, 'Non disponible', '81990', 2.20634, 43.915, 'camille.gayraud.damboise@gmail.com', 'RAS'),
(191, 'M. COPPIN', '4 rue d\'Albi ', 'ALBI', 'Studio 45 m²', 'jjjj', '0606060606', 400, 'Disponible', '81000', 2.33102, 43.8964, 'camille.gayraud.damboise@gmail.com', NULL),
(192, 'M. \'ÀJDO', '4 rue d\'Albi ', 'ALBI', 'Studio 40 m²', 'à\'fosbfg', '0659865976', 800, 'Disponible', '81000', 2.33102, 43.8964, 'camille.gayraud.damboise@gmail.com', NULL),
(193, 'M. FKFKF', '4 rue vivaldi', 'lescure d\'albigeois ', 'Studio 45 m²', 'eirbcc', '0606060606', 100, 'Disponible', '81990', 2.20634, 43.915, 'camille.gayraud.damboise@gmail.com', NULL),
(194, 'M. COPPIN', '4 rue d\'Albi ', 'cambon d\'albi ', 'Studio 45 m²', 'fg', '0606060606', 600, 'Disponible', '81990', 2.21204, 43.9128, 'camille.gayraud.damboise@gmail.com', NULL),
(195, 'M. FKFK', '4', 'albi', 'Studio 45 m²', 'ff', '0606060606', 400, 'Disponible', '81990', 2.18213, 43.8987, 'camille.gayraud.damboise@gmail.com', NULL),
(196, 'M. FHRHFB', '30 rue Paul verlaine', 'ANGERS', 'Studio 45 m²', 'fjfbf', '0606060606', 787, 'Disponible', '49100', -0.522122, 47.4614, 'camille.gayraud.damboise@gmail.com', NULL),
(197, 'M. PIERRE', 'rue du 8 mai 1945', 'SAINT BARTHÉLEMY D\'ANJOU', 'Studio 50 m²', 'd', '0606060606', 600, 'Disponible', '49124', -0.501551, 47.4612, 'anthony.coppin@hotmail.fr', NULL),
(198, 'M. RORO', '', '', 'Studio 40 m²', 'dkd', '0606060606', 500, 'Disponible', '49000', -0.517146, 47.5018, 'anthony.coppin@hotmail.fr', NULL),
(199, 'MME ELSA', '3 rue boylesve', 'ANGERS', 'T2 30 m²', 'C\'est top', '0606060606', 400, 'Disponible', '49000', -0.513755, 47.4833, 'anthony.coppin@hotmail.fr', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tab_article`
--

DROP TABLE IF EXISTS `tab_article`;
CREATE TABLE IF NOT EXISTS `tab_article` (
  `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT,
  `DATE_ARTICLE` datetime NOT NULL,
  `TITRE_ARTICLE` varchar(100) DEFAULT NULL,
  `CATEGORIE_ARTICLE` varchar(30) DEFAULT NULL,
  `IMAGE_ARTICLE` text NOT NULL,
  `CORPS_ARTICLE` text NOT NULL,
  `NOMBRE_VUE_ARTICLE` int(5) NOT NULL,
  `NOMBRE_LIKE_ARTICLE` int(5) NOT NULL,
  PRIMARY KEY (`ID_ARTICLE`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_article`
--

INSERT INTO `tab_article` (`ID_ARTICLE`, `DATE_ARTICLE`, `TITRE_ARTICLE`, `CATEGORIE_ARTICLE`, `IMAGE_ARTICLE`, `CORPS_ARTICLE`, `NOMBRE_VUE_ARTICLE`, `NOMBRE_LIKE_ARTICLE`) VALUES
(30, '2017-01-05 00:00:00', 'C\'est le départ', 'ESAIP', 'https://i.ytimg.com/vi/PTlk8kYMPIw/maxresdefault.jpg', 'Quam ob rem vita quidem talis fuit vel fortuna vel gloria, ut nihil posset accedere, moriendi autem sensum celeritas abstulit; quo de genere mortis difficile dictu est; quid homines suspicentur, videtis; hoc vere tamen licet dicere, P. Scipioni ex multis diebus, quos in vita celeberrimos laetissimosque viderit, illum diem clarissimum fuisse, cum senatu dimisso domum reductus ad vesperum est a patribus conscriptis, populo Romano, sociis et Latinis, pridie quam excessit e vita, ut ex tam alto dignitatis gradu ad superos videatur deos potius quam ad inferos pervenisse.\n\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\n\nEo adducta re per Isauriam, rege Persarum bellis finitimis inligato repellenteque a conlimitiis suis ferocissimas gentes, quae mente quadam versabili hostiliter eum saepe incessunt et in nos arma moventem aliquotiens iuvant, Nohodares quidam nomine e numero optimatum, incursare Mesopotamiam quotiens copia dederit ordinatus, explorabat nostra sollicite, si repperisset usquam locum vi subita perrupturus.\n\nCirca hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu.', 45, 22),
(31, '2017-01-19 14:00:00', 'Bonjour à tous', 'Actualité', 'https://i.ytimg.com/vi/cGDHVjyJUcM/hqdefault.jpg', 'Quam ob rem vita quidem talis fuit vel fortuna vel gloria, ut nihil posset accedere, moriendi autem sensum celeritas abstulit; quo de genere mortis difficile dictu est; quid homines suspicentur, videtis; hoc vere tamen licet dicere, P. Scipioni ex multis diebus, quos in vita celeberrimos laetissimosque viderit, illum diem clarissimum fuisse, cum senatu dimisso domum reductus ad vesperum est a patribus conscriptis, populo Romano, sociis et Latinis, pridie quam excessit e vita, ut ex tam alto dignitatis gradu ad superos videatur deos potius quam ad inferos pervenisse.\n\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\n\nEo adducta re per Isauriam, rege Persarum bellis finitimis inligato repellenteque a conlimitiis suis ferocissimas gentes, quae mente quadam versabili hostiliter eum saepe incessunt et in nos arma moventem aliquotiens iuvant, Nohodares quidam nomine e numero optimatum, incursare Mesopotamiam quotiens copia dederit ordinatus, explorabat nostra sollicite, si repperisset usquam locum vi subita perrupturus.\n\nCirca hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu.', 80, 41),
(32, '2017-01-20 20:00:00', 'Omar sy à l\'affiche', 'Cinéma', 'http://img.gal.pmdstatic.net/fit/http.3A.2F.2Fwww.2Egala.2Efr.2Fvar.2Fgal.2Fstorage.2Fimages.2Fmedia.2Fmultiupload_du_31_janvier_2016.2Fomar_sy.2F3506614-1-fre-FR.2Fomar_sy.2Ejpg/1140x499/crop-from/top/omar-sy.jpg', 'Quam ob rem vita quidem talis fuit vel fortuna vel gloria, ut nihil posset accedere, moriendi autem sensum celeritas abstulit; quo de genere mortis difficile dictu est; quid homines suspicentur, videtis; hoc vere tamen licet dicere, P. Scipioni ex multis diebus, quos in vita celeberrimos laetissimosque viderit, illum diem clarissimum fuisse, cum senatu dimisso domum reductus ad vesperum est a patribus conscriptis, populo Romano, sociis et Latinis, pridie quam excessit e vita, ut ex tam alto dignitatis gradu ad superos videatur deos potius quam ad inferos pervenisse.\n\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\n\nEo adducta re per Isauriam, rege Persarum bellis finitimis inligato repellenteque a conlimitiis suis ferocissimas gentes, quae mente quadam versabili hostiliter eum saepe incessunt et in nos arma moventem aliquotiens iuvant, Nohodares quidam nomine e numero optimatum, incursare Mesopotamiam quotiens copia dederit ordinatus, explorabat nostra sollicite, si repperisset usquam locum vi subita perrupturus.\n\nCirca hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu.', 260, 36);

-- --------------------------------------------------------

--
-- Structure de la table `tab_evenement`
--

DROP TABLE IF EXISTS `tab_evenement`;
CREATE TABLE IF NOT EXISTS `tab_evenement` (
  `ID_EVENEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_EVENEMENT` text,
  `LIEU_EVENEMENT` varchar(100) NOT NULL,
  `DEBUT_EVENEMENT` datetime DEFAULT NULL,
  `DESCRIPTION_EVENEMENT` text NOT NULL,
  PRIMARY KEY (`ID_EVENEMENT`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_evenement`
--

INSERT INTO `tab_evenement` (`ID_EVENEMENT`, `NOM_EVENEMENT`, `LIEU_EVENEMENT`, `DEBUT_EVENEMENT`, `DESCRIPTION_EVENEMENT`) VALUES
(1, 'Concert au ralliement', '', '2017-01-14 08:20:00', ''),
(2, 'Sale of pancakes', '', '2017-01-13 21:30:00', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
