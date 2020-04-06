<?php
require('../lib/account.php');
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorization</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div class="header-logo">
            <a href="index.php" class="">
                <h1 class="logo"><span class="logo_red">K</span>inooboz</h1>
            </a>
        </div>
        <div class="header-links">
            <a class="li_active" href="autorization.php">
                <p>Вход</p>
            </a>
            <a href="registration.php">
                <p>Регистрация</p>
            </a>
        </div>
    </header>
    <section class="section-registration section-registration_autorization">
        <div class="registration">
            <h1 class="registration__title autorization_title">Авторизация пользователя</h1>
            <form action="methods/signin.php" method="post" class="registration__form">
                <?php
                if ($_SESSION['message']) {
                    echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
                }
                unset($_SESSION['message']);
                ?>
                <div class="form-group form-group__resize">
                    <label class="form__label form__label_resize" for="email">Email:</label>
                    <input class="form__input form__input_resize" type="email" name="email" id="email"
                    placeholder="Email address" value="<?= $_SESSION['email'] ?>" required />
                </div>
                <div class="form-group form-group__resize">
                    <label class="form__label form__label_resize" for="password">Пароль:</label>
                    <input class="form__input form__input_resize" type="password" name="password" id="password"
                     placeholder="Password" required />
                </div>
                <input type="submit" class="form__bg button" value="Войти">
            </form>
        </div>
    </section>
    <!-- Footer -->
    <?php include 'methods/footer.php' ?>
</body>

</html>