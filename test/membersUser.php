<?php
include("header.php");
?>
<?php
//GET USERS BY UPLOADS DESC
try{
	global $db;
	//GET THE TOTAL NUMBER OF USERS
	$query = $db->prepare("SELECT * FROM members");
	$query->execute();
	$result = $query -> fetchAll();
	$total = count($result);
}
catch(Exception $e){
	echo $e->getMessage();
	exit;
}
//GET AN AMOUNT OF USERS AND PUT IT ON A SPECIFIC PAGE
try{
	//GET THE PAGE NUMBER IF EMPTY ASSIGN 1 AS A DEFAULT VALUE
	if (isset($_GET["page"])){
		$page  = $_GET["page"]; 
	}else{
		$page=1; 
	}; 
	$end = 10 ;
	$start = ($page-1) * $end;
	$query = $db -> prepare("SELECT name, uploads FROM members ORDER BY uploads DESC LIMIT $start, $end");
	$query -> execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
	echo $e->getMessage();
	exit;
}
//GET THE NUMBER OF PAGES BY DIVIDING THE TOTAL AND THE AMOUNT PRINTED ON ONE PAGE TO SEE HOW MANY PAGES WE NEED
$totalPages =  ceil($total/$end);
//PRINT THE LINKS OF THE PAGES
for ($page=1; $page <= $totalPages ; $page++){?>
<a href='<?php echo "?page=$page"; ?>' class="links">
<?php  echo $page; ?>
</a>

<?php } ?>

<div class="membersTable">
<!--PRINT BY UPLOADS-->
	<table>
	<caption>Потребители подредени по качвания</caption>
		<tr>
			<th>
				Име
			</th>
			<th>
				Брой качвания
			</th>
		</tr>
		<?php
		foreach($rows as $row){
		?>
		<tr>
			<td>
				<?php
				echo $row["name"];
				?>
			</td>
			<td>
				<?php
				if($row["uploads"]!= null){
					echo $row["uploads"];
				}else{
					echo "0";
				}
				?>
			</td>
		</tr>
		<?php
		};
		?>
	</table>
</div>
<?php
//GET USERS BY REGISTRATION_DATE DESC
try{
	global $db;
	//GET THE TOTAL NUMBER OF USERS
	$query = $db->prepare("SELECT * FROM members");
	$query->execute();
	$result = $query -> fetchAll();
	$total = count($result);
}
catch(Exception $e){
	echo $e->getMessage();
	exit;
}
//GET AN AMOUNT OF USERS AND PUT IT ON A SPECIFIC PAGE
try{
	//GET THE PAGE NUMBER IF EMPTY ASSIGN 1 AS A DEFAULT VALUE
	if (isset($_GET["page"])){
		$page  = $_GET["page"]; 
	}else{
		$page=1; 
	}; 
	$end = 10 ;
	$start = ($page-1) * $end;
	$query = $db -> prepare("SELECT name, registration_date FROM members ORDER BY registration_date DESC LIMIT $start, $end");
	$query -> execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
	echo $e->getMessage();
	exit;
}
//GET THE NUMBER OF PAGES BY DIVIDING THE TOTAL AND THE AMOUNT PRINTED ON ONE PAGE TO SEE HOW MANY PAGES WE NEED
$totalPages =  ceil($total/$end);
//PRINT THE LINKS OF THE PAGES
for ($page=1; $page <= $totalPages ; $page++){?>
<a href='<?php echo "?page=$page"; ?>' class="links">
<?php  echo $page; ?>
</a>
<?php } ?>
<div class="membersTable">
<!--PRINT BY REGISTRATION_DATE-->
	<table>
		<caption>Потребители подредени по ден на присъединяване</caption>
		<tr>
			<th>
				Име
			</th>
			<th>
				Ден на присъединяване
			</th>
		</tr>
		<?php
		foreach($rows as $row){
		?>
		<tr>
			<td>
				<?php
				echo $row["name"];
				?>
			</td>
			<td>
				<?php
					echo $row["registration_date"];
				?>
			</td>
		</tr>
		<?php
		};
		?>
	</table>
</div>

<?php
include("footer.php");
?>