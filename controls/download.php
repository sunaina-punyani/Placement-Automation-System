<?php
	/*
	 *
	 * @author Arpita Karkera
	 * @date 19 March, 2017
	 *
	 * Downloads a csv file of containing registered users' data of an event
	 * event id is supplied using GET
	 *
	 */

	// authenticate - user must be logged in and a manager to access
	//require_once(__DIR__ . '/../includes/authenticate.php');

	// connect to database
	require_once(__DIR__ . '/../includes/dbconfig.php');
	session_start();
	// get event details
	if (isset($_GET['jobpost'])) {
		$postid = mysqli_real_escape_string($dbc, trim($_GET['jobpost']));

		$query="SELECT * FROM job_post WHERE id=$postid"; 
		$result = mysqli_query($dbc, $query) or die(mysqli_error());
		if (mysqli_num_rows($result) == 1) {
			$event_row = mysqli_fetch_array($result);
			// proceed only if the manager who is logged in posted the event
			if ($_SESSION['company_id'] == $event_row['company_id']) {
				// correct manager
				// get details of users who have registered for the event
				$query = "SELECT user.id,user.first_name, user.last_name,user.email, user.contact, user.programme,user.branch,user.year FROM user INNER JOIN application ON user.id = application.stud_id";
				$result = mysqli_query($dbc, $query);

				// open file to be downloaded
				$out = fopen('php://output', 'w');
				// put deatils of event and manager on file
				fputcsv($out, array('Job Post:', $event_row['title']));
				//fputcsv($out, array('Comapny:', $event_row['first_name'].' '.$event_row['last_name']));
				fputcsv($out, array());
				fputcsv($out, array('ID','First_Name','Last_Name', 'Email','Contact', 'Programme', 'Year', 'Branch'));
				if (mysqli_num_rows($result) != 0) {
					while ($reg_row = mysqli_fetch_array($result)) {
						//echo str_pad($event_id, 3, '0', STR_PAD_LEFT).str_pad($reg_row['registration_id'], 5, '0', STR_PAD_LEFT);
						fputcsv($out, array(str_pad($event_id, 3, '0', STR_PAD_LEFT).str_pad($reg_row['id'], 5, '0', STR_PAD_LEFT), $reg_row['first_name'].' '.$reg_row['last_name'], $reg_row['email'], $reg_row['contact'], $reg_row['programme'], $reg_row['branch'], $reg_row['year']));
					}
				}
				header('Content-Type: application/csv');
				// tell the browser we want to save it instead of displaying it
    			header('Content-Disposition: attachment; filename="'.str_replace(' ','',strtolower($event_row['title'])).str_pad($postid, 3, '0', STR_PAD_LEFT).'.csv";');
    			// make php send the generated csv lines to the browser
    			fpassthru($out);
				fclose($out);
			}
		}
	}
?>