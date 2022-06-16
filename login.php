<?php
session_start();
include('connection.php');
if(isset($_POST['login_btn'])){
  $ID = $_POST['id'];
  $pass = $_POST['pass'];

  $s = "select * from students where Matrics_Num = '$ID' && Stud_Pass = '$pass' ";
  $result = mysqli_query($conn, $s);
  $num = mysqli_num_rows($result);
  
  if($num == 1)
  {
    $_SESSION['userID'] = $ID;
    $_SESSION['login'] = "1";
    echo '<script language="javascript">alert("Login Success! Welcome, '.$ID.'!"); setTimeout(window.location.href="dashboard/dashboard.php",2000);</script>';
  }
  else{
    $_SESSION['login'] = "";
    echo '<script language="javascript">alert("Login Error!"); window.location.href="login.php";</script>';
  }
}
if(isset($_POST['login_lect'])){
  $ID = $_POST['id'];
  $pass = $_POST['pass'];

  $s = "select * from lecturers where Lect_ID = '$ID' && Lect_Pass = '$pass' ";
  $result = mysqli_query($conn, $s);
  $num = mysqli_num_rows($result);
  
  if($num == 1)
  {
    $_SESSION['userID'] = $ID;
    $_SESSION['login'] = "1";
    echo '<script language="javascript">alert("Login Success! Welcome, '.$ID.'!"); setTimeout(window.location.href="dashboard/dashboard.php",2000);</script>';
  }
  else{
    $_SESSION['login'] = "";
    echo '<script language="javascript">alert("Login Error!"); window.location.href="login.php";</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Attendance Tracker</title>

  <!-- Custom fonts for this template-->
  <link href="dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6" style="margin-top:150px;">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login</h1>
                <?php

                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                        unset($_SESSION['status']);
                    }
                ?>
              </div>

                <form class="user" action="login.php" method="POST">

                    <div class="form-group">
                    <input type="text" name="id" class="form-control form-control-user" placeholder="Enter Matrics Num...">
                    </div>
                    <div class="form-group">
                    <input type="password" name="pass" class="form-control form-control-user" placeholder="Password">
                    </div>
            
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login as Student</button>
                    <button type="submit" name="login_lect" class="btn btn-primary btn-user btn-block"> Login as Lecturer</button>
                    <hr>
                </form>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>
</div>
</body>
</html>

<?php
include('dashboard/includes/scripts.php'); 
?>