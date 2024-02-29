<?php

function getItemCount() {
	$db = dbConnect();

	$query = "SELECT count(*) FROM item";

	try {
		$queryPrep = $db->prepare($query);

		if (!$queryPrep->execute())
			throw new Exception("Get item count error");
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}

	return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? NULL;
}

function getCraftCount() {
	$db = dbConnect();

	$query = "SELECT count(*) FROM craft";

	try {
		$queryPrep = $db->prepare($query);

		if (!$queryPrep->execute())
			throw new Exception("Get craft count error");
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}

	return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? NULL;
}

function getDiscoverCount() {
	$db = dbConnect();

	$query = "SELECT count(*) FROM item WHERE isNew = 1";

	try {
		$queryPrep = $db->prepare($query);

		if (!$queryPrep->execute())
			throw new Exception("Get discover count error");
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}

	return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? NULL;
}
