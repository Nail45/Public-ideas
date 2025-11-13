<?php

session_start();

require_once './connect.php';

try {
    $stmt = $pdo->prepare('SELECT * FROM ideas where user_id=:id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $ideas = $stmt->fetchAll();

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

try {
    $stmt = $pdo->prepare('SELECT name FROM users where id=:id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $user = $stmt->fetch();

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

if (!empty($_SESSION['auth'])) {


    if (isset($_POST['delete'])) {
        try {
            $stmt = $pdo->prepare('DELETE FROM ideas where id=:id');
            $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
            $stmt->execute();

            header('Location: /account/' . $_SESSION['id']);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    if (isset($_POST['title']) and isset($_POST['description'])) {
        try {
            $stmt = $pdo->prepare('INSERT INTO ideas(title, description, created_at, updated_at, user_id)
                                VALUES (:title,:description,:created_at,:updated_at,:user_id)');

            $dateNow = date('y-m-d H:i:s');

            $stmt->bindValue(':title', $_POST['title']);
            $stmt->bindValue(':description', $_POST['description']);
            $stmt->bindValue(':created_at', $dateNow);
            $stmt->bindValue(':updated_at', $dateNow);
            $stmt->bindValue(':user_id', $_SESSION['id']);
            $stmt->execute();

            header('Location: /account/' . $_SESSION['id']);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}