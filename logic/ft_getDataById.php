<?php

function getDataById($id) {
	$db = dbConnect();

	$query = "SELECT name, symbole, isNew FROM item WHERE id = :id";

	try {
		$queryPrep = $db->prepare($query);
		$queryPrep->bindParam(':id', $id);

		if (!$queryPrep->execute())
			throw new Exception("Get name of " . $id . " error");
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}

	return $queryPrep->fetchAll(PDO::FETCH_ASSOC)[0] ?? NULL;
}
