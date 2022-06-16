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
	<section class="rounded col-md-6 col-lg-4 my-auto mx-auto text-dark bg-white p-5 shadow-lg">
    <!--Section heading-->
    <div class="row mx-auto pt-4">
      <div class="col-md-12">
    <h2 class="h1-responsive font-weight-bold text-center my-4"><i class="fas fa-tasks"></i> Project Tasks</h2>
    <ul class="list-group list-group-flush">
      <?php 
      $totaltasks = "SELECT * from tasks WHERE projectID='$projectID'";
      $result = mysqli_query($conn, $totaltasks);
      $num2 = mysqli_num_rows($result);

      if($num2==0){

      }else{
      ?>
      <div class="md-form mb-2">
            <?php
              $progress = "SELECT * from tasks WHERE status=1 AND projectID='$projectID'";
              $resprog = mysqli_query($conn, $progress);
              $complete = mysqli_num_rows($resprog);
              $counttasks = "SELECT * from tasks WHERE projectID='$projectID'";
              $restasks = mysqli_query($conn, $counttasks);
              $numtasks = mysqli_num_rows($restasks);
              $width = ($complete/$numtasks)*100;
              $width = round($width, 1);
              ?>  
            <label for="name">Project Progress: <b><?php echo $width?>%</b></label>
            <div class="progress" style="height:20px">
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="<?php echo $width; ?>" aria-valuemin="0" aria-valuemax="100" style="height:20px; width: <?php echo $width;?>%"></div>
            </div>
      </div>
      <?php
      }
      ?>
      
    <?php
    $student = "SELECT * from projects where studID='".$_SESSION['user']."'";
    $res4 = mysqli_query($conn, $student);
    $row4 = mysqli_fetch_assoc($res4);

    $sql5 = "SELECT * from tasks where projectID='$projectID'";
    $res5 = mysqli_query($conn, $sql5);
    $num = mysqli_num_rows($res5);

    if ($num >0){
      while($row5 = mysqli_fetch_assoc($res5)){
    ?>
    <div class="col-md-12">
          
      </div>
      <li class="list-group-item">
        <label><b><?php 
        $sql6 = "SELECT * from tasktopics where topicID='".$row5['topicID']."'";
        $res6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_assoc($res6);
        echo $row6['topicName'];
        ?></b></label>

        <div class="custom-checkbox">
          <?php if($row5['status']==1){
          ?>
          <i class="far fa-check-square fa-lg"></i> 
          <?php
          }else{
          ?>
          <i class="far fa-square fa-lg"></i>  
          <?php
          }
          ?>
          <label><?php echo $row5['taskDesc']; ?></label>
          <?php if($row5['status']==1){
          }else{
          }
          ?>
        </div>
      </li>
    <?php
      }
    }else{
    ?>
    <p class="text-center">No tasks to be found.</p>
    <?php
    }
    ?>
    </ul>
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
