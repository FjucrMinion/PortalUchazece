<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['school'])) {
        header('Location: schoolhome.php');
}
elseif (!isset($_SESSION['user'])) {
	    header('Location: login.html');
	    exit;
}
$DATABASE_HOST = 'remotemysql.com';
$DATABASE_USER = 'DJcTw7h5BR';
$DATABASE_PASS = 'W71l2MTgG4';
$DATABASE_NAME = 'DJcTw7h5BR';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT firstname, surname, phone, email, mistonarozeni, originalsurname, rodnecislo FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($firstname, $surname, $phone, $email, $mistonarozeni, $originalsurname, $rodnecislo);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
		<title>Portál uchazeče - Profil</title>
		<link href="https://covid.gov.cz/static/ds/images/meta/android-chrome-256x256.png?v=7639581032a7f955eee5ef9c304ea5cb" rel="SHORTCUT ICON">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Portál Uchazeče</h1>
				<a href="home.php"><i class="fas fa-home"></i>Domů</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Odhlásit se</a>
			</div>
		</nav>
		<div class="content">
			<h2>Váš profil</h2>
			<div>
				<p>Detaily účtu:</p>
				<table>
					<tr>
						<td>Státní Číslo Uchazeče:</td>
						<td><?=$_SESSION['id']?></td>
					</tr>
					<tr>
						<td>Jméno a příjmení:</td>
						<td><?=$firstname?> <?=$surname?></td>
					</tr>
					<tr>
						<td>Rodné příjmení:</td>
						<td><?=$originalsurname?></td>
					</tr>
					<tr>
						<td>Tel. číslo:</td>
						<td><?=$phone?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>Místo narození:</td>
						<td><?=$mistonarozeni?></td>
					</tr>
					<tr>
						<td>Rodné číslo:</td>
						<td><?=$rodnecislo?></td>
					</tr>
				</table>
				<a href="zmenahesla.php"><input type="submit" value="Změnit heslo"></a>
			</div>
		</div>
	</body>
</html>