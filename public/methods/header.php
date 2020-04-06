<?php
if(isset($_SESSION['user'])){
	$name = (mb_strlen($_SESSION['user']->name) < 12) ? $_SESSION['user']->name : substr($_SESSION['user']->name, 0, 10) . "..";
	if($_SESSION['user']->moderator == 'true'){
		echo '<a href="../addObzor.php"><p>Добавить обзор</p></a>';
		echo '<a href="#"><p>Привет, ' . $name . '</p></a>';
		echo '<a href="methods/logout.php"><p>Выйти</p></a>';
	} else {
		echo '<a href="#"><p>Привет, ' . $name . '</p></a>';
		echo '<a href="methods/logout.php"><p>Выйти</p></a>';
	}
} else {
	echo '<a href="autorization.php"><p>Вход</p></a>';
	echo '<a href="registration.php"><p>Регистрация</p></a>';
}
?>