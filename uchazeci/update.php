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
        header("Location: http://portaluchazece.tk/login.html");
	    exit;
}
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])){
    $con = mysqli_connect("remotemysql.com", "DJcTw7h5BR", "W71l2MTgG4", "DJcTw7h5BR");
    $verifyschool = $_GET['id'];
    $sql = "SELECT zskola FROM accounts WHERE id=$verifyschool";
    $zatimnic = (mysqli_query($con, "SELECT zskola FROM accounts WHERE id=$verifyschool"));
    $row = (mysqli_fetch_array($zatimnic));
    $con -> close();
    if ($_SESSION['name'] === $row["zskola"]){
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $pdo = pdo_connect_mysql();
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
        $originalsurname = isset($_POST['originalsurname']) ? $_POST['originalsurname'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $rodnecislo = isset($_POST['rodnecislo']) ? $_POST['rodnecislo'] : '';
        // Update the record
        $verifyschool = $_GET['id'];
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('UPDATE accounts SET firstname=:firstname, surname=:surname, originalsurname=:originalsurname, email=:email, phone=:phone, rodnecislo=:rodnecislo WHERE id=:id');
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':originalsurname', $originalsurname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':rodnecislo', $rodnecislo);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    } else {
    exit('Nemate prava upravit tohoto uzivatele!');
}
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Upravit Žáka - <?=$contact['firstname']?> <?=$contact['surname']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="firstname">Jméno</label>
        <label for="surname">Příjmení</label>
        <input type="text" name="firstname" placeholder="Jan" value="<?=$contact['firstname']?>" id="firstname">
        <input type="text" name="surname" placeholder="Novák" value="<?=$contact['surname']?>" id="surname">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$contact['email']?>" id="email">
        <input type="text" name="phone" placeholder="2025550143" value="<?=$contact['phone']?>" id="phone">
        <label for="rodnecislo">Rodné Číslo</label>
        <label for="originalsurname">Rodné příjmení</label>
        <input type="text" name="rodnecislo" placeholder="0612310000" value="<?=$contact['rodnecislo']?>" id="rodnecislo">
        <input type="text" name="originalsurname" placeholder="Novotný" value="<?=$contact['originalsurname']?>" id="originalsurname">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>