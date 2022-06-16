<?php
	include("connection.php");
	if (isset($_GET['dow'])){
		$path = $_GET['dow'];
		$sql = "SELECT * FROM projectfiles WHERE (`pathname`) = '$path'";
		$res = mysqli_query($conn, $sql);
		ob_start();
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename"'.basename($path).'"');
		header('Content-Length: '. filesize($path));
		readfile($path);
	}
	if (isset($_GET['guideline'])){
		$path = $_GET['guideline'];
		$sql = "SELECT * FROM files WHERE (`pathname`) = '$path'";
		$res = mysqli_query($conn, $sql);
		ob_start();
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename"'.basename($path).'"');
		header('Content-Length: '. filesize($path));
		readfile($path);
	}
	if (isset($_GET['report'])){
		$path = $_GET['report'];
		$sql = "SELECT * FROM files WHERE (`pathname`) = '$path'";
		$res = mysqli_query($conn, $sql);
		ob_start();
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename"'.basename($path).'"');
		header('Content-Length: '. filesize($path));
		readfile($path);
	}
?>
