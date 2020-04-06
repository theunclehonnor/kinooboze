<?php
require('../lib/account.php');
require('../lib/obzor.php');
session_start();
if (isset($_SESSION['user'])) {
	if (!$_SESSION['user']->moderator) {
		header('Location: index.php');
		die();
	}
} else {
	header('Location: index.php');
	die();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AddObzor</title>
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
			<a class="li_active" href="addObzor.php">
				<p>Добавить обзор</p>
			</a>
			<a href="#">
				<p>Привет, Artem</p>
			</a>
			<a href="methods/logout.php">
				<p>Выйти</p>
			</a>
		</div>
	</header>
	<section class="section-poster">
		<form action="methods/pushObzor.php" method="POST" class="section-poster__form" enctype="multipart/form-data">
			<div class="message_center">
				<?php
				if ($_SESSION['message']) {
					echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
				}
				unset($_SESSION['message']);
				?>
			</div>
			<div class="poster-instruments">
				<div class="poster-instruments__container-foto">
					<img class="poster-img__add" id="img-poster" src="<?php
																		if (!isset($_SESSION['file'])) {
																			echo 'img/photo-poster.jpg';
																		} else {
																			echo $_SESSION['test_obzor']->poster;
																			$_SESSION['file'] = $_SESSION['test_obzor']->poster;
																		}
																		?>" alt="poster" name="img">
					<label for="file" class="button poster__button">Добавить фото постера</label>
					<input type="file" name="file" id="file" class="poster__button_hidden">
				</div>
				<div class="poster-editing">
					<div class="poster-editing__name">
						<input class="poster-editing__title" type="text" name="nameFilm" id="nameFilm" placeholder="+название" value="<?= $_SESSION['test_obzor']->nameFilm ?>" required />
					</div>
					<div class="poster-editing__body">
						<p class="poster-editing__obzor">Обзор:</p>
						<div class="poster-editing__textarea">
							<textarea name="textObzor" maxlength=5000 rows="26" id="textObzor" class="poster-editing__textarea-redacted" placeholder="Напишите ваш обзор"><?= $_SESSION['test_obzor']->textObzor ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="poster-trailer">
				<div class="poster-trailer__title">
					<h3 class="poster-trailer__text">Трейлер</h3>
				</div>
				<div class="poster-trailer__youtubeLink">
					<label class="poster-trailer__label" for="link__trailer">Ссылка на трейлер с youtube:</label>
					<input class="poster-trailer__link" type="text" name="linkTrailer" id="link__trailer" value="<?= $_SESSION['test_obzor']->linkTrailer ?>" required />
				</div>
				<input type="submit" class="button button-push_obzor" value="Выложить обзор">
			</div>
		</form>
	</section>
	<!-- Footer -->
	<?php include 'methods/footer.php' ?>
</body>

</html>