<?php
require_once "database.php";

$id = (int) ($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(["id" => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: index.php");
    exit;
}

$pageTitle = "Edit product";
require_once "header.php";
?>

<h2 class="page-title">Edit product</h2>

<div class="form-card">
    <form action="update_product.php" method="POST">
        <input type="hidden" name="id" value="<?= $product["id"] ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars($product["name"]) ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" min="0" id="price" name="price"
                   value="<?= htmlspecialchars($product["price"]) ?>" required>
        </div>
        <div class="form-group">
            <label for="quantity_in_stock">Quantity in stock</label>
            <input type="number" step="1" min="0" id="quantity_in_stock" name="quantity_in_stock"
                   value="<?= htmlspecialchars($product["quantity_in_stock"]) ?>" required>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn--primary">Save changes</button>
            <a href="index.php" class="btn btn--secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once "footer.php"; ?>