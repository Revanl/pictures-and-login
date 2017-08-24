<?php
require_once("connect.php");
session_start();

$_SESSION["admin"] = true;
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="javascript.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
		
<?php
if(isset($_SESSION["name"])){?>
	<h2>Здравей <?php echo $_SESSION["name"]; ?>!</h2>
			<button id="logoutButton">Изход</button>
	<?php
}
?>
	<nav class="userMenu">
		<ul>
			<li>
				<a href="index.php">Начало</a>
			</li>
			<li>
				<a href="membersUser.php">Потребители</a>
			</li>
			<li>
				<a href="contactUser.php">Контакти</a>
			</li>
		</ul>
	</nav>

	
	<?php
	//НАВИГАЦИЯ КЪМ МЯСТО ЗА КАЧВАНЕ И ТРИЕНЕ НА СНИМКИ И ПРОМЯНА НА ДАННИ НА ПРОФИЛА
		if(isset($_SESSION["name"])){
			?>
			<a href="manageImages.php" class="manageImages">УПРАВЛЕНИЕ НА СНИМКИ</a>
			<a href="manageProfile.php" class="manageProfile">УПРАВЛЕНИЕ НА ПРИФЛА</a>	
			<?php
		}
	?>
</header>