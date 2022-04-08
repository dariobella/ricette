<?php
require_once 'config.php';

if (($_SESSION['user'] ?? '') == '') {
    header('location: /login.php');
    $_SESSION['msg'] = 'Errore: impossibile accedere';
    die;
}