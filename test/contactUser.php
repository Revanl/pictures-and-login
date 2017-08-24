<?php
include("header.php");
?>
<form action="" method="post" class="contactForm">
	<label for="contactName">Name</label>
	<input type="text" class="contactName">
	<label for="contactEmail">Email</label>
	<input type="text" class="contactEmail">
	<label for="contactMessage">Message</label>
	<textarea class="contactMessage"></textarea>
	<input type="submit" class="contactSubmit" value="Submit">
</form>
<?php
include("footer.php");
?>