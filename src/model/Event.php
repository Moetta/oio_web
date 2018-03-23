<?php

class Event {

	// SELECT 1
//	static function read($pdo, $id) {
//		$select = "SELECT * ";
//		$from = "FROM tab_evenement ";
//		$where = "WHERE ID_EVENEMENT = :id";
//		$sql = $select . $from . $where;
//		$statement = $pdo->prepare($sql);
//		$statement->execute(array(':id' => $id));
//		$event = $statement->fetch(PDO::FETCH_OBJ);
//
//		return $event;
//	}

	// SELECT all events
	static function readMany($pdo) {
		$select = "SELECT *";
		$from = "FROM tab_evenement";
		$sql = $select ." ". $from;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$events = $statement->fetchAll(PDO::FETCH_OBJ);

		return $events;
	}
	
	// INSERT new event
	static function create($pdo, $data) {
		$insert = "INSERT INTO tab_evenement (NOM_EVENEMENT, DEBUT_EVENEMENT, LIEN_EVENEMENT, LIEU_EVENEMENT)";
		$values = "VALUES (:name, :start, :link, :location)";
		$sql 	= $insert ." ". $values;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':name' => $data['name'],
								  ':start' => $data['start'],
								  ':link' => $data['link'],
								  ':location' => $data['location']
								 ));
	}
	
	// UPDATE event by id
	static function update($pdo, $id, $data) {
		$update = "UPDATE tab_evenement";
		$set 	= "SET NOM_EVENEMENT = :name ";
		$set   .= ", DEBUT_EVENEMENT = :start";
		$set   .= ", LIEN_EVENEMENT = :link";
		$set   .= ", LIEU_EVENEMENT = :location";
		$where 	= "WHERE ID_EVENEMENT = :id";
		$sql 	= $update ." ". $set ." ". $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id,
								  ':name' => $data['name'],
								  ':start' => $data['start'],
								  ':link' => $data['link'],
								  ':location' => $data['location']
								 ));
	}
  
	// DELETE event by id
	static function delete($pdo, $id) {
		$delete = "DELETE FROM tab_evenement";
		$where 	= "WHERE ID_EVENEMENT = :id";
		$sql 	= $delete ." ". $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
	}

}
