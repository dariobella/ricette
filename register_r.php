<?php
require_once "config.php";

#var_export($_GET);
#die;

$username = $_GET['username'] ?? '';
$psw = $_GET['psw'] ?? '';

if ($username == '' || $psw == '') {
    # --> restituire un messaggio di errore
    $_SESSION['register_data'] = [
        'msg'  => 'Some required data is missing',
        'username' => $username,
        'psw' => $psw,
    ];
    header('location: register.php?');
    die;
}

unset($_SESSION['user']);

try {
    $stmt = $db->prepare("
        INSERT INTO users (username, psw) VALUES (:username, MD5(CONCAT(:psw, :salt)))
    ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':psw', $psw);
    $stmt->bindParam(':salt', $securitysalt);
    $stmt->execute();

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

header("location: index.php");
