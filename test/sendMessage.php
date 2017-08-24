<?php
require_once('connect.php');
$name = $email = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["contactName"])) {
		$error = "Нужно ви е име";
		echo $error; die;
	} else {
		$name = test_input($_POST["contactName"]);
		if (empty($_POST["contactEmail"])) {
			$error = "Нужен ви е имейл за връзка";
			echo $error; die;
		} else {
			$email = test_input($_POST["contactEmail"]);
			if (empty($_POST["contactMessage"])) {
				$error = "Нужно ви е съобщение";
				echo $error; die;
			} else {
				$message = test_input($_POST["contactMessage"]);
				try{
				global $db;
				//INSERT DATA TO DB				
					$inserts = $db->prepare("INSERT INTO messages( name, email, message) VALUES(:sendContactName, :sendContactEmail, :sendContactMessage)");
					$inserts->bindParam(':sendContactName', $name);
					$inserts->bindParam(':sendContactEmail', $email);
					$inserts->bindParam(':sendContactMessage', $message);
					$inserts->execute();
					$success = true;
					echo $success; die;
				}
				catch(Exception $e){
					echo $e->getMessage();
					exit;
				}
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
echo $name;
echo $password;
echo $message
?>