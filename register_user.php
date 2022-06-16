<?php
include ("connection.php");
session_start();


$matricnum = $_POST['matricnum'];
$name = $_POST['name'];
$tel = $_POST['num'];
$parenttel = $_POST['pnum'];
$pass = $_POST['pass'];
$sv = $_POST['supervisor'];
$s = "select * from students where Matrics_Num = '$matricnum'";
$result = mysqli_query($conn, $s);

$file = $_FILES['file'];
$images = $_FILES['file']['name'];
move_uploaded_file($file["tmp_name"],"profilepics/".$matricnum."_". $file["name"]);
$location = "".$matricnum."_".$images."";

$num = mysqli_num_rows($result);
if($num == 1)
{
	echo '<script language="javascript">alert("ID has already been registered!"); window.location.href="login.php";</script>';
}
else{
	$reg = "insert into students(Matrics_Num,  Stud_Name, Stud_Pass, Stud_Num, Parent_Num, Supervisor, image) values ('$matricnum', '$name', '$pass', '$tel', '$parenttel', '$sv', '$location')";
	mysqli_query($conn, $reg);
	echo '<script language="javascript">alert("Successfully Registered!\nPlease login with your credentials..."); window.location.href="login.php";</script>';
}
?>