<?php
	function mainHeader($title) {
		// Import main functions
		require($_SERVER["DOCUMENT_ROOT"] . "/config/config.php");

		// Page title
		if ($title != "")
			$title = $title . " - InfiniteWiki";
		else
			$title = "InfiniteWiki";

		$main = "/public/css/main.css";

		// Create header
		echo <<<EOT
			<!DOCTYPE html>
			<html lang="fr">
			<head>
				<meta charset="UTF-8">
				<link rel="stylesheet" href="$main">
				<title>$title</title>
			</head>
		EOT;
	}
