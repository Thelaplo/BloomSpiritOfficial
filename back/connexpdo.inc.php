<?php
function connexpdo($base,$param)
{
	include_once($param.".inc.php");
	$dsn="mysql:host=".HOST.";dbname=".$base.";charset=UTF8";
	$user=USER;
	$pass=PASS;
	try
	{
		$cnx = new PDO($dsn,$user,$pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $cnx;
	}
	catch(PDOException $except)
	{
		die('Echec de la connexion.'.$except->getMessage());
	}
}
?>