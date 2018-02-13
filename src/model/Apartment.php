<?php
//require "Resource.php";

class Apartment extends Resource {
	//private $id;
	private $name;

	// SELECT 1
	static function read($pdo, $id) {
		$select = "SELECT * ";
		$from 	= "FROM tab_appart ";
		$where 	= "WHERE ID_APPART = :id";
		$sql 	= $select . $from . $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
		$apartment = $statement->fetch(PDO::FETCH_OBJ);

		return $apartment;
	}

	// SELECT all
	static function readMany($pdo) {
		$select = "SELECT * ";
		$from 	= "FROM tab_appart";
		$sql 	= $select . $from;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$apartments = $statement->fetchAll(PDO::FETCH_OBJ);

		return $apartments;
	}
	
	// TODO search filter
	/*static function search($pdo, $data) {
		$select = "SELECT * ";
		$from 	= "FROM tab_appart";
		if($data['filter']) {
			$where 	= "WHERE DISPO_APPART LIKE :filter ";
		}
		//$and 	= "AND CONTAINS(DESCRIP_APPART, :keyword)";
		$sql 	= $select . $from . $where . $and;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':filter' => $data['filter'], ':keyword' => $data['keyword']));
		$apartments = $statement->fetchAll(PDO::FETCH_OBJ);

		return $apartments;
	}*/

	// INSERT new
	static function create($pdo, $data) {
		$insert = "INSERT INTO tab_appart (DESCRIP_APPART, PRIX_APPART, DETAIL_APPART, ADRESSE_APPART, VILLE_APPART, CP_APPART, NOM_PROP, TELEPHONE_PROP, ADRESSE_MAIL, DISPO_APPART, COM_SIGNALER, LATITUDE_APPART, LONGITUDE_APPART)";
		$values = " VALUES (:description, :price, :details, :address, :city, :postalcode, :owner, :phone, :email, :status, :reported, :lat, :lng)";
		$sql 	= $insert . $values;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':description' => $data['description'],
								  ':price' => $data['price'],
								  ':details' => $data['details'],
								  ':address' => $data['address'],
								  ':city' => $data['city'],
								  ':postalcode' => $data['postalcode'],
								  ':owner' => $data['owner'],
								  ':phone' => $data['phone'],
								  ':email' => $data['email'],
								  ':status' => "Disponible",
								  ':reported' => "RAS",
								  ':lat' => $data['lat'],
								  ':lng' => $data['lng']
								 ));
	}

	// UPDATE 1
	static function update($pdo, $id, $data) {
		$update = "UPDATE tab_appart";
		$set 	= " SET DESCRIP_APPART = :description";
		$set   .= ", PRIX_APPART = :price";
		$set   .= ", DETAIL_APPART = :details";
		$set   .= ", ADRESSE_APPART = :address";
		$set   .= ", VILLE_APPART = :city";
		$set   .= ", CP_APPART = :postalcode";
		$set   .= ", NOM_PROP = :owner";
		$set   .= ", TELEPHONE_PROP = :phone";
		$set   .= ", ADRESSE_MAIL = :email";
		$set   .= ", DISPO_APPART = :status";
		$set   .= ", COM_SIGNALER = :reported";
		$set   .= ", LATITUDE_APPART = :lat";
		$set   .= ", LONGITUDE_APPART = :lng";
		$where 	= " WHERE ID_APPART = :id";
		$sql 	= $update . $set . $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id,
								  ':description' => $data['description'],
								  ':price' => $data['price'],
								  ':details' => $data['details'],
								  ':address' => $data['address'],
								  ':city' => $data['city'],
								  ':postalcode' => $data['postalcode'],
								  ':owner' => $data['owner'],
								  ':phone' => $data['phone'],
								  ':email' => $data['email'],
								  ':status' => $data['status'],
								  ':reported' => $data['reported'],
								  ':lat' => $data['lat'],
								  ':lng' => $data['lng']
								 ));
	}

	// DELETE 1
	static function delete($pdo, $id) {
		$delete = "DELETE FROM tab_appart ";
		$where 	= "WHERE ID_APPART = :id";
		$sql 	= $delete . $where;
		$statement = $pdo->prepare($sql);
		$statement->execute(array(':id' => $id));
	}
}