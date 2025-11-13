<?php
//if ($_SESSION['auth']) {
//
//    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный Кабинет</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/personal-account.css">
</head>
<body>
<div class="nav">

    <a class=" <?php if (empty($ideas)) {
        echo 'disabled';
    }
    ?>" href="/">На главную</a>
    <a href="/logout">Выход</a>
</div>
<div class="container">
    <header>
        <h1>Личный кабинет</h1>
    </header>

    <main>
        <section id="ideas-list">
            <?php
            if ($_SESSION['auth'] and ($id == $_SESSION['id'])) { ?>
                <h2>Мои идеи</h2>
            <?php } else { ?>
                <h2>Идеи <?php echo $user['name'] ?></h2>
            <?php } ?>
            <?php foreach ($ideas as $idea) { ?>
                <div class="idea-item">
                    <h3><?php echo $idea['title'] ?></h3>
                    <p><?php echo $idea['description'] ?></p>
                    <?php if ($idea['created_at'] === $idea['updated_at']) { ?>
                        <span><?php echo $idea['created_at'] ?></span>
                    <?php } else { ?>
                        <span>ред. <?php echo $idea['updated_at'] ?></span>
                    <?php } ?>
                    <?php
                    if ($_SESSION['auth'] and ($id == $_SESSION['id'])) {

                        ?>
                        <div class="action-wrap">
                            <a class="edit-btn" href="/edit/<?php echo $idea['id'] ?>">Редактировать</a>
                            <form action="" method="post">
                                <input type="hidden" value="<?php echo $idea['id'] ?>" name="id">
                                <input class="delete-btn" type="submit" value="Удалить" name="delete">
                            </form>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </section>

        <?php if ($_SESSION['id'] == $id) { ?>

            <h2>Добавить идею</h2>

            <form action="" method="post" name="name">
                <label for="new-idea-title">Заголовок идеи:</label>
                <input name="title" type="text" id="new-idea-title" placeholder="Введите заголовок идеи"
                       required><br>

                <label for="new-idea-description">Описание идеи:</label>
                <textarea name="description" id="new-idea-description" rows="4" required></textarea><br>

                <button type="submit">Добавить идею</button>
            </form>

        <?php } ?>
    </main>

    <footer>
        <p>© 2025 Идея</p>
    </footer>
</div>
</body>
</html>

<?php //} else {
//    header('Location: /login');
//} ?>
