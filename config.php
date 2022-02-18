<?php

// DISPLAY ALL ERRORS
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

$dbhost = "127.0.0.1";
$dbuser = "dario";
$dbpassword = "eS1vEsMySqL?";
$dbname = "ricette";
$securitysalt = '1d6896d08b9a73a26d07a7616d2f4d69';

try {
    $db = new PDO ("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}


?>