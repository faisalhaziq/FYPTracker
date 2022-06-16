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
    <h2 class="h1-responsive font-weight-bold text-center my-4">Project List</h2>
    <div class="row">
        <!--Grid column-->
        <div class="col-sm-8 col-md-12 mb-md-0 mb-5">
                <!--Grid row-->
                <div class="row">
                    <table class="table table-bordered">
                      <thead>
                        <th>Student</th>
                        <th class="text-center">Log</th>
                        <th class="text-center">Project</th>
                        <th class="text-center">Tasks</th>
                      </thead>
                      <tbody>
                      <?php
                      $sql3 = "SELECT * from projects where lectID='".$_SESSION['user']."'";
                      $res3 = mysqli_query($conn, $sql3);
                      $num = mysqli_num_rows($res3);
                      if($num>0){
                      while($row3 = mysqli_fetch_assoc($res3)){
                      ?>
                      <tr>
                      <th><?php echo $row3['studID']?></th>
                      <th class="text-center"><a href="viewlog.php?ID=<?php echo $row3['projectID']; ?>" class="btn btn-danger btn-sm">View</a></th>
                      <th class="text-center"><a href="viewproject.php?ID=<?php echo $row3['projectID']; ?>" class="btn btn-danger btn-sm">View</a></th>
                      <th class="text-center"><a href="viewtasks.php?ID=<?php echo $row3['projectID']; ?>" class="btn btn-danger btn-sm">View</a></th>
                      </tr>
                      <?php
                      }
                    }else{
                    ?>
                    <tr class="text-center"><th colspan="4">No Projects Found</th></tr>
                    <?php
                    }
                      ?> 
                      </tbody>
                    </table>
                </div>
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
