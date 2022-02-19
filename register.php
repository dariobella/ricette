<?php
require_once "config.php";

if (isset($_SESSION['register_data'])) {
    $msg  = $_SESSION['register_data']['msg'];
    $username = $_SESSION['register_data']['username'];
    $psw = $_SESSION['register_data']['psw'];

    unset($_SESSION['add_data']);
} else {
    $msg  = '';
    $username = '';
    $psw = '';
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Dario Bella">

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Register - Il Ricettario di Dario</title>
</head>
<body>

<div class="topbar">
    <div class="left"></div>
    <h2> Register </h2>
    <div class="right"></div>
</div>

<div class="body">
    <form method="post" id="registerForm" onsubmit="register(); return false">
        <input type="text" id="username" name="username" placeholder="Username" value="<?= $username ?>">
        <input type="password" id="psw" name="psw" placeholder="Password" value="<?= $psw ?>">
        <input type="password" id="confPsw" name="confPsw" placeholder="Confirm Password" value="">
        <div class="formBtns">
            <button type="submit">Register</button>
            <button type="reset">Reset</button>
        </div>
    </form>
    <nobr> Already have an account? <a href="login.php">Login</a> </nobr>
</div>

<script type="text/javascript">
    function register() {
        var psw = document.getElementById('psw').value;
        var confPsw = document.getElementById('confPsw').value;

        if (psw.localeCompare(confPsw) === 0) {
            if (psw.length >= 5) {
                var form = document.getElementById('registerForm');
                var url = `register_r.php?username=${form.username.value}&psw=${form.psw.value}`;
                location.href = url;
            } else {
                alert('Error: password minimum length is 5');
            }
        } else {
            alert('Error: password and confirm password do not match');
        }
    }
</script>

</body>
</html>