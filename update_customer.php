<?php
require_once "database.php";

$id = (int) ($_POST["id"] ?? 0);
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$address = trim($_POST["address"] ?? "");

if ($id <= 0 || $name === "" || $email === "") {
    header("Location: customers.php");
    exit;
}

$stmt = $db->prepare("
    UPDATE customers
    SET name = :name, email = :email, phone = :phone, address = :address
    WHERE id = :id
");
$stmt->execute([
    "name" => $name,
    "email" => $email,
    "phone" => $phone,
    "address" => $address,
    "id" => $id,
]);

header("Location: customers.php");
exit;