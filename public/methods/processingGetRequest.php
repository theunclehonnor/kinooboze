<?php
if (!isset($_GET['idObzor'])) {
    header('Location: index.php');
    die();
}

$obzor = new Obzor();
$obzor = $obzor->getObzor($_GET['idObzor']);
$_SESSION['obzor'] = $obzor;
if (!$_SESSION['obzor']->idObzor) {
    header('Location: index.php');
    unset($_SESSION['obzor']);
    unset($obzor);
    die();
}
