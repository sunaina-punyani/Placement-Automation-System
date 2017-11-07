<?php
            require_once(__DIR__ . '/includes/dbconfig.php');
            session_start();

            if(isset($_GET['id'])){
                $uni_id=$_GET['id'];
              if(isset($_SESSION['id']))
              {
                  $student=$_SESSION['id'];
                  $q="INSERT INTO application (stud_id,post_id) VALUES ($uni_id,$student)";
                   $result = mysqli_query($dbc,$q);
              }
                 
 
                }
                header('Location: studdash/dashboard.php');
?>