<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['user'])) {
        header('Location: home.php');
}
elseif (isset($_SESSION["school"])) {
    header("Location: schoolhome.php");
}
elseif (!isset($_SESSION['stredniskola'])) {
	    header('Location: login.html');
	    exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
		<title>Portál Uchazeče - Škola</title>
		<link href="https://covid.gov.cz/static/ds/images/meta/android-chrome-256x256.png?v=7639581032a7f955eee5ef9c304ea5cb" rel="SHORTCUT ICON">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Portál Uchazeče</h1>
				<a href="uchazeci/index.php"><i class="fas fa-users"></i>Uchazeči</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Odhlásit se</a>
			</div>
		</nav>
		<div class="content">
			<h2>Domovská stránka</h2>
			<p>Vítejte, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>