<?php

function getUseInCraft($name) {
	$db = dbConnect();

	$query = "SELECT idItem1, idItem2, idResult FROM craft cr, item it WHERE (cr.idItem1 = it.id or idItem2 = it.id) and it.name = :name";

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
