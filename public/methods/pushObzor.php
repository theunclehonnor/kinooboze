<?php
require_once ('connect.php');
require ('../../lib/obzor.php');
require ('../../lib/account.php');
session_start();

$obzor = new Obzor();
try {
	$obzor->checkParam(); // Проверяем переданные данные
	$obzor->setIdModer($_SESSION['user']->idAccount); // Присваиваем обзору id модератора
	$obzor->setObzor();
	if(isset($_SESSION['test_obzor']))
		unset($_SESSION['test_obzor']);
		unset($_SESSION['file']);
	header('Location: ../pageObzor.php?idObzor='. $obzor->idObzor);
} catch (Exception $e) {
	$_SESSION['message'] = $e->getMessage();
	$_SESSION['test_obzor'] = $obzor; 
	header('Location: ../addObzor.php'); 
	die();
}
?>