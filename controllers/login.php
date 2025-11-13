<?php

require './connect.php';

session_start();

$_SESSION['auth'] = null;


if (!empty($_POST['email']) and !empty($_POST['password'])) {
    $email = $_POST['email'];

    try {

        $stmt = $pdo->prepare('SELECT * FROM users where email=:email');

        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!empty($user)) {
            $hash = $user['password'];
            $password = password_verify($_POST['password'], $hash);
        }

        if (!empty($password)) {
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['login-error'] = null;

            header('location: account/' . $user['id']);
        } else {
            header('Location: /login');
            $_SESSION['login-error'] = true;
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

