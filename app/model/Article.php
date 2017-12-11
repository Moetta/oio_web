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

	static function read($id) {
		$db = new db();
		$pdo = $db->connect();

        $sql = "SELECT * FROM tab_article WHERE ID_ARTICLE = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':id' => $id));

        $article = $statement->fetch(PDO::FETCH_OBJ);
        $db = null;

        return $article;
    }

    static function readMany() {
        $db = new db();
        $pdo = $db->connect();

        $sql = "SELECT * FROM tab_article";
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $articles = $statement->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        return $articles;
    }

    static function create($title, $body) {
        $db = new db();
        $pdo = $db->connect();

        $sql = "INSERT INTO tab_article (TITRE_ARTICLE, CORPS_ARTICLE) VALUES (:title, :body)";
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':title' => $title, ':body' => $body));

        $db = null;
    }

    static function update() {

    }

    static function delete($id) {
        $db = new db();
        $pdo = $db->connect();

        $sql = "DELETE FROM tab_article WHERE tab_article.ID_ARTICLE = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':id' => $id));

        $db = null;
    }
}
