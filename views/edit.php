<?php
if ($_SESSION['auth']) {

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Редактирование идеи</title>
        <link rel="stylesheet" href="../assets/styles.css">
        <link rel="stylesheet" href="../assets/personal-account.css">
    </head>
    <body>
    <div class="nav">
        <a href="/">На главную</a>
        <a href="/account/<?php echo $_SESSION['id'] ?>">Назад</a>
        <a href="/logout">Выход</a>
    </div>
    <div class="container">
        <header>
            <h1>Редактирование идеи</h1>
        </header>

        <main>
            <section id="ideas-list">
                <form class="idea-item" method="post">
                    <label>
                        <input name="title" type="text" value="<?php echo $idea['title'] ?>">
                    </label>
                    <label>
                        <textarea name="description"><?php echo $idea['description'] ?></textarea>
                    </label>
                    <?php if ($idea['created_at'] === $idea['updated_at']) { ?>
                        <span><?php echo $idea['created_at'] ?></span>
                    <?php } else { ?>
                        <span>ред. <?php echo $idea['updated_at'] ?></span>
                    <?php } ?>
                    <input  type="submit" class="edit-btn edit-inp" value="Редактировать">
                </form>
            </section>
        </main>

        <footer>
            <p>© 2025 Идея</p>
        </footer>
    </div>
    </body>
    </html>

<?php } else {
    header('Location: /login');
} ?>
