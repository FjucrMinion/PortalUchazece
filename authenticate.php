<?php
session_start();
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
		exit('Incorrect username and/or password!');
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!*';
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
		exit('Incorrect username and/or password!-');
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!+';
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
		exit('Incorrect username and/or password!');
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!*';
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
		exit('Incorrect username and/or password!-');
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!+';
}
	$stmt->close();
}
}
}
}
}


?>