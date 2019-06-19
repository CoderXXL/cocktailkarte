<?php
include('conn.php');

$cocktail = null;
$userId = null;

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}

if (isset($_GET['id'])) {
    $userId = $_SESSION['userid'];
    $id = $_GET['id'];
    $cocktail = $db->query("
    SELECT cocktails.id, cocktails.name, cocktails.zubereitung, AVG(rating.rating) AS rating
    FROM cocktails
    LEFT JOIN rating
    ON cocktails.id = rating.cocktail
    WHERE cocktails.id = {$id}
")->fetchObject();

}

