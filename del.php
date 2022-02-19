<?php

require_once "authorize.php";

$id = $_GET['id'] ?? 0;

try {
    $stmt = $db->prepare("DELETE FROM recipes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

header('location: index.php');

?>
