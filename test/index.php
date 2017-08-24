<?php
include("header.php");

?>
<!--CHECK IF LOGGED IN-->
<?php
if(isset($_SESSION["name"])){

}else{
?>
<!--BUTTONS FOR THE MODALS-->
<div class="modalButtons" >
	<button id="registerModalButtons">Регистрация</button>
	<button id="loginModalButtons">Логин</button>
</div>

<!--REGISTER-->
<div id="registerModal" class="panel">
<h1>Регистрация</h1>
	<!--форма за регистрация на нови потребители-->
	<form class="registerForm" method="post" action="">
		<label name="registerName">Име</label>
		<input type="text" class="registerName">
		<label name="registerPassowrd">Парола</label>
		<input type="password" class="registerPassowrd">
		<input type="submit" class="registerSubmit" value="Submit">
	</form>
</div>

<!--LOGIN-->
<div id="loginModal" class="panel">
<h1>Логин</h1>
	<!--логин форма за потребители-->
	<form class="loginForm" method="post" action="">
		<label name="loginName">Име</label>
		<input type="text" class="loginName">
		<label name="loginPassowrd">Парола</label>
		<input type="passowrd" class="loginPassowrd">
		<input type="submit" class="loginSubmit" value="Submit">
	</form>
</div>
<?php }?>
<!-- MODAL -->
<div class="modal" src=""> 
<span class="close">&times;</span>
  <img class="modalForImages" src="">

  <div class="imageComments">
  <!--GET THE COMMENTS AND PUT THEM HERE-->
  <?php
try{
	global $db;
$query = $db -> prepare("SELECT * FROM comments ORDER BY id DESC LIMIT 10");
$query -> execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){
	echo $row["user"];
	echo " say's: ";
	echo $row["comment"];
	echo '<br>';
}
}
catch(Exception $e){
	echo $e->getMessage();
	exit;
}
?>
  </div>
  <?php
  if(isset($_SESSION["name"])){
	  ?>
    <!--WRTIE THE COMMENTS-->
	<form action="" method="post" class="addCommentForm">
		<label for="addComment"></label>
		<textarea class="addCommentMessage"></textarea>
		<input type="submit" class="addCommentSubmit" value="Submit">
	</form>
  <?php } ?>
</div>
<!--последните 10 снимки листнати като линкове-->
<div class="latestImages">
<?php
	$latestImages = $db->prepare("SELECT file FROM images ORDER BY upload_date DESC LIMIT 10");
	$latestImages->execute();
	$listLatestImages = $latestImages -> fetchAll();
foreach( $listLatestImages as $row ) {
	?>
	<img src="<?php echo $row["file"];?>" class="latestImagesStyle">
	<?php
}
?>
</div>
<?php
include("footer.php");
?>
