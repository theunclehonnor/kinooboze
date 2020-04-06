<?php
require_once('connect.php');
require('../../lib/account.php');
session_start();

$user = new Account();
$user->registrationForm();
$_SESSION['test_user'] = $user;

try {
    if (!empty($user->email) && !empty($user->password) && !empty($user->name) && $user->personalData) {
        if (!preg_match("/^[а-яА-я0-9_\-%\s]+$/iu", $user->name)) {
            throw new Exception(' В имени допустимы только русские буквы, пробелы и дефисы!');
        }
        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Введите корректный email!');
        }
        if (strlen($user->password) < 6) {
            throw new Exception('Минимальная длина пароля - 6 символов!');
        } elseif (!preg_match("/[^0-9]/", $user->password)) {
            throw new Exception('Пароль не может состоять только из одних цифр!');
        }
        if (strcasecmp($_POST['passwordRetard'], $user->password) != 0) {
            throw new Exception('Пароли не совпадают!');
        }
        if (strcasecmp($user->personalData, "on") == 0) {
            $user->personalData = "true";
        } else {
            $user->personalData = "false";
        }
        if ($user->checkedName()) {
            throw new Exception('Пользователь с таким именем уже существует!');
        }
        if ($user->checkedEmail()) {
            throw new Exception('Пользователь с такой почтой уже существует!');
        }

        $user->setAccount(); //создаем аккаунт в БД
        $user->setIdAccount(); // узнаем id account
        $_SESSION['user']= $user; // в сессии будем хранить user
        unset($_SESSION['test_user']);
        header('Location: ../index.php');
        die();
    } else {
        throw new Exception('Пожалуйста, заполните все поля');
    }
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    header('Location: ../registration.php'); // Редирект
    unset($user);
    die();
}
