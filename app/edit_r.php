<?php

require_once "authorize.php";

#var_export($_POST); die;
#var_export($_GET); die;

$id = intval($_GET['id'] ?? 0);

$name = $_POST['name'] ?? '';
$ingredients = $_POST['ingredients'] ?? '';
$url = $_POST['url'] ?? '';
$description = $_POST['description'] ?? '';
$type = $_POST['type'] ?? '';
$hours = intval($_POST['hours']) ?? 0;
$mins = intval($_POST['mins']) ?? 0;


if ($name == '' || !in_array($type, ['', 'Colazione', 'Primo', 'Secondo', 'Snack', 'Dessert'])) {
    $_SESSION['edit_data'] = [
        'name'  => $name,
        'ingredients' => $ingredients,
        'url' => $url,
        'description' => $description,
        'type' => $type,
        'hours' => $hours,
        'mins' => $mins,
    ];
    header("location: edit.php?id=$id");
    die;
}

try {

    $stmt = $db->prepare("
        UPDATE recipes SET 
            `name` = :name,
            ingredients = :ingredients,
            url = :url,
            description = :description,
            `type` = (:type),
            hours = :hours,
            mins = :mins,
            userId = :userId
        WHERE id = :id
        ");
    $stmt->bindParam(':id', $id);
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

    if (isset($_FILES['image']) and $_FILES['image']['error'] == 0) {
        move_uploaded_file($_FILES['image']['tmp_name'], "pics/$id.png");
    }

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

header("location: detail.php?id=$id");


?>
