<?php
// Author: Danah
// Task: Home page for Little Minds Store

error_reporting(E_ALL);
ini_set('display_errors', 1);

$pageTitle = "Little Minds Store - Home";
include 'includes/header.php';
?>


<section class="main-section">
    <div class="hero">
        <h1>Learning Through Play Starts Here</h1>
        <p>
            Welcome to Little Minds Store, where educational toys and creative learning tools
            make every playtime more meaningful, enjoyable, and inspiring for children.
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


   <div class="map-box" style="margin-top: 20px;">
    <h2 class="section-title">Past Purchases</h2>

    <div id="pastPurchasesContainer">
        <p id="pastPurchasesText">
            Returning customers will be able to view their past purchases here.
        </p>
    </div>

</div>
</section>

<?php include 'includes/footer.php'; ?>
