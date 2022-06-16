<?php
  include ('connection.php');
  session_start();
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
    <div class="row">
      <div class="col">
        <div class='alert alert-danger alert-dismissible fade show w-50 mx-auto' role='alert'>
        <i class='fas fa-exclamation-circle'></i> Only students with ACTIVE status are allowed to login to this system. For any enquiries, please contact us.
      </div>
    <form method="POST" action="signin.php" class="form-signin text-dark bg-white rounded shadow-lg">
      <div class="row">
        <div class="col">
      
      <h1 class="text-center h4 mb-5 font-weight-normal">Please login with your account</h1>
      <label for="inputText" class="sr-only">Username</label>
      <input type="text" name="ID" id="inputText" class="form-control" placeholder="Enter your ID" required autofocus><br>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required><br>
      <a href="forgotpw.php" class="btn btn-sm btn-light btn-outline-danger float-left">Forgot Password</a>
      <button class="btn btn-sm btn-light btn-outline-success float-right" name="login" type="submit">Sign in</button>
      </div>
    </div>
    </form>
      </div>
    </div>
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
