<?php

require "Ressource.php";

class Article extends Ressource {
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
    
    static function create() {
       
    }
    
    static function update() {
       
    }
    
    static function delete() {
       
    }
}