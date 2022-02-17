<?php

require_once "authorize.php";

#var_export($_POST); die;

$name = $_POST['name'] ?? '';
$ingredients = $_POST['ingredients'] ?? '';
$url = $_POST['url'] ?? '';
$description = $_POST['description'] ?? '';
$type = $_POST['type'] ?? '';
$hours = intval($_POST['hours']) ?? 0;
$mins = intval($_POST['mins']) ?? 0;

if ($year == '') $year = null;
if ($price == '') $price = null;

# ERO QUI
if ($name == '') {
    # --> restituire un messaggio di errore
    $_SESSION['add_data'] = [
        'msg'  => 'Some required data is missing',
        'title' => $title,
        'genre_id' => $genre_id,
        'year' => $year,
        'price' => $price,
        'authors_id' => $authors_id,
    ];
    header('location: /admin/books/add.php?');
    die;
}

try {
    $stmt = $db->prepare("
        INSERT INTO books SET 
            title = :title,
            genre_id = :genre_id,
            year = :year,
            price = :price
        ");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':genre_id', $genre_id);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':price', $price);
    $stmt->execute();

    $book_id = $db->lastInsertId();
    $stmt = $db->prepare('
        INSERT INTO books_authors VALUES ( :book_id, :author_id )
    ');

    $stmt->bindParam(':book_id', $book_id);
    foreach ($authors_id as $author_id) {
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->execute();
    }

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die;
}

header('location: /admin/books/index.php');


?>
