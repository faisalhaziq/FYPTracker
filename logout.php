<?php
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['login']);
	unset($usertype);
	header("location:index.php");
?>