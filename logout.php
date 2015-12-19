<?php
	// resume user session
	session_start();

	// remove all session variables
	session_unset();

	// destroy the session 
	session_destroy();

	echo "You have been successfully logged out.";

	//TODO REDIRECT to the login screen
	
?>