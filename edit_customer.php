<?php
require_once "database.php";

$id = (int) ($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: customers.php");
    exit;
}

$stmt = $db->prepare("SELECT * FROM customers WHERE id = :id");
$stmt->execute(["id" => $id]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$customer) {
    header("Location: customers.php");
    exit;
}

$pageTitle = "Edit customer";
require_once "header.php";
?>

<h2 class="page-title">Edit customer</h2>

<div class="form-card">
    <form action="update_customer.php" method="POST">
        <input type="hidden" name="id" value="<?= $customer["id"] ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars($customer["name"]) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($customer["email"]) ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone"
                   value="<?= htmlspecialchars($customer["phone"] ?? "") ?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address"
                   value="<?= htmlspecialchars($customer["address"] ?? "") ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn--primary">Save changes</button>
            <a href="customers.php" class="btn btn--secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once "footer.php"; ?>