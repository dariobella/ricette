<?php
require_once "config.php";

#var_export($_POST); die;

$username = $_POST['username'] ?? '';
$psw = $_POST['psw'] ?? '';

unset($_SESSION['user']);

try {
    $stmt = $db->prepare("
        SELECT id, username FROM users
        WHERE username=:username AND psw=MD5(CONCAT(:psw, :salt))
    ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':psw', $psw);
    $stmt->bindParam(':salt', $securitysalt);
    $stmt->execute();

    if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $_SESSION['user'] = $user;

        header('location: index.php');
        die;
    }

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

header("location: login.php");
