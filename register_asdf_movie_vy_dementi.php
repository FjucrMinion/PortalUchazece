<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
		<title>Portál Uchazeče - Registrace</title>
		<link href="https://covid.gov.cz/static/ds/images/meta/android-chrome-256x256.png?v=7639581032a7f955eee5ef9c304ea5cb" rel="SHORTCUT ICON">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
                <nav class="navtop">
			<div>
				<h1>Portál Uchazeče</h1>
				<a href="login.html"><i class="fas fa-sign-in-alt"></i>Přihlásit se</a>
			</div>
		</nav>

		<div class="register">
			<h1>Registrace</h1>
			<form action="register.php" method="post" autocomplete="off">
				<label for="firstname">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="firstname" placeholder="Jméno" id="firstname" required>
				<label for="surname">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="surname" placeholder="Příjmení" id="surname" required>
				<label for="phone">
					<i class="fas fa-phone"></i>
				</label>
				<input type="number" name="phone" placeholder="Tel. číslo" id="phone" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Heslo" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<input type="submit" value="Registrovat se">
			</form>
		</div>
	</body>
</html>
<?php
// Change this to your connection info.
$DATABASE_HOST = 'remotemysql.com';
$DATABASE_USER = 'DJcTw7h5BR';
$DATABASE_PASS = 'W71l2MTgG4';
$DATABASE_NAME = 'DJcTw7h5BR';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['firstname'], $_POST['surname'], $_POST['phone'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['firstname']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['surname'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	} else {
		// Username doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO accounts (firstname, surname, password, phone, email) VALUES (?, ?, ?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sssss', $_POST['firstname'], $_POST['surname'], $password, $_POST['phone'], $_POST['email']);
	$stmt->execute();
	echo 'You have successfully registered, you can now login!';
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>