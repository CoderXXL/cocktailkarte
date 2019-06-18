<?php

try {
    $host="mysql:host=localhost;dbname=cocktailkarte";
    $user="root";
    $password="Auto-123";

    $db = new PDO($host, $user, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}