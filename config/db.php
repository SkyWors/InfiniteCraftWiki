<?php
function dbConnect()
{
	try {
		$infosConnexion = parse_ini_file($_SERVER["DOCUMENT_ROOT"] .'/config/setting.ini');

		$infoBdd = array(
			'type' => 'mysql',
			'host' => $infosConnexion['database_host'],
			'port' => $infosConnexion['database_port'],
			'charset' => 'utf8mb4',
			'dbname' => $infosConnexion['database_name'],
			'user' => $infosConnexion['database_user'],
			'password' => $infosConnexion['database_password'],
		);

		$hostname = $infoBdd['host'];
		$dbname = $infoBdd['dbname'];
		$username = $infoBdd['user'];
		$password = $infoBdd['password'];
		$driver = $infoBdd['type'];
		$port = $infoBdd['port'];
		$charset = $infoBdd['charset'];

		$db = new PDO("$driver:dbname=$dbname; host=$hostname; port=$port; options='--client_encoding=$charset'", $username, $password, [PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
		$db->exec("SET NAMES 'UTF8MB4'");

		return $db;
	} catch (Exception $e) {
		LogRepository::fileSave($e);
	}
}
