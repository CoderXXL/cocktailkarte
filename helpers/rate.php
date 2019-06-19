<?php

include('conn.php');


if (isset($_GET['delete'], $_GET['user'], $_GET['cocktail'])) {

    $cocktail = $_GET['cocktail'];
    $delete = (int)$_GET['delete'];
    $user = $_GET['user'];

    if ($delete) {
        $db->query("DELETE FROM rating WHERE user = {$user} AND cocktail = {$cocktail}")->fetch();
    }

    header('Location: ../pages/experimental/cocktail.php?id=' . $cocktail);
}


if (isset($_GET['cocktail'], $_GET['rating'], $_GET['user'])) {

    $cocktail = $_GET['cocktail'];
    $rating = $_GET['rating'];
    $user = $_GET['user'];

    if (in_array($rating, [1, 2, 3, 4, 5])) {
        $exists = $db->query("SELECT id FROM cocktails WHERE id = {$cocktail}")->rowCount() ? true : false;
        var_dump($exists);
        if ($exists) {
            $db->query("INSERT INTO rating (cocktail, user, rating) VALUES ({$cocktail}, {$user}, {$rating})");
        }

    }


    header('Location: ../pages/experimental/cocktail.php?id=' . $cocktail);
}

