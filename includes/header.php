<?php
// Edited by: Danah
// Task: Shared header / footer for all pages
?>
<?php
if (!isset($pageTitle)) {
    $pageTitle = "Little Minds Store";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <a href="index.php" class="logo">
        <span class="logo-icon">🧸</span>
        <span class="store-name">Little Minds Store</span>
    </a>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="contact.php">Contact Us</a>
        <a href="login.php">Admin</a>
        <a href="cart.php" class="cart-link">
            <span class="cart-icon">🛒</span>
            <span>Cart</span>
        </a>
    </nav>
</header>