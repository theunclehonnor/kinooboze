<?php
require_once('methods/connect.php');
require('../lib/obzor.php');
require('../lib/account.php');
require('../lib/comment.php');
session_start();
require('methods/processingGetRequest.php');
if (!isset($_SESSION['obzor'])) {
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
            <a href="../index.php" class="">
                <h1 class="logo"><span class="logo_red">K</span>inooboz</h1>
            </a>
        </div>
        <div class="header-links">
            <?php include 'methods/header.php' ?>
        </div>
    </header>
    <section class="section-poster obzor">
        <div class="section-poster__form">
            <div class="poster-instruments">
                <img class="poster-img__add" src="../<?= $_SESSION['obzor']->poster ?>" alt="poster" name="img">
                <div class="poster-editing">
                    <div class="poster-editing__name">
                        <p class="poster-name">
                            <?= $_SESSION['obzor']->nameFilm ?>
                        </p>
                    </div>
                    <div class="poster-editing__body">
                        <p class="poster-editing__obzor">Автор обзора: <?= $_SESSION['obzor']->getAutorObzor() ?></p>
                        <p class="poster-editing__obzor">Дата добавления: <?= $_SESSION['obzor']->dateAdd ?></p>
                        <p class="poster-editing__obzor">Обзор:</p>
                        <div class="poster-editing__textarea">
                            <textarea name="textobzora" maxlength=5000 rows="20" id="textobzora"
                            class="poster-editing__textarea-redacted" readonly><?= $_SESSION['obzor']->textObzor ?>
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="poster-trailer">
                <div class="poster-trailer__title">
                    <h3 class="poster-trailer__text">Трейлер</h3>
                </div>
                <div class="poster-trailer__youtubeLink">
                    <iframe class="poster-trailer__iframe" src=<?= $_SESSION['obzor']->linkTrailer ?> frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="poster-comment">
                <div class="poster-comment__title">
                    <h3 class="poster-comment__text">Отзывы</h3>
                </div>
                <?php include 'methods/comments.php' ?>
                <form action="methods/addComment.php" method="post" class="comment-add
                    <?php $otchet = (!isset($_SESSION['user']) ? 'comment-add__none' : null);
                    echo $otchet;
                    ?>">
                    <h3 class="comment-add__title">Оставить комментарий</h3>
                    <div class="comment-add__line"></div>
                    <div class="message_center">
                        <?php
                        if ($_SESSION['message']) {
                            echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
                        }
                        unset($_SESSION['message']);
                        ?>
                    </div>
                    <div class="comment-add__textarea">
                        <textarea name="textAddComment" maxlength=350 rows="7"
                        id="textAddComment" class="comment-add__textarea-redacted"
                        placeholder="Оставьте свой комментарий"></textarea>
                    </div>
                    <input type="submit" class="button button-push_comment" value="Отправить">
                </form>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php include 'methods/footer.php' ?>
</body>

</html>