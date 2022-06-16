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
}else{
      echo '<script language="javascript">alert("Please login to view!"); window.location.href="signin.php";</script>';
    }

if(isset($_POST['addreport'])){
    $projectid = $_POST['id'];
    $file = $_FILES['file'];
    $report = $_FILES['file']['name'];
    move_uploaded_file($file["tmp_name"],"files/" . $file["name"]);
    $location = "files/$report";
    $insert = "INSERT into files (projectID, filename, pathname) values ('$projectid','$report', '$location')";
    mysqli_query($conn, $insert);
    header('Location: guideline.php?uploaded=1');
}

if(isset($_POST['addguideline'])){
    $file = $_FILES['file'];
    $guideline = $_FILES['file']['name'];
    move_uploaded_file($file["tmp_name"],"files/" . $file["name"]);
    $location = "files/$guideline";
    $insert = "INSERT into files (filename, pathname) values ('$guideline', '$location')";
    mysqli_query($conn, $insert);
    header('Location: guideline.php?uploaded=1');
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
<div class="container ml-auto mr-auto">
<div class="rounded row text-dark bg-white p-3 shadow-lg">
    <div class="col-sm-4 col-lg-3">
            <div class="nav flex-column nav-pills w-10" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-guidelines-tab" data-toggle="pill" href="#v-pills-guidelines" role="tab" aria-controls="v-pills-guidelines" aria-selected="true"><i class="fas fa-star"></i> General FYP Guideline</a>
              <a class="nav-link" id="v-pills-past-tab" data-toggle="pill" href="#v-pills-past" role="tab" aria-controls="v-pills-past" aria-selected="false"><i class="fas fa-folder"></i> Past Project Reports</a>
              <?php if($usertype=="lect"){
              ?>
              <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-cogs"></i> Settings</a>
              <?php         
          }?>
            </div>
    </div> <!-- close row -->
    <div class="col-sm-8 col-lg-9 justify-content-md-center">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-guidelines" role="tabpanel" aria-labelledby="v-pills-guidelines-tab"><h2 class="h2-responsive font-weight-bold text-center mb-3"><i class="fas fa-star"></i> FYP Guidelines</h2>
          <div class="md-form mt-5 mb-5">
            <table class="table table-bordered">
              <thead>
                <th>Document</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
              $sql5 = "SELECT * from files where `projectID` IS NULL";
              $res5 = mysqli_query($conn, $sql5);
              $num3 = mysqli_num_rows($res5);
              if($num3>0){
              while($row6 = mysqli_fetch_assoc($res5)){
              ?>
              <tr>
                  <td><?php echo $row6['filename']?></td>
                  <td><a download='<?php echo $row6['pathname']?>' href="download.php?guideline=<?php echo $row6['pathname']?>" class="btn btn-primary">Download</a></td>
              </tr>
              <?php
              }
            }else{
            ?>
            <tr>
                  <td colspan="2" class="text-center">No guidelines found.</td>
              </tr>
            <?php
            }
              ?>
              </tbody>
            </table>
          </div>
        </div>
          <div class="tab-pane fade ml-5 mr-5" id="v-pills-past" role="tabpanel" aria-labelledby="v-pills-past-tab"><h2 class="h2-responsive font-weight-bold text-center mb-3"><i class="fas fa-folder"></i> Past Project Reports</h2>
          <div class="md-form mt-5 mb-5">
            <table class="table table-bordered">
              <thead>
                <th>Document</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
              $sql4 = "SELECT * from files where `projectID` IS NOT NULL AND `projectID` != ''";
              $res4 = mysqli_query($conn, $sql4);
              $num2 = mysqli_num_rows($res4);
              if($num2>0){
              while($row5 = mysqli_fetch_assoc($res4)){
              ?>
              <tr>
                  <td><?php echo $row5['filename']?></td>
                  <td><a download='<?php echo $row5['pathname']?>' href="download.php?report=<?php echo $row5['pathname']?>" class="btn btn-primary">Download</a></td>
              </tr>
              <?php
              }
            }else{
            ?>
            <tr>
                  <td colspan="2" class="text-center">No reports found.</td>
              </tr>
            <?php
            }
              ?>
              </tbody>
            </table>
          </div>

          </div>
          <?php if($usertype=="lect"){
          ?>
          <div class="tab-pane fade ml-5 mr-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"><h2 class="h2-responsive font-weight-bold text-center mb-3"><i class="fas fa-cogs"></i> Settings</h2> 
          <div class="md-form mt-5 mb-5">
          <label for="name"><i class="fas fa-upload"></i> Upload FYP Guidelines</label>
            <form action="guideline.php" method="POST" enctype="multipart/form-data">
              <div class="custom-file mb-5">
                <br><input type="file" name="file" accept=".doc, .docx, .pdf" class="custom-file-input" id="inputGroupFile02" required>
                <label class="custom-file-label" for="inputGroupFile02">Choose File</label>
                <input type="hidden" name="id" value="<?php echo $row3['projectID']?>">
                <button type="submit" class="btn btn-success btn-sm float-right " name="addguideline">Upload</button>
            </form>
          </div>
          <div class="md-form mt-5 mb-2">
              <label for="name"><i class="fas fa-upload"></i> Upload Past Project Report</label>
            <form action="guideline.php" method="POST" enctype="multipart/form-data">
              <div class="custom-file mb-5">
                <br><input type="file" name="file" accept=".doc, .docx, .pdf" class="custom-file-input" id="inputGroupFile01" required>
                <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                <input type="hidden" name="id" value="<?php echo $row4['projectID']?>">
                <button type="submit" class="btn btn-success btn-sm float-right " name="addreport">Upload</button>
            </form>
          </div>
          <?php         
          }?>
          </div>
        </div>
    </div>
</div>
</div>
  <footer class="py-3 bg-dark fixed-bottom">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; FYP Progress Tracker</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $("input[type=file]").change(function () {
        var fieldVal = $(this).val();

        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");

        if (fieldVal != undefined || fieldVal != "") {
            $(this).next(".custom-file-label").attr('data-content', fieldVal);
            $(this).next(".custom-file-label").text(fieldVal);
        }
        if (fieldVal != undefined || fieldVal != "") {
            $(this).next(".custom-file-label").attr('data-content', fieldVal);
            $(this).next(".custom-file-label").text(fieldVal);
        }
    });

  </script>
</body>

</html>
