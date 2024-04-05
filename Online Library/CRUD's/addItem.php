<?php

require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connectionObj = new Connection();
    $connection = $connectionObj->getPdo();

    switch ($_POST['item']) {
        case 'book':
            $books = $connection->prepare('SELECT * from book');
            $books->execute();
            $booksData = $books->fetchAll(PDO::FETCH_ASSOC);
            foreach ($booksData as $book) {
                if ($book['title'] == $_POST['title']) {
                    if ($book['author'] == $_POST['author']) {
                        header('location:.././app/adminPanel.php?existMsg=The%20book%20already%20exists');
                        exit;
                    }
                }
            }
            ;
            $add = $connection->prepare('INSERT INTO book (title,author,year_published,number_of_pages,img,category) VALUES (:title,:author,:year_published,:number_of_pages,:img,:category)');
            $addData = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'year_published' => $_POST['yearPublished'],
                'number_of_pages' => $_POST['numberOfPages'],
                'img' => $_POST['img'],
                'category' => $_POST['category']
            ];
            $add->execute($addData);
            header('location:.././app/adminPanel.php?successMsg=The%20book%20has%20been%20added%20successufully');
            break;
        case 'author':
            $authors = $connection->prepare('SELECT * from author');
            $authors->execute();
            $authorsData = $authors->fetchAll(PDO::FETCH_ASSOC);
            foreach ($authorsData as $author) {
                if ($author['first_name'] == $_POST['firstName'] && $author['last_name'] == $_POST['lastName'] && $author['is_deleted'] == 0) {
                    header('location:.././app/adminPanel.php?existAuthorMsg=An%20author%20with%20theese%20credentials%20already%20exists');
                    exit;
                }
            }
            ;
            $add = $connection->prepare('INSERT INTO author (first_name,last_name,short_bio) VALUES (:first_name,:last_name,:short_bio)');
            $addData = [
                'first_name' => $_POST['firstName'],
                'last_name' => $_POST['lastName'],
                'short_bio' => $_POST['shortBio']
            ];
            $add->execute($addData);
            header('location:.././app/adminPanel.php?successAuthorMsg=The%20author%20has%20been%20added%20successufully');
            break;
        case 'category':
            $categories = $connection->prepare('SELECT * from books_category');
            $categories->execute();
            $categoriesData = $categories->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categoriesData as $category) {
                if (strtolower($category['name']) == strtolower($_POST['name'])) {
                    header('location:.././app/adminPanel.php?existCategoryMsg=A%20category%20with%20that%20name%20already%20exists');
                    exit;
                }
            }
            ;
            $add = $connection->prepare('INSERT INTO books_category (name) VALUES (:name)');
            $add->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
            $add->execute();
            header('location:.././app/adminPanel.php?successCategoryMsg=The%20category%20has%20been%20added%20successufully');
            break;
        case 'comment':
            // var_dump($_POST);
            $comments = $connection->prepare('SELECT * from comment');
            $comments->execute();
            $commentsData = $comments->fetchAll(PDO::FETCH_ASSOC);
            foreach ($commentsData as $comment) {
                if($comment['user'] == $_POST['user'] && $comment['book'] == $_POST['book'] && $comment['is_deleted'] == 0) {
                    header('location:.././app/bookInfo.html#' . $_POST['book']);
                    exit;
                }
            }
            $comment = $connection->prepare('INSERT INTO comment (user,book,content) VALUES (:user,:book,:content)');
            $commentData = [
                ':user'=> $_POST['user'],
                ':book'=> $_POST['book'],
                ':content'=> $_POST['content']
            ];
            $comment->execute($commentData);
            echo '<script>
                    localStorage.setItem("commented", "true");
                    setTimeout(function() {
                        location.href = ".././app/bookInfo.html#' . $_POST['book'] . '?commentAdded"
                      }, 100); 
                </script>';    
            break;
        case 'note':
            $note = $connection->prepare('INSERT INTO note (user,book,content) VALUES (:user,:book,:content)');
            $noteData = [
                ':user'=> $_POST['user'],
                ':book'=> $_POST['book'],
                ':content' => $_POST['content']	
            ];
            $note->execute($noteData);
            echo json_encode(['success' => true, 'message' => 'The note has been added successfully','noteId' => $connection->lastInsertId()]);
            break;
    }




}


?>