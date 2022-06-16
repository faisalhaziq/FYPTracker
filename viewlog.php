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
$projectID = $_GET['ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>FYP Progress Tracker</title>
  <style>
      input.larger {
        width: 20px;
        height: 20px;
      }
    </style>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/heroic-features.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/fontawesome-free-5.14.0-web/css/all.css">
</head>
<body style="background-color: #CD5C5C; padding-bottom:200px;">
  <!-- Navigation -->
  <?php include("nav.php");?>
  <div class="mb-5">
  </div>
  <!-- Page Content -->
	<section class="rounded col-md-6 col-lg-6 my-auto mx-auto text-dark bg-white p-5 shadow-lg">
  <?php
    if (isset($_GET['added']) && $_GET['added'] == 1 )
    {
        echo     "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='fas fa-check-circle'></i> 
                  Logbook has been updated!</div>";
    }
  ?>  
    <div class="row mx-auto">
      <div class="col-md-12">
      <h2 class="h1-responsive font-weight-bold text-center my-4"><i class="fas fa-tasks"></i> Student Logbook</h2>
      <table class="table table-bordered">
        <thead>
          <th>Date</th>
          <th>Work Done</th>
          <th>Hours</th>
          <th>Remarks</th>
        </thead>
        <tbody>
          <?php
          $sql4 = "SELECT * from logbooks where projectID='$projectID'";
          $res4 = mysqli_query($conn, $sql4);
          $num = mysqli_num_rows($res4);

          if ($num>0){
          while($row4 = mysqli_fetch_assoc($res4)){
          ?>
          <tr>
            <td>
              <?php echo $row4['date']?>
            </td>
            <td>
              <?php echo $row4['work']?>
            </td>
            <td>
              <?php echo $row4['hrs']?>
            </td>
            <td>
              <?php echo $row4['remarks']?>
            </td>
          </tr>
          <?php
          }
        }else{
        ?>
        <tr>
          <td colspan="4" class="text-center">No logs found.</td>
        </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
      </div>
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
