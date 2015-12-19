<?php
	/*import the database connection file*/
	require "connect.php";

	/*Resume user session*/
	session_start();

	/*Check if the user session is set, else redirect to homepage*/
	if(isset($_SESSION['id'])) {

		//Set current logged in user_id
		$user_id = $_SESSION['id'];

		/*Get data from form*/
		$recipient_ids = $_POST['recipient_ids'];
		$subject = $_POST['subject'];
		$body = $_POST['body'];

		/*Match for recipient_ids field*/
		$checkids = "/^[0-9 ]|;$/";
		
		/*Validate message contents*/
		if (!preg_match($checkids, $recipient_ids)) {
			echo "Please enter the recipient ids in the specified format.";
		} elseif (($body == NULL) || ($subject == NULL)) {
			echo "Please complete the required fields.";
		} else {
			$recipients = explode(";", $recipient_ids);
			for ($i = 0; $i < count($recipients); $i++) {
				str_replace(" ", "", $recipients[$i]);
				/*Query that will insert the message into the database*/
				$insert = "INSERT INTO Message (recipient_ids, subject, body, user_id) VALUES ('$recipients[$i]', '$subject', '$body', '$user_id')";

				/*Insert the message to the database*/
				mysql_query($insert);

				/*Check if the message is sent*/
				/*$query = "SELECT * FROM Message WHERE user_id=$user_id";
				$z = 0;
				while ($row = mysql_fetch_array(mysql_query($query))) {
					for ($i = 0; $i < count($recipients); $i++) {
						if (($row['body'] == $body) && ($row['subject'] == $subject) && ($row['recipient_ids'] == $recipients['$i'])) {
							$Z += 1;
						}
					}
				}
				if ($z == count($recipients)) {
					echo "Message sent!";
				}*/
			}
			echo "Message sent!";
		}
	} else {
		print "Please login to send a message.";
	}
	//http_redirect("mail.php", true); TODO redirect to homepage
?>