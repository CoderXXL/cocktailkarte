<?php

include('conn.php');

if (isset($_GET['cocktail'], $_GET['rating'])) {

    $cocktail = $_GET['cocktail'];
    $rating = $_GET['rating'];


    if (in_array($rating, [1, 2, 3, 4, 5])) {
        $exists = $db->query("SELECT id FROM cocktails WHERE id = {$cocktail}")->rowCount() ? true : false;
        var_dump($exists);
        if ($exists) {
            $db->query("INSERT INTO rating (cocktail, rating) VALUES ({$cocktail}, {$rating})");
        }

    }


    header('Location: ../cocktail.php?id=' . $cocktail);
}
