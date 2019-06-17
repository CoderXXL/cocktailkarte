<?php
session_start();
include('./header.php');
include('../helpers/conn.php');
if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="./login.php">einloggen</a>');
}

$userid = $_SESSION['userid'];
$sql = 'SELECT vorname from users WHERE id = ' . $userid;

$data = $db->query($sql)->fetchObject();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hallo <?php echo $data->vorname ?></title>
</head>
<body>
<h3>Willkommen bei der besten Cocktailkarte im Internet, <?php echo $data->vorname ?></h3>
<a href="logout.php">Logout</a>

</body>
</html>
