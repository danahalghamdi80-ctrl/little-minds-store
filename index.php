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