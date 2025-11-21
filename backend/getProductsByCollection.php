<?php
//Get relevant product information by a certain ID.
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ClothingStore";

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("
        SELECT title, price, descript, thumbnail FROM `Products` WHERE section = :collection
    ");

    $stmt->execute([
        ':collection' => $_SESSION['collection'],
    ]);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "products" => $products,
    ]);
} catch(PDOException $e) {
    echo json_encode(["success" => false, "msg" => "Error: " . $e->getMessage()]);
}

$conn = null;
?>