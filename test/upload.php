<?php
session_start();
require_once('connect.php');
//VALIDATE THE IMAGE THEN COPY PASTE IT TO THE FOLDER UPLOADS

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		//STORE THE NAME AND MAYBE THE LOCATION IN MYSQL SO WE CAN LATER FIND OUR IMAGES
		try{
			global $db;
			$userFile = $_SESSION["name"];
			//CHECK IF DATA EXISTS IN DB
			$insert = $db->prepare("INSERT INTO images (file, uploader) VALUES (:targetFile, :userFile) ");
			$insert->bindParam(':targetFile', $target_file);
			$insert->bindParam(':userFile', $userFile);
			$insert->execute();
		}
		catch(Exception $e){
			echo $e->getMessage();
			exit;
		}
	
	} else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>