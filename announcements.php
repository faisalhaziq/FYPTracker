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

if(isset($_POST['addannounce'])){
  $details = $_POST['announce'];

  $insert = "INSERT into announcements (announcement) values ('$details')";
  mysqli_query($conn, $insert);
  header('Location: announcements.php?added=1');
}
if(isset($_POST['delannounce'])){
  $id = $_POST['ID'];
  $delete = "DELETE from announcements where announceID='$id'";
  mysqli_query($conn, $delete);
  header('Location: announcements.php?deleted=1');
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
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Announcements</h2>
    <div class="row mx-auto">
        <div class="col-md-12">
          <?php 
          $sql3 = "SELECT * from announcements";
          $res3 = mysqli_query($conn, $sql3);
          $num = mysqli_num_rows($res3);

          if($num>0){
          while($row3 = mysqli_fetch_assoc($res3)){
          ?>
          <div class='alert alert-dark alert-dismissible fade show' role='alert'>
            <span class="badge badge-primary mr-2"><i class="fas fa-exclamation-circle"></i> Announcement</span><?php echo $row3['announcement'] ?></div>
          <?php
          }
        }else{
        ?>
          <p class="h1-responsive text-center my-4">No Announcements!</p>
        <?php
          }
        ?>
        
        </div>
    </div>
  </section>

  <?php 
  if($usertype!="stud"){
  ?>
  <section class="mt-3 rounded col-md-6 col-lg-4  mx-auto text-dark bg-white p-5 shadow-lg">
    <!--Section heading-->
    <?php
    if (isset($_GET['added']) && $_GET['added'] == 1 )
    {
        echo     "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='fas fa-check-circle'></i> 
                  Announcement added!</div>";
    }else if (isset($_GET['deleted']) && $_GET['deleted'] == 1 )
    {
        echo     "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='fas fa-check-circle'></i> 
                  Announcement deleted!</div>";
    }
    ?>
    <h2 class="h1-responsive font-weight-bold text-center my-4">Create Announcement</h2>
    <div class="row mx-auto pt-4">
        <div class="col-md-12">
          <form action="announcements.php" method="POST">
          <input type="text" class="form-control" placeholder="Enter Announcement" name="announce" required>
          <button type="submit" name="addannounce" class="mt-3 btn btn-primary float-right">Announce</button>
          </form>
        </div>
    </div>
  </section>

  <section class="mt-3 rounded col-md-6 col-lg-4  mx-auto text-dark bg-white p-5 shadow-lg">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">List of Announcements</h2>
    <div class="row mx-auto">
        <div class="col-md-12">
          <table class="table table-responsive text-center">
            <thead>
              <th class="w-100 text-left">Announcement</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php 
              $sql3 = "SELECT * from announcements";
              $res3 = mysqli_query($conn, $sql3);
              while($row3 = mysqli_fetch_assoc($res3)){
              ?>
              <tr>
              <td class="text-left"><?php echo $row3['announcement']?></td>
              <td>
              <form action="announcements.php" method="POST">
              <input type="hidden" name="ID" value="<?php echo $row3['announceID']?>">
              <button type="submit" name="delannounce" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
              </form>
              </td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
    </div>
  </section>
  <?php
  }
  ?>
  
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
