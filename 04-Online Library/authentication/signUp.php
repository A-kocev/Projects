<?php
require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

$connectionObj = new Connection();
$connection = $connectionObj->getPdo();

$existingEmails = $connection->query('SELECT email FROM user');
$existingEmails->execute();
$existingEmailsData = $existingEmails->fetchAll(PDO::FETCH_ASSOC);

if ($existingEmailsData) {
    foreach ($existingEmailsData as $email) {
        if ($email['email'] == $_POST['email']) {
            header('location:.././app/dashboard.html?Already%20exists%20an%20account%20with%20this%20email');
            exit;
        }
    }
}

$writeUser = $connection->prepare('INSERT INTO user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)');
$writeUserData = [
    'first_name' => $_POST['firstName'],
    'last_name' => $_POST['lastName'],
    'email' => $_POST['email'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
];
$writeUser->execute($writeUserData);

echo '<script>
        localStorage.setItem("firstName", "' . $_POST['firstName'] . '");
        localStorage.setItem("lastName", "' . $_POST['lastName'] . '");
        localStorage.setItem("userId" , "' .$connection->lastInsertId() . '");
        setTimeout(function() {
          window.location.href = ".././app/dashboard.html?loggedUser";
        }, 100); 
      </script>';


?>