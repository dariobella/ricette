<?php
require_once "config.php";

$username = $_POST['username'] ?? '';
$psw = $_POST['psw'] ?? '';

unset($_SESSION['user']);

try {
    $stmt = $db->prepare("
        SELECT username FROM users
        WHERE username=:username AND psw=MD5(CONCAT(:psw, :salt))
    ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':psw', $psw);
    $stmt->bindParam(':salt', $securitysalt);
    $stmt->execute();

    if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $_SESSION['user'] = $user;
        $_SESSION['msg'] = 'Logged in';

        header('location: index.php');
        die;
    } else {
        $_SESSION['msg'] = "Impossibile accedere";
    }

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

header("location: login.php");
