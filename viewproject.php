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

if(isset($_POST['send'])){
  $text = $_POST['comment'];

  $insert = "INSERT into comments (comment, postedby, projectID) values ('$text', '".$_SESSION['user']."', '$projectID')";
  mysqli_query($conn, $insert);
  header("Location: viewproject.php?ID=$projectID&commented=1");
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
    <?php
    $projectcheck = "SELECT * from projects where projectID='$projectID'";
    $res3 = mysqli_query($conn, $projectcheck);
    $row3 = mysqli_fetch_assoc($res3);
    $num = mysqli_num_rows($res3);
    ?>
    <h2 class="h1-responsive font-weight-bold text-center my-4">Project</h2>
    <div class="row">
        <!--Grid column-->
        <div class="col-sm-8 col-md-12 mb-md-0 mb-5">
                <!--Grid row-->
                <?php
                  if ($num>0){
                  ?>
                <div class="row mx-auto">
                  <!--Grid column-->
                  <div class="col-md-6">
                    <div class="md-form mb-2">
                      <label for="name">Project Title</label>
                      <input type="text" name="title" class="form-control" value="<?php echo $row3['project_title']?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form mb-2">
                      <label for="name">Student Name</label>
                      <input type="text" name="title" class="form-control" value="<?php echo $row3['studID']?>" readonly>
                    </div>
                  </div>
                  
              </div>
              <div class="row mx-auto">
                  <div class="col-md-12">
                    <div class="md-form mb-2">
                      <label for="name">Project Description</label>
                      <textarea class="form-control" name="desc" readonly><?php echo $row3['projectDesc']?>
                      </textarea>
                    </div>
                  </div>
              </div>
              <div class="row mx-auto">
        <div class="col-md-12">
          <div class="md-form mb-2">
            <label for="name">Project Documents</label>
            <?php
            if (isset($_GET['uploaded']) && $_GET['uploaded'] == 1 )
              {
                  echo     "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <i class='fas fa-check-circle'></i> 
                            Document has been uploaded!</div>";
              }
            ?>
            <table class="table table-bordered">
            <thead>
              <th>Document Name</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
            <?php
            $doc = "SELECT * from projectfiles where projectID='".$row3['projectID']."'";
            $docres = mysqli_query($conn, $doc);
            $numdoc = mysqli_num_rows($docres);
            if($numdoc>0){
            while ($docrow = mysqli_fetch_assoc($docres)){
            ?>
            <tr>
              <td><?php echo $docrow['filename']?></td>
              <td class="text-center"><a download="<?php echo $docrow['pathname'];?>" href='download.php?dow=<?php echo $docrow['pathname'];?>' class="btn btn-sm btn-primary"><i class="fas fa-cloud-download-alt"></i> Download</a></td>
            </tr>
            <?php
            }
          }else{
          ?>
          <tr>
              <td colspan="2" class="text-center">No documents found.</td>
          </tr>  
          <?php
          }
            ?>
            </tbody>
            </table>
            </div>
          </div>
        </div>
              <?php
                }
                ?>
        </div>
        <!--Grid column-->
    </div>
</section>

<section class="mt-5 rounded col-md-6 col-lg-4 mx-auto text-dark bg-white p-5 shadow-lg">
    <!--Section heading-->
    <?php
    $projectcheck = "SELECT * from projects where projectID='$projectID'";
    $res3 = mysqli_query($conn, $projectcheck);
    $row3 = mysqli_fetch_assoc($res3);
    $num = mysqli_num_rows($res3);
    ?>
    <h2 class="h1-responsive font-weight-bold text-center my-4">Comments</h2>
    <div class="col-md-12 pb-5">
          <div class="md-form mb-2">
            <form method="POST" action="viewproject.php?ID=<?php echo $projectID;?>">
            <label>Send a comment</label><textarea class="form-control" name="comment" required></textarea>
            <button type="submit" class="btn btn-sm btn-secondary float-right mt-3" name="send">Comment</button>
          </form>
          </div>
    </div>
    <div class="col-md-12">
          <div class="md-form mb-2 mt-3 border rounded pt-2 pl-2 pr-2">
            <h5 class="mb-4"><b>Comments</b></h5>
            <?php
            $sql5 = "SELECT * from comments where projectID='$projectID'";
            $comments = mysqli_query($conn, $sql5);
            
            while($rowcom = mysqli_fetch_assoc($comments)){
            ?>
            <p class="border-bottom mb-5">
            <?php echo $rowcom['comment']?><br><span class="float-right">Posted by <b><?php echo $rowcom['postedby']?></b></span></p>
            <?php
            }
            ?>
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
