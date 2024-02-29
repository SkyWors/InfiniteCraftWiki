<?php

function getCraft($name) {
	$db = dbConnect();

	$query = "SELECT cr.* FROM craft cr, item it WHERE cr.idResult = it.id and it.name = :name";

	try {
		$queryPrep = $db->prepare($query);
		$queryPrep->bindParam(':name', $name);

		if (!$queryPrep->execute())
			throw new Exception("Get crafts of " . $name . " error");
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}

	return $queryPrep->fetchAll(PDO::FETCH_ASSOC) ?? NULL;
}
