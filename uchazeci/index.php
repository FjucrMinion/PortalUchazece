<?php
// Kód níže je nutný pro každé použití "restricted access"
session_start();
if (isset($_SESSION['user'])) {
        header('Location: http://portaluchazece.tk/home.php');
}
elseif (isset($_SESSION['school'])) {
	    header('Location: http://portaluchazece.tk/schoolhome.php');
}
elseif (!isset($_SESSION["stredniskola"])) {
        header("Location: http://portaluchazece.tk/login.php");
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
	<a href="prvnitermin.php"><p>První termín</p></a>
	<a href="druhytermin.php"><p>Druhý termín</p></a>
	<a href="poradizaku.php"><p>Pořadí žáků</p></a>
	<a href="odvolani.php"><p>Odvolání</p></a>
	<a href="zapisovelistky.php"><p>Zápisové lístky</p></a>
</div>

<?=template_footer()?>