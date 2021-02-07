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
?>
<?php
if (empty($_POST)) {
$msg = "";
}elseif (!empty($_POST['newpassword1'] || $_POST['oldpassword'] || $_POST['newpassword2'])) {
    
    $conn = mysqli_connect("remotemysql.com", "DJcTw7h5BR", "W71l2MTgG4", "DJcTw7h5BR");
    $verifyschool = $_SESSION['id'];
    $zatimnic = (mysqli_query($conn, "SELECT password FROM accounts WHERE id=$verifyschool"));
    $row = (mysqli_fetch_array($zatimnic));
    $conn -> close();
    $heslo = password_verify($_POST['oldpassword'], $row['password']);
if ($heslo) {
if ($_POST['newpassword1'] == $_POST['newpassword2']) {
    //Tady je kod pro zmenu hesla
$DATABASE_HOST = 'remotemysql.com';
$DATABASE_USER = 'DJcTw7h5BR';
$DATABASE_PASS = 'W71l2MTgG4';
$DATABASE_NAME = 'DJcTw7h5BR';
// Try and connect using the info above.
$heslocon = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);
$heslocon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
        $zmeneneheslo = password_hash($_POST["newpassword2"], PASSWORD_BCRYPT);
        // Update the record
        $verifyschool = $_SESSION["id"];
        $stmt = $heslocon->prepare('UPDATE accounts SET password=:zmeneneheslo WHERE id=:id');
        $stmt->bindValue(':id', $verifyschool);
        $stmt->bindValue(':zmeneneheslo', $zmeneneheslo);
        $stmt->execute();
    $msg = "Heslo úspěsně změněno!";
session_destroy();
header('Location: login.php');
}else{
$msg = "Hesla se neshoduji!";
}
}else{
$msg = "Spatne heslo!";
}
}else{
$msg = "Musite vyplnit vsechna policka!";
}
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
				<form action="zmenahesla.php" method="post">
				<table>
					<tr>
						<td>Staré heslo:</td>
						<td><input type="password" name="oldpassword" placeholder="Změnit heslo" id="oldpassword"></td>
					</tr>
					<tr>
						<td>Nové heslo:</td>
						<td><input type="password" name="newpassword1" placeholder="Změnit heslo" id="newpassword1"></td>
					</tr>
					<tr>
						<td>Nové heslo znovu:</td>
						<td><input type="password" name="newpassword2" placeholder="Změnit heslo" id="newpassword2"></td>
					</tr>
				</table>
				<input type="submit" value="Změnit heslo">
    </form>
    
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
			</div>
		</div>
	</body>
</html>
