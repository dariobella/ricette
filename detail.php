<?php
require_once "authorize.php";

try {
    $stmt = $db->prepare("
        SELECT * FROM recipes WHERE userId = :userId AND id = :id
    ");
    $stmt->bindParam(':userId', $_SESSION['user']['id']);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

$r = $stmt->fetch(PDO::FETCH_ASSOC);

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

    <title>Dettaglio ricetta - Il Ricettario di Dario</title>
</head>
<body>

<div class="topbar" id="topbar">
    <div class="left"><button id="backBtn" onclick="location='index.php'"> <span class="material-icons">arrow_back</span> </button></div>
    <h2> <?= $r['name'] ?> </h2>
    <div class="right"></div>
</div>

<div class="body" id="detailBody">

    <?php if(file_exists("pics/$r[id].png")): ?>
        <img src="pics/<?= $r['id'] ?>.png">
    <?php else: ?>
        <img src="pics/foodIcon.png">
    <?php endif ?>
    <br>
    <a href="<?= $r['url'] ?>" target=”_blank”> link alla ricetta </a>

    <div class="descText">
        <b>Tipo: </b> <span> <?= $r['type'] ?> </span> <br>
        <b>Durata: </b>
        <span> <?php
            $hours = $r['hours']; $mins = $r['mins'];

            if ($hours != 0 && $hours == 1) echo "$hours ora ";
            else if ($hours != 0) echo "$hours ore ";

            if ($mins != 0 && $mins == 1) echo "$mins minuto";
            else if ($mins != 0) echo "$mins minuti";

            ?> </span> <br>

        <b>Ingredienti: </b> <span> <?= $r['ingredients'] ?> </span> <br>

        <b>Descrizione: </b> <span> <?= $r['description'] ?> </span> <br>

    </div>

    <div class="detailBtns">
        <button id="editBtn" onclick="edit(<?= $r['id'] ?>)"> <b> Edit </b> </button>
        <button id="deleteBtn" onclick="del(<?= $r['id'] ?>)"> <b> Delete </b> </button>
    </div>

    
</div>

<div id="blank"></div>

<script>
    function del(id) {
        if (confirm('Are you sure you want to delete this recipe?')) {
            location = "del.php?id=" + id
        }
    }

    function edit(id) {
        location = "edit.php?id=" + id
    }
</script>

</body>
</html>
