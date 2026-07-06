<?php
require_once "database.php";

$stmt = $db->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "All products";
require_once "header.php";
?>