<?php
  require_once(__DIR__.'/../includes/dbconfig.php');
  session_start();
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM job_post,company WHERE job_post.id = $id AND job_post.company_id = company.id";
    $result = mysqli_query($dbc,$query);
    if (mysqli_num_rows($result)==1) {
      $post = mysqli_fetch_array($result);
    }
    else {

    }
  }
  else {

  }
 ?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Job Post</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">

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
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../signout.php">Sign Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4"><?php echo $post['title']; ?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="#"><?php echo $post['name']; ?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $post['timestamp']; ?></p>

          <hr>

          <!-- Preview Image -->
          <!-- <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> -->

          <!-- <hr> -->

          <!-- Post Content -->
          <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p> -->

          <p><?php echo $post['details']; ?></p>

          <p>Eligibility: <?php echo $post['eligibility']; ?></p>

          <p>Purpose: <?php echo $post['purpose']; ?></p>

          <p>Package: <?php echo $post['package']; ?></p>

          <p>Contact: <?php echo $post['contact_email']; ?></p>

          <hr>


        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <div class="card my-2" style="border: white">
            <a href="../apply.php?id=<?php echo $id;?>"><button class="btn btn-success btn-lg my-4">Apply</button></a>
          </div>

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
