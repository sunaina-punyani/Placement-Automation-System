<?php
//if (isset($_SESSION['company_id'])) {
		// user is a manager

    require_once(__DIR__ . '/../includes/dbconfig.php');
    session_start();

		if (isset($_POST['submit'])) {
      //echo "submit pressed";
			// grab the data
			$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
			$details = mysqli_real_escape_string($dbc, trim($_POST['details']));
			$eligibility = mysqli_real_escape_string($dbc, trim($_POST['eligibility']));
			$purpose = mysqli_real_escape_string($dbc, trim($_POST['purpose']));
			$package = mysqli_real_escape_string($dbc, trim($_POST['package']));
			$contact_email = mysqli_real_escape_string($dbc, trim($_POST['contact_email']));
      $company_id = $_SESSION['company_id'];

			if (!empty($title) && !empty($details) && !empty($eligibility) && !empty($purpose) && !empty($package) && !empty($contact_email)) {

				$company_id = $_SESSION['company_id'];
				$query = "INSERT INTO job_post (company_id, title, details, eligibility, purpose, package, contact_email) VALUES ($company_id, '$title', '$details', '$eligibility', '$purpose', $package, '$contact_email')";
        //echo $query;
				mysqli_query($dbc, $query) or die(mysqli_error($dbc));
        header('Location: ../compdash/dashboard.php');

			}
			else
				$err_msg = "Please provide the mandatory details.";
		}
	//}

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Post Job</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


      <link rel="stylesheet" href="css/style.css">


</head>

<body>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Post Form</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>

      <form action="post_job.php" method="post">

        <h1>Post Job</h1>

        <fieldset>
          <legend>Fill job details</legend>
          <label for="name">Title</label>
          <input type="text" id="title" name="title">

          <label for="bio">Details</label>
          <textarea id="details" name="details"></textarea>

          <label for="name">Eligibility</label>
          <input type="text" id="eligibility" name="eligibility">

          <label for="name">Purpose</label>
          <input type="text" id="pupose" name="purpose">

          <label for="name">Package</label>
          <input type="number" id="package" name="package">

          <label for="password">Contact Email</label>
          <input type="email" id="contact_email" name="contact_email">


        </fieldset>

        <!-- <fieldset>
          <legend><span class="number">2</span>Your profile</legend>
          <label for="bio">Biography:</label>
          <textarea id="bio" name="user_bio"></textarea>
        </fieldset>
        <fieldset>
        <label for="job">Job Role:</label>
        <select id="job" name="user_job">
          <optgroup label="Web">
            <option value="frontend_developer">Front-End Developer</option>
            <option value="php_developor">PHP Developer</option>
            <option value="python_developer">Python Developer</option>
            <option value="rails_developer"> Rails Developer</option>
            <option value="web_designer">Web Designer</option>
            <option value="WordPress_developer">WordPress Developer</option>
          </optgroup>
          <optgroup label="Mobile">
            <option value="Android_developer">Androild Developer</option>
            <option value="iOS_developer">iOS Developer</option>
            <option value="mobile_designer">Mobile Designer</option>
          </optgroup>
          <optgroup label="Business">
            <option value="business_owner">Business Owner</option>
            <option value="freelancer">Freelancer</option>
          </optgroup>
          <optgroup label="Other">
            <option value="secretary">Secretary</option>
            <option value="maintenance">Maintenance</option>
          </optgroup>
        </select>

          <label>Interests:</label>
          <input type="checkbox" id="development" value="interest_development" name="user_interest"><label class="light" for="development">Development</label><br>
            <input type="checkbox" id="design" value="interest_design" name="user_interest"><label class="light" for="design">Design</label><br>
          <input type="checkbox" id="business" value="interest_business" name="user_interest"><label class="light" for="business">Business</label>

        </fieldset> -->
        <button type="submit" name="submit">Post</button>
      </form>

    </body>
</html>


</body>
</html>
