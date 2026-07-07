<?php
require_once "database.php";

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$address = trim($_POST["address"] ?? "");

if ($name === "" || $email === "") {
    header("Location: create_customer.php");
    exit;
}

$stmt = $db->prepare("
    INSERT INTO customers (name, email, phone, address)
    VALUES (:name, :email, :phone, :address)
");
$stmt->execute([
    "name" => $name,
    "email" => $email,
    "phone" => $phone,
    "address" => $address,
]);

header("Location: customers.php");
exit;