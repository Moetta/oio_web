<?php
//require "Resource.php";

class ArticleCategory extends Resource {
	//private $id;
	private $name;

	// SELECT 1
	static function read($pdo, $id) {
		$select = "SELECT * ";
		$from 	= "FROM tab_categorie_article ";
		$where 	= "WHERE ID_CATEGORIE = :id";
		$sql 	= $select . $from . $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
		$categorie = $statement->fetch(PDO::FETCH_OBJ);

		return $categorie;
	}

	// SELECT all
	static function readMany($pdo) {
		$select = "SELECT * ";
		$from 	= "FROM tab_categorie_article";
		$sql 	= $select . $from;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$categories = $statement->fetchAll(PDO::FETCH_OBJ);

		return $categories;
	}

	// INSERT new
	static function create($pdo, $data) {
		$insert = "INSERT INTO tab_categorie_article (LIBELLE_CATEGORIE) ";
		$values = "VALUES (:name)";
		$sql 	= $insert . $values;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':name' => $data['name']));
	}

	// UPDATE 1
	static function update($pdo, $id, $data) {
		$update = "UPDATE tab_categorie_article ";
		$set 	= "SET LIBELLE_CATEGORIE = :name ";
		$where 	= "WHERE ID_CATEGORIE = :id";
		$sql 	= $update . $set . $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id, ':name' => $data['name']));
	}

	// DELETE 1
	static function delete($pdo, $id) {
		$delete = "DELETE FROM tab_categorie_article ";
		$where 	= "WHERE tab_categorie_article.ID_CATEGORIE = :id";
		$sql 	= $delete . $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
	}
}
