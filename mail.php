<?php
	/*connect to database*/
	require "connect.php";

	//Regular expression for the user password validation '/^[a-zA-Z]{8,}$/'

	/*resume user session*/
	session_start();

	/*Check if the user is logged in, otherwise display nothing*/
	if(isset($_SESSION['id'])) {
		/*get current logged in user id*/
		$recipient_id = $_SESSION['id'];

		/*lookup the specified user messages*/
		$messages = mysql_query("SELECT * FROM Message WHERE recipient_ids=$recipient_id LIMIT 10");
		$users = mysql_query("SELECT * FROM User");
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="users">
		<h1>List of Cheapo Users</h1>
		<table>
			<thead>
				<th>User id</th>
				<th>Username</th>
				<th>Firstname</th>
				<th>Lastname</th>
			</thead>
			<tbody>
				<?php
					while ($row = mysql_fetch_array($users)) {
				?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['firstname']; ?></td>
						<td><?php echo $row['lastname']; ?></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<div id="messages">
		<h1>Recent messages</h1>
		<table>
			<thead>
				<th>Sender</th>
				<th>Subject</th>
				<th>Body</th>
				<th>Recipient</th>
			</thead>
			<tbody>
				<?php
					while ($row = mysql_fetch_array($messages)) {
						?>
						<tr>
							<td><?php print $row['user_id']; ?></td>
							<td><?php print $row['subject']; ?></td>
							<td><?php print $row['body']; ?></td>
							<td><?php print $row['recipient_ids']; ?></td>
							<td><a href=<?php echo "message.php?id=" . $row['id']; ?>>Read</a></td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>

<?php
	} else {
		echo "Please login to continue.";
	}
?>