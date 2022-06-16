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

if(isset($_POST['addlog'])){
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $date = Date('Y-m-d');
  $work = $_POST['work'];
  $hrs = $_POST['hours'];
  $remark = $_POST['remarks'];

  $sql3 = "SELECT * from projects where studID='".$_SESSION['user']."'";
  $res3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($res3);

  $insert = "INSERT into logbooks (projectID, studID, date, work, hrs, remarks) values ('".$row3['projectID']."','".$_SESSION['user']."','$date', '$work', '$hrs', '$remark')";
  mysqli_query($conn, $insert);
  header('Location: log.php?added=1');
}
if(isset($_POST['delete'])){
  $id = $_POST['logID'];
  $sql5 = "DELETE from logbooks where logID='$id'";
  mysqli_query($conn, $sql5);
  header('Location: log.php?deleted=1');
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
	<section class="rounded col-md-6 col-lg-4 my-auto mx-auto text-dark bg-white p-5 shadow-lg">
  <?php
    if (isset($_GET['added']) && $_GET['added'] == 1 )
    {
        echo     "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='fas fa-check-circle'></i> 
                  Logbook has been updated!</div>";
    }else if (isset($_GET['deleted']) && $_GET['deleted'] == 1 )
    {
        echo     "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='fas fa-check-circle'></i> 
                  Log has been deleted!</div>";
    }
  ?>  
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4"><i class="fas fa-plus-square"></i> Update Logbook</h2>
    <div class="row mx-auto pt-4">
        <div class="col-md-12">
          <form action="log.php" method="POST">
          <label>Work</label>
          <textarea class="form-control mb-3" name="work" placeholder="Enter Work Done" required></textarea>
          <label>Hours</label>
          <input type="number" name="hours" class="form-control mb-3" placeholder="Enter Hours Spent" required>
          <label>Remarks</label>
          <textarea class="form-control mb-3" name="remarks" placeholder="Enter Remarks" required></textarea>
          <button type="submit" name="addlog" class="mt-3 btn btn-success float-right">Add to Logbook</button>
        </div>
      </form>
    </div> 
  </section>

<section class="rounded col-lg-4 col-xl-6 mx-auto text-dark bg-white p-5 mt-5 shadow-lg">
  <div class="row mx-auto pt-4">
      <div class="col-md-12">
      <h2 class="h1-responsive font-weight-bold text-center my-4"><i class="fas fa-tasks"></i> Your logbook</h2>
      <table class="table table-bordered">
        <thead>
          <th>Date</th>
          <th>Work Done</th>
          <th>Hours</th>
          <th>Remarks</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php
          $sql4 = "SELECT * from logbooks where studID='".$_SESSION['user']."'";
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
            <td>
              <form method="POST" action="log.php">
              <input type="hidden" name="logID" value="<?php echo $row4['logID']?>">
              <button class="btn btn-danger" name="delete">Delete</button>
              </form>
            </td>
          </tr>
          <?php
          }
        }else{
        ?>
        <tr>
          <td colspan="5" class="text-center">No logs found.</td>
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
