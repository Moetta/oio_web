<?php
require "Resource.php";

class Article extends Resource {
	//private $id;
	private $date;
	private $title;
	private $category;
	private $image;
	private $body;
	private $views;
	private $likes;

	// SELECT 1
	static function read($pdo, $id) {
		$select = "SELECT * ";
		$from = "FROM tab_article ";
		$where = "WHERE ID_ARTICLE = :id";
		$sql = $select . $from . $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
		$article = $statement->fetch(PDO::FETCH_OBJ);

		return $article;
	}

	// SELECT all
	static function readMany($pdo) {
		$sql = "SELECT * FROM tab_article ORDER BY DATE_ARTICLE DESC";
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$articles = $statement->fetchAll(PDO::FETCH_OBJ);

		return $articles;
	}

	// INSERT new
	static function create($pdo, $data) {
		$sql = "INSERT INTO tab_article (TITRE_ARTICLE, CORPS_ARTICLE, IMAGE_ARTICLE) VALUES (:title, :body, :img)";
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':title' => $data['title'], ':body' => $data['body'], ':img' => $data['img64']));
	}

	// UPDATE 1
	static function update($pdo, $id, $data) {
		$sql = "UPDATE tab_article SET TITRE_ARTICLE = :title, CORPS_ARTICLE = :body, IMAGE_ARTICLE = :img WHERE ID_ARTICLE = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id, ':title' => $data['title'], ':body' => $data['body'], ':img' => $data['img64']));
	}

	// DELETE 1
	static function delete($pdo, $id) {
		$sql = "DELETE FROM tab_article WHERE tab_article.ID_ARTICLE = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
	}
}
