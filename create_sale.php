<?php
require_once "database.php";

$customers = $db->query("SELECT id, name FROM customers ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$products = $db->query("SELECT id, name, quantity_in_stock, price FROM products ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "Record a sale";
require_once "header.php";
?>

<h2 class="page-title">Record a sale</h2>

<?php if (isset($_GET["error"]) && $_GET["error"] === "stock"): ?>
    <div class="error-banner">Not enough stock for that quantity. Please check available stock and try again.</div>
<?php endif; ?>

<?php if (count($customers) === 0 || count($products) === 0): ?>
    <div class="empty-state">
        <p>You need at least one customer and one product before recording a sale.</p>
        <a href="create_customer.php" class="btn btn--secondary">Add a customer</a>
        <a href="create_product.php" class="btn btn--primary">Add a product</a>
    </div>
<?php else: ?>
    <div class="form-card">
        <form action="store_sale.php" method="POST">
            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select id="customer_id" name="customer_id" required>
                    <option value="">-- Select customer --</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?= $customer["id"] ?>"><?= htmlspecialchars($customer["name"]) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="product_id">Product</label>
                <select id="product_id" name="product_id" required>
                    <option value="">-- Select product --</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product["id"] ?>">
                            <?= htmlspecialchars($product["name"]) ?>
                            (<?= (int) $product["quantity_in_stock"] ?> in stock, $<?= number_format($product["price"], 2) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" step="1" min="1" id="quantity" name="quantity" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn--primary">Save sale</button>
                <a href="sales.php" class="btn btn--secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php require_once "footer.php"; ?>