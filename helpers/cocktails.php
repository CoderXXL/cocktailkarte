<?php
include('conn.php');

$rating=0;


$query = $db->query("
    SELECT cocktails.id, cocktails.name, cocktails.zubereitung ,AVG(rating.rating) AS rating
    FROM cocktails
    LEFT JOIN rating
    ON cocktails.id = rating.cocktail
    GROUP BY cocktails.id
");
$cocktails = [];

while($row = $query->fetchObject()) {
    $cocktails[] = $row;
}