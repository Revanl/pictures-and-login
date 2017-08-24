<?php
require_once('connect.php');

$name = $password = "";
//CHECK IF EMPTY THEN GO TO VALIDATION FUNCTION 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["registerName"])) {
		$error = "Нужно ви е име";
		echo $error; die;
	} else {
		$name = test_input($_POST["registerName"]);
		if (empty($_POST["registerPassowrd"])) {
			$error = "Нужна ви е парола";
			 echo $error; die;
		} else {
			$password = test_input($_POST["registerPassowrd"]);
			try{
				global $db;
				//CHECK IF DATA EXISTS IN DB
				$check = $db->prepare("SELECT * FROM members WHERE name = :checkRegisterName AND password = :checkRegisterPassowrd");
				$check->bindParam(':checkRegisterName', $name);
				$check->bindParam(':checkRegisterPassowrd', $password);
				$check->execute();
				$result = $check -> fetchAll();				
				if (count($result)!=0){
					$error = "Този акаунт вече съществува";
					echo $error; die;
				}else{
					//INSERT DATA TO DB				
					$inserts = $db->prepare("INSERT INTO members( name, password) VALUES(:sendRegisterName, :sendRegisterPassowrd)");
					$inserts->bindParam(':sendRegisterName', $name);
					$inserts->bindParam(':sendRegisterPassowrd', $password);
					$inserts->execute();
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