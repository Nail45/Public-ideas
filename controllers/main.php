<?php

session_start();

require_once './connect.php';

if (!empty($_SESSION['auth'])) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE users.id=:id');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();

        $user = $stmt->fetch();

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}

try {
    $page = isset($_GET['page']) ? ($_GET['page'] > 0 ? $_GET['page'] : 1) : 1;
    $perPage = 20;

    $stmtCount = $pdo->prepare('SELECT COUNT(*) AS total FROM ideas');
    $stmtCount->execute();
    $totalRecords = $stmtCount->fetchColumn();

    $totalPages = ceil($totalRecords / $perPage);

    if ($page > $totalPages) {
        $page = $totalPages;
    }

    $offset = ($page - 1) * $perPage;

    $stmt = $pdo->prepare('SELECT ideas.*, users.name, users.id FROM ideas left join users on ideas.user_id=users.id
                                     ORDER BY ideas.id ASC LIMIT :limit OFFSET :offset');
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $page = $_GET['page'];
    if ($page <= 1) {
        $page = 1;
    } elseif ($page >= $totalPages) {
        $page = $totalPages;
    }


} catch (PDOException $e) {
    header('location: /empty');
    echo 'Error: ' . $e->getMessage();
}

