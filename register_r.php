<?php
require_once "config.php";

#var_export($_GET); die;

$username = $_GET['username'] ?? '';
$psw = $_GET['psw'] ?? '';

if ($username == '' || $psw == '') {
    $_SESSION['register_data'] = [
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

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

?>

<form method="POST" action="login_r.php" name="registerLoginForm" id="registerLoginForm">

    <input type="hidden" name="username" value="<?= $username ?>">
    <input type="hidden" name="psw" value="<?= $psw ?>">

</form>

<script type="text/javascript">

    window.onload = function(){
        document.forms['registerLoginForm'].submit();
    }

</script>
