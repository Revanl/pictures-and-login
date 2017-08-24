<?php
require_once('connect.php');
session_start();
$name = $password = "";
//CHECK IF EMPTY THEN GO TO VALIDATION FUNCTION 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["loginName"])) {
		$error = "Нужно ви е име";
		echo $error; die;
	} else {
		$name = test_input($_POST["loginName"]);
		if (empty($_POST["loginPassowrd"])) {
			$error = "Нужна ви е парола";
			echo $error; die;
		} else {
			$password = test_input($_POST["loginPassowrd"]);
			try{
				global $db;
				//CHECK IF DATA EXISTS IN DB
				$check = $db->prepare("SELECT name FROM members WHERE name = :checkloginName AND password = :checkloginPassowrd");
				$check->bindParam(':checkloginName', $name);
				$check->bindParam(':checkloginPassowrd', $password);
				$check->execute();
				$results = $check->fetch(PDO::FETCH_ASSOC);
				if (empty($results)){
					$error = "Данните които въведохте не съответстват с тези на вашия акаунт";
					echo $error; die;
				} else {
					//Store some data in a session						
					$_SESSION["name"] = $results["name"];
					$success = true;
					echo $success; die;
				}
				
			}
			catch(Exception $e){
				echo $e->getMessage();
				exit;
			}
		}
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>