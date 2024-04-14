<?php
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_header.php");
	mainHeader("");

	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getCraft.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getItem.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getDataById.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getUseInCraft.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getStat.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getItems.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/search.php");
?>

<div class="main">

<?php
	echo "<div class='stat'>Item : " . getItemCount() . ", Recipes : " . getCraftCount() . ", First discoveries : " . getDiscoverCount() . "</div>";
?>

	<div class='search'>
		<form method="POST">
			<input class="searchbar" type="text" name="search" placeholder="Search items" autocomplete="off" required/>
			<input type="submit" name="send"/>
		</form>
	</div>

<?php
	if (isset($_GET["search"])) {
		echo "<div class='search'>";

		echo "Recherche " . $_GET["search"] . "<br><br>";
		foreach (getItem($_GET["search"]) as $value) {
			echo "<a class='item' href='?item=" . $value["name"] . "'>" . $value["symbole"] . " " . $value["name"] . "</a>";
		}

		echo "</div>";
	}

	if (isset($_GET["item"])) {
		unset($_POST);

		echo "<div class='recipe'>";
		echo "<h1>Recipes:</h1>";

		foreach (getCraft($_GET["item"]) as $value) {
			$item1 = getDataById($value["idItem1"]);
			$item2 = getDataById($value["idItem2"]);
			$result = getDataById($value["idResult"]);

			$line = "";

			$isNew1 = "";
			$isNew2 = "";
			$isNewResult = "";
			if ($item1["isNew"])
				$isNew1 = "firstdiscovery";
			if ($item2["isNew"])
				$isNew2 = "firstdiscovery";
			if ($result["isNew"])
				$isNewResult = "firstdiscovery";

			if ($item1["name"] != $result["name"])
				$line .= "<a class='item " . $isNew1 . "' href='?item=" . $item1["name"] . "'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";
			else
				$line .= "<a class='item " . $isNew1 . " noclick'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";

			if ($item2["name"] != $result["name"])
				$line .= " + <a class='item " . $isNew2 . "' href='?item=" . $item2["name"] . "'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";
			else
				$line .= " + " . "<a class='item " . $isNew2 . " noclick'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";

			$line .= " = " . "<a class='item " . $isNewResult . " noclick'>" . $result["symbole"] . " " . $result["name"] . "</a>";

			echo $line . "<br>";
		}

		echo "</div>";
		echo "<div class='used'>";

		echo "<h1>Used in:</h1>";
		foreach (getUseInCraft($_GET["item"]) as $value) {
			$item1 = getDataById($value["idItem1"]);
			$item2 = getDataById($value["idItem2"]);
			$result = getDataById($value["idResult"]);

			$isNew1 = "";
			$isNew2 = "";
			$isNewResult = "";
			if ($item1["isNew"])
				$isNew1 = "firstdiscovery";
			if ($item2["isNew"])
				$isNew2 = "firstdiscovery";
			if ($result) {
				if ($result["isNew"])
					$isNewResult = "firstdiscovery";
			}

			if ($item2["name"] == $_GET["item"]) {
				$temp = $item1;
				$item1 = $item2;
				$item2 = $temp;

				$temp = $isNew1;
				$isNew1 = $isNew2;
				$isNew2 = $temp;
			}

			$line = "";

			if ($item1["name"] != $_GET["item"])
				$line .= "<a class='item " . $isNew1 . "' href='?item=" . $item1["name"] . "'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";
			else
				$line .= "<a class='item " . $isNew1 . " noclick'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";

			if ($item2["name"] != $_GET["item"])
				$line .= " + <a class='item " . $isNew2 . "' href='?item=" . $item2["name"] . "'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";
			else
				$line .= " + " . "<a class='item " . $isNew2 . " noclick'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";

			if (!$result)
				$line .= " = Nothing.";
			else
				if ($result["name"] != $_GET["item"])
					$line .= " = <a class='item " . $isNewResult . "' href='?item=" . $result["name"] . "'>" . $result["symbole"] . " " . $result["name"] . "</a>";
				else
					$line .= " = " . "<a class='item " . $isNewResult . " noclick'>" . $result["symbole"] . " " . $result["name"] . "</a>";

			echo $line . "<br>";
		}
		echo "</div>";
	}

	if (!$_GET) {
		foreach (getItems() as $value) {
			$isNew = "";
			if ($value["isNew"])
				$isNew = "firstdiscovery";
			echo "<a class='item " . $isNew . "' href='?item=" . $value["name"] . "'>" . $value["symbole"] . " " . $value["name"] . "</a>";
		}
	}
?>

</div>
