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
    }else{
      echo '<script language="javascript">alert("Please login to view!"); window.location.href="signin.php";</script>';
    }
  }
}

if(isset($_POST['updatestud'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $ID = $_POST['ID'];
  $pass = $_POST['pass'];
  $intake = $_POST['intake'];
  $major = $_POST['major'];
  $phone = $_POST['phone'];

  $update = "UPDATE students SET fullname='$name', email='$email', studID='$ID', password='$pass', major='$major', intake='$intake', phone='$phone' WHERE studID='".$_SESSION['user']."'";
  mysqli_query($conn, $update);
  echo '<script language="javascript">alert("Profile edited successfully!"); window.location.href="profile.php";</script>';
}

if(isset($_POST['updatelect'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $ID = $_POST['ID'];
  $pass = $_POST['pass'];
  $phone = $_POST['phone'];
  $update = "UPDATE lecturers SET fullname='$name', email='$email', lectID='$ID', password='$pass',phone='$phone' WHERE lectID='".$_SESSION['user']."'";
  mysqli_query($conn, $update);
  echo '<script language="javascript">alert("Profile edited successfully!"); window.location.href="profile.php";</script>';
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
<body style="background-color: #CD5C5C; margin-bottom:200px;" >
  <!-- Navigation -->
  <?php include("nav.php");?>
  <div class="mb-5">
  </div>
  <!-- Page Content -->
	<section class="rounded col-md-6 col-lg-4 my-auto mx-auto text-dark bg-white p-5 shadow-lg">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4"><i class="fas fa-user"></i> Profile</h2>
    <div class="row">
        <!--Grid column-->
        <div class="col-sm-8 col-md-12 mb-md-0 mb-5">
            <form action="profile.php" method="POST">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="name" class="">Name</label>
                          <input type="text" id="name" name="name" class="form-control" value="<?php 
                          if($usertype=="stud"){
                            echo $row['fullname'];
                          }else{
                            echo $row2['fullname'];
                          }
                          ?>" required>
                        </div>
                    </div>
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="email" class="">Email</label>
                          <input type="text" id="email" name="email" class="form-control" value="<?php 
                          if($usertype=="stud"){
                            echo $row['email'];
                          }else{
                            echo $row2['email'];
                          }
                          ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="name" class=""><?php 
                          if($usertype=="stud"){
                            echo "Student ID";
                          }else{
                            echo "Lecturer ID";
                          }
                          ?></label>
                          <input type="text" id="ID" name="ID" class="form-control" value="<?php 
                          if($usertype=="stud"){
                            echo $row['studID'];
                          }else{
                            echo $row2['lectID'];
                          }
                          ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="name" class="">Password</label>
                          <input type="password" id="pass" name="pass" class="form-control" value="<?php 
                          if($usertype=="stud"){
                            echo $row['password'];
                          }else{
                            echo $row2['password'];
                          }
                          ?>" required>
                        </div>
                    </div>
                    <?php if($usertype=="stud"){
                    ?>
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="major" class="">Major</label>
                          <input type="text" id="major" name="major" class="form-control" value="<?php 
                          if($usertype=="stud"){
                            echo $row['major'];
                          }
                          ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="intake" class="">Intake</label>
                          <input type="text" id="intake" name="intake" class="form-control" value="<?php 
                          if($usertype=="stud"){
                            echo $row['intake'];
                          }
                          ?>" readonly required>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="phone" class="">Phone</label>
                          <input type="text" id="phone" name="phone" class="form-control" value="<?php 
                          if($usertype=="stud"){
                            echo $row['phone'];
                          }else{
                            echo $row2['phone'];
                          }
                          ?>" required>
                        </div>
                    </div>
                </div>
                <!--Grid row-->
                <div class="mt-3 text-center text-md-right">
                <?php if($usertype=="stud"){
                ?>
                <button type="submit" name="updatestud" class="btn btn-success">Update</button>
                <?php
                }else{
                ?>
                <button type="submit" name="updatelect" class="btn btn-success">Update</button>
                <?php
                }
                ?>
                
            </div>
            </form>
        </div>
        <!--Grid column-->
    </div>
</section>

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
