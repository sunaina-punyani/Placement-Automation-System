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
      $info=mysqli_real_escape_string($dbc, trim($_POST['info']));
      $category=mysqli_real_escape_string($dbc, trim($_POST['category']));
      $email=mysqli_real_escape_string($dbc, trim($_POST['email']));

      if(!empty($name) && !empty($username) && !empty($email) && !empty($password1) && !empty($password2)  && !empty($info) && !empty($category))
      {

        //to check if someone isnt registered with same email

        $query="SELECT id FROM company WHERE email = '$email' ";
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
         
          // else if(!validate_name($first_name) || validate_name($last_name))
          //   $err_msg="Name is invalid";
          else {
            $name=ucfirst(strtolower($name));
            
            $password=password_hash($password1,PASSWORD_BCRYPT);

            $query="INSERT INTO company (username,password,name,info,email,category) VALUES ('$username','$password','$name','$info','$email','$category')";
            
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
          $err_msg = 'The email id has been used. Choose another one. ';
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
          <label for="name">Name:</label>
          <input type="text" id="name"  name="name" required value="<?php if(isset($name)) echo $name; ?>">

          <label for="name">User-name:</label>
          <input type="text" id="name"  name="username" required value="<?php if(isset($username)) echo $username; ?>">

          <label for="mail">Email:</label>
          <input type="email" id="email" name="email" required value="<?php if(isset($email)) echo $email; ?>">

          <label for="info">Info:</label>
          <input type="text" id="name" name="info" required value="<?php if(isset($info)) echo $info; ?>">

          <label for="password">Password:</label>
          <input type="password" name="password1" id="password" required>

          <label for="password">Confirm Password:</label>
          <input type="password" name="password2" id="password" required>

          <label for="name">Category:</label>
          <input type="text" id="programme"   name="category" required value="<?php if(isset($category)) echo $category; ?>">
        </fieldset>

        


        <button type="submit" name="submit">Sign Up</button>
      </form>

    </body>
</html>
