<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

$connectionObj = new Connection();
$connection = $connectionObj->getPdo();
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $book = $connection->prepare('SELECT * from book as b join books_category as bc on b.category = bc.category_id join author as a on b.author=a.author_id where id = :id');
    $book->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $book->execute();
    $bookData = $book->fetch(PDO::FETCH_ASSOC);
    echo json_encode($bookData);
} else {
    $books = $connection->prepare('SELECT * from book as b join books_category as bc on b.category = bc.category_id join author as a on b.author=a.author_id');
    $books->execute();
    $booksData = $books->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($booksData));
}

?>