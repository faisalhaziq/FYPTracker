<?php
session_start();
include("connection.php");

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
<div class="container">
<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-7 col-lg-7 col-md-8" style="margin-top:50px;">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row h-100">
          <div class="col-lg-12 h-100">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register</h1>
              </div>
                <form class="user" action="register_user.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                    <div class="form-group">
                    <label>Matrics Number</label>
                    <input type="text" name="matricnum" class="form-control" placeholder="Enter Matrics Num" required>
                    </div>

                    <div class="form-group">
                    <label>Full Name</label>  
                    <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required autocomplete="OFF">
                    </div>

                    <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
                    </div>

                    <div class="form-group">
                    <label>Profile Picture</label>
                      <div class="custom-file">
                      <input type="file" name="file" class="custom-file-input" accept=".png,.jpg" id="inputGroupFile01" required>
                      <label class="custom-file-label" for="inputGroupFile01">Upload File</label>
                      </div>
                    </div>
                    </div>

                    <div class="col">
                    <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="num" class="form-control" placeholder="Enter Phone Number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </div>
                    <div class="form-group">
                    <label>Parents Phone Number</label>
                    <input type="tel" name="pnum" class="form-control" placeholder="Enter Phone Number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </div>
                    <div class="form-group">
                    <label>Supervisor Name</label>  
                    <input type="text" name="supervisor" class="form-control" placeholder="Enter Supervisor Name" required>
                    </div>
                    </div>
                    <hr>
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block mt-3"> Register </button>
                </form>
                    <div class="text-center mx-auto">
                      <a href="index.php" class="btn btn-success mt-3"><i class="fas fa-home"></i> Home</a>
                      <a href="register_lect.php" class="btn btn-success mt-3">Register as Lecturer</a>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

</div>
<?php
include('dashboard/includes/scripts.php');
?>
</body>
</html>

