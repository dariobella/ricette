<?php
require_once "authorize.php";

#var_export($_POST); die;

$search = $_POST['search'] ?? '';

if ($search === '') {
    header('location: index.php');
    die;
}

try {
    $stmt = $db->prepare("
        SELECT * FROM recipes WHERE userId = :userId
    ");
    $stmt->bindParam(':userId', $_SESSION['user']['id']);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

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

<div class="topbar" id="topbar">
    <div class="left"><button class="backBtn" onclick="location='index.php'"> <span class="material-icons">arrow_back</span> </button></div>
    <h2> Le tue ricette </h2>
    <div class="right"> <button id="logoutBtn" onclick="location='login_r.php'"> <span class="material-icons">logout</span> </button> </div>
</div>

<div class="body">
    <div class="searchBar">
        <form method="post" id="searchForm" action="search.php">
            <input type="search" name="search" id="search" placeholder="Search" value="<?= $search ?>">
            <button id="searchBtn" type="submit"> <span class="material-icons">search</span> </button>
        </form>
    </div>

    <?php if (in_array(strtolower($search), ['colazione', 'primo', 'secondo', 'snack', 'dessert'])):

        while($r = $stmt->fetch(PDO::FETCH_ASSOC)):

            if (strtolower($r['type']) === strtolower($search)): ?>

                <div class="recipeCard" onclick="location='detail.php?id=<?= $r['id'] ?>'">
                    <div class="recipeDesc">
                        <?php if(file_exists("pics/$r[id].png")): ?>
                            <img src="pics/<?= $r['id'] ?>.png">
                        <?php else: ?>
                            <img src="pics/foodIcon.png">
                        <?php endif ?>
                        <div class="descText">
                            <b>Tipo: </b> <span> <?= $r['type'] ?> </span> <br>
                            <b>Ingredienti: </b> <span> <?= $r['ingredients'] ?> </span> <br>
                            <b>Durata: </b>
                            <span> <?php
                                $hours = $r['hours']; $mins = $r['mins'];

                                if ($hours != 0 && $hours == 1) echo "$hours ora ";
                                else if ($hours != 0) echo "$hours ore ";

                                if ($mins != 0 && $mins == 1) echo "$mins minuto";
                                else if ($mins != 0) echo "$mins minuti";

                                ?> </span>
                        </div>
                    </div>
                    <div>
                        <h4> <?= $r['name'] ?> </h4>
                    </div>
                </div>
            <?php endif ?>

        <?php endwhile ?>

        <div id="blank"></div>

    <?php else: ?>

        <div class="searchSection"> Name </div>

        <?php while($r = $stmt->fetch(PDO::FETCH_ASSOC)):

            if (strpos(strtolower($r['name']), strtolower($search)) !== false): ?>

                <div class="recipeCard" onclick="location='detail.php?id=<?= $r['id'] ?>'">
                    <div class="recipeDesc">
                        <?php if(file_exists("pics/$r[id].png")): ?>
                            <img src="pics/<?= $r['id'] ?>.png">
                        <?php else: ?>
                            <img src="pics/foodIcon.png">
                        <?php endif ?>
                        <div class="descText">
                            <b>Tipo: </b> <span> <?= $r['type'] ?> </span> <br>
                            <b>Ingredienti: </b> <span> <?= $r['ingredients'] ?> </span> <br>
                            <b>Durata: </b>
                            <span> <?php
                                $hours = $r['hours']; $mins = $r['mins'];

                                if ($hours != 0 && $hours == 1) echo "$hours ora ";
                                else if ($hours != 0) echo "$hours ore ";

                                if ($mins != 0 && $mins == 1) echo "$mins minuto";
                                else if ($mins != 0) echo "$mins minuti";

                                ?> </span>
                        </div>
                    </div>
                    <div>
                        <h4> <?= $r['name'] ?> </h4>
                    </div>
                </div>
            <?php endif ?>

        <?php endwhile ?>

        <div class="searchSection"> Ingredients </div>

        <?php while($r = $stmt->fetch(PDO::FETCH_ASSOC)):

            if (strpos(strtolower($r['ingredients']), strtolower($search)) !== false): ?>

                <div class="recipeCard" onclick="location='detail.php?id=<?= $r['id'] ?>'">
                    <div class="recipeDesc">
                        <?php if(file_exists("pics/$r[id].png")): ?>
                            <img src="pics/<?= $r['id'] ?>.png">
                        <?php else: ?>
                            <img src="pics/foodIcon.png">
                        <?php endif ?>
                        <div class="descText">
                            <b>Tipo: </b> <span> <?= $r['type'] ?> </span> <br>
                            <b>Ingredienti: </b> <span> <?= $r['ingredients'] ?> </span> <br>
                            <b>Durata: </b>
                            <span> <?php
                                $hours = $r['hours']; $mins = $r['mins'];

                                if ($hours != 0 && $hours == 1) echo "$hours ora ";
                                else if ($hours != 0) echo "$hours ore ";

                                if ($mins != 0 && $mins == 1) echo "$mins minuto";
                                else if ($mins != 0) echo "$mins minuti";

                                ?> </span>
                        </div>
                    </div>
                    <div>
                        <h4> <?= $r['name'] ?> </h4>
                    </div>
                </div>
            <?php endif ?>

        <?php endwhile ?>

        <div class="searchSection"> Description </div>


        <?php while($r = $stmt->fetch(PDO::FETCH_ASSOC)):

            if (strpos(strtolower($r['description']), strtolower($search)) !== false): ?>

                <div class="recipeCard" onclick="location='detail.php?id=<?= $r['id'] ?>'">
                    <div class="recipeDesc">
                        <?php if(file_exists("pics/$r[id].png")): ?>
                            <img src="pics/<?= $r['id'] ?>.png">
                        <?php else: ?>
                            <img src="pics/foodIcon.png">
                        <?php endif ?>
                        <div class="descText">
                            <b>Tipo: </b> <span> <?= $r['type'] ?> </span> <br>
                            <b>Ingredienti: </b> <span> <?= $r['ingredients'] ?> </span> <br>
                            <b>Durata: </b>
                            <span> <?php
                                $hours = $r['hours']; $mins = $r['mins'];

                                if ($hours != 0 && $hours == 1) echo "$hours ora ";
                                else if ($hours != 0) echo "$hours ore ";

                                if ($mins != 0 && $mins == 1) echo "$mins minuto";
                                else if ($mins != 0) echo "$mins minuti";

                                ?> </span>
                        </div>
                    </div>
                    <div>
                        <h4> <?= $r['name'] ?> </h4>
                    </div>
                </div>
            <?php endif ?>

        <?php endwhile ?>


    <?php endif ?>

    <div id="blank"></div>
</div>

<div class="centerAddBtn">
    <button id="addBtn" onclick="location='add.php'"> <span class="material-icons">add</span> </button>
</div>

</body>
</html>
