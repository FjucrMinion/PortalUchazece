<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['school'])) {
        header('Location: schoolhome.php');
}
elseif (isset($_SESSION["stredniskola"])) {
        header("Location: stredniskola.php");
}
elseif (isset($_SESSION['user'])) {
	    header('Location: home.php');
	    exit;
}
?>
<?php
if (isset($_POST["password"]) && (isset($_POST["email_izo"]))) {
// Change this to your connection info.
$DATABASE_HOST = 'remotemysql.com';
$DATABASE_USER = 'DJcTw7h5BR';
$DATABASE_PASS = 'W71l2MTgG4';
$DATABASE_NAME = 'DJcTw7h5BR';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email_izo'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
//UDAJE JSOU ZADANY - TED JE KONTROLA UDAJU
//STREDNI SKOLA LOGIN
if ($stmt = $con -> prepare('SELECT id, password, typskoly FROM schools WHERE izo = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt -> bind_param('s', $_POST['email_izo']);
     $stmt -> execute();
     // Store the result so we can check if the account exists in the database.
    $stmt -> store_result();
    if ($stmt -> num_rows > 0) {
        $stmt -> bind_result($id, $password, $typskoly);
         $stmt -> fetch();
         // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password) && $typskoly === "ss") {
            // Uspesne, clovicek se prihlasil.
            // Vytvori session, zapamatuje si to, ze uzivatel je prihlaseny, ale je to ulozeno na serveru.
             session_regenerate_id();
             $_SESSION['stredniskola'] = true;
             $_SESSION['name'] = $_POST['email_izo'];
             $_SESSION['id'] = $id;
             header('Location: stredniskola.php');
             } else {
//LOGIN ZAKLADNI SKOLY
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM schools WHERE izo = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email_izo']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['school'] = TRUE;
		$_SESSION['name'] = $_POST['email_izo'];
		$_SESSION['id'] = $id;
		header('Location: schoolhome.php');
	} else {
		// Incorrect password
        
        
        
        
        
		$stmt->close();
//LOGIN UCHAZEC
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email_izo']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['user'] = TRUE;
		$_SESSION['name'] = $_POST['email_izo'];
		$_SESSION['id'] = $id;
		header('Location: home.php');
	} else {
		// Incorrect password
		$msg="Nesprávné přihlašovací údaje!";
	}
} else {
	// Incorrect username
	$msg="Nesprávné přihlašovací údaje!";
}
	$stmt->close();
    
    
    
    
    
	}
    }
} else {
	// Incorrect username
    
    
    
    
    
	$stmt->close();
//LOGIN UCHAZEC 2
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email_izo']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['user'] = TRUE;
		$_SESSION['name'] = $_POST['email_izo'];
		$_SESSION['id'] = $id;
		header('Location: home.php');
	} else {
		// Incorrect password
		$msg="Nesprávné přihlašovací údaje!";
	}
} else {
	// Incorrect username
	$msg="Nesprávné přihlašovací údaje!";
}
	$stmt->close();
}	
}
}
}
}else{
 $stmt->close();
 //LOGIN ZAKLADNI SKOLY
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM schools WHERE izo = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email_izo']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['school'] = TRUE;
		$_SESSION['name'] = $_POST['email_izo'];
		$_SESSION['id'] = $id;
		header('Location: schoolhome.php');
	} else {
		// Incorrect password
        
        
        
        
        
		$stmt->close();
//LOGIN UCHAZEC
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email_izo']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['user'] = TRUE;
		$_SESSION['name'] = $_POST['email_izo'];
		$_SESSION['id'] = $id;
		header('Location: home.php');
	} else {
		// Incorrect password
		$msg="Nesprávné přihlašovací údaje!";
	}
} else {
	// Incorrect username
	$msg="Nesprávné přihlašovací údaje!";
}
	$stmt->close();
    
    
    
    
    
	}
    }
} else {
	// Incorrect username
    
    
    
    
    
	$stmt->close();
//LOGIN UCHAZEC 2
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email_izo']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['user'] = TRUE;
		$_SESSION['name'] = $_POST['email_izo'];
		$_SESSION['id'] = $id;
		header('Location: home.php');
	} else {
		// Incorrect password
		$msg="Nesprávné přihlašovací údaje!";
	}
} else {
	// Incorrect username
	$msg="Nesprávné přihlašovací údaje!";
}
	$stmt->close();
}
}
}
}
}
} else
$msg="";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
		<title>Portál Uchazeče - Přihlášení</title>
		<link href="https://covid.gov.cz/static/ds/images/meta/android-chrome-256x256.png?v=7639581032a7f955eee5ef9c304ea5cb" rel="SHORTCUT ICON">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
                <nav class="navtop">
			<div>
				<h1>Portál Uchazeče</h1>
				<a href="index.html"><i class="fas fa-home"></i>Domů</a>
			</div>
		</nav>
		<div class="login">
			<h1>Přihlášení</h1>
			<form action="login.php" method="post">
	<?php if ($msg):?>
    <p><?=$msg?></p>
    <?php endif; ?>
				<label type="form" for="email_izo">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="email_izo" placeholder="Email/IZO" id="email_izo" required>
				<label type="form" for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Heslo" id="password" required>
				<input type="submit" value="Přihlásit se">
			</form>
			</div>
	</body>
</html>