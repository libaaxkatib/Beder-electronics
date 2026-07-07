<?php
require_once "database.php";

$customerId = (int) ($_POST["customer_id"] ?? 0);
$productId = (int) ($_POST["product_id"] ?? 0);
$quantity = trim($_POST["quantity"] ?? "");

if ($customerId <= 0 || $productId <= 0 || $quantity === "" || !ctype_digit($quantity) || (int) $quantity <= 0) {
    header("Location: create_sale.php");
    exit;
}
$quantity = (int) $quantity;

$stmt = $db->prepare("SELECT price, quantity_in_stock FROM products WHERE id = :id");
$stmt->execute(["id" => $productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: create_sale.php");
    exit;
}

if ($quantity > $product["quantity_in_stock"]) {
    header("Location: create_sale.php?error=stock");
    exit;
}

$totalPrice = $product["price"] * $quantity;

$db->beginTransaction();
try {
    $insert = $db->prepare("
        INSERT INTO sales (customer_id, product_id, quantity, total_price)
        VALUES (:customer_id, :product_id, :quantity, :total_price)
    ");
    $insert->execute([
        "customer_id" => $customerId,
        "product_id" => $productId,
        "quantity" => $quantity,
        "total_price" => $totalPrice,
    ]);

    $update = $db->prepare("
        UPDATE products
        SET quantity_in_stock = quantity_in_stock - :qty
        WHERE id = :id AND quantity_in_stock >= :qty2
    ");
    $update->execute([
        "qty" => $quantity,
        "qty2" => $quantity,
        "id" => $productId,
    ]);

    if ($update->rowCount() === 0) {
        throw new Exception("Stock unavailable");
    }

    $db->commit();
} catch (Exception $e) {
    $db->rollBack();
    header("Location: create_sale.php?error=stock");
    exit;
}

header("Location: sales.php");
exit;