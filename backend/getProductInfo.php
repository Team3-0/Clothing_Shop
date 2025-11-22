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
        SELECT title, price, descript, thumbnail FROM `Product` WHERE id = :pId
    ");
    
    $stmt->execute([
        ':pId' => $_POST['pId'],
    ]);

    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "product" => $product[0],
    ]);
} catch(PDOException $e) {
    echo json_encode(["success" => false, "msg" => "Error: " . $e->getMessage()]);
}

$conn = null;
?>