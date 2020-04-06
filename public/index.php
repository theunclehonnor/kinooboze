<?php
require('../lib/account.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
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
            <?php include('methods/header.php') ?>
        </div>
    </header>
    <section class="section-posters">
        <div class="posters-content">
            <div class="posters-content__row">
                <?php include('methods/loadingFromBd.php') ?>
                <?php include('methods/onePosterOnIndex.php') ?>
            </div>
        </div>
    </section>
    <?php include 'methods/footer.php' ?>
</body>
<script src="scripts/getPageObzor.js"></script>
<script src="scripts/setClassOnClick.js"></script>
</html>