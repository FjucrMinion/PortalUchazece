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
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    $con = mysqli_connect("remotemysql.com", "DJcTw7h5BR", "W71l2MTgG4", "DJcTw7h5BR");
    $verifyschool = $_GET['id'];
    $sql = "SELECT zskola FROM accounts WHERE id=$verifyschool";
    $zatimnic = (mysqli_query($con, "SELECT zskola FROM accounts WHERE id=$verifyschool"));
    $row = (mysqli_fetch_array($zatimnic));
    $con -> close();
    if ($_SESSION['name'] === $row["zskola"]){
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM accounts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
    } else {
    exit('Nemáte práva na odstranění tohoto uživatele.');
}
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Odstranit žáka <?=$contact['firstname']?> <?=$contact['surname']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Jste si jisti, že chcete odstranit žáka <?=$contact['firstname']?> <?=$contact['surname']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>