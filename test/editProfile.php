<?php
//EDIT PROFILE
require_once('connect.php');
session_start();
	$editProfilePassowrd = $_POST["editProfilePassowrd"];
	$editProfileName = $_POST["editProfileName"];
	$currentName = $_SESSION["name"];
	$error=" ";
	try{
	global $db;
	//CHECK IF PASSWORD IS EMPTY AND VALIDATE
	if (empty($_POST["editProfilePassowrd"])) {
		$error .= "Нужна ви е парола";
	} else {
			$editProfilePassowrd = test_input($_POST["editProfilePassowrd"]);
			//CHECK IF PASSWORD EXISTS IN DB
			$checkPassword = $db->prepare("SELECT password FROM members WHERE password = :editProfilePassowrd");
			$checkPassword->bindParam(':editProfilePassowrd', $editProfilePassowrd);
			$checkPassword->execute();
			$resultPassword = $checkPassword -> fetchAll();			
			if (count($resultPassword)!=0){
				$error .= " Тази парола вече е заета";
			}else{
				//EDIT PASSWORD
				global $db;
				$editPassword = $db -> prepare( "UPDATE members SET password = :editProfilePassowrd WHERE name= :currentName");
				$editPassword->bindParam(':editProfilePassowrd', $editProfilePassowrd);
				$editPassword->bindParam(':currentName', $currentName);
				$editPassword->execute();
				$success = "Вие променихте паролата";
			}
		}
		if (empty($_POST["editProfileName"])) {
			$error .= "Нужно ви е име";
			echo $error; die;
		} else {
		$editProfileName = test_input($_POST["editProfileName"]);
		//CHECK IF NAME EXISTS IN DB
		$checkName = $db->prepare("SELECT name FROM members WHERE name = :editProfileName");
		$checkName->bindParam(':editProfileName', $editProfileName);
		$checkName->execute();
		$resultName = $checkName -> fetchAll();			
		if (count($resultName)!=0){
			$error .= " това име вече е заето";
			echo $error; die;
			}else{
			//EDIT NAME
			$editName = $db -> prepare( "UPDATE members SET name= :editProfileName WHERE name= :currentName");
			$editName->bindParam(':editProfileName', $editProfileName);
			$editName->bindParam(':currentName', $currentName);
			$editName->execute();
			//OVERWRITE SESSION NAME
			$_SESSION["name"] = $editProfileName;
			$success =  true;
			echo $success; die;
		}
	}
}
catch(Exception $e){
	echo $e->getMessage();
	exit;
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>