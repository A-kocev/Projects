<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

header('Content-Type: application/json');
$connectionObj = new Connection();
$connection = $connectionObj->getPdo();

$categories = $connection->prepare('SELECT * from books_category where is_deleted = 0');
$categories->execute();
$categoriesData = $categories->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($categoriesData));

?>