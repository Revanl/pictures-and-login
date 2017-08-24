<?php
//MANAGE PROFILE
include("header.php");


$name = $_SESSION["name"];
try{
	global $db;
	//CHECK IF DATA EXISTS IN DB
	$check = $db->prepare("SELECT * FROM members WHERE name = :checkName");
	$check->bindParam(':checkName', $name);
	$check->execute();
	$result = $check->fetch(PDO::FETCH_ASSOC);		
	if (count($result)!=0){
		//FIND PROFILE DISPLAY IT AND EDIT IT IF USER WANTS
		?>
	  <div class="displayProfileInfo">
		<?php
		echo "<br>Име:".$result["name"];
		echo "<br>Парола:".$result["password"];
		echo "<br>Качени снимки:";
		if($result["uploads"]==null){echo "Нищо не сте качвали";}else{echo $result["uploads"];};
		echo "<br>Ден на присъединяване:".$result["registration_date"];
		?>
		</div>
		<form type="POST" action="" class="editProfileForm">
			<label name="editProfileName">Име</label>
			<input type="text" class="editProfileName">
			<label name="editPassowrd">Парола</label>
			<input type="passowrd" class="editProfilePassowrd">
			<input type="submit" class="editProfileSubmit" value="Save changes">
		</form>
		<p>Оставете полето празно ако не искате да променяте сегашната стойност</p>
		<?php
	}
}
catch(Exception $e){
	echo $e->getMessage();
	exit;
}
?>
<?php
include("footer.php");
?>