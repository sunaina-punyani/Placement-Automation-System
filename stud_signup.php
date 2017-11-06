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
  session_start();
  if(!isset($_SESSION['id'])){
    //user is not logged in

    if(isset($_POST['submit'])){
      //grab data
      $id=mysqli_real_escape_string($dbc, trim($_POST['id']));
      $first_name=mysqli_real_escape_string($dbc, trim($_POST['first_name']));
      $last_name=mysqli_real_escape_string($dbc, trim($_POST['last_name']));
      $password1=mysqli_real_escape_string($dbc, trim($_POST['password1']));
      $password2=mysqli_real_escape_string($dbc, trim($_POST['password2']));
      $email=mysqli_real_escape_string($dbc, trim($_POST['email']));
      $contact=mysqli_real_escape_string($dbc, trim($_POST['contact']));
      $programme=mysqli_real_escape_string($dbc, trim($_POST['programme']));
      $year=mysqli_real_escape_string($dbc, trim($_POST['year']));
      $branch=mysqli_real_escape_string($dbc, trim($_POST['branch']));

      if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password1) && !empty($passwrod2) && !empty($id) && !empty($year) && !empty($programme) && !empty($branch))
      {

        //to check if someone isnt registered with same email

        $query="SELECT id FROM user WHERE email = '$email' ";
        $result=mysqli_query($dbc,$query);
        if(mysqli_num_rows($result)==0)
        {
          //email is unique

          if($password1!=$password2)
          {
            $errr_msg='Passwords don\'t match.';

          }
          else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $err_msg='Email provided is invalid';
          else if(!validate_contact($contact))
            $err_msg='Contact number is invalid';
          else if(!validate_name($first_name) || validate_name($last_name))
            $err_msg="Name is invalid";
          else {
            $first_name=ucfirst(strtolower($first_name));
            $last_name=ucfirst(strtolower($lst_name));
            $password=password_hash($password1,'PASSWORD_BCRYPT');

            $query="INSERT INTO user (id,password,email,first_name,last_name,contact,programme,year,branch) VALUES ('$id','$email','$first_name','$last_name','$contact','$programme','$year','$branch')";

            if(mysql_query($dbc,$query))
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
          $err_msg = 'The email id has been used. Choose another one. <a href="forgot.php">Forgot password?</a>';
        }

      } 
      else 
      {
                $err_msg = 'Please fill the required fields.';
      }


    }
  }
  else
  {

    // user is logged in so redirect to dashboard
    header('Location: dashboard.php');
  
  }

function validate_contact($contact) {
    if (preg_match('/^[789]\d{9}$/', $contact))
      return true;

    return false;
  }

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
          <label for="name">First Name:</label>
          <input type="text" id="name"  name="first_name" required value="<?php if(isset($first_name)) echo $first_name; ?>">
          
          <label for="name">Last Name:</label>
          <input type="text" id="name"  name="last_name" required value="<?php if(isset($last_name)) echo $last_name; ?>">

          <label for="mail">Email:</label>
          <input type="email" id="mail" name="email" required value="<?php if(isset($email)) echo $email; ?>">

          <label for="mail">Contat Number:</label>
          <input type="email" id="name" name="contact" required value="<?php if(isset($contact)) echo $contact; ?>">
          
          <label for="password">Password:</label>
          <input type="password" name="password1" id="password" required>

          <label for="password">Confirm Password:</label>
          <input type="password" name="password2" id="password" required>
          
        
        </fieldset>
        
        <fieldset>
          <legend><span class="number">2</span>Your profile</legend>
          
          <label for="name">ID:</label>
          <input type="text" id="name"  placeholder="identity number" name="id" required value="<?php if(isset($id)) echo $id; ?>">

          <label for="name">Programme:</label>
          <input type="text" id="name"  placeholder="eg. BTech" name="programme" required value="<?php if(isset($programme)) echo $programme; ?>">

          <label for="name">Year:</label>
          <input type="text" id="name"  placeholder="current academic year" name="id" required value="<?php if(isset($year)) echo $year; ?>">

          <label for="name">Branch:</label>
          <input type="text" id="name"  placeholder="branch" name="id" required value="<?php if(isset($branch)) echo $branch; ?>">

        </fieldset>
       
       
        <button type="submit">Sign Up</button>
      </form>
      
    </body>
</html>
  
  

