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

if(isset($_POST['send'])){
  $text = $_POST['comment'];
  $sql3 = "SELECT * from projects where studID='".$_SESSION['user']."'";
  $res5 = mysqli_query($conn, $sql3);
  $row5 = mysqli_fetch_assoc($res5);

  $insert = "INSERT into comments (comment, postedby, projectID) values ('$text', '".$_SESSION['user']."', '".$row5['projectID']."')";
  mysqli_query($conn, $insert);
  header("Location: project.php?commented=1");
}

if(isset($_POST['upload'])){
    $id = $_POST['id'];
    $file = $_FILES['file'];
    $project = $_FILES['file']['name'];
    move_uploaded_file($file["tmp_name"],"files/" . $file["name"]);
    $location = "files/$project";
    $insert = "INSERT into projectfiles (projectID, filename, pathname) values ('$id', '$project', '$location')";
    mysqli_query($conn, $insert);
    header('Location: project.php?uploaded=1');
  }
if(isset($_POST['delete'])){
    $id = $_POST['fileID'];
    $sqldel = "DELETE from projectfiles where fileID='$id'";
    mysqli_query($conn, $sqldel);
    header('Location: project.php?deleted=1');
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
<body style="background-color: #CD5C5C; padding-bottom:200px;">
  <!-- Navigation -->
  <?php include("nav.php");?>
  <div class="mb-5">
  </div>
  <!-- Page Content -->
	<div class="row my-auto mx-auto">
    <!--Section heading-->
  <div class="col-md-6 col-xl-5 mx-auto rounded text-dark bg-white p-5 shadow-lg">
    <h2 class="h1-responsive font-weight-bold text-center my-4"><i class="fas fa-pen"></i> Your Project</h2>
    <div class="row mx-auto">
        <!--Grid column-->
        <?php 
        $projectcheck = "SELECT * from projects where studID='".$_SESSION['user']."'";
        $res3 = mysqli_query($conn, $projectcheck);
        $row3 = mysqli_fetch_assoc($res3);
        $num = mysqli_num_rows($res3);

        if ($num>0){
        ?>
        <div class="col-md-6">
          <div class="md-form mb-2">
            <label for="name">Project Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo $row3['project_title']?>" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="md-form mb-2">
            <label for="name">Lecturer Name</label>
            <input type="text" name="title" class="form-control" value="<?php 
            $lect = "SELECT * from lecturers where lectID='".$row3['lectID']."'";
            $res4 = mysqli_query($conn, $lect);
            $row4 = mysqli_fetch_assoc($res4);
            echo $row4['fullname']?>" readonly>
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
              }else if (isset($_GET['deleted']) && $_GET['deleted'] == 1 ){
                echo     "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <i class='fas fa-check-circle'></i> 
                            Document has been deleted!</div>";
              }
            ?>
            <table class="table table-bordered">
            <thead>
              <th>Document Name</th>
              <th class="w-25 text-center" colspan="2">Action</th>
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
              <td class="w-25 text-center"><a download="<?php echo $docrow['pathname'];?>" href='download.php?dow=<?php echo $docrow['pathname'];?>' class="btn btn-sm btn-primary"><i class="fas fa-cloud-download-alt"></i> Download</a></td>

              <td class="w-25 text-center">
                <form action="project.php" method="POST">
                  <input type="hidden" name="fileID" value="<?php echo $docrow['fileID'];?>">
                <button class="btn btn-sm btn-danger" name="delete"><i class="fas fa-trash"></i> Delete</button></form></td>
            </tr>
            <?php
            }
          }else{
          ?>
          <tr>
              <td colspan="2">No documents found.</td>
          </tr>  
          <?php
          }
            ?>
            
            </tbody>
            </table>
            <label for="name"><i class="fas fa-upload"></i> Upload Documents</label>
            <form action="project.php" method="POST" enctype="multipart/form-data">
              <div class="custom-file mb-5">
                <br><input type="file" name="file" accept=".zip" class="custom-file-input" id="inputGroupFile01" required>
                <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                <input type="hidden" name="id" value="<?php echo $row3['projectID']?>">
                <button type="submit" class="btn btn-success btn-sm float-right " name="upload">Upload</button>
            </form>
            </div>
          </div>
        </div>
    </div>
        <?php
        }else{
        ?>
        <div class="col-sm-8 col-md-12 text-center">
          <p>No projects found, want to add a project?</p>
          <a href="addproject.php" class=" btn btn-light btn-outline-success">Add Project</a>
        </div>
    </div>
        <?php
        }
        ?>
  </div>

  <footer class="py-3 bg-dark fixed-bottom">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; FYP Progress Tracker</p>
    </div>
    <!-- /.container -->
  </footer>
</div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<div class="row mx-auto">
  <?php
  $sql6 = "SELECT * from projects where studID='".$_SESSION['user']."'";
  $res6 = mysqli_query($conn, $sql6);
  $num2 = mysqli_num_rows($res6);

  if($num2>0){
  ?>
  <!-- comments -->
  <div class="col-md-4 col-xl-5 mt-5 mx-auto">
  <div class="mx-auto rounded text-dark bg-white p-5 shadow-lg">
    <?php
    if (isset($_GET['commented']) && $_GET['commented'] == 1 )
    {
        echo     "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='fas fa-check-circle'></i> 
                  Your comment has been added!</div>";
    }
  ?>  
    <h2 class="h1-responsive font-weight-bold text-center"><i class="fas fa-comments"></i> Project Comments</h2>
    <div class="col-md-12 pb-5">
          <div class="md-form mb-2">
            <form method="POST" action="project.php">
            <label>Send a comment</label><textarea class="form-control" name="comment" required></textarea>
            <button type="submit" class="btn btn-sm btn-secondary float-right mt-3" name="send">Comment</button>
          </form>
          </div>
    </div>
    <div class="col-md-12">
          <div class="md-form mb-2 mt-3 border rounded pt-2 pl-2 pr-2">
            <h5 class="mb-4"><b>Comments</b></h5>
            <?php
            $sql4 = "SELECT * from projects where studID='".$_SESSION['user']."'";
            $proj = mysqli_query($conn, $sql4);
            $rowproj = mysqli_fetch_assoc($proj);
            $sql5 = "SELECT * from comments where projectID='".$rowproj['projectID']."'";
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
  </div>
</div>
</div>
  <?php
  }else{

  }
  ?>
  <script>
    $("input[type=file]").change(function () {
        var fieldVal = $(this).val();

        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");

        if (fieldVal != undefined || fieldVal != "") {
            $(this).next(".custom-file-label").attr('data-content', fieldVal);
            $(this).next(".custom-file-label").text(fieldVal);
        }
    });
  </script>
</body>

</html>
