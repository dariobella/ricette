<?php
require_once "authorize.php";
?>

<!DOCTYPE HTML>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Dario Bella">

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Il Ricettario di Dario</title>
</head>
<body>

<div class="topbar">
    <h2> Le tue ricette </h2>
</div>

<div class="body">
    <div class="searchBar">
        <form method="post" id="searchForm" action="">
            <input type="text" id="search" placeholder="Search">
            <button id="searchBtn" onclick="alert('cerchiaml')"> <span class="material-icons">search</span> </button>
        </form>
    </div>

    <div class="recipeCard">
        <div class="recipeDesc">
            <img src="pics/gnocchi.jpg">
            <div class="descText">
                <b>Tipo: </b> <span>Pranzo</span> <br>
                <b>Ingredienti: </b> <span>Patate, farina, pomodoro</span> <br>
                <b>Durata: </b> <span>2 ore 30 min</span> <br>
            </div>
        </div>
        <div>
            <h4>Gnocchi di patate</h4>
        </div>
    </div>
    <div id="blank"></div>
</div>

<div class="centerAddBtn">
    <button id="addBtn" onclick="alert('aggiungiaml')"> <span class="material-icons">add</span> </button>
</div>

</body>
</html>
