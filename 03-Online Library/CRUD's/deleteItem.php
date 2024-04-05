<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connectionObj = new Connection();
    $connection = $connectionObj->getPdo();
    
    switch ($_POST['item']) {
        case 'book':
            $delete = $connection->prepare('DELETE from book WHERE id = :id');
            $delete->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $delete->execute();
            break;
        case 'author':
            $delete = $connection->prepare('UPDATE author SET is_deleted = 1 WHERE author_id = :id');
            $delete->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $delete->execute();
            echo json_encode(['success' => true, 'message' => 'The author has been deleted successfully']);
            break;
        case 'category':
            $delete = $connection->prepare('UPDATE books_category SET is_deleted = 1 WHERE category_id = :id');
            $delete->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $delete->execute();
            echo json_encode(['success' => true, 'message' => 'The category has been deleted successfully']);
            break;
        case 'comment':
            $delete = $connection->prepare('UPDATE comment SET is_deleted = 1 WHERE comment_id = :id');
            $delete->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $delete->execute();
            echo json_encode(['success' => true, 'message' => 'The category has been deleted successfully']);
            break;
        case 'note':
            $delete = $connection->prepare('DELETE from note WHERE note_id = :id');
            $delete->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $delete->execute();
            echo json_encode(['success' => true, 'message' => 'The note has been deleted successfully']);

            break;
    }


}


?>