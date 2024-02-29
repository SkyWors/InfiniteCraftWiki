<?php
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_header.php");
	mainHeader("");
?>

<?php
	if (isset($_GET["item"])) {
?>

	<a href="/">Retour</a><br><br>

<?php
		foreach (getCraft($_GET["item"]) as $value) {
			$item1 = getNameById($value["idItem1"]);
			$item2 = getNameById($value["idItem2"]);
			$result = getNameById($value["idResult"]);

			echo "<a href='?item=" . $item1["name"] . "'>"
			. $item1["symbole"] . " " . $item1["name"]
			. "</a>"
			. " + " . "<a href='?item=" . $item2["name"] . "'>"
			. $item2["symbole"] . " " . $item2["name"]
			. "</a>"
			. " = " . $result["symbole"] . " " . $result["name"]
			. "<br>";
		}
	} else {
?>

	<form method="POST">
		<input type="text" name="search" autofocus required/>
		<input type="submit" name="send"/>
	</form>

<?php
		if (isset($_POST["send"])) {
			echo "Recherche " . $_POST["search"] . "<br><br>";
			foreach (getItem($_POST["search"]) as $value) {
				echo "<a href='?item=" . $value["name"] . "'>" . $value["symbole"] . " " . $value["name"] . "</a><br>";
			}
		}
	}

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

	function getNameById($id) {
		$db = dbConnect();

		$query = "SELECT name, symbole FROM item WHERE id = :id";

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
?>
