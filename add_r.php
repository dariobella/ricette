<?php

require_once "authorize.php";

var_export($_SESSION); die;

$name = $_POST['name'] ?? '';
$ingredients = $_POST['ingredients'] ?? '';
$url = $_POST['url'] ?? '';
$description = $_POST['description'] ?? '';
$type = $_POST['type'] ?? '';
$hours = intval($_POST['hours']) ?? 0;
$mins = intval($_POST['mins']) ?? 0;


if ($name == '') {
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
        SELECT id FROM users WHERE username=:username 
    ");
    $stmt->bindParam(':username', $user['username']);

    $stmt = $db->prepare("
        INSERT INTO recipes SET 
            name = :name,
            ingredients = :ingredients,
            url = :url,
            description = :description
        ");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':genre_id', $genre_id);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':price', $price);
    $stmt->execute();

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

header('location: /admin/books/index.php');


?>
