<?php
require_once "authorize.php";

$id = intval($_GET['id'] ?? 0);

try {

    $stmt = $db->prepare("
        SELECT * FROM recipes WHERE userId = :userId AND id = :id
    ");
    $stmt->bindParam(':userId', $_SESSION['user']['id']);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die();
}

$r = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['edit_data'])) {
    $name = $_SESSION['edit_data']['name'];
    $ingredients = $_SESSION['edit_data']['ingredients'];
    $url = $_SESSION['edit_data']['url'];
    $description = $_SESSION['edit_data']['description'];
    $type = $_SESSION['edit_data']['type'];
    $hours = $_SESSION['edit_data']['hours'];
    $mins = $_SESSION['edit_data']['mins'];
    unset($_SESSION['edit_data']);
} else {
    $name = $r['name'];
    $ingredients = $r['ingredients'];
    $url = $r['url'];
    $description = $r['description'];
    $type = $r['type'];
    $hours = $r['hours'];
    $mins = $r['mins'];
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

    <title>Modifica Ricetta - Il Ricettario di Dario</title>
</head>
<body>

<div class="topbar">
    <div class="left"> <button class="backBtn" onclick="location = 'detail.php?id=<?= $id ?>'"> <span class="material-icons"> arrow_back </span> </button> </div>
    <h2> Modifica Ricetta </h2>
    <div class="right"></div>
</div>

<div class="body">
    <form method="post" id="editForm" action="edit_r.php?id=<?= $id ?>" enctype="multipart/form-data">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="<?= $name ?>">
        <br> <br>

        <label for="url">Link: </label>
        <input type="text" id="url" name="url" value="<?= $url ?>">
        <br> <br>

        <label for="ingredients">Ingredienti: </label> <br>
        <textarea id="ingredients" name="ingredients"><?= $ingredients ?> </textarea>
        <br> <br>

        <label for="description">Descrizione: </label> <br>
        <textarea id="description" name="description"><?= $description ?> </textarea>
        <br> <br>

        <label for="type">Tipo: </label>
        <select name="type" id="type">
            <option value=""></option>
            <?php $sel = ($type === 'Colazione') ? 'selected' : ''; ?>
            <option value="Colazione" <?= $sel ?>>Colazione</option>
            <?php $sel = ($type === 'Primo') ? 'selected' : ''; ?>
            <option value="Primo" <?= $sel ?>>Primo</option>
            <?php $sel = ($type === 'Secondo') ? 'selected' : ''; ?>
            <option value="Secondo" <?= $sel ?>>Secondo</option>
            <?php $sel = ($type === 'Snack') ? 'selected' : ''; ?>
            <option value="Snack" <?= $sel ?>>Snack</option>
            <?php $sel = ($type === 'Dessert') ? 'selected' : ''; ?>
            <option value="Dessert" <?= $sel ?>>Dessert</option>
        </select>
        <br> <br>

        <label for="hours">Durata: </label> <input name="hours" id="hours" type="number" min="0" size="1" value="<?= $r['hours'] ?>"> ore &nbsp
        <input name="mins" id="mins" type="number" step="5" min="0" size="2" value="<?= $mins ?>"> minuti
        <br> <br>

        <label for="image">Image</label>
        <?php if(file_exists("pics/$id.png")): ?>
            <img src="pics/<?= $id ?>.png" width="150px">
        <?php else: ?>
            <img src="pics/foodIcon.png" width="150px">
        <?php endif ?> &nbsp; &nbsp;
        <input id="image" type="file" name="image" accept="image/png" style="margin-top: 20px">
        <br> <br>

        

        <div class="formBtns">
            <button type="submit">Salva</button>
            <button type="reset">Reset</button>
            <button type="button" onclick="location = 'detail.php?id=<?= $id ?>'">Annulla</button>
        </div>
    </form>
</div>

</body>
</html>
