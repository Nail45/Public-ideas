<?php

require_once './connect.php';

$_SESSION['auth'] = null;

if (!empty($_POST)) {

    if ($_POST['password'] === $_POST['confirm-password']) {

        $_SESSION['name'] = $_POST['name'];

        $_SESSION['email'] = $email = $_POST['email'];
        $_SESSION['login'] = $login = $_POST['login'];
        $passwordInitial = $_POST['password'];
        $passwordLength = mb_strlen($passwordInitial);

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $loginLength = mb_strlen($login);

        if ($loginLength < 3 or $loginLength > 10) {
            header('Location: /register');
            $_SESSION['login-error'] = true;
            return false;
        }

        if ($passwordLength < 3 or $passwordLength > 10) {
            header('Location: /register');
            $_SESSION['password-error'] = true;
            return false;
        }

        try {

            $stmt = $pdo->prepare('SELECT * FROM users where email=:email');

            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($user)) {
                $stmt = $pdo->prepare('INSERT INTO users(name, login, email, password) 
                                        VALUES (:name,:login,:email, :password)');

                $stmt->bindValue(':name', $_POST['name']);
                $stmt->bindValue(':login', $_POST['login']);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':password', $password);

                $stmt->execute();

                $id = $pdo->lastInsertId();

                $_SESSION['auth'] = true;
                $_SESSION['id'] = $id;

                header('location: account/' . $id);

            } else {
                header('Location: /register');
                $_SESSION['email-error'] = true;
            }


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        header('Location: /register');
        $_SESSION['repeated-password-error'] = true;
    }

}

