<?php
require_once('connect.php');
require('../../lib/obzor.php');
require('../../lib/account.php');
require('../../lib/comment.php');
session_start();
if(!$_POST['textAddComment']){
	$_SESSION['message'] = "Вы ничего не написали!";
	header('Location: ../pageObzor.php?idObzor=' . $_SESSION['obzor']->idObzor);
	die();
}
$comment = new Comment();
$comment->setComment($_SESSION['obzor']->idObzor, $_SESSION['user']->idAccount, $_POST['textAddComment']);
header('Location: ../pageObzor.php?idObzor=' . $_SESSION['obzor']->idObzor);
die();
?>