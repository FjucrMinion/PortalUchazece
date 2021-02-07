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
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$pristupskola=$_SESSION['name'];
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE sskola2=:sskola ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':sskola', $_SESSION['name'], PDO::PARAM_INT);
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM accounts')->fetchColumn();
?>
<?=template_header('2. termín PZ')?>

<div class="content read">
	<h2>2. termín PZ</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
	        </div>
        <div class="content read" style="overflow-x:auto;">
	<table>
        <thead>
            <tr>
                <td>SČU</td>
                <td>Jméno</td>
                <td>Email</td>
                <td>Tel. číslo</td>
                <td>Rodné číslo</td>
                <td>Rodné příjmení</td>
                <td>Kód oboru</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['firstname']?> <?=$contact['surname']?></td>
                <td><?=$contact['email']?></td>
                <td><?=$contact['phone']?></td>
                <td><?=$contact['rodnecislo']?></td>
                <td><?=$contact['originalsurname']?></td>
                <td><?=$contact['sskola2kod']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>