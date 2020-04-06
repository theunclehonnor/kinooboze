<?php
require_once('connect.php');
require('../lib/obzor.php');

$obzor = new Obzor();
$data = $obzor->getDataForIndexPage();
