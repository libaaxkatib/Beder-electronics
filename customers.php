<?php
require_once "database.php";

$stmt = $db->query("SELECT * FROM customers ORDER BY created_at DESC");
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "All customers";
require_once "header.php";
?>

<h2 class="page-title">All customers</h2>
<p><a href="create_customer.php" class="btn btn--primary">+ Add customer</a></p>

<?php if (count($customers) === 0): ?>
    <div class="empty-state">
        <p>No customers yet.</p>
        <a href="create_customer.php" class="btn btn--primary">Add your first customer</a>
    </div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= htmlspecialchars($customer["name"]) ?></td>
                    <td><?= htmlspecialchars($customer["email"]) ?></td>
                    <td><?= htmlspecialchars($customer["phone"] ?? "") ?></td>
                    <td><?= htmlspecialchars($customer["address"] ?? "") ?></td>
                    <td class="actions">
                        <a href="edit_customer.php?id=<?= $customer["id"] ?>" class="btn btn--secondary">Edit</a>
                        <form action="delete_customer.php" method="POST" onsubmit="return confirm('Delete this customer?');">
                            <input type="hidden" name="id" value="<?= $customer["id"] ?>">
                            <button type="submit" class="btn btn--danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once "footer.php"; ?>