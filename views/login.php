<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Авторизация</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>
<?php if (isset($_SESSION['login-error'])) { ?>
    <div class="error">Неверный email или пароль</div>
<?php } ?>

<form action="/login" method="POST">
    <h2>Авторизация</h2>

    <label for="email">Почта:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Войти</button>
</form>
<div class="to-login"><a href="/register">Зарегистрироваться</a></div>
</body>
</html>

