<?php
require_once "database.php";

$id = (int) ($_POST["id"] ?? 0);

if ($id > 0) {
    $stmt = $db->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute(["id" => $id]);
}

header("Location: index.php");
exit;