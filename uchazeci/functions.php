<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'remotemysql.com';
    $DATABASE_USER = 'DJcTw7h5BR';
    $DATABASE_PASS = 'W71l2MTgG4';
    $DATABASE_NAME = 'DJcTw7h5BR';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
		<title>$title</title>
		<link href="https://covid.gov.cz/static/ds/images/meta/android-chrome-256x256.png?v=7639581032a7f955eee5ef9c304ea5cb" rel="SHORTCUT ICON">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Portál Uchazeče</h1>
            <a href="http://portaluchazece.tk/schoolhome.php"><i class="fas fa-home"></i>Domů</a>
    		<a href="http://portaluchazece.tk/logout.php"><i class="fas fa-sign-out-alt"></i>Odhlásit se</a>
    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>