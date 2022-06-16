<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['login'] == '1') {
  header ("Location: dashboard/dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Attendance Tracker</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.css" rel="stylesheet">

</head>

<body class="overflow-hidden">

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Attendance Tracker</a>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center" style="">
    <div class="overlay"></div>
    <div class="container h-100">
      <div class="row" style="height:530px;">
        <div class="col-xl-9 mx-auto mt-5">
          <h1 class="mb-5 mt-5">Attendance Tracker!
            <p style="font-size:13pt; font-weight: normal;">An online attendance tracker, stop using paper and save the environment!</p>
            <div class="row text-center mt-3">
              <div class="col">
                <a href="login.php" class="btn btn-primary">Sign In</a>
                <a href="register.php" class="btn btn-success">Register</a>
              </div>
          </div>
          </h1>
        </div>
      </div>
    </div>
  </header>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
