<?php
include_once('conn.php');
session_start();

$userid = null;
$vorname_neu = null;
$nachname_neu = null;

if(isset($_GET['vorname_neu'], $_GET['nachname_neu'])) {

    $userid = $_SESSION['userid'];
    $nachname_neu = $_GET['nachname_neu'];
    $vorname_neu = $_GET['vorname_neu'];

    $db->query("UPDATE users SET vorname = \"{$vorname_neu}\", nachname = \"{$nachname_neu}\" WHERE id = {$userid}");

    header('Location: ../pages/experimental/profil.php');

}
