<?php
session_start();
unset($_SESSION["name"]);
$success = true;
echo $success; die;
?>