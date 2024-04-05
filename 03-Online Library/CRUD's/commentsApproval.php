<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connectionObj = new Connection();
    $connection = $connectionObj->getPdo();

    if ($_POST['approve'] == 2) {
        $approve = $connection->prepare('UPDATE comment SET is_approved = 2 WHERE comment_id = :id');
        $approve->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $approve->execute();
        echo json_encode(['success' => true, 'message' => 'You have rejected comment number ' . $_POST['id']]);
    }else{
        $approve = $connection->prepare('UPDATE comment SET is_approved = 1 WHERE comment_id = :id');
        $approve->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $approve->execute();
        echo json_encode(['success' => true, 'message' => 'You have approved comment number ' . $_POST['id']]);
    }

}


?>