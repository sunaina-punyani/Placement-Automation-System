<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


      <link rel="stylesheet" href="css/signup.css">


</head>

<?php
  require_once(__DIR__ . '/includes/dbconfig.php');
  $err_msg=" ";
  //session_start();
  //if(!isset($_SESSION['id'])){
    //user is not logged in

    if(isset($_POST['submit'])){
      //grab data
     
      $name=mysqli_real_escape_string($dbc, trim($_POST['name']));
      $username=mysqli_real_escape_string($dbc, trim($_POST['username']));
      $password1=mysqli_real_escape_string($dbc, trim($_POST['password1']));
      $password2=mysqli_real_escape_string($dbc, trim($_POST['password2']));
      $dept=mysqli_real_escape_string($dbc, trim($_POST['dept']));
      

      if(!empty($username) && !empty($name) && !empty($password1) && !empty($password2) && !empty($dept))
      {

        //to check if someone isnt registered with same email

        $query="SELECT id FROM admin WHERE username = '$username' ";
        $result=mysqli_query($dbc,$query);
        if(mysqli_num_rows($result)==0)
        {
          //email is unique

          if($password1!=$password2)
          {
            $errr_msg='Passwords don\'t match.';

          }
        
          // else if(!validate_name($first_name) || validate_name($last_name))
          //   $err_msg="Name is invalid";
          else {
            $name=ucfirst(strtolower($name));
            $password=password_hash($password1,PASSWORD_BCRYPT);

            $query="INSERT INTO admin (username,name,password,dept) VALUES ('$username','$name','$password','$dept')";
            
            if(mysqli_query($dbc,$query))
            {

            }
            else
            {
              echo mysqli_error($dbc);
            }
          }
        }
        else
        {
          $err_msg = 'This user-name has been used. Choose another one. ';
        }

      }
      else
      {
                $err_msg = 'Please fill the required fields.';
      }


    }
  // }
  // else
  // {
  //
  //   // user is logged in so redirect to dashboard
  //   header('Location: dashboard.php');
  //
  // }


function validate_name($name) {
    return preg_match("/^[a-zA-Z'-]+$/", $name);
  }


?>



    <body>

      <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <h1>Sign Up</h1>

        <fieldset>
          <legend><span class="number">1</span>Your basic info</legend>
          <div style="color: red;">
            <p>&nbsp;
            <?php echo $err_msg; ?>&nbsp;</p>
          </div>
          <label for="name"> Name:</label>
          <input type="text" id="name"  name="name" required value="<?php if(isset($name)) echo $name; ?>">

          <label for="name">UserName:</label>
          <input type="text" id="name"  name="username" required value="<?php if(isset($username)) echo $username; ?>">

          <label for="password">Password:</label>
          <input type="password" name="password1" id="password" required>

          <label for="password">Confirm Password:</label>
          <input type="password" name="password2" id="password" required>

          <label for="name">Department:</label>
          <input type="text" id="name"  name="dept" required value="<?php if(isset($dept)) echo $dept; ?>">

        </fieldset>

       

        <button type="submit" name="submit">Sign Up</button>
      </form>

    </body>
</html>
