DROP TABLE IF EXISTS `owlinone`.`tab_bugs`;

CREATE TABLE `owlinone`.`tab_bugs` (
  `ID_BUG` INT NOT NULL AUTO_INCREMENT,
  `STATUT_BUG` BOOL NOT NULL DEFAULT TRUE,
  `RAISON_BUG` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `SUGGESTION_BUG` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID_BUG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
INSERT INTO `tab_bugs` (`RAISON_BUG`) VALUES ('Quand j\'ouvre et je ferme le menu très vite, ça fait crasher l\appli');
INSERT INTO `tab_bugs` (`SUGGESTION_BUG`) VALUES ('Ça serait bien que tout fonctionne bien merci bonsoir');
INSERT INTO `tab_bugs` (`STATUT_BUG`, `RAISON_BUG`) VALUES (false, 'Bug résolu tavu');
