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
	<title>Registration</title>
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
			<a href="autorization.php">
				<p>Вход</p>
			</a>
			<a class="li_active" href="registration.php">
				<p>Регистрация</p>
			</a>
		</div>
	</header>
	<section class="section-registration">
		<div class="registration">
			<h1 class="registration__title">Регистрация пользователя</h1>
			<form action="methods/reg.php" method="post" class="registration__form">
				<!-- PHP проверка валидации формы регистрации -->
				<?php
				if ($_SESSION['message']) {
					echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
				}
				unset($_SESSION['message']);
				?>
				<div class="form-group">
					<label class="form__label" for="name">Имя:</label>
					<input class="form__input" type="text" name="name" id="name" placeholder="Артем" value="<?= $_SESSION['test_user']->name ?>" required />
				</div>
				<div class="form-group">
					<label class="form__label" for="email">Email:</label>
					<input class="form__input" type="email" name="email" id="email" placeholder="Email address" value="<?= $_SESSION['test_user']->email ?>" required />
				</div>
				<div class=" form-group">
					<label class="form__label" for="password">Пароль:</label>
					<input class="form__input" type="password" name="password" id="password" placeholder="Password" value="<?= $_SESSION['test_user']->password ?>" required />
				</div>
				<div class="form-group">
					<label class="form__label" for="password_retard">Повтор пароля:</label>
					<input class="form__input" type="password" name="passwordRetard" id="passwordRetard" placeholder="Retard password" value="<?= $_SESSION['test_user']->passwordRetard ?>" required />
				</div>
				<div class="form-group">
					<label class="form__label form__label_order2" for="radioButton">Согласие на обработку персональных данных</label>
					<input type="radio" onMouseDown="this.isChecked=this.checked;" onClick="this.checked=!this.isChecked;" id="radioButton" name="personalData" class="form__label_order1">
				</div>
				<input type="submit" class="form__bg button" value="Отправить">
			</form>
		</div>
	</section>
	<!-- Footer -->
	<?php include 'methods/footer.php' ?>
</body>

</html>