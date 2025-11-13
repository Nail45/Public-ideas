<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Последние идеи</title>
    <link rel="stylesheet" href="../assets/styles.css"/>
</head>
<body>
<?php if ($_SESSION['auth']) { ?>
    <div class="nav">
        <a href="/account/<?php echo $_SESSION['id'] ?>"><?php echo $user['name'] ?></a>
        <a href="/logout">Выход</a>
    </div>
<?php } else { ?>
    <div class="nav">
        <a href="/login">Войти</a>
    </div>
<?php } ?>


<header>
    <h1>Последние идеи</h1>
</header>
<main>
    <div class="ideas-list">
        <?php foreach ($ideas as $idea) { ?>
            <div class="idea">
                <h2 class="idea-title"><?php echo $idea['title'] ?></h2>
                <p class="idea-description"><?php echo $idea['description'] ?></p>
                <div class="idea-meta">
                    <?php if ($idea['created_at'] === $idea['updated_at']) { ?>
                        <span><?php echo $idea['created_at'] ?></span>
                    <?php } else { ?>
                        <span>ред. <?php echo $idea['updated_at'] ?></span>
                    <?php } ?>
                    <a href="/account/<?php echo $idea['id'] ?>" class="author"><?php echo $idea['name'] ?></a>
                </div>
            </div>
        <?php } ?>

    </div>
    <div class="pagination">
        <a href="?page=<?php echo $page - 1 ?>" class="page-link <?php
        if ($page === 1) {
            echo 'disabled';
        }
        ?>">Предыдущая</a>
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="?page=<?php echo $i ?>" class="page-link <?php if ($page == $i) {
                echo 'active';
            } else {
                echo '';
            }
            ?>"><?php echo $i ?></a>
        <?php } ?>
        <a href="?page=<?php echo $page + 1; ?>" class="page-link <?php
        if ($page == $totalPages) {
            echo 'disabled';
        }
        ?>">Следующая</a>
    </div>
</main>
</body>
</html>