<?php
if (isset($_POST["send"])) {
	header("Location: ?search=" . $_POST["search"]);
}
