<?php
// Author: Jana Alqahtani
// Task: Display all products retrieved from the database
?>


<?php include 'includes/header.php'; ?>
<?php include 'database/db.php'; ?>

<section class="main-section">
    <h2 class="section-title">Our Products</h2>

    <div class="products-container">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM products");

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="product-card">
                    <img src="images/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="150">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <p><strong><?php echo $row['price']; ?> SAR</strong></p>
                    <a href="product-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                </div>
        <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
