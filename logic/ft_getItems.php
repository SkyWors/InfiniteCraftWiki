<?php

function getItems() {
	$db = dbConnect();

	$query = "SELECT * FROM item ORDER BY RAND() LIMIT 100";

	try {
		$queryPrep = $db->prepare($query);

		if (!$queryPrep->execute())
			throw new Exception("Get items error");
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}

	return $queryPrep->fetchAll(PDO::FETCH_ASSOC) ?? NULL;
}
