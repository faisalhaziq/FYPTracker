<?php include("connection.php");
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] != NULL){
  $sql = "SELECT * from students where studID='".$_SESSION['user']."'";
  $res = mysqli_query($conn, $sql);
  $check = mysqli_num_rows($res);

  if($check == 1){
    $row = mysqli_fetch_assoc($res);
    $usertype = "stud";
  }else{
    $sql2 = "SELECT * from lecturers where lectID='".$_SESSION['user']."'";
    $res2 = mysqli_query($conn, $sql2);
    $check2 = mysqli_num_rows($res2);
    if ($check2 == 1){
      $row2 = mysqli_fetch_assoc($res2);
      $usertype = "lect";
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
  <link rel="stylesheet" type="text/css" href="css/fontawesome-free-5.14.0-web/css/all.css">
</head>
<body style="background-color: #CD5C5C;">
  <!-- Navigation -->
  <?php include("nav.php");?>
  <!-- Page Content -->
  <div class="container">
    <!-- Jumbotron Header -->
    <header class="jumbotron text-white shadow-lg bg-white rounded " style="background: url(images/bg.jpeg) no-repeat center center; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%; background-color:rgba(0, 0, 0, 0.5); margin-top:150px;">
      <?php
      if (isset($_SESSION['user']) && $_SESSION['user'] != NULL){
        if($usertype=="stud"){
        ?>
        <h1 class="display-3" style="text-shadow: 3px 4px black;"><b>Welcome!</b></h1>
        <p class="lead" style="font-size:18pt; text-shadow: 2px 2px black;"><b>Welcome to FYP Progress Tracker!</b></p>
          <a href="project.php" class="btn btn-light btn-outline-danger btn-lg mb-3">Track your Progress!</a>
        <?php
        }else{
        ?>
        <h1 class="display-3" style="text-shadow: 3px 4px black;"><b>Dashboard</b></h1>
        <p class="lead" style="font-size:16pt; text-shadow: 2px 2px black;"><b>Welcome to your dashboard, <?php echo $row2['fullname'];?>!</b></p>
          <a href="projectlist.php" class="btn btn-light btn-outline-danger btn-lg mb-3">View your Student's Progress!</a>
          <?php 
          $sql3 = "SELECT * from projects WHERE lectID='".$_SESSION['user']."'";
          $res3 = mysqli_query($conn, $sql3);
          $num = mysqli_num_rows($res3);
          if($num>1){
            $word = "are";
          }else{
            $word = "is";
          }
          ?>
          <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <a class="btn btn-sm btn-danger disabled"><i class='fas fa-exclamation-circle'></i> Important</a> There <?php echo $word." ".$num; ?> project(s) that need your attention!
          </div>
        <?php
        }  
      }else{
      ?>
      <h1 class="display-3" style="text-shadow: 3px 4px black;"><b>Welcome!</b></h1>
        <p class="lead" style="font-size:18pt; text-shadow: 2px 2px black;"><b>Welcome to FYP Progress Tracker!</b></p>
        <p style="text-shadow: 2px 2px black;">Please login/register to continue!</p>
      <?php
      }
      ?>
    </header>
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
