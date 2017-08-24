<?php
//Connect to the DB
try{
$db= new PDO('mysql:host=localhost;dbname=test_project_images;port=3306','root','');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
$db->exec('SET NAMES "utf8"');
}
catch (Exception $e){
	echo $e->getMessage();
	exit;
}
?>