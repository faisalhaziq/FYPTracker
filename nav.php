<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">FYP Progress Tracker</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
          if (isset($_SESSION['user']) && $_SESSION['user'] != NULL){
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
          if($usertype=="stud"){
          ?>
          <li class="nav-item">
            <a class="nav-link" href="project.php">Project</a>
          </li>
          <?php
            $sql3 = "SELECT * from projects where studID='".$_SESSION['user']."'";
            $res3 = mysqli_query($conn, $sql3);
            $num = mysqli_num_rows($res3);
            if($num>0){
            ?>
              <li class="nav-item">
                <a class="nav-link" href="tasks.php">Tasks</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="log.php">Logbook</a>
              </li>
          <?php
            }else{
              }
          }else{
          ?>
          <li class="nav-item">
            <a class="nav-link" href="projectlist.php">Project List</a>
          </li>
          <?php
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="announcements.php">Announcements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="guideline.php">Guidelines</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="ml-2 nav-link" href="profile.php">
            <i class="fas fa-user"></i> Profile</a>
          </li>
          <li class="nav-item">
            <a class=" ml-2 btn btn-danger" href="logout.php">Logout</a>
          </li>
          <?php
          }else{
            ?>
          </ul>
          <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class=" ml-2 btn btn-light" href="signin.php">Login</a>
          </li>
          <li class="nav-item">
            <a class=" ml-2 btn btn-light" href="register.php">Register</a>
          </li>
            <?php
          }
        ?>
        </ul>
      </div>
    </div>
  </nav>
