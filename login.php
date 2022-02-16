<?php
require_once "config.php";
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

    <title>Login - Il Ricettario di Dario</title>
</head>
<body>

<div class="topbar">
    <h2> Login </h2>
</div>

<div class="body">
    <form method="post" id="loginForm" action="login_r.php">
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="password" id="psw" name="psw" placeholder="Password">
        <div class="formBtns">
            <button type="submit">Login</button>
            <button type="reset">Reset</button>
        </div>
    </form>
    <nobr> New here? <a href="register.php">Register</a> </nobr>
</div>

</body>
</html>