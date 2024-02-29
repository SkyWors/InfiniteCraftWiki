<?php

function getItem($name) {
	$db = dbConnect();

	$query = "SELECT * FROM item WHERE name like :name";

	$namef = "%" . $name . "%";
	try {
		$queryPrep = $db->prepare($query);
		$queryPrep->bindParam(':name', $namef);

		if (!$queryPrep->execute())
			throw new Exception("Get item " . $name . " error");
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}

	return $queryPrep->fetchAll(PDO::FETCH_ASSOC) ?? NULL;
}
