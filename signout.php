<?php
	/*
	 * @author: Arpita Karkera
	 * @date: 6th March, 2017
	 *
	 * Logout logic. After logging out it redirects to index page.
	 *
	 */

	// authenticate
	//require_once(__DIR__ . '/../includes/authenticate.php');
session_start();
	// if user is logged in, delete session vars to log them out
	if (isset($_SESSION['id']) || isset($_SESSION['company_id']) || isset($_SESSION['admin_id'])) {
		// clear session array
		$_SESSION = array();

		/*
		if (isset($_COOKIE[session_name()])) {
      		setcookie(session_name(), '', time() - 3600);
    	}
    	*/

    	// destroy the session
    	session_destroy();
	}

	/*
	// delete the user ID and username cookies by setting their expirations to an hour ago (3600)
  	setcookie('user_id', '', time() - 3600);
 	setcookie('username', '', time() - 3600);
 	*/

 	// redirect to the index page
 	$home_url = 'index.php';
  	header('Location: ' . $home_url);
?>
