<?php
require_once "database.php";

$id = (int) ($_POST["id"] ?? 0);
$name = trim($_POST["name"] ?? "");
$price = trim($_POST["price"] ?? "");
$quantity = trim($_POST["quantity_in_stock"] ?? "");

if ($id <= 0 || $name === "" || $price === "" || !is_numeric($price) || $quantity === "" || !ctype_digit($quantity)) {
    header("Location: index.php");
    exit;
}

$stmt = $db->prepare("
    UPDATE products
    SET name = :name, price = :price, quantity_in_stock = :quantity
    WHERE id = :id
");
$stmt->execute([
    "name" => $name,
    "price" => (float) $price,
    "quantity" => (int) $quantity,
    "id" => $id,
]);

header("Location: index.php");
exit;