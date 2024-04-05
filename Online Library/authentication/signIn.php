<?php
require_once('.././databaseConfig/Database.php');
use Database\Connection as Connection;

$connectionObj = new Connection();
$connection = $connectionObj->getPdo();

$userEmail = $connection->prepare('SELECT * from user WHERE email = :email');
$userEmail->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$userEmail->execute();
$userEmailData = $userEmail->fetch(PDO::FETCH_ASSOC);
if ($userEmailData) {
    if (password_verify($_POST['password'], $userEmailData['password'])) {
        if ($userEmailData['role_id'] == 0) {
            echo '<script>
                localStorage.setItem("firstName", "' . $userEmailData['first_name'] . '");
                localStorage.setItem("lastName", "' . $userEmailData['last_name'] . '");
                setTimeout(function() {
                window.location.href = ".././app/adminPanel.php?loggedUser";
                }, 100); 
            </script>';
        } else {
            echo '<script>
                            localStorage.setItem("firstName", "' . $userEmailData['first_name'] . '");
                            localStorage.setItem("lastName", "' . $userEmailData['last_name'] . '");
                            localStorage.setItem("userId" , "' .$userEmailData['id'] . '");
                            setTimeout(function() {
                            window.location.href = ".././app/dashboard.html?loggedUser";
                            }, 100); 
                        </script>';
        }
    } else {
        header('location:.././app/dashboard.html?Wrong%20credentials');
    }
} else {
    header('location:.././app/dashboard.html?Wrong%20credentials');
}

?>