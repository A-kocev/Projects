<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

header('Content-Type: application/json');
$connectionObj = new Connection();
$connection = $connectionObj->getPdo();

$authors = $connection->prepare('SELECT * from author where is_deleted = 0');
$authors->execute();
$authorsData = $authors->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($authorsData));

?>