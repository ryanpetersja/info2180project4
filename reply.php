<?php
	/*connect to database*/
	require "connect.php";

	/*Resume user session*/
	session_start();

	/*Check if the user is logged in*/
	if (isset($_SESSION['id'])) {

		$user_id = $_SESSION['id'];

		$subject = $_POST['subject'];
		$recipient_id = $_POST['recipient_id'];
		$body = $_POST['body'];

		if ($body == NULL) {
			echo "Please enter a message to send.";
			//Redirect to previous page
		} else {
			/*Reply to message*/
			$insert = mysql_query("INSERT INTO Message (recipient_ids, subject, body, user_id) VALUES ('$recipient_id', '$subject', '$body', '$user_id')");
		}


	} else {
		//User should be logged in

		echo "Please login to reply to message.";

		//TODO redirect to login page
	}
?>