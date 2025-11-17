<?php

session_start();

require_once './connect.php';

if (!empty($_SESSION['auth'])) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM ideas where id=:id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $idea = $stmt->fetch();

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    if (isset($_POST['title']) and isset($_POST['description'])) {

        $dateNow = date('y-m-d H:i:s');


        try {
            $stmt = $pdo->prepare('UPDATE ideas SET title=:title,description=:description,
            updated_at=:updated_at WHERE id=:id');

            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $_POST['title']);
            $stmt->bindValue(':description', $_POST['description']);
            $stmt->bindValue(':updated_at', $dateNow);
            $stmt->execute();

            header('Location: /account/' . $_SESSION['id']);

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
