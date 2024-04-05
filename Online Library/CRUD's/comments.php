<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

header('Content-Type: application/json');
$connectionObj = new Connection();
$connection = $connectionObj->getPdo();

if(isset($_GET['userId'])) {
    $comments = $connection->prepare('SELECT * from 
    comment as c join user as u on c.user=u.id
    join book as b on c.book=b.id
    where
    c.is_deleted = 0 && c.book = :id &&
    (c.is_approved = 1 || c.user = :userId) order by c.datetime DESC');
    $commentData = [
        ':id'=> $_GET['id'],
        ':userId'=> $_GET['userId']
    ];
    $comments->execute($commentData);
    $commentsData = $comments->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($commentsData));
}else if(isset($_GET['id'])){
    $comments = $connection->prepare('SELECT * from comment as c join user as u on c.user=u.id join book as b on c.book=b.id where c.is_deleted = 0 && c.book = :id && c.is_approved = 1 order by c.datetime DESC');
    $comments->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $comments->execute();
    $commentsData = $comments->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($commentsData));
}else {
    $comments = $connection->prepare('SELECT * from comment as c join user as u on c.user=u.id join book as b on c.book=b.id where c.is_deleted = 0 order by c.datetime DESC');
    $comments->execute();
    $commentsData = $comments->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($commentsData));
}


?>