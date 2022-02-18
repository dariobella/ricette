<?php
require_once "authorize.php";

if (isset($_SESSION['add_data'])) {
    $name = $_SESSION['add_data']['name'];
    $ingredients = $_SESSION['add_data']['ingredients'];
    $url = $_SESSION['add_data']['url'];
    $description = $_SESSION['add_data']['description'];
    $type = $_SESSION['add_data']['type'];
    $hours = $_SESSION['add_data']['hours'];
    $mins = $_SESSION['add_data']['mins'];
    unset($_SESSION['add_data']);
} else {
    $name = '';
    $ingredients = '';
    $url = '';
    $description = '';
    $type = '';
    $hours = 0;
    $mins = 0;
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

    <title>Nuova Ricetta - Il Ricettario di Dario</title>
</head>
<body>

<div class="topbar">
    <div class="left"> <button class="backBtn" onclick="location = 'index.php'"> <span class="material-icons"> arrow_back </span> </button> </div>
    <h2> Le tue ricette </h2>
    <div class="right"></div>
</div>

<div class="body">
    <form method="post" id="addForm" action="add_r.php" enctype="multipart/form-data">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="<?= $name ?>">
        <br> <br>

        <label for="url">Link: </label>
        <input type="text" id="url" name="url" value="<?= $url ?>">
        <br> <br>

        <label for="ingredients">Ingredienti: </label> <br>
        <textarea id="ingredients" name="ingredients"> <?= $ingredients ?> </textarea>
        <br> <br>

        <label for="description">Descrizione: </label> <br>
        <textarea id="description" name="description"> <?= $description ?> </textarea>
        <br> <br>

        <label for="type">Tipo: </label>
        <select name="type" id="type">
            <option value=""></option>
            <?php
            $sel = ($type === 'Colazione') ? 'selected' : '';
            ?>
            <option value="Colazione" <?= $sel ?>>Colazione</option>
            <?php
            $sel = ($type === 'Primo') ? 'selected' : '';
            ?>
            <option value="Primo" <?= $sel ?>>Primo</option>
            <?php
            $sel = ($type === 'Secondo') ? 'selected' : '';
            ?>
            <option value="Secondo" <?= $sel ?>>Secondo</option>
            <?php
            $sel = ($type === 'Snack') ? 'selected' : '';
            ?>
            <option value="Snack" <?= $sel ?>>Snack</option>
            <?php
            $sel = ($type === 'Dessert') ? 'selected' : '';
            ?>
            <option value="Dessert" <?= $sel ?>>Dessert</option>
        </select>
        <br> <br>

        <label for="hours">Durata: </label> <input name="hours" id="hours" type="number" min="0" size="1" value="<?= $hours ?>"> ore &nbsp
        <input name="mins" id="mins" type="number" step="5" min="0" size="2" value="<?= $mins ?>"> minuti

        

        <div class="formBtns">
            <button type="submit">Aggiungi</button>
            <button type="reset">Reset</button>
            <button type="button" onclick="location='index.php'">Annulla</button>
        </div>
    </form>
</div>

</body>
</html>
