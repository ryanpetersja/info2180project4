<?php
	/*connect to database*/
	require "connect.php";

	/*Resume user session*/
	session_start();

	//Check if user is logged in
	if (isset($_SESSION['id'])) {
		//set current user id
		$recipient_id = $_SESSION['id'];
		//set current message id
		$message_id = $_GET['id'];

		/*Get all the read messages*/
		$query = mysql_query("SELECT * FROM Message_read");
		
		/*Mark message as read*/
		$count = 1;
		while ($row = mysql_fetch_array($query)) {
			//Check if the message is already read
			if ($row['message_id'] == $message_id) {
				break;
			}
			$count++;
		}
		$total_query = mysql_query("SELECT * FROM Message_read");
		$total = 0;
		//Get the total number of read messages
		while ($row = mysql_fetch_array($total_query)) {
			$total++;
		}
		//If count exceeds total then mark the message as read
		if ($count > $total) {
			$mark_read = "INSERT INTO Message_read (message_id, reader_id) VALUES ('$message_id', '$recipient_id')";
			mysql_query($mark_read);
		}

		//get message contents
		$get_message = "SELECT * FROM Message WHERE id=$message_id";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charst="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="prototype.js"></script>
	<script src="script.js" type="text/javascript"> </script>
</head>
<body>
	<?php
		$row = mysql_fetch_array(mysql_query($get_message));
	?>
	<div class="subject"><?php echo $row['subject']; ?></div>
	<div class="body"><?php echo $row['body']; ?></div>

	<div id="reply">
		<form action="reply.php" method="post">
			Message: <input type="text" id="body" name="body" placeholder="Reply to message"><br>
			<input type="submit" value="reply">
			<input type="hidden" id="message_id" name="message_id" value=<?php echo $row['id']; ?>>
			<input type="hidden" id="subject" name="subject" value=<?php echo $row['subject']; ?>>
			<input type="hidden" id="recipient_id" name="recipient_id" value=<?php echo $row['user_id']; ?>>
		</form>
	</div>
</body>
</html>

<?php
	} else {
		echo "Please login to continue.";
	}
?>