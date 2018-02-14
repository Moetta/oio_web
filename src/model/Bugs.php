<?php

class Bugs {

	// SELECT all bugs where type bug
	static function getBugs($pdo) {
		$select = "SELECT *";
		$from = "FROM tab_bugs";
		$where = "WHERE STATUT_BUG = 1";
		$and = "AND RAISON_BUG IS NOT NULL";
		$sql = $select ." ". $from ." ". $where ." ". $and;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$bugs = $statement->fetchAll(PDO::FETCH_OBJ);

		return $bugs;
	}
	
	// SELECT all bugs where type suggestion
	static function getSuggestions($pdo) {
		$select = "SELECT *";
		$from = "FROM tab_bugs";
		$where = "WHERE STATUT_BUG = 1";
		$and = "AND SUGGESTION_BUG IS NOT NULL";
		$sql = $select ." ". $from ." ". $where ." ". $and;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$suggestions = $statement->fetchAll(PDO::FETCH_OBJ);

		return $suggestions;
	}
	
	// UPDATE bug to mark as resolved
	static function resolveBug($pdo, $id, $data) {
		$update = "UPDATE tab_bugs";
		$set 	= "SET STATUT_BUG = :active ";
		$where 	= "WHERE ID_BUG = :id";
		$sql 	= $update ." ". $set ." ". $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id,
								  ':active' => $data['active']
								 ));
	}
  
	// SELECT all reported apartments
	static function getReportedApartments($pdo) {
		$select = "SELECT *";
		$from = "FROM tab_appart";
		$where = "WHERE DISPO_APPART LIKE 'Signaler'";
		$sql = $select ." ". $from ." ". $where;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$apartments = $statement->fetchAll(PDO::FETCH_OBJ);

		return $apartments;
	}
	
	// SELECT all users
	static function getUsers($pdo) {
		$select = "SELECT *";
		$from = "FROM tab_users";
		$sql = $select ." ". $from;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$users = $statement->fetchAll(PDO::FETCH_OBJ);

		return $users;
	}
	
	// DELETE user by id
	static function deleteUser($pdo, $id) {
		$delete = "DELETE FROM tab_users";
		$where 	= "WHERE id = :id";
		$sql 	= $delete ." ". $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
	}
}
