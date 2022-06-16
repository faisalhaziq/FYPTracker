<?php
  include ('connection.php');
  session_start();
  $studID = $_GET['ID'];
  if (isset($_POST['login'])){
    $ID = $_POST['ID'];
    $pass = $_POST['pass'];
    $sql = "select * from students where studID = '$ID' && password = '$pass' ";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    $checking = mysqli_num_rows($result);
    
    if($checking == 1)
    {
      $_SESSION['user'] = $res['studID'];
      $_SESSION['login'] = "1";
      echo '<script language="javascript">alert("Logged in!"); window.location.href="index.php";</script>';
    }else{
      $sql2 = "select * from lecturers where lectID = '$ID' && password = '$pass' ";
      $result2 = mysqli_query($conn, $sql2);
      $res2 = mysqli_fetch_assoc($result2);
      $checking2 = mysqli_num_rows($result2);

      if($checking2==1){
        $_SESSION['user'] = $res2['lectID'];
        $_SESSION['login'] = "1";
        echo '<script language="javascript">alert("Logged in!"); window.location.href="index.php";</script>';
      }else{
        $_SESSION['login'] = " ";
      echo '<script language="javascript">alert("Oops, wrong password?"); window.location.href="signin.php";</script>';
      }
    }
}
if(isset($_POST['reset'])){
        $pass = $_POST['password'];
        $sql = "UPDATE students SET password='$pass' WHERE studID='$studID'";
        $res = mysqli_query($conn, $sql);
        echo '<script language="javascript">alert("Password changed, please login!"); window.location.href="signin.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>FYP Progress Tracker</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/heroic-features.css" rel="stylesheet">
  <link href="css/signin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/fontawesome-free-5.14.0-web/css/all.css">
</head>
<body style="background-color: #CD5C5C;">
  <!-- Navigation -->
  <?php include("nav.php");?>
  <!-- Page Content -->
  <div class="container">
    <!-- Jumbotron Header -->
    <form method="POST" action="changePassword.php?ID=<?php echo $studID; ?>" class="form-signin text-dark bg-white rounded shadow-lg">
      <div class="row">
        <div class="col">
      <h1 class="text-center h4 mb-5 font-weight-normal">Change your password</h1>
      <input type="password" name="password" id="inputText" class="form-control" placeholder="Enter your password" required autofocus><br>
      <button class="btn btn-sm btn-light btn-outline-success float-right" name="reset" type="submit">Change Password</button>
    </div>
  </div>
    </form>
  </div>
  <!-- /.container -->

  <!-- Footer -->
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
