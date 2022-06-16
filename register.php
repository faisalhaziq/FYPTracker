<?php 
session_start();
include("connection.php");

if(isset($_POST['register'])){
  $user= $_POST['userid'];
  $name= $_POST['name'];
  $email= $_POST['email'];
  $pass= $_POST['pass'];
  $major = $_POST['major'];
  $phone = $_POST['phone'];
  $intake = $_POST['intake'];

  $user = addslashes($user);
  $sql = "SELECT * from students where studID='$user'";
  $res = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($res);
  if($num == 1)
  {
    echo '<script language="javascript">alert("ID has already been registered!"); window.location.href="signin.php";</script>';
  }
  else{
    $reg = "INSERT into students (studID, password, fullname, email, phone, intake, major) values ('$user', '$pass', '$name', '$email', '$phone', '$intake', '$major')";
    mysqli_query($conn, $reg);
    echo '<script language="javascript">alert("Successfully Registered!\nPlease login with your credentials..."); window.location.href="signin.php";</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>FYP Progress Tracker</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/heroic-features.css" rel="stylesheet">
  <link href="css/signin.css" rel="stylesheet">
</head>
<body style="background-color: #CD5C5C; ">
  <!-- Navigation -->
  <?php include("nav.php");?>
  <!-- Page Content -->
<div class="container">
    <!-- Jumbotron Header -->
    <div class="row">
      <div class="col col-sm-8 mx-auto my-auto">
      <form method="POST" action="register.php" class="p-5 text-dark bg-white rounded shadow-lg">
      
      <h1 class="text-center h4 mb-5 font-weight-normal">Please register an account! <a href="register_lect.php" class=" font-weight-normal" style="font-size:10pt;">(Not a student?)</a></h1>
      <div class="row">
        <div class="col">
          <input type="text" name="name" id="inputText" class="form-control" placeholder="Full Name" required autofocus><br>
          <input type="tel" name="phone" id="inputText" class="form-control" placeholder="Phone Number" maxlength="12" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required><br>
          <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email Address" required><br>
        </div>
        <div class="col">
          <input type="text" name="userid" id="inputText" class="form-control" placeholder="Student ID" maxlength="12" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required><br>
          <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required><br>
          <input type="text" name="intake" id="inputText" class="form-control" placeholder="Intake (MM-YY)" pattern="[0-9]{2}/[0-9]{2}" maxlength="13" required title="Example: 09/20"><br>
          <input type="text" name="major" id="inputText" class="form-control" placeholder="Programme/Major" required><br>
          <button class="btn btn-sm btn-light btn-outline-success float-right" name="register" type="submit">Register</button>
        </div>
      </div>
      </form>
      </div>
  </div>
</div>
  <footer class="py-3 bg-dark fixed-bottom">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; FYP Progress Tracker</p>
    </div>
    <!-- /.container -->
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
