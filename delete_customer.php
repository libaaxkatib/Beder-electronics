<?php
require_once "database.php";

$id = (int) ($_POST["id"] ?? 0);

if ($id > 0) {
    $stmt = $db->prepare("DELETE FROM customers WHERE id = :id");
    $stmt->execute(["id" => $id]);
}

header("Location: customers.php");
exit;