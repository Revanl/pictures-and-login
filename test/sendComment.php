<?php
//ADD COMMENTS
require_once('connect.php');
session_start();
//HERE WE WANT TO GET THE COMMENT THE LOGGED IN USER AND THE IMAGE ON WHICH WE ARE ON
$user = $_SESSION["name"];
$image = $_POST["addCommentImage"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["addCommentMessage"])) {
		$error = "Напишете коментар";
		echo $error; die;
	} else {
		$comment = test_input($_POST["addCommentMessage"]);
		try{
		global $db;
		//INSERT DATA TO DB				
			$inserts = $db->prepare("INSERT INTO comments(comment,user,image) VALUES(:addCommentMessage, :addCommentUser, :addCommentImage)");
			$inserts->bindParam(':addCommentMessage', $comment);
			$inserts->bindParam(':addCommentUser', $user);
			$inserts->bindParam(':addCommentImage', $image);
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
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
