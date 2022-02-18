<?php

require_once "authorize.php";

#var_export($_SESSION['user']['id']); die;

$name = $_POST['name'] ?? '';
$ingredients = $_POST['ingredients'] ?? '';
$url = $_POST['url'] ?? '';
$description = $_POST['description'] ?? '';
$type = $_POST['type'] ?? '';
$hours = intval($_POST['hours']) ?? 0;
$mins = intval($_POST['mins']) ?? 0;


if ($name == '' || !in_array($type, ['Colazione', 'Primo', 'Secondo', 'Snack', 'Dessert'])) {
    $_SESSION['add_data'] = [
        'name'  => $name,
        'ingredients' => $ingredients,
        'url' => $url,
        'description' => $description,
        'type' => $type,
        'hours' => $hours,
        'mins' => $mins,
    ];
    header('location: add.php?');
    die;
}

try {

    $stmt = $db->prepare("
        INSERT INTO recipes SET 
            `name` = :name,
            ingredients = :ingredients,
            url = :url,
            description = :description,
            `type` = (:type),
            hours = :hours,
            mins = :mins,
            userId = :userId
        ");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':hours', $hours);
    $stmt->bindParam(':mins', $mins);
    $stmt->bindParam(':userId', $_SESSION['user']['id']);
    #var_export($stmt); die;
    $stmt->execute();

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

header('location: /index.php');


?>
