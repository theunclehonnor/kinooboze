<?php
require_once('connect.php');
require('../../lib/account.php');
session_start();

try {
    $user = new Account();
    $user->email = trim($_POST['email']);
    $user->password = trim($_POST['password']);
    $tempUser = $user->checkedEmail();
    if (!$tempUser) {
        throw new Exception('Пользователя с данным логином в системе не найден.');
    }
    if ($user->verifyPassword($tempUser->password)) { // сравниваем зашифрованный пароль
        $tempUser->setIdAccount();
        $_SESSION['user'] = $tempUser;
        unset($_SESSION['email']);
        header('Location: ../index.php'); // Редирект на главную
        die();
    } else {
        throw new Exception('Неверный пароль');
    }
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['email'] = $user->email;
    header('Location: ../autorization.php'); // Редирект на авторазацию
    die();
}
