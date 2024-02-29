<?php

$page = explode("?", $_SERVER["REQUEST_URI"]);

switch ($page[0]) {
	case "/":
		include "pages/index.php";
		break;
	case "/denied":
		include "pages/denied.php";
		break;
	default:
		include "pages/notfound.php";
		break;
}

