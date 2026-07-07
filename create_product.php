<?php
$pageTitle = "Add a product";
require_once "header.php";
?>

<h2 class="page-title">Add a product</h2>

<div class="form-card">
    <form action="store_product.php" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" min="0" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="quantity_in_stock">Quantity in stock</label>
            <input type="number" step="1" min="0" id="quantity_in_stock" name="quantity_in_stock" required>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn--primary">Save product</button>
            <a href="index.php" class="btn btn--secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once "footer.php"; ?>