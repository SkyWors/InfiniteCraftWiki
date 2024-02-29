<?php
	function mainHeader($title) {
		// Import main functions
		require($_SERVER["DOCUMENT_ROOT"] . "/config/config.php");

		// Page title
		if ($title != "")
			$title = $title . " - InfiniteWiki";
		else
			$title = "InfiniteWiki";

		// Setup stylesheet path
		// $main = "/public/css/main.css";
		// $navbar = "/public/css/navbar.css";
		// $remixicon = "/public/css/import/remixicon.css";

		// Create header
		echo <<<EOT
			<!DOCTYPE html>
			<html lang="fr">
			<head>
				<meta charset="UTF-8">
				<title>$title</title>
			</head>
		EOT;
	}
