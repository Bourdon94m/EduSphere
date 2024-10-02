<?php

require_once 'config.php';
require_once 'utilities.php';

$page = $_GET['page'] ?? 'acceuil';

include 'includes/header.php';

switch ($page) {
    case 'acceuil':
        include 'pages/acceuil.php';
        break;
    case 'catalogue':
        include 'pages/catalogue.php';
        break;
    case 'formation':
        include 'pages/formation.php';
        break;
    case 'mon-compte':
        include 'pages/mon-compte.php';
        break;
    case 'panier':
        include 'pages/panier.php';
        break;
    case 'login':
        include 'pages/login.php';
        break;
    case 'register':
        include 'pages/register.php';
        break;
}

include "includes/footer.php";

?>