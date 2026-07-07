<?php
$pageTitle = "Add a customer";
require_once "header.php";
?>

<h2 class="page-title">Add a customer</h2>

<div class="form-card">
    <form action="store_customer.php" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn--primary">Save customer</button>
            <a href="customers.php" class="btn btn--secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once "footer.php"; ?>