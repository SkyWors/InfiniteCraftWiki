<?php
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_header.php");
	mainHeader("");

	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getCraft.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getItem.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getDataById.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getUseInCraft.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/logic/ft_getStat.php");
?>

<?php
	echo "<div class='stat'>Item : " . getItemCount() . ", Recipes : " . getCraftCount() . ", First discoveries : " . getDiscoverCount() . "</div>";

	if (isset($_GET["item"])) {
?>

<?php
		echo "<div class='recipe'>";

		echo "<a href='/'>Retour</a><br><br>";

		echo "<h1>Recipes:</h1>";

		foreach (getCraft($_GET["item"]) as $value) {
			$item1 = getDataById($value["idItem1"]);
			$item2 = getDataById($value["idItem2"]);
			$result = getDataById($value["idResult"]);

			$line = "";

			if ($item1["name"] != $result["name"])
				$line .= "<a class='item' href='?item=" . $item1["name"] . "'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";
			else
				$line .= "<a class='item noclick'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";

			if ($item2["name"] != $result["name"])
				$line .= " + <a class='item' href='?item=" . $item2["name"] . "'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";
			else
				$line .= " + " . "<a class='item noclick'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";

			$line .= " = " . "<a class='item noclick'>" . $result["symbole"] . " " . $result["name"] . "</a>";

			echo $line . "<br>";
		}

		echo "</div>";
		echo "<div class='used'>";

		echo "<h1>Used in:</h1>";
		foreach (getUseInCraft($_GET["item"]) as $value) {
			$item1 = getDataById($value["idItem1"]);
			$item2 = getDataById($value["idItem2"]);
			$result = getDataById($value["idResult"]);

			if ($item2["name"] == $_GET["item"]) {
				$temp = $item1;
				$item1 = $item2;
				$item2 = $temp;
			}

			$line = "";

			if ($item1["name"] != $_GET["item"])
				$line .= "<a class='item' href='?item=" . $item1["name"] . "'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";
			else
				$line .= "<a class='item noclick'>" . $item1["symbole"] . " " . $item1["name"] . "</a>";

			if ($item2["name"] != $_GET["item"])
				$line .= " + <a class='item' href='?item=" . $item2["name"] . "'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";
			else
				$line .= " + " . "<a class='item noclick'>" . $item2["symbole"] . " " . $item2["name"] . "</a>";

			if (!$result)
				$line .= " = Nothing.";
			else
				if ($result["name"] != $_GET["item"])
					$line .= " = <a class='item' href='?item=" . $result["name"] . "'>" . $result["symbole"] . " " . $result["name"] . "</a>";
				else
					$line .= " = " . "<a class='item noclick'>" . $result["symbole"] . " " . $result["name"] . "</a>";

			echo $line . "<br>";
		}
		echo "</div>";
	} else {
?>

	<div class='search'>

	<form method="POST">
		<input type="text" name="search" autofocus required/>
		<input type="submit" name="send"/>
	</form>

	</div>

<?php
		if (isset($_POST["send"])) {
			echo "<div class='search'>";

			echo "Recherche " . $_POST["search"] . "<br><br>";
			foreach (getItem($_POST["search"]) as $value) {
				echo "<a class='item' href='?item=" . $value["name"] . "'>" . $value["symbole"] . " " . $value["name"] . "</a>";
			}

			echo "</div>";
		}
	}
?>
