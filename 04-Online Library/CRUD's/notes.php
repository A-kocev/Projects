<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

header('Content-Type: application/json');
$connectionObj = new Connection();
$connection = $connectionObj->getPdo();

$notes = $connection->prepare('SELECT * from note where user = :userId && book = :id');
$noteData=[
    ':userId'=> $_GET['userId'],
    ':id'=> $_GET['id']
];
$notes->execute($noteData);
$notesData = $notes->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($notesData));

?>