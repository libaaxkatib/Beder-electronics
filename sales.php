<?php
require_once "database.php";

$stmt = $db->query("
    SELECT sales.id, sales.quantity, sales.total_price, sales.sale_date,
           customers.name AS customer_name,
           products.name AS product_name
    FROM sales
    JOIN customers ON customers.id = sales.customer_id
    JOIN products ON products.id = sales.product_id
    ORDER BY sales.sale_date DESC
");
$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "All sales";
require_once "header.php";
?>

<h2 class="page-title">All sales</h2>
<p><a href="create_sale.php" class="btn btn--primary">+ Record a sale</a></p>

<?php if (count($sales) === 0): ?>
    <div class="empty-state">
        <p>No sales recorded yet.</p>
        <a href="create_sale.php" class="btn btn--primary">Record your first sale</a>
    </div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= htmlspecialchars($sale["sale_date"]) ?></td>
                    <td><?= htmlspecialchars($sale["customer_name"]) ?></td>
                    <td><?= htmlspecialchars($sale["product_name"]) ?></td>
                    <td><?= (int) $sale["quantity"] ?></td>
                    <td>$<?= number_format($sale["total_price"], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once "footer.php"; ?>