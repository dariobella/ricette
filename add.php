<?php
require_once "authorize.php";
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
    <h2> Nuova Ricetta </h2>
</div>

<div class="body">
    <form method="post" id="addForm" onsubmit="add_r.php" enctype="multipart/form-data">
        <label for="name">Nome: </label>
        <input type="text" id="name" name="name">
        <br> <br>

        <label for="url">Link: </label>
        <input type="text" id="url" name="url">
        <br> <br>

        <label for="ingredients">Ingredienti: </label> <br>
        <textarea id="ingredients" name="ingredients"> </textarea>
        <br> <br>

        <label for="description">Descrizione: </label> <br>
        <textarea id="description" name="description"> </textarea>
        <br> <br>

        <label for="type">Tipo: </label>
        <input type="text" id="name" name="name">
        <br> <br>

        <label for="hours">Durata: </label> <input name="hours" id="hours" type="number" min="0" size="1"> hours
        <input name="mins" id="mins" type="number" min="0" size="2"> mins

        <div class="formBtns">
            <button type="submit">Aggiungi</button>
            <button type="reset">Reset</button>
            <button type="button" onclick="location='index.php'">Annulla</button>
        </div>
    </form>
</div>

</body>
</html>
