<?php
  require_once(__DIR__ . '/../includes/dbconfig.php');
  session_start();
  // if(!isset($_SESSION['id'])) {
  //   header('Location: ../signintemp/stud_signin.php');
  // }
  $id = $_SESSION['id'];
  $query = "SELECT * FROM job_post WHERE timestamp >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
  if(isset($_GET['view']) && $_GET['view']=='old')
    $query = "SELECT * FROM application, job_post WHERE application.stud_id = $id AND application.post_id = job_post.id ORDER BY application.timestamp DESC";

    //echo $query;
  $result = mysqli_query($dbc,$query);

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php?view=new">Job Posts
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php?view=old">My Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Job Posts
            <!-- <small>Secondary Text</small> -->
          </h1>

          <?php
            if(isset($_GET['view']) && $_GET['view']=='old') {
              if (mysqli_num_rows($result) != 0) {
              while ($row = mysqli_fetch_array($result)) { ?>
                <div class="card mb-4">
                  <!-- <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> -->
                  <div class="card-body">
                    <h2 class="card-title"><?php echo $row['title']; ?></h2>
                    <p class="card-text"><?php echo $row['details']; ?></p>
                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
                  </div>
                  <!-- <div class="card-footer text-muted"> -->
                    <!-- Posted on January 1, 2017 -->
                    <!-- <a href="#">Start Bootstrap</a> -->
                  <!-- </div> -->
                </div>
            <?php
              }
            }
            } else {
              if (mysqli_num_rows($result) != 0) {
              while ($row = mysqli_fetch_array($result)) { ?>
                <div class="card mb-4">
                  <!-- <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> -->
                  <div class="card-body">
                    <h2 class="card-title"><?php echo $row['title']; ?></h2>
                    <p class="card-text"><?php echo $row['details']; ?></p>
                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
                  </div>
                  <!-- <div class="card-footer text-muted"> -->
                    <!-- Posted on January 1, 2017 -->
                    <!-- <a href="#">Start Bootstrap</a> -->
                  <!-- </div> -->
                </div>
            <?php
              }
            }
            }
           ?>




          <!-- Pagination -->
          <!-- <ul class="pagination justify-content-center mb-4"> -->
            <!-- <li class="page-item">
              <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Newer &rarr;</a>
            </li>
          </ul> -->

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <!-- <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div> -->



          <!-- Side Widget -->
          <!-- <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div> -->

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
