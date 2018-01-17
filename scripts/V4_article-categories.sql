DROP TABLE IF EXISTS `owlinone`.`tab_categorie_article`;
CREATE TABLE `owlinone`.`tab_categorie_article` (
  `ID_CATEGORIE` INT NOT NULL AUTO_INCREMENT,
  `LIBELLE_CATEGORIE` VARCHAR(30) NOT NULL, 
  PRIMARY KEY (`ID_CATEGORIE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `tab_article`
  DROP `CATEGORIE_ARTICLE`;
  
ALTER TABLE `tab_article`
  ADD `CATEGORIE_ARTICLE` INT; 

ALTER TABLE `tab_article`
  ADD CONSTRAINT FK_Categorie_Article
  FOREIGN KEY (CATEGORIE_ARTICLE) REFERENCES `tab_categorie_article`(ID_CATEGORIE);
  
  INSERT INTO `tab_categorie_article` (`ID_CATEGORIE`, `LIBELLE_CATEGORIE`) VALUES (NULL, 'BDE'), (NULL, 'News'), (NULL, 'Évènements');
  