<?php
require_once "database.php";

$name = trim($_POST["name"] ?? "");
$price = trim($_POST["price"] ?? "");
$quantity = trim($_POST["quantity_in_stock"] ?? "");

if ($name === "" || $price === "" || !is_numeric($price) || $quantity === "" || !ctype_digit($quantity)) {
    header("Location: create_product.php");
    exit;
}

$stmt = $db->prepare("
    INSERT INTO products (name, price, quantity_in_stock)
    VALUES (:name, :price, :quantity)
");
$stmt->execute([
    "name" => $name,
    "price" => (float) $price,
    "quantity" => (int) $quantity,
]);

header("Location: index.php");
exit;