<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$pageTitle = "Little Minds Store - Home";
?>
<?php
$pageTitle = "Little Minds Store - Home";
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
    <div class="logo">
        <span class="logo-icon">🧸</span>
        <span class="store-name">Little Minds Store</span>
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="contact.php">Contact Us</a>
        <a href="cart.php" class="cart-link">
            <span class="cart-icon">🛒</span>
            <span>Cart</span>
        </a>
    </nav>
</header>

<section class="main-section">
    <div class="hero">
        <h1>Welcome to Little Minds Store</h1>
        <p>
            A simple online store for educational toys, books, puzzles, and fun learning tools for children.
            This page is prepared to be connected later with the database and backend.
        </p>

        <div class="button-group">
            <a href="products.php" class="btn btn-primary">Shop Now</a>
            <a href="contact.php" class="btn btn-secondary">Contact Us</a>
        </div>
    </div>

    <section>
        <h2 class="section-title">About Our Store</h2>
        <div class="placeholder-box">
            <p>
                Little Minds Store is designed to provide a clean and easy shopping experience for parents
                looking for educational products for their children.
            </p>
        </div>
    </section>

    <br>

    <section>
        <h2 class="section-title">Featured Products</h2>
        <div class="placeholder-box">
            <p>
                Product cards will be displayed here later after connecting this page with the products table
                and backend logic.
            </p>
        </div>
    </section>

    <br>

    <section>
        <h2 class="section-title">Why Choose Us</h2>
        <div class="placeholder-box">
            <p>
                We focus on simple design, child-friendly products, and a website structure that can be expanded
                later with database, cart, and checkout functionality.
            </p>
        </div>
    </section>
</section>

<footer>
    <p>&copy; 2026 Little Minds Store. All rights reserved.</p>
</footer>

</body>
</html>