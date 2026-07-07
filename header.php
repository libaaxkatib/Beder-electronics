<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : "Beder-electronics" ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <h1><a href="index.php">Beder Electronics</a></h1>
        <nav>
            <a href="index.php">Products</a>
            <a href="customers.php">Customers</a>
            <a href="sales.php">Sales</a>
            <a href="create_product.php" class="btn btn--primary">+ Add product</a>
        </nav>
    </header>
    <main class="container">