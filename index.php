<?php
require_once "database.php";

$stmt = $db->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "All products";
require_once "header.php";
?>

<h2 class="page-title">All products</h2>

<?php if (count($products) === 0): ?>
    <div class="empty-state">
        <p>No products yet.</p>
        <a href="create_product.php" class="btn btn--primary">Add your first product</a>
    </div>
<?php else: ?>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product["name"]) ?></td>
                    <td>$<?= number_format($product["price"], 2) ?></td>
                    <td class="<?= $product["quantity_in_stock"] <= 5 ? "stock-low" : "" ?>">
                        <?= (int) $product["quantity_in_stock"] ?>
                    </td>
                    <td class="actions">
                        <a href="edit_product.php?id=<?= $product["id"] ?>" class="btn btn--secondary">Edit</a>
                        <form action="delete_product.php" method="POST" onsubmit="return confirm('Delete this product?');">
                            <input type="hidden" name="id" value="<?= $product["id"] ?>">
                            <button type="submit" class="btn btn--danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once "footer.php"; ?>