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
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $rodnecislo = isset($_POST['rodnecislo']) ? $_POST['rodnecislo'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    // Insert new record into the contacts table
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('INSERT INTO accounts (id, firstname, surname, rodnecislo, email, phone, password, zskola) VALUES (:id, :firstname, :surname, :rodnecislo, :email, :phone, :password, :zskola)');
    $stmt->bindValue(':firstname', $firstname);
    $stmt->bindValue(':surname', $surname);
    $stmt->bindValue(':rodnecislo', $rodnecislo);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':id', NULL);
    $stmt->bindValue(':zskola', $_SESSION['name']);
    $stmt->execute();
    // Output message
    $msg = 'Úspěšně vytvořen!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="firstname" placeholder="26" id="firstname">
        <input type="text" name="surname" placeholder="John Doe" id="surname">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="title">RČ</label>
        <label for="created">Heslo</label>
        <input type="text" name="rodnecislo" placeholder="Employee" id="rodnecislo">
        <input type="text" name="password" placeholder="něco silnějšího než test" id="password">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>