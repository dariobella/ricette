<?php
require_once "authorize.php";

try {
    $stmt = $db->prepare("
        SELECT id FROM recipes WHERE userId = :userId ORDER BY RAND() LIMIT 1
    ");
    $stmt->bindParam(':userId', $_SESSION['user']['id']);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

$r = $stmt->fetch(PDO::FETCH_ASSOC);

$url = strval($r['id']);

header("location: detail.php?id=$url");
        
?>