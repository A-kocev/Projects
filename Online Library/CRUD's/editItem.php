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
            $existBook = false;
            foreach ($booksData as $book) {
                if ($book['title'] == $_POST['title'] && $book['author'] == $_POST['author']) {
                    if ($_POST['title'] != $_POST['oldTitle'] || $_POST['author'] != $_POST['oldAuthor']) {
                        $existBook = true;
                    }
                }
            }
            if ($existBook) {
                header('location:.././app/adminPanel.php?existMsg=The%20book%20already%20exists');
                exit;
            }
            $edit = $connection->prepare('UPDATE book
                                                SET title = :title,
                                                    author = :author,
                                                    year_published = :year_published,
                                                    number_of_pages = :number_of_pages,
                                                    img = :img,
                                                    category = :category
                                                    WHERE id = :id');
            $editData = [
                'id' => $_POST['bookId'],
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'year_published' => $_POST['yearPublished'],
                'number_of_pages' => $_POST['numberOfPages'],
                'img' => $_POST['img'],
                'category' => $_POST['category']
            ];
            $edit->execute($editData);
            header('location:.././app/adminPanel.php?successMsg=The%20book%20has%20been%20updated%20successufully');
            break;
        case 'author':
            $authors = $connection->prepare('SELECT * from author');
            $authors->execute();
            $authorsData = $authors->fetchAll(PDO::FETCH_ASSOC);
            $existAuthor = false;
            foreach ($authorsData as $author) {
                if ($author['first_name'] == $_POST['firstName'] && $author['last_name'] == $_POST['lastName'] && $author['is_deleted'] == 0) {
                    if ($_POST['firstName'] != $_POST['oldFirstName'] || $_POST['lastName'] != $_POST['oldLastName']) {
                        $existAuthor = true;
                    }
                }
            }
            if ($existAuthor) {
                header('location:.././app/adminPanel.php?existAuthorMsg=An%20author%20with%20theese%20credentials%20already%20exists');
                exit;
            }
            ;
            $edit = $connection->prepare('UPDATE author
                                                SET first_name = :first_name,
                                                    last_name = :last_name,
                                                    short_bio = :short_bio
                                                    WHERE author_id = :id');
            $editData = [
                'id' => $_POST['authorId'],
                'first_name' => $_POST['firstName'],
                'last_name' => $_POST['lastName'],
                'short_bio' => $_POST['shortBio']
            ];
            $edit->execute($editData);
            header('location:.././app/adminPanel.php?successAuthorMsg=The%20author%20has%20updated%20added%20successufully');
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
            $edit = $connection->prepare('UPDATE books_category
                                                SET name = :name
                                                    WHERE category_id = :id');
            $editData = [
                'id' => $_POST['categoryId'],
                'name' => $_POST['name']
            ];
            $edit->execute($editData);
            header('location:.././app/adminPanel.php?successCategoryMsg=The%20category%20has%20updated%20added%20successufully');
            break;
        case 'note':
            $note = $connection->prepare('UPDATE note 
                                            SET content =:content 
                                                where note_id = :noteId');
            $noteData = [
                ':noteId'=> $_POST['noteId'],
                ':content'=> $_POST['content']
            ];
            $note->execute($noteData);
            echo json_encode(['success' => true, 'message' => 'The note has been updated successfully']);
            break;
    }



}


?>