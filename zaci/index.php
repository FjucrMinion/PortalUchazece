<?php
// Kód níže je nutný pro každé použití "restricted access"
session_start();
if (isset($_SESSION['user'])) {
        header('Location: http://portaluchazece.tk/home.php');
}
elseif (isset($_SESSION["stredniskola"])) {
        header("Location: http://portaluchazece.tk/stredniskola.php");
}
elseif (!isset($_SESSION['school'])) {
	    header('Location: http://portaluchazece.tk/login.html');
	    exit;
}
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>

<div class="content">
	<h2>Home</h2>
	<p>Welcome to the home page!</p>
</div>

<?=template_footer()?>