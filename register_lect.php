<?php
session_start();
include("connection.php");

if(isset($_POST['reg_btn'])){
$lectid = $_POST['lectid'];
$name = $_POST['name'];
$tel = $_POST['num'];
$pass = $_POST['pass'];
$dept = $_POST['dept'];
$s = "select * from lecturers where Lect_ID = '$lectid'";
$result = mysqli_query($conn, $s);

$file = $_FILES['file'];
$images = $_FILES['file']['name'];
move_uploaded_file($file["tmp_name"],"profilepics/".$lectid."_". $file["name"]);
$location = "".$lectid."_".$images."";

$num = mysqli_num_rows($result);
if($num == 1)
{
  echo '<script language="javascript">alert("ID has already been registered!"); window.location.href="login.php";</script>';
}
else{
  $reg = "insert into lecturers(Lect_ID, Lect_Name, Lect_Pass, Lect_Num, Lect_Dept, image) values ('$lectid', '$name', '$pass', '$tel', '$dept', '$location')";
  mysqli_query($conn, $reg);
  echo '<script language="javascript">alert("Successfully Registered!\nPlease login with your credentials..."); window.location.href="login.php";</script>';
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
                <h1 class="h4 text-gray-900 mb-4">Register as Lecturer</h1>
                <?php
                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                        unset($_SESSION['status']);
                    }
                ?>
              </div>

                <form class="user" action="register_lect.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                    <div class="form-group">
                    <label>Lecturer ID</label>
                    <input type="text" name="lectid" class="form-control" placeholder="Enter Lecturer ID" required>
                    </div>

                    <div class="form-group">
                    <label>Full Name</label>  
                    <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required autocomplete="OFF">
                    </div>

                    <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
                    </div>

                    
                    </div>
                    <div class="col">
                    <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="num" class="form-control" placeholder="Enter Phone Number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </div>
                    <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="dept" class="form-control" placeholder="Enter Department">
                    </div>


                    <label>Profile Picture</label>
                    <div class="custom-file mb-3">
                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" required accept=".png, .jpg">
                    <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                    </div>
                    </div>
                    <hr>
                    <button type="submit" name="reg_btn" class="btn btn-primary btn-user btn-block mt-3"> Register </button>
                </form>
                    <div class="text-center mx-auto">
                      <a href="index.php" class="btn btn-success mt-3"><i class="fas fa-home"></i> Home</a>
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