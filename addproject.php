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

if(isset($_POST['add'])){
  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $lect = $_POST['lect'];

  $sql4 = "INSERT INTO projects (project_title, projectDesc, studID, lectID) values ('$title', '$desc', '".$_SESSION['user']."', '$lect')";
  mysqli_query($conn, $sql4);
  header('Location: addproject.php?added=1');
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
  <div class="mb-5">
  </div>
  <!-- Page Content -->
	<section class="rounded col-sm-6 col-lg-4 mx-auto text-dark bg-white p-5 shadow-lg">
    <!--Section heading-->
    <?php
    if (isset($_GET['added']) && $_GET['added'] == 1 )
    {
        echo     "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='fas fa-check-circle'></i> 
                  Project has been added!</div>";
    }
    ?>
    <h2 class="h2-responsive font-weight-bold text-center mb-3"><i class="fas fa-pen"></i> Add a project</h2>
    <div class="row mx-auto">
        <div class="col-sm-8 col-md-12 mb-md-0 mb-5">
            <form action="addproject.php" method="POST">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="name">Project Title</label>
                          <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-2">
                          <label for="name">Lecturer Name</label>
                          <select class="form-control" name="lect">
                            <option>Choose a Lecturer</option>
                            <?php
                            $sql3 = "SELECT * from lecturers";
                            $res3 = mysqli_query($conn, $sql3);
                            while($row3 = mysqli_fetch_assoc($res3)){
                            ?>
                            <option value="<?php echo $row3['lectID']; ?>"><?php echo $row3['fullname']; ?> </option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-2">
                          <label for="name">Project Description</label>
                          <textarea class="form-control" rows="5" name="desc"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="mt-4 btn btn-block btn-success" name="add">Add Project</button>
            </form>  
        </div>  
    </div> <!-- close row -->
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
